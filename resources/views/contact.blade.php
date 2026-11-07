@extends('layouts.app')

@section('title', 'Contact Us | Social Development Council (SDC) Sri Lanka')
@section('meta_description', 'Get in touch with the Social Development Council Maligaikadu Sri Lanka for inquiries, partnerships, and community support.')

@section('content')

    <!-- Banner -->
    <section class="page-header-banner">
        <div class="container text-center">
            <span class="badge mb-2 px-3 py-2 text-uppercase fw-bold" style="background-color: rgba(54, 121, 201, 0.25); color: #93C5FD;">We Are Here to Help</span>
            <h1 class="display-4 fw-bold text-white mb-2">Contact Our Global Team</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Contact Details & Form Section -->
    <section class="py-5 bg-white">
        <div class="container py-lg-4">
            <div class="row g-4 g-lg-5">
                <!-- Contact Information Column Left -->
                <div class="col-lg-5">
                    <span class="section-badge">Get In Touch</span>
                    <h2 class="section-title mb-3">Connect with SDC</h2>
                    <p class="text-muted mb-4">
                        Have a question regarding our ongoing relief operations, wish to verify a donation, or propose an organizational partnership? Reach out to our executive secretariat.
                    </p>

                    <div class="d-flex flex-column gap-3 mb-4">
                        <!-- Address -->
                        <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light border">
                            <div class="rounded-circle p-3 fs-4 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #EBF3FC; color: #245A91;">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-navy">Headquarters Location</h6>
                                <p class="small text-muted mb-0">Main Street, Maligaikadu West, Eastern Province, Sri Lanka</p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light border">
                            <div class="rounded-circle p-3 fs-4 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #EBF3FC; color: #245A91;">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-navy">Telephone & WhatsApp</h6>
                                <p class="small text-muted mb-0">
                                    <a href="tel:+94672229180" class="text-muted hover-teal">+94 (0) 67 222 9180</a> /
                                    <a href="tel:+94773123456" class="text-muted hover-teal">+94 (0) 77 312 3456</a>
                                </p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light border">
                            <div class="rounded-circle p-3 fs-4 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #EBF3FC; color: #245A91;">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-navy">Email Communications</h6>
                                <p class="small text-muted mb-0">
                                    <a href="mailto:info@sdcmksl.org" class="text-muted hover-teal">info@sdcmksl.org</a><br>
                                    <a href="mailto:support@sdcmksl.org" class="text-muted hover-teal">support@sdcmksl.org</a>
                                </p>
                            </div>
                        </div>

                        <!-- Hours -->
                        <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light border">
                            <div class="rounded-circle p-3 fs-4 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #EBF3FC; color: #245A91;">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-navy">Secretariat Office Hours</h6>
                                <p class="small text-muted mb-0">Monday – Friday: 8:30 AM – 5:00 PM (GMT+5:30)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form Column Right -->
                <div class="col-lg-7">
                    <div class="card border rounded-4 shadow-sm p-4 p-md-5">
                        <h4 class="fw-bold text-navy mb-2">Send Us a Direct Message</h4>
                        <p class="text-muted small mb-4">Fill out the validated form below. Our communications team will respond within 24 to 48 hours.</p>

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold text-navy small">Your Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-custom @error('name') is-invalid @enderror" id="name" name="name" placeholder="John Doe" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold text-navy small">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" id="email" name="email" placeholder="john@example.com" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="subject" class="form-label fw-semibold text-navy small">Message Subject <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-custom @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Inquiry regarding Clean Water Project" value="{{ old('subject') }}" required>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="message" class="form-label fw-semibold text-navy small">Detailed Message <span class="text-danger">*</span></label>
                                    <textarea class="form-control form-control-custom @error('message') is-invalid @enderror" id="message" name="message" rows="5" placeholder="Write your message here (minimum 10 characters)..." required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-teal px-5 py-3 fs-6 w-100 justify-content-center">
                                        <i class="fa-solid fa-paper-plane"></i> Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Verified Map Embed Section -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="text-center mb-4">
                <span class="section-badge">Headquarters Map</span>
                <h3 class="fw-bold text-navy">Locate Our Field Office</h3>
            </div>
            <div class="rounded-4 overflow-hidden shadow-sm border" style="height: 380px;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.776652251147!2d81.8497672758156!3d7.478832011776518!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae515764264218d%3A0xe5adfe3dc5086ee1!2sMaligaikadu!5e0!3m2!1sen!2slk!4v1700000000000!5m2!1sen!2slk" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

@endsection
