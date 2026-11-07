@extends('admin.layouts.app')

@section('title', 'Edit Project')
@section('page_title', 'Edit Project: ' . $project->title)

@section('content')

    <div class="mb-4">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Projects
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <h5 class="admin-card-title">Edit Project: {{ $project->title }}</h5>
        </div>
        <div class="admin-card-body p-4">
            <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-8">
                        <label for="title" class="form-label fw-bold text-navy">Project Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $project->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="category_id" class="form-label fw-bold text-navy">Sector Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $project->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="location" class="form-label fw-bold text-navy">Field Location <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $project->location) }}" required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="target_amount" class="form-label fw-bold text-navy">Target Budget (LKR / Rs.) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" class="form-control @error('target_amount') is-invalid @enderror" id="target_amount" name="target_amount" value="{{ old('target_amount', $project->target_amount) }}" required>
                        @error('target_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="status" class="form-label fw-bold text-navy">Current Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="active" {{ old('status', $project->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="pending" {{ old('status', $project->status) == 'pending' ? 'selected' : '' }}>Pending / Pipeline</option>
                            <option value="completed" {{ old('status', $project->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="start_date" class="form-label fw-bold text-navy">Project Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $project->start_date ? $project->start_date->format('Y-m-d') : '') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="end_date" class="form-label fw-bold text-navy">Project Projected End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $project->end_date ? $project->end_date->format('Y-m-d') : '') }}">
                    </div>

                    <div class="col-12">
                        <label for="image" class="form-label fw-bold text-navy">Cover Image URL</label>
                        <input type="url" class="form-control" id="image" name="image" value="{{ old('image', $project->image) }}">
                    </div>

                    <div class="col-12">
                        <label for="short_description" class="form-label fw-bold text-navy">Executive Summary <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="2" required>{{ old('short_description', $project->short_description) }}</textarea>
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label fw-bold text-navy">Comprehensive Project Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6" required>{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $project->featured) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-navy" for="featured">
                                Pin this project to Homepage Featured section
                            </label>
                        </div>
                    </div>

                    <div class="col-12 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-teal px-4">Save Changes</button>
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
