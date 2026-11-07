@extends('admin.layouts.app')

@section('title', 'Institutional Settings')
@section('page_title', 'Organization Profile & System Settings')

@section('content')

    <div class="row g-4">
        <div class="col-lg-3">
            <!-- Settings Navigation Nav-pills -->
            <div class="admin-card p-3 mb-4">
                <div class="nav flex-column nav-pills" id="settingsTab" role="tablist">
                    <button class="nav-link active text-start py-2 px-3 fw-bold mb-1" id="org-tab" data-bs-toggle="pill" data-bs-target="#tab-org" type="button" role="tab">
                        <i class="fa-solid fa-building-ngo me-2"></i> Organization Profile
                    </button>
                    <button class="nav-link text-start py-2 px-3 fw-bold mb-1" id="bank-tab" data-bs-toggle="pill" data-bs-target="#tab-bank" type="button" role="tab">
                        <i class="fa-solid fa-building-columns me-2"></i> Bank & Donations
                    </button>
                    <button class="nav-link text-start py-2 px-3 fw-bold mb-1" id="gateway-tab" data-bs-toggle="pill" data-bs-target="#tab-gateway" type="button" role="tab">
                        <i class="fa-solid fa-credit-card me-2"></i> Payment Gateway
                    </button>
                    <button class="nav-link text-start py-2 px-3 fw-bold mb-1" id="security-tab" data-bs-toggle="pill" data-bs-target="#tab-security" type="button" role="tab">
                        <i class="fa-solid fa-shield-halved me-2"></i> Security & Audits
                    </button>
                </div>
            </div>

            <!-- Organization Badge Card -->
            <div class="admin-card p-3 text-center">
                <div class="avatar-circle mx-auto mb-2 bg-navy text-teal rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 55px; height: 55px;">
                    <i class="fa-solid fa-hands-holding-child fa-lg"></i>
                </div>
                <h6 class="text-navy fw-bold mb-1">SDC Maligaikadu</h6>
                <small class="text-muted d-block">Reg. No: GA 2838</small>
                <span class="badge bg-success-subtle text-success border border-success mt-2">Active NGO License</span>
            </div>
        </div>

        <div class="col-lg-9">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div class="tab-content" id="settingsTabContent">

                    <!-- Tab 1: Organization Profile -->
                    <div class="tab-pane fade show active" id="tab-org" role="tabpanel">
                        <div class="admin-card">
                            <div class="admin-card-header">
                                <h5 class="admin-card-title">Institutional Identity & Headquarters</h5>
                            </div>
                            <div class="admin-card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <label class="form-label fw-bold text-navy small">Organization Official Name</label>
                                        <input type="text" class="form-control" name="org_name" value="Social Development Council (SDC) Maligaikadu" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold text-navy small">Government Registration No</label>
                                        <input type="text" class="form-control" name="org_reg_no" value="GA 2838 / SL-NGO" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-navy small">Official Public Inquiries Email</label>
                                        <input type="email" class="form-control" name="org_email" value="info@sdcmksl.org" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-navy small">Hotline / WhatsApp</label>
                                        <input type="text" class="form-control" name="org_phone" value="+94 67 222 9390" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold text-navy small">Headquarters Physical Address</label>
                                        <textarea class="form-control" name="org_address" rows="2" required>Main Street, Maligaikadu, Eastern Province, Sri Lanka</textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold text-navy small">Official Mission Statement</label>
                                        <textarea class="form-control" name="org_mission" rows="3">Dedicated to poverty alleviation, orphan welfare, clean water infrastructure, educational excellence, and healthcare support for underprivileged communities.</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Bank & Donations -->
                    <div class="tab-pane fade" id="tab-bank" role="tabpanel">
                        <div class="admin-card">
                            <div class="admin-card-header">
                                <h5 class="admin-card-title">Official Humanitarian Bank Account Details</h5>
                            </div>
                            <div class="admin-card-body p-4">
                                <div class="alert alert-info border-info small">
                                    <i class="fa-solid fa-circle-info me-1"></i> These details are displayed on the public website for donors sending direct wire transfers or local bank deposits.
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-navy small">Beneficiary Account Name</label>
                                        <input type="text" class="form-control font-monospace" name="bank_account_name" value="Social Development Council">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-navy small">Account Number</label>
                                        <input type="text" class="form-control font-monospace" name="bank_account_number" value="0640 1000 7890">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-navy small">Bank Name</label>
                                        <input type="text" class="form-control" name="bank_name" value="Bank of Ceylon (BOC)">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-navy small">Branch / Swift BIC</label>
                                        <input type="text" class="form-control font-monospace" name="bank_swift" value="BCEYLKLX / Sainthamaruthu Branch">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 3: Payment Gateway -->
                    <div class="tab-pane fade" id="tab-gateway" role="tabpanel">
                        <div class="admin-card">
                            <div class="admin-card-header">
                                <h5 class="admin-card-title">Online Payment Processing Gateway</h5>
                            </div>
                            <div class="admin-card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-navy small">Active Gateway Engine</label>
                                        <select class="form-select" name="gateway_engine">
                                            <option value="test_sandbox" selected>Sandbox Demonstration (Test Cards Enabled)</option>
                                            <option value="stripe">Stripe Payments (Credit / Debit Card)</option>
                                            <option value="bank_direct">Direct Bank Wire Transfer Proof Only</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-navy small">Default Settlement Currency</label>
                                        <select class="form-select font-monospace" name="default_currency">
                                            <option value="LKR" selected>LKR (Rs.) - Sri Lankan Rupee</option>
                                            <option value="USD">USD ($) - United States Dollar</option>
                                            <option value="GBP">GBP (£) - British Pound Sterling</option>
                                            <option value="EUR">EUR (€) - Euro</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold text-navy small">Payment Webhook Public Endpoint</label>
                                        <input type="text" class="form-control font-monospace bg-light" readonly value="{{ url('/webhook/donations') }}">
                                        <div class="form-text small">Configure this URL in your payment gateway dashboard to receive real-time IPN / Webhook callbacks.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 4: Security & Audits -->
                    <div class="tab-pane fade" id="tab-security" role="tabpanel">
                        <div class="admin-card">
                            <div class="admin-card-header">
                                <h5 class="admin-card-title">Access Policy & Security Safeguards</h5>
                            </div>
                            <div class="admin-card-body p-4">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="audit_log" name="audit_log" checked disabled>
                                    <label class="form-check-label fw-bold text-navy ms-2" for="audit_log">
                                        Mandatory Donation Verification Audit Trail
                                    </label>
                                    <div class="text-muted small">Every manual payment status change is timestamped with the acting administrator's ID.</div>
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="public_beneficiaries" name="public_beneficiaries" checked disabled>
                                    <label class="form-check-label fw-bold text-navy ms-2" for="public_beneficiaries">
                                        Strict Beneficiary Privacy Firewall
                                    </label>
                                    <div class="text-muted small">Beneficiary personal identity, phone numbers, and addresses are strictly concealed from public routes.</div>
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="admin_last_guard" checked disabled>
                                    <label class="form-check-label fw-bold text-navy ms-2" for="admin_last_guard">
                                        Last-Admin Lockout Protection
                                    </label>
                                    <div class="text-muted small">System automatically rejects deletion or deactivation of the last remaining administrator account.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-teal px-4 py-2">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Configuration Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
