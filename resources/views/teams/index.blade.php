@extends('layouts.app')

@section('title', 'Our Teams - Board of Directors & Managing Executives | SDC Sri Lanka')
@section('meta_description', 'Meet the Board of Directors and Managing Executive Members leading Social Development Council (SDC) Sri Lanka in humanitarian and community development.')

@section('content')

    <!-- Hero Header Banner -->
    <section class="page-header-banner" style="background: linear-gradient(135deg, #0d233a 0%, #173b64 50%, #12345a 100%);">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold shadow-sm" style="background-color: rgba(56, 189, 248, 0.2); color: #7DD3FC; letter-spacing: 0.05em;">
                <i class="fa-solid fa-users-gear me-1"></i> Organizational Governance
            </span>
            <h1 class="display-4 fw-bold text-white mb-2">Our Teams & Leadership</h1>
            <p class="text-white-50 mx-auto mb-3" style="max-width: 720px; font-size: 1.1rem;">
                Guided by experienced community directors and dedicated executive leads committed to transparency, grassroots impact, and sustainable community empowerment.
            </p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('about') }}" class="text-white-50">About Us</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Teams</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Quick Navigation Sticky Pills -->
    <section class="py-3 bg-white border-bottom shadow-sm sticky-top" style="top: 72px; z-index: 990;">
        <div class="container">
            <div class="d-flex align-items-center justify-content-center gap-2 overflow-x-auto py-1">
                <a href="#board-of-directors" class="btn btn-sm btn-outline-navy rounded-pill px-4 py-2 fw-semibold">
                    <i class="fa-solid fa-user-tie text-accent me-1"></i> Board of Directors
                </a>
                <a href="#managing-executives" class="btn btn-sm btn-outline-navy rounded-pill px-4 py-2 fw-semibold">
                    <i class="fa-solid fa-sitemap text-teal me-1"></i> Managing Executive Members
                </a>
            </div>
        </div>
    </section>

    <!-- SECTION 1: BOARD OF DIRECTORS -->
    <section class="py-5 bg-white" id="board-of-directors">
        <div class="container">
            <div class="text-center max-w-750 mx-auto mb-5">
                <span class="badge bg-primary-subtle text-primary px-3 py-1 rounded-pill fw-bold text-uppercase mb-2">
                    <i class="fa-solid fa-shield-halved me-1"></i> Governing Body
                </span>
                <h2 class="fw-bold text-navy mb-3" style="font-size: 2.25rem;">Board of Directors</h2>
                <p class="text-muted fs-6">
                    Our esteemed Board of Directors steers institutional vision, ethical oversight, statutory compliance, and strategic alliances to ensure our aid programs achieve lasting humanitarian impact.
                </p>
            </div>

            <!-- Board Members Cards Grid -->
            <div class="row g-4 justify-content-center">
                @foreach($boardOfDirectors as $director)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden team-profile-card bg-white text-center p-4 d-flex flex-column justify-content-between">
                            <div>
                                <!-- Profile Photo with Professional Frame -->
                                <div class="position-relative mx-auto mb-4" style="width: 140px; height: 140px;">
                                    <img src="{{ asset($director['image']) }}" alt="{{ $director['name'] }}" class="rounded-circle w-100 h-100 shadow" style="object-fit: cover; border: 4px solid #1E4A7A;" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($director['name']) }}&background=1E4A7A&color=fff&size=200'">
                                    <span class="position-absolute bottom-0 end-0 badge bg-primary rounded-circle p-2 shadow" title="Board of Directors" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fa-solid fa-check text-white small"></i>
                                    </span>
                                </div>

                                <!-- Role & Name -->
                                <span class="badge bg-light text-navy border px-3 py-1 rounded-pill small fw-bold mb-2">
                                    {{ $director['badge'] ?? 'Director of Board' }}
                                </span>
                                <h4 class="fw-bold text-navy mb-1" style="font-size: 1.25rem;">{{ $director['name'] }}</h4>
                                <div class="text-primary fw-semibold small mb-3">
                                    <i class="fa-solid fa-briefcase me-1"></i> {{ $director['role'] }}
                                </div>

                                <p class="text-muted small mb-4" style="line-height: 1.6;">
                                    {{ $director['bio'] }}
                                </p>
                            </div>

                            <!-- Footer Contact & Badge -->
                            <div class="pt-3 border-top d-flex align-items-center justify-content-between">
                                <span class="text-muted small" style="font-size: 0.75rem;">
                                    <i class="fa-solid fa-building-columns text-accent me-1"></i> SDC Board
                                </span>
                                <a href="mailto:{{ $director['email'] ?? 'info@sdcmksl.org' }}" class="btn btn-sm btn-outline-navy rounded-pill px-3 py-1" style="font-size: 0.78rem;">
                                    <i class="fa-solid fa-envelope me-1"></i> Contact
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SECTION 2: MANAGING EXECUTIVE MEMBERS -->
    <section class="py-5 bg-light border-top" id="managing-executives">
        <div class="container">
            <div class="text-center max-w-750 mx-auto mb-5">
                <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill fw-bold text-uppercase mb-2">
                    <i class="fa-solid fa-gears me-1"></i> Field & Program Delivery
                </span>
                <h2 class="fw-bold text-navy mb-3" style="font-size: 2.25rem;">Managing Executive Members</h2>
                <p class="text-muted fs-6">
                    Hands-on departmental directors executing our relief programs, medical missions, vocational skills education, women empowerment, and community field logistics.
                </p>
            </div>

            <!-- Executive Members Cards Grid -->
            <div class="row g-4 justify-content-center">
                @foreach($executiveMembers as $exec)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden team-profile-card bg-white text-center p-4 d-flex flex-column justify-content-between">
                            <div>
                                <!-- Profile Photo -->
                                <div class="position-relative mx-auto mb-4" style="width: 130px; height: 130px;">
                                    <img src="{{ asset($exec['image']) }}" alt="{{ $exec['name'] }}" class="rounded-circle w-100 h-100 shadow-sm" style="object-fit: cover; border: 4px solid #0059FF;" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($exec['name']) }}&background=0059FF&color=fff&size=200'">
                                    <span class="position-absolute bottom-0 end-0 badge bg-teal rounded-circle p-2 shadow" style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; background-color: #059669;">
                                        <i class="fa-solid fa-sitemap text-white small"></i>
                                    </span>
                                </div>

                                <!-- Role & Name -->
                                <span class="badge bg-light text-secondary border px-3 py-1 rounded-pill small fw-semibold mb-2">
                                    {{ $exec['badge'] ?? 'Executive Member' }}
                                </span>
                                <h4 class="fw-bold text-navy mb-1" style="font-size: 1.2rem;">{{ $exec['name'] }}</h4>
                                <div class="text-teal fw-semibold small mb-3" style="color: #059669;">
                                    <i class="fa-solid fa-id-badge me-1"></i> {{ $exec['role'] }}
                                </div>

                                <p class="text-muted small mb-4" style="line-height: 1.6;">
                                    {{ $exec['bio'] }}
                                </p>
                            </div>

                            <!-- Footer Contact & Organization Details -->
                            <div class="pt-3 border-top d-flex align-items-center justify-content-between">
                                <span class="text-muted small" style="font-size: 0.75rem;">
                                    <i class="fa-solid fa-circle-check text-success me-1"></i> Executive Officer
                                </span>
                                <a href="mailto:{{ $exec['email'] ?? 'info@sdcmksl.org' }}" class="btn btn-sm btn-outline-navy rounded-pill px-3 py-1" style="font-size: 0.78rem;">
                                    <i class="fa-solid fa-envelope me-1"></i> Connect
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Join Leadership / Volunteer CTA -->
    <section class="py-5 bg-navy text-white text-center" style="background-color: #12345a;">
        <div class="container py-3">
            <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold text-uppercase mb-2">Collaborative Action</span>
            <h3 class="fw-bold text-white mb-2">Work Alongside Our Leadership Team</h3>
            <p class="text-white-50 mx-auto mb-4" style="max-width: 650px;">
                Whether you wish to provide expert advisory servicing, volunteer in our field operations, or partner on community infrastructure projects, our directors welcome your collaboration.
            </p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="{{ route('volunteer.register') }}" class="btn btn-primary px-4 py-2 rounded-pill fw-bold">
                    <i class="fa-solid fa-hand-holding-heart me-1"></i> Join as Volunteer
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline-light px-4 py-2 rounded-pill fw-bold">
                    <i class="fa-solid fa-envelope me-1"></i> Contact Leadership
                </a>
            </div>
        </div>
    </section>

@endsection

