@extends('admin.layouts.app')

@section('title', 'Create Campaign Appeal')
@section('page_title', 'New Fundraising Appeal')

@section('content')

    <div class="mb-4">
        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Campaigns
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <h5 class="admin-card-title">Campaign Appeal Information</h5>
        </div>
        <div class="admin-card-body p-4">
            <form action="{{ route('admin.campaigns.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-8">
                        <label for="title" class="form-label fw-bold text-navy">Campaign Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. Emergency Monsoon Food Relief" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="category_id" class="form-label fw-bold text-navy">Sector Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">Select Category...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="target_amount" class="form-label fw-bold text-navy">Target Financial Goal (LKR / Rs.) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="1" class="form-control @error('target_amount') is-invalid @enderror" id="target_amount" name="target_amount" value="{{ old('target_amount') }}" placeholder="150000.00" required>
                        @error('target_amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label fw-bold text-navy">Campaign Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active (Accepting Donations)</option>
                            <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="start_date" class="form-label fw-bold text-navy">Campaign Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="end_date" class="form-label fw-bold text-navy">Campaign Target End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
                    </div>

                    <div class="col-12">
                        <label for="image" class="form-label fw-bold text-navy">Campaign Cover Image URL</label>
                        <input type="url" class="form-control" id="image" name="image" value="{{ old('image') }}" placeholder="https://images.unsplash.com/photo-...">
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label fw-bold text-navy">Detailed Urgent Appeal Narrative <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Explain the urgent community need, exact items to be distributed, and cost breakdown..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-navy" for="featured">
                                Pin this campaign to Homepage Active Appeals section
                            </label>
                        </div>
                    </div>

                    <div class="col-12 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-teal px-4">Launch Campaign</button>
                        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
