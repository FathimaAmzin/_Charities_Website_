@extends('admin.layouts.app')

@section('title', 'Add New Team Member')
@section('page_title', 'Add New Team Member')

@section('content')

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-navy mb-1">Add Team Member Profile</h4>
            <p class="text-muted small mb-0">Create new profile for Board of Directors or Managing Executive officers with customized image upload.</p>
        </div>
        <div>
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

    <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            <!-- Left Column: Primary Member Details -->
            <div class="col-lg-8">
                <div class="admin-card p-4 mb-4">
                    <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-user text-primary me-2"></i>Member Profile Details</h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-navy">Sub-Team / Category <span class="text-danger">*</span></label>
                            <select name="category" id="teamCategorySelect" class="form-select @error('category') is-invalid @enderror" required onchange="autoFillBadge(this.value)">
                                <option value="board_of_directors" {{ old('category') == 'board_of_directors' ? 'selected' : '' }}>Board of Directors</option>
                                <option value="managing_executives" {{ old('category') == 'managing_executives' ? 'selected' : '' }}>Managing Executive Members</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-navy">Badge Label</label>
                            <input type="text" name="badge" id="teamBadgeInput" class="form-control @error('badge') is-invalid @enderror" placeholder="e.g. Director of Board or Executive Member" value="{{ old('badge', 'Director of Board') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-navy">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. Mohammed Musthafa Azath Raheem" value="{{ old('name') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-navy">Role / Official Title <span class="text-danger">*</span></label>
                            <input type="text" name="role" class="form-control @error('role') is-invalid @enderror" placeholder="e.g. Director of Board or President / Chairman" value="{{ old('role') }}" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-navy">Bio / Professional Overview</label>
                            <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="4" placeholder="Brief summary of their responsibilities, background, and contribution to community welfare...">{{ old('bio') }}</textarea>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-navy">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="e.g. director@sdcmksl.org" value="{{ old('email') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-navy">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="+94 (0) 67 222 9180" value="{{ old('phone') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-navy">LinkedIn Profile URL</label>
                            <input type="url" name="linkedin" class="form-control" placeholder="https://linkedin.com/in/..." value="{{ old('linkedin') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Photo Upload & Status -->
            <div class="col-lg-4">
                <div class="admin-card p-4 mb-4">
                    <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-camera text-primary me-2"></i>Profile Photograph</h5>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-navy">Upload Photo File <span class="text-danger">*</span></label>
                        <input type="file" name="image_file" class="form-control" accept="image/*">
                        <small class="text-muted">Recommended: Square format (400x400px, JPG/PNG)</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-navy">Or Existing Photo Path / URL</label>
                        <input type="text" name="image" class="form-control" placeholder="e.g. images/team/aa-ashraf-ali.jpg" value="{{ old('image') }}">
                    </div>
                </div>

                <div class="admin-card p-4 mb-4">
                    <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-sliders text-teal me-2"></i>Display Settings</h5>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-navy">Display Order</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
                        <small class="text-muted">Lower order number appears first in the list</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-navy">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active (Publicly Visible)</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive (Hidden)</option>
                        </select>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="admin-card p-4">
                    <button type="submit" class="btn btn-teal w-100 py-2 fw-bold fs-6">
                        <i class="fa-solid fa-check-circle me-1"></i> Save Team Member
                    </button>
                    <a href="{{ route('admin.teams.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
        function autoFillBadge(category) {
            const badgeInput = document.getElementById('teamBadgeInput');
            if (badgeInput && (!badgeInput.value || badgeInput.value === 'Director of Board' || badgeInput.value === 'Executive Member')) {
                badgeInput.value = (category === 'board_of_directors') ? 'Director of Board' : 'Executive Member';
            }
        }
    </script>
    @endpush

@endsection

