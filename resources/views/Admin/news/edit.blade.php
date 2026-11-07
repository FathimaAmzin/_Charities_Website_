@extends('admin.layouts.app')

@section('title', 'Edit Article: ' . $article->title)
@section('page_title', 'Edit News Article / Event')

@section('content')

    <div class="mb-4">
        <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to News List
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <h5 class="admin-card-title">Edit Article Details: {{ $article->title }}</h5>
        </div>
        <div class="admin-card-body p-4">
            <form action="{{ route('admin.news.update', $article->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-8">
                        <label for="title" class="form-label fw-bold text-navy">Article Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $article->title) }}" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="type" class="form-label fw-bold text-navy">Post Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="news" {{ old('type', $article->type) == 'news' ? 'selected' : '' }}>News / Field Story</option>
                            <option value="event" {{ old('type', $article->type) == 'event' ? 'selected' : '' }}>Upcoming Event / Seminar</option>
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="location" class="form-label fw-bold text-navy">Location (Optional)</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $article->location) }}" placeholder="e.g. Ampara District, Sri Lanka">
                        @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label fw-bold text-navy">Featured Image URL</label>
                        <input type="url" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image', $article->image) }}" placeholder="https://images.unsplash.com/...">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label for="summary" class="form-label fw-bold text-navy">Short Summary / Teaser</label>
                        <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" rows="2">{{ old('summary', $article->summary) }}</textarea>
                        @error('summary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label for="content" class="form-label fw-bold text-navy">Full Article Content <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" required>{{ old('content', $article->content) }}</textarea>
                        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="published_at" class="form-label fw-bold text-navy">Publication Date</label>
                        <input type="date" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at"
                               value="{{ old('published_at', $article->published_at ? \Carbon\Carbon::parse($article->published_at)->format('Y-m-d') : '') }}">
                        @error('published_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 d-flex align-items-center mt-md-4">
                        <div class="form-check form-switch pt-2">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_published" name="is_published" value="1" {{ old('is_published', $article->is_published) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-navy ms-2" for="is_published">
                                Published to Public Website
                            </label>
                            <div class="text-muted small">Uncheck to unpublish and keep as internal draft.</div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top text-end">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-teal px-4">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Update Article
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
