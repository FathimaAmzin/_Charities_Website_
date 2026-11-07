@extends('admin.layouts.app')

@section('title', 'Manage Services & Courses')
@section('page_title', 'Services & Courses Management')

@section('content')

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-navy mb-1">Humanitarian Services & Vocational Courses</h4>
            <p class="text-muted small mb-0">Manage services, courses, descriptions, and action images (Support, Request Assistance, Provide Servicing).</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.services.create') }}" class="btn btn-teal">
                <i class="fa-solid fa-plus me-1"></i> Add Service / Course
            </a>
            <a href="{{ route('services.index') }}" target="_blank" class="btn btn-outline-primary">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> View Public Page
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="admin-card p-3 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper icon-teal" style="width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; background-color: rgba(36, 90, 145, 0.15); color: #245A91; font-size: 1.25rem;">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4 text-navy">{{ $services->total() }}</div>
                    <div class="text-muted small">Total Active Entries</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="admin-card p-3 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper icon-blue" style="width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; background-color: rgba(37, 99, 235, 0.15); color: #2563EB; font-size: 1.25rem;">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4 text-navy">{{ $totalServices }}</div>
                    <div class="text-muted small">Core Services (Electricity, Education...)</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="admin-card p-3 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper icon-purple" style="width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; background-color: rgba(147, 51, 234, 0.15); color: #9333EA; font-size: 1.25rem;">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4 text-navy">{{ $totalCourses }}</div>
                    <div class="text-muted small">Vocational Courses & Seminars</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="admin-card mb-4">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.services.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Search service title, category, keywords..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <select name="type" class="form-select" onchange="this.form.submit()">
                        <option value="">All Types (Services & Courses)</option>
                        <option value="service" {{ request('type') == 'service' ? 'selected' : '' }}>Services Only</option>
                        <option value="course" {{ request('type') == 'course' ? 'selected' : '' }}>Courses Only</option>
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
                    @if(request()->hasAny(['search', 'type', 'status']))
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary" title="Clear Filters"><i class="fa-solid fa-rotate-left"></i></a>
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
                        <th>Service / Course</th>
                        <th>Type & Category</th>
                        <th>Action Images (Support / Request / Provide)</th>
                        <th>Impact / Duration</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $srv)
                        <tr>
                            <td class="text-muted fw-bold">#{{ $srv->order }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="position-relative">
                                        <img src="{{ asset($srv->image) }}" alt="{{ $srv->title }}" class="rounded-3 shadow-xs" style="width: 56px; height: 56px; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=SDC&background=2563EB&color=fff'">
                                        <span class="position-absolute bottom-0 end-0 badge rounded-pill p-1 shadow-sm" style="background-color: {{ $srv->accent_color ?? '#2563EB' }}; font-size: 0.65rem;">
                                            <i class="{{ $srv->icon ?? 'fa-solid fa-bolt' }} text-white"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <div class="fw-bold text-navy">{{ $srv->title }}</div>
                                        <span class="small text-muted">{{ Str::limit($srv->summary, 55) }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge {{ $srv->type === 'course' ? 'bg-purple-subtle text-purple' : 'bg-primary-subtle text-primary' }} text-uppercase mb-1" style="font-size: 0.7rem; font-weight: 700; padding: 4px 8px; border-radius: 6px;">
                                    <i class="{{ $srv->type === 'course' ? 'fa-solid fa-graduation-cap' : 'fa-solid fa-hand-holding-heart' }} me-1"></i>
                                    {{ $srv->type }}
                                </span>
                                <div class="small text-muted fw-semibold">{{ $srv->category }}</div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="text-center" title="Support This Service Image">
                                        <img src="{{ asset($srv->support_image ?: $srv->image) }}" class="rounded border" style="width: 32px; height: 32px; object-fit: cover;" onerror="this.src='{{ asset($srv->image) }}'">
                                        <div style="font-size: 0.62rem; color: #DC2626; font-weight: 700;">Support</div>
                                    </div>
                                    <div class="text-center" title="Request Assistance Image">
                                        <img src="{{ asset($srv->request_image ?: $srv->image) }}" class="rounded border" style="width: 32px; height: 32px; object-fit: cover;" onerror="this.src='{{ asset($srv->image) }}'">
                                        <div style="font-size: 0.62rem; color: #2563EB; font-weight: 700;">Request</div>
                                    </div>
                                    <div class="text-center" title="Provide Servicing Image">
                                        <img src="{{ asset($srv->provide_image ?: $srv->image) }}" class="rounded border" style="width: 32px; height: 32px; object-fit: cover;" onerror="this.src='{{ asset($srv->image) }}'">
                                        <div style="font-size: 0.62rem; color: #16A34A; font-weight: 700;">Provide</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($srv->type === 'course')
                                    <div class="fw-semibold text-navy small"><i class="fa-solid fa-clock me-1 text-muted"></i> {{ $srv->course_duration ?? 'Flexible' }}</div>
                                    <span class="badge bg-light text-secondary small border">{{ $srv->course_level ?? 'All Levels' }}</span>
                                @else
                                    <div class="fw-bold text-teal small">{{ $srv->impact ?? 'Grassroots Aid' }}</div>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $srv->status === 'active' ? 'bg-success' : 'bg-secondary' }} text-capitalize">
                                    {{ $srv->status }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <a href="{{ route('admin.services.show', $srv->id) }}" class="btn-action-view" title="Preview Details">
                                        <i class="fa-solid fa-eye me-1"></i> View
                                    </a>
                                    <a href="{{ route('admin.services.edit', $srv->id) }}" class="btn btn-sm btn-outline-primary" title="Edit Service">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $srv->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service/course?')" class="d-inline">
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
                                <i class="fa-solid fa-hand-holding-heart fs-1 mb-2 d-block text-muted"></i>
                                No services or courses found matching your criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($services->hasPages())
            <div class="p-3 border-top d-flex justify-content-center">
                {{ $services->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

@endsection

