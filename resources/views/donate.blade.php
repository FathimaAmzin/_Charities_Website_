@extends('layouts.app')

@section('title', 'Make a Donation | Social Development Council (SDC)')
@section('meta_description', 'Support vulnerable families and humanitarian aid with a secure, tax-deductible donation to the Social Development Council.')

@section('content')

    <!-- Banner -->
    <section class="page-header-banner">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.25); color: #93C5FD;">Secure Humanitarian Giving</span>
            <h1 class="display-4 fw-bold text-white mb-2">Support Our Global Relief Mission</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Donate</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Donation Section -->
    <section class="py-5 bg-white">
        <div class="container py-lg-4">
            <div class="row g-4 g-lg-5">
                <!-- Donation Form Left -->
                <div class="col-lg-7">
                    <div class="card border rounded-4 shadow-sm p-4 p-md-5">
                        <span class="section-badge mb-2">Step-by-Step Giving</span>
                        <h3 class="fw-bold text-navy mb-4">Choose Your Contribution</h3>

                        <form action="{{ route('donate.store') }}" method="POST">
                            @csrf

                            <!-- 1. Preset Amount Buttons -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-navy mb-2">Select Donation Amount (LKR / Rs.)</label>
                                <div class="row g-2 mb-3">
                                    <div class="col-6 col-sm-3">
                                        <button type="button" class="btn btn-outline-navy w-100 py-3 fw-bold btn-preset-amount {{ $prefillAmount == 1000 ? 'active btn-teal' : '' }}" data-amount="1000">Rs. 1,000</button>
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <button type="button" class="btn btn-outline-navy w-100 py-3 fw-bold btn-preset-amount {{ $prefillAmount == 2500 ? 'active btn-teal' : '' }}" data-amount="2500">Rs. 2,500</button>
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <button type="button" class="btn btn-outline-navy w-100 py-3 fw-bold btn-preset-amount {{ $prefillAmount == 5000 ? 'active btn-teal' : '' }}" data-amount="5000">Rs. 5,000</button>
                                    </div>
                                    <div class="col-6 col-sm-3">
                                        <button type="button" class="btn btn-outline-navy w-100 py-3 fw-bold btn-preset-amount {{ $prefillAmount == 10000 ? 'active btn-teal' : '' }}" data-amount="10000">Rs. 10,000</button>
                                    </div>
                                </div>

                                <input type="hidden" name="amount_option" id="amount_option" value="{{ $prefillAmount }}">

                                <label for="amount_custom" class="form-label fw-semibold text-navy small">Or Enter a Custom Amount (Rs.)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light fw-bold text-navy">Rs.</span>
                                    <input type="number" step="0.01" min="1" class="form-control form-control-custom @error('amount_custom') is-invalid @enderror" id="amount_custom" name="amount_custom" placeholder="e.g. 5000.00" value="{{ old('amount_custom', $prefillAmount) }}">
                                    @error('amount_custom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- 2. Target Campaign or Project Allocation -->
                            <div class="mb-4">
                                <label for="campaign_id" class="form-label fw-bold text-navy mb-1">Direct this gift to a specific Appeal (Optional)</label>
                                <select class="form-select form-select-custom" id="campaign_id" name="campaign_id">
                                    <option value="">General Relief Fund (Where most needed)</option>
                                    @foreach($campaigns as $camp)
                                        <option value="{{ $camp->id }}" {{ (old('campaign_id') ?? $selectedCampaignId) == $camp->id ? 'selected' : '' }}>
                                            Appeal: {{ $camp->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- 3. Donor Identity Information -->
                            <div class="mb-4 pt-3 border-top">
                                <h5 class="fw-bold text-navy mb-3">Donor Details</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="donor_name" class="form-label fw-semibold text-navy small">Your Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-custom @error('donor_name') is-invalid @enderror" id="donor_name" name="donor_name" value="{{ old('donor_name', Auth::user()->name ?? '') }}" placeholder="Sarah Connor" required>
                                        @error('donor_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email" class="form-label fw-semibold text-navy small">Email Address <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}" placeholder="sarah@example.com" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="phone" class="form-label fw-semibold text-navy small">Phone Number (Optional)</label>
                                        <input type="text" class="form-control form-control-custom" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+1 555 123 4567">
                                    </div>

                                    <div class="col-md-6 d-flex align-items-center pt-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="anonymous" value="1" id="anonymous" {{ old('anonymous') ? 'checked' : '' }}>
                                            <label class="form-check-label small text-navy fw-semibold" for="anonymous">
                                                Make this donation anonymous
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="message" class="form-label fw-semibold text-navy small">Personal Message / Dedication (Optional)</label>
                                        <textarea class="form-control form-control-custom" id="message" name="message" rows="2" placeholder="In memory of, or words of encouragement...">{{ old('message') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- 4. Payment Gateway Mode Selection -->
                            <div class="mb-4 pt-3 border-top">
                                <h5 class="fw-bold text-navy mb-3">Payment Method</h5>
                                
                                <div class="alert alert-info border-0 rounded-3 small mb-3">
                                    <i class="fa-solid fa-circle-info me-1"></i>
                                    <strong>Safe Test Mode Active:</strong> Live credit card processing requires production Stripe / PayPal merchant credentials. This donation workflow runs in verified test mode without charging real cards.
                                </div>

                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check p-3 rounded-3 border bg-light d-flex align-items-center gap-2">
                                        <input class="form-check-input ms-0" type="radio" name="payment_method" id="pay_test" value="test_gateway" checked>
                                        <label class="form-check-label fw-semibold text-navy w-100 cursor-pointer" for="pay_test">
                                            <i class="fa-solid fa-shield-halved text-teal me-1"></i> Instant Secure Test Simulation (Instant Receipt Generated)
                                        </label>
                                    </div>

                                    <div class="form-check p-3 rounded-3 border bg-light d-flex align-items-center gap-2">
                                        <input class="form-check-input ms-0" type="radio" name="payment_method" id="pay_bank" value="bank_transfer">
                                        <label class="form-check-label fw-semibold text-navy w-100 cursor-pointer" for="pay_bank">
                                            <i class="fa-solid fa-building-columns text-navy me-1"></i> Direct International Wire / Bank Transfer
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-donate-highlight w-100 justify-content-center py-3 fs-5">
                                <i class="fa-solid fa-lock me-1"></i> Confirm & Complete Contribution
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right Summary Panel -->
                <div class="col-lg-5">
                    <div class="card border rounded-4 shadow-sm p-4 sticky-top" style="top: 100px;">
                        <h4 class="fw-bold text-navy mb-3">Donation Summary</h4>

                        <div class="p-3 rounded-3 bg-light border mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">Allocated Amount:</span>
                                <strong class="fs-4 text-teal" id="summary-donation-amount">Rs. {{ number_format($prefillAmount, 2) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between align-items-center text-muted small">
                                <span>Platform Processing Fee:</span>
                                <span class="text-success fw-bold">FREE (Rs. 0.00)</span>
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-3 mb-4 small text-muted">
                            <div class="d-flex align-items-start gap-2">
                                <i class="fa-solid fa-receipt text-teal fs-5 mt-1"></i>
                                <span><strong>Instant E-Receipt:</strong> A verifiable voucher with tracking reference will be generated immediately.</span>
                            </div>
                            <div class="d-flex align-items-start gap-2">
                                <i class="fa-solid fa-lock text-teal fs-5 mt-1"></i>
                                <span><strong>Bank-Grade Encryption:</strong> Never stores raw payment cards. Protected by Laravel CSRF and encrypted protocols.</span>
                            </div>
                            <div class="d-flex align-items-start gap-2">
                                <i class="fa-solid fa-file-invoice text-teal fs-5 mt-1"></i>
                                <span><strong>Audit Transparency:</strong> Track project expenditure through published periodic impact reports.</span>
                            </div>
                        </div>

                        <div class="p-3 rounded-3 border bg-white text-center">
                            <img src="{{ asset('images/logo-sdc.jpg') }}" alt="SDC Charity" class="rounded-circle mb-2" style="width: 50px; height: 50px; object-fit: cover; border: 2px solid var(--secondary-blue);" onerror="this.src='https://ui-avatars.com/api/?name=SDC&background=12345A&color=fff&size=80'">
                            <h6 class="fw-bold text-navy mb-0">Social Development Council</h6>
                            <span class="small text-muted">Registered Humanitarian Trust &bull; Sri Lanka</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
