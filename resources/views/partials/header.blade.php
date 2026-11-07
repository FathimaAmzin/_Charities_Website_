<!-- Skip Navigation for Accessibility (WCAG 2.1 AA / Screen Readers) -->
<a href="#main-content" class="skip-nav-link">Skip to main content</a>

<!-- Top Utility Bar (Desktop & High Contrast) -->
<div class="top-bar d-none d-lg-block" role="region" aria-label="Quick contact and organization info">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Contact Information Links -->
        <div class="d-flex align-items-center gap-4 flex-wrap top-bar-contacts">
            <span class="d-inline-flex align-items-center">
                <i class="fa-solid fa-location-dot me-2 text-accent" aria-hidden="true"></i>
                <a href="https://maps.google.com/?q=Maligaikadu,Eastern+Province,Sri+Lanka" target="_blank" rel="noopener noreferrer" class="top-bar-link" title="Open location in Google Maps">
                    Maligaikadu, Eastern Province, Sri Lanka
                </a>
            </span>
            <span class="d-inline-flex align-items-center">
                <i class="fa-solid fa-envelope me-2 text-accent" aria-hidden="true"></i>
                <a href="mailto:info@sdcmksl.org" class="top-bar-link" aria-label="Send email to info@sdcmksl.org">
                    info@sdcmksl.org
                </a>
            </span>
            <span class="d-inline-flex align-items-center">
                <i class="fa-solid fa-phone me-2 text-accent" aria-hidden="true"></i>
                <a href="tel:+94672229180" class="top-bar-link" aria-label="Call +94 67 222 9180">
                    +94 (0) 67 222 9180
                </a>
            </span>
        </div>

        <!-- Social Media & Quick Volunteer Badge -->
        <div class="d-flex align-items-center gap-3">
            <!-- Topbar Multi-Language Selector (English, Tamil, Sinhala) -->
            <div class="dropdown custom-lang-dropdown">
                <button class="btn btn-sm lang-btn dropdown-toggle d-inline-flex align-items-center gap-2" type="button" id="topbarLangDropdown" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" title="Translate Website">
                    <span class="current-lang-flag">🇬🇧</span>
                    <span class="current-lang-name">English</span>
                    <i class="fa-solid fa-chevron-down" style="font-size: 0.65rem;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 p-1 lang-dropdown-menu" aria-labelledby="topbarLangDropdown" style="min-width: 180px;">
                    <li>
                        <button class="dropdown-item d-flex align-items-center justify-content-between py-2 rounded-2" type="button" data-lang-select="en" onclick="sdcChangeLanguage('en')">
                            <span class="d-inline-flex align-items-center gap-2">
                                <span>🇬🇧</span>
                                <span>English</span>
                            </span>
                            <i class="fa-solid fa-check text-primary small lang-check" data-lang="en"></i>
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item d-flex align-items-center justify-content-between py-2 rounded-2" type="button" data-lang-select="ta" onclick="sdcChangeLanguage('ta')">
                            <span class="d-inline-flex align-items-center gap-2">
                                <span>🇱🇰</span>
                                <span>தமிழ் (Tamil)</span>
                            </span>
                            <i class="fa-solid fa-check text-primary small lang-check d-none" data-lang="ta"></i>
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item d-flex align-items-center justify-content-between py-2 rounded-2" type="button" data-lang-select="si" onclick="sdcChangeLanguage('si')">
                            <span class="d-inline-flex align-items-center gap-2">
                                <span>🇱🇰</span>
                                <span>සිංහල (Sinhala)</span>
                            </span>
                            <i class="fa-solid fa-check text-primary small lang-check d-none" data-lang="si"></i>
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Topbar Dark / Light Mode Toggle Button -->
            <button class="theme-toggle-btn" type="button" title="Switch Theme" aria-label="Toggle Dark / Light Theme">
                <i class="fa-solid fa-moon theme-icon-moon"></i>
                <i class="fa-solid fa-sun theme-icon-sun d-none"></i>
            </button>

            <span class="top-bar-divider" aria-hidden="true"></span>

            <!-- Topbar Volunteer Team Dropdown (Volunteer, Members) -->
            <div class="dropdown custom-volunteer-dropdown d-inline-block">
                <button class="top-bar-volunteer-pill dropdown-toggle d-inline-flex align-items-center gap-2 border-0" type="button" id="topbarVolunteerDropdown" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" title="SDC Volunteer Team & Council Members">
                    <i class="fa-solid fa-hand-holding-heart" aria-hidden="true"></i>
                    <span>Volunteer Team</span>
                    <i class="fa-solid fa-chevron-down ms-1" style="font-size: 0.65rem;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 p-2 volunteer-dropdown-menu" aria-labelledby="topbarVolunteerDropdown" style="min-width: 250px;">
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-3 p-2 rounded-2" href="{{ route('volunteer.register') }}">
                            <div class="volunteer-menu-icon bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 1rem;">
                                <i class="fa-solid fa-hand-holding-heart"></i>
                            </div>
                            <div>
                                <div class="fw-bold small text-navy">Volunteer</div>
                                <small class="text-muted d-block" style="font-size: 0.72rem;">Apply to join volunteer field team</small>
                            </div>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider my-1"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-3 p-2 rounded-2" href="{{ route('member.register') }}">
                            <div class="volunteer-menu-icon bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 1rem;">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div>
                                <div class="fw-bold small text-navy">Members</div>
                                <small class="text-muted d-block" style="font-size: 0.72rem;">Apply for SDC Membership Registration</small>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <span class="top-bar-divider" aria-hidden="true"></span>
            <span class="text-white-50 small">Follow Us:</span>
            <div class="d-flex align-items-center gap-2 top-social-links">
                <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="top-social-icon" aria-label="Visit SDC on Facebook" title="Facebook">
                    <i class="fa-brands fa-facebook-f" aria-hidden="true"></i>
                </a>
                <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="top-social-icon" aria-label="Visit SDC on X / Twitter" title="X (Twitter)">
                    <i class="fa-brands fa-x-twitter" aria-hidden="true"></i>
                </a>
                <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="top-social-icon" aria-label="Visit SDC on Instagram" title="Instagram">
                    <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                </a>
                <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="top-social-icon" aria-label="Visit SDC on LinkedIn" title="LinkedIn">
                    <i class="fa-brands fa-linkedin-in" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Website Header & Accessible Navigation -->
