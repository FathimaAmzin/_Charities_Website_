@extends('layouts.app')

@section('title', 'About Us | Social Development Council (SDC) Sri Lanka')
@section('meta_description', 'Discover the history, mission, leadership, and humanitarian objectives of the Social Development Council Maligaikadu Sri Lanka.')

@section('content')

    <!-- Page Banner with Breadcrumb -->
    <section class="page-header-banner">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.25); color: #93C5FD;">Our Humanitarian Journey</span>
            <h1 class="display-4 fw-bold text-white mb-2">About Our Organization</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Organization Background & History -->
    <section class="py-5 bg-white">
        <div class="container py-lg-4">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6">
                    <span class="section-badge">Roots & Legacy</span>
                    <h2 class="section-title">Two Decades of Compassion, Dignity, and Direct Action</h2>
                    <p class="text-muted fs-6 mb-3">
                        The <strong>Social Development Council (SDC)</strong>, originated in Maligaikadu, Eastern Province, Sri Lanka, was born out of an urgent humanitarian imperative: to organize local collective capacity and deliver essential social welfare to communities devastated by conflict, seasonal cyclones, and entrenched socioeconomic hardship.
                    </p>
                    <p class="text-muted fs-6 mb-4">
                        From a modest community voluntary circle in the early 2000s, SDC has grown into a recognized, transparent non-governmental organization registered under Sri Lankan statutory welfare bodies. Today, SDC partners with international diaspora networks, donor organizations, and local government stakeholders to manage multi-sector programs spanning sustainable clean water, healthcare outreach, orphan care, micro-livelihoods, and emergency disaster relief.
                    </p>
                    <div class="d-flex align-items-center gap-4">
                        <div class="border-start border-4 border-teal ps-3" style="border-color: var(--secondary-teal) !important;">
                            <h4 class="fw-bold mb-0 text-navy">100% Volunteer Spirit</h4>
                            <p class="small text-muted mb-0">Transparent governance and community-led execution.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6">
                            <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=600&q=80" alt="SDC Relief" class="img-fluid rounded-4 shadow-sm w-100" style="height: 240px; object-fit: cover;">
                        </div>
                        <div class="col-6">
                            <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=600&q=80" alt="SDC Education" class="img-fluid rounded-4 shadow-sm w-100" style="height: 240px; object-fit: cover; margin-top: 25px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission, Vision & Core Objectives -->
    <section class="py-5 bg-light">
        <div class="container py-lg-4">
            <div class="text-center mb-5">
                <span class="section-badge">Vision & Purpose</span>
                <h2 class="section-title">Our Strategic Compass</h2>
                <p class="section-subtitle">Dedicated to creating transparent, ethical, and measurable humanitarian impact.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="mission-vision-box bg-white">
                        <div class="mission-icon"><i class="fa-solid fa-bullseye"></i></div>
                        <h4 class="fw-bold text-navy mb-3">Our Mission</h4>
                        <p class="text-muted small">
                            To empower vulnerable families through sustainable education, health facilities, water purification, and emergency assistance without regard to race, creed, or gender.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="mission-vision-box bg-white">
                        <div class="mission-icon" style="background-color: #FEF3C7; color: #D97706;"><i class="fa-solid fa-eye"></i></div>
                        <h4 class="fw-bold text-navy mb-3">Our Vision</h4>
                        <p class="text-muted small">
                            A just, educated, and self-sufficient society where every child flourishes in health and security, and every community has the capacity to build its future.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="mission-vision-box bg-white">
                        <div class="mission-icon" style="background-color: #EFF6FF; color: #2563EB;"><i class="fa-solid fa-scale-balanced"></i></div>
                        <h4 class="fw-bold text-navy mb-3">Core Objectives</h4>
                        <ul class="text-muted small ps-3 mb-0">
                            <li>Promote inclusive educational opportunities for impoverished children.</li>
                            <li>Install clean water wells and RO filtration centers in drought-hit regions.</li>
                            <li>Deliver free medical diagnostics and sponsored surgeries for elders.</li>
                            <li>Equip women and youth with vocational livelihood tools.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="py-5 bg-white">
        <div class="container py-lg-4">
            <div class="text-center mb-5">
                <span class="section-badge">Ethical Standards</span>
                <h2 class="section-title">Values That Guide SDC</h2>
                <p class="section-subtitle">Every rupee and dollar entrusted to us is managed with absolute fidelity.</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-sm-6">
                    <div class="p-4 rounded-3 border bg-light h-100 text-center">
                        <i class="fa-solid fa-shield-halved fs-1 text-teal mb-3"></i>
                        <h5 class="fw-bold text-navy">Integrity & Audit</h5>
                        <p class="small text-muted mb-0">Comprehensive tracking of all donor disbursements with zero compromise on financial transparency.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="p-4 rounded-3 border bg-light h-100 text-center">
                        <i class="fa-solid fa-people-carry-box fs-1 text-teal mb-3"></i>
                        <h5 class="fw-bold text-navy">Human Dignity</h5>
                        <p class="small text-muted mb-0">Respecting the self-worth and privacy of every beneficiary in all communications and distributions.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="p-4 rounded-3 border bg-light h-100 text-center">
                        <i class="fa-solid fa-leaf fs-1 text-teal mb-3"></i>
                        <h5 class="fw-bold text-navy">Sustainability</h5>
                        <p class="small text-muted mb-0">Investing in long-term solutions—such as solar wells and vocational training—that end dependency.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="p-4 rounded-3 border bg-light h-100 text-center">
                        <i class="fa-solid fa-handshake-angle fs-1 text-teal mb-3"></i>
                        <h5 class="fw-bold text-navy">Collaboration</h5>
                        <p class="small text-muted mb-0">Uniting local community leaders, foreign agencies, and grassroots volunteers for maximum reach.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Board of Directors / Leadership Section -->
    <section class="py-5 bg-light">
        <div class="container py-lg-4">
            <div class="text-center mb-5">
                <span class="section-badge">Governance</span>
                <h2 class="section-title">Board of Directors & Executive Leadership</h2>
                <p class="section-subtitle">Meet the visionary trustees steering the Social Development Council with dedication and community trust.</p>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach($boardMembers as $member)
                    <div class="col-lg-3 col-md-6">
                        <div class="charity-card text-center p-4">
                            <div class="mx-auto mb-3" style="width: 120px; height: 120px;">
                                <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="rounded-circle shadow-sm w-100 h-100" style="object-fit: cover; border: 3px solid var(--secondary-teal);">
                            </div>
                            <h5 class="fw-bold text-navy mb-1">{{ $member['name'] }}</h5>
                            <div class="text-teal small fw-semibold mb-3">{{ $member['role'] }}</div>
                            <p class="text-muted small mb-3">{{ $member['bio'] }}</p>
                            <div class="mt-auto d-flex justify-content-center gap-2">
                                <a href="mailto:info@sdcmksl.org" class="btn btn-sm btn-outline-navy rounded-circle p-2" style="width: 34px; height: 34px;" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>
                                <a href="https://linkedin.com" target="_blank" class="btn btn-sm btn-outline-teal rounded-circle p-2" style="width: 34px; height: 34px;" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('teams.index') }}" class="btn btn-navy px-4 py-2 rounded-pill fw-bold">
                    <span>View Full Teams & Executive Structure</span> <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Become a Volunteer CTA -->
    <section class="py-5 bg-white text-center">
        <div class="container py-lg-4">
            <div class="cta-volunteer-banner">
                <span class="badge bg-white text-navy mb-3 px-3 py-2 fw-bold text-uppercase">Make an Impact</span>
                <h2 class="display-6 fw-bold text-white mb-3">Ready to Serve Humanity with SDC?</h2>
                <p class="text-white-50 mx-auto fs-5 mb-4" style="max-width: 650px;">
                    Join our vibrant family of volunteers and changemakers. Your time and passion can change a community forever.
                </p>
                <a href="{{ route('volunteer.register') }}" class="btn btn-teal px-5 py-3 fs-6">
                    <i class="fa-solid fa-user-plus"></i> Submit Volunteer Application
                </a>
            </div>
        </div>
    </section>

@endsection
