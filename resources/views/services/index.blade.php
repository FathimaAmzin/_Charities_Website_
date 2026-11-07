@extends('layouts.app')

@section('title', 'Our Services | Social Development Council (SDC) Sri Lanka')
@section('meta_description', 'Explore the comprehensive humanitarian and community development services provided by SDC Sri Lanka, including Electricity, Education, Housing, Clean Water, Basic Facilities, Poverty Alleviation, Support for Widows, and Disability Care.')

@section('content')

    <!-- Page Banner with Breadcrumb -->
    <section class="page-header-banner">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.25); color: #93C5FD;">Holistic Community Welfare</span>
            <h1 class="display-4 fw-bold text-white mb-2">Our Services</h1>
            <p class="text-white-50 mx-auto mb-3" style="max-width: 680px;">
                Delivering grassroots humanitarian assistance, sustainable infrastructure, and compassionate empowerment to the most vulnerable families across Sri Lanka.
            </p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Our Services</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Interactive Jump Pills / Quick Selector -->
    <section class="py-3 bg-white border-bottom shadow-sm sticky-top" style="top: 72px; z-index: 990;">
        <div class="container">
            <div class="d-flex align-items-center justify-content-start justify-content-lg-center gap-2 overflow-x-auto py-1 service-nav-pills text-nowrap">
                <span class="text-muted small fw-semibold me-2 d-none d-md-inline"><i class="fa-solid fa-arrow-down-short-wide me-1"></i> Jump to:</span>
                @foreach($services as $srv)
                    <a href="#{{ $srv->slug ?? $srv['id'] }}" class="btn btn-sm btn-outline-navy rounded-pill px-3 py-1 service-pill-link">
                        <i class="{{ $srv->icon ?? $srv['icon'] }} me-1" style="color: {{ $srv->accent_color ?? $srv['accent_color'] }};"></i> {{ $srv->short_title ?? $srv['short_title'] ?? $srv->title ?? $srv['title'] }}
                    </a>
                @endforeach
                <a href="{{ route('courses.index') }}" class="btn btn-sm btn-primary rounded-pill px-3 py-1 text-white fw-bold shadow-xs">
                    <i class="fa-solid fa-graduation-cap me-1"></i> Vocational Courses & Seminars
                </a>
            </div>
        </div>
    </section>

    <!-- Services Overview Intro -->
    <section class="py-5 bg-white">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 d-flex align-items-center gap-3 p-3 mb-4" role="alert">
                    <div class="p-2 bg-success text-white rounded-circle fs-5 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-0 text-success">Request Received Successfully!</h6>
                        <div class="small text-dark">{{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="text-center max-w-750 mx-auto mb-5">
                <span class="section-badge">Humanitarian Sectors</span>
                <h2 class="section-title">Comprehensive Aid Built Around Real Community Needs</h2>
                <p class="text-muted fs-6">
                    From basic physiological essentials like potable water and secure shelter to long-term economic independence and disability rights, the Social Development Council executes targeted relief across our core welfare pillars.
                </p>

                <!-- Vocational Courses Callout Card -->
                <div class="p-4 rounded-4 mt-4 shadow-sm border d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 text-start" style="background: linear-gradient(135deg, #f0f7ff 0%, #e6f0fa 100%); border-color: #bfdbfe !important;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-3 bg-primary text-white rounded-circle fs-3 shadow-xs">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <div>
                            <div class="badge bg-primary text-white text-uppercase px-2 py-1 small fw-bold mb-1">New Feature</div>
                            <h5 class="fw-bold text-navy mb-1">Looking for Free Seminars & Vocational Courses?</h5>
                            <p class="text-muted small mb-0">Explore our free school seminars, IT diplomas, tailoring, cooking, and English language courses.</p>
                        </div>
                    </div>
                    <a href="{{ route('courses.index') }}" class="btn btn-navy px-4 py-2 rounded-pill text-nowrap fw-bold shadow-xs">
                        <span>Explore Courses</span> <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- Services Detailed Section -->
            <div class="d-flex flex-column gap-5">
                @foreach($services as $index => $service)
                    @php
                        $slug = $service->slug ?? $service['id'];
                        $title = $service->title ?? $service['title'];
                        $shortTitle = $service->short_title ?? $service['short_title'] ?? $title;
                        $category = $service->category ?? $service['category'];
                        $icon = $service->icon ?? $service['icon'];
                        $accentColor = $service->accent_color ?? $service['accent_color'] ?? '#2563EB';
                        $image = $service->image ?? $service['image'];
                        $summary = $service->summary ?? $service['summary'];
                        $description = $service->description ?? $service['description'];
                        $impact = $service->impact ?? $service['impact'] ?? 'Community Support';
                        $highlights = is_array($service->highlights ?? null) ? $service->highlights : ($service['highlights'] ?? []);
                        $supportImage = $service->support_image ?? $image;
                        $requestImage = $service->request_image ?? $image;
                        $provideImage = $service->provide_image ?? $image;
                        $supportDetails = $service->support_details ?? 'Contribute donations or equipment to empower this community service sector.';
                        $requestDetails = $service->request_details ?? 'Need aid or support in this sector? Submit your application or reach our local team.';
                        $provideDetails = $service->provide_details ?? 'Are you a professional, contractor, or volunteer? Join our network to provide servicing.';
                    @endphp

                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden service-detail-card bg-white" id="{{ $slug }}">
                        <div class="row g-0 align-items-stretch {{ $index % 2 == 1 ? 'flex-lg-row-reverse' : '' }}">
                            
                            <!-- Media Column with Photo (Click to View Full Details & Gallery) -->
                            <a href="{{ route('services.show', $slug) }}" class="col-lg-5 position-relative service-img-col d-block text-decoration-none" style="min-height: 360px;" title="View {{ $title }} Details & Photo Gallery">
                                <img src="{{ asset($image) }}" alt="{{ $title }}" class="w-100 h-100 service-featured-img" style="object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=800&q=80'">
                                <div class="service-img-overlay">
                                    <span class="badge px-3 py-2 rounded-pill fw-bold shadow-sm" style="background-color: {{ $accentColor }}; color: #fff;">
                                        <i class="{{ $icon }} me-1"></i> {{ $category }}
                                    </span>
                                </div>
                            </a>

                            <!-- Content Column -->
                            <div class="col-lg-7 p-4 p-md-5 d-flex flex-column justify-content-between bg-white">
                                <div>
                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                                        <span class="text-uppercase fw-bold small text-blue" style="letter-spacing: 0.05em;">
                                            Sector {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }} • {{ $category }}
                                        </span>
                                        <span class="badge bg-soft-blue text-navy px-3 py-1 rounded-pill small fw-semibold">
                                            <i class="fa-solid fa-chart-line text-accent me-1"></i> {{ $impact }}
                                        </span>
                                    </div>

                                    <h3 class="fw-bold text-navy mb-3 display-6" style="font-size: 1.85rem;">
                                        <a href="{{ route('services.show', $slug) }}" class="text-navy text-decoration-none hover-primary">{{ $title }}</a>
                                    </h3>
                                    
                                    <p class="lead text-secondary fs-6 mb-3 fw-medium">
                                        {{ $summary }}
                                    </p>

                                    <p class="text-muted mb-4" style="line-height: 1.7; font-size: 0.95rem;">
                                        {{ $description }}
                                    </p>

                                    <!-- Key Service Highlights -->
                                    @if(!empty($highlights))
                                        <div class="mb-4">
                                            <h6 class="fw-bold text-navy text-uppercase small mb-3" style="letter-spacing: 0.05em;">
                                                <i class="fa-solid fa-circle-check text-success me-1"></i> Key Interventions & Deliverables:
                                            </h6>
                                            <div class="row g-2">
                                                @foreach($highlights as $highlight)
                                                    <div class="col-sm-6">
                                                        <div class="d-flex align-items-center gap-2 p-2 rounded-3 bg-light border border-light">
                                                            <i class="fa-solid fa-check text-blue small"></i>
                                                            <span class="small fw-semibold text-dark">{{ $highlight }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Action Buttons: 1. Support This Service, 2. Request Assistance, 3. Provide Servicing -->
                                <div class="pt-3 border-top mt-3">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                        <div class="d-flex flex-wrap align-items-center gap-2">
                                            
                                            <!-- Button 1: Support This Service -->
                                            <button type="button" class="btn btn-navy px-3 py-2 btn-service-modal"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#serviceActionModal"
                                                data-action-type="support"
                                                data-title="Support {{ $title }}"
                                                data-badge="Support This Service"
                                                data-badge-class="bg-danger text-white"
                                                data-image="{{ asset($supportImage) }}"
                                                data-desc="{{ $supportDetails }}"
                                                data-link="{{ route('donate') }}"
                                                data-btn-text="Proceed to Support / Donate">
                                                <i class="fa-solid fa-heart text-danger me-1"></i> Support This Service
                                            </button>

                                            <!-- Button 2: Request Assistance -->
                                            <button type="button" class="btn btn-outline-navy px-3 py-2 btn-service-modal"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#serviceActionModal"
                                                data-action-type="apply"
                                                data-service-name="{{ $title }}"
                                                data-service-id="{{ $service->id ?? 0 }}"
                                                data-title="Request Assistance: {{ $title }}"
                                                data-badge="Request Assistance"
                                                data-badge-class="bg-primary text-white"
                                                data-image="{{ asset($requestImage) }}"
                                                data-desc="{{ $requestDetails }}">
                                                <i class="fa-solid fa-paper-plane text-primary me-1"></i> Request Assistance
                                            </button>

                                            <!-- Button 3: Provided Servicing (Navigates to Dedicated Showcase Page) -->
                                            <a href="{{ route('services.show', $slug) }}#provide-servicing" class="btn btn-outline-primary px-3 py-2 fw-semibold d-inline-flex align-items-center gap-1" title="View details, photos, and provided servicing for {{ $title }}">
                                                <i class="fa-solid fa-handshake-angle text-primary me-1"></i>
                                                <span>Provided Servicing</span>
                                                <i class="fa-solid fa-arrow-right small ms-1"></i>
                                            </a>
                                        </div>

                                        <a href="#servicesNavbarDropdown" class="text-muted small text-decoration-none">
                                            <i class="fa-solid fa-angle-up me-1"></i> Top
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Why Our Services Matter / Impact Section -->
    <section class="py-5 bg-light border-top border-bottom">
        <div class="container py-lg-4">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6">
                    <span class="section-badge">Grassroots Model</span>
                    <h2 class="section-title">Direct Delivery Without Middlemen or Bureaucracy</h2>
                    <p class="text-muted mb-4">
                        Every single service provided by the Social Development Council is initiated through rigorous ground assessment by our verified field volunteers. We work hand-in-hand with village elders, local schools, Grama Niladhari administrative officers, and medical teams to ensure aid reaches those who truly need it most.
                    </p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="p-3 bg-white rounded-3 shadow-xs border">
                                <div class="fs-4 text-accent mb-1"><i class="fa-solid fa-certificate"></i></div>
                                <h6 class="fw-bold text-navy mb-1">100% Transparent Aid</h6>
                                <p class="text-muted small mb-0">Every donation, volunteer activity, and beneficiary is audited and published.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-white rounded-3 shadow-xs border">
                                <div class="fs-4 text-accent mb-1"><i class="fa-solid fa-people-carry-box"></i></div>
                                <h6 class="fw-bold text-navy mb-1">Community Driven</h6>
                                <p class="text-muted small mb-0">Local community members participate directly in planning and service execution.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="{{ asset('images/services/education.jpg') }}" alt="Community Aid" class="w-100 rounded-4 shadow-sm" style="max-height: 420px; object-fit: cover;">
                        <div class="position-absolute bottom-0 end-0 bg-navy text-white p-4 rounded-4 m-3 shadow-lg max-w-320">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <i class="fa-solid fa-hands-holding-circle text-accent fs-2"></i>
                                <div class="fw-bold fs-5">Serving 40+ Villages</div>
                            </div>
                            <p class="text-white-50 small mb-0">Across Ampara, Batticaloa, and Trincomalee in Eastern Sri Lanka.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Universal Interactive Action Modal with Admin Configured Image -->
    <div class="modal fade" id="serviceActionModal" tabindex="-1" aria-labelledby="serviceActionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
                <!-- Modal Top Header Bar -->
                <div class="modal-header border-0 bg-navy text-white px-4 py-3" style="background-color: #12345a;">
                    <div class="d-flex align-items-center gap-2">
                        <span id="serviceModalActionBadge" class="badge rounded-pill px-3 py-1 fw-bold"></span>
                        <h5 class="modal-title fw-bold text-white mb-0" id="serviceActionModalLabel">Action Details</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body with Admin-Managed Image Display -->
                <div class="modal-body p-0">
                    <div class="position-relative bg-dark text-center overflow-hidden" style="max-height: 340px;">
                        <img id="serviceModalActionImage" src="" alt="Action Visual" class="w-100" style="max-height: 340px; object-fit: cover; object-position: center;" onerror="this.src='https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=800&q=80'">
                        <div class="position-absolute bottom-0 start-0 p-3 w-100 text-start" style="background: linear-gradient(to top, rgba(0,0,0,0.85), transparent);">
                            <span class="text-white-50 small d-block"><i class="fa-solid fa-shield-heart text-accent me-1"></i> SDC Humanitarian Program</span>
                            <h4 id="serviceModalActionCaption" class="text-white fw-bold mb-0"></h4>
                        </div>
                    </div>

                    <div class="p-4 bg-white">
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="p-2 rounded-3 bg-light border text-navy fs-4">
                                <i class="fa-solid fa-circle-info text-blue"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-navy mb-1">Information & Guidance</h6>
                                <p id="serviceModalActionDesc" class="text-muted mb-0" style="line-height: 1.7; font-size: 0.98rem;"></p>
                            </div>
                        </div>

                        <!-- Embedded Assistance Request Form -->
                        <div id="serviceApplicationFormWrapper" class="d-none mt-4 pt-3 border-top">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="badge bg-primary text-white rounded-pill px-3 py-1">Assistance Form</div>
                                <h6 class="fw-bold text-navy mb-0">Submit Your Humanitarian Aid Request</h6>
                            </div>

                            <form action="{{ route('course.request.store') }}" method="POST" id="serviceApplicationForm">
                                @csrf
                                <input type="hidden" name="type" value="service">
                                <input type="hidden" name="course_title" id="formServiceTitle" value="">
                                <input type="hidden" name="service_id" id="formServiceRefId" value="">

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-navy mb-1">Full Name of Beneficiary / Applicant <span class="text-danger">*</span></label>
                                        <input type="text" name="full_name" class="form-control" required placeholder="e.g. S. Fathima" value="{{ Auth::check() ? Auth::user()->name : '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-navy mb-1">Contact Phone / WhatsApp <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" class="form-control" required placeholder="e.g. 077 123 4567" value="{{ Auth::check() ? Auth::user()->phone : '' }}">
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-navy mb-1">Email Address <span class="text-muted fw-normal">(Optional)</span></label>
                                        <input type="email" name="email" class="form-control" placeholder="e.g. contact@gmail.com" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-navy mb-1">District & Town / Village <span class="text-danger">*</span></label>
                                        <input type="text" name="district" class="form-control" required placeholder="e.g. Batticaloa / Eravur">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-navy mb-1">Details of Assistance Needed <span class="text-danger">*</span></label>
                                    <textarea name="message" class="form-control" rows="3" required placeholder="Please describe the emergency assistance, family situation, or required support..."></textarea>
                                </div>

                                <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                    <button type="button" class="btn btn-outline-secondary px-4 rounded-pill" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-teal px-4 rounded-pill fw-bold shadow-sm">
                                        <i class="fa-solid fa-paper-plane me-1"></i> Submit Assistance Request
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div id="serviceSupportPhoneAlert" class="alert alert-light border rounded-3 p-3 d-flex align-items-center justify-content-between flex-wrap gap-2 mt-3">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-phone text-accent"></i>
                                <span class="small fw-semibold text-navy">Need immediate help or want to speak with our field coordinator? Call +94 (0) 67 222 9180</span>
                            </div>
                            <span class="badge bg-success-subtle text-success fw-bold">SDC Support Desk</span>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-top bg-light px-4 py-3 d-flex justify-content-between" id="serviceModalStandardFooter">
                    <button type="button" class="btn btn-outline-secondary px-4 rounded-pill" data-bs-dismiss="modal">Close</button>
                    <a id="serviceModalActionBtn" href="#" class="btn btn-navy px-4 py-2 rounded-pill fw-bold">
                        <span>Continue</span> <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const serviceActionModal = document.getElementById('serviceActionModal');
            if (serviceActionModal) {
                serviceActionModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    if (!button) return;

                    const actionType = button.getAttribute('data-action-type') || '';
                    const title = button.getAttribute('data-title') || 'Service Action';
                    const badge = button.getAttribute('data-badge') || 'Action';
                    const badgeClass = button.getAttribute('data-badge-class') || 'bg-primary text-white';
                    const image = button.getAttribute('data-image');
                    const desc = button.getAttribute('data-desc') || '';
                    const link = button.getAttribute('data-link') || '#';
                    const btnText = button.getAttribute('data-btn-text') || 'Proceed';
                    const serviceName = button.getAttribute('data-service-name') || '';
                    const serviceId = button.getAttribute('data-service-id') || '';

                    document.getElementById('serviceActionModalLabel').textContent = title;
                    document.getElementById('serviceModalActionCaption').textContent = title;
                    
                    const badgeEl = document.getElementById('serviceModalActionBadge');
                    badgeEl.className = 'badge rounded-pill px-3 py-1 fw-bold ' + badgeClass;
                    badgeEl.textContent = badge;

                    const imgEl = document.getElementById('serviceModalActionImage');
                    if (image) {
                        imgEl.src = image;
                    }

                    document.getElementById('serviceModalActionDesc').textContent = desc;

                    const appFormWrapper = document.getElementById('serviceApplicationFormWrapper');
                    const standardFooter = document.getElementById('serviceModalStandardFooter');
                    const supportPhoneAlert = document.getElementById('serviceSupportPhoneAlert');

                    if (actionType === 'apply') {
                        // Show embedded Assistance Application Form
                        appFormWrapper.classList.remove('d-none');
                        standardFooter.classList.add('d-none');
                        supportPhoneAlert.classList.add('d-none');

                        document.getElementById('formServiceTitle').value = serviceName;
                        document.getElementById('formServiceRefId').value = serviceId;
                    } else {
                        // Standard CTA (Donate / Volunteer)
                        appFormWrapper.classList.add('d-none');
                        standardFooter.classList.remove('d-none');
                        supportPhoneAlert.classList.remove('d-none');

                        const actionBtn = document.getElementById('serviceModalActionBtn');
                        actionBtn.href = link;
                        actionBtn.innerHTML = `<span>${btnText}</span> <i class="fa-solid fa-arrow-right ms-1"></i>`;
                    }
                });
            }
        });
    </script>
    @endpush

@endsection
