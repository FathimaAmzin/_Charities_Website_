@extends('admin.layouts.app')

@section('title', 'Manage Volunteers')
@section('page_title', 'Volunteer Applications & Records')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h4 class="fw-bold text-navy mb-1">Registered Volunteers</h4>
            <p class="text-muted small mb-0">Screen candidate profiles, inspect verified particulars, NICs, photos, and review applications.</p>
        </div>
        <div>
            <a href="{{ route('volunteer.register') }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-2 fw-semibold">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Public Volunteer Form
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="admin-card mb-4">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.volunteers.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-7">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Search applicant by name, NIC, phone, occupation, or education..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Screening</option>
                        <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-navy w-100">Filter</button>
                    @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('admin.volunteers.index') }}" class="btn btn-outline-secondary" title="Clear Filters"><i class="fa-solid fa-rotate-left"></i></a>
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
                        <th style="min-width: 220px;">Volunteer</th>
                        <th>NIC Number</th>
                        <th>Age / DOB</th>
                        <th>Phone & Address</th>
                        <th>Education & Occupation</th>
                        <th>Applied Date</th>
                        <th>Status</th>
                        <th class="text-end" style="min-width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($volunteers as $vol)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $vol->photo_url }}" alt="{{ $vol->full_name }}" class="rounded-circle border shadow-sm flex-shrink-0" width="46" height="46" style="object-fit: cover;">
                                    <div class="overflow-hidden">
                                        <strong class="text-navy d-block text-truncate" style="max-width: 170px;">{{ $vol->full_name }}</strong>
                                        <small class="text-muted text-truncate d-block" style="max-width: 170px;">{{ $vol->email ?: 'No email' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($vol->nic_no)
                                    <span class="badge bg-light text-navy border font-monospace fw-semibold px-2 py-1">{{ $vol->nic_no }}</span>
                                @else
                                    <span class="text-muted small">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($vol->age)
                                    <span class="fw-bold text-navy">{{ $vol->age }} yrs</span>
                                @endif
                                @if($vol->date_of_birth)
                                    <small class="d-block text-muted" style="font-size: 0.72rem;">{{ \Carbon\Carbon::parse($vol->date_of_birth)->format('d M Y') }}</small>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold text-navy small">{{ $vol->phone ?: 'N/A' }}</div>
                                <small class="text-muted text-truncate d-block" style="max-width: 160px;" title="{{ $vol->address }}">
                                    {{ $vol->address ?: ($vol->country ?: 'Sri Lanka') }}
                                </small>
                            </td>
                            <td>
                                <div class="fw-semibold text-navy small text-truncate" style="max-width: 180px;">
                                    {{ $vol->occupation ?: 'General' }}
                                </div>
                                <small class="text-muted text-truncate d-block" style="max-width: 180px;">
                                    {{ $vol->education_qualification ?: 'Not specified' }}
                                </small>
                            </td>
                            <td class="small text-muted">
                                {{ $vol->created_at ? $vol->created_at->format('M d, Y') : 'N/A' }}
                            </td>
                            <td>
                                @php
                                    $badgeClass = match($vol->status) {
                                        'approved' => 'bg-success',
                                        'under_review' => 'bg-info text-white',
                                        'rejected' => 'bg-danger',
                                        default => 'bg-warning text-dark'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} text-capitalize px-2 py-1" style="font-size: 0.75rem;">
                                    {{ str_replace('_', ' ', $vol->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex align-items-center gap-1">
                                    <a href="{{ route('admin.volunteers.show', $vol->id) }}" class="btn btn-sm btn-outline-primary" title="Review Full Volunteer Profile">
                                        <i class="fa-solid fa-eye"></i> View
                                    </a>
                                    
                                    <form action="{{ route('admin.volunteers.destroy', $vol->id) }}" method="POST" class="d-inline" data-confirm-prompt="Do you want to delete volunteer profile for {{ $vol->full_name }}?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Volunteer Application">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-hands-holding-child fs-1 mb-2 d-block text-secondary opacity-50"></i>
                                <div class="fw-semibold">No volunteer applications found.</div>
                                <div class="small">New applications submitted from the website will appear here with photos and full details.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($volunteers->hasPages())
            <div class="p-3 border-top d-flex justify-content-center">
                {{ $volunteers->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

@endsection
