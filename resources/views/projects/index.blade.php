@extends('layouts.app')

@section('title', 'Community Projects | Social Development Council (SDC)')
@section('meta_description', 'Explore community development, healthcare, education, clean water, and disaster relief projects run by the Social Development Council.')

@section('content')

    <!-- Projects Page Banner -->
    <section class="page-header-banner">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.25); color: #93C5FD;">Sustainable Initiatives</span>
            <h1 class="display-4 fw-bold text-white mb-2">Our Community Projects</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Projects</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Search & Category Filters -->
    <section class="py-4 bg-white border-bottom shadow-sm">
        <div class="container">
            <form action="{{ route('projects.index') }}" method="GET" class="row g-3 align-items-center">
                <!-- Search Input -->
                <div class="col-lg-5 col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="search" class="form-control form-control-custom border-start-0" placeholder="Search projects by keyword or location..." value="{{ request('search') }}">
                    </div>
                </div>

                <!-- Category Select -->
                <div class="col-lg-3 col-md-3 col-6">
                    <select name="category" class="form-select form-select-custom" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Select -->
                <div class="col-lg-2 col-md-3 col-6">
                    <select name="status" class="form-select form-select-custom" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <!-- Filter & Reset Buttons -->
                <div class="col-lg-2 d-flex gap-2">
                    <button type="submit" class="btn btn-teal w-100 justify-content-center">Filter</button>
                    @if(request()->hasAny(['search', 'category', 'status']))
                        <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary" title="Reset Filters"><i class="fa-solid fa-rotate-left"></i></a>
                    @endif
                </div>
            </form>

            <!-- Quick Category Pill Tags -->
            <div class="d-flex flex-wrap gap-2 mt-3 pt-2 border-top">
                <a href="{{ route('projects.index') }}" class="filter-btn {{ !request('category') ? 'active' : '' }}">All</a>
                @foreach($categories as $cat)
                    <a href="{{ route('projects.index', ['category' => $cat->slug]) }}" class="filter-btn {{ request('category') == $cat->slug ? 'active' : '' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Projects Grid -->
    <section class="py-5 bg-light">
        <div class="container py-lg-4">
            <div class="row g-4">
                @forelse($projects as $project)
                    <div class="col-lg-4 col-md-6">
                        <div class="charity-card">
                            <div class="card-img-wrap">
                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" loading="lazy">
                                <span class="card-category-badge">{{ $project->category->name ?? 'Community' }}</span>
                                <span class="card-status-badge status-{{ strtolower($project->status) }}">{{ $project->status }}</span>
                            </div>
                            <div class="charity-card-body">
                                <div class="text-muted small mb-2">
                                    <i class="fa-solid fa-location-dot me-1 text-teal"></i> {{ $project->location ?? 'Global Field' }}
                                </div>
                                <h3 class="charity-card-title">{{ $project->title }}</h3>
                                <p class="charity-card-desc">{{ Str::limit($project->short_description ?? $project->description, 120) }}</p>

                                <div class="mt-auto">
                                    <div class="progress-meta">
                                        <span>Target: Rs. {{ number_format($project->target_amount, 0) }}</span>
                                        <span class="text-teal fw-bold">{{ $project->progress_percent }}%</span>
                                    </div>
                                    <div class="progress-custom">
                                        <div class="progress-custom-bar" style="width: {{ $project->progress_percent }}%;"></div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="small text-muted d-block">Raised:</span>
                                            <strong class="text-navy">Rs. {{ number_format($project->amount_raised, 2) }}</strong>
                                        </div>
                                        <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-sm btn-navy">
                                            View Details <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="py-5">
                            <i class="fa-solid fa-folder-open fs-1 text-muted mb-3"></i>
                            <h4 class="text-navy">No Projects Match Your Search</h4>
                            <p class="text-muted">Try clearing filters or searching with different keywords.</p>
                            <a href="{{ route('projects.index') }}" class="btn btn-teal mt-2">Reset All Filters</a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($projects->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $projects->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </section>

@endsection
