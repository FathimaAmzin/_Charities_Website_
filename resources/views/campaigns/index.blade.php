@extends('layouts.app')

@section('title', 'Fundraising Campaigns | Social Development Council (SDC)')
@section('meta_description', 'Support active humanitarian fundraising campaigns by the Social Development Council to fund clean water, emergency relief, and child education.')

@section('content')

    <!-- Campaigns Banner -->
    <section class="page-header-banner">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.25); color: #93C5FD;">Give Hope, Save Lives</span>
            <h1 class="display-4 fw-bold text-white mb-2">Fundraising Campaigns</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Campaigns</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Search & Filter Bar -->
    <section class="py-4 bg-white border-bottom shadow-sm">
        <div class="container">
            <form action="{{ route('campaigns.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="search" class="form-control form-control-custom border-start-0" placeholder="Search campaigns by appeal title or description..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-8">
                    <select name="category" class="form-select form-select-custom" onchange="this.form.submit()">
                        <option value="">All Appeal Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-lg-2 col-md-2 col-4">
                    <button type="submit" class="btn btn-teal w-100 justify-content-center">Search</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Campaigns Section with Tabs -->
    <section class="py-5 bg-light">
        <div class="container py-lg-4">
            <!-- Tabs Navigation -->
            <ul class="nav nav-pills justify-content-center mb-5 gap-2" id="campaignsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-pill px-4 py-2" id="active-tab" data-bs-toggle="pill" data-bs-target="#active-campaigns" type="button" role="tab" aria-selected="true">
                        <i class="fa-solid fa-fire text-danger me-1"></i> Active Appeals ({{ $activeCampaigns->count() }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-4 py-2" id="upcoming-tab" data-bs-toggle="pill" data-bs-target="#upcoming-campaigns" type="button" role="tab" aria-selected="false">
                        <i class="fa-solid fa-clock text-warning me-1"></i> Upcoming ({{ $upcomingCampaigns->count() }})
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-4 py-2" id="completed-tab" data-bs-toggle="pill" data-bs-target="#completed-campaigns" type="button" role="tab" aria-selected="false">
                        <i class="fa-solid fa-circle-check text-success me-1"></i> Completed ({{ $completedCampaigns->count() }})
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="campaignsTabsContent">
                <!-- 1. Active Campaigns -->
                <div class="tab-pane fade show active" id="active-campaigns" role="tabpanel" aria-labelledby="active-tab">
                    <div class="row g-4">
                        @forelse($activeCampaigns as $campaign)
                            <div class="col-lg-4 col-md-6">
                                <div class="charity-card">
                                    <div class="card-img-wrap">
                                        <img src="{{ $campaign->image_url }}" alt="{{ $campaign->title }}" loading="lazy">
                                        <span class="card-category-badge">{{ $campaign->category->name ?? 'Appeal' }}</span>
                                        <span class="card-status-badge status-active">Active</span>
                                    </div>
                                    <div class="charity-card-body">
                                        <h3 class="charity-card-title">{{ $campaign->title }}</h3>
                                        <p class="charity-card-desc">{{ Str::limit($campaign->description, 120) }}</p>

                                        <div class="mt-auto">
                                            <div class="progress-meta">
                                                <span>Target: Rs. {{ number_format($campaign->target_amount, 0) }}</span>
                                                <span class="text-teal fw-bold">{{ $campaign->progress_percent }}%</span>
                                            </div>
                                            <div class="progress-custom">
                                                <div class="progress-custom-bar" style="width: {{ $campaign->progress_percent }}%;"></div>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <div>
                                                    <span class="small text-muted d-block">Raised:</span>
                                                    <strong class="text-navy fs-5">Rs. {{ number_format($campaign->amount_raised, 2) }}</strong>
                                                </div>
                                                <span class="badge bg-light text-dark border p-2"><i class="fa-solid fa-users me-1 text-teal"></i> {{ $campaign->donor_count ?? 0 }} Donors</span>
                                            </div>

                                            <div class="d-flex gap-2">
                                                <a href="{{ route('donate', ['campaign_id' => $campaign->id]) }}" class="btn btn-teal w-100 justify-content-center">
                                                    <i class="fa-solid fa-heart"></i> Donate Now
                                                </a>
                                                <a href="{{ route('campaigns.show', $campaign->slug) }}" class="btn btn-outline-navy" title="View Campaign Details">
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <p class="text-muted">No active fundraising campaigns match your criteria.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- 2. Upcoming Campaigns -->
                <div class="tab-pane fade" id="upcoming-campaigns" role="tabpanel" aria-labelledby="upcoming-tab">
                    <div class="row g-4">
                        @forelse($upcomingCampaigns as $campaign)
                            <div class="col-lg-4 col-md-6">
                                <div class="charity-card">
                                    <div class="card-img-wrap">
                                        <img src="{{ $campaign->image_url }}" alt="{{ $campaign->title }}" loading="lazy">
                                        <span class="card-category-badge">{{ $campaign->category->name ?? 'Upcoming' }}</span>
                                        <span class="card-status-badge status-upcoming">Upcoming</span>
                                    </div>
                                    <div class="charity-card-body">
                                        <h3 class="charity-card-title">{{ $campaign->title }}</h3>
                                        <p class="charity-card-desc">{{ Str::limit($campaign->description, 120) }}</p>
                                        <div class="mt-auto">
                                            <span class="text-muted small d-block mb-2">Projected Launch: <strong>{{ $campaign->start_date ? $campaign->start_date->format('M d, Y') : 'Coming Soon' }}</strong></span>
                                            <a href="{{ route('campaigns.show', $campaign->slug) }}" class="btn btn-outline-navy w-100 justify-content-center">Preview Campaign</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <p class="text-muted">No upcoming campaigns scheduled at this time.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- 3. Completed Campaigns -->
                <div class="tab-pane fade" id="completed-campaigns" role="tabpanel" aria-labelledby="completed-tab">
                    <div class="row g-4">
                        @forelse($completedCampaigns as $campaign)
                            <div class="col-lg-4 col-md-6">
                                <div class="charity-card">
                                    <div class="card-img-wrap">
                                        <img src="{{ $campaign->image_url }}" alt="{{ $campaign->title }}" loading="lazy">
                                        <span class="card-category-badge">{{ $campaign->category->name ?? 'Completed' }}</span>
                                        <span class="card-status-badge status-completed">Completed</span>
                                    </div>
                                    <div class="charity-card-body">
                                        <h3 class="charity-card-title">{{ $campaign->title }}</h3>
                                        <p class="charity-card-desc">{{ Str::limit($campaign->description, 120) }}</p>
                                        <div class="mt-auto">
                                            <div class="p-2 rounded bg-success-subtle text-success text-center mb-2 fw-semibold small">
                                                <i class="fa-solid fa-check-double me-1"></i> Successfully Funded 100%
                                            </div>
                                            <a href="{{ route('campaigns.show', $campaign->slug) }}" class="btn btn-outline-secondary w-100 justify-content-center">View Impact Report</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <p class="text-muted">No archived campaigns listed.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
