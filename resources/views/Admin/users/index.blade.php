@extends('admin.layouts.app')

@section('title', 'Manage System Users & Roles')
@section('page_title', 'User & Access Role Management')

@section('content')

    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-6">
            <h5 class="mb-0 text-navy fw-bold">System Users & Privileges</h5>
            <p class="text-muted small mb-0">Manage administrative credentials, staff permissions, and donor accounts</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('admin.users.create') }}" class="btn btn-teal">
                <i class="fa-solid fa-user-plus me-1"></i> Add New System User
            </a>
        </div>
    </div>

    <!-- Search & Filter Card -->
    <div class="admin-card mb-4">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.users.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Search by name or email..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <select name="role" class="form-select">
                        <option value="">All Access Roles</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrator (Full Access)</option>
                        <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staff / Case Officer</option>
                        <option value="donor" {{ request('role') == 'donor' ? 'selected' : '' }}>Donor Account</option>
                        <option value="volunteer" {{ request('role') == 'volunteer' ? 'selected' : '' }}>Volunteer Account</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-teal w-100">Filter</button>
                    @if(request()->anyFilled(['search', 'role']))
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary"><i class="fa-solid fa-xmark"></i></a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Users Table -->
    <div class="admin-card">
        <div class="admin-card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">User</th>
                            <th>Email Address</th>
                            <th>System Role</th>
                            <th>Contact / Country</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $u)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2 bg-navy text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px; font-size: 0.85rem;">
                                            {{ strtoupper(substr($u->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <strong class="text-navy d-block">{{ $u->name }}</strong>
                                            @if($u->id === auth()->id())
                                                <span class="badge bg-teal-subtle text-teal border border-teal" style="font-size: 0.65rem;">You</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="font-monospace text-muted">{{ $u->email }}</span>
                                </td>
                                <td>
                                    @if($u->role === 'admin')
                                        <span class="badge bg-danger-subtle text-danger border border-danger fw-bold">
                                            <i class="fa-solid fa-shield-halved me-1"></i>Administrator
                                        </span>
                                    @elseif($u->role === 'staff')
                                        <span class="badge bg-primary-subtle text-primary border border-primary fw-bold">
                                            <i class="fa-solid fa-user-gear me-1"></i>Staff Officer
                                        </span>
                                    @elseif($u->role === 'donor')
                                        <span class="badge bg-success-subtle text-success border border-success">
                                            <i class="fa-solid fa-heart me-1"></i>Donor
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border">
                                            <i class="fa-solid fa-handshake-angle me-1"></i>Volunteer
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted d-block">{{ $u->phone ?? 'Phone not set' }}</small>
                                    <small class="text-navy">{{ $u->country ?? 'Sri Lanka' }}</small>
                                </td>
                                <td>
                                    @if($u->is_active ?? true)
                                        <span class="badge bg-success-subtle text-success border border-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border">Deactivated</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">{{ $u->created_at ? $u->created_at->format('M d, Y') : 'N/A' }}</small>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-outline-teal" title="Edit User">
                                            <i class="fa-solid fa-pencil"></i>
                                        </a>
                                        @if($u->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Permanently remove user {{ $u->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete User">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">No users matching search filters.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="p-3 border-top d-flex justify-content-end">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection
