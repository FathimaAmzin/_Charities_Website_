@extends('layouts.app')

@section('title', $campaign->title . ' | SDC Fundraising Appeal')
@section('meta_description', Str::limit($campaign->description, 150))

@section('content')

    <!-- Banner -->
    <section class="page-header-banner">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.25); color: #93C5FD;">{{ $campaign->category->name ?? 'Humanitarian Appeal' }}</span>
            <h1 class="display-5 fw-bold text-white mb-2">{{ $campaign->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('campaigns.index') }}">Campaigns</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($campaign->title, 25) }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Content -->
    <section class="py-5 bg-white">
        <div class="container py-lg-4">
            <div class="row g-4 g-lg-5">
                <!-- Left Details -->
                <div class="col-lg-8">
                    <div class="rounded-4 overflow-hidden mb-4 shadow-sm" style="max-height: 440px;">
                        <img src="{{ $campaign->image_url }}" alt="{{ $campaign->title }}" class="img-fluid w-100" style="object-fit: cover; max-height: 440px;">
                    </div>

                    <div class="d-flex flex-wrap align-items-center gap-3 mb-4 pb-3 border-bottom text-muted small">
                        <span><i class="fa-solid fa-users text-teal me-1"></i> <strong>Supporters:</strong> {{ $campaign->donor_count ?? 0 }} Donors</span>
                        <span>&bull;</span>
                        <span><i class="fa-solid fa-calendar-check text-teal me-1"></i> <strong>Timeline:</strong> {{ $campaign->start_date ? $campaign->start_date->format('M Y') : 'Active' }} – {{ $campaign->end_date ? $campaign->end_date->format('M Y') : 'Ongoing' }}</span>
                        <span>&bull;</span>
                        <span><i class="fa-solid fa-circle-check text-success me-1"></i> <strong>Status:</strong> <span class="badge bg-success text-capitalize">{{ $campaign->status }}</span></span>
                    </div>

                    <h3 class="fw-bold text-navy mb-3">Why this Appeal Matters</h3>
                    <div class="text-body mb-4" style="line-height: 1.8; font-size: 1.05rem;">
                        <p>{{ $campaign->description }}</p>
                        <p>
                            Through the direct support of compassionate donors around the world, SDC provides immediate sustenance, shelter kits, medical attention, and clean drinking water to affected communities. All disbursements are verified and accounted for by local steering teams.
                        </p>
                    </div>

                    <!-- Direct Quick Donate Box -->
                    <div class="p-4 rounded-4 bg-light border mb-4">
                        <h4 class="fw-bold text-navy mb-2">Support this Emergency Appeal Today</h4>
                        <p class="text-muted small mb-3">Select an amount to make an immediate, secure contribution directly to this campaign.</p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <a href="{{ route('donate', ['campaign_id' => $campaign->id, 'amount' => 1000]) }}" class="btn btn-outline-navy">Rs. 1,000</a>
                            <a href="{{ route('donate', ['campaign_id' => $campaign->id, 'amount' => 2500]) }}" class="btn btn-outline-navy">Rs. 2,500</a>
                            <a href="{{ route('donate', ['campaign_id' => $campaign->id, 'amount' => 5000]) }}" class="btn btn-outline-navy">Rs. 5,000</a>
                            <a href="{{ route('donate', ['campaign_id' => $campaign->id, 'amount' => 10000]) }}" class="btn btn-outline-navy">Rs. 10,000</a>
                            <a href="{{ route('donate', ['campaign_id' => $campaign->id]) }}" class="btn btn-teal">Custom Amount</a>
                        </div>
                    </div>

                    @if($recentDonations->count() > 0)
                        <div class="mt-4">
                            <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-heart text-danger me-2"></i> Recent Verified Donors</h5>
                            <ul class="list-group list-group-flush rounded-3 border">
                                @foreach($recentDonations as $d)
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                        <div>
                                            <strong class="text-navy">{{ $d->donor_name }}</strong>
                                            <span class="text-muted small d-block">{{ $d->created_at->diffForHumans() }}</span>
                                        </div>
                                        <span class="badge fs-6 px-3 py-2" style="background-color: #EBF3FC; color: #245A91;">
                                            Rs. {{ number_format($d->amount, 2) }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <!-- Right Sticky Card -->
                <div class="col-lg-4">
                    <div class="card border rounded-4 shadow-sm p-4 sticky-top" style="top: 100px;">
                        <h5 class="fw-bold text-navy mb-3">Appeal Progress</h5>

                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <div>
                                <span class="text-muted small d-block">Raised:</span>
                                <h3 class="fw-bold text-teal mb-0">Rs. {{ number_format($campaign->amount_raised, 2) }}</h3>
                            </div>
                            <div class="text-end">
                                <span class="text-muted small d-block">Target Goal:</span>
                                <span class="fw-bold text-navy">Rs. {{ number_format($campaign->target_amount, 2) }}</span>
                            </div>
                        </div>

                        <div class="progress-custom mb-3">
                            <div class="progress-custom-bar" style="width: {{ $campaign->progress_percent }}%;"></div>
                        </div>

                        <div class="text-center text-muted small mb-4">
                            <strong>{{ $campaign->progress_percent }}%</strong> of goal funded by <strong>{{ $campaign->donor_count ?? 0 }}</strong> supporters.
                        </div>

                        <a href="{{ route('donate', ['campaign_id' => $campaign->id]) }}" class="btn btn-donate-highlight w-100 justify-content-center py-3 fs-6 mb-3">
                            <i class="fa-solid fa-heart"></i> Donate to this Appeal
                        </a>

                        <hr class="my-3">

                        <h6 class="fw-bold text-navy mb-2">Share this Appeal</h6>
                        <div class="d-flex gap-2">
                            <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-outline-secondary w-100"><i class="fa-brands fa-facebook-f"></i> Share</a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($campaign->title) }}" target="_blank" class="btn btn-sm btn-outline-secondary w-100"><i class="fa-brands fa-x-twitter"></i> Tweet</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
