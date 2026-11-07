@extends('admin.layouts.app')

@section('title', 'Manage Donors')
@section('page_title', 'Donor Management')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-navy mb-1">Registered Donors</h4>
            <p class="text-muted small mb-0">View registered donor profiles, contact coordinates, and lifetime giving histories.</p>
        </div>
    </div>

    <!-- Search Card -->
    <div class="admin-card mb-4">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.donors.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-9">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Search donor by name, email, or telephone..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-navy w-100">Search</button>
                    @if(request('search'))
                        <a href="{{ route('admin.donors.index') }}" class="btn btn-outline-secondary" title="Clear Search"><i class="fa-solid fa-rotate-left"></i></a>
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
                        <th>Donor Name</th>
                        <th>Email Address</th>
                        <th>Phone</th>
                        <th>Country</th>
                        <th>Registered Date</th>
                        <th>Total Contributions (LKR / Rs.)</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donors as $donor)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($donor->name) }}&background=12345A&color=fff&size=36" class="rounded-circle" width="36" height="36" alt="">
                                    <strong class="text-navy">{{ $donor->name }}</strong>
                                </div>
                            </td>
                            <td class="small">{{ $donor->email }}</td>
                            <td class="small">{{ $donor->phone ?? 'Not provided' }}</td>
                            <td class="small">{{ $donor->country ?? 'Sri Lanka' }}</td>
                            <td class="small text-muted">{{ $donor->created_at->format('M d, Y') }}</td>
                            <td>
                                <span class="badge badge-receipt fs-6 px-3 py-1">
                                    Rs. {{ number_format($donor->donations()->where('status', 'completed')->sum('amount'), 2) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.donors.show', $donor->id) }}" class="btn-action-view" title="View Profile">
                                    <i class="fa-solid fa-eye me-1"></i> Profile & History
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-users-slash fs-1 mb-2 d-block text-muted"></i>
                                No donors found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($donors->hasPages())
            <div class="p-3 border-top d-flex justify-content-center">
                {{ $donors->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

@endsection
