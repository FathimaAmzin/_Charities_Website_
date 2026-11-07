@extends('layouts.app')

@section('title', 'My Dashboard | SDC Sri Lanka')

@push('styles')
<style>
    /* User Dashboard Styling */
    .user-dashboard-wrapper {
        background-color: #F8FAFC;
        min-height: calc(100vh - 200px);
        padding-bottom: 60px;
    }

    .user-hero-banner {
        background: linear-gradient(135deg, #071739 0%, #0B2568 50%, #0059FF 100%);
        color: #FFFFFF;
        padding: 42px 0 70px 0;
        position: relative;
        overflow: hidden;
    }

    .user-hero-banner::after {
        content: '';
        position: absolute;
        top: -40%;
        right: -10%;
        width: 480px;
        height: 480px;
        background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .user-avatar-box {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        border: 2px solid rgba(255, 255, 255, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: #FFFFFF;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .stat-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 22px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.08);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .dashboard-tabs {
        border-bottom: 2px solid #E2E8F0;
        gap: 8px;
    }

    .dashboard-tabs .nav-link {
        color: #64748B;
        font-weight: 600;
        font-size: 14.5px;
        padding: 12px 20px;
        border-radius: 10px 10px 0 0;
        border: none;
        border-bottom: 3px solid transparent;
        background: transparent;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .dashboard-tabs .nav-link:hover {
        color: #0059FF;
        background: rgba(0, 89, 255, 0.04);
    }

    .dashboard-tabs .nav-link.active {
        color: #0059FF;
        background: #FFFFFF;
        border-bottom-color: #0059FF;
        box-shadow: 0 -2px 8px rgba(0,0,0,0.03);
    }

    .portal-card {
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(15, 23, 42, 0.04);
    }

    .portal-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .badge-status-pending {
        background-color: #FEF3C7;
        color: #B45309;
        border: 1px solid #FDE68A;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-status-approved {
        background-color: #D1FAE5;
        color: #047857;
        border: 1px solid #A7F3D0;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-status-rejected {
        background-color: #FEE2E2;
        color: #B91C1C;
        border: 1px solid #FECACA;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .custom-input-group {
        position: relative;
    }

    .custom-input-group i.input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94A3B8;
        font-size: 14px;
        pointer-events: none;
        z-index: 2;
    }

    .custom-input-group input,
    .custom-input-group textarea,
    .custom-input-group select {
        padding-left: 42px;
        border-radius: 10px;
        border: 1.5px solid #E2E8F0;
        font-size: 14px;
        background-color: #F8FAFC;
        transition: all 0.2s ease;
    }

    .custom-input-group input.has-toggle {
        padding-right: 44px;
    }

    .custom-input-group input:focus,
    .custom-input-group textarea:focus,
    .custom-input-group select:focus {
        background-color: #FFFFFF;
        border-color: #0059FF;
        box-shadow: 0 0 0 3px rgba(0, 89, 255, 0.12);
    }

    .toggle-pass-btn {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: #94A3B8;
        font-size: 15px;
        cursor: pointer;
        padding: 6px;
        z-index: 5;
        border-radius: 6px;
        line-height: 1;
    }

    .toggle-pass-btn:hover {
        color: #0059FF;
    }

    .request-item-card {
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 18px;
        background: #FFFFFF;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .request-item-card:hover {
        border-color: #0059FF;
        box-shadow: 0 4px 14px rgba(0, 89, 255, 0.08);
    }
</style>
@endpush

@section('content')
<div class="user-dashboard-wrapper">

    <!-- Top Hero Banner with User Profile Summary -->
    <div class="user-hero-banner">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="user-avatar-box">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <h2 class="h3 fw-bold mb-0 text-white">{{ $user->name }}</h2>
                            <span class="badge bg-white text-primary rounded-pill px-3 py-1 fw-bold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.05em;">
                                <i class="fa-solid fa-circle-check text-success me-1"></i> {{ $user->role ?? 'Member' }}
                            </span>
                        </div>
                        <p class="text-white-50 mb-0 mt-1 small">
                            <i class="fa-regular fa-envelope me-1"></i> {{ $user->email }}
                            @if($user->phone)
                                <span class="mx-2">•</span>
                                <i class="fa-solid fa-phone me-1"></i> {{ $user->phone }}
                            @endif
                            <span class="mx-2">•</span>
                            <i class="fa-regular fa-calendar-check me-1"></i> Member since {{ $user->created_at->format('M Y') }}
                        </p>
                    </div>
                </div>

                <!-- Fast Actions -->
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <a href="{{ route('courses.index') }}" class="btn btn-light fw-bold rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2 shadow-sm text-primary">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <span>Apply For Courses</span>
                    </a>
                    <a href="{{ route('donate') }}" class="btn btn-warning fw-bold rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2 shadow-sm text-dark">
                        <i class="fa-solid fa-heart"></i>
                        <span>Donate</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: -35px;">

        <!-- 4 Metric Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted small fw-semibold">Course Requests</span>
                        <div class="stat-icon bg-primary-subtle text-primary">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                    </div>
                    <h3 class="h2 fw-bold text-navy mb-1">{{ $metrics['total_requests'] }}</h3>
                    <div class="small text-muted d-flex align-items-center gap-1">
                        <span class="text-warning fw-bold">{{ $metrics['pending_requests'] }} Pending</span> •
                        <span class="text-success fw-bold">{{ $metrics['approved_requests'] }} Approved</span>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted small fw-semibold">Approved Aid</span>
                        <div class="stat-icon bg-success-subtle text-success">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                    </div>
                    <h3 class="h2 fw-bold text-success mb-1">{{ $metrics['approved_requests'] }}</h3>
                    <div class="small text-muted">Confirmed Enrollments</div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted small fw-semibold">Contributions</span>
                        <div class="stat-icon bg-warning-subtle text-warning">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                    </div>
                    <h3 class="h2 fw-bold text-navy mb-1">${{ number_format($metrics['total_donations'], 2) }}</h3>
                    <div class="small text-muted">{{ $metrics['donations_count'] }} Donation Receipts</div>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="stat-card">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="text-muted small fw-semibold">Community Role</span>
                        <div class="stat-icon bg-info-subtle text-info">
                            <i class="fa-solid fa-shield-heart"></i>
                        </div>
                    </div>
                    <h3 class="h2 fw-bold text-navy mb-1">Active</h3>
                    <div class="small text-muted">Verified Portal Account</div>
                </div>
            </div>
        </div>

        <!-- Dashboard Navigation Tabs -->
        <ul class="nav nav-tabs dashboard-tabs mb-4" id="dashboardTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'overview' ? 'active' : '' }}" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview-pane" type="button" role="tab">
                    <i class="fa-solid fa-gauge"></i>
                    <span>Overview</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'requests' ? 'active' : '' }}" id="requests-tab" data-bs-toggle="tab" data-bs-target="#requests-pane" type="button" role="tab">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>My Applications ({{ $courseRequests->count() }})</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'donations' ? 'active' : '' }}" id="donations-tab" data-bs-toggle="tab" data-bs-target="#donations-pane" type="button" role="tab">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                    <span>My Donations ({{ $donations->count() }})</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'profile' ? 'active' : '' }}" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-pane" type="button" role="tab">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>Profile Info</span>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $activeTab === 'security' ? 'active' : '' }}" id="security-tab" data-bs-toggle="tab" data-bs-target="#security-pane" type="button" role="tab">
                    <i class="fa-solid fa-lock"></i>
                    <span>Change Password</span>
                </button>
            </li>
        </ul>

        <!-- Tab Contents -->
        <div class="tab-content" id="dashboardTabContent">

            <!-- TAB 1: OVERVIEW -->
            <div class="tab-pane fade {{ $activeTab === 'overview' ? 'show active' : '' }}" id="overview-pane" role="tabpanel">
                <div class="row g-4">
                    <!-- Left: Recent Applications / Status -->
                    <div class="col-lg-8">
                        <div class="portal-card mb-4">
                            <div class="portal-card-header">
                                <div>
                                    <h4 class="h5 fw-bold text-navy mb-0">Recent Applications & Requests</h4>
                                    <small class="text-muted">Track the progress of your course enrollments and assistance requests</small>
                                </div>
                                <a href="{{ route('courses.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">
                                    + Apply New
                                </a>
                            </div>
                            <div class="p-4">
                                @forelse($courseRequests->take(4) as $req)
                                    <div class="request-item-card mb-3">
                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-primary-subtle text-primary fw-bold text-uppercase" style="font-size: 0.7rem;">
                                                    {{ $req->type === 'course' ? 'Course Enrollment' : 'Service Aid' }}
                                                </span>
                                                <h5 class="h6 fw-bold text-navy mb-0">{{ $req->course_title }}</h5>
                                            </div>
                                            @if($req->status === 'approved')
                                                <span class="badge-status-approved">
                                                    <i class="fa-solid fa-circle-check"></i> Approved
                                                </span>
                                            @elseif($req->status === 'rejected')
                                                <span class="badge-status-rejected">
                                                    <i class="fa-solid fa-circle-xmark"></i> Rejected
                                                </span>
                                            @else
                                                <span class="badge-status-pending">
                                                    <i class="fa-solid fa-clock"></i> Pending Review
                                                </span>
                                            @endif
                                        </div>

                                        <div class="row g-2 text-muted small mb-2">
                                            <div class="col-6 col-md-3">
                                                <i class="fa-regular fa-calendar me-1"></i> {{ $req->created_at->format('M d, Y') }}
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <i class="fa-solid fa-location-dot me-1"></i> {{ $req->district ?: 'Eastern Province' }}
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <i class="fa-solid fa-phone me-1"></i> {{ $req->phone }}
                                            </div>
                                            <div class="col-6 col-md-3">
                                                <i class="fa-regular fa-clock me-1"></i> {{ $req->preferred_schedule ?: 'Flexible' }}
                                            </div>
                                        </div>

                                        @if($req->admin_notes)
                                            <div class="p-2 px-3 rounded-3 bg-light border border-dashed mt-2 small">
                                                <strong class="text-navy"><i class="fa-solid fa-comment-dots text-primary me-1"></i> SDC Team Note:</strong>
                                                <span class="text-secondary">{{ $req->admin_notes }}</span>
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <div class="text-center py-5">
                                        <div class="stat-icon bg-light text-muted mx-auto mb-3" style="width: 60px; height: 60px; font-size: 24px;">
                                            <i class="fa-regular fa-folder-open"></i>
                                        </div>
                                        <h5 class="fw-bold text-navy">No applications submitted yet</h5>
                                        <p class="text-muted small mb-3">Explore our educational diplomas and community empowerment courses to start your journey.</p>
                                        <a href="{{ route('courses.index') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold">
                                            <i class="fa-solid fa-graduation-cap me-1"></i> Explore Available Courses
                                        </a>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Available Courses Quick Grid -->
                        <div class="portal-card">
                            <div class="portal-card-header">
                                <h4 class="h5 fw-bold text-navy mb-0">Featured Community Courses</h4>
                                <a href="{{ route('courses.index') }}" class="text-primary small fw-bold text-decoration-none">View All 6 Courses →</a>
                            </div>
                            <div class="p-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="p-3 border rounded-3 h-100 d-flex flex-column justify-content-between bg-light">
                                            <div>
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <span class="badge bg-success-subtle text-success fw-bold">Free</span>
                                                    <h6 class="fw-bold text-navy mb-0">Free Seminars for Students</h6>
                                                </div>
                                                <p class="text-muted small mb-3">Career guidance, motivational sessions, and exam preparatory workshops.</p>
                                            </div>
                                            <a href="{{ route('courses.index') }}#free-seminars" class="btn btn-sm btn-outline-primary rounded-pill fw-bold">Apply Now</a>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="p-3 border rounded-3 h-100 d-flex flex-column justify-content-between bg-light">
                                            <div>
                                                <div class="d-flex align-items-center gap-2 mb-2">
                                                    <span class="badge bg-primary-subtle text-primary fw-bold">Diploma</span>
                                                    <h6 class="fw-bold text-navy mb-0">IT Diploma Course</h6>
                                                </div>
                                                <p class="text-muted small mb-3">Modern web coding, digital literacy, and IT office applications.</p>
                                            </div>
                                            <a href="{{ route('courses.index') }}#it-diploma-course" class="btn btn-sm btn-outline-primary rounded-pill fw-bold">Apply Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Profile Summary & Helpdesk -->
                    <div class="col-lg-4">
                        <!-- Profile Card -->
                        <div class="portal-card mb-4">
                            <div class="portal-card-header">
                                <h5 class="h6 fw-bold text-navy mb-0">My Membership Details</h5>
                                <a href="#profile-pane" onclick="document.getElementById('profile-tab').click();" class="text-primary small fw-semibold">Edit</a>
                            </div>
                            <div class="p-4">
                                <ul class="list-unstyled mb-0 d-flex flex-column gap-3 small">
                                    <li class="d-flex justify-content-between pb-2 border-bottom">
                                        <span class="text-muted">Full Name</span>
                                        <strong class="text-navy">{{ $user->name }}</strong>
                                    </li>
                                    <li class="d-flex justify-content-between pb-2 border-bottom">
                                        <span class="text-muted">Email</span>
                                        <span class="text-navy text-truncate" style="max-width: 170px;">{{ $user->email }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between pb-2 border-bottom">
                                        <span class="text-muted">Phone</span>
                                        <strong class="text-navy">{{ $user->phone ?: 'Not provided' }}</strong>
                                    </li>
                                    <li class="d-flex justify-content-between pb-2 border-bottom">
                                        <span class="text-muted">Country</span>
                                        <strong class="text-navy">{{ $user->country ?: 'Sri Lanka' }}</strong>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="text-muted">Account Status</span>
                                        <span class="badge bg-success-subtle text-success">Active</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- SDC Direct Support -->
                        <div class="portal-card" style="background: linear-gradient(135deg, #0B2568 0%, #0059FF 100%); color: #FFFFFF;">
                            <div class="p-4">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="stat-icon bg-white text-primary">
                                        <i class="fa-solid fa-headset"></i>
                                    </div>
                                    <div>
                                        <h5 class="h6 fw-bold text-white mb-0">Need Assistance?</h5>
                                        <small class="text-white-50">SDC Member Support Desk</small>
                                    </div>
                                </div>
                                <p class="small text-white-50 mb-3">
                                    Have queries about your course application, enrollment confirmation, or community relief services?
                                </p>
                                <div class="d-flex flex-column gap-2 small">
                                    <a href="tel:+94672229180" class="btn btn-sm btn-light rounded-pill fw-bold text-navy d-flex align-items-center justify-content-center gap-2">
                                        <i class="fa-solid fa-phone"></i> +94 (0) 67 222 9180
                                    </a>
                                    <a href="mailto:info@sdcmksl.org" class="btn btn-sm btn-outline-light rounded-pill fw-bold d-flex align-items-center justify-content-center gap-2">
                                        <i class="fa-solid fa-envelope"></i> info@sdcmksl.org
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: MY APPLICATIONS & REQUESTS -->
            <div class="tab-pane fade {{ $activeTab === 'requests' ? 'show active' : '' }}" id="requests-pane" role="tabpanel">
                <div class="portal-card">
                    <div class="portal-card-header">
                        <div>
                            <h4 class="h5 fw-bold text-navy mb-0">My Applications & Course Enrollments</h4>
                            <small class="text-muted">All course requests and community welfare applications registered to your account</small>
                        </div>
                        <a href="{{ route('courses.index') }}" class="btn btn-primary rounded-pill px-4 fw-bold">
                            <i class="fa-solid fa-plus me-1"></i> Apply for New Course
                        </a>
                    </div>

                    <div class="p-4">
                        @if($courseRequests->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr class="text-muted small text-uppercase">
                                            <th># ID</th>
                                            <th>Program / Title</th>
                                            <th>Applicant</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>SDC Response</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($courseRequests as $req)
                                            <tr>
                                                <td class="fw-bold text-muted">#CR-{{ str_pad($req->id, 4, '0', STR_PAD_LEFT) }}</td>
                                                <td>
                                                    <div class="fw-bold text-navy">{{ $req->course_title }}</div>
                                                    <span class="badge bg-light text-secondary border" style="font-size: 0.7rem;">
                                                        {{ ucfirst($req->type) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="small fw-semibold">{{ $req->full_name }}</div>
                                                    <div class="text-muted small"><i class="fa-solid fa-phone fs-xs me-1"></i>{{ $req->phone }}</div>
                                                </td>
                                                <td class="small text-muted">
                                                    {{ $req->district ?: 'N/A' }} {{ $req->city ? '• ' . $req->city : '' }}
                                                </td>
                                                <td class="small text-muted">{{ $req->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    @if($req->status === 'approved')
                                                        <span class="badge-status-approved">
                                                            <i class="fa-solid fa-circle-check"></i> Approved
                                                        </span>
                                                    @elseif($req->status === 'rejected')
                                                        <span class="badge-status-rejected">
                                                            <i class="fa-solid fa-circle-xmark"></i> Rejected
                                                        </span>
                                                    @else
                                                        <span class="badge-status-pending">
                                                            <i class="fa-solid fa-clock"></i> Pending Review
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($req->admin_notes)
                                                        <span class="badge bg-primary-subtle text-primary p-2 text-wrap" style="max-width: 200px; text-align: left; font-size: 0.75rem;">
                                                            {{ $req->admin_notes }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted small">Under administrative review</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="stat-icon bg-light text-muted mx-auto mb-3" style="width: 70px; height: 70px; font-size: 28px;">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </div>
                                <h4 class="fw-bold text-navy">No Applications Found</h4>
                                <p class="text-muted small mb-4">You have not submitted any course enrollment or humanitarian assistance requests yet.</p>
                                <a href="{{ route('courses.index') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold">
                                    Browse SDC Courses & Apply
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- TAB 3: MY DONATIONS -->
            <div class="tab-pane fade {{ $activeTab === 'donations' ? 'show active' : '' }}" id="donations-pane" role="tabpanel">
                <div class="portal-card">
                    <div class="portal-card-header">
                        <div>
                            <h4 class="h5 fw-bold text-navy mb-0">Donation History & Receipts</h4>
                            <small class="text-muted">All contributions made to support SDC humanitarian initiatives</small>
                        </div>
                        <a href="{{ route('donate') }}" class="btn btn-warning rounded-pill px-4 fw-bold text-dark">
                            <i class="fa-solid fa-heart me-1"></i> Make a New Donation
                        </a>
                    </div>

                    <div class="p-4">
                        @if($donations->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr class="text-muted small text-uppercase">
                                            <th>Receipt Code</th>
                                            <th>Project / Campaign</th>
                                            <th>Amount</th>
                                            <th>Payment Method</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($donations as $donation)
                                            <tr>
                                                <td class="fw-bold text-primary font-monospace">{{ $donation->receipt_code ?: '#DON-' . $donation->id }}</td>
                                                <td>
                                                    <div class="fw-bold text-navy">
                                                        {{ $donation->campaign?->title ?? ($donation->project?->title ?? 'General Humanitarian Fund') }}
                                                    </div>
                                                </td>
                                                <td class="fw-bold text-success">
                                                    ${{ number_format($donation->amount, 2) }}
                                                </td>
                                                <td class="small text-muted text-capitalize">{{ $donation->payment_method ?: 'Online Transfer' }}</td>
                                                <td class="small text-muted">{{ $donation->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <span class="badge bg-success-subtle text-success fw-bold px-3 py-1 rounded-pill">
                                                        {{ ucfirst($donation->status ?? 'Completed') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="stat-icon bg-light text-muted mx-auto mb-3" style="width: 70px; height: 70px; font-size: 28px;">
                                    <i class="fa-solid fa-hand-holding-dollar"></i>
                                </div>
                                <h4 class="fw-bold text-navy">No Donations Recorded Yet</h4>
                                <p class="text-muted small mb-4">Your contributions provide education, shelter, clean water, and emergency food aid to families in need.</p>
                                <a href="{{ route('donate') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-bold">
                                    <i class="fa-solid fa-heart me-1"></i> Donate to SDC Programs
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- TAB 4: PROFILE INFO -->
            <div class="tab-pane fade {{ $activeTab === 'profile' ? 'show active' : '' }}" id="profile-pane" role="tabpanel">
                <div class="portal-card">
                    <div class="portal-card-header">
                        <div>
                            <h4 class="h5 fw-bold text-navy mb-0">Personal Profile Settings</h4>
                            <small class="text-muted">Update your contact information and identity details</small>
                        </div>
                    </div>

                    <div class="p-4">
                        <form action="{{ route('user.profile.update') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-navy">Full Name <span class="text-danger">*</span></label>
                                    <div class="custom-input-group">
                                        <i class="fa-solid fa-user input-icon"></i>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-navy">Email Address</label>
                                    <div class="custom-input-group">
                                        <i class="fa-solid fa-envelope input-icon"></i>
                                        <input type="email" class="form-control" value="{{ $user->email }}" disabled readonly style="background-color: #E2E8F0; cursor: not-allowed;">
                                    </div>
                                    <small class="text-muted" style="font-size: 0.75rem;">Email address cannot be changed directly.</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-navy">Phone Number</label>
                                    <div class="custom-input-group">
                                        <i class="fa-solid fa-phone input-icon"></i>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" placeholder="+94 77 123 4567">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-navy">Country</label>
                                    <div class="custom-input-group">
                                        <i class="fa-solid fa-globe input-icon"></i>
                                        <input type="text" name="country" class="form-control" value="{{ old('country', $user->country ?: 'Sri Lanka') }}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold small text-navy">Residential Address</label>
                                    <div class="custom-input-group">
                                        <i class="fa-solid fa-location-dot input-icon"></i>
                                        <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}" placeholder="Street Address, City, Postal Code">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold small text-navy">Bio / Notes</label>
                                    <div class="custom-input-group">
                                        <textarea name="bio" class="form-control ps-3" rows="3" placeholder="Share a few words about your educational background or community interests...">{{ old('bio', $user->bio) }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 pt-2">
                                    <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 fw-bold d-inline-flex align-items-center gap-2">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                        <span>Save Profile Changes</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- TAB 5: CHANGE PASSWORD -->
            <div class="tab-pane fade {{ $activeTab === 'security' ? 'show active' : '' }}" id="security-pane" role="tabpanel">
                <div class="portal-card" style="max-width: 680px;">
                    <div class="portal-card-header">
                        <div>
                            <h4 class="h5 fw-bold text-navy mb-0">Update Password</h4>
                            <small class="text-muted">Ensure your account uses a strong and confidential password</small>
                        </div>
                    </div>

                    <div class="p-4">
                        <form action="{{ route('user.password.update') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-navy">Current Password <span class="text-danger">*</span></label>
                                <div class="custom-input-group">
                                    <i class="fa-solid fa-lock input-icon"></i>
                                    <input type="password" id="current_password" name="current_password" class="form-control has-toggle" placeholder="Enter current password" required>
                                    <button type="button" class="toggle-pass-btn" onclick="togglePassField('current_password', 'currentPassIcon')" title="Show password">
                                        <i class="fa-regular fa-eye" id="currentPassIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold small text-navy">New Password <span class="text-danger">*</span></label>
                                <div class="custom-input-group">
                                    <i class="fa-solid fa-key input-icon"></i>
                                    <input type="password" id="new_password" name="password" class="form-control has-toggle" placeholder="Minimum 8 characters" required>
                                    <button type="button" class="toggle-pass-btn" onclick="togglePassField('new_password', 'newPassIcon')" title="Show password">
                                        <i class="fa-regular fa-eye" id="newPassIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-navy">Confirm New Password <span class="text-danger">*</span></label>
                                <div class="custom-input-group">
                                    <i class="fa-solid fa-shield-halved input-icon"></i>
                                    <input type="password" id="new_password_confirmation" name="password_confirmation" class="form-control has-toggle" placeholder="Re-type new password" required>
                                    <button type="button" class="toggle-pass-btn" onclick="togglePassField('new_password_confirmation', 'confirmPassIcon')" title="Show password">
                                        <i class="fa-regular fa-eye" id="confirmPassIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 fw-bold d-inline-flex align-items-center gap-2">
                                <i class="fa-solid fa-key"></i>
                                <span>Change Password</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script>
    function togglePassField(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (!input || !icon) return;
        const isPassword = input.getAttribute('type') === 'password';
        input.setAttribute('type', isPassword ? 'text' : 'password');
        icon.className = isPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
    }
</script>
@endsection

