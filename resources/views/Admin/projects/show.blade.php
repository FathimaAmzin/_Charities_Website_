@extends('admin.layouts.app')

@section('title', 'Project Details: ' . $project->title)
@section('page_title', 'Project Details')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Projects
        </a>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-outline-primary">
                <i class="fa-solid fa-pen me-1"></i> Edit Project
            </a>
            <a href="{{ route('projects.show', $project->slug) }}" target="_blank" class="btn btn-sm btn-outline-teal">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> View Live on Website
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">{{ $project->title }}</h5>
                    <span class="badge {{ $project->status === 'active' ? 'bg-success' : 'bg-secondary' }} text-capitalize">
                        {{ $project->status }}
                    </span>
                </div>
                <div class="admin-card-body">
                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="img-fluid rounded-3 mb-4 w-100" style="max-height: 380px; object-fit: cover;">

                    <h6 class="fw-bold text-navy mb-2">Executive Summary</h6>
                    <p class="text-muted mb-4">{{ $project->short_description }}</p>

                    <h6 class="fw-bold text-navy mb-2">Full Description</h6>
                    <p class="text-body" style="line-height: 1.8;">{{ $project->description }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">Project Metadata</h5>
                </div>
                <div class="admin-card-body">
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-3 small">
                        <li>
                            <span class="text-muted d-block">Sector Category:</span>
                            <strong class="text-navy">{{ $project->category->name ?? 'General' }}</strong>
                        </li>
                        <li>
                            <span class="text-muted d-block">Location:</span>
                            <strong class="text-navy">{{ $project->location }}</strong>
                        </li>
                        <li>
                            <span class="text-muted d-block">Target Budget (LKR):</span>
                            <strong class="text-navy fs-5">Rs. {{ number_format($project->target_amount, 2) }}</strong>
                        </li>
                        <li>
                            <span class="text-muted d-block">Verified Raised (LKR):</span>
                            <strong class="text-teal fs-5">Rs. {{ number_format($project->amount_raised, 2) }}</strong>
                        </li>
                        <li>
                            <span class="text-muted d-block">Progress:</span>
                            <div class="progress mt-1" style="height: 8px;">
                                <div class="progress-bar" style="width: {{ $project->progress_percent }}%; background-color: #245A91;"></div>
                            </div>
                            <span class="fw-bold text-teal">{{ $project->progress_percent }}% funded</span>
                        </li>
                        <li>
                            <span class="text-muted d-block">Start Date:</span>
                            <span>{{ $project->start_date ? $project->start_date->format('M d, Y') : 'Not set' }}</span>
                        </li>
                        <li>
                            <span class="text-muted d-block">End Date:</span>
                            <span>{{ $project->end_date ? $project->end_date->format('M d, Y') : 'Ongoing' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
