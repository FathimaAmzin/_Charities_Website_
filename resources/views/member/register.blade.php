@extends('layouts.app')

@section('title', 'Membership Application | Social Development Council (SDC)')
@section('meta_description', 'Apply to become an official member of the Social Development Council (SDC) Sri Lanka. Join hands to lead, govern, and champion sustainable community development.')

@push('styles')
<style>
    .member-card {
        background-color: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(11, 37, 104, 0.06);
    }

    .member-photo-box {
        background: linear-gradient(135deg, #F8FAFC 0%, #EFF6FF 100%);
        border: 2px dashed #93C5FD;
        border-radius: 18px;
        padding: 24px;
        text-align: center;
        transition: all 0.25s ease;
        position: relative;
    }

    .member-photo-box:hover,
    .member-photo-box.drag-over {
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

    .member-avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #FFFFFF;
        box-shadow: 0 6px 18px rgba(0, 89, 255, 0.15);
        background-color: #E2E8F0;
        transition: transform 0.2s ease;
    }

    .photo-preview-wrapper:hover .member-avatar-img {
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
    [data-theme="dark"] .member-card {
        background-color: #151F32 !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4) !important;
    }

    [data-theme="dark"] .member-photo-box {
        background: #111A2C !important;
        border-color: rgba(56, 189, 248, 0.3) !important;
    }

    [data-theme="dark"] .member-photo-box:hover,
    [data-theme="dark"] .member-photo-box.drag-over {
        border-color: #38BDF8 !important;
        background: #16243A !important;
    }

    [data-theme="dark"] .member-avatar-img {
        border-color: #1E293B !important;
    }

    [data-theme="dark"] .form-section-title {
        color: #38BDF8 !important;
        border-bottom-color: rgba(255, 255, 255, 0.08) !important;
    }
</style>
@endpush

@section('content')

    <!-- Banner (Royal Blue / Navy Gradient) -->
    <section class="page-header-banner" style="background: linear-gradient(135deg, #071744 0%, #0B2568 50%, #0059FF 100%);">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold shadow-sm" style="background-color: rgba(56, 189, 248, 0.25); color: #7DD3FC; letter-spacing: 0.05em;">
                <i class="fa-solid fa-users me-1"></i> Council Fellowship
            </span>
            <h1 class="display-4 fw-bold text-white mb-2">SDC Membership Registration</h1>
            <p class="text-white-50 mx-auto mb-3" style="max-width: 680px; font-size: 1.05rem;">
                Become an accredited member of the Social Development Council. Contribute your voice, leadership, and expertise to our council missions.
            </p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Membership Application</li>
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
                        <h5 class="fw-bold mb-1">Application Submitted Successfully!</h5>
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
                    <span class="section-badge" style="background-color: #EFF6FF; color: #0059FF; border-color: #BFDBFE;">Official Council Member</span>
                    <h2 class="section-title mb-3" style="font-size: 1.8rem;">Shape the Future with SDC Leadership</h2>
                    <p class="text-muted small mb-4" style="line-height: 1.7;">
                        SDC members form our voting body, executive leadership committees, advisory councils, and regional initiative trustees.
                    </p>

                    <div class="card border-0 bg-white p-4 rounded-4 mb-4 shadow-sm">
                        <h5 class="fw-bold text-navy mb-3 fs-6">Privileges of Membership</h5>
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-3 small text-muted">
                            <li class="d-flex align-items-start gap-2">
                                <i class="fa-solid fa-circle-check text-primary mt-1"></i>
                                <span><strong>Council Voting & Governance:</strong> Participate in annual general meetings, policy decisions, and committee elections.</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <i class="fa-solid fa-circle-check text-primary mt-1"></i>
                                <span><strong>Official Member Credential:</strong> Verified membership certificate and official photo ID issued by the Board.</span>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <i class="fa-solid fa-circle-check text-primary mt-1"></i>
                                <span><strong>Program Directorship:</strong> Lead grassroots initiatives, educational programs, and humanitarian relief funds.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Direct Coordination Box (Navy / Blue Theme) -->
                    <div class="card border-0 p-4 rounded-4 text-white shadow-sm" style="background: linear-gradient(135deg, #071744 0%, #0059FF 100%);">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-id-card fs-5"></i>
                            <h6 class="fw-bold mb-0">Secretariat Committee</h6>
                        </div>
                        <p class="small text-white-50 mb-3">Questions regarding membership fees, constitution bylaws, or committee categories?</p>
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
                                <h5 class="fw-bold text-navy mb-3 fs-6"><i class="fa-solid fa-clock-rotate-left text-primary me-2"></i> Your Submitted Membership Applications</h5>
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
                                            <div class="small text-muted" style="font-size: 0.75rem;">
                                                <span class="fw-semibold text-primary">{{ $app->membership_type }}</span> • NIC: {{ $app->nic_no ?? 'N/A' }} • {{ $app->created_at->format('M d, Y') }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>

                <!-- Right Application Form -->
                <div class="col-lg-8">
                    <div class="member-card p-4 p-md-5">
                        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
                            <div>
                                <h3 class="fw-bold text-navy mb-1">SDC Member Application Form</h3>
                                <p class="text-muted small mb-0">Please fill out your verified details. The executive board will inspect your application for statutory admission.</p>
                            </div>
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold">
                                <i class="fa-solid fa-stamp me-1"></i> Official Council Admission
                            </span>
                        </div>

                        <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data" id="memberForm">
                            @csrf

                            <!-- =========================================================================
                                 1. MEMBER PHOTO BOX (Choose from Files / Live Preview)
                                 ========================================================================= -->
                            <div class="member-photo-box mb-4" id="photoDropZone">
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center">
                                        <div class="photo-preview-wrapper" id="photoPreviewTrigger" title="Click to choose a photo from your files">
                                            <img id="memberPhotoPreview" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Member') }}&background=E2E8F0&color=0059FF&size=200&bold=true" alt="Member Photo Preview" class="member-avatar-img">
                                            <div class="photo-camera-badge" title="Choose Photo">
                                                <i class="fa-solid fa-camera"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 text-center text-md-start">
                                        <h6 class="fw-bold text-navy mb-1">
                                            <i class="fa-solid fa-id-badge text-primary me-1"></i> Official Member Profile Photo
                                        </h6>
                                        <p class="text-muted small mb-3" style="font-size: 0.82rem;">
                                            Upload a clear, passport-size portrait photo. This photograph will be laminated onto your permanent SDC Council Member ID card.
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
                                 2. PERSONAL PARTICULARS
                                 ========================================================================= -->
                            <div class="form-section-title">
                                <i class="fa-solid fa-user me-2"></i> 1. Personal & Contact Particulars
                            </div>

                            <div class="row g-3 mb-4">
                                <!-- Full Name -->
                                <div class="col-md-6">
                                    <label for="full_name" class="form-label fw-semibold text-navy small">Full Legal Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-custom @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', Auth::user()->name ?? '') }}" placeholder="e.g. Al-Haj Mohamed Farook" required>
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- NIC No -->
                                <div class="col-md-6">
                                    <label for="nic_no" class="form-label fw-semibold text-navy small">NIC No (National Identity Card) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-custom @error('nic_no') is-invalid @enderror" id="nic_no" name="nic_no" value="{{ old('nic_no') }}" placeholder="e.g. 198512345678 or 851234567V" required>
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
                                        <input type="number" class="form-control form-control-custom @error('age') is-invalid @enderror" id="age" name="age" value="{{ old('age') }}" min="16" max="100" placeholder="Auto-calculated from DOB" required>
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
                                        <input type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}" placeholder="member@example.com">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="col-12">
                                    <label for="address" class="form-label fw-semibold text-navy small">Permanent Residential Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control form-control-custom @error('address') is-invalid @enderror" id="address" name="address" rows="2" placeholder="House No, Street Name, Village/Town, District" required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- =========================================================================
                                 3. MEMBERSHIP CATEGORY & QUALIFICATIONS
                                 ========================================================================= -->
                            <div class="form-section-title">
                                <i class="fa-solid fa-users me-2"></i> 2. Membership Category & Professional Record
                            </div>

                            <div class="row g-3 mb-4">
                                <!-- Membership Type / Category -->
                                <div class="col-md-6">
                                    <label for="membership_type" class="form-label fw-semibold text-navy small">Membership Category <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-custom @error('membership_type') is-invalid @enderror" id="membership_type" name="membership_type" required>
                                        <option value="General Member" {{ old('membership_type') == 'General Member' ? 'selected' : '' }}>General Council Member</option>
                                        <option value="Executive Committee Member" {{ old('membership_type') == 'Executive Committee Member' ? 'selected' : '' }}>Executive Committee Member</option>
                                        <option value="Youth Wing Member" {{ old('membership_type') == 'Youth Wing Member' ? 'selected' : '' }}>Youth Wing Member (Ages 18-35)</option>
                                        <option value="Professional / Advisory Member" {{ old('membership_type') == 'Professional / Advisory Member' ? 'selected' : '' }}>Professional / Advisory Member (Medical, Legal, Engineering)</option>
                                        <option value="Life Member" {{ old('membership_type') == 'Life Member' ? 'selected' : '' }}>Permanent Life Member</option>
                                        <option value="Overseas Diaspora Member" {{ old('membership_type') == 'Overseas Diaspora Member' ? 'selected' : '' }}>Overseas Diaspora Member</option>
                                    </select>
                                    @error('membership_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Education Qualification -->
                                <div class="col-md-6">
                                    <label for="education_qualification" class="form-label fw-semibold text-navy small">Education Qualification <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-custom @error('education_qualification') is-invalid @enderror" id="education_qualification" name="education_qualification" required>
                                        <option value="">Select highest qualification...</option>
                                        <option value="G.C.E. Ordinary Level (O/L)" {{ old('education_qualification') == 'G.C.E. Ordinary Level (O/L)' ? 'selected' : '' }}>G.C.E. Ordinary Level (O/L)</option>
                                        <option value="G.C.E. Advanced Level (A/L)" {{ old('education_qualification') == 'G.C.E. Advanced Level (A/L)' ? 'selected' : '' }}>G.C.E. Advanced Level (A/L)</option>
                                        <option value="Higher National Diploma (HND) / NVQ" {{ old('education_qualification') == 'Higher National Diploma (HND) / NVQ' ? 'selected' : '' }}>Higher National Diploma (HND) / NVQ</option>
                                        <option value="Bachelor's Degree (Graduate)" {{ old('education_qualification') == "Bachelor's Degree (Graduate)" ? 'selected' : '' }}>Bachelor's Degree (Graduate)</option>
                                        <option value="Postgraduate Diploma / Master's Degree" {{ old('education_qualification') == "Postgraduate Diploma / Master's Degree" ? 'selected' : '' }}>Postgraduate Diploma / Master's Degree</option>
                                        <option value="Doctorate (Ph.D.)" {{ old('education_qualification') == 'Doctorate (Ph.D.)' ? 'selected' : '' }}>Doctorate (Ph.D.)</option>
                                        <option value="Other Technical / Vocational" {{ old('education_qualification') == 'Other Technical / Vocational' ? 'selected' : '' }}>Other Technical / Vocational</option>
                                    </select>
                                    @error('education_qualification')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Current Occupation -->
                                <div class="col-md-6">
                                    <label for="occupation" class="form-label fw-semibold text-navy small">Current Occupation / Profession <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-custom @error('occupation') is-invalid @enderror" id="occupation" name="occupation" value="{{ old('occupation') }}" placeholder="e.g. Attorney-at-Law, Medical Doctor, Principal, Businessman" required>
                                    @error('occupation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Other Qualifications -->
                                <div class="col-md-6">
                                    <label for="other_qualification" class="form-label fw-semibold text-navy small">Other Credentials / Community Positions</label>
                                    <input type="text" class="form-control form-control-custom @error('other_qualification') is-invalid @enderror" id="other_qualification" name="other_qualification" value="{{ old('other_qualification') }}" placeholder="e.g. Justice of Peace (JP), Mosque Trustee, Social Advocate">
                                    @error('other_qualification')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Motivation Statement -->
                                <div class="col-12">
                                    <label for="statement" class="form-label fw-semibold text-navy small">Contribution & Membership Statement</label>
                                    <textarea class="form-control form-control-custom @error('statement') is-invalid @enderror" id="statement" name="statement" rows="3" placeholder="Briefly state your intention to serve SDC and how you can support our council activities...">{{ old('statement') }}</textarea>
                                    <small class="text-muted" style="font-size: 0.76rem;">Detail your experience in community service, leadership, or specialized guidance.</small>
                                    @error('statement')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button (Royal Blue / Navy) -->
                            <div class="mt-4 pt-2 border-top">
                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill py-3 fw-bold d-flex align-items-center justify-content-center gap-2 shadow" style="font-size: 1.05rem; background: linear-gradient(135deg, #0059FF 0%, #0B2568 100%); border-color: #0059FF;">
                                    <i class="fa-solid fa-stamp"></i> Submit SDC Membership Application
                                </button>
                                <div class="text-center mt-2">
                                    <small class="text-muted" style="font-size: 0.78rem;">
                                        <i class="fa-solid fa-lock me-1 text-primary"></i> All membership records are safeguarded under SDC Organizational Constitution & Privacy Policy.
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
        const photoPreview = document.getElementById('memberPhotoPreview');
        const photoTrigger = document.getElementById('photoPreviewTrigger');
        const dropZone = document.getElementById('photoDropZone');
        const removeBtn = document.getElementById('removePhotoBtn');
        const fileNameEl = document.getElementById('selectedFileName');
        const defaultAvatar = "{{ 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'Member') . '&background=E2E8F0&color=0059FF&size=200&bold=true' }}";

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
