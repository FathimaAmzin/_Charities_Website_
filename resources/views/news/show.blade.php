@extends('layouts.app')

@section('title', $article->title . ' | SDC News')
@section('meta_description', Str::limit($article->summary ?? $article->content, 150))

@section('content')

    <!-- Banner -->
    <section class="page-header-banner">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.25); color: #93C5FD;">{{ ucfirst($article->type) }} Dispatch</span>
            <h1 class="display-5 fw-bold text-white mb-2">{{ $article->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News & Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($article->title, 25) }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-5 bg-white">
        <div class="container py-lg-4">
            <div class="row g-4 g-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center gap-3 text-muted small mb-4 pb-3 border-bottom">
                        <span><i class="fa-regular fa-calendar text-teal me-1"></i> Published: <strong>{{ $article->published_at ? $article->published_at->format('F j, Y') : date('F j, Y') }}</strong></span>
                        @if($article->location)
                            <span>&bull;</span>
                            <span><i class="fa-solid fa-location-dot text-teal me-1"></i> {{ $article->location }}</span>
                        @endif
                    </div>

                    <div class="rounded-4 overflow-hidden mb-4 shadow-sm" style="max-height: 440px;">
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="img-fluid w-100" style="object-fit: cover; max-height: 440px;">
                    </div>

                    @if($article->summary)
                        <div class="p-3 rounded-3 bg-light border-start border-4 border-teal mb-4 fs-5 fst-italic text-navy" style="border-color: var(--secondary-teal) !important;">
                            {{ $article->summary }}
                        </div>
                    @endif

                    <div class="article-body text-body mb-5" style="line-height: 1.85; font-size: 1.05rem;">
                        <p>{{ $article->content }}</p>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                        <a href="{{ route('news.index') }}" class="btn btn-outline-navy">
                            <i class="fa-solid fa-arrow-left me-1"></i> Back to News
                        </a>
                        <div class="d-flex align-items-center gap-2">
                            <span class="small text-muted">Share:</span>
                            <a href="https://facebook.com" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 34px; height: 34px;" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://twitter.com" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle" style="width: 34px; height: 34px;" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar Recent News -->
                <div class="col-lg-4">
                    <div class="card border rounded-4 shadow-sm p-4 sticky-top" style="top: 100px;">
                        <h5 class="fw-bold text-navy mb-3">Recent Stories</h5>
                        <div class="d-flex flex-column gap-3">
                            @foreach($recentNews as $rn)
                                <div class="d-flex gap-3 align-items-start border-bottom pb-3">
                                    <img src="{{ $rn->image_url }}" alt="{{ $rn->title }}" class="rounded-2" style="width: 70px; height: 70px; object-fit: cover;">
                                    <div>
                                        <h6 class="fw-bold mb-1" style="font-size: 0.92rem;"><a href="{{ route('news.show', $rn->slug) }}" class="text-navy hover-teal">{{ Str::limit($rn->title, 55) }}</a></h6>
                                        <span class="small text-muted"><i class="fa-regular fa-calendar me-1"></i> {{ $rn->published_at ? $rn->published_at->format('M d, Y') : date('M d, Y') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 p-3 rounded-3 bg-light text-center">
                            <h6 class="fw-bold text-navy mb-1">Stay Connected</h6>
                            <p class="small text-muted mb-3">Support our community projects with a monthly or one-time gift.</p>
                            <a href="{{ route('donate') }}" class="btn btn-sm btn-teal w-100">Donate Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
