@extends('layouts.app')

@section('title', 'Social Development Council | International Charity & Community Support')

@section('content')

    <!-- A. HERO BANNER / IMAGE SLIDER -->
    <section class="hero-slider-section">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
            <!-- Slide Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">
                <!-- Slide 1: Helping Communities -->
                <div class="carousel-item active hero-slide-item" style="background-image: url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=1800&q=80');">
                    <div class="hero-overlay">
                        <div class="container">
                            <div class="hero-content">
                                <span class="hero-tag"><i class="fa-solid fa-hands-holding-circle"></i> Empowering Communities</span>
                                <h1 class="hero-title">Together, We Can Make a Difference</h1>
                                <p class="hero-description">
                                    Join hands with the Social Development Council to uplift underprivileged communities through sustainable aid, clean water, healthcare access, and emergency response.
                                </p>
                                <div class="d-flex flex-wrap gap-3">
                                    <a href="{{ route('services.index') }}" class="btn btn-navy"><i class="fa-solid fa-hand-holding-heart"></i> Explore Our Services</a>
                                    <a href="{{ route('donate') }}" class="btn btn-teal"><i class="fa-solid fa-heart"></i> Donate Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2: Education for Everyone -->
                <div class="carousel-item hero-slide-item" style="background-image: url('https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=1800&q=80');">
                    <div class="hero-overlay">
                        <div class="container">
                            <div class="hero-content">
                                <span class="hero-tag"><i class="fa-solid fa-graduation-cap"></i> Quality Education</span>
                                <h1 class="hero-title">Building Brighter Futures Through Education</h1>
                                <p class="hero-description">
                                    Empowering children and youth with school kits, scholarships, vocational apprenticeships, and digital literacy to break generational cycles of poverty.
                                </p>
                                <div class="d-flex flex-wrap gap-3">
                                    <a href="{{ route('about') }}" class="btn btn-navy"><i class="fa-solid fa-circle-info"></i> Learn More</a>
                                    <a href="{{ route('donate') }}" class="btn btn-teal"><i class="fa-solid fa-hand-holding-heart"></i> Support Our Mission</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 3: Food and Community Support -->
                <div class="carousel-item hero-slide-item" style="background-image: url('https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=1800&q=80');">
                    <div class="hero-overlay">
                        <div class="container">
                            <div class="hero-content">
                                <span class="hero-tag"><i class="fa-solid fa-bowl-food"></i> Relief & Nutrition</span>
                                <h1 class="hero-title">Sharing Hope, Changing Lives</h1>
                                <p class="hero-description">
                                    Providing emergency food rations, medical relief camps, and livelihoods to families facing economic hardship and climate disasters across the region.
                                </p>
                                <div class="d-flex flex-wrap gap-3">
                                    <a href="{{ route('campaigns.index') }}" class="btn btn-navy"><i class="fa-solid fa-bullhorn"></i> View Campaigns</a>
                                    <a href="{{ route('volunteer.register') }}" class="btn btn-teal"><i class="fa-solid fa-users"></i> Get Involved</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="Previous">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="Next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </section>

    <!-- B. WELCOME / ABOUT SECTION -->
    <section class="py-5 bg-white">
        <div class="container py-lg-4">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6">
                    <div class="position-relative pe-lg-3">
                        <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=800&q=80" alt="SDC Community Volunteers" class="img-fluid rounded-4 shadow-lg w-100" style="max-height: 480px; object-fit: cover;">
                        <div class="position-absolute bottom-0 start-0 m-3 p-3 bg-white rounded-3 shadow-lg d-none d-sm-flex align-items-center gap-3 border border-light" style="max-width: 280px;">
                            <div class="rounded-circle p-3 text-accent fs-4 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px; background-color: #EBF3FC; color: #245A91;">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <div>
                                <div class="fw-bold fs-5 text-navy">20+ Years</div>
                                <div class="small text-muted">Of Dedicated Humanitarian Community Service</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <span class="section-badge">Welcome to SDC Charity</span>
                    <h2 class="section-title">Dedicated to Building Resilient and Dignified Communities</h2>
                    <p class="text-muted fs-6 mb-4">
                        The Social Development Council (SDC) Maligaikadu Sri Lanka is an internationally engaged non-profit organization established to foster sustainable community advancement. We bridge compassionate donors with verified grassroots beneficiaries to create enduring social impact.
                    </p>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light border border-light">
                                <i class="fa-solid fa-bullseye text-accent fs-3 mt-1" style="color: #245A91;"></i>
                                <div>
                                    <h6 class="fw-bold mb-1 text-navy">Our Mission</h6>
                                    <p class="small text-muted mb-0">Delivering sustainable relief, education, and healthcare to empower marginalized communities.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light border border-light">
                                <i class="fa-solid fa-eye text-accent fs-3 mt-1" style="color: #245A91;"></i>
                                <div>
                                    <h6 class="fw-bold mb-1 text-navy">Our Vision</h6>
                                    <p class="small text-muted mb-0">A just, self-reliant society where every family has access to dignity, clean water, and opportunity.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('about') }}" class="btn btn-teal">
                        <i class="fa-solid fa-arrow-right"></i> Discover Our Story
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- C. OUR IMPACT STATISTICS -->
    <section class="stats-section">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.25); color: #93C5FD;">Verified Track Record</span>
                <h2 class="text-white fw-bold mb-2">Our Cumulative Impact</h2>
                <p class="text-white-50 mx-auto" style="max-width: 600px;">Every contribution directly translates into measurable change for families on the ground.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-circle-check"></i></div>
                        <div class="stat-number">{{ $stats['projects_completed'] }}+</div>
                        <div class="stat-label">Projects Completed</div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-users-line"></i></div>
                        <div class="stat-number">{{ $stats['people_supported'] }}</div>
                        <div class="stat-label">People Supported</div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                        <div class="stat-number">{{ $stats['active_volunteers'] }}+</div>
                        <div class="stat-label">Active Volunteers</div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fa-solid fa-map-location-dot"></i></div>
                        <div class="stat-number">{{ $stats['communities_reached'] }}</div>
                        <div class="stat-label">Communities Reached</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- H. NEWS AND EVENTS PREVIEW -->
    <section class="py-5 bg-light">
        <div class="container py-lg-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5">
                <div>
                    <span class="section-badge">Updates & Happenings</span>
                    <h2 class="section-title mb-1">Latest News & Events</h2>
                    <p class="section-subtitle ms-0">Follow our frontline activities, program launches, and upcoming outreach camps.</p>
                </div>
                <div class="mt-3 mt-md-0">
                    <a href="{{ route('news.index') }}" class="btn btn-outline-navy">
                        View All News & Events <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <div class="row g-4">
                @forelse($latestNews as $article)
                    <div class="col-lg-4 col-md-6">
                        <div class="charity-card">
                            <div class="card-img-wrap">
                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy">
                                <span class="card-category-badge">{{ ucfirst($article->type) }}</span>
                                <span class="card-status-badge bg-dark text-white">
                                    <i class="fa-regular fa-calendar me-1"></i> {{ $article->published_at ? $article->published_at->format('M d, Y') : date('M d, Y') }}
                                </span>
                            </div>
                            <div class="charity-card-body">
                                <h3 class="charity-card-title fs-5">{{ $article->title }}</h3>
                                <p class="charity-card-desc">{{ Str::limit($article->summary ?? $article->content, 110) }}</p>
                                <div class="mt-auto">
                                    <a href="{{ route('news.show', $article->slug) }}" class="text-teal fw-semibold">
                                        Read More <i class="fa-solid fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p class="text-muted">No news articles published yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- G. VOLUNTEER / GET INVOLVED SECTION -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="cta-volunteer-banner text-center">
                <span class="badge bg-white text-navy mb-3 px-3 py-2 fw-bold text-uppercase">Join Our Global Volunteer Network</span>
                <h2 class="display-6 fw-bold text-white mb-3">Be the Reason Someone Smiles Today</h2>
                <p class="text-white-50 mx-auto fs-5 mb-4" style="max-width: 680px;">
                    Whether you are an educator, healthcare professional, tech volunteer, or community organizer, your dedication can transform lives. Join hundreds of passionate individuals serving on the frontlines.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('volunteer.register') }}" class="btn btn-teal px-4 py-3 fs-6">
                        <i class="fa-solid fa-hands-helping"></i> Become a Volunteer
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-light px-4 py-3 fs-6">
                        <i class="fa-solid fa-headset"></i> Talk to Our Team
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- D. FEATURED PROJECTS -->
    <section class="py-5 bg-light">
        <div class="container py-lg-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5">
                <div>
                    <span class="section-badge">Humanitarian Endeavors</span>
                    <h2 class="section-title mb-1">Featured Community Projects</h2>
                    <p class="section-subtitle ms-0">Targeted programs delivering sustainable long-term transformation.</p>
                </div>
                <div class="mt-3 mt-md-0">
                    <a href="{{ route('projects.index') }}" class="btn btn-outline-navy">
                        View All Projects <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <div class="row g-4">
                @forelse($featuredProjects as $project)
                    <div class="col-lg-4 col-md-6">
                        <div class="charity-card">
                            <div class="card-img-wrap">
                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" loading="lazy">
                                <span class="card-category-badge">{{ $project->category->name ?? 'Community' }}</span>
                                <span class="card-status-badge status-{{ strtolower($project->status) }}">{{ $project->status }}</span>
                            </div>
                            <div class="charity-card-body">
                                <div class="text-muted small mb-2"><i class="fa-solid fa-location-dot me-1 text-teal"></i> {{ $project->location ?? 'Global Field' }}</div>
                                <h3 class="charity-card-title">{{ $project->title }}</h3>
                                <p class="charity-card-desc">{{ Str::limit($project->short_description ?? $project->description, 110) }}</p>
                                
                                <div class="mt-auto">
                                    <div class="progress-meta">
                                        <span>Target: Rs. {{ number_format($project->target_amount, 0) }}</span>
                                        <span class="text-teal fw-bold">{{ $project->progress_percent }}%</span>
                                    </div>
                                    <div class="progress-custom">
                                        <div class="progress-custom-bar" style="width: {{ $project->progress_percent }}%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small text-muted">Raised: <strong>Rs. {{ number_format($project->amount_raised, 0) }}</strong></span>
                                        <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-sm btn-outline-navy">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p class="text-muted">No projects currently listed. Please check back soon.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- E. ACTIVE CAMPAIGNS -->
    <section class="py-5 bg-white">
        <div class="container py-lg-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5">
                <div>
                    <span class="section-badge">Urgent Appeals</span>
                    <h2 class="section-title mb-1">Active Fundraising Campaigns</h2>
                    <p class="section-subtitle ms-0">Directly fund critical emergency relief and community support operations.</p>
                </div>
                <div class="mt-3 mt-md-0">
                    <a href="{{ route('campaigns.index') }}" class="btn btn-outline-teal">
                        View All Campaigns <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <div class="row g-4">
                @forelse($activeCampaigns as $campaign)
                    <div class="col-lg-6">
                        <div class="charity-card flex-md-row">
                            <div class="card-img-wrap w-md-50" style="height: auto; min-height: 220px;">
                                <img src="{{ $campaign->image_url }}" alt="{{ $campaign->title }}" loading="lazy">
                                <span class="card-category-badge">{{ $campaign->category->name ?? 'Urgent' }}</span>
                            </div>
                            <div class="charity-card-body w-md-50">
                                <h3 class="charity-card-title">{{ $campaign->title }}</h3>
                                <p class="charity-card-desc">{{ Str::limit($campaign->description, 120) }}</p>

                                <div class="mt-auto">
                                    <div class="progress-meta">
                                        <span>Target: Rs. {{ number_format($campaign->target_amount, 0) }}</span>
                                        <span class="text-teal fw-bold">{{ $campaign->progress_percent }}%</span>
                                    </div>
                                    <div class="progress-custom">
                                        <div class="progress-custom-bar" style="width: {{ $campaign->progress_percent }}%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <span class="d-block small text-muted">Raised so far:</span>
                                            <strong class="text-navy fs-5">Rs. {{ number_format($campaign->amount_raised, 2) }}</strong>
                                        </div>
                                        <span class="badge bg-light text-dark border p-2"><i class="fa-solid fa-user-group me-1 text-teal"></i> {{ $campaign->donor_count ?? 0 }} Donors</span>
                                    </div>
                                    <a href="{{ route('donate', ['campaign_id' => $campaign->id]) }}" class="btn btn-teal w-100 justify-content-center">
                                        <i class="fa-solid fa-heart"></i> Donate to Campaign
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p class="text-muted">No active fundraising campaigns at this time.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- F. OUR MISSION AND VISION -->
    <section class="py-5 bg-light">
        <div class="container py-lg-4">
            <div class="text-center mb-5">
                <span class="section-badge">Core Pillars</span>
                <h2 class="section-title">Guiding Humanitarian Values</h2>
                <p class="section-subtitle">The foundational principles that guide every relief operation, program design, and beneficiary partnership.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="mission-vision-box">
                        <div class="mission-icon">
                            <i class="fa-solid fa-hand-holding-heart"></i>
                        </div>
                        <h3 class="fs-4 fw-bold mb-3 text-navy">Our Mission</h3>
                        <p class="text-muted mb-4" style="line-height: 1.7;">
                            To mobilize resources, volunteers, and strategic partnerships to deliver high-impact programs in basic health, clean water, quality education, and rapid disaster relief. We ensure every child and family receives dignified, non-discriminatory care regardless of background.
                        </p>
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                            <li class="d-flex align-items-center gap-2"><i class="fa-solid fa-circle-check text-teal"></i> <span>Uncompromising transparency in financial resource allocation</span></li>
                            <li class="d-flex align-items-center gap-2"><i class="fa-solid fa-circle-check text-teal"></i> <span>Locally driven solutions customized to regional realities</span></li>
                            <li class="d-flex align-items-center gap-2"><i class="fa-solid fa-circle-check text-teal"></i> <span>Long-term sustainability over temporary stopgap measures</span></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mission-vision-box">
                        <div class="mission-icon" style="background-color: #FEF3C7; color: #D97706;">
                            <i class="fa-solid fa-mountain-sun"></i>
                        </div>
                        <h3 class="fs-4 fw-bold mb-3 text-navy">Our Vision</h3>
                        <p class="text-muted mb-4" style="line-height: 1.7;">
                            A resilient world where marginalized families emerge from vulnerability into self-sustained prosperity. We envision empowered communities equipped with education, healthy environments, sustainable livelihoods, and the capability to lead their own development.
                        </p>
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                            <li class="d-flex align-items-center gap-2"><i class="fa-solid fa-circle-check text-warning"></i> <span>Universal access to clean potable drinking water</span></li>
                            <li class="d-flex align-items-center gap-2"><i class="fa-solid fa-circle-check text-warning"></i> <span>Equal educational opportunities for every rural child</span></li>
                            <li class="d-flex align-items-center gap-2"><i class="fa-solid fa-circle-check text-warning"></i> <span>Climate-resilient community infrastructure and rapid relief</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- I. DONATION CALL-TO-ACTION BANNER -->
    <section class="cta-donation-banner text-center">
        <div class="container">
            <span class="badge mb-3 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.3); color: #DCEAF8;">Support Humanity</span>
            <h2 class="display-5 fw-bold text-white mb-3">Every Contribution Makes a Difference</h2>
            <p class="text-white-50 mx-auto fs-5 mb-4" style="max-width: 650px;">
                Your tax-deductible contribution provides clean drinking water, emergency food supplies, and essential medical aid to families facing desperate circumstances.
            </p>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="{{ route('donate') }}" class="btn btn-donate-highlight px-5 py-3 fs-5">
                    <i class="fa-solid fa-heart"></i> Donate Now
                </a>
                <a href="{{ route('campaigns.index') }}" class="btn btn-outline-light px-4 py-3 fs-6">
                    <i class="fa-solid fa-list-check"></i> Explore Campaigns
                </a>
            </div>
        </div>
    </section>

   

    <!-- K. EXECUTIVE LEADERSHIP & HUMANITARIAN PARTNERS -->
    <section class="py-5 bg-light border-top" id="executive-leadership">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-badge">Humanitarian Leadership</span>
                <h3 class="fw-bold text-navy mb-2">Our Trusted Humanitarian Leadership</h3>
                <p class="text-muted small mx-auto mb-0" style="max-width: 650px;">
                    Meet the visionary executive office bearers steering the Social Development Council with dedication, transparency, and grassroots community service.
                </p>
            </div>

            <!-- 3 Key Office Bearers Cards -->
            <div class="row g-4 justify-content-center mb-4">
                <!-- 1. AM. JAAHEER - Chairman -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden team-profile-card bg-white text-center p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="position-relative mx-auto mb-3" style="width: 140px; height: 140px;">
                                <img src="{{ asset('images/team/am-jaaheer.jpg') }}" alt="AM. JAAHEER" class="rounded-circle w-100 h-100 shadow" style="object-fit: cover; border: 4px solid #1E4A7A;" onerror="this.src='https://ui-avatars.com/api/?name=AM+JAAHEER&background=1E4A7A&color=fff&size=200'">
                                <span class="position-absolute bottom-0 end-0 badge bg-primary rounded-circle p-2 shadow" title="Chairman" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-crown text-white small"></i>
                                </span>
                            </div>
                            <span class="badge bg-primary text-white px-3 py-1 rounded-pill small fw-bold mb-2">
                                Chairman
                            </span>
                            <h4 class="fw-bold text-navy mb-1" style="font-size: 1.25rem;">AM. JAAHEER</h4>
                            <div class="text-primary fw-semibold small mb-3">
                                <i class="fa-solid fa-user-tie me-1"></i> Chairman of SDC
                            </div>
                            <p class="text-muted small mb-3" style="line-height: 1.6;">
                                Guiding SDC's humanitarian mission, strategic community partnerships, and grassroots empowerment across Sri Lanka.
                            </p>
                        </div>
                        <div class="pt-3 border-top d-flex align-items-center justify-content-between">
                            <span class="text-muted small" style="font-size: 0.75rem;">
                                <i class="fa-solid fa-building-columns text-accent me-1"></i> Executive Board
                            </span>
                            <a href="{{ route('teams.index') }}#board-of-directors" class="btn btn-sm btn-outline-navy rounded-pill px-3 py-1" style="font-size: 0.78rem;">
                                <span>Profile Details</span> <i class="fa-solid fa-arrow-right fs-xs ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 2. S. FASLOON - Secretary General -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden team-profile-card bg-white text-center p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="position-relative mx-auto mb-3" style="width: 140px; height: 140px;">
                                <img src="{{ asset('images/team/s-fasloon.jpg') }}" alt="S. FASLOON" class="rounded-circle w-100 h-100 shadow" style="object-fit: cover; border: 4px solid #2563EB;" onerror="this.src='https://ui-avatars.com/api/?name=S+FASLOON&background=2563EB&color=fff&size=200'">
                                <span class="position-absolute bottom-0 end-0 badge bg-primary rounded-circle p-2 shadow" title="Secretary General" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-file-signature text-white small"></i>
                                </span>
                            </div>
                            <span class="badge bg-primary text-white px-3 py-1 rounded-pill small fw-bold mb-2">
                                Secretary General
                            </span>
                            <h4 class="fw-bold text-navy mb-1" style="font-size: 1.25rem;">S. FASLOON</h4>
                            <div class="text-primary fw-semibold small mb-3">
                                <i class="fa-solid fa-briefcase me-1"></i> Secretary General of SDC
                            </div>
                            <p class="text-muted small mb-3" style="line-height: 1.6;">
                                Managing executive operations, official governance, statutory compliance, and humanitarian project execution.
                            </p>
                        </div>
                        <div class="pt-3 border-top d-flex align-items-center justify-content-between">
                            <span class="text-muted small" style="font-size: 0.75rem;">
                                <i class="fa-solid fa-shield-halved text-accent me-1"></i> Executive Board
                            </span>
                            <a href="{{ route('teams.index') }}#board-of-directors" class="btn btn-sm btn-outline-navy rounded-pill px-3 py-1" style="font-size: 0.78rem;">
                                <span>Profile Details</span> <i class="fa-solid fa-arrow-right fs-xs ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 3. AM. MUHAGIRIN - Treasurer -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden team-profile-card bg-white text-center p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="position-relative mx-auto mb-3" style="width: 140px; height: 140px;">
                                <img src="{{ asset('images/team/am-muhagirin.jpg') }}" alt="AM. MUHAGIRIN" class="rounded-circle w-100 h-100 shadow" style="object-fit: cover; border: 4px solid #1E4A7A;" onerror="this.src='https://ui-avatars.com/api/?name=AM+MUHAGIRIN&background=1E4A7A&color=fff&size=200'">
                                <span class="position-absolute bottom-0 end-0 badge bg-primary rounded-circle p-2 shadow" title="Treasurer" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-coins text-white small"></i>
                                </span>
                            </div>
                            <span class="badge bg-primary text-white px-3 py-1 rounded-pill small fw-bold mb-2">
                                Treasurer
                            </span>
                            <h4 class="fw-bold text-navy mb-1" style="font-size: 1.25rem;">AM. MUHAGIRIN</h4>
                            <div class="text-primary fw-semibold small mb-3">
                                <i class="fa-solid fa-sack-dollar me-1"></i> Treasurer of SDC
                            </div>
                            <p class="text-muted small mb-3" style="line-height: 1.6;">
                                Overseeing financial transparency, donor fund management, auditing integrity, and humanitarian project budgets.
                            </p>
                        </div>
                        <div class="pt-3 border-top d-flex align-items-center justify-content-between">
                            <span class="text-muted small" style="font-size: 0.75rem;">
                                <i class="fa-solid fa-scale-balanced text-accent me-1"></i> Executive Board
                            </span>
                            <a href="{{ route('teams.index') }}#board-of-directors" class="btn btn-sm btn-outline-navy rounded-pill px-3 py-1" style="font-size: 0.78rem;">
                                <span>Profile Details</span> <i class="fa-solid fa-arrow-right fs-xs ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>
    </section>

@endsection
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
