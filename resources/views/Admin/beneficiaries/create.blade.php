@extends('admin.layouts.app')

@section('title', 'Register Beneficiary Case')
@section('page_title', 'New Beneficiary Assistance Request')

@section('content')

    <div class="mb-4">
        <a href="{{ route('admin.beneficiaries.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Beneficiaries
        </a>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <h5 class="admin-card-title">Confidential Beneficiary Intake Form</h5>
        </div>
        <div class="admin-card-body p-4">
            <form action="{{ route('admin.beneficiaries.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="full_name" class="form-label fw-bold text-navy">Applicant Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                        @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label fw-bold text-navy">Contact Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold text-navy">Email Address (Optional)</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="nic_or_id" class="form-label fw-bold text-navy">National ID / NIC (Optional)</label>
                        <input type="text" class="form-control" id="nic_or_id" name="nic_or_id" value="{{ old('nic_or_id') }}" placeholder="e.g. 198512345678">
                    </div>

                    <div class="col-md-6">
                        <label for="category" class="form-label fw-bold text-navy">Assistance Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                            <option value="Emergency Food Relief">Emergency Food Relief</option>
                            <option value="Medical Aid & Surgery Sponsorship">Medical Aid & Surgery Sponsorship</option>
                            <option value="Education Support & School Supplies">Education Support & School Supplies</option>
                            <option value="Shelter & Flood Reconstruction">Shelter & Flood Reconstruction</option>
                            <option value="Women Vocational Tools">Women Vocational Tools</option>
                            <option value="Clean Drinking Water Connection">Clean Drinking Water Connection</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="family_members_count" class="form-label fw-bold text-navy">Family Members <span class="text-danger">*</span></label>
                        <input type="number" min="1" class="form-control" id="family_members_count" name="family_members_count" value="{{ old('family_members_count', 4) }}" required>
                    </div>

                    <div class="col-md-3">
                        <label for="monthly_income" class="form-label fw-bold text-navy">Monthly Income (LKR)</label>
                        <input type="number" step="0.01" class="form-control" id="monthly_income" name="monthly_income" value="{{ old('monthly_income', 10000) }}">
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label fw-bold text-navy">Residential Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" placeholder="Street, Village, Sector..." required>
                    </div>

                    <div class="col-12">
                        <label for="assistance_requested" class="form-label fw-bold text-navy">Exact Assistance Requested <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('assistance_requested') is-invalid @enderror" id="assistance_requested" name="assistance_requested" rows="4" placeholder="Detail the family situation, current vulnerability, and exact assistance needed..." required>{{ old('assistance_requested') }}</textarea>
                        @error('assistance_requested')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="assigned_staff" class="form-label fw-bold text-navy">Assigned Review Officer</label>
                        <input type="text" class="form-control" id="assigned_staff" name="assigned_staff" value="{{ old('assigned_staff', Auth::user()->name) }}">
                    </div>

                    <div class="col-md-6">
                        <label for="review_notes" class="form-label fw-bold text-navy">Initial Verification Notes</label>
                        <input type="text" class="form-control" id="review_notes" name="review_notes" value="{{ old('review_notes') }}" placeholder="First contact notes...">
                    </div>

                    <div class="col-12 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-teal px-4">Register Beneficiary</button>
                        <a href="{{ route('admin.beneficiaries.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
