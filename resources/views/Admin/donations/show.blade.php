@extends('admin.layouts.app')

@section('title', 'Donation Ref: ' . $donation->receipt_code)
@section('page_title', 'Donation Voucher Details')

@section('content')

    <div class="mb-4">
        <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Donations
        </a>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">Donation Record: {{ $donation->receipt_code }}</h5>
                    <span class="badge {{ $donation->status === 'completed' ? 'bg-success' : 'bg-warning text-dark' }} text-capitalize">
                        {{ $donation->status }}
                    </span>
                </div>
                <div class="admin-card-body p-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Donor Full Name:</span>
                            <strong class="text-navy fs-6">{{ $donation->donor_name }}</strong>
                            @if($donation->anonymous)
                                <span class="badge bg-secondary ms-1">Anonymous</span>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Donor Email Address:</span>
                            <strong class="text-navy fs-6">{{ $donation->email }}</strong>
                        </div>

                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Donor Phone:</span>
                            <span>{{ $donation->phone ?? 'Not provided' }}</span>
                        </div>

                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Transaction Timestamp:</span>
                            <span>{{ $donation->created_at->format('l, F j, Y h:i:s A') }}</span>
                        </div>

                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Allocated Appeal / Project:</span>
                            <strong class="text-teal">{{ $donation->campaign->title ?? ($donation->project->title ?? 'General Humanitarian Relief') }}</strong>
                        </div>

                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Payment Method / Gateway:</span>
                            <span class="badge badge-receipt text-capitalize">{{ str_replace('_', ' ', $donation->payment_method) }}</span>
                        </div>

                        <div class="col-12"><hr></div>

                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Total Donation Amount:</span>
                            <h3 class="fw-bold text-teal mb-0">Rs. {{ number_format($donation->amount, 2) }} LKR</h3>
                        </div>

                        <div class="col-sm-6 d-flex align-items-center justify-content-sm-end">
                            @if($donation->status !== 'completed')
                                <form action="{{ route('admin.donations.verify', $donation->id) }}" method="POST" onsubmit="return confirm('Confirm verification of this donation?')">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa-solid fa-check me-1"></i> Verify & Mark Completed
                                    </button>
                                </form>
                            @else
                                <div class="text-success fw-bold">
                                    <i class="fa-solid fa-circle-check fs-5 me-1"></i> Formally Verified & Reconciled
                                </div>
                            @endif
                        </div>

                        @if($donation->message)
                            <div class="col-12 mt-3">
                                <label class="text-muted small fw-bold d-block">Donor Message / Dedication:</label>
                                <div class="p-3 bg-light rounded-3 border fst-italic">
                                    "{{ $donation->message }}"
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
