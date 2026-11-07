@extends('layouts.app')

@section('title', 'Vocational Courses & Free Seminars | SDC Sri Lanka')
@section('meta_description', 'Empowering youth and community members through free seminars for school students, tailoring & sewing, IT certificate, IT diploma, cooking, and English diploma courses.')

@section('content')

    <!-- Hero Page Header Banner -->
    <section class="page-header-banner" style="background: linear-gradient(135deg, #0f2b48 0%, #1e4a7a 50%, #12345a 100%);">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(99, 102, 241, 0.25); color: #C7D2FE; letter-spacing: 0.05em;">
                <i class="fa-solid fa-graduation-cap me-1"></i> Skills Development & Education
            </span>
            <h1 class="display-4 fw-bold text-white mb-2">Vocational Courses & Free Seminars</h1>
            <p class="text-white-50 mx-auto mb-3" style="max-width: 720px; font-size: 1.1rem;">
                Empowering school students, women, and ambitious youth with career-defining skills, recognized diplomas, and 100% free community training.
            </p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('services.index') }}" class="text-white-50">Services</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Courses</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Jump Selector Pills -->
    <section class="py-3 bg-white border-bottom shadow-sm sticky-top" style="top: 72px; z-index: 990;">
        <div class="container">
            <div class="d-flex align-items-center justify-content-start justify-content-lg-center gap-2 overflow-x-auto py-1 service-nav-pills text-nowrap">
                <span class="text-muted small fw-semibold me-2 d-none d-md-inline"><i class="fa-solid fa-arrow-down-short-wide me-1"></i> Quick Jump:</span>
                @foreach($courses as $c)
                    <a href="#{{ $c->slug }}" class="btn btn-sm btn-outline-navy rounded-pill px-3 py-1 service-pill-link">
                        <i class="{{ $c->icon ?? 'fa-solid fa-graduation-cap' }} me-1" style="color: {{ $c->accent_color ?? '#2563EB' }};"></i> {{ $c->short_title ?? $c->title }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Courses Grid & Detail Section -->
    <section class="py-5 bg-light">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 d-flex align-items-center gap-3 p-3 mb-4" role="alert">
                    <div class="p-2 bg-success text-white rounded-circle fs-5 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; flex-shrink: 0;">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-0 text-success">Application Received Successfully!</h6>
                        <div class="small text-dark">{{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="text-center max-w-750 mx-auto mb-5">
                <span class="badge bg-primary-subtle text-primary px-3 py-1 rounded-pill fw-bold text-uppercase mb-2">Our 6 Core Courses</span>
                <h2 class="fw-bold text-navy mb-3" style="font-size: 2.25rem;">Practical Education That Transforms Futures</h2>
                <p class="text-muted fs-6">
                    Each course is specifically curated to meet regional job market demands, support school curriculum success, and enable sustainable home-based self-employment.
                </p>
            </div>

            <!-- Course Cards Stack -->
            <div class="d-flex flex-column gap-5">
                @foreach($courses as $index => $course)
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white service-detail-card" id="{{ $course->slug }}">
                        <div class="row g-0 align-items-stretch {{ $index % 2 == 1 ? 'flex-lg-row-reverse' : '' }}">
                            
                            <!-- Course Image Column -->
                            <a href="{{ route('services.show', $course->slug) }}" class="col-lg-5 position-relative service-img-col d-block text-decoration-none" style="min-height: 360px;" title="View {{ $course->title }} Details, Curriculum & Servicing Options">
                                <img src="{{ asset($course->image) }}" alt="{{ $course->title }}" class="w-100 h-100 service-featured-img" style="object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80'">
                                <div class="service-img-overlay">
                                    <span class="badge px-3 py-2 rounded-pill fw-bold shadow-sm" style="background-color: {{ $course->accent_color ?? '#2563EB' }}; color: #fff;">
                                        <i class="{{ $course->icon ?? 'fa-solid fa-graduation-cap' }} me-1"></i> {{ $course->category }}
                                    </span>
                                </div>
                            </a>

                            <!-- Course Content Column -->
                            <div class="col-lg-7 p-4 p-md-5 d-flex flex-column justify-content-between bg-white">
                                <div>
                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                                        <span class="text-uppercase fw-bold small" style="color: {{ $course->accent_color ?? '#2563EB' }}; letter-spacing: 0.05em;">
                                            Course {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }} • {{ $course->category }}
                                        </span>
                                        <div class="d-flex gap-2">
                                            @if($course->course_duration)
                                                <span class="badge bg-light text-navy px-3 py-1 rounded-pill small fw-semibold border">
                                                    <i class="fa-solid fa-clock text-accent me-1"></i> {{ $course->course_duration }}
                                                </span>
                                            @endif
                                            @if($course->impact)
                                                <span class="badge bg-soft-blue text-navy px-3 py-1 rounded-pill small fw-semibold">
                                                    <i class="fa-solid fa-users text-accent me-1"></i> {{ $course->impact }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <h3 class="fw-bold text-navy mb-3 display-6" style="font-size: 1.85rem;">
                                        <a href="{{ route('services.show', $course->slug) }}" class="text-navy text-decoration-none hover-primary">{{ $course->title }}</a>
                                    </h3>
                                    
                                    <p class="lead text-secondary fs-6 mb-3 fw-medium">
                                        {{ $course->summary }}
                                    </p>

                                    <p class="text-muted mb-4" style="line-height: 1.7; font-size: 0.95rem;">
                                        {{ $course->description }}
                                    </p>

                                    <!-- Key Course Modules / Highlights -->
                                    @if(!empty($course->highlights))
                                        <div class="mb-4">
                                            <h6 class="fw-bold text-navy text-uppercase small mb-3" style="letter-spacing: 0.05em;">
                                                <i class="fa-solid fa-list-check text-primary me-1"></i> Curriculum & Course Highlights:
                                            </h6>
                                            <div class="row g-2">
                                                @foreach($course->highlights as $hl)
                                                    <div class="col-sm-6">
                                                        <div class="d-flex align-items-center gap-2 p-2 rounded-3 bg-light border border-light">
                                                            <i class="fa-solid fa-check text-blue small"></i>
                                                            <span class="small fw-semibold text-dark">{{ $hl }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Action Buttons (Support, Request Assistance / Apply, Provide Servicing) -->
                                <div class="pt-3 border-top mt-3">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                        <div class="d-flex flex-wrap align-items-center gap-2">
                                            <!-- Button 1: Support -->
                                            <button type="button" class="btn btn-navy px-3 py-2 btn-action-trigger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#actionModal"
                                                data-action-type="Support"
                                                data-action-title="Support {{ $course->title }}"
                                                data-action-badge="Support This Course"
                                                data-action-badge-class="bg-danger text-white"
                                                data-action-image="{{ asset($course->support_image ?: $course->image) }}"
                                                data-action-desc="{{ $course->support_details ?: 'Help us sponsor course kits, training computers, sewing machines, and examination certificates for students.' }}"
                                                data-action-link="{{ route('donate') }}"
                                                data-action-btn-text="Proceed to Donate / Sponsor">
                                                <i class="fa-solid fa-heart text-danger me-1"></i> Support This Service
                                            </button>

                                            <!-- Button 2: Request Assistance / Apply -->
                                            <button type="button" class="btn btn-outline-navy px-3 py-2 btn-action-trigger" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#actionModal"
                                                data-action-type="apply"
                                                data-course-name="{{ $course->title }}"
                                                data-service-id="{{ $course->id }}"
                                                data-action-title="Apply for Enrollment: {{ $course->title }}"
                                                data-action-badge="Course Admission / Assistance"
                                                data-action-badge-class="bg-primary text-white"
                                                data-action-image="{{ asset($course->request_image ?: $course->image) }}"
                                                data-action-desc="{{ $course->request_details ?: 'Complete this enrollment form to request admission, subsidized course kits, and recognized certification.' }}">
                                                <i class="fa-solid fa-graduation-cap text-primary me-1"></i> Request Assistance
                                            </button>

                                            <!-- Button 3: Provided Servicing (Navigates to Dedicated Servicing Showcase Page) -->
                                            <a href="{{ route('services.show', $course->slug) }}#provide-servicing" class="btn btn-outline-primary px-3 py-2 fw-semibold d-inline-flex align-items-center gap-1" title="View details, syllabus, and provided servicing for {{ $course->title }}">
                                                <i class="fa-solid fa-handshake-angle text-primary me-1"></i>
                                                <span>Provided Servicing</span>
                                                <i class="fa-solid fa-arrow-right small ms-1"></i>
                                            </a>
                                        </div>

                                        <a href="#main-content" class="text-muted small text-decoration-none">
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

    <!-- Universal Interactive Action Modal with Admin Configured Image -->
    <div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
                <!-- Modal Top Header Bar -->
                <div class="modal-header border-0 bg-navy text-white px-4 py-3" style="background-color: #12345a;">
                    <div class="d-flex align-items-center gap-2">
                        <span id="modalActionBadge" class="badge rounded-pill px-3 py-1 fw-bold"></span>
                        <h5 class="modal-title fw-bold text-white mb-0" id="actionModalLabel">Action Details</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body with Admin-Managed Image Display -->
                <div class="modal-body p-0">
                    <div class="position-relative bg-dark text-center overflow-hidden" style="max-height: 340px;">
                        <img id="modalActionImage" src="" alt="Action Visual" class="w-100" style="max-height: 340px; object-fit: cover; object-position: center;" onerror="this.src='https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=800&q=80'">
                        <div class="position-absolute bottom-0 start-0 p-3 w-100 text-start" style="background: linear-gradient(to top, rgba(0,0,0,0.85), transparent);">
                            <span class="text-white-50 small d-block"><i class="fa-solid fa-shield-heart text-accent me-1"></i> SDC Humanitarian Verified Initiative</span>
                            <h4 id="modalActionImageCaption" class="text-white fw-bold mb-0"></h4>
                        </div>
                    </div>

                    <div class="p-4 bg-white">
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="p-2 rounded-3 bg-light border text-navy fs-4">
                                <i class="fa-solid fa-circle-info text-blue"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-navy mb-1">Details & Guidelines</h6>
                                <p id="modalActionDesc" class="text-muted mb-0" style="line-height: 1.7; font-size: 0.98rem;"></p>
                            </div>
                        </div>

                        <!-- Direct Application Form for Course Enrollment -->
                        <div id="courseApplicationFormWrapper" class="d-none mt-4 pt-3 border-top">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="badge bg-primary text-white rounded-pill px-3 py-1">Admission Form</div>
                                <h6 class="fw-bold text-navy mb-0">Apply to Enroll in this Course</h6>
                            </div>

                            <form action="{{ route('course.request.store') }}" method="POST" id="courseApplicationForm">
                                @csrf
                                <input type="hidden" name="type" value="course">
                                <input type="hidden" name="course_title" id="formCourseTitle" value="">
                                <input type="hidden" name="service_id" id="formServiceId" value="">

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-navy mb-1">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="full_name" class="form-control" required placeholder="e.g. Mohammed Farhan" value="{{ Auth::check() ? Auth::user()->name : '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-navy mb-1">Contact Phone / WhatsApp <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" class="form-control" required placeholder="e.g. 077 123 4567" value="{{ Auth::check() ? Auth::user()->phone : '' }}">
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-navy mb-1">Email Address <span class="text-muted fw-normal">(Optional)</span></label>
                                        <input type="email" name="email" class="form-control" placeholder="e.g. farhan@gmail.com" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-navy mb-1">District / City <span class="text-danger">*</span></label>
                                        <input type="text" name="district" class="form-control" required placeholder="e.g. Ampara / Kalmunai">
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-navy mb-1">Current Education Level</label>
                                        <select name="education_level" class="form-select">
                                            <option value="School Student">School Student (Grade 9 - 13)</option>
                                            <option value="O/L Completed">G.C.E. O/L Completed</option>
                                            <option value="A/L Completed">G.C.E. A/L Completed</option>
                                            <option value="Undergraduate / Diploma">Undergraduate / Diploma</option>
                                            <option value="Job Seeker">Job Seeker / Youth</option>
                                            <option value="Homemaker / Self-employed">Homemaker / Self-employed</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-navy mb-1">Preferred Timing</label>
                                        <select name="preferred_schedule" class="form-select">
                                            <option value="Flexible">Flexible (Any Batch)</option>
                                            <option value="Weekend (Sat / Sun)">Weekend (Saturday / Sunday)</option>
                                            <option value="Weekday Morning">Weekday Morning</option>
                                            <option value="Weekday Afternoon / Evening">Weekday Afternoon / Evening</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-navy mb-1">Message / Questions <span class="text-muted fw-normal">(Optional)</span></label>
                                    <textarea name="message" class="form-control" rows="2" placeholder="Tell us if you need free certificate sponsorship, equipment support, or have any special questions..."></textarea>
                                </div>

                                <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                    <button type="button" class="btn btn-outline-secondary px-4 rounded-pill" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-teal px-4 rounded-pill fw-bold shadow-sm">
                                        <i class="fa-solid fa-paper-plane me-1"></i> Submit Course Application
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div id="modalSupportPhoneAlert" class="alert alert-light border rounded-3 p-3 d-flex align-items-center justify-content-between flex-wrap gap-2 mt-3">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-phone text-accent"></i>
                                <span class="small fw-semibold text-navy">Need immediate phone assistance? Call +94 (0) 67 222 9180</span>
                            </div>
                            <span class="badge bg-success-subtle text-success fw-bold">Live Support Active</span>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer (Shown for Support & Servicing CTAs) -->
                <div class="modal-footer border-top bg-light px-4 py-3 d-flex justify-content-between" id="modalStandardFooter">
                    <button type="button" class="btn btn-outline-secondary px-4 rounded-pill" data-bs-dismiss="modal">Close</button>
                    <a id="modalActionBtn" href="#" class="btn btn-navy px-4 py-2 rounded-pill fw-bold">
                        <span>Continue</span> <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const actionModal = document.getElementById('actionModal');
            if (actionModal) {
                actionModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    if (!button) return;

                    const actionType = button.getAttribute('data-action-type') || '';
                    const title = button.getAttribute('data-action-title') || 'Action Information';
                    const badge = button.getAttribute('data-action-badge') || 'SDC Action';
                    const badgeClass = button.getAttribute('data-action-badge-class') || 'bg-primary text-white';
                    const image = button.getAttribute('data-action-image');
                    const desc = button.getAttribute('data-action-desc') || '';
                    const link = button.getAttribute('data-action-link') || '#';
                    const btnText = button.getAttribute('data-action-btn-text') || 'Proceed';
                    const courseName = button.getAttribute('data-course-name') || '';
                    const serviceId = button.getAttribute('data-service-id') || '';

                    document.getElementById('actionModalLabel').textContent = title;
                    document.getElementById('modalActionImageCaption').textContent = title;
                    
                    const badgeEl = document.getElementById('modalActionBadge');
                    badgeEl.className = 'badge rounded-pill px-3 py-1 fw-bold ' + badgeClass;
                    badgeEl.textContent = badge;

                    const imgEl = document.getElementById('modalActionImage');
                    if (image) {
                        imgEl.src = image;
                    }

                    document.getElementById('modalActionDesc').textContent = desc;

                    const appFormWrapper = document.getElementById('courseApplicationFormWrapper');
                    const standardFooter = document.getElementById('modalStandardFooter');
                    const supportPhoneAlert = document.getElementById('modalSupportPhoneAlert');

                    if (actionType === 'apply') {
                        // Show Enrollment Form
                        appFormWrapper.classList.remove('d-none');
                        standardFooter.classList.add('d-none');
                        supportPhoneAlert.classList.add('d-none');

                        document.getElementById('formCourseTitle').value = courseName;
                        document.getElementById('formServiceId').value = serviceId;
                    } else {
                        // Standard CTA (Donate / Volunteer)
                        appFormWrapper.classList.add('d-none');
                        standardFooter.classList.remove('d-none');
                        supportPhoneAlert.classList.remove('d-none');

                        const actionBtn = document.getElementById('modalActionBtn');
                        actionBtn.href = link;
                        actionBtn.innerHTML = `<span>${btnText}</span> <i class="fa-solid fa-arrow-right ms-1"></i>`;
                    }
                });
            }
        });
    </script>
    @endpush

@endsection
