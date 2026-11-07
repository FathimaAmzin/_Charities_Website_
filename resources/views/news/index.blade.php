@extends('layouts.app')

@section('title', 'News & Events | Social Development Council (SDC)')
@section('meta_description', 'Latest news, press releases, field updates, and upcoming outreach events by the Social Development Council.')

@section('content')

    <!-- Banner -->
    <section class="page-header-banner">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.25); color: #93C5FD;">Field Dispatches</span>
            <h1 class="display-4 fw-bold text-white mb-2">News & Community Events</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">News & Events</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Search Bar -->
    <section class="py-4 bg-white border-bottom shadow-sm">
        <div class="container">
            <form action="{{ route('news.index') }}" method="GET" class="row g-3 align-items-center justify-content-between">
                <div class="col-lg-6 col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="search" class="form-control form-control-custom border-start-0" placeholder="Search articles, press releases, or events..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4">
                    <button type="submit" class="btn btn-teal w-100 justify-content-center">Search News</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Content Sections -->
    <section class="py-5 bg-light">
        <div class="container py-lg-4">
            
            <!-- Latest News Articles -->
            <div class="mb-5">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <span class="section-badge">Press & Reports</span>
                        <h2 class="section-title mb-0">Latest Organization News</h2>
                    </div>
                </div>

                <div class="row g-4">
                    @forelse($news as $article)
                        <div class="col-lg-4 col-md-6">
                            <div class="charity-card">
                                <div class="card-img-wrap">
                                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy">
                                    <span class="card-category-badge">{{ ucfirst($article->type) }}</span>
                                    <span class="card-status-badge bg-dark text-white">
                                        <i class="fa-regular fa-calendar me-1"></i> {{ $article->published_at ? $article->published_at->format('M d, Y') : date('M d, Y') }}
                                    </span>
                                </div>
                                <div class="charity-card-body">
                                    @if($article->location)
                                        <div class="small text-muted mb-2"><i class="fa-solid fa-location-dot me-1 text-teal"></i> {{ $article->location }}</div>
                                    @endif
                                    <h3 class="charity-card-title fs-5">{{ $article->title }}</h3>
                                    <p class="charity-card-desc">{{ Str::limit($article->summary ?? $article->content, 130) }}</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('news.show', $article->slug) }}" class="btn btn-sm btn-outline-navy w-100 justify-content-center">
                                            Read Full Article <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4">
                            <p class="text-muted">No news articles found matching your criteria.</p>
                        </div>
                    @endforelse
                </div>

                @if($news->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $news->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>

            <!-- Upcoming Events Section -->
            <div class="mb-5 pt-4 border-top">
                <div class="mb-4">
                    <span class="section-badge">Calendar</span>
                    <h2 class="section-title mb-0">Upcoming Community Events</h2>
                </div>

                <div class="row g-4">
                    @forelse($upcomingEvents as $evt)
                        <div class="col-lg-6">
                            <div class="charity-card flex-md-row">
                                <div class="card-img-wrap w-md-40" style="height: auto; min-height: 200px;">
                                    <img src="{{ $evt->image_url }}" alt="{{ $evt->title }}" loading="lazy">
                                    <span class="card-status-badge status-active">Upcoming</span>
                                </div>
                                <div class="charity-card-body w-md-60">
                                    <div class="d-flex align-items-center gap-2 text-teal small fw-bold mb-1">
                                        <i class="fa-regular fa-calendar-days"></i>
                                        <span>{{ $evt->event_date ? $evt->event_date->format('l, F j, Y') : 'TBA' }}</span>
                                    </div>
                                    <h4 class="charity-card-title fs-5">{{ $evt->title }}</h4>
                                    <div class="text-muted small mb-2"><i class="fa-solid fa-location-dot me-1"></i> {{ $evt->location ?? 'Main Center' }}</div>
                                    <p class="charity-card-desc mb-3">{{ Str::limit($evt->description, 110) }}</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('events.show', $evt->slug) }}" class="btn btn-sm btn-teal">
                                            Event Details & Registration
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="p-4 bg-white rounded-3 border text-center text-muted">
                                No upcoming events scheduled at this moment. Stay tuned for future announcements.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Past Events Section -->
            @if($pastEvents->count() > 0)
                <div class="pt-4 border-top">
                    <div class="mb-4">
                        <span class="section-badge">Archive</span>
                        <h2 class="section-title mb-0">Past Events & Outcomes</h2>
                    </div>

                    <div class="row g-3">
                        @foreach($pastEvents as $pevt)
                            <div class="col-md-6 col-lg-4">
                                <div class="p-3 bg-white rounded-3 border h-100">
                                    <span class="badge bg-secondary mb-2">Concluded</span>
                                    <h6 class="fw-bold text-navy mb-1">{{ $pevt->title }}</h6>
                                    <div class="small text-muted mb-2"><i class="fa-regular fa-calendar me-1"></i> {{ $pevt->event_date ? $pevt->event_date->format('M d, Y') : 'Completed' }} &bull; {{ $pevt->location }}</div>
                                    <p class="small text-muted mb-2">{{ Str::limit($pevt->description, 90) }}</p>
                                    <a href="{{ route('events.show', $pevt->slug) }}" class="small text-teal fw-semibold">View Summary <i class="fa-solid fa-angle-right"></i></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>

@endsection
