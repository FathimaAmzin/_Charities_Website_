@extends('admin.layouts.app')

@section('title', 'Edit User: ' . $user->name)
@section('page_title', 'Update User & Role Privileges')

@section('content')

    <div class="mb-4">
        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to User List
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header d-flex justify-content-between align-items-center">
            <h5 class="admin-card-title mb-0">Edit User Account: {{ $user->name }}</h5>
            <span class="text-muted small">Registered: {{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}</span>
        </div>
        <div class="admin-card-body p-4">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold text-navy">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold text-navy">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label fw-bold text-navy">Reset Password (leave empty to keep current)</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter new password if changing">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="role" class="form-label fw-bold text-navy">Assigned System Role <span class="text-danger">*</span></label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="staff" {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}>Staff / Field Officer</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator (Full Administrative Control)</option>
                            <option value="donor" {{ old('role', $user->role) == 'donor' ? 'selected' : '' }}>Donor Account</option>
                            <option value="volunteer" {{ old('role', $user->role) == 'volunteer' ? 'selected' : '' }}>Volunteer Account</option>
                        </select>
                        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label fw-bold text-navy">Contact Phone / WhatsApp</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+94 77 123 4567">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="country" class="form-label fw-bold text-navy">Country</label>
                        <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country', $user->country ?? 'Sri Lanka') }}">
                        @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 mt-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold text-navy ms-2" for="is_active">
                                Account is Active & Allowed to Log In
                            </label>
                            <div class="text-muted small">Deactivating prevents login immediately while preserving all historical audit trails.</div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top text-end">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-teal px-4">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Update User Account
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
