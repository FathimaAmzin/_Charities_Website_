@extends('admin.layouts.app')

@section('title', 'Manage News & Events')
@section('page_title', 'News & Articles Management')

@section('content')

    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-6">
            <h5 class="mb-0 text-navy fw-bold">Published Stories & Press Releases</h5>
            <p class="text-muted small mb-0">Manage news articles, announcements, and humanitarian impact reports</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('admin.news.create') }}" class="btn btn-teal">
                <i class="fa-solid fa-plus me-1"></i> Add New Article
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="admin-card mb-4">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.news.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Search by article title..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">All Publication Statuses</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published Only</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Drafts / Hidden</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-teal w-100">Filter</button>
                    @if(request()->anyFilled(['search', 'status']))
                        <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary" title="Reset Filters"><i class="fa-solid fa-xmark"></i></a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Articles Table -->
    <div class="admin-card">
        <div class="admin-card-body p-0">
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 70px;">Thumbnail</th>
                            <th>Article Details</th>
                            <th>Category</th>
                            <th>Date / Schedule</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($news as $item)
                            <tr>
                                <td>
                                    @if($item->image)
                                        <img src="{{ $item->image }}" alt="{{ $item->title }}" class="rounded object-fit-cover shadow-sm" style="width: 52px; height: 42px;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted border" style="width: 52px; height: 42px;">
                                            <i class="fa-regular fa-newspaper"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <strong class="text-navy d-block fs-6">{{ $item->title }}</strong>
                                    <small class="text-muted text-truncate d-block" style="max-width: 380px;">{{ $item->summary ?: Str::limit(strip_tags($item->content), 80) }}</small>
                                </td>
                                <td>
                                    <span class="badge badge-category text-uppercase">{{ $item->type ?? 'News' }}</span>
                                </td>
                                <td>
                                    <div class="small text-muted">
                                        <i class="fa-regular fa-calendar me-1"></i>
                                        {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('M d, Y') : ($item->created_at ? $item->created_at->format('M d, Y') : 'Draft') }}
                                    </div>
                                    @if($item->location)
                                        <div class="small text-muted"><i class="fa-solid fa-location-dot me-1 text-teal"></i>{{ $item->location }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($item->is_published)
                                        <span class="badge bg-success-subtle text-success border border-success"><i class="fa-solid fa-check-circle me-1"></i>Published</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary"><i class="fa-regular fa-clock me-1"></i>Draft</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-outline-teal" title="Edit Article">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Delete Article">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fa-regular fa-newspaper fa-3x mb-3 text-secondary opacity-50"></i>
                                        <h6>No news articles or press releases found</h6>
                                        <p class="small mb-3">Create your first humanitarian news article or update to inform donors.</p>
                                        <a href="{{ route('admin.news.create') }}" class="btn btn-teal btn-sm">Add Article</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($news->hasPages())
                <div class="p-3 border-top d-flex justify-content-end">
                    {{ $news->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection
