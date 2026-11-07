@extends('admin.layouts.app')

@section('title', 'Manage Teams & Directors')
@section('page_title', 'Leadership & Teams Management')

@section('content')

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-navy mb-1">Board of Directors & Executive Members</h4>
            <p class="text-muted small mb-0">Add, edit, reorder, and update profile photos of Board Directors and Managing Executive officers.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.teams.create') }}" class="btn btn-teal">
                <i class="fa-solid fa-user-plus me-1"></i> Add Team Member
            </a>
            <a href="{{ route('teams.index') }}" target="_blank" class="btn btn-outline-primary">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> View Public Teams Page
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="admin-card p-3 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper icon-teal" style="width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; background-color: rgba(36, 90, 145, 0.15); color: #245A91; font-size: 1.25rem;">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4 text-navy">{{ $totalMembers }}</div>
                    <div class="text-muted small">Total Team Profiles</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="admin-card p-3 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper icon-blue" style="width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; background-color: rgba(37, 99, 235, 0.15); color: #2563EB; font-size: 1.25rem;">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4 text-navy">{{ $totalBoard }}</div>
                    <div class="text-muted small">Board of Directors</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="admin-card p-3 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper icon-purple" style="width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; background-color: rgba(16, 185, 129, 0.15); color: #10B981; font-size: 1.25rem;">
                    <i class="fa-solid fa-gears"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4 text-navy">{{ $totalExecutives }}</div>
                    <div class="text-muted small">Managing Executives</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="admin-card mb-4">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.teams.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Search by name, role, bio..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        <option value="board_of_directors" {{ request('category') == 'board_of_directors' ? 'selected' : '' }}>Board of Directors</option>
                        <option value="managing_executives" {{ request('category') == 'managing_executives' ? 'selected' : '' }}>Managing Executives</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-navy w-100">Filter</button>
                    @if(request()->hasAny(['search', 'category', 'status']))
                        <a href="{{ route('admin.teams.index') }}" class="btn btn-outline-secondary" title="Clear Filters"><i class="fa-solid fa-rotate-left"></i></a>
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
                        <th style="width: 50px;">Order</th>
                        <th>Member Details</th>
                        <th>Sub-Team / Category</th>
                        <th>Designation / Badge</th>
                        <th>Contact Email</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $m)
                        <tr>
                            <td class="text-muted fw-bold">#{{ $m->order }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ asset($m->image) }}" alt="{{ $m->name }}" class="rounded-circle shadow-xs" style="width: 48px; height: 48px; object-fit: cover; border: 2px solid #2563EB;" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($m->name) }}&background=2563EB&color=fff'">
                                    <div>
                                        <div class="fw-bold text-navy">{{ $m->name }}</div>
                                        <span class="small text-muted">{{ Str::limit($m->role, 45) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($m->category === 'board_of_directors')
                                    <span class="badge bg-primary-subtle text-primary fw-bold" style="font-size: 0.72rem; padding: 5px 9px;">
                                        <i class="fa-solid fa-user-tie me-1"></i> Board of Directors
                                    </span>
                                @else
                                    <span class="badge bg-success-subtle text-success fw-bold" style="font-size: 0.72rem; padding: 5px 9px;">
                                        <i class="fa-solid fa-gears me-1"></i> Managing Executives
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-navy border small fw-semibold">
                                    {{ $m->badge ?? $m->role }}
                                </span>
                            </td>
                            <td class="small text-muted">
                                {{ $m->email ?: 'N/A' }}
                            </td>
                            <td>
                                <span class="badge {{ $m->status === 'active' ? 'bg-success' : 'bg-secondary' }} text-capitalize">
                                    {{ $m->status }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <a href="{{ route('admin.teams.show', $m->id) }}" class="btn-action-view" title="Preview Details">
                                        <i class="fa-solid fa-eye me-1"></i> View
                                    </a>
                                    <a href="{{ route('admin.teams.edit', $m->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.teams.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this team member?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-users fs-1 mb-2 d-block text-muted"></i>
                                No team members found matching your search.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($members->hasPages())
            <div class="p-3 border-top d-flex justify-content-center">
                {{ $members->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

@endsection

