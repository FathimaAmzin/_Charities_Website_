@extends('layouts.app')

@section('title', 'Photo Gallery | Social Development Council (SDC)')
@section('meta_description', 'View photo moments from our frontline charity programs, medical health camps, school kit distributions, and clean water dedication ceremonies.')

@section('content')

    <!-- Gallery Banner -->
    <section class="page-header-banner">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.25); color: #93C5FD;">Moments of Hope</span>
            <h1 class="display-4 fw-bold text-white mb-2">Our Field Activities Gallery</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Category Filters -->
    <section class="py-4 bg-white border-bottom shadow-sm">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="{{ route('gallery.index') }}" class="filter-btn {{ !request('category') || request('category') == 'all' ? 'active' : '' }}">
                    All Photos
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('gallery.index', ['category' => $category]) }}" class="filter-btn {{ request('category') == $category ? 'active' : '' }}">
                        {{ $category }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-5 bg-light">
        <div class="container py-lg-4">
            <div class="row g-4">
                @forelse($images as $img)
                    <div class="col-lg-4 col-md-6">
                        <div class="gallery-item"
                             data-img-src="{{ $img->image_url }}"
                             data-img-title="{{ $img->title }}"
                             data-img-desc="{{ $img->description }}">
                            <img src="{{ $img->image_url }}" alt="{{ $img->title }}" loading="lazy">
                            <div class="gallery-item-overlay">
                                <span class="badge mb-1 align-self-start" style="background-color: #245A91;">{{ $img->category }}</span>
                                <h5 class="fw-bold mb-1 text-white">{{ $img->title }}</h5>
                                <p class="small text-white-50 mb-0">{{ Str::limit($img->description, 70) }}</p>
                                <span class="mt-2 text-white small"><i class="fa-solid fa-up-right-and-down-left-from-center me-1"></i> Click to enlarge</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No photographs found in this category.</p>
                        <a href="{{ route('gallery.index') }}" class="btn btn-teal">View All Photos</a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Lightbox Modal for Enlarged View -->
    <div class="modal fade" id="galleryLightboxModal" tabindex="-1" aria-labelledby="galleryLightboxModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark text-white border-0 rounded-4 overflow-hidden shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3 text-center">
                    <img id="lightboxImage" src="" alt="Enlarged Photo" class="img-fluid rounded-3 mb-3 shadow" style="max-height: 520px; object-fit: contain;">
                    <div id="lightboxCaption" class="text-start px-3 py-2 bg-black bg-opacity-50 rounded-3">
                        <!-- Dynamic caption filled by JS -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