<header class="site-header" role="banner">
    <nav class="navbar navbar-expand-lg py-2" aria-label="Primary Navigation">
        <div class="container-fluid header-nav-container">
            <!-- Organization Brand Logo & Name (Left side) -->
            <a class="navbar-brand-wrapper" href="{{ route('home') }}" aria-label="Social Development Council Homepage">
                <img src="{{ asset('images/logo-sdc.jpg') }}" alt="SDC Organization Logo" class="navbar-brand-logo" width="44" height="44" onerror="this.src='https://ui-avatars.com/api/?name=SDC&background=0059FF&color=fff&size=80'">
                <div class="brand-text-container">
                    <span class="brand-text-title d-block">Social Development Council</span>
                    <span class="brand-text-sub d-block">Maligaikadu • Sri Lanka</span>
                </div>
            </a>

            <!-- Mobile Hamburger Menu Toggler (Right side, visible on mobile/tablet < 992px) -->
            <button class="navbar-toggler custom-hamburger-toggler d-inline-flex d-lg-none ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#mainNavbarOffcanvas" aria-controls="mainNavbarOffcanvas" aria-expanded="false" aria-label="Toggle navigation menu">
                <i class="fa-solid fa-bars fs-4 text-navy" aria-hidden="true"></i>
            </button>

            <!-- Offcanvas Responsive Navigation Drawer -->
            <div class="offcanvas offcanvas-end modern-offcanvas" tabindex="-1" id="mainNavbarOffcanvas" aria-labelledby="mainNavbarOffcanvasLabel">
                <!-- Mobile Drawer Header -->
                <div class="offcanvas-header border-bottom d-lg-none">
                    <div class="d-flex align-items-center gap-2" id="mainNavbarOffcanvasLabel">
                        <img src="{{ asset('images/logo-sdc.jpg') }}" alt="SDC Logo" class="navbar-brand-logo-sm" width="36" height="36" onerror="this.src='https://ui-avatars.com/api/?name=SDC&background=0059FF&color=fff&size=80'">
                        <div>
                            <div class="fw-bold text-navy" style="font-size: 0.95rem; line-height: 1.2;">Social Development Council</div>
                            <small class="text-accent fw-bold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.05em;">Maligaikadu • Sri Lanka</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close custom-offcanvas-close shadow-none" data-bs-dismiss="offcanvas" data-bs-target="#mainNavbarOffcanvas" aria-label="Close navigation menu"></button>
                </div>

                <!-- Navigation Links & Drawer Body -->
                <div class="offcanvas-body d-flex flex-column flex-lg-row align-items-stretch align-items-lg-center justify-content-lg-between p-3 p-lg-0 w-100">
                    <ul class="navbar-nav mx-lg-auto mb-3 mb-lg-0 py-2 py-lg-0 align-items-lg-center flex-lg-nowrap" role="menubar">
                        <!-- Home -->
                        <li class="nav-item" role="none">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" role="menuitem" aria-current="{{ request()->routeIs('home') ? 'page' : 'false' }}">
                                <i class="fa-solid fa-house-chimney d-lg-none me-2 text-accent" aria-hidden="true"></i>
                                <span>Home</span>
                            </a>
                        </li>

                        <!-- About Us -->
                        <li class="nav-item" role="none">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}" role="menuitem" aria-current="{{ request()->routeIs('about') ? 'page' : 'false' }}">
                                <i class="fa-solid fa-circle-info d-lg-none me-2 text-accent" aria-hidden="true"></i>
                                <span>About Us</span>
                            </a>
                        </li>
                        

                        <!-- Services Mega-Dropdown (Accessible & 2-Column Desktop Grid) -->
                        <li class="nav-item dropdown services-mega-dropdown" role="none">
                            <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-between {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}" id="servicesNavbarDropdown" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" aria-haspopup="true">
                                <span class="d-inline-flex align-items-center">
                                    <i class="fa-solid fa-hand-holding-heart d-lg-none me-2 text-accent" aria-hidden="true"></i>
                                    <span>Services</span>
                                </span>
                            </a>
                            <div class="dropdown-menu mega-services-menu shadow-lg border-0 rounded-4 p-0" aria-labelledby="servicesNavbarDropdown">
                                <!-- Mega Menu Header Banner -->
                                <div class="mega-menu-header px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="mega-icon-badge">
                                            <i class="fa-solid fa-hand-holding-heart text-white" aria-hidden="true"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-navy mb-0" style="font-size: 1rem;">Our 8 Core Impact Sectors</div>
                                            <small class="text-muted" style="font-size: 0.78rem;">Humanitarian aid and sustainable community development</small>
                                        </div>
                                    </div>
                                    <a href="{{ route('services.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1 fw-bold d-none d-md-inline-flex align-items-center gap-1">
                                        <span>Overview</span>
                                        <i class="fa-solid fa-arrow-right fs-xs" aria-hidden="true"></i>
                                    </a>
                                </div>

                                <!-- 2-Column Services Grid -->
                                <div class="mega-menu-grid px-3 py-2">
                                    <div class="row g-2">
                                        <!-- 1. Electricity -->
                                        <div class="col-12 col-md-6">
                                            <a class="mega-service-item d-flex align-items-center gap-3 p-2 rounded-3" href="{{ route('services.index') }}#electricity">
                                                <div class="service-mini-icon bg-warning-subtle text-warning">
                                                    <i class="fa-solid fa-bolt" aria-hidden="true"></i>
                                                </div>
                                                <div class="service-mini-content">
                                                    <div class="service-mini-title">Electricity Access</div>
                                                    <div class="service-mini-desc">Solar solutions & home electrification</div>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- 2. Education -->
                                        <div class="col-12 col-md-6">
                                            <a class="mega-service-item d-flex align-items-center gap-3 p-2 rounded-3" href="{{ route('services.index') }}#education">
                                                <div class="service-mini-icon bg-primary-subtle text-primary">
                                                    <i class="fa-solid fa-graduation-cap" aria-hidden="true"></i>
                                                </div>
                                                <div class="service-mini-content">
                                                    <div class="service-mini-title">Education Support</div>
                                                    <div class="service-mini-desc">Scholarships, kits & tuition assistance</div>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- 3. House -->
                                        <div class="col-12 col-md-6">
                                            <a class="mega-service-item d-flex align-items-center gap-3 p-2 rounded-3" href="{{ route('services.index') }}#house">
                                                <div class="service-mini-icon bg-success-subtle text-success">
                                                    <i class="fa-solid fa-house-chimney" aria-hidden="true"></i>
                                                </div>
                                                <div class="service-mini-content">
                                                    <div class="service-mini-title">Housing & Shelter</div>
                                                    <div class="service-mini-desc">Safe home repairs & reconstruction</div>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- 4. Water Supply -->
                                        <div class="col-12 col-md-6">
                                            <a class="mega-service-item d-flex align-items-center gap-3 p-2 rounded-3" href="{{ route('services.index') }}#water-supply">
                                                <div class="service-mini-icon bg-info-subtle text-info">
                                                    <i class="fa-solid fa-faucet-drip" aria-hidden="true"></i>
                                                </div>
                                                <div class="service-mini-content">
                                                    <div class="service-mini-title">Clean Water Supply</div>
                                                    <div class="service-mini-desc">Wells, pipelines & water purification</div>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- 5. Basic Facilities -->
                                        <div class="col-12 col-md-6">
                                            <a class="mega-service-item d-flex align-items-center gap-3 p-2 rounded-3" href="{{ route('services.index') }}#basic-facilities">
                                                <div class="service-mini-icon bg-warning-subtle text-dark">
                                                    <i class="fa-solid fa-bell-concierge" aria-hidden="true"></i>
                                                </div>
                                                <div class="service-mini-content">
                                                    <div class="service-mini-title">Basic Facilities</div>
                                                    <div class="service-mini-desc">Sanitation toilets & essential amenities</div>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- 6. Livelihood -->
                                        <div class="col-12 col-md-6">
                                            <a class="mega-service-item d-flex align-items-center gap-3 p-2 rounded-3" href="{{ route('services.index') }}#livelihood-poverty">
                                                <div class="service-mini-icon bg-success-subtle text-success">
                                                    <i class="fa-solid fa-seedling" aria-hidden="true"></i>
                                                </div>
                                                <div class="service-mini-content">
                                                    <div class="service-mini-title">Livelihood for Poverty</div>
                                                    <div class="service-mini-desc">Tools, grants & self-sufficiency</div>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- 7. Widows & Families -->
                                        <div class="col-12 col-md-6">
                                            <a class="mega-service-item d-flex align-items-center gap-3 p-2 rounded-3" href="{{ route('services.index') }}#widows-head-of-families">
                                                <div class="service-mini-icon bg-danger-subtle text-danger">
                                                    <i class="fa-solid fa-person-breastfeeding" aria-hidden="true"></i>
                                                </div>
                                                <div class="service-mini-content">
                                                    <div class="service-mini-title">Widows & Female Heads</div>
                                                    <div class="service-mini-desc">Direct monthly stipends & protection</div>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- 8. Physical Disabilities -->
                                        <div class="col-12 col-md-6">
                                            <a class="mega-service-item d-flex align-items-center gap-3 p-2 rounded-3" href="{{ route('services.index') }}#physical-disabilities">
                                                <div class="service-mini-icon bg-primary-subtle text-primary">
                                                    <i class="fa-solid fa-wheelchair" aria-hidden="true"></i>
                                                </div>
                                                <div class="service-mini-content">
                                                    <div class="service-mini-title">Physical Disabilities</div>
                                                    <div class="service-mini-desc">Mobility aids, wheelchairs & healthcare</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Courses & Vocational Sub-Courses Section inside Services Dropdown -->
                                <div class="mega-courses-subpanel px-3 py-3 border-top" style="background: linear-gradient(180deg, #F8FAFC 0%, #F1F5F9 100%);">
                                    <div class="d-flex align-items-center justify-content-between mb-2 px-1">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-primary text-white rounded-pill px-2 py-1 small fw-bold">
                                                <i class="fa-solid fa-graduation-cap me-1"></i> Courses
                                            </span>
                                            <span class="fw-bold text-navy small">Educational & Vocational Training Sub-Courses</span>
                                        </div>
                                        <a href="{{ route('courses.index') }}" class="small fw-bold text-primary text-decoration-none d-inline-flex align-items-center gap-1">
                                            <span>Explore All Courses</span>
                                            <i class="fa-solid fa-arrow-right fs-xs"></i>
                                        </a>
                                    </div>

                                    <div class="row g-2">
                                        <!-- 1. Free Seminars for school students -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <a class="mega-service-item d-flex align-items-center gap-2 p-2 rounded-3 bg-white border" href="{{ route('courses.index') }}#free-seminars-school-students">
                                                <div class="service-mini-icon bg-primary-subtle text-primary" style="width: 32px; height: 32px; font-size: 0.85rem; border-radius: 8px;">
                                                    <i class="fa-solid fa-chalkboard-user"></i>
                                                </div>
                                                <div class="service-mini-content">
                                                    <div class="service-mini-title" style="font-size: 0.82rem; font-weight: 600;">Free Seminars for students</div>
                                                    <small class="text-muted d-block" style="font-size: 0.68rem;">Exam & career guidance</small>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- 2. Sewing Course -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <a class="mega-service-item d-flex align-items-center gap-2 p-2 rounded-3 bg-white border" href="{{ route('courses.index') }}#sewing-course">
                                                <div class="service-mini-icon bg-danger-subtle text-danger" style="width: 32px; height: 32px; font-size: 0.85rem; border-radius: 8px;">
                                                    <i class="fa-solid fa-scissors"></i>
                                                </div>
                                                <div class="service-mini-content">
                                                    <div class="service-mini-title" style="font-size: 0.82rem; font-weight: 600;">Sewing Course</div>
                                                    <small class="text-muted d-block" style="font-size: 0.68rem;">Garment tailoring & design</small>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- 3. IT Certificate Course -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <a class="mega-service-item d-flex align-items-center gap-2 p-2 rounded-3 bg-white border" href="{{ route('courses.index') }}#it-certificate-course">
                                                <div class="service-mini-icon bg-info-subtle text-info" style="width: 32px; height: 32px; font-size: 0.85rem; border-radius: 8px;">
                                                    <i class="fa-solid fa-laptop-code"></i>
                                                </div>
                                                <div class="service-mini-content">
                                                    <div class="service-mini-title" style="font-size: 0.82rem; font-weight: 600;">IT Certificate Course</div>
                                                    <small class="text-muted d-block" style="font-size: 0.68rem;">Basic computing & MS Office</small>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- 4. IT Diploma Course -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <a class="mega-service-item d-flex align-items-center gap-2 p-2 rounded-3 bg-white border" href="{{ route('courses.index') }}#it-diploma-course">
                                                <div class="service-mini-icon bg-primary-subtle text-primary" style="width: 32px; height: 32px; font-size: 0.85rem; border-radius: 8px;">
                                                    <i class="fa-solid fa-network-wired"></i>
                                                </div>
                                                <div class="service-mini-content">
                                                    <div class="service-mini-title" style="font-size: 0.82rem; font-weight: 600;">IT Diploma Course</div>
                                                    <small class="text-muted d-block" style="font-size: 0.68rem;">Coding & web development</small>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- 5. Cooking Course -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <a class="mega-service-item d-flex align-items-center gap-2 p-2 rounded-3 bg-white border" href="{{ route('courses.index') }}#cooking-course">
                                                <div class="service-mini-icon bg-warning-subtle text-warning" style="width: 32px; height: 32px; font-size: 0.85rem; border-radius: 8px;">
                                                    <i class="fa-solid fa-utensils"></i>
                                                </div>
                                                <div class="service-mini-content">
                                                    <div class="service-mini-title" style="font-size: 0.82rem; font-weight: 600;">Cooking Course</div>
                                                    <small class="text-muted d-block" style="font-size: 0.68rem;">Culinary arts & baking</small>
                                                </div>
                                            </a>
                                        </div>

                                        <!-- 6. English Diploma Course -->
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <a class="mega-service-item d-flex align-items-center gap-2 p-2 rounded-3 bg-white border" href="{{ route('courses.index') }}#english-diploma-course">
                                                <div class="service-mini-icon bg-success-subtle text-success" style="width: 32px; height: 32px; font-size: 0.85rem; border-radius: 8px;">
                                                    <i class="fa-solid fa-book-open-reader"></i>
                                                </div>
                                                <div class="service-mini-content">
                                                    <div class="service-mini-title" style="font-size: 0.82rem; font-weight: 600;">English Diploma Course</div>
                                                    <small class="text-muted d-block" style="font-size: 0.68rem;">Spoken & workplace English</small>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mega Menu Footer -->
                                <div class="mega-menu-footer bg-light px-4 py-2 border-top rounded-bottom-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <small class="text-muted"><i class="fa-solid fa-shield-heart text-accent me-1"></i> Dedicated to transparent humanitarian aid</small>
                                    <a href="{{ route('services.index') }}" class="fw-bold text-primary small d-inline-flex align-items-center gap-1">
                                        <span>View all services overview</span>
                                        <i class="fa-solid fa-chevron-right" style="font-size: 0.7rem;" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </li>

                        <!-- Teams Dropdown (Board of Directors & Managing Executive Members) -->
                        <li class="nav-item dropdown teams-dropdown" role="none">
                            <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-between {{ request()->routeIs('teams.*') ? 'active' : '' }}" href="{{ route('teams.index') }}" id="teamsNavbarDropdown" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" aria-haspopup="true">
                                <span class="d-inline-flex align-items-center">
                                    <i class="fa-solid fa-users-gear d-lg-none me-2 text-accent" aria-hidden="true"></i>
                                    <span>Teams</span>
                                </span>
                            </a>
                            <div class="dropdown-menu shadow-lg border-0 rounded-4 p-2 teams-dropdown-menu" aria-labelledby="teamsNavbarDropdown" style="min-width: 290px;">
                                <!-- Sub-Team 1: Board of Directors -->
                                <a class="dropdown-item d-flex align-items-center gap-3 p-2 rounded-3 hover-bg-light" href="{{ route('teams.index') }}#board-of-directors">
                                    <div class="service-mini-icon bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 0.95rem; border-radius: 8px;">
                                        <i class="fa-solid fa-user-tie"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-navy small">Board of Directors</div>
                                        <small class="text-muted" style="font-size: 0.72rem;">Governing board & trustees</small>
                                    </div>
                                </a>

                                <!-- Sub-Team 2: Managing Executive Members -->
                                <a class="dropdown-item d-flex align-items-center gap-3 p-2 rounded-3 hover-bg-light mt-1" href="{{ route('teams.index') }}#managing-executives">
                                    <div class="service-mini-icon bg-success-subtle text-success d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 0.95rem; border-radius: 8px;">
                                        <i class="fa-solid fa-gears"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-navy small">Managing Executive Members</div>
                                        <small class="text-muted" style="font-size: 0.72rem;">Operations & field leadership</small>
                                    </div>
                                </a>

                                <!-- Full Team Footer Link -->
                                <div class="border-top mt-2 pt-2 text-center">
                                    <a href="{{ route('teams.index') }}" class="btn btn-sm btn-navy w-100 rounded-pill py-1 fw-bold" style="font-size: 0.8rem;">
                                        <span>View Full Teams</span> <i class="fa-solid fa-arrow-right fs-xs ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </li>

                        <!-- Campaigns -->
                        <li class="nav-item" role="none">
                            <a class="nav-link {{ request()->routeIs('campaigns.*') ? 'active' : '' }}" href="{{ route('campaigns.index') }}" role="menuitem" aria-current="{{ request()->routeIs('campaigns.*') ? 'page' : 'false' }}">
                                <i class="fa-solid fa-bullhorn d-lg-none me-2 text-accent" aria-hidden="true"></i>
                                <span>Campaigns</span>
                            </a>
                        </li>

                        <!-- Gallery -->
                        <li class="nav-item" role="none">
                            <a class="nav-link {{ request()->routeIs('gallery.index') ? 'active' : '' }}" href="{{ route('gallery.index') }}" role="menuitem" aria-current="{{ request()->routeIs('gallery.index') ? 'page' : 'false' }}">
                                <i class="fa-solid fa-images d-lg-none me-2 text-accent" aria-hidden="true"></i>
                                <span>Gallery</span>
                            </a>
                        </li>

                        <!-- News & Events -->
                        <li class="nav-item" role="none">
                            <a class="nav-link {{ request()->routeIs('news.*') || request()->routeIs('events.*') ? 'active' : '' }}" href="{{ route('news.index') }}" role="menuitem" aria-current="{{ (request()->routeIs('news.*') || request()->routeIs('events.*')) ? 'page' : 'false' }}">
                                <i class="fa-solid fa-newspaper d-lg-none me-2 text-accent" aria-hidden="true"></i>
                                <span>News & Events</span>
                            </a>
                        </li>

                        <!-- Contact Us -->
                        <li class="nav-item" role="none">
                            <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}" role="menuitem" aria-current="{{ request()->routeIs('contact') ? 'page' : 'false' }}">
                                <i class="fa-solid fa-envelope d-lg-none me-2 text-accent" aria-hidden="true"></i>
                                <span>Contact</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Action Controls: Auth & Donate Now -->
                    <div class="nav-action-wrapper d-flex flex-column flex-lg-row align-items-stretch align-items-lg-center gap-2 gap-lg-3 pt-3 pt-lg-0 border-top border-lg-0 flex-shrink-0">
                        @auth
                            <!-- Authenticated User Dropdown Menu -->
                            <div class="dropdown">
                                <button class="btn btn-outline-navy user-profile-btn dropdown-toggle w-100 d-flex align-items-center justify-content-between justify-content-lg-start gap-2" type="button" id="userAccountMenuButton" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="user-avatar-circle">
                                            <i class="fa-solid fa-user" aria-hidden="true"></i>
                                        </div>
                                        <span class="user-name-label text-truncate" style="max-width: 140px;">{{ Auth::user()->name }}</span>
                                    </div>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2 user-menu-dropdown" aria-labelledby="userAccountMenuButton">
                                    <li class="px-3 py-2 bg-light border-bottom rounded-top-3">
                                        <div class="small text-muted">Signed in as</div>
                                        <div class="fw-bold text-navy text-truncate" style="max-width: 200px;">{{ Auth::user()->email }}</div>
                                        <span class="badge bg-primary-subtle text-primary mt-1 text-capitalize fw-semibold">{{ Auth::user()->role ?? 'Member' }}</span>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2 fw-semibold text-primary d-flex align-items-center gap-2" href="{{ route('user.dashboard') }}">
                                            <i class="fa-solid fa-gauge text-primary" aria-hidden="true"></i>
                                            <span>My Dashboard</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('user.dashboard', ['tab' => 'requests']) }}">
                                            <i class="fa-solid fa-graduation-cap text-accent" aria-hidden="true"></i>
                                            <span>My Course Requests</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('user.dashboard', ['tab' => 'donations']) }}">
                                            <i class="fa-solid fa-hand-holding-dollar text-success" aria-hidden="true"></i>
                                            <span>My Donations</span>
                                        </a>
                                    </li>
                                    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff')
                                        <li>
                                            <a class="dropdown-item py-2 fw-semibold text-navy d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                                                <i class="fa-solid fa-shield-halved text-warning" aria-hidden="true"></i>
                                                <span>Admin Panel</span>
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('user.dashboard', ['tab' => 'profile']) }}">
                                            <i class="fa-solid fa-gear text-secondary" aria-hidden="true"></i>
                                            <span>Account Settings</span>
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider my-1"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger py-2 d-flex align-items-center gap-2 w-100">
                                                <i class="fa-solid fa-arrow-right-from-bracket" aria-hidden="true"></i>
                                                <span>Sign Out</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <!-- Guest Login Button -->
                            <a href="{{ route('login') }}" class="btn btn-outline-navy header-login-btn d-flex align-items-center justify-content-center gap-2" aria-label="Login to your account">
                                <i class="fa-solid fa-arrow-right-to-bracket" aria-hidden="true"></i>
                                <span>Login</span>
                            </a>
                        @endauth

                        <!-- Donate Now Button (Accessible, Vibrant & Prominent) -->
                        <a href="{{ route('donate') }}" class="btn btn-donate-highlight header-donate-btn d-flex align-items-center justify-content-center gap-2" aria-label="Make a donation to SDC charity projects">
                            <i class="fa-solid fa-heart beating-heart" aria-hidden="true"></i>
                            <span>Donate Now</span>
                        </a>
                    </div>

                    <!-- Mobile Drawer Footer Info (Shown in offcanvas on phone/tablet) -->
                    <div class="offcanvas-mobile-footer d-lg-none mt-4 pt-3 border-top">
                        <!-- Mobile Volunteer Team Options -->
                        <div class="mb-3">
                            <div class="dropdown custom-volunteer-dropdown w-100">
                                <button class="btn btn-outline-primary btn-sm w-100 dropdown-toggle d-flex align-items-center justify-content-between px-3 py-2 rounded-3 fw-semibold" type="button" id="mobileVolunteerDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="d-inline-flex align-items-center gap-2">
                                        <i class="fa-solid fa-hand-holding-heart"></i>
                                        <span>Volunteer Team</span>
                                    </span>
                                    <i class="fa-solid fa-chevron-down" style="font-size: 0.7rem;"></i>
                                </button>
                                <ul class="dropdown-menu w-100 shadow-sm border rounded-3 p-2 volunteer-dropdown-menu" aria-labelledby="mobileVolunteerDropdown">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded-2" href="{{ route('volunteer.register') }}">
                                            <i class="fa-solid fa-hand-holding-heart text-primary"></i>
                                            <div>
                                                <div class="fw-bold small text-navy">Volunteer</div>
                                                <small class="text-muted d-block" style="font-size: 0.7rem;">Apply as Volunteer</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider my-1"></li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded-2" href="{{ route('member.register') }}">
                                            <i class="fa-solid fa-users text-success"></i>
                                            <div>
                                                <div class="fw-bold small text-navy">Members</div>
                                                <small class="text-muted d-block" style="font-size: 0.7rem;">Apply for SDC Membership</small>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Mobile Language & Dark Mode Controls -->
                        <div class="d-flex align-items-center justify-content-between mb-3 p-2 bg-light rounded-3 border">
                            <span class="small fw-semibold text-navy">Language & Theme</span>
                            <div class="d-flex align-items-center gap-2">
                                <div class="dropdown custom-lang-dropdown">
                                    <button class="btn btn-sm lang-btn dropdown-toggle d-inline-flex align-items-center gap-1" type="button" id="mobileLangDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="current-lang-flag">🇬🇧</span>
                                        <span class="current-lang-name">English</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 p-1 lang-dropdown-menu" aria-labelledby="mobileLangDropdown">
                                        <li><button class="dropdown-item d-flex align-items-center justify-content-between py-2 rounded-2" type="button" data-lang-select="en" onclick="sdcChangeLanguage('en')"><span>🇬🇧 English</span><i class="fa-solid fa-check text-primary small lang-check" data-lang="en"></i></button></li>
                                        <li><button class="dropdown-item d-flex align-items-center justify-content-between py-2 rounded-2" type="button" data-lang-select="ta" onclick="sdcChangeLanguage('ta')"><span>🇱🇰 தமிழ்</span><i class="fa-solid fa-check text-primary small lang-check d-none" data-lang="ta"></i></button></li>
                                        <li><button class="dropdown-item d-flex align-items-center justify-content-between py-2 rounded-2" type="button" data-lang-select="si" onclick="sdcChangeLanguage('si')"><span>🇱🇰 සිංහල</span><i class="fa-solid fa-check text-primary small lang-check d-none" data-lang="si"></i></button></li>
                                    </ul>
                                </div>
                                <button class="theme-toggle-btn" type="button" title="Switch Theme" aria-label="Toggle Dark / Light Theme">
                                    <i class="fa-solid fa-moon theme-icon-moon"></i>
                                    <i class="fa-solid fa-sun theme-icon-sun d-none"></i>
                                </button>
                            </div>
                        </div>

                        <div class="text-muted small fw-bold text-uppercase mb-2" style="font-size: 0.72rem; letter-spacing: 0.05em;">Get in Touch</div>
                        <div class="d-flex flex-column gap-2 mb-3">
                            <a href="tel:+94672229180" class="mobile-footer-link d-flex align-items-center gap-2">
                                <i class="fa-solid fa-phone text-accent" aria-hidden="true"></i>
                                <span>+94 (0) 67 222 9180</span>
                            </a>
                            <a href="mailto:info@sdcmksl.org" class="mobile-footer-link d-flex align-items-center gap-2">
                                <i class="fa-solid fa-envelope text-accent" aria-hidden="true"></i>
                                <span>info@sdcmksl.org</span>
                            </a>
                            <div class="mobile-footer-link d-flex align-items-start gap-2 text-muted">
                                <i class="fa-solid fa-location-dot text-accent mt-1" aria-hidden="true"></i>
                                <span>Maligaikadu, Eastern Province, Sri Lanka</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                            <span class="small text-muted">Connect with SDC</span>
                            <div class="d-flex align-items-center gap-2">
                                <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" class="mobile-social-icon" aria-label="Facebook">
                                    <i class="fa-brands fa-facebook-f" aria-hidden="true"></i>
                                </a>
                                <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="mobile-social-icon" aria-label="X / Twitter">
                                    <i class="fa-brands fa-x-twitter" aria-hidden="true"></i>
                                </a>
                                <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="mobile-social-icon" aria-label="Instagram">
                                    <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                                </a>
                                <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="mobile-social-icon" aria-label="LinkedIn">
                                    <i class="fa-brands fa-linkedin-in" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
