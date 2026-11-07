@extends('admin.layouts.app')

@section('title', 'Beneficiary: ' . $beneficiary->full_name)
@section('page_title', 'Beneficiary Application Review')

@section('content')

    <div class="mb-4 d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.beneficiaries.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Beneficiaries
        </a>
        <span class="badge {{ $beneficiary->status_badge }} px-3 py-2 text-uppercase font-monospace">
            {{ str_replace('_', ' ', $beneficiary->status) }}
        </span>
    </div>

    <div class="row g-4">
        <!-- Beneficiary Dossier -->
        <div class="col-lg-8">
            <div class="admin-card mb-4">
                <div class="admin-card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="admin-card-title mb-0">Application Dossier</h5>
                        <small class="text-muted">Ref: <span class="badge badge-receipt font-monospace">{{ $beneficiary->application_ref }}</span></small>
                    </div>
                    <span class="badge badge-assistance">{{ $beneficiary->category }}</span>
                </div>
                <div class="admin-card-body p-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Full Applicant Name:</span>
                            <strong class="text-navy fs-6">{{ $beneficiary->full_name }}</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">National Identity (NIC / Passport):</span>
                            <strong class="text-navy font-monospace">{{ $beneficiary->nic_or_id ?? 'Not provided' }}</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Phone / WhatsApp Contact:</span>
                            <span>{{ $beneficiary->phone }}</span>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Email Address:</span>
                            <span>{{ $beneficiary->email ?? 'N/A' }}</span>
                        </div>
                        <div class="col-12">
                            <span class="text-muted small d-block">Residential Address:</span>
                            <div class="p-2 bg-light rounded border text-navy">
                                <i class="fa-solid fa-location-dot text-teal me-2"></i>{{ $beneficiary->address }}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Family Dependents Count:</span>
                            <strong class="text-navy">{{ $beneficiary->family_members_count }} Members</strong>
                        </div>
                        <div class="col-sm-6">
                            <span class="text-muted small d-block">Reported Monthly Income:</span>
                            <strong class="text-navy">
                                {{ $beneficiary->monthly_income ? 'LKR ' . number_format($beneficiary->monthly_income, 2) : 'Nil / Irregular' }}
                            </strong>
                        </div>

                        <div class="col-12">
                            <span class="text-muted small d-block">Requested Assistance Details:</span>
                            <div class="p-3 bg-light rounded-3 border mt-1 text-navy" style="line-height: 1.7;">
                                {{ $beneficiary->assistance_requested }}
                            </div>
                        </div>

                        <div class="col-12">
                            <span class="text-muted small d-block">Confidential Staff Review Notes:</span>
                            <div class="p-3 bg-warning-subtle rounded-3 border border-warning text-dark mt-1">
                                <i class="fa-solid fa-shield-halved text-warning me-1"></i>
                                {{ $beneficiary->review_notes ?: 'No review notes have been logged yet for this applicant.' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Review & Status Form -->
        <div class="col-lg-4">
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">Case Assessment & Action</h5>
                </div>
                <div class="admin-card-body p-4">
                    <form action="{{ route('admin.beneficiaries.updateStatus', $beneficiary->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold text-navy small">Case Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pending" {{ $beneficiary->status == 'pending' ? 'selected' : '' }}>Pending Initial Review</option>
                                <option value="under_review" {{ $beneficiary->status == 'under_review' ? 'selected' : '' }}>Under Field Verification</option>
                                <option value="approved" {{ $beneficiary->status == 'approved' ? 'selected' : '' }}>Approved for Assistance</option>
                                <option value="rejected" {{ $beneficiary->status == 'rejected' ? 'selected' : '' }}>Rejected / Disqualified</option>
                                <option value="completed" {{ $beneficiary->status == 'completed' ? 'selected' : '' }}>Assistance Completed & Disbursed</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="assigned_staff" class="form-label fw-bold text-navy small">Assigned Case Officer</label>
                            <input type="text" class="form-control" id="assigned_staff" name="assigned_staff"
                                   value="{{ old('assigned_staff', $beneficiary->assigned_staff ?? auth()->user()->name) }}" placeholder="e.g. Officer Rizwan">
                        </div>

                        <div class="mb-3">
                            <label for="review_notes" class="form-label fw-bold text-navy small">Add / Update Verification Notes</label>
                            <textarea class="form-control" id="review_notes" name="review_notes" rows="4"
                                      placeholder="Field verification outcome, documents checked, disbursement schedule...">{{ old('review_notes', $beneficiary->review_notes) }}</textarea>
                            <div class="form-text small">Confidential. Restricted to authorized administrators & case staff.</div>
                        </div>

                        <button type="submit" class="btn btn-teal w-100 py-2">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Save Assessment
                        </button>
                    </form>
                </div>
            </div>

            <!-- Meta info box -->
            <div class="admin-card">
                <div class="admin-card-body p-3 small text-muted">
                    <div class="d-flex justify-content-between py-1 border-bottom">
                        <span>Submitted On:</span>
                        <strong>{{ $beneficiary->created_at ? $beneficiary->created_at->format('M d, Y h:i A') : 'N/A' }}</strong>
                    </div>
                    <div class="d-flex justify-content-between py-1 border-bottom">
                        <span>Last Assessment:</span>
                        <strong>{{ $beneficiary->updated_at ? $beneficiary->updated_at->diffForHumans() : 'N/A' }}</strong>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <span>Data Protection:</span>
                        <span class="text-success"><i class="fa-solid fa-lock me-1"></i> GDPR / NGO Compliant</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
