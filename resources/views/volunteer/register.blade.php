@extends('layouts.app')

@section('title', 'Volunteer Application | Social Development Council (SDC)')
@section('meta_description', 'Apply to become a volunteer with the Social Development Council and contribute your skills to community healthcare, education, and disaster relief.')

@push('styles')
<style>
    .volunteer-card {
        background-color: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(11, 37, 104, 0.06);
    }

    .volunteer-photo-box {
        background: linear-gradient(135deg, #F8FAFC 0%, #EFF6FF 100%);
        border: 2px dashed #93C5FD;
        border-radius: 18px;
        padding: 24px;
        text-align: center;
        transition: all 0.25s ease;
        position: relative;
    }

    .volunteer-photo-box:hover,
    .volunteer-photo-box.drag-over {
        border-color: #0059FF;
        background: #EEF4FF;
    }

    .photo-preview-wrapper {
        width: 130px;
        height: 130px;
        margin: 0 auto 14px auto;
        position: relative;
        cursor: pointer;
    }

    .volunteer-avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #FFFFFF;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        background-color: #E2E8F0;
        transition: transform 0.2s ease;
    }

    .photo-preview-wrapper:hover .volunteer-avatar-img {
        transform: scale(1.03);
    }

    .photo-camera-badge {
        position: absolute;
        bottom: 2px;
        right: 4px;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #0059FF;
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        box-shadow: 0 4px 10px rgba(0, 89, 255, 0.35);
        border: 3px solid #FFFFFF;
        transition: all 0.2s ease;
    }

    .photo-preview-wrapper:hover .photo-camera-badge {
        transform: scale(1.1);
        background: #0B2568;
    }

    .form-section-title {
        font-size: 0.95rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #0059FF;
        border-bottom: 2px solid #EFF6FF;
        padding-bottom: 8px;
        margin-bottom: 16px;
    }

    /* Dark Mode Adjustments */
    [data-theme="dark"] .volunteer-card {
        background-color: #151F32 !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4) !important;
    }

    [data-theme="dark"] .volunteer-photo-box {
        background: #111A2C !important;
        border-color: rgba(56, 189, 248, 0.3) !important;
    }

    [data-theme="dark"] .volunteer-photo-box:hover,
    [data-theme="dark"] .volunteer-photo-box.drag-over {
        border-color: #38BDF8 !important;
        background: #1A2742 !important;
    }

    [data-theme="dark"] .volunteer-avatar-img {
        border-color: #1E293B !important;
    }

    [data-theme="dark"] .form-section-title {
        color: #38BDF8 !important;
        border-bottom-color: rgba(255, 255, 255, 0.08) !important;
    }
</style>
@endpush

