@extends('admin.layouts.app')

@section('title', 'Donor Profile: ' . $donor->name)
@section('page_title', 'Donor Profile')

@section('content')

    <div class="mb-4">
        <a href="{{ route('admin.donors.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Donors
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="admin-card text-center p-4">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($donor->name) }}&background=12345A&color=fff&size=90" class="rounded-circle shadow-sm mb-3" width="90" height="90" alt="">
                <h4 class="fw-bold text-navy mb-1">{{ $donor->name }}</h4>
                <div class="badge bg-light text-navy border mb-3">{{ $donor->role }}</div>

                <div class="p-3 bg-light rounded-3 text-start mb-3">
                    <div class="small text-muted mb-1"><i class="fa-solid fa-envelope text-teal me-2"></i> {{ $donor->email }}</div>
                    <div class="small text-muted mb-1"><i class="fa-solid fa-phone text-teal me-2"></i> {{ $donor->phone ?? 'No phone' }}</div>
                    <div class="small text-muted"><i class="fa-solid fa-earth-americas text-teal me-2"></i> {{ $donor->country ?? 'Sri Lanka' }}</div>
                </div>

                <div class="p-3 rounded-3 text-center" style="background-color: #EBF3FC;">
                    <div class="small text-teal fw-bold text-uppercase">Lifetime Contributions (LKR)</div>
                    <div class="fs-3 fw-bold text-navy" style="color: #12345A !important;">Rs. {{ number_format($totalContributed, 2) }}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title"><i class="fa-solid fa-clock-rotate-left text-teal me-2"></i> Donation History</h5>
                </div>
                <div class="table-responsive">
                    <table class="table admin-table align-middle">
                        <thead>
                            <tr>
                                <th>Receipt Ref</th>
                                <th>Allocated Cause</th>
                                <th>Amount (LKR / Rs.)</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($donor->donations as $dn)
                                <tr>
                                    <td><span class="badge badge-receipt font-monospace">{{ $dn->receipt_code }}</span></td>
                                    <td>{{ $dn->campaign->title ?? ($dn->project->title ?? 'General Relief') }}</td>
                                    <td><strong class="text-teal">Rs. {{ number_format($dn->amount, 2) }}</strong></td>
                                    <td class="small text-muted">{{ $dn->created_at->format('M d, Y h:i A') }}</td>
                                    <td>
                                        <span class="badge {{ $dn->status === 'completed' ? 'bg-success' : 'bg-warning text-dark' }} text-capitalize">
                                            {{ $dn->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No donation transactions recorded for this account.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
