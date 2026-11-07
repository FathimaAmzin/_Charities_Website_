@extends('admin.layouts.app')

@section('title', 'Manage Beneficiaries')
@section('page_title', 'Beneficiary Assistance Registry')

@section('content')

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-navy mb-1">Beneficiary Assistance Cases</h4>
            <p class="text-muted small mb-0">Confidential welfare registry for tracking household aid, medical sponsorships, and food relief.</p>
        </div>
        <div>
            <a href="{{ route('admin.beneficiaries.create') }}" class="btn btn-teal">
                <i class="fa-solid fa-user-plus me-1"></i> Register New Beneficiary Case
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="admin-card mb-4">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.beneficiaries.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Search by name, ref code, NIC or phone..." value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">All Review Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Verification</option>
                        <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Under Field Review</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved for Aid</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Assistance Completed</option>
                    </select>
                </div>

                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-navy w-100">Filter Cases</button>
                    @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('admin.beneficiaries.index') }}" class="btn btn-outline-secondary" title="Clear Filters"><i class="fa-solid fa-rotate-left"></i></a>
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
                        <th>Case Ref</th>
                        <th>Applicant Full Name</th>
                        <th>Assistance Category</th>
                        <th>Family Members</th>
                        <th>Assigned Staff</th>
                        <th>Registered Date</th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beneficiaries as $b)
                        <tr>
                            <td><span class="badge badge-receipt font-monospace">{{ $b->application_ref }}</span></td>
                            <td>
                                <strong class="text-navy">{{ $b->full_name }}</strong>
                                <span class="d-block small text-muted">{{ $b->phone }}</span>
                            </td>
                            <td><span class="badge badge-assistance">{{ $b->category }}</span></td>
                            <td>{{ $b->family_members_count }} members</td>
                            <td class="small">{{ $b->assigned_staff ?? 'Unassigned' }}</td>
                            <td class="small text-muted">{{ $b->created_at->format('M d, Y') }}</td>
                            <td>
                                <span class="badge {{ $b->status_badge }} text-capitalize">
                                    {{ str_replace('_', ' ', $b->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.beneficiaries.show', $b->id) }}" class="btn-action-view" title="Review Case">
                                    <i class="fa-solid fa-folder-open me-1"></i> Review Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-id-card-clip fs-1 mb-2 d-block text-muted"></i>
                                No beneficiary cases found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($beneficiaries->hasPages())
            <div class="p-3 border-top d-flex justify-content-center">
                {{ $beneficiaries->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

@endsection
