@extends('layouts.app')

@section('title', $service->title . ' | Social Development Council (SDC) Sri Lanka')
@section('meta_description', $service->summary)

@push('styles')
<style>
    /* Service Showcase Styling */
    .service-hero-header {
        background: linear-gradient(135deg, #071739 0%, #0B2568 50%, #0059FF 100%);
        color: #FFFFFF;
        padding: 55px 0 75px 0;
        position: relative;
        overflow: hidden;
    }

    .service-hero-header::after {
        content: '';
        position: absolute;
        top: -30%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .fast-nav-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 25px;
    }

    .fast-nav-pill {
        background: rgba(255, 255, 255, 0.12);
        color: #FFFFFF;
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 30px;
        padding: 8px 18px;
        font-size: 13.5px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .fast-nav-pill:hover,
    .fast-nav-pill.active {
        background: #FFFFFF;
        color: #0B2568;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    }

    /* Provide Servicing Opportunity Cards (Matching Image 1) */
    .servicing-feature-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.05);
    }

    .servicing-feature-card:hover {
        transform: translateY(-6px);
        border-color: #0059FF;
        box-shadow: 0 16px 32px rgba(0, 89, 255, 0.12);
    }

    .servicing-card-img-wrap {
        position: relative;
        height: 220px;
        overflow: hidden;
        background-color: #0F172A;
    }

    .servicing-card-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .servicing-feature-card:hover .servicing-card-img-wrap img {
        transform: scale(1.05);
    }

    .servicing-card-badge-left {
        position: absolute;
        top: 14px;
        left: 14px;
        background: rgba(15, 43, 72, 0.9);
        backdrop-filter: blur(4px);
        color: #FFFFFF;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 5px 12px;
        border-radius: 20px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    .servicing-card-badge-date {
        position: absolute;
        top: 14px;
        right: 14px;
        background: rgba(15, 23, 42, 0.85);
        backdrop-filter: blur(4px);
        color: #FFFFFF;
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 0.03em;
        padding: 5px 12px;
        border-radius: 20px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .servicing-card-body {
        padding: 24px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        background: #FFFFFF;
    }

    .servicing-card-title {
        color: #0B2568;
        font-size: 1.15rem;
        font-weight: 700;
        line-height: 1.35;
        margin-bottom: 12px;
    }

    .servicing-card-desc {
        color: #64748B;
        font-size: 0.88rem;
        line-height: 1.6;
        margin-bottom: 18px;
        flex-grow: 1;
    }

    .role-badge-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 18px;
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        height: 100%;
    }

    .role-badge-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(0, 89, 255, 0.14);
        border-color: #0059FF;
    }

    .request-aid-card {
        background: linear-gradient(135deg, #FFFFFF 0%, #EFF6FF 100%);
        border: 1px solid #BFDBFE;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 8px 24px rgba(0, 89, 255, 0.05);
    }
</style>
@endpush

@section('content')
@php
    $gallery = is_array($gallery) ? $gallery : (is_array($service->gallery) ? $service->gallery : []);
    $roles = is_array($roles) ? $roles : (is_array($service->servicing_roles) ? $service->servicing_roles : []);
@endphp

    <!-- Professional Hero Header Banner -->
    <section class="service-hero-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9">
                    <!-- Category & Status Badge -->
                    <div class="d-flex align-items-center gap-2 flex-wrap mb-3">
                        <span class="badge px-3 py-2 rounded-pill fw-bold shadow-sm" style="background-color: {{ $service->accent_color ?? '#0059FF' }}; color: #FFFFFF; font-size: 0.8rem;">
                            <i class="{{ $service->icon ?? 'fa-solid fa-hand-holding-heart' }} me-1"></i> {{ $service->category }}
                        </span>
                        <span class="badge bg-white text-navy px-3 py-2 rounded-pill fw-bold small shadow-sm">
                            <i class="fa-solid fa-chart-line text-accent me-1"></i> {{ $service->impact ?? 'Grassroots Relief Program' }}
                        </span>
                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold small">
                            <i class="fa-solid fa-circle-check me-1"></i> Active {{ $service->type === 'course' ? 'Vocational Course' : 'Community Service' }}
                        </span>
                    </div>

                    <!-- Service Main Title -->
                    <h1 class="display-4 fw-bold text-white mb-3" style="letter-spacing: -0.02em;">
                        {{ $service->title }}
                    </h1>

                    <!-- Summary -->
                    <p class="lead text-white-50 mb-3" style="max-width: 820px; font-size: 1.15rem; line-height: 1.6;">
                        {{ $service->summary }}
                    </p>

                    <!-- Breadcrumbs -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                            @if($service->type === 'course')
                                <li class="breadcrumb-item"><a href="{{ route('courses.index') }}" class="text-white-50 text-decoration-none">Courses</a></li>
                            @else
                                <li class="breadcrumb-item"><a href="{{ route('services.index') }}" class="text-white-50 text-decoration-none">Services</a></li>
                            @endif
                            <li class="breadcrumb-item active text-white fw-bold" aria-current="page">{{ $service->short_title ?? $service->title }}</li>
                        </ol>
                    </nav>

                    <!-- Fast Action Navigation Buttons -->
                    <div class="fast-nav-pills">
                        <a href="#provide-servicing" class="fast-nav-pill active bg-primary text-white border-primary" style="background-color: #0059FF !important; border-color: #0059FF !important;">
                            <i class="fa-solid fa-handshake-angle"></i>
                            <span>Provided Servicing Opportunities</span>
                        </a>
                        <button type="button" class="fast-nav-pill" data-bs-toggle="modal" data-bs-target="#provideServicingModal">
                            <i class="fa-solid fa-user-plus text-warning"></i>
                            <span>Register as Service Partner</span>
                        </button>
                        <a href="#request-assistance" class="fast-nav-pill">
                            <i class="fa-solid fa-paper-plane text-info"></i>
                            <span>Request Assistance</span>
                        </a>
                        <a href="{{ route('donate') }}" class="fast-nav-pill bg-warning text-dark border-warning">
                            <i class="fa-solid fa-heart text-danger"></i>
                            <span>Support & Donate</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Servicing Showcase Area -->
    <section class="py-5" style="background-color: #F8FAFC;">
        <div class="container py-lg-3">

            <!-- 1. Dedicated "Provided Servicing" Header Banner -->
            <div class="p-4 p-lg-5 rounded-4 mb-5 shadow-xs border bg-white" id="provide-servicing" style="border-color: #E2E8F0 !important;">
                <div class="d-flex align-items-start justify-content-between flex-wrap gap-4">
                    <div style="max-width: 760px;">
                        <span class="badge bg-primary-subtle text-primary px-3 py-1 rounded-pill fw-bold text-uppercase mb-2" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                            <i class="fa-solid fa-handshake-angle me-1"></i> Professional Partnership & Field Servicing
                        </span>
                        <h2 class="h2 fw-bold text-navy mb-2">{{ $service->provide_title ?: 'Provided Servicing & Expert Instruction For ' . $service->title }}</h2>
                        <p class="text-secondary lead mb-0" style="font-size: 1.05rem; line-height: 1.6;">
                            {{ $service->provide_details ?: 'Are you a qualified professional, technician, contractor, or volunteer organization? Partner with SDC to deliver hands-on servicing, technical equipment, or mentoring for this program.' }}
                        </p>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <button type="button" class="btn btn-primary rounded-pill px-4 py-3 fw-bold d-inline-flex align-items-center gap-2 shadow-sm"
                            data-bs-toggle="modal" data-bs-target="#provideServicingModal" style="background-color: #0059FF; border-color: #0059FF;">
                            <i class="fa-solid fa-handshake-angle"></i>
                            <span>Provided Servicing</span>
                            <i class="fa-solid fa-arrow-right small ms-1"></i>
                        </button>
                        <a href="tel:+94672229180" class="btn btn-outline-dark rounded-pill px-4 py-3 fw-bold d-inline-flex align-items-center gap-2">
                            <i class="fa-solid fa-phone text-primary"></i>
                            <span>Call Desk</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 2. Dynamic Servicing Project Cards (Image 1 Style) -->
            @if(isset($servicingCards) && count($servicingCards) > 0)
                <div class="mb-5">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                        <div>
                            <h3 class="h4 fw-bold text-navy mb-1">
                                <i class="fa-solid fa-layer-group text-primary me-2"></i>Active Servicing Projects & Opportunities
                            </h3>
                            <small class="text-muted">Select an ongoing field project below to contribute specialized servicing, equipment, or labor</small>
                        </div>
                        <span class="badge bg-white text-primary border border-primary-subtle fw-bold px-3 py-2 rounded-pill shadow-xs">
                            {{ count($servicingCards) }} Active Opportunities
                        </span>
                    </div>

                    <div class="row g-4">
                        @foreach($servicingCards as $card)
                            <div class="col-md-6 col-lg-4">
                                <div class="servicing-feature-card">
                                    <div class="servicing-card-img-wrap">
                                        <img src="{{ asset($card['image'] ?? 'images/services/education.jpg') }}" alt="{{ $card['title'] }}" onerror="this.src='{{ asset($service->image) }}'">
                                        <span class="servicing-card-badge-left">{{ $card['tag'] ?? 'SERVICING' }}</span>
                                        <span class="servicing-card-badge-date">
                                            <i class="fa-regular fa-calendar"></i>
                                            {{ !empty($card['date']) ? \Carbon\Carbon::parse($card['date'])->format('M d, Y') : date('M d, Y') }}
                                        </span>
                                    </div>
                                    <div class="servicing-card-body">
                                        <h4 class="servicing-card-title">{{ $card['title'] }}</h4>
                                        <p class="servicing-card-desc">{{ $card['desc'] }}</p>
                                        <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                                            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1 fw-bold btn-card-servicing-trigger"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#provideServicingModal"
                                                data-service-title="{{ $card['title'] }}"
                                                data-service-desc="{{ $card['desc'] }}">
                                                <span>Provided Servicing</span>
                                                <i class="fa-solid fa-arrow-right ms-1 small"></i>
                                            </button>
                                            <span class="text-muted small" style="font-size: 0.74rem;">
                                                <i class="fa-solid fa-shield-halved text-primary me-1"></i> SDC Verified
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- 3. Specialist Roles Section -->
            @if(count($roles) > 0)
                <div class="p-4 p-lg-5 rounded-4 mb-5 bg-white border shadow-xs" style="border-color: #E2E8F0 !important;">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                        <div>
                            <h4 class="h5 fw-bold text-navy mb-1">
                                <i class="fa-solid fa-users-gear text-primary me-2"></i>Specialist Roles Needed for {{ $service->short_title ?? $service->title }}
                            </h4>
                            <small class="text-muted">Skilled technicians, mentors, and equipment partners required on the ground</small>
                        </div>
                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-bold small">
                            {{ count($roles) }} Profile Specializations
                        </span>
                    </div>

                    <div class="row g-3">
                        @foreach($roles as $roleItem)
                            <div class="col-sm-6 col-lg-3">
                                <div class="role-badge-card">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 34px; height: 34px;">
                                            <i class="fa-solid fa-user-check" style="font-size: 13px;"></i>
                                        </div>
                                        <h6 class="fw-bold text-navy mb-0 small">{{ $roleItem['role'] }}</h6>
                                    </div>
                                    <p class="text-muted small mb-0" style="line-height: 1.5; font-size: 0.82rem;">
                                        {{ $roleItem['desc'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- 4. Assistance Request Banner (For Beneficiaries) -->
            <div class="request-aid-card" id="request-assistance">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-4">
                    <div style="max-width: 720px;">
                        <span class="badge bg-primary text-white px-3 py-1 rounded-pill fw-bold text-uppercase mb-2" style="font-size: 0.72rem; letter-spacing: 0.05em;">
                            <i class="fa-solid fa-hands-holding-child me-1"></i> Humanitarian Beneficiary Assistance
                        </span>
                        <h3 class="h4 fw-bold text-navy mb-2">Are You or a Family in Need of {{ $service->short_title ?? $service->title }}?</h3>
                        <p class="text-secondary mb-0" style="font-size: 0.95rem; line-height: 1.6;">
                            {{ $service->request_details ?: 'SDC supports deserving families living below the poverty line. Submit an assistance request and our field verification team will review your application.' }}
                        </p>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <button type="button" class="btn btn-primary rounded-pill px-4 py-3 fw-bold d-inline-flex align-items-center gap-2 shadow-sm"
                            data-bs-toggle="modal" data-bs-target="#requestAssistanceModal">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>Submit Assistance Request</span>
                        </button>
                        <a href="{{ route('services.index') }}" class="btn btn-outline-primary rounded-pill px-4 py-3 fw-bold">
                            <span>View All Services</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- MODAL: Provided Servicing Registration Modal -->
    <div class="modal fade" id="provideServicingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
                <div class="modal-header text-white px-4 py-3" style="background: linear-gradient(135deg, #0B2568 0%, #0059FF 100%);">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-handshake-angle fs-4"></i>
                        <div>
                            <h5 class="modal-title fw-bold text-white mb-0">Register for Provided Servicing</h5>
                            <small class="text-white-50">Program: {{ $service->title }}</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('volunteer.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="area_of_interest" value="Provided Servicing: {{ $service->title }}">

                    <div class="modal-body p-4 bg-white" style="max-height: 72vh; overflow-y: auto;">
                        <div class="alert alert-primary-subtle border-primary-subtle rounded-3 p-3 mb-3 small text-navy d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div>
                                <i class="fa-solid fa-circle-check text-primary me-1"></i>
                                <strong>Join as a Service Partner / Volunteer!</strong> Provide technical services, equipment, or skilled labor for <strong>{{ $service->title }}</strong>.
                            </div>
                            <a href="{{ route('volunteer.register', ['interest' => 'Provided Servicing: ' . $service->title]) }}" class="btn btn-sm btn-outline-primary rounded-pill fw-semibold text-nowrap">
                                <i class="fa-solid fa-expand me-1"></i> Full Form Page
                            </a>
                        </div>

                        <div class="row g-3">
                            <!-- Full Name -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="full_name" class="form-control rounded-3" value="{{ auth()->user()?->name ?? '' }}" placeholder="e.g. Mohamed Farhan" required>
                            </div>

                            <!-- NIC No -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">NIC No <span class="text-danger">*</span></label>
                                <input type="text" name="nic_no" class="form-control rounded-3" placeholder="e.g. 199812345678 or 981234567V" required>
                            </div>

                            <!-- Date of Birth -->
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-navy">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" name="date_of_birth" id="modal_dob" class="form-control rounded-3" max="{{ date('Y-m-d') }}" required>
                            </div>

                            <!-- Age -->
                            <div class="col-md-2">
                                <label class="form-label small fw-bold text-navy">Age <span class="text-danger">*</span></label>
                                <input type="number" name="age" id="modal_age" class="form-control rounded-3" min="14" max="100" placeholder="Yrs" required>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Phone / WhatsApp <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control rounded-3" value="{{ auth()->user()?->phone ?? '' }}" placeholder="+94 77 123 4567" required>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Email Address</label>
                                <input type="email" name="email" class="form-control rounded-3" value="{{ auth()->user()?->email ?? '' }}" placeholder="name@example.com">
                            </div>

                            <!-- Address -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Residential Address <span class="text-danger">*</span></label>
                                <input type="text" name="address" class="form-control rounded-3" placeholder="Street / Village, Town, District" required>
                            </div>

                            <!-- Education Qualification -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Education Qualification <span class="text-danger">*</span></label>
                                <select name="education_qualification" class="form-select rounded-3" required>
                                    <option value="" disabled selected>Select qualification</option>
                                    <option value="G.C.E. O/L Completed">G.C.E. O/L Completed</option>
                                    <option value="G.C.E. A/L Completed">G.C.E. A/L Completed</option>
                                    <option value="Vocational / NVQ Certificate">Vocational / NVQ Certificate</option>
                                    <option value="Higher National Diploma (HND)">Higher National Diploma (HND)</option>
                                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                                    <option value="Postgraduate / Master's">Postgraduate / Master's</option>
                                    <option value="Other Professional Qualification">Other Professional Qualification</option>
                                </select>
                            </div>

                            <!-- Occupation -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Current Occupation / Trade <span class="text-danger">*</span></label>
                                <input type="text" name="occupation" class="form-control rounded-3" placeholder="e.g. Electrician, Civil Engineer, Teacher, Tailor" required>
                            </div>

                            <!-- Skills & Tools Offered -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Specialized Skills / Tools</label>
                                <input type="text" name="skills" class="form-control rounded-3" placeholder="e.g. Home wiring, masonry, teaching math, sewing machine repair">
                            </div>

                            <!-- Availability -->
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Availability</label>
                                <select name="availability" class="form-select rounded-3">
                                    <option value="Weekends Only">Weekends Only</option>
                                    <option value="Weekdays">Weekdays</option>
                                    <option value="Flexible / On-Call">Flexible / On-Call</option>
                                    <option value="Full-Time Partnership">Full-Time Partnership</option>
                                </select>
                            </div>

                            <!-- Servicing Details -->
                            <div class="col-12">
                                <label class="form-label small fw-bold text-navy">Servicing Details & Contribution Offered</label>
                                <textarea name="introduction" class="form-control rounded-3" rows="2" placeholder="Describe the specific servicing you can provide for {{ $service->short_title ?? $service->title }} (e.g. free labor, equipment donation, mentoring, materials)..."></textarea>
                            </div>

                            <!-- Photo Upload -->
                            <div class="col-12">
                                <label class="form-label small fw-bold text-navy">Your Photo (Optional)</label>
                                <input type="file" name="photo_file" class="form-control rounded-3" accept="image/*">
                                <small class="text-muted" style="font-size: 0.72rem;">JPG, PNG, WEBP up to 5MB.</small>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-top bg-light px-4 py-3 justify-content-between">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold" style="background-color: #0059FF; border-color: #0059FF;">
                            <i class="fa-solid fa-paper-plane me-1"></i> Submit Provided Servicing Registration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL 3: Request Assistance Modal -->
    <div class="modal fade" id="requestAssistanceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
                <div class="modal-header bg-primary text-white px-4 py-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-hand-holding-heart fs-4"></i>
                        <div>
                            <h5 class="modal-title fw-bold text-white mb-0">Request Assistance</h5>
                            <small class="text-white-50">Program: {{ $service->title }}</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('course.request.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <input type="hidden" name="type" value="service">
                    <input type="hidden" name="course_title" value="{{ $service->title }}">

                    <div class="modal-body p-4 bg-white">
                        <div class="alert alert-primary-subtle border-primary-subtle rounded-3 p-3 mb-3 small text-navy">
                            <i class="fa-solid fa-circle-info text-primary me-1"></i>
                            <strong>Confidential Humanitarian Assistance:</strong> SDC verifies all requests with compassionate care. Please provide accurate contact details.
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Applicant Name <span class="text-danger">*</span></label>
                                <input type="text" name="full_name" class="form-control rounded-3" value="{{ auth()->user()?->name ?? '' }}" placeholder="Your full name" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control rounded-3" value="{{ auth()->user()?->phone ?? '' }}" placeholder="+94 77 123 4567" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Email Address</label>
                                <input type="email" name="email" class="form-control rounded-3" value="{{ auth()->user()?->email ?? '' }}" placeholder="name@example.com">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">NIC / ID Number</label>
                                <input type="text" name="nic" class="form-control rounded-3" placeholder="National Identity Card #">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">District</label>
                                <input type="text" name="district" class="form-control rounded-3" placeholder="e.g. Ampara, Batticaloa, Trincomalee">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Village / City</label>
                                <input type="text" name="city" class="form-control rounded-3" placeholder="e.g. Maligaikadu, Kalmunai, Sammanthurai">
                            </div>

                            <div class="col-12">
                                <label class="form-label small fw-bold text-navy">Describe Your Requirement / Emergency</label>
                                <textarea name="message" class="form-control rounded-3" rows="3" placeholder="Briefly describe what assistance your household needs under this program..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-top bg-light px-4 py-3 justify-content-between">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">
                            <i class="fa-solid fa-paper-plane me-1"></i> Submit Assistance Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Auto-fill Provide Servicing Modal from Card Click
        document.querySelectorAll('.btn-card-servicing-trigger').forEach(btn => {
            btn.addEventListener('click', function () {
                const cardTitle = this.getAttribute('data-service-title') || '';
                const cardDesc = this.getAttribute('data-service-desc') || '';
                const modalIntro = document.querySelector('#provideServicingModal textarea[name="introduction"]');
                if (modalIntro && cardTitle) {
                    modalIntro.value = 'I would like to provide servicing for: ' + cardTitle + (cardDesc ? ' (' + cardDesc + ')' : '');
                }
            });
        });

        // Auto-calculate Age from DOB in Servicing Modal
        const dobInput = document.getElementById('modal_dob');
        const ageInput = document.getElementById('modal_age');
        if (dobInput && ageInput) {
            dobInput.addEventListener('change', function () {
                const birthDate = new Date(this.value);
                if (isNaN(birthDate.getTime())) return;
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                if (age >= 0 && age <= 120) {
                    ageInput.value = age;
                }
            });
        }
    });
</script>
@endpush
