@extends('admin.layouts.app')

@section('title', 'Manage Members')
@section('page_title', 'Council Members & Applications')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h4 class="fw-bold text-navy mb-1">Council Members Registry</h4>
            <p class="text-muted small mb-0">Review accredited member profiles, verify NICs and credentials, approve memberships, and maintain council records.</p>
        </div>
        <div>
            <a href="{{ route('member.register') }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-2 fw-semibold">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Public Member Registration Form
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="admin-card mb-4">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.members.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Search member by name, NIC, phone, category, occupation..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        <option value="General Member" {{ request('category') == 'General Member' ? 'selected' : '' }}>General Council Member</option>
                        <option value="Executive Committee Member" {{ request('category') == 'Executive Committee Member' ? 'selected' : '' }}>Executive Committee Member</option>
                        <option value="Youth Wing Member" {{ request('category') == 'Youth Wing Member' ? 'selected' : '' }}>Youth Wing Member</option>
                        <option value="Professional / Advisory Member" {{ request('category') == 'Professional / Advisory Member' ? 'selected' : '' }}>Professional / Advisory</option>
                        <option value="Life Member" {{ request('category') == 'Life Member' ? 'selected' : '' }}>Life Member</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Screening</option>
                        <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved Official</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-navy w-100">Filter</button>
                    @if(request()->hasAny(['search', 'status', 'category']))
                        <a href="{{ route('admin.members.index') }}" class="btn btn-outline-secondary" title="Clear Filters"><i class="fa-solid fa-rotate-left"></i></a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="admin-card">
        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                    <tr>
                        <th style="min-width: 220px;">Member</th>
                        <th>NIC Number</th>
                        <th>Category</th>
                        <th>Age / DOB</th>
                        <th>Phone & Address</th>
                        <th>Occupation & Education</th>
                        <th>Applied Date</th>
                        <th>Status</th>
                        <th class="text-end" style="min-width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $mbr)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $mbr->photo_url }}" alt="{{ $mbr->full_name }}" class="rounded-circle border shadow-sm flex-shrink-0" width="46" height="46" style="object-fit: cover;">
                                    <div class="overflow-hidden">
                                        <strong class="text-navy d-block text-truncate" style="max-width: 170px;">{{ $mbr->full_name }}</strong>
                                        <small class="text-muted text-truncate d-block" style="max-width: 170px;">{{ $mbr->email ?: 'No email' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($mbr->nic_no)
                                    <span class="badge bg-light text-navy border font-monospace fw-semibold px-2 py-1">{{ $mbr->nic_no }}</span>
                                @else
                                    <span class="text-muted small">N/A</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border px-2 py-1" style="font-size: 0.75rem;">
                                    {{ $mbr->membership_type }}
                                </span>
                            </td>
                            <td>
                                @if($mbr->age)
                                    <span class="fw-bold text-navy">{{ $mbr->age }} yrs</span>
                                @endif
                                @if($mbr->date_of_birth)
                                    <small class="d-block text-muted" style="font-size: 0.72rem;">{{ \Carbon\Carbon::parse($mbr->date_of_birth)->format('d M Y') }}</small>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold text-navy small">{{ $mbr->phone ?: 'N/A' }}</div>
                                <small class="text-muted text-truncate d-block" style="max-width: 160px;" title="{{ $mbr->address }}">
                                    {{ $mbr->address }}
                                </small>
                            </td>
                            <td>
                                <div class="fw-semibold text-navy small text-truncate" style="max-width: 180px;">
                                    {{ $mbr->occupation ?: 'General' }}
                                </div>
                                <small class="text-muted text-truncate d-block" style="max-width: 180px;">
                                    {{ $mbr->education_qualification ?: 'Not specified' }}
                                </small>
                            </td>
                            <td class="small text-muted">
                                {{ $mbr->created_at ? $mbr->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td>
                                @php
                                    $badgeClass = match($mbr->status) {
                                        'approved' => 'bg-success',
                                        'under_review' => 'bg-info text-white',
                                        'rejected' => 'bg-danger',
                                        default => 'bg-warning text-dark'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} text-capitalize px-2 py-1" style="font-size: 0.75rem;">
                                    {{ str_replace('_', ' ', $mbr->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex align-items-center gap-1">
                                    <a href="{{ route('admin.members.show', $mbr->id) }}" class="btn btn-sm btn-outline-primary" title="Review Full Member Profile">
                                        <i class="fa-solid fa-eye"></i> View
                                    </a>
                                    
                                    <form action="{{ route('admin.members.destroy', $mbr->id) }}" method="POST" class="d-inline" data-confirm-prompt="Do you want to delete member application for {{ $mbr->full_name }}?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Member Record">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-users-viewfinder fs-1 mb-2 d-block text-secondary opacity-50"></i>
                                <div class="fw-semibold">No member applications found.</div>
                                <div class="small">New applications submitted through the public Membership form will appear here with photos and full credentials.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($members->hasPages())
            <div class="p-3 border-top d-flex justify-content-center">
                {{ $members->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

@endsection

