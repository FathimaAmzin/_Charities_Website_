@extends('admin.layouts.app')

@section('title', 'Edit Team Member')
@section('page_title', 'Edit: ' . $member->name)

@section('content')

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-navy mb-1">Edit: {{ $member->name }}</h4>
            <p class="text-muted small mb-0">Update profile details, replace photo, or adjust designation and sub-team category.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.teams.show', $member->id) }}" class="btn btn-outline-primary">
                <i class="fa-solid fa-eye me-1"></i> View Profile
            </a>
            <a href="{{ route('admin.teams.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Teams
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6 class="fw-bold mb-1"><i class="fa-solid fa-triangle-exclamation me-1"></i> Please check form inputs:</h6>
            <ul class="mb-0 small ps-3">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('admin.teams.update', $member->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Left Column: Primary Member Details -->
            <div class="col-lg-8">
                <div class="admin-card p-4 mb-4">
                    <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-user text-primary me-2"></i>Member Profile Details</h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-navy">Sub-Team / Category <span class="text-danger">*</span></label>
                            <select name="category" id="teamCategorySelect" class="form-select @error('category') is-invalid @enderror" required>
                                <option value="board_of_directors" {{ old('category', $member->category) === 'board_of_directors' ? 'selected' : '' }}>Board of Directors</option>
                                <option value="managing_executives" {{ old('category', $member->category) === 'managing_executives' ? 'selected' : '' }}>Managing Executive Members</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-navy">Badge Label</label>
                            <input type="text" name="badge" class="form-control @error('badge') is-invalid @enderror" value="{{ old('badge', $member->badge) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-navy">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $member->name) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-navy">Role / Official Title <span class="text-danger">*</span></label>
                            <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role', $member->role) }}" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-navy">Bio / Professional Overview</label>
                            <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="4">{{ old('bio', $member->bio) }}</textarea>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-navy">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $member->email) }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-navy">Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $member->phone) }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-navy">LinkedIn Profile URL</label>
                            <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $member->linkedin) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Photo Upload & Status -->
            <div class="col-lg-4">
                <div class="admin-card p-4 mb-4 text-center">
                    <h5 class="fw-bold text-navy mb-3 text-start"><i class="fa-solid fa-camera text-primary me-2"></i>Profile Photograph</h5>
                    
                    <div class="position-relative mx-auto mb-3" style="width: 140px; height: 140px;">
                        <img src="{{ asset($member->image) }}" alt="{{ $member->name }}" class="rounded-circle w-100 h-100 shadow-sm" style="object-fit: cover; border: 4px solid #2563EB;" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=2563EB&color=fff&size=200'">
                    </div>
                    <small class="text-muted d-block mb-3">Current Photo</small>

                    <div class="mb-3 text-start">
                        <label class="form-label small fw-semibold text-navy">Replace Photo File</label>
                        <input type="file" name="image_file" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3 text-start">
                        <label class="form-label small fw-semibold text-navy">Or Image Path / URL</label>
                        <input type="text" name="image" class="form-control" value="{{ old('image', $member->image) }}">
                    </div>
                </div>

                <div class="admin-card p-4 mb-4">
                    <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-sliders text-teal me-2"></i>Display Settings</h5>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-navy">Display Order</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $member->order) }}" min="0">
                        <small class="text-muted">Lower order number appears first in the list</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-navy">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="active" {{ old('status', $member->status) === 'active' ? 'selected' : '' }}>Active (Publicly Visible)</option>
                            <option value="inactive" {{ old('status', $member->status) === 'inactive' ? 'selected' : '' }}>Inactive (Hidden)</option>
                        </select>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="admin-card p-4">
                    <button type="submit" class="btn btn-teal w-100 py-2 fw-bold fs-6">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Update Team Member
                    </button>
                    <a href="{{ route('admin.teams.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>

@endsection