@section('content')

    <!-- Banner -->
    <section class="page-header-banner">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.25); color: #93C5FD;">Hands of Compassion</span>
            <h1 class="display-4 fw-bold text-white mb-2">Volunteer Registration</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Volunteer Application</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Application Form & Information -->
    <section class="py-5 bg-light">
        <div class="container py-lg-4">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 p-4 mb-4 shadow-sm border-0 d-flex align-items-center gap-3" role="alert">
                    <i class="fa-solid fa-circle-check fs-2 text-success"></i>
                    <div>
                        <h5 class="fw-bold mb-1">Registration Submitted Successfully!</h5>
                        <p class="mb-0 small">{{ session('success') }}</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show rounded-4 p-3 mb-4 shadow-sm border-0" role="alert">
                    <div class="d-flex align-items-center gap-2 fw-bold mb-1">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>Please correct the errors below before submitting:</span>
                    </div>
                    <ul class="mb-0 small ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4 g-lg-5">
                <!-- Left Information Panel -->
                <div class="col-lg-4">
                    <span class="section-badge">Join the Frontlines</span>
                    <h2 class="section-title mb-3" style="font-size: 1.8rem;">Empower Communities with SDC</h2>
                    <p class="text-muted small mb-4" style="line-height: 1.7;">
                        SDC volunteers are the beating heart of our humanitarian work across Sri Lanka. Every volunteer makes an authentic, tangible difference in people's lives.
                    </p>

                    <div class="card border-0 bg-white p-4 rounded-4 mb-4 shadow-sm">
                        <h5 class="fw-bold text-navy mb-3 fs-6">Volunteer Benefits & Growth</h5>
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-3 small text-muted">
                            <li class="d-flex align-items-start gap-2">
                                <i class="fa-solid fa-circle-check text-primary mt-1"></i>
                                <span><strong>Hands-On Field Experience:</strong> Direct involvement in healthcare camps, educational tutoring, and emergency relief distribution.</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <i class="fa-solid fa-circle-check text-primary mt-1"></i>
                                <span><strong>Official Recognition:</strong> Verified Certificate of Volunteering issued upon project completion.</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <i class="fa-solid fa-circle-check text-primary mt-1"></i>
                                <span><strong>Skill Development:</strong> Leadership training, professional networking, and emergency response capabilities.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Quick Contact Support Box -->
                    <div class="card border-0 p-4 rounded-4 text-white shadow-sm" style="background: linear-gradient(135deg, #071744 0%, #0059FF 100%);">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-headset fs-5"></i>
                            <h6 class="fw-bold mb-0">Coordination Desk</h6>
                        </div>
                        <p class="small text-white-50 mb-3">Have questions about volunteer commitments or regional requirements?</p>
                        <div class="d-flex flex-column gap-2 small">
                            <a href="tel:+94672229180" class="text-white text-decoration-none d-flex align-items-center gap-2">
                                <i class="fa-solid fa-phone"></i> +94 (0) 67 222 9180
                            </a>
                            <a href="mailto:info@sdcmksl.org" class="text-white text-decoration-none d-flex align-items-center gap-2">
                                <i class="fa-solid fa-envelope"></i> info@sdcmksl.org
                            </a>
                        </div>
                    </div>

                    <!-- Application Tracking for Logged-In Users -->
                    @auth
                        @if(isset($userApplications) && $userApplications->count() > 0)
                            <div class="card border rounded-4 shadow-sm p-4 mt-4 bg-white">
                                <h5 class="fw-bold text-navy mb-3 fs-6"><i class="fa-solid fa-clock-rotate-left text-primary me-2"></i> Your Submitted Applications</h5>
                                <div class="d-flex flex-column gap-2">
                                    @foreach($userApplications as $app)
                                        <div class="p-3 bg-light rounded-3 border">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <strong class="text-navy small">{{ $app->full_name }}</strong>
                                                @php
                                                    $stBadge = match($app->status) {
                                                        'approved' => 'bg-success',
                                                        'under_review' => 'bg-info text-white',
                                                        'rejected' => 'bg-danger',
                                                        default => 'bg-warning text-dark'
                                                    };
                                                @endphp
                                                <span class="badge {{ $stBadge }} text-capitalize" style="font-size: 0.7rem;">{{ str_replace('_', ' ', $app->status) }}</span>
                                            </div>
                                            <div class="small text-muted" style="font-size: 0.75rem;">NIC: {{ $app->nic_no ?? 'N/A' }} • {{ $app->created_at->format('M d, Y') }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>

                <!-- Right Application Form -->
                <div class="col-lg-8">
                    <div class="volunteer-card p-4 p-md-5">
                        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                            <div>
                                <h3 class="fw-bold text-navy mb-1">Volunteer Application Form</h3>
                                <p class="text-muted small mb-0">Please fill out your official particulars accurately so our coordinator committee can review and verify your profile.</p>
                            </div>
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold">
                                <i class="fa-solid fa-shield-halved me-1"></i> Verified Intake
                            </span>
                        </div>

                        <form action="{{ route('volunteer.store') }}" method="POST" enctype="multipart/form-data" id="volunteerForm">
                            @csrf

                            <!-- =========================================================================
                                 1. VOLUNTEER PHOTO BOX (Choose from Files / Live Preview)
                                 ========================================================================= -->
                            <div class="volunteer-photo-box mb-4" id="photoDropZone">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center">
                                        <div class="photo-preview-wrapper" id="photoPreviewTrigger" title="Click to choose a photo from your files">
                                            <img id="volunteerPhotoPreview" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Volunteer') }}&background=E2E8F0&color=0059FF&size=200&bold=true" alt="Volunteer Photo Preview" class="volunteer-avatar-img">
                                            <div class="photo-camera-badge" title="Choose Photo">
                                                <i class="fa-solid fa-camera"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 text-center text-md-start">
                                        <h6 class="fw-bold text-navy mb-1">
                                            <i class="fa-solid fa-image text-primary me-1"></i> Volunteer Profile Photo
                                        </h6>
                                        <p class="text-muted small mb-3" style="font-size: 0.82rem;">
                                            Upload a clear, front-facing passport-style portrait photo. This image will be printed on your official Volunteer ID card.
                                        </p>
                                        <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 flex-wrap">
                                            <label for="photoFileInput" class="btn btn-primary btn-sm rounded-pill px-4 py-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm cursor-pointer">
                                                <i class="fa-solid fa-folder-open"></i> Choose Photo from Files
                                            </label>
                                            <input type="file" id="photoFileInput" name="photo_file" accept="image/png,image/jpeg,image/jpg,image/webp" class="d-none">
                                            
                                            <button type="button" id="removePhotoBtn" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-2 d-none">
                                                <i class="fa-solid fa-trash-can me-1"></i> Remove
                                            </button>
                                        </div>
                                        <div class="small text-muted mt-2" style="font-size: 0.74rem;">
                                            <span class="text-muted">Allowed formats: JPG, PNG, WEBP • Max Size: 5MB</span>
                                            <div id="selectedFileName" class="text-primary fw-semibold mt-1 d-none"></div>
                                        </div>
                                        @error('photo_file')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- =========================================================================
                                 2. PERSONAL & IDENTIFICATION DETAILS
                                 ========================================================================= -->
                            <div class="form-section-title">
                                <i class="fa-solid fa-user me-2"></i> 1. Personal & Contact Particulars
                            </div>

                            <div class="row g-3 mb-4">
                                <!-- Full Name -->
                                <div class="col-md-6">
                                    <label for="full_name" class="form-label fw-semibold text-navy small">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-custom @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', Auth::user()->name ?? '') }}" placeholder="e.g. Mohamed Rishan" required>
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- NIC No -->
                                <div class="col-md-6">
                                    <label for="nic_no" class="form-label fw-semibold text-navy small">NIC No (National Identity Card) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-custom @error('nic_no') is-invalid @enderror" id="nic_no" name="nic_no" value="{{ old('nic_no') }}" placeholder="e.g. 199812345678 or 981234567V" required>
                                    @error('nic_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Date of Birth -->
                                <div class="col-md-6">
                                    <label for="date_of_birth" class="form-label fw-semibold text-navy small">Date of Birth <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control form-control-custom @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" max="{{ date('Y-m-d') }}" required>
                                    @error('date_of_birth')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Age (Auto-calculated from DOB) -->
                                <div class="col-md-6">
                                    <label for="age" class="form-label fw-semibold text-navy small">Age (Years) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-custom @error('age') is-invalid @enderror" id="age" name="age" value="{{ old('age') }}" min="14" max="100" placeholder="Auto-calculated from DOB" required>
                                        <span class="input-group-text bg-light text-muted small">Yrs</span>
                                    </div>
                                    @error('age')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Phone / WhatsApp Number -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-semibold text-navy small">Phone / WhatsApp Number <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted small"><i class="fa-solid fa-phone"></i></span>
                                        <input type="tel" class="form-control form-control-custom @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+94 77 123 4567" required>
                                    </div>
                                    @error('phone')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email Address -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold text-navy small">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-muted small"><i class="fa-solid fa-envelope"></i></span>
                                        <input type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}" placeholder="volunteer@example.com">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="col-12">
                                    <label for="address" class="form-label fw-semibold text-navy small">Permanent Residential Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control form-control-custom @error('address') is-invalid @enderror" id="address" name="address" rows="2" placeholder="House No, Street Name, Village/City, District" required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- =========================================================================
                                 3. QUALIFICATIONS & OCCUPATION
                                 ========================================================================= -->
                            <div class="form-section-title">
                                <i class="fa-solid fa-graduation-cap me-2"></i> 2. Professional & Academic Qualifications
                            </div>

                            <div class="row g-3 mb-4">
                                <!-- Education Qualification -->
                                <div class="col-md-6">
                                    <label for="education_qualification" class="form-label fw-semibold text-navy small">Education Qualification <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-custom @error('education_qualification') is-invalid @enderror" id="education_qualification" name="education_qualification" required>
                                        <option value="">Select highest qualification...</option>
                                        <option value="G.C.E. Ordinary Level (O/L)" {{ old('education_qualification') == 'G.C.E. Ordinary Level (O/L)' ? 'selected' : '' }}>G.C.E. Ordinary Level (O/L)</option>
                                        <option value="G.C.E. Advanced Level (A/L)" {{ old('education_qualification') == 'G.C.E. Advanced Level (A/L)' ? 'selected' : '' }}>G.C.E. Advanced Level (A/L)</option>
                                        <option value="Higher National Diploma (HND) / NVQ 4/5" {{ old('education_qualification') == 'Higher National Diploma (HND) / NVQ 4/5' ? 'selected' : '' }}>Higher National Diploma (HND) / NVQ 4/5</option>
                                        <option value="Bachelor's Degree (Undergraduate)" {{ old('education_qualification') == "Bachelor's Degree (Undergraduate)" ? 'selected' : '' }}>Bachelor's Degree (Undergraduate)</option>
                                        <option value="Bachelor's Degree (Graduate)" {{ old('education_qualification') == "Bachelor's Degree (Graduate)" ? 'selected' : '' }}>Bachelor's Degree (Graduate)</option>
                                        <option value="Postgraduate Diploma / Master's Degree" {{ old('education_qualification') == "Postgraduate Diploma / Master's Degree" ? 'selected' : '' }}>Postgraduate Diploma / Master's Degree</option>
                                        <option value="Doctorate (Ph.D.)" {{ old('education_qualification') == 'Doctorate (Ph.D.)' ? 'selected' : '' }}>Doctorate (Ph.D.)</option>
                                        <option value="Other Technical / Vocational" {{ old('education_qualification') == 'Other Technical / Vocational' ? 'selected' : '' }}>Other Technical / Vocational</option>
                                    </select>
                                    @error('education_qualification')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Occupation -->
                                <div class="col-md-6">
                                    <label for="occupation" class="form-label fw-semibold text-navy small">Current Occupation <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-custom @error('occupation') is-invalid @enderror" id="occupation" name="occupation" value="{{ old('occupation') }}" placeholder="e.g. Teacher, Nurse, IT Engineer, Student, Entrepreneur" required>
                                    @error('occupation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Other Qualification -->
                                <div class="col-12">
                                    <label for="other_qualification" class="form-label fw-semibold text-navy small">Other Qualifications & Professional Certifications</label>
                                    <textarea class="form-control form-control-custom @error('other_qualification') is-invalid @enderror" id="other_qualification" name="other_qualification" rows="2" placeholder="e.g. First Aid & CPR Training, Certified Translator (English/Tamil/Sinhala), Counseling, Photography, Heavy Vehicle Driving License">{{ old('other_qualification') }}</textarea>
                                    <small class="text-muted" style="font-size: 0.76rem;">List any extracurricular courses, diplomas, technical skills or language proficiencies.</small>
                                    @error('other_qualification')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- =========================================================================
                                 4. VOLUNTEER ROLE PREFERENCE & AVAILABILITY
                                 ========================================================================= -->
                            <div class="form-section-title">
                                <i class="fa-solid fa-hand-holding-heart me-2"></i> 3. Role Preferences & Availability
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="area_of_interest" class="form-label fw-semibold text-navy small">Primary Area of Interest</label>
                                    <select class="form-select form-select-custom @error('area_of_interest') is-invalid @enderror" id="area_of_interest" name="area_of_interest">
                                        @if(request('interest'))
                                            <option value="{{ request('interest') }}" selected>{{ request('interest') }}</option>
                                        @endif
                                        <option value="General Community Support" {{ old('area_of_interest') == 'General Community Support' ? 'selected' : '' }}>General Community Support</option>
                                        <option value="Community Healthcare & Medical Camps" {{ old('area_of_interest') == 'Community Healthcare & Medical Camps' ? 'selected' : '' }}>Community Healthcare & Medical Camps</option>
                                        <option value="Education, Tutoring & Youth Mentorship" {{ old('area_of_interest') == 'Education, Tutoring & Youth Mentorship' ? 'selected' : '' }}>Education, Tutoring & Youth Mentorship</option>
                                        <option value="Disaster Relief Logistics & Field Distribution" {{ old('area_of_interest') == 'Disaster Relief Logistics & Field Distribution' ? 'selected' : '' }}>Disaster Relief Logistics & Field Distribution</option>
                                        <option value="Clean Water & Infrastructure Engineering" {{ old('area_of_interest') == 'Clean Water & Infrastructure Engineering' ? 'selected' : '' }}>Clean Water & Infrastructure Engineering</option>
                                        <option value="Digital Media, Photography & Translation" {{ old('area_of_interest') == 'Digital Media, Photography & Translation' ? 'selected' : '' }}>Digital Media, Photography & Translation</option>
                                    </select>
                                    @error('area_of_interest')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="availability" class="form-label fw-semibold text-navy small">Availability</label>
                                    <select class="form-select form-select-custom @error('availability') is-invalid @enderror" id="availability" name="availability">
                                        <option value="Weekends Only" {{ old('availability') == 'Weekends Only' ? 'selected' : '' }}>Weekends Only</option>
                                        <option value="Full-Time (Daily)" {{ old('availability') == 'Full-Time (Daily)' ? 'selected' : '' }}>Full-Time (Daily)</option>
                                        <option value="Part-Time (10-15 hrs/week)" {{ old('availability') == 'Part-Time (10-15 hrs/week)' ? 'selected' : '' }}>Part-Time (10-15 hrs/week)</option>
                                        <option value="Emergency On-Call Relief" {{ old('availability') == 'Emergency On-Call Relief' ? 'selected' : '' }}>Emergency On-Call Relief</option>
                                    </select>
                                    @error('availability')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="introduction" class="form-label fw-semibold text-navy small">Applicant Remarks / Personal Motivation</label>
                                    <textarea class="form-control form-control-custom @error('introduction') is-invalid @enderror" id="introduction" name="introduction" rows="3" placeholder="Tell us briefly about why you are passionate about joining SDC charity initiatives...">{{ old('introduction') }}</textarea>
                                    @error('introduction')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-4 pt-2 border-top">
                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill py-3 fw-bold d-flex align-items-center justify-content-center gap-2 shadow" style="font-size: 1.05rem;">
                                    <i class="fa-solid fa-paper-plane"></i> Submit Volunteer Registration
                                </button>
                                <div class="text-center mt-2">
                                    <small class="text-muted" style="font-size: 0.78rem;">
                                        <i class="fa-solid fa-lock me-1 text-success"></i> Your personal data and NIC details are protected under SDC Privacy & Security Charter.
                                    </small>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const photoInput = document.getElementById('photoFileInput');
        const photoPreview = document.getElementById('volunteerPhotoPreview');
        const photoTrigger = document.getElementById('photoPreviewTrigger');
        const dropZone = document.getElementById('photoDropZone');
        const removeBtn = document.getElementById('removePhotoBtn');
        const fileNameEl = document.getElementById('selectedFileName');
        const defaultAvatar = "{{ 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'Volunteer') . '&background=E2E8F0&color=0059FF&size=200&bold=true' }}";

        // Click trigger on photo avatar opens file picker
        if (photoTrigger && photoInput) {
            photoTrigger.addEventListener('click', function () {
                photoInput.click();
            });
        }

        // When user selects a file from file picker
        if (photoInput) {
            photoInput.addEventListener('change', function () {
                handleFileSelect(this.files[0]);
            });
        }

        // Remove photo handler
        if (removeBtn) {
            removeBtn.addEventListener('click', function () {
                photoInput.value = '';
                photoPreview.src = defaultAvatar;
                removeBtn.classList.add('d-none');
                fileNameEl.classList.add('d-none');
                fileNameEl.textContent = '';
            });
        }

        // Drag and drop handlers
        if (dropZone) {
            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropZone.classList.add('drag-over');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropZone.classList.remove('drag-over');
                }, false);
            });

            dropZone.addEventListener('drop', function (e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files && files.length > 0) {
                    photoInput.files = files;
                    handleFileSelect(files[0]);
                }
            }, false);
        }

        function handleFileSelect(file) {
            if (!file) return;

            // Check file type
            if (!file.type.match('image.*')) {
                alert('Please choose an image file (PNG, JPG, JPEG, WEBP).');
                photoInput.value = '';
                return;
            }

            // Check file size (5MB limit)
            if (file.size > 5 * 1024 * 1024) {
                alert('The selected image is larger than 5MB. Please choose a smaller image.');
                photoInput.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                photoPreview.src = e.target.result;
                if (removeBtn) removeBtn.classList.remove('d-none');
                if (fileNameEl) {
                    fileNameEl.textContent = 'Selected: ' + file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
                    fileNameEl.classList.remove('d-none');
                }
            };
            reader.readAsDataURL(file);
        }

        // =====================================================================
        // Automatic Age Calculator from Date of Birth
        // =====================================================================
        const dobInput = document.getElementById('date_of_birth');
        const ageInput = document.getElementById('age');

        if (dobInput && ageInput) {
            dobInput.addEventListener('change', function () {
                const dobVal = this.value;
                if (!dobVal) return;

                const dob = new Date(dobVal);
                const today = new Date();
                let age = today.getFullYear() - dob.getFullYear();
                const m = today.getMonth() - dob.getMonth();

                if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                    age--;
                }

                if (age >= 10 && age <= 120) {
                    ageInput.value = age;
                }
            });
        }
    });
</script>
@endpush
