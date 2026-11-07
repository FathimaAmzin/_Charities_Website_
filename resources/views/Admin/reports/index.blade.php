@extends('admin.layouts.app')

@section('title', 'Reports & Humanitarian Analytics')
@section('page_title', 'Audit & Performance Reports')

@section('content')

    <div class="row align-items-center mb-4 g-3 d-print-none">
        <div class="col-md-7">
            <h5 class="mb-0 text-navy fw-bold">Executive Analytics & Impact Audit</h5>
            <p class="text-muted small mb-0">Audited contributions, campaign yield, volunteer intake, and beneficiary case outcomes</p>
        </div>
        <div class="col-md-5 text-md-end d-flex gap-2 justify-content-md-end">
            <button onclick="window.print()" class="btn btn-outline-secondary">
                <i class="fa-solid fa-print me-1"></i> Print Report
            </button>
            <a href="{{ route('admin.reports.export') }}" class="btn btn-teal">
                <i class="fa-solid fa-file-csv me-1"></i> Export CSV Audit
            </a>
        </div>
    </div>

    <!-- Date Range Filter Form -->
    <div class="admin-card mb-4 d-print-none">
        <div class="admin-card-body p-3">
            <form action="{{ route('admin.reports.index') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-navy">Filter Start Date</label>
                    <input type="date" name="date_from" class="form-control form-control-sm" value="{{ $dateFrom }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-navy">Filter End Date</label>
                    <input type="date" name="date_to" class="form-control form-control-sm" value="{{ $dateTo }}">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-teal w-100">Apply Date Window</button>
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Audited Financial Highlights -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="admin-card p-3 border-start border-4 border-teal h-100">
                <span class="text-muted small d-block">Verified Contributions in Period:</span>
                <h3 class="text-teal fw-bold my-1">Rs. {{ number_format($totalRaisedPeriod, 2) }}</h3>
                <span class="small text-muted"><i class="fa-solid fa-calendar-check me-1"></i> {{ $dateFrom }} to {{ $dateTo }}</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="admin-card p-3 border-start border-4 border-primary h-100">
                <span class="text-muted small d-block">Total Campaigns Monitored:</span>
                <h3 class="text-navy fw-bold my-1">{{ count($campaignReports) }} Appeals</h3>
                <span class="small text-muted"><i class="fa-solid fa-bullhorn me-1"></i> Public & Emergency Appeals</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="admin-card p-3 border-start border-4 border-success h-100">
                <span class="text-muted small d-block">Approved Beneficiary Assistance:</span>
                <h3 class="text-success fw-bold my-1">{{ $beneficiaryStats['approved'] ?? 0 }} Cases</h3>
                <span class="small text-muted"><i class="fa-solid fa-hand-holding-heart me-1"></i> Field-verified families supported</span>
            </div>
        </div>
    </div>

    <!-- Monthly Donations Trend Table -->
    <div class="admin-card mb-4">
        <div class="admin-card-header">
            <h5 class="admin-card-title"><i class="fa-solid fa-chart-line text-teal me-2"></i>Verified Monthly Inflow Breakdown</h5>
        </div>
        <div class="admin-card-body p-0">
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Accounting Period</th>
                            <th>Transaction Volume</th>
                            <th>Gross Verified Inflow (LKR)</th>
                            <th>Average Contribution (LKR)</th>
                            <th class="pe-4 text-end">Audit Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($monthlyDonations as $month)
                            <tr>
                                <td>
                                    <strong class="text-navy font-monospace">{{ $month->month_name }}</strong>
                                </td>
                                <td>
                                    <span class="badge badge-receipt">{{ $month->count }} Receipts</span>
                                </td>
                                <td>
                                    <strong class="text-teal fs-6">Rs. {{ number_format($month->total, 2) }}</strong>
                                </td>
                                <td>
                                    Rs. {{ number_format($month->total / ($month->count ?: 1), 2) }}
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="badge bg-success-subtle text-success border border-success">
                                        <i class="fa-solid fa-check-double me-1"></i>Reconciled
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    No completed donations recorded in the selected period.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Campaign Fundraising Performance -->
    <div class="admin-card mb-4">
        <div class="admin-card-header">
            <h5 class="admin-card-title"><i class="fa-solid fa-bullhorn text-teal me-2"></i>Campaign Fundraising Performance</h5>
        </div>
        <div class="admin-card-body p-0">
            <div class="table-responsive">
                <table class="table admin-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Campaign Appeal</th>
                            <th>Financial Target (LKR)</th>
                            <th>Total Raised (LKR)</th>
                            <th style="min-width: 180px;">Target Fulfillment</th>
                            <th>Donors</th>
                            <th class="pe-4 text-end">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($campaignReports as $camp)
                            <tr>
                                <td><strong class="text-navy">{{ $camp['title'] }}</strong></td>
                                <td>Rs. {{ number_format($camp['target'], 2) }}</td>
                                <td><strong class="text-teal">Rs. {{ number_format($camp['raised'], 2) }}</strong></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1" style="height: 7px;">
                                            <div class="progress-bar bg-teal" style="width: {{ $camp['percent'] }}%;"></div>
                                        </div>
                                        <small class="text-muted fw-bold">{{ $camp['percent'] }}%</small>
                                    </div>
                                </td>
                                <td>{{ $camp['donors'] }} Donors</td>
                                <td class="pe-4 text-end">
                                    <span class="badge {{ $camp['status'] === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($camp['status']) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No campaigns currently active.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Intake Performance (Volunteers & Beneficiaries) -->
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="admin-card h-100">
                <div class="admin-card-header">
                    <h5 class="admin-card-title"><i class="fa-solid fa-users text-teal me-2"></i>Volunteer Roster Status</h5>
                </div>
                <div class="admin-card-body p-4">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fa-solid fa-circle-check text-success me-2"></i>Approved Active Volunteers</span>
                            <strong class="badge bg-success-subtle text-success fs-6">{{ $volunteerStats['approved'] ?? 0 }}</strong>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fa-solid fa-clock text-warning me-2"></i>Pending Initial Screening</span>
                            <strong class="badge bg-warning-subtle text-warning fs-6">{{ $volunteerStats['pending'] ?? 0 }}</strong>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fa-solid fa-user-clock text-info me-2"></i>Under Interview / Background Review</span>
                            <strong class="badge bg-info-subtle text-info fs-6">{{ $volunteerStats['under_review'] ?? 0 }}</strong>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fa-solid fa-user-xmark text-danger me-2"></i>Rejected / Not Eligible</span>
                            <strong class="badge bg-danger-subtle text-danger fs-6">{{ $volunteerStats['rejected'] ?? 0 }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="admin-card h-100">
                <div class="admin-card-header">
                    <h5 class="admin-card-title"><i class="fa-solid fa-hand-holding-heart text-teal me-2"></i>Beneficiary Relief Caseload</h5>
                </div>
                <div class="admin-card-body p-4">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fa-solid fa-flag-checkered text-success me-2"></i>Completed & Disbursed Assistance</span>
                            <strong class="badge bg-success-subtle text-success fs-6">{{ $beneficiaryStats['completed'] ?? 0 }}</strong>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fa-solid fa-circle-check text-primary me-2"></i>Approved Awaiting Disbursement</span>
                            <strong class="badge bg-primary-subtle text-primary fs-6">{{ $beneficiaryStats['approved'] ?? 0 }}</strong>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fa-solid fa-magnifying-glass text-warning me-2"></i>Field Verification Underway</span>
                            <strong class="badge bg-warning-subtle text-warning fs-6">{{ $beneficiaryStats['under_review'] ?? 0 }}</strong>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span><i class="fa-solid fa-inbox text-secondary me-2"></i>New Pending Intake Applications</span>
                            <strong class="badge bg-secondary-subtle text-secondary fs-6">{{ $beneficiaryStats['pending'] ?? 0 }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Institutional Disclaimer -->
    <div class="alert alert-light border small text-muted">
        <i class="fa-solid fa-circle-info text-teal me-1"></i>
        <strong>Audit Compliance Statement:</strong> In accordance with international humanitarian accounting standards, charitable receipts are non-commercial gift distributions earmarked exclusively for declared social welfare activities, orphan relief, and infrastructure projects.
    </div>

@endsection
