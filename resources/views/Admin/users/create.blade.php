@extends('admin.layouts.app')

@section('title', 'Create System User')
@section('page_title', 'Provision New User Account')

@section('content')

    <div class="mb-4">
        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to User List
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <h5 class="admin-card-title">New User Account Details</h5>
        </div>
        <div class="admin-card-body p-4">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold text-navy">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Farhan Rizwan" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold text-navy">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="officer@sdcmksl.org" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label fw-bold text-navy">Account Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="At least 8 characters" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="role" class="form-label fw-bold text-navy">Assigned System Role <span class="text-danger">*</span></label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff / Field Officer</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator (Full Administrative Control)</option>
                            <option value="donor" {{ old('role') == 'donor' ? 'selected' : '' }}>Donor Account</option>
                            <option value="volunteer" {{ old('role') == 'volunteer' ? 'selected' : '' }}>Volunteer Account</option>
                        </select>
                        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label fw-bold text-navy">Contact Phone / WhatsApp</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+94 77 123 4567">
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="country" class="form-label fw-bold text-navy">Country</label>
                        <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country', 'Sri Lanka') }}">
                        @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top text-end">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-teal px-4">
                        <i class="fa-solid fa-user-check me-1"></i> Provision Account
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
