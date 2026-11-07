@extends('admin.layouts.app')

@section('title', 'View ' . $service->title)
@section('page_title', $service->title)

@section('content')

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <span class="badge {{ $service->type === 'course' ? 'bg-purple-subtle text-purple' : 'bg-primary-subtle text-primary' }} text-uppercase fw-bold">
                    <i class="{{ $service->type === 'course' ? 'fa-solid fa-graduation-cap' : 'fa-solid fa-hand-holding-heart' }} me-1"></i>
                    {{ $service->type }}
                </span>
                <span class="badge bg-light text-muted border">{{ $service->category }}</span>
                <span class="badge {{ $service->status === 'active' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($service->status) }}</span>
            </div>
            <h4 class="fw-bold text-navy mb-0">{{ $service->title }}</h4>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-teal">
                <i class="fa-solid fa-pen me-1"></i> Edit Everything
            </a>
            <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="btn btn-outline-success">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> View Live Showcase
            </a>
            <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Service Overview -->
        <div class="col-lg-8">
            <div class="admin-card p-4 mb-4">
                <div class="position-relative rounded-4 overflow-hidden mb-4 shadow-sm" style="max-height: 380px;">
                    <img src="{{ asset($service->image) }}" alt="{{ $service->title }}" class="w-100 h-100" style="object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=SDC&background=2563EB&color=fff'">
                    <div class="position-absolute bottom-0 start-0 p-3 w-100" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                        <span class="badge px-3 py-2 rounded-pill fw-bold text-white shadow-sm" style="background-color: {{ $service->accent_color ?? '#2563EB' }};">
                            <i class="{{ $service->icon ?? 'fa-solid fa-bolt' }} me-1"></i> {{ $service->category }}
                        </span>
                    </div>
                </div>

                <h5 class="fw-bold text-navy mb-2">Summary</h5>
                <p class="lead fs-6 text-secondary mb-4">{{ $service->summary }}</p>

                <h5 class="fw-bold text-navy mb-2">Detailed Scope</h5>
                <p class="text-muted mb-4" style="line-height: 1.8;">{{ $service->description }}</p>

                @if(!empty($service->highlights))
                    <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-circle-check text-success me-2"></i>Key Highlights / Deliverables</h5>
                    <div class="row g-2 mb-2">
                        @foreach($service->highlights as $h)
                            <div class="col-md-6">
                                <div class="p-2 bg-light rounded-3 border d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-check text-primary small"></i>
                                    <span class="small fw-semibold text-dark">{{ $h }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- PROVIDE SERVICING CONFIGURATION (Admin Preview) -->
            <div class="admin-card p-4 mb-4 border-start border-4 border-primary">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary rounded-pill px-3 py-1"><i class="fa-solid fa-handshake-angle me-1"></i> Configured</span>
                        <h5 class="fw-bold text-primary mb-0">Provide Servicing Public Display</h5>
                    </div>
                    <a href="{{ route('admin.services.edit', $service->id) }}#provide-servicing" class="btn btn-sm btn-outline-primary">
                        <i class="fa-solid fa-pen me-1"></i> Edit Servicing
                    </a>
                </div>

                <h6 class="fw-bold text-navy mb-1">{{ $service->provide_title ?: 'Provide Servicing For This Program' }}</h6>
                <p class="text-muted small mb-3">{{ $service->provide_details ?: 'Standard servicing and volunteer instructions' }}</p>

                @if(is_array($service->servicing_cards) && count($service->servicing_cards) > 0)
                    <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-layer-group text-primary me-1"></i> Servicing Opportunity Cards ({{ count($service->servicing_cards) }}):</h6>
                    <div class="row g-3 mb-4">
                        @foreach($service->servicing_cards as $sc)
                            <div class="col-md-6">
                                <div class="card h-100 border rounded-3 overflow-hidden shadow-xs">
                                    <div class="position-relative" style="height: 120px;">
                                        <img src="{{ asset($sc['image'] ?? 'images/services/education.jpg') }}" class="w-100 h-100" style="object-fit: cover;" onerror="this.src='{{ asset($service->image) }}'">
                                        <span class="position-absolute top-0 start-0 m-2 badge bg-navy text-white small" style="background-color: #0F2B48;">{{ $sc['tag'] ?? 'SERVICING' }}</span>
                                        <span class="position-absolute top-0 end-0 m-2 badge bg-dark text-white small"><i class="fa-regular fa-calendar me-1"></i> {{ !empty($sc['date']) ? \Carbon\Carbon::parse($sc['date'])->format('M d, Y') : date('M d, Y') }}</span>
                                    </div>
                                    <div class="p-3 bg-white">
                                        <strong class="text-navy small d-block mb-1">{{ $sc['title'] }}</strong>
                                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">{{ Str::limit($sc['desc'], 85) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if(is_array($service->servicing_roles) && count($service->servicing_roles) > 0)
                    <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-users-gear text-primary me-1"></i> Specialist Roles Needed ({{ count($service->servicing_roles) }}):</h6>
                    <div class="row g-2 mb-3">
                        @foreach($service->servicing_roles as $sr)
                            <div class="col-md-6">
                                <div class="p-2 px-3 rounded-3 bg-light border small">
                                    <strong class="text-navy d-block">{{ $sr['role'] ?? 'Specialist' }}</strong>
                                    <span class="text-muted" style="font-size: 0.78rem;">{{ $sr['desc'] ?? '' }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- VISUAL GALLERY (Admin Preview) -->
            <div class="admin-card p-4 mb-4 border-start border-4 border-primary">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary rounded-pill px-3 py-1"><i class="fa-solid fa-images me-1"></i> Public Gallery</span>
                        <h5 class="fw-bold text-navy mb-0">Visual Gallery Photos ({{ is_array($service->gallery) ? count($service->gallery) : 0 }} Photos)</h5>
                    </div>
                    <a href="{{ route('admin.services.edit', $service->id) }}#service-gallery" class="btn btn-sm btn-outline-primary">
                        <i class="fa-solid fa-pen me-1"></i> Manage Photos
                    </a>
                </div>

                @if(is_array($service->gallery) && count($service->gallery) > 0)
                    <div class="row g-3">
                        @foreach($service->gallery as $gp)
                            <div class="col-md-6">
                                <div class="card h-100 border rounded-3 overflow-hidden">
                                    <img src="{{ asset($gp['url']) }}" class="w-100" style="height: 140px; object-fit: cover;" onerror="this.src='{{ asset($service->image) }}'">
                                    <div class="p-3 bg-white">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="badge bg-primary-subtle text-primary" style="font-size: 0.7rem;">{{ $gp['tag'] ?? 'Deliverable' }}</span>
                                        </div>
                                        <strong class="text-navy small d-block mb-1">{{ $gp['title'] }}</strong>
                                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">{{ Str::limit($gp['desc'], 80) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted small mb-0">No custom gallery photos uploaded. Default showcase photo is being used.</p>
                @endif
            </div>
        </div>

        <!-- Sidebar Metadata -->
        <div class="col-lg-4">
            <div class="admin-card p-4 mb-4">
                <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-circle-nodes text-primary me-2"></i>Properties</h5>
                
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted">Slug</span>
                        <span class="fw-semibold text-navy">{{ $service->slug }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted">Impact Metric</span>
                        <span class="fw-semibold text-teal">{{ $service->impact ?? 'N/A' }}</span>
                    </li>
                    @if($service->type === 'course')
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Duration</span>
                            <span class="fw-semibold text-navy">{{ $service->course_duration ?? 'N/A' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Eligibility</span>
                            <span class="fw-semibold text-navy">{{ $service->course_level ?? 'N/A' }}</span>
                        </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted">Order Index</span>
                        <span class="fw-semibold text-navy">#{{ $service->order }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted">Created</span>
                        <span class="text-muted">{{ $service->created_at->format('M d, Y') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted">Last Updated</span>
                        <span class="text-muted">{{ $service->updated_at->diffForHumans() }}</span>
                    </li>
                </ul>

                <hr>

                <div class="d-grid gap-2">
                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-teal">
                        <i class="fa-solid fa-pen me-1"></i> Edit This {{ ucfirst($service->type) }}
                    </a>
                    <a href="{{ route('services.show', $service->slug) }}" target="_blank" class="btn btn-outline-success">
                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> View Live Page
                    </a>
                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="fa-solid fa-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
