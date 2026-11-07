<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of community humanitarian services.
     */
    public function index()
    {
        $services = Service::servicesOnly()->active()->orderBy('order', 'asc')->get();
        $courses = Service::coursesOnly()->active()->orderBy('order', 'asc')->get();

        return view('services.index', compact('services', 'courses'));
    }

    /**
     * Display vocational courses and free educational seminars.
     */
    public function courses()
    {
        $courses = Service::coursesOnly()->active()->orderBy('order', 'asc')->get();
        $services = Service::servicesOnly()->active()->orderBy('order', 'asc')->get();

        return view('courses.index', compact('courses', 'services'));
    }

    /**
     * Display a specific service or course details with comprehensive media, gallery, and servicing options.
     */
    public function show($slug)
    {
        $service = Service::where('slug', $slug)->active()->firstOrFail();

        // 1. DYNAMIC GALLERY RETRIEVAL FROM GALLERY DATABASE
        // Matches images added by Admin in Gallery matching this service / course sector
        $categoryMapping = [
            'electricity' => ['Electricity', 'Power', 'Utility & Infrastructure'],
            'education' => ['Education', 'Scholarships', 'Learning & Child Development'],
            'house' => ['Housing Assistance', 'House', 'Shelter & Housing', 'Housing', 'Shelter'],
            'water-supply' => ['water supply', 'Water & Sanitation (WASH)', 'Clean Water', 'Water Supply', 'Water'],
            'basic-facilities' => ['Basic Facilities', 'Community Welfare', 'Sanitation', 'Essential Basic Facilities'],
            'livelihood-poverty' => ['Livelihood', 'Livelihood for Poverty', 'Economic Self-Reliance', 'Poverty Alleviation'],
            'widows-head-of-families' => ['Widows & Female Heads', 'Support for Widows', 'Women & Vulnerable Families', 'Widows'],
            'physical-disabilities' => ['Physical Disabilities', 'Inclusion & Specialized Care', 'Disabilities', 'Assistance & Care for Physical Disabilities'],
            'free-seminars-school-students' => ['Free Seminars', 'Seminars', 'Education', 'Youth Education & Career'],
            'sewing-course' => ['Sewing Course', 'Tailoring', 'Sewing', 'Vocational Training', 'Vocational & Livelihood Skills'],
            'it-certificate-course' => ['IT Certificate', 'IT Course', 'Information Technology', 'Education'],
            'it-diploma-course' => ['IT Diploma', 'IT Course', 'Information Technology', 'Education'],
            'cooking-course' => ['Cooking Course', 'Cooking', 'Culinary', 'Vocational Training', 'Culinary & Hospitality Skills'],
            'english-diploma-course' => ['English Course', 'English Diploma', 'Language & Communication', 'Education'],
        ];

        $targetCategories = $categoryMapping[$service->slug] ?? [$service->category, $service->title];

        // Query GalleryImage table dynamically (Respects admin additions and deletions in Gallery)
        $dbGalleryImages = \App\Models\GalleryImage::where(function ($query) use ($targetCategories, $service) {
            foreach ($targetCategories as $cat) {
                $query->orWhere('category', 'LIKE', '%' . $cat . '%');
            }
            $query->orWhere('category', 'LIKE', '%' . $service->slug . '%')
                  ->orWhere('title', 'LIKE', '%' . ($service->short_title ?? $service->title) . '%');
        })
        ->orderBy('order', 'asc')
        ->orderBy('created_at', 'desc')
        ->get();

        if ($dbGalleryImages->count() > 0) {
            $gallery = $dbGalleryImages->map(function ($img) use ($service) {
                return [
                    'url'   => $img->image_path,
                    'title' => $img->title,
                    'tag'   => $img->category ?: ($service->short_title ?? 'Field Operation'),
                    'desc'  => !empty($img->description) ? $img->description : ('Verified SDC humanitarian deliverable under ' . ($service->short_title ?? $service->title) . '.'),
                ];
            })->toArray();
        } elseif (is_array($service->gallery) && count($service->gallery) > 0) {
            $gallery = $service->gallery;
        } else {
            $gallery = [];
        }

        // 2. SPECIALIST SERVICING ROLES FOR ALL 8 SERVICES & 6 COURSES
        $servicingRoles = [
            'electricity' => [
                ['role' => 'Certified Electrician', 'desc' => 'Conduct house wiring, switchboard repairs, and safety earthing for poor families.'],
                ['role' => 'Solar Energy Engineer', 'desc' => 'Design, install, and service off-grid solar panels and battery storage units.'],
                ['role' => 'Hardware & Electrical Supplier', 'desc' => 'Provide discounted cables, conduit pipes, bulbs, and circuit breakers.'],
                ['role' => 'Safety Inspector', 'desc' => 'Perform volunteer inspection visits to certify household electrical installations.'],
            ],
            'education' => [
                ['role' => 'Volunteer Teacher / Tutor', 'desc' => 'Teach English, Mathematics, Science, or IT at our community learning centers.'],
                ['role' => 'Seminar Speaker / Lecturer', 'desc' => 'Conduct motivational seminars and exam preparatory workshops for O/L and A/L students.'],
                ['role' => 'Book & Stationery Sponsor', 'desc' => 'Contribute stationery sets, uniforms, and textbooks for marginalized children.'],
                ['role' => 'Career Guidance Mentor', 'desc' => 'Counsel school leavers on higher education, apprenticeships, and vocational careers.'],
            ],
            'house' => [
                ['role' => 'Civil Engineer / Architect', 'desc' => 'Provide structural drawings, bill of quantities, and construction supervision.'],
                ['role' => 'Mason / Carpenter / Painter', 'desc' => 'Volunteer craftsmanship to construct walls, lay roofs, and build secure shelters.'],
                ['role' => 'Building Materials Supplier', 'desc' => 'Donate or supply sand, cement, roof tiles, bricks, and timber at subsidized rates.'],
                ['role' => 'Site Supervisor', 'desc' => 'Coordinate field teams and monitor housing milestones in rural village clusters.'],
            ],
            'water-supply' => [
                ['role' => 'Hydrogeologist / Well Driller', 'desc' => 'Operate borehole rigs and pinpoint freshwater aquifers in drought-prone areas.'],
                ['role' => 'Plumbing Technician', 'desc' => 'Install pipelines, storage tanks, taps, and pump mechanisms for communities.'],
                ['role' => 'Water Quality Specialist', 'desc' => 'Conduct microbiological and chemical tests to verify water purity and safety.'],
                ['role' => 'Pump Maintenance Volunteer', 'desc' => 'Service and grease mechanical handpumps and solar water pumps regularly.'],
            ],
            'basic-facilities' => [
                ['role' => 'Sanitation Contractor', 'desc' => 'Build sanitary pour-flush latrines, soakage pits, and septic tanks.'],
                ['role' => 'Public Health Worker', 'desc' => 'Conduct village hygiene awareness campaigns and distribute sanitization supplies.'],
                ['role' => 'Environmental Volunteer', 'desc' => 'Lead drainage cleaning drives, tree planting, and solid waste cleanup campaigns.'],
                ['role' => 'Equipment Provider', 'desc' => 'Supply sanitary fittings, pipes, drainage culverts, and waste receptacles.'],
            ],
            'livelihood-poverty' => [
                ['role' => 'Vocational Trainer', 'desc' => 'Instruct youth and breadwinners in carpentry, welding, automotive repair, or handicrafts.'],
                ['role' => 'Agriculture & Poultry Expert', 'desc' => 'Advise rural families on livestock management, home gardening, and organic fertilizer.'],
                ['role' => 'Micro-Business Coach', 'desc' => 'Help small entrepreneurs calculate profits, market goods, and manage capital.'],
                ['role' => 'Tool & Equipment Sponsor', 'desc' => 'Provide sewing machines, mechanic toolkits, fishing nets, or workshop equipment.'],
            ],
            'widows-head-of-families' => [
                ['role' => 'Culinary / Baking Instructor', 'desc' => 'Train widowed mothers in commercially viable baking, pastry, and home catering.'],
                ['role' => 'Tailoring Mentor', 'desc' => 'Provide pattern cutting and garment stitching mentoring to female entrepreneurs.'],
                ['role' => 'Counselor & Social Worker', 'desc' => 'Offer compassionate psychosocial guidance, family counseling, and legal assistance.'],
                ['role' => 'Healthcare Professional', 'desc' => 'Conduct free health checkups and provide nutrition advice for mothers and children.'],
            ],
            'physical-disabilities' => [
                ['role' => 'Physiotherapist', 'desc' => 'Provide therapeutic rehabilitation and mobility exercises for disabled individuals.'],
                ['role' => 'Prosthetic / Orthotic Technician', 'desc' => 'Fit, repair, and maintain artificial limbs, braces, and specialized mobility aids.'],
                ['role' => 'Wheelchair Technician', 'desc' => 'Assemble, customize, and repair tricycles and wheelchairs in village clinics.'],
                ['role' => 'Accessibility Builder', 'desc' => 'Construct wheelchair ramps and accessible bathroom grab bars for village homes.'],
            ],
            'free-seminars-school-students' => [
                ['role' => 'Guest Lecturer / Seminar Speaker', 'desc' => 'Conduct high-impact exam preparation and motivational sessions for O/L and A/L students.'],
                ['role' => 'Subject Specialist Tutor', 'desc' => 'Deliver specialized seminar modules in Mathematics, Science, English, or Commerce.'],
                ['role' => 'Study Materials & Exam Kit Sponsor', 'desc' => 'Donate past exam model papers, stationery kits, and school supplies for seminar attendees.'],
                ['role' => 'Career Guidance Counselor', 'desc' => 'Mentor school leavers on higher studies, university entrance, and vocational career pathways.'],
            ],
            'sewing-course' => [
                ['role' => 'Master Tailor & Pattern Maker', 'desc' => 'Instruct students in professional pattern drafting, modern garment cutting, and tailoring.'],
                ['role' => 'Sewing Machine Technician', 'desc' => 'Service, calibrate, and repair domestic and industrial electric sewing machines.'],
                ['role' => 'Fabric & Haberdashery Supplier', 'desc' => 'Supply discounted or sponsored fabrics, threads, scissors, measuring tapes, and zippers.'],
                ['role' => 'Garment Industry Placement Mentor', 'desc' => 'Connect certified female graduates to clothing brands, retail boutiques, and tailoring contracts.'],
            ],
            'it-certificate-course' => [
                ['role' => 'IT Instructor / Computer Trainer', 'desc' => 'Teach computer basics, Windows OS, MS Word, Excel, PowerPoint, and safe internet navigation.'],
                ['role' => 'Hardware & Lab Technician', 'desc' => 'Assemble, configure, and maintain computer training lab PCs, keyboards, and network routers.'],
                ['role' => 'Computer Equipment Sponsor', 'desc' => 'Donate refurbished desktop computers, laptops, monitors, or uninterruptible power supplies (UPS).'],
                ['role' => 'Digital Literacy Volunteer', 'desc' => 'Guide rural beginners, youth, and homemakers in online digital skills and government e-services.'],
            ],
            'it-diploma-course' => [
                ['role' => 'Full-Stack Software Engineer', 'desc' => 'Mentor students in web development, HTML5, CSS3, JavaScript, PHP, MySQL, and modern frameworks.'],
                ['role' => 'Database & Systems Administrator', 'desc' => 'Teach server configuration, database design, Git version control, and cybersecurity fundamentals.'],
                ['role' => 'Tech Industry Placement Partner', 'desc' => 'Provide real-world software project assignments, remote code reviews, and junior tech internships.'],
                ['role' => 'High-Speed Tech Sponsor', 'desc' => 'Sponsor high-speed internet connectivity, cloud hosting subscriptions, and coding lab hardware.'],
            ],
            'cooking-course' => [
                ['role' => 'Executive Chef / Culinary Instructor', 'desc' => 'Teach commercial culinary arts, food safety & hygiene standards, nutrition, and recipe formulation.'],
                ['role' => 'Commercial Baker & Pastry Specialist', 'desc' => 'Instruct students in commercial baking, cake decoration, pastry production, and catering packaging.'],
                ['role' => 'Kitchen Equipment Supplier', 'desc' => 'Provide or service commercial mixers, baking ovens, blenders, and commercial cookware sets.'],
                ['role' => 'Hospitality & Catering Mentor', 'desc' => 'Assist certified trainees in establishing home catering enterprises or finding hospitality jobs.'],
            ],
            'english-diploma-course' => [
                ['role' => 'Spoken English & ESL Lecturer', 'desc' => 'Teach conversational English, pronunciation, phonetics, sentence structure, and vocabulary building.'],
                ['role' => 'Professional Workplace Coach', 'desc' => 'Conduct professional business communication, email writing, and mock job interview workshops.'],
                ['role' => 'Conversational Club Volunteer', 'desc' => 'Host weekly English speaking practice circles and debate sessions for youth and students.'],
                ['role' => 'Audio-Visual Resource Sponsor', 'desc' => 'Sponsor English learning textbooks, audio headsets, multimedia projector units, and certificates.'],
            ],
        ];

        if (is_array($service->servicing_roles) && count($service->servicing_roles) > 0) {
            $roles = $service->servicing_roles;
        } else {
            $roles = $servicingRoles[$service->slug] ?? [
                ['role' => 'Field Volunteer', 'desc' => 'Support on-ground delivery, logistics, and beneficiary verification.'],
                ['role' => 'Professional Specialist', 'desc' => 'Offer your expertise, technical advice, or consulting for community relief.'],
                ['role' => 'Resource Partner', 'desc' => 'Contribute tools, equipment, or educational materials to empower families.'],
                ['role' => 'Community Coordinator', 'desc' => 'Help mobilize local participants and facilitate service outreach.'],
            ];
        }

        // 3. DYNAMIC PROVIDE SERVICING CARDS (Card Style from Image 1)
        // High-resolution cards with Image, Date, Title at top, Description at bottom
        $defaultCardsMap = [
            'electricity' => [
                [
                    'image' => 'images/gallery/gallery_1793433125_p2.jpeg',
                    'title' => 'Household Power Wiring & Grid Connections',
                    'tag' => 'FIELD SERVICE',
                    'date' => '2026-10-16',
                    'desc' => 'SDC technical teams sponsoring internal safety wiring, circuit breakers, and grid hookups for impoverished rural families.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433233_p1.jpeg',
                    'title' => 'Emergency Solar Lighting Systems',
                    'tag' => 'SOLAR ENERGY',
                    'date' => '2026-10-12',
                    'desc' => 'Deploying decentralized solar panels and rechargeable lighting kits for remote, off-grid rural households.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433288_p4.jpeg',
                    'title' => 'Electrical Safety Audits & Fixtures Maintenance',
                    'tag' => 'SAFETY AUDIT',
                    'date' => '2026-10-09',
                    'desc' => 'Conducting free home electrical safety inspections and replacing faulty switches to prevent domestic fire accidents.',
                ],
            ],
            'education' => [
                [
                    'image' => 'images/gallery/gallery_1793433605_edu1.jpg',
                    'title' => 'Distribution of Educational Kits and School Supplies',
                    'tag' => 'SCHOOL KITS',
                    'date' => '2026-10-16',
                    'desc' => 'Distributing school uniforms, stationery bags, geometry kits, and term textbooks to deserving rural students.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433639_edu4.jpg',
                    'title' => 'Free Exam Seminars & Career Mentorship',
                    'tag' => 'SEMINAR',
                    'date' => '2026-10-12',
                    'desc' => 'Conducting motivational workshops and exam preparatory seminars led by qualified university lecturers across schools.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433682_edu7.jpg',
                    'title' => 'Community Remedial Learning Centers',
                    'tag' => 'TUITION',
                    'date' => '2026-10-08',
                    'desc' => 'Running after-school remedial learning centers in underprivileged villages to bridge academic gaps for students.',
                ],
            ],
            'house' => [
                [
                    'image' => 'images/gallery/gallery_1793433859_s2.jpeg',
                    'title' => 'Dignified Permanent Shelter Construction',
                    'tag' => 'SHELTER',
                    'date' => '2026-10-19',
                    'desc' => 'Constructing disaster-resilient brick houses with secure roofs, doors, and private sanitary amenities for destitute families.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433924_l10.jpeg',
                    'title' => 'Monsoon Roof Renovation & Waterproofing',
                    'tag' => 'RENOVATION',
                    'date' => '2026-10-15',
                    'desc' => 'Replacing broken asbestos and leaking tin roofs with sturdy timber framing and weather-sealed roofing sheets.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433966_s3.jpeg',
                    'title' => 'Foundation Fortification & Plastering Works',
                    'tag' => 'CIVIL WORKS',
                    'date' => '2026-10-11',
                    'desc' => 'Reinforcing foundation columns, stone masonry, and plastering for flood-affected families in vulnerable coastal belts.',
                ],
            ],
            'water-supply' => [
                [
                    'image' => 'images/gallery/gallery_1793433379_p1.jpeg',
                    'title' => 'Deep Tube Well Drilling & Handpumps',
                    'tag' => 'TUBE WELLS',
                    'date' => '2026-10-18',
                    'desc' => 'Borehole drilling reaching deep uncontaminated freshwater aquifers in drought-prone dry-zone coastal communities.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433428_p2.jpeg',
                    'title' => 'Reverse Osmosis Filtration & Purification Station',
                    'tag' => 'PURIFICATION',
                    'date' => '2026-10-14',
                    'desc' => 'Constructing village-scale water purification plants to eliminate kidney disease and eradicate waterborne bacteria.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433529_bill1.jpeg',
                    'title' => 'Rural Pipeline Distribution & Tap Connections',
                    'tag' => 'DISTRIBUTION',
                    'date' => '2026-10-10',
                    'desc' => 'Laying subterranean distribution pipes and public drinking tap stations to save women and children hours of carrying water.',
                ],
            ],
            'basic-facilities' => [
                [
                    'image' => 'images/services/basic-facilities.png',
                    'title' => 'Hygienic Pour-Flush Sanitary Latrine Units',
                    'tag' => 'SANITATION',
                    'date' => '2026-10-17',
                    'desc' => 'Building private pour-flush toilet facilities to safeguard health, hygiene, and human dignity for women and children.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433859_s2.jpeg',
                    'title' => 'Communal Drainage Cleaning & Mosquito Control',
                    'tag' => 'DRAINAGE',
                    'date' => '2026-10-13',
                    'desc' => 'Clearing blocked drainage channels and establishing concrete soakage pits to combat dengue and malaria outbreaks.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433966_s3.jpeg',
                    'title' => 'Family Hygiene & Antiseptic Relief Hampers',
                    'tag' => 'HEALTH KITS',
                    'date' => '2026-10-09',
                    'desc' => 'Distributing essential soaps, antiseptic solutions, dental kits, and household sanitation supplies to low-income clusters.',
                ],
            ],
            'livelihood-poverty' => [
                [
                    'image' => 'images/services/livelihood-poverty.jpg',
                    'title' => 'Micro-Enterprise Startup Toolkits',
                    'tag' => 'TOOLKITS',
                    'date' => '2026-10-16',
                    'desc' => 'Providing carpentry sets, welding gear, motorcycle repair tools, and fishing gear for independent household livelihoods.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433924_l10.jpeg',
                    'title' => 'Smallholder Poultry & Organic Seed Grants',
                    'tag' => 'AGRICULTURE',
                    'date' => '2026-10-12',
                    'desc' => 'Distributing egg-laying hens, goats, and organic farming seeds to create sustainable everyday revenue for struggling families.',
                ],
                [
                    'image' => 'images/courses/sewing-course.jpg',
                    'title' => 'Industrial Electric Sewing Machines for Women',
                    'tag' => 'TAILORING',
                    'date' => '2026-10-07',
                    'desc' => 'Equipping trained female tailors with heavy-duty electric sewing machines to launch home-based dressmaking businesses.',
                ],
            ],
            'widows-head-of-families' => [
                [
                    'image' => 'images/services/widows-families.jpg',
                    'title' => 'Monthly Dignity Nutrition & Food Hampers',
                    'tag' => 'FOOD AID',
                    'date' => '2026-10-18',
                    'desc' => 'Supplying rice, flour, pulses, cooking oil, and nutritious essentials to widowed mothers caring for young dependents.',
                ],
                [
                    'image' => 'images/courses/cooking-course.jpg',
                    'title' => 'Commercial Baking & Catering Startup Grants',
                    'tag' => 'ENTERPRISE',
                    'date' => '2026-10-14',
                    'desc' => 'Providing commercial blenders, baking ovens, and catering equipment for mothers earning through home food production.',
                ],
                [
                    'image' => 'images/courses/sewing-course.jpg',
                    'title' => 'Garment Making & Pattern Cutting Support',
                    'tag' => 'WOMEN RIGHTS',
                    'date' => '2026-10-10',
                    'desc' => 'Supplying tailoring toolkits and fabric bundles so single mothers can earn flexibly while looking after their children.',
                ],
            ],
            'physical-disabilities' => [
                [
                    'image' => 'images/services/disabilities.jpg',
                    'title' => 'Custom Wheelchair & Hand-Cranked Tricycle Aid',
                    'tag' => 'MOBILITY',
                    'date' => '2026-10-19',
                    'desc' => 'Providing lightweight manual wheelchairs, pediatric wheelchairs, and specialized mobility tricycles free of charge.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433428_p2.jpeg',
                    'title' => 'Concrete Accessibility Ramps for Rural Homes',
                    'tag' => 'RAMPS',
                    'date' => '2026-10-15',
                    'desc' => 'Constructing concrete safety ramps and widening doorways in rural homes and school entrances for barrier-free access.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433125_p2.jpeg',
                    'title' => 'Orthotic Braces, Walkers & Hearing Devices',
                    'tag' => 'MEDICAL AIDS',
                    'date' => '2026-10-11',
                    'desc' => 'Supplying elbow crutches, mobility walkers, and hearing assistance units for elderly and disabled individuals.',
                ],
            ],
            'free-seminars-school-students' => [
                [
                    'image' => 'images/courses/free-seminars.jpg',
                    'title' => 'G.C.E. O/L & A/L Exam Strategy Masterclass',
                    'tag' => 'SEMINAR',
                    'date' => '2026-10-17',
                    'desc' => 'Top university lecturers conducting free paper analysis, past exam answering techniques, and revision coaching.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433605_edu1.jpg',
                    'title' => 'School Leavers Career Guidance Symposium',
                    'tag' => 'GUIDANCE',
                    'date' => '2026-10-13',
                    'desc' => 'Counseling students on vocational diplomas, university admissions, scholarships, and modern job market demands.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433639_edu4.jpg',
                    'title' => 'Exam Prep Workbooks & Model Papers Grant',
                    'tag' => 'MATERIALS',
                    'date' => '2026-10-09',
                    'desc' => 'Distributing complimentary model examination books, geometry instruments, and stationery packs for attendees.',
                ],
            ],
            'sewing-course' => [
                [
                    'image' => 'images/courses/sewing-course.jpg',
                    'title' => 'Professional Garment Cutting & Tailoring Workshop',
                    'tag' => 'TRAINING',
                    'date' => '2026-10-18',
                    'desc' => 'Intensive practical training in pattern drafting, modern ladies garments, uniform tailoring, and embroidery styling.',
                ],
                [
                    'image' => 'images/services/livelihood-poverty.jpg',
                    'title' => 'Industrial Sewing Machine Maintenance Servicing',
                    'tag' => 'MACHINERY',
                    'date' => '2026-10-14',
                    'desc' => 'Instructing students in bobbin calibration, needle replacement, motor safety, and everyday machine servicing.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433859_s2.jpeg',
                    'title' => 'Graduate Placement & Commercial Boutique Links',
                    'tag' => 'EMPLOYMENT',
                    'date' => '2026-10-10',
                    'desc' => 'Connecting certified tailoring graduates with apparel manufacturers and bulk home order tailoring contracts.',
                ],
            ],
            'it-certificate-course' => [
                [
                    'image' => 'images/courses/it-certificate.jpg',
                    'title' => 'Foundations of Computer Literacy & Windows OS',
                    'tag' => 'BASIC IT',
                    'date' => '2026-10-16',
                    'desc' => 'Hands-on training covering computer hardware, file management, touch typing, and safe web navigation skills.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433639_edu4.jpg',
                    'title' => 'Microsoft Office Suite for Workplace Productivity',
                    'tag' => 'MS OFFICE',
                    'date' => '2026-10-12',
                    'desc' => 'Mastering Word document preparation, Excel formula calculations, and PowerPoint slide presentation skills.',
                ],
                [
                    'image' => 'images/courses/it-diploma.jpg',
                    'title' => 'Refurbished PC Lab Upgrades & Networking',
                    'tag' => 'HARDWARE',
                    'date' => '2026-10-08',
                    'desc' => 'Technicians setting up computer workstations, routers, and peripheral equipment for village training students.',
                ],
            ],
            'it-diploma-course' => [
                [
                    'image' => 'images/courses/it-diploma.jpg',
                    'title' => 'Full-Stack Web Development Bootcamp',
                    'tag' => 'CODING',
                    'date' => '2026-10-19',
                    'desc' => 'Comprehensive training in HTML5, CSS3, modern JavaScript, PHP, MySQL, and dynamic web application building.',
                ],
                [
                    'image' => 'images/courses/it-certificate.jpg',
                    'title' => 'Database Design & Server Administration',
                    'tag' => 'DATABASE',
                    'date' => '2026-10-15',
                    'desc' => 'Teaching relational databases, cloud server deployment, Git version control, and web security best practices.',
                ],
                [
                    'image' => 'images/services/education.jpg',
                    'title' => 'Live Software Projects & Tech Internships',
                    'tag' => 'INTERNSHIPS',
                    'date' => '2026-10-11',
                    'desc' => 'Pairing advanced students with real client software deliverables, coding mentorship, and internship placements.',
                ],
            ],
            'cooking-course' => [
                [
                    'image' => 'images/courses/cooking-course.jpg',
                    'title' => 'Commercial Culinary Arts & Hygiene Standards',
                    'tag' => 'CULINARY',
                    'date' => '2026-10-17',
                    'desc' => 'Practical instruction in knife skills, food safety hygiene, commercial kitchen sanitation, and flavor pairing.',
                ],
                [
                    'image' => 'images/services/widows-families.jpg',
                    'title' => 'Baking, Pastry Production & Cake Decoration',
                    'tag' => 'BAKING',
                    'date' => '2026-10-13',
                    'desc' => 'Training students in commercial bread baking, savory pastries, celebration cakes, and confectionery packaging.',
                ],
                [
                    'image' => 'images/services/livelihood-poverty.jpg',
                    'title' => 'Catering Enterprise Startup & Menu Costing',
                    'tag' => 'BUSINESS',
                    'date' => '2026-10-09',
                    'desc' => 'Guiding trainees on bulk ingredient purchasing, recipe costing, event menu planning, and food safety compliance.',
                ],
            ],
            'english-diploma-course' => [
                [
                    'image' => 'images/courses/english-diploma.jpg',
                    'title' => 'Conversational English Fluency & Pronunciation',
                    'tag' => 'SPOKEN ENGLISH',
                    'date' => '2026-10-18',
                    'desc' => 'Daily spoken dialogue practice, phonetics training, vocabulary expansion, and confidence building for students.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433605_edu1.jpg',
                    'title' => 'Business English & Workplace Communications',
                    'tag' => 'CAREER',
                    'date' => '2026-10-14',
                    'desc' => 'Mastering professional email drafting, formal reports, telephonic etiquette, and international meeting communication.',
                ],
                [
                    'image' => 'images/gallery/gallery_1793433682_edu7.jpg',
                    'title' => 'Job Interview Preparation & Public Speaking',
                    'tag' => 'INTERVIEW',
                    'date' => '2026-10-10',
                    'desc' => 'Conducting video mock interviews, impromptu speeches, resume optimization, and corporate presentation masterclasses.',
                ],
            ],
        ];

        if (is_array($service->servicing_cards) && count($service->servicing_cards) > 0) {
            $servicingCards = $service->servicing_cards;
        } else {
            $servicingCards = $defaultCardsMap[$service->slug] ?? [
                [
                    'image' => $service->provide_image ?: $service->image,
                    'title' => $service->provide_title ?: 'Community Servicing Deliverable',
                    'tag' => 'FIELD WORK',
                    'date' => date('Y-m-d'),
                    'desc' => $service->provide_details ?: 'Volunteer or partner with SDC to deliver hands-on technical servicing.',
                ],
            ];
        }

        $relatedServices = Service::where('type', $service->type)
            ->where('id', '!=', $service->id)
            ->active()
            ->take(4)
            ->get();

        return view('services.show', compact('service', 'gallery', 'roles', 'servicingCards', 'relatedServices'));
    }
}
