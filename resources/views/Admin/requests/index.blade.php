@extends('admin.layouts.app')

@section('title', 'Manage Course & Service Requests')
@section('page_title', 'Course Applications & Assistance Requests')

@section('content')

    <!-- Top Action Bar -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-7">
            <h5 class="mb-0 text-navy fw-bold">Student Enrollments & Assistance Inquiries</h5>
            <p class="text-muted small mb-0">Approve, reject, or contact candidates who applied for vocational courses and community programs</p>
        </div>
        <div class="col-md-5 text-md-end d-flex align-items-center justify-content-md-end gap-2">
            @if(isset($unreadRequestsCount) && $unreadRequestsCount > 0)
                <form action="{{ route('admin.requests.markAllRead') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-navy btn-sm">
                        <i class="fa-solid fa-check-double me-1"></i> Mark All as Read
                    </button>
                </form>
            @endif
            <a href="{{ route('courses.index') }}" target="_blank" class="btn btn-teal btn-sm">
                <i class="fa-solid fa-graduation-cap me-1"></i> View Courses on Site
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 border-start border-4 border-primary">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold">Total Requests</span>
                        <h4 class="fw-bold text-navy mb-0 mt-1">{{ $totalCount }}</h4>
                    </div>
                    <div class="p-2 rounded-3 bg-primary-subtle text-primary fs-5">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                </div>
                <div class="mt-2 text-muted small" style="font-size: 0.75rem;">
                    <strong>{{ $courseCount }}</strong> Courses • <strong>{{ $serviceCount }}</strong> Services
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 border-start border-4 border-warning">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold">Pending Review</span>
                        <h4 class="fw-bold text-navy mb-0 mt-1">{{ $pendingCount }}</h4>
                    </div>
                    <div class="p-2 rounded-3 bg-warning-subtle text-warning fs-5">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                </div>
                <div class="mt-2 text-warning small" style="font-size: 0.75rem;">
                    Awaiting admin approval/rejection
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 border-start border-4 border-info">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold">Contacted</span>
                        <h4 class="fw-bold text-navy mb-0 mt-1">{{ $contactedCount }}</h4>
                    </div>
                    <div class="p-2 rounded-3 bg-info-subtle text-info fs-5">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                </div>
                <div class="mt-2 text-muted small" style="font-size: 0.75rem;">
                    In communication
                </div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="admin-card p-3 border-start border-4 border-success">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small fw-semibold">Approved / Enrolled</span>
                        <h4 class="fw-bold text-navy mb-0 mt-1">{{ $approvedCount }}</h4>
                    </div>
                    <div class="p-2 rounded-3 bg-success-subtle text-success fs-5">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
                <div class="mt-2 text-success small" style="font-size: 0.75rem;">
                    Notified via official email
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Search Controls -->
    <div class="admin-card mb-4">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.requests.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-4">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Search by name, phone, course, district..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <select name="type" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">All Categories (Courses & Services)</option>
                        <option value="course" {{ request('type') == 'course' ? 'selected' : '' }}>Courses Only (Vocational / Seminars)</option>
                        <option value="service" {{ request('type') == 'service' ? 'selected' : '' }}>Humanitarian Services Only</option>
                    </select>
                </div>

                <div class="col-6 col-md-3">
                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="all">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="contacted" {{ request('status') == 'contacted' ? 'selected' : '' }}>Contacted</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved / Enrolled</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-navy btn-sm flex-grow-1">Filter</button>
                    @if(request()->hasAny(['search', 'type', 'status']))
                        <a href="{{ route('admin.requests.index') }}" class="btn btn-outline-secondary btn-sm" title="Clear Filters">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Requests Table -->
    <div class="admin-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-navy small">
                    <tr>
                        <th class="ps-3" style="width: 40px;">#</th>
                        <th>Applicant Information</th>
                        <th>Requested Course / Service</th>
                        <th>Contact & WhatsApp</th>
                        <th>Applied On</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Actions & Decisions</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @forelse($requests as $req)
                        <tr class="{{ !$req->is_read ? 'table-primary bg-opacity-10 fw-semibold' : '' }}">
                            <td class="ps-3 text-muted">
                                @if(!$req->is_read)
                                    <span class="badge bg-primary p-1 rounded-circle" title="New unread application">
                                        <span class="visually-hidden">New</span>
                                    </span>
                                @else
                                    {{ $req->id }}
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 36px; height: 36px; background-color: #12345A; font-size: 0.85rem;">
                                        {{ strtoupper(substr($req->full_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-navy">{{ $req->full_name }}</div>
                                        <div class="text-muted" style="font-size: 0.75rem;">
                                            <i class="fa-solid fa-location-dot me-1 text-danger"></i> {{ $req->district ?: 'District N/A' }} {{ $req->city ? '• ' . $req->city : '' }}
                                            @if($req->education_level)
                                                <span class="badge bg-light text-dark border ms-1">{{ $req->education_level }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">
                                    <i class="{{ $req->type === 'course' ? 'fa-solid fa-graduation-cap text-primary' : 'fa-solid fa-hand-holding-heart text-success' }} me-1"></i>
                                    {{ $req->course_title }}
                                </div>
                                <span class="badge {{ $req->type === 'course' ? 'bg-primary-subtle text-primary' : 'bg-success-subtle text-success' }}" style="font-size: 0.7rem;">
                                    {{ ucfirst($req->type) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="fw-mono">{{ $req->phone }}</span>
                                    @php
                                        // Clean phone number for WhatsApp link
                                        $cleanPhone = preg_replace('/[^0-9]/', '', $req->phone);
                                        if (str_starts_with($cleanPhone, '0')) {
                                            $cleanPhone = '94' . substr($cleanPhone, 1);
                                        }
                                    @endphp
                                    <a href="https://wa.me/{{ $cleanPhone }}?text={{ urlencode('Hello ' . $req->full_name . ', regarding your application for ' . $req->course_title . ' at Social Development Council (SDC).') }}" target="_blank" class="btn btn-sm btn-outline-success p-1 px-2" title="Chat on WhatsApp">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                    <a href="tel:{{ $req->phone }}" class="btn btn-sm btn-outline-secondary p-1 px-2" title="Call Phone">
                                        <i class="fa-solid fa-phone"></i>
                                    </a>
                                </div>
                                @if($req->email)
                                    <div class="text-muted mt-1" style="font-size: 0.72rem;">
                                        <i class="fa-regular fa-envelope me-1 text-primary"></i>{{ $req->email }}
                                    </div>
                                @endif
                            </td>
                            <td class="text-muted">
                                <div>{{ $req->created_at ? $req->created_at->format('M d, Y') : 'N/A' }}</div>
                                <small style="font-size: 0.72rem;">{{ $req->created_at ? $req->created_at->format('h:i A') : '' }}</small>
                            </td>
                            <td>
                                {!! $req->status_badge !!}
                            </td>
                            <td class="text-end pe-3">
                                <div class="d-inline-flex align-items-center gap-1">
                                    
                                    <!-- Quick 1-Click Approve Button -->
                                    @if($req->status !== 'approved')
                                        <form action="{{ route('admin.requests.quickDecision', ['id' => $req->id, 'decision' => 'approved']) }}" method="POST" class="d-inline" onsubmit="return confirm('Approve & Enroll {{ $req->full_name }}? {{ $req->email ? 'An official approval email will be sent to ' . $req->email : '' }}');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success p-1 px-2 text-white fw-bold shadow-xs" title="Quick Approve & Send Email">
                                                <i class="fa-solid fa-check me-1"></i> Approve
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Quick 1-Click Reject Button -->
                                    @if($req->status !== 'rejected')
                                        <form action="{{ route('admin.requests.quickDecision', ['id' => $req->id, 'decision' => 'rejected']) }}" method="POST" class="d-inline" onsubmit="return confirm('Reject application from {{ $req->full_name }}? {{ $req->email ? 'A notification email will be sent to ' . $req->email : '' }}');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger p-1 px-2" title="Quick Reject & Send Email">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <!-- View & Full Review Modal Button -->
                                    <button type="button" class="btn btn-sm btn-outline-navy p-1 px-2 btn-view-request" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#requestDetailModal"
                                        data-id="{{ $req->id }}"
                                        data-name="{{ $req->full_name }}"
                                        data-phone="{{ $req->phone }}"
                                        data-email="{{ $req->email ?? '' }}"
                                        data-nic="{{ $req->nic ?? 'Not provided' }}"
                                        data-district="{{ $req->district ?? 'Not specified' }}"
                                        data-city="{{ $req->city ?? 'Not specified' }}"
                                        data-education="{{ $req->education_level ?? 'Not specified' }}"
                                        data-schedule="{{ $req->preferred_schedule ?? 'Flexible' }}"
                                        data-course="{{ $req->course_title }}"
                                        data-type="{{ ucfirst($req->type) }}"
                                        data-message="{{ $req->message ?? 'No specific message provided.' }}"
                                        data-status="{{ $req->status }}"
                                        data-notes="{{ $req->admin_notes ?? '' }}"
                                        data-date="{{ $req->created_at ? $req->created_at->format('M d, Y h:i A') : 'N/A' }}"
                                        data-update-url="{{ route('admin.requests.updateStatus', $req->id) }}"
                                        data-approve-url="{{ route('admin.requests.quickDecision', ['id' => $req->id, 'decision' => 'approved']) }}"
                                        data-reject-url="{{ route('admin.requests.quickDecision', ['id' => $req->id, 'decision' => 'rejected']) }}"
                                        title="Review Application & Edit Notes">
                                        <i class="fa-regular fa-eye me-1"></i> Review
                                    </button>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.requests.destroy', $req->id) }}" method="POST" onsubmit="return confirm('Delete application from {{ $req->full_name }}?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-secondary p-1 px-2" title="Delete">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-graduation-cap fa-3x mb-3 text-secondary opacity-50"></i>
                                <h6>No applications found</h6>
                                <p class="small mb-0">When candidates or students submit requests on the site, they will be listed here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($requests->hasPages())
            <div class="card-footer bg-white border-top p-3 d-flex justify-content-end">
                {{ $requests->links() }}
            </div>
        @endif
    </div>

    <!-- Review, Decision & Email Notification Modal -->
    <div class="modal fade" id="requestDetailModal" tabindex="-1" aria-labelledby="requestDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-navy text-white px-4 py-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="p-2 rounded-3 bg-white bg-opacity-10 text-teal fs-5"><i class="fa-solid fa-user-graduate"></i></span>
                        <div>
                            <h5 class="modal-title fs-6 fw-bold mb-0" id="modalApplicantName">Applicant Details</h5>
                            <span class="text-white-50 small" id="modalAppliedCourse">Course Enrollment</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="modalStatusForm" method="POST" action="">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <!-- Left Column: Applicant Profile -->
                            <div class="col-md-6 border-end">
                                <h6 class="fw-bold text-navy text-uppercase small mb-3 border-bottom pb-2">
                                    <i class="fa-regular fa-id-card me-1 text-primary"></i> Personal Information
                                </h6>
                                <div class="mb-2">
                                    <span class="text-muted small d-block">Full Name</span>
                                    <strong class="text-navy" id="detailFullName"></strong>
                                </div>
                                <div class="mb-2">
                                    <span class="text-muted small d-block">Phone / WhatsApp</span>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <strong class="text-dark" id="detailPhone"></strong>
                                        <a href="#" id="detailWhatsAppBtn" target="_blank" class="btn btn-sm btn-outline-success py-0 px-2" style="font-size: 0.75rem;">
                                            <i class="fa-brands fa-whatsapp"></i> WhatsApp
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <span class="text-muted small d-block">Email Address</span>
                                    <span class="text-dark fw-semibold" id="detailEmail"></span>
                                </div>
                                <div class="mb-2">
                                    <span class="text-muted small d-block">NIC / Student ID</span>
                                    <span class="text-dark" id="detailNic"></span>
                                </div>
                                <div class="mb-2">
                                    <span class="text-muted small d-block">Location</span>
                                    <span class="text-dark" id="detailLocation"></span>
                                </div>
                                <div class="mb-2">
                                    <span class="text-muted small d-block">Education Level</span>
                                    <span class="text-dark" id="detailEducation"></span>
                                </div>
                                <div class="mb-2">
                                    <span class="text-muted small d-block">Preferred Schedule</span>
                                    <span class="text-dark" id="detailSchedule"></span>
                                </div>
                            </div>

                            <!-- Right Column: Status & Processing -->
                            <div class="col-md-6">
                                <h6 class="fw-bold text-navy text-uppercase small mb-3 border-bottom pb-2">
                                    <i class="fa-solid fa-list-check me-1 text-teal"></i> Application & Decision
                                </h6>
                                <div class="mb-3">
                                    <span class="text-muted small d-block">Submitted On</span>
                                    <span class="text-dark fw-semibold" id="detailAppliedDate"></span>
                                </div>

                                <div class="mb-3">
                                    <span class="text-muted small d-block">Applicant Message / Notes</span>
                                    <div class="p-3 bg-light rounded-3 border text-secondary small" id="detailMessage" style="min-height: 80px; white-space: pre-wrap;">
                                    </div>
                                </div>

                                <!-- Email Dispatch Notice Badge -->
                                <div id="emailNoticeBox" class="mb-3 p-2 rounded-3 bg-light border small">
                                    <!-- Injected by JS -->
                                </div>

                                <!-- Status Control -->
                                <div class="mb-3">
                                    <label for="statusSelect" class="form-label fw-bold text-navy small">
                                        Enrollment Decision / Status <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select" id="statusSelect" name="status" required>
                                        <option value="pending">⏳ Pending (Under Initial Review)</option>
                                        <option value="contacted">📞 Contacted (Spoke via Phone / WhatsApp)</option>
                                        <option value="approved">✅ Approved / Enrolled (Dispatches Approval Email)</option>
                                        <option value="completed">🎓 Completed Training</option>
                                        <option value="rejected">❌ Rejected (Dispatches Decision Email)</option>
                                    </select>
                                </div>

                                <!-- Internal Admin / Coordinator Notes -->
                                <div class="mb-3">
                                    <label for="adminNotes" class="form-label fw-bold text-navy small">Coordinator Message / Email Notes</label>
                                    <textarea class="form-control small" id="adminNotes" name="admin_notes" rows="3" placeholder="e.g. Approved for Saturday batch. Class begins 9:00 AM at Kalmunai Center. (Will be included in the email)"></textarea>
                                </div>

                                <div class="form-check form-switch small mb-2">
                                    <input class="form-check-input" type="checkbox" id="sendEmailSwitch" name="send_email" value="1" checked>
                                    <label class="form-check-label fw-semibold text-navy" for="sendEmailSwitch">
                                        Send Official Email Notification to Applicant
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light px-4 py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <div>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <!-- Direct One-Click Modal Approve Button -->
                            <button type="button" class="btn btn-success fw-bold text-white shadow-xs" id="modalQuickApproveBtn">
                                <i class="fa-solid fa-check me-1"></i> Approve & Send Email
                            </button>

                            <!-- Direct One-Click Modal Reject Button -->
                            <button type="button" class="btn btn-danger fw-bold text-white shadow-xs" id="modalQuickRejectBtn">
                                <i class="fa-solid fa-xmark me-1"></i> Reject & Send Email
                            </button>

                            <!-- Save All Form Updates Button -->
                            <button type="submit" class="btn btn-navy px-4">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const reviewButtons = document.querySelectorAll('.btn-view-request');
            const statusForm = document.getElementById('modalStatusForm');
            const quickApproveBtn = document.getElementById('modalQuickApproveBtn');
            const quickRejectBtn = document.getElementById('modalQuickRejectBtn');

            reviewButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const phone = this.getAttribute('data-phone');
                    const email = this.getAttribute('data-email');
                    const nic = this.getAttribute('data-nic');
                    const district = this.getAttribute('data-district');
                    const city = this.getAttribute('data-city');
                    const education = this.getAttribute('data-education');
                    const schedule = this.getAttribute('data-schedule');
                    const course = this.getAttribute('data-course');
                    const type = this.getAttribute('data-type');
                    const message = this.getAttribute('data-message');
                    const status = this.getAttribute('data-status');
                    const notes = this.getAttribute('data-notes');
                    const date = this.getAttribute('data-date');
                    const updateUrl = this.getAttribute('data-update-url');
                    const approveUrl = this.getAttribute('data-approve-url');
                    const rejectUrl = this.getAttribute('data-reject-url');

                    document.getElementById('modalApplicantName').textContent = name;
                    document.getElementById('modalAppliedCourse').textContent = `${type}: ${course}`;
                    document.getElementById('detailFullName').textContent = name;
                    document.getElementById('detailPhone').textContent = phone;
                    document.getElementById('detailEmail').textContent = email || 'No email provided';
                    document.getElementById('detailNic').textContent = nic;
                    document.getElementById('detailLocation').textContent = `${district} ${city ? '• ' + city : ''}`;
                    document.getElementById('detailEducation').textContent = education;
                    document.getElementById('detailSchedule').textContent = schedule;
                    document.getElementById('detailAppliedDate').textContent = date;
                    document.getElementById('detailMessage').textContent = message;

                    // Email Notice Box
                    const emailNoticeBox = document.getElementById('emailNoticeBox');
                    if (email) {
                        emailNoticeBox.className = 'mb-3 p-2 rounded-3 bg-success-subtle border border-success-subtle small text-success';
                        emailNoticeBox.innerHTML = `<i class="fa-solid fa-paper-plane me-1"></i> Decision emails will be automatically sent to: <strong>${email}</strong>`;
                    } else {
                        emailNoticeBox.className = 'mb-3 p-2 rounded-3 bg-warning-subtle border border-warning-subtle small text-dark';
                        emailNoticeBox.innerHTML = `<i class="fa-solid fa-triangle-exclamation me-1 text-warning"></i> Candidate has no email on file. Decision will be logged; notify candidate via Phone/WhatsApp: <strong>${phone}</strong>`;
                    }

                    // WhatsApp button link
                    let cleanPhone = phone.replace(/[^0-9]/g, '');
                    if (cleanPhone.startsWith('0')) {
                        cleanPhone = '94' + cleanPhone.substring(1);
                    }
                    document.getElementById('detailWhatsAppBtn').href = `https://wa.me/${cleanPhone}?text=${encodeURIComponent('Hello ' + name + ', regarding your application for ' + course + ' at Social Development Council.')}`;

                    // Select Status & Notes
                    document.getElementById('statusSelect').value = status;
                    document.getElementById('adminNotes').value = notes;

                    // Update Form Action
                    statusForm.action = updateUrl;

                    // Setup Quick Modal Buttons
                    quickApproveBtn.onclick = function() {
                        if (confirm(`Officially APPROVE and admit ${name} for ${course}? ${email ? 'An official approval email will be sent to ' + email : ''}`)) {
                            document.getElementById('statusSelect').value = 'approved';
                            statusForm.submit();
                        }
                    };

                    quickRejectBtn.onclick = function() {
                        if (confirm(`Officially REJECT application from ${name}? ${email ? 'A notification email will be sent to ' + email : ''}`)) {
                            document.getElementById('statusSelect').value = 'rejected';
                            statusForm.submit();
                        }
                    };
                });
            });
        });
    </script>
    @endpush

@endsection
