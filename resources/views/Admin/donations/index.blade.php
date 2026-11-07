@extends('admin.layouts.app')

@section('title', 'Manage Donations')
@section('page_title', 'Donations & Giving Management')

@section('content')

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-navy mb-1">Financial Donations</h4>
            <p class="text-muted small mb-0">Audit, verify, inspect payment vouchers, and export donor contribution records.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.donations.export', request()->all()) }}" class="btn btn-outline-teal">
                <i class="fa-solid fa-file-csv me-1"></i> Export CSV Report
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="admin-card mb-4">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.donations.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Search donor, email, ref..." value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <select name="campaign_id" class="form-select" onchange="this.form.submit()">
                        <option value="">All Campaigns</option>
                        @foreach($campaigns as $camp)
                            <option value="{{ $camp->id }}" {{ request('campaign_id') == $camp->id ? 'selected' : '' }}>{{ $camp->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed (Verified)</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Verification</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <input type="date" name="date_from" class="form-control" title="Date From" value="{{ request('date_from') }}">
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-navy w-100">Filter</button>
                    @if(request()->hasAny(['search', 'campaign_id', 'status', 'date_from']))
                        <a href="{{ route('admin.donations.index') }}" class="btn btn-outline-secondary" title="Reset Filters"><i class="fa-solid fa-rotate-left"></i></a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Box -->
    <div class="alert alert-light border rounded-3 d-flex justify-content-between align-items-center mb-4 py-2 px-3">
        <span class="text-muted small">Total Contributions for current filter selection:</span>
        <strong class="text-teal fs-5">Rs. {{ number_format($totalSum, 2) }} LKR</strong>
    </div>

    <!-- Data Table -->
    <div class="admin-card">
        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                    <tr>
                        <th>Receipt Code</th>
                        <th>Donor Name</th>
                        <th>Email / Contact</th>
                        <th>Program / Campaign</th>
                        <th>Amount (LKR / Rs.)</th>
                        <th>Payment Method</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donations as $donation)
                        <tr>
                            <td><span class="badge badge-receipt font-monospace">{{ $donation->receipt_code }}</span></td>
                            <td>
                                <strong class="text-navy">{{ $donation->donor_name }}</strong>
                                @if($donation->anonymous)
                                    <span class="badge bg-secondary small ms-1" style="font-size: 0.65rem;">Anonymous</span>
                                @endif
                            </td>
                            <td class="small">{{ $donation->email }}</td>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 140px;">
                                    {{ $donation->campaign->title ?? ($donation->project->title ?? 'General Fund') }}
                                </span>
                            </td>
                            <td><strong class="text-teal">Rs. {{ number_format($donation->amount, 2) }}</strong></td>
                            <td class="small text-muted text-capitalize">{{ str_replace('_', ' ', $donation->payment_method) }}</td>
                            <td class="small text-muted">{{ $donation->created_at->format('M d, Y h:i A') }}</td>
                            <td>
                                <span class="badge {{ $donation->status === 'completed' ? 'bg-success' : 'bg-warning text-dark' }} text-capitalize">
                                    {{ $donation->status }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <a href="{{ route('admin.donations.show', $donation->id) }}" class="btn-action-view" title="View Details">
                                        <i class="fa-solid fa-eye me-1"></i> Details
                                    </a>
                                    @if($donation->status !== 'completed')
                                        <form action="{{ route('admin.donations.verify', $donation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Verify and mark this payment as completed?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Verify Payment">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-hand-holding-dollar fs-1 mb-2 d-block text-muted"></i>
                                No donations found matching criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($donations->hasPages())
            <div class="p-3 border-top d-flex justify-content-center">
                {{ $donations->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

@endsection
