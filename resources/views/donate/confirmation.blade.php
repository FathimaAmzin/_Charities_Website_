@extends('layouts.app')

@section('title', 'Donation Receipt ' . $donation->receipt_code . ' | SDC')

@section('content')

    <!-- Banner -->
    <section class="page-header-banner">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.25); color: #93C5FD;">Official Receipt</span>
            <h1 class="display-4 fw-bold text-white mb-2">Thank You for Your Generosity</h1>
            <p class="text-white-50">Your gift directly supports communities in need through the Social Development Council.</p>
        </div>
    </section>

    <!-- Receipt Card -->
    <section class="py-5 bg-light">
        <div class="container py-lg-4">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card border rounded-4 shadow-sm p-4 p-md-5 bg-white" id="printableReceipt">
                        <div class="text-center mb-4">
                            <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background-color: #EBF3FC; color: #245A91; font-size: 2rem;">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <h3 class="fw-bold text-navy mb-1">Donation Verified Successfully</h3>
                            <div class="badge badge-receipt px-3 py-2 mt-1">Receipt Ref: {{ $donation->receipt_code }}</div>
                        </div>

                        <div class="border rounded-3 p-3 bg-light mb-4">
                            <div class="row g-2 small">
                                <div class="col-6 text-muted">Donor Name:</div>
                                <div class="col-6 text-end fw-bold text-navy">{{ $donation->donor_name }}</div>

                                <div class="col-6 text-muted">Donor Email:</div>
                                <div class="col-6 text-end fw-bold text-navy">{{ $donation->email }}</div>

                                <div class="col-6 text-muted">Allocated Program:</div>
                                <div class="col-6 text-end fw-bold text-teal">
                                    {{ $donation->campaign->title ?? ($donation->project->title ?? 'General Humanitarian Relief') }}
                                </div>

                                <div class="col-6 text-muted">Date & Time:</div>
                                <div class="col-6 text-end text-navy">{{ $donation->created_at->format('M d, Y h:i A') }}</div>

                                <div class="col-6 text-muted">Payment Method:</div>
                                <div class="col-6 text-end text-navy text-capitalize">{{ str_replace('_', ' ', $donation->payment_method) }}</div>

                                <div class="col-12"><hr class="my-2"></div>

                                <div class="col-6 text-navy fw-bold fs-5">Total Contributed:</div>
                                <div class="col-6 text-end fw-bold text-success fs-4">Rs. {{ number_format($donation->amount, 2) }} LKR</div>
                            </div>
                        </div>

                        <div class="alert alert-info border-0 rounded-3 small mb-4">
                            <i class="fa-solid fa-circle-info me-1"></i>
                            This official e-voucher serves as formal acknowledgment from the <strong>Social Development Council Maligaikadu Sri Lanka</strong>. Keep this reference for tax or inquiry purposes.
                        </div>

                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            <button type="button" class="btn btn-outline-navy" onclick="window.print()"><i class="fa-solid fa-print me-1"></i> Print Receipt</button>
                            <a href="{{ route('home') }}" class="btn btn-teal"><i class="fa-solid fa-house me-1"></i> Return to Homepage</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
