@extends('layouts.app')

@section('title', $event->title . ' | SDC Community Events')
@section('meta_description', Str::limit($event->description, 150))

@section('content')

    <!-- Banner -->
    <section class="page-header-banner">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.25); color: #93C5FD;">Community Gathering</span>
            <h1 class="display-5 fw-bold text-white mb-2">{{ $event->title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Events</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($event->title, 25) }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Event Detail -->
    <section class="py-5 bg-white">
        <div class="container py-lg-4">
            <div class="row g-4 g-lg-5">
                <div class="col-lg-8">
                    <div class="rounded-4 overflow-hidden mb-4 shadow-sm" style="max-height: 440px;">
                        <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="img-fluid w-100" style="object-fit: cover; max-height: 440px;">
                    </div>

                    <h3 class="fw-bold text-navy mb-3">Event Description</h3>
                    <div class="text-body mb-4" style="line-height: 1.8; font-size: 1.05rem;">
                        <p>{{ $event->description }}</p>
                    </div>

                    <div class="p-4 rounded-4 bg-light border mb-4">
                        <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-clipboard-check text-teal me-2"></i> Attendance & Volunteer Support</h5>
                        <p class="text-muted small mb-3">
                            This community event is open to the public free of charge. If you would like to participate as a specialized volunteer or field assistant for this event, please register below.
                        </p>
                        <a href="{{ route('volunteer.register') }}" class="btn btn-teal">
                            <i class="fa-solid fa-hands-helping"></i> Register as Volunteer for this Event
                        </a>
                    </div>
                </div>

                <!-- Event Details Card Right -->
                <div class="col-lg-4">
                    <div class="card border rounded-4 shadow-sm p-4 sticky-top" style="top: 100px;">
                        <h5 class="fw-bold text-navy mb-3">Event Quick Info</h5>

                        <ul class="list-unstyled mb-4 d-flex flex-column gap-3">
                            <li class="d-flex align-items-start gap-3">
                                <i class="fa-regular fa-calendar-days text-teal fs-4 mt-1"></i>
                                <div>
                                    <strong class="d-block text-navy">Date:</strong>
                                    <span class="text-muted">{{ $event->event_date ? $event->event_date->format('l, F j, Y') : 'TBA' }}</span>
                                </div>
                            </li>
                            @if($event->event_time)
                            <li class="d-flex align-items-start gap-3">
                                <i class="fa-regular fa-clock text-teal fs-4 mt-1"></i>
                                <div>
                                    <strong class="d-block text-navy">Time:</strong>
                                    <span class="text-muted">{{ $event->event_time }}</span>
                                </div>
                            </li>
                            @endif
                            <li class="d-flex align-items-start gap-3">
                                <i class="fa-solid fa-location-dot text-teal fs-4 mt-1"></i>
                                <div>
                                    <strong class="d-block text-navy">Location:</strong>
                                    <span class="text-muted">{{ $event->location ?? 'Main Headquarters' }}</span>
                                </div>
                            </li>
                            @if($event->registration_deadline)
                            <li class="d-flex align-items-start gap-3">
                                <i class="fa-solid fa-hourglass-half text-warning fs-4 mt-1"></i>
                                <div>
                                    <strong class="d-block text-navy">Registration Deadline:</strong>
                                    <span class="text-muted">{{ $event->registration_deadline->format('M d, Y') }}</span>
                                </div>
                            </li>
                            @endif
                        </ul>

                        <a href="{{ route('contact') }}" class="btn btn-outline-navy w-100 justify-content-center mb-2">
                            <i class="fa-solid fa-envelope"></i> Inquire About Event
                        </a>
                        <a href="{{ route('donate') }}" class="btn btn-teal w-100 justify-content-center">
                            <i class="fa-solid fa-heart"></i> Sponsor this Event
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
