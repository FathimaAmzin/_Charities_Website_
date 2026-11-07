@extends('layouts.app')

@section('title', $project->title . ' | SDC Projects')
@section('meta_description', Str::limit($project->short_description ?? $project->description, 150))

@section('content')

    <!-- Banner -->
    <section class="page-header-banner">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.25); color: #93C5FD;">{{ $project->category->name ?? 'Community Initiative' }}</span>
            <h1 class="display-5 fw-bold text-white mb-2">{{ $project->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($project->title, 25) }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Project Details Body -->
    <section class="py-5 bg-white">
        <div class="container py-lg-4">
            <div class="row g-4 g-lg-5">
                <!-- Main Content Left -->
                <div class="col-lg-8">
                    <div class="rounded-4 overflow-hidden mb-4 shadow-sm" style="max-height: 440px;">
                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="img-fluid w-100" style="object-fit: cover; max-height: 440px;">
                    </div>

                    <div class="d-flex flex-wrap align-items-center gap-3 mb-4 pb-3 border-bottom text-muted small">
                        <span><i class="fa-solid fa-location-dot text-teal me-1"></i> <strong>Location:</strong> {{ $project->location ?? 'Regional Program' }}</span>
                        <span>&bull;</span>
                        <span><i class="fa-solid fa-layer-group text-teal me-1"></i> <strong>Category:</strong> {{ $project->category->name ?? 'Community' }}</span>
                        <span>&bull;</span>
                        <span><i class="fa-solid fa-circle-check text-success me-1"></i> <strong>Status:</strong> <span class="badge bg-success text-capitalize">{{ $project->status }}</span></span>
                    </div>

                    <h3 class="fw-bold text-navy mb-3">Project Overview</h3>
                    <div class="text-body mb-4" style="line-height: 1.8; font-size: 1.05rem;">
                        <p>{{ $project->description ?? $project->short_description }}</p>
                    </div>

                    <div class="p-4 rounded-3 bg-light border mb-4">
                        <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-shield-halved text-teal me-2"></i> Our Transparency Guarantee</h5>
                        <p class="text-muted small mb-0">
                            The Social Development Council audits all project expenditures through certified independent accountants. 100% of earmarked donations go directly to funding field materials, local logistics, and beneficiary support.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('donate', ['project_id' => $project->id]) }}" class="btn btn-teal px-4 py-2 fs-6">
                            <i class="fa-solid fa-heart"></i> Donate to this Project
                        </a>
                        <a href="{{ route('volunteer.register') }}" class="btn btn-outline-navy px-4 py-2 fs-6">
                            <i class="fa-solid fa-hand-holding-hand"></i> Volunteer on this Project
                        </a>
                    </div>
                </div>

                <!-- Sidebar Right -->
                <div class="col-lg-4">
                    <div class="card border rounded-4 shadow-sm p-4 sticky-top" style="top: 100px;">
                        <h5 class="fw-bold text-navy mb-3">Fundraising Goal</h5>
                        
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <div>
                                <span class="text-muted small d-block">Raised:</span>
                                <h3 class="fw-bold text-teal mb-0">Rs. {{ number_format($project->amount_raised, 2) }}</h3>
                            </div>
                            <div class="text-end">
                                <span class="text-muted small d-block">Target Goal:</span>
                                <span class="fw-bold text-navy">Rs. {{ number_format($project->target_amount, 2) }}</span>
                            </div>
                        </div>

                        <div class="progress-custom mb-3">
                            <div class="progress-custom-bar" style="width: {{ $project->progress_percent }}%;"></div>
                        </div>

                        <div class="text-center text-muted small mb-4">
                            <strong>{{ $project->progress_percent }}%</strong> of required funding secured.
                        </div>

                        <a href="{{ route('donate', ['project_id' => $project->id]) }}" class="btn btn-donate-highlight w-100 justify-content-center py-3 fs-6 mb-3">
                            <i class="fa-solid fa-heart"></i> Support This Project
                        </a>

                        <hr class="my-3">

                        <h6 class="fw-bold text-navy mb-2">Share this Project</h6>
                        <div class="d-flex gap-2">
                            <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-outline-secondary w-100"><i class="fa-brands fa-facebook-f"></i> Share</a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($project->title) }}" target="_blank" class="btn btn-sm btn-outline-secondary w-100"><i class="fa-brands fa-x-twitter"></i> Tweet</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
