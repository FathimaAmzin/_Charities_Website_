@extends('admin.layouts.app')

@section('title', 'Member: ' . $member->full_name)
@section('page_title', 'Council Member Profile Review')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <a href="{{ route('admin.members.index') }}" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Back to Members List
        </a>

        <div class="d-flex align-items-center gap-2">
            <button type="button" onclick="window.print()" class="btn btn-sm btn-outline-navy d-inline-flex align-items-center gap-2">
                <i class="fa-solid fa-print"></i> Print Profile
            </button>

            <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" class="d-inline" data-confirm-prompt="Do you want to permanently delete member record for {{ $member->full_name }}?">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-2">
                    <i class="fa-solid fa-trash"></i> Delete Member
                </button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Profile Info -->
        <div class="col-lg-8">
            <div class="admin-card mb-4">
                <div class="admin-card-body p-4">
                    <!-- Header with Photo & Basic Info -->
                    <div class="d-flex align-items-center gap-4 flex-wrap pb-4 border-bottom mb-4">
                        <div class="position-relative">
                            <img src="{{ $member->photo_url }}" alt="{{ $member->full_name }}" class="rounded-4 border shadow-sm" width="110" height="110" style="object-fit: cover;">
                            @if($member->photo)
                                <a href="{{ $member->photo_url }}" target="_blank" class="badge bg-dark position-absolute bottom-0 end-0 m-1 rounded-pill p-1 px-2 text-decoration-none" title="View Full Size Image">
                                    <i class="fa-solid fa-magnifying-glass-plus"></i> View
                                </a>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                <h4 class="fw-bold text-navy mb-0">{{ $member->full_name }}</h4>
                                @php
                                    $stClass = match($member->status) {
                                        'approved' => 'bg-success',
                                        'under_review' => 'bg-info text-white',
                                        'rejected' => 'bg-danger',
                                        default => 'bg-warning text-dark'
                                    };
                                @endphp
                                <span class="badge {{ $stClass }} text-capitalize px-3 py-1">{{ str_replace('_', ' ', $member->status) }}</span>
                                <span class="badge bg-primary-subtle text-primary border px-2 py-1">{{ $member->membership_type }}</span>
                            </div>
                            <div class="text-muted small mb-2">
                                <span class="fw-semibold text-primary">{{ $member->occupation ?: 'Council Member' }}</span>
                                • NIC: <span class="font-monospace fw-semibold text-dark">{{ $member->nic_no ?: 'Not Provided' }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-3 text-muted small flex-wrap">
                                <span><i class="fa-solid fa-calendar-days text-primary me-1"></i> Applied on {{ $member->created_at ? $member->created_at->format('M d, Y - h:i A') : 'N/A' }}</span>
                                <span><i class="fa-solid fa-cake-candles text-primary me-1"></i> {{ $member->age ? $member->age . ' Years Old' : 'Age N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- 1. PERSONAL INFORMATION -->
                    <h6 class="fw-bold text-navy mb-3 text-uppercase small" style="letter-spacing: 0.05em;">
                        <i class="fa-solid fa-id-card text-primary me-2"></i> Personal Particulars
                    </h6>
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-muted small d-block">Full Legal Name</span>
                                <strong class="text-navy fs-6">{{ $member->full_name }}</strong>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-muted small d-block">National Identity Card (NIC)</span>
                                <strong class="text-navy font-monospace fs-6">{{ $member->nic_no ?: 'Not Provided' }}</strong>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-muted small d-block">Date of Birth & Age</span>
                                <strong class="text-navy fs-6">
                                    {{ $member->date_of_birth ? \Carbon\Carbon::parse($member->date_of_birth)->format('d F Y') : 'Not Provided' }}
                                    @if($member->age)
                                        <span class="badge bg-primary-subtle text-primary ms-1">Age: {{ $member->age }}</span>
                                    @endif
                                </strong>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-muted small d-block">Phone / WhatsApp Number</span>
                                <strong class="text-navy fs-6">{{ $member->phone ?: 'Not Provided' }}</strong>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-muted small d-block">Email Address</span>
                                <strong class="text-navy fs-6">{{ $member->email ?: 'Not Provided' }}</strong>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-muted small d-block">Membership Category</span>
                                <strong class="text-primary fs-6">{{ $member->membership_type }}</strong>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-muted small d-block mb-1">Permanent Residential Address</span>
                                <div class="text-navy fw-semibold">{{ $member->address ?: 'Not Provided' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. QUALIFICATIONS & PROFESSION -->
                    <h6 class="fw-bold text-navy mb-3 text-uppercase small" style="letter-spacing: 0.05em;">
                        <i class="fa-solid fa-graduation-cap text-primary me-2"></i> Professional & Academic Record
                    </h6>
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border h-100">
                                <span class="text-muted small d-block">Education Qualification</span>
                                <strong class="text-navy fs-6">{{ $member->education_qualification ?: 'Not Specified' }}</strong>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3 border h-100">
                                <span class="text-muted small d-block">Current Occupation / Profession</span>
                                <strong class="text-navy fs-6">{{ $member->occupation ?: 'Not Specified' }}</strong>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 bg-light rounded-3 border">
                                <span class="text-muted small d-block mb-1">Other Qualifications, Positions & Credentials</span>
                                <div class="text-navy">{{ $member->other_qualification ?: 'No other qualifications recorded.' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. CONTRIBUTION STATEMENT -->
                    @if($member->statement)
                        <h6 class="fw-bold text-navy mb-3 text-uppercase small" style="letter-spacing: 0.05em;">
                            <i class="fa-solid fa-quote-left text-primary me-2"></i> Contribution & Motivation Statement
                        </h6>
                        <div class="p-3 bg-light rounded-3 border mb-2 text-body" style="line-height: 1.7;">
                            {{ $member->statement }}
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- Right Side Panel: Status & Contact Actions -->
        <div class="col-lg-4">
            <!-- Application Status Control -->
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">Assign Membership Status</h5>
                </div>
                <div class="admin-card-body p-4">
                    <form action="{{ route('admin.members.updateStatus', $member->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold text-navy small">Council Membership Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pending" {{ $member->status == 'pending' ? 'selected' : '' }}>Pending Screening</option>
                                <option value="under_review" {{ $member->status == 'under_review' ? 'selected' : '' }}>Under Board Review / Interview</option>
                                <option value="approved" {{ $member->status == 'approved' ? 'selected' : '' }}>Approved Official Council Member</option>
                                <option value="rejected" {{ $member->status == 'rejected' ? 'selected' : '' }}>Rejected / Ineligible</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-teal w-100 py-2 fw-semibold">
                            <i class="fa-solid fa-check-circle me-1"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Fast Communication Actions -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">Direct Contact Actions</h5>
                </div>
                <div class="admin-card-body p-4 d-flex flex-column gap-2">
                    @if($member->phone)
                        @php
                            $cleanPhone = preg_replace('/[^0-9]/', '', $member->phone);
                        @endphp
                        <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" class="btn btn-success d-flex align-items-center justify-content-center gap-2 py-2">
                            <i class="fa-brands fa-whatsapp fs-5"></i> Chat on WhatsApp
                        </a>

                        <a href="tel:{{ $member->phone }}" class="btn btn-outline-primary d-flex align-items-center justify-content-center gap-2 py-2">
                            <i class="fa-solid fa-phone"></i> Direct Voice Call
                        </a>
                    @endif

                    @if($member->email)
                        <a href="mailto:{{ $member->email }}?subject=SDC Membership Application - {{ urlencode($member->full_name) }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-center gap-2 py-2">
                            <i class="fa-solid fa-envelope"></i> Send Official Email
                        </a>
                    @endif

                    <div class="p-3 bg-light rounded-3 border mt-2 small text-muted">
                        <i class="fa-solid fa-circle-info text-primary me-1"></i>
                        Official Member admission entitles the applicant to attend general meetings, vote in council resolutions, and receive an accredited SDC identification badge.
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

