@extends('admin.layouts.app')

@section('title', 'Manage Projects')
@section('page_title', 'Projects Management')

@section('content')

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-navy mb-1">Humanitarian Projects</h4>
            <p class="text-muted small mb-0">Create, monitor, edit, and audit all community assistance programs.</p>
        </div>
        <div>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-teal">
                <i class="fa-solid fa-plus me-1"></i> Add New Project
            </a>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="admin-card mb-4">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.projects.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Search by title or location..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-navy w-100">Filter</button>
                    @if(request()->hasAny(['search', 'category', 'status']))
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary" title="Clear Filters"><i class="fa-solid fa-rotate-left"></i></a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Data Table -->
    <div class="admin-card">
        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Target (LKR / Rs.)</th>
                        <th>Raised (LKR / Rs.)</th>
                        <th>Progress</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $p)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $p->image_url }}" alt="{{ $p->title }}" class="rounded-3" style="width: 50px; height: 50px; object-fit: cover;">
                                    <div>
                                        <div class="fw-bold text-navy">{{ $p->title }}</div>
                                        <span class="small text-muted">{{ Str::limit($p->short_description, 50) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge badge-category">{{ $p->category->name ?? 'General' }}</span></td>
                            <td class="small">{{ $p->location }}</td>
                            <td class="fw-semibold text-navy">Rs. {{ number_format($p->target_amount, 2) }}</td>
                            <td class="fw-bold text-teal">Rs. {{ number_format($p->amount_raised, 2) }}</td>
                            <td style="min-width: 120px;">
                                <div class="d-flex justify-content-between small text-muted mb-1">
                                    <span>{{ $p->progress_percent }}%</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar" style="width: {{ $p->progress_percent }}%; background-color: #245A91;"></div>
                                </div>
                            </td>
                            <td>
                                <span class="badge {{ $p->status === 'active' ? 'bg-success' : ($p->status === 'completed' ? 'bg-secondary' : 'bg-warning text-dark') }} text-capitalize">
                                    {{ $p->status }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <a href="{{ route('admin.projects.show', $p->id) }}" class="btn-action-view" title="View Details"><i class="fa-solid fa-eye me-1"></i> Details</a>
                                    <a href="{{ route('admin.projects.edit', $p->id) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                    <form action="{{ route('admin.projects.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-folder-open fs-1 mb-2 d-block text-muted"></i>
                                No projects found matching your search.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($projects->hasPages())
            <div class="p-3 border-top d-flex justify-content-center">
                {{ $projects->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

@endsection
