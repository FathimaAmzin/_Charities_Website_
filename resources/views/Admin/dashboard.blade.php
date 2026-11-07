@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Overview')

@section('content')

    <!-- A. WELCOME BANNER -->
    <div class="admin-welcome-banner d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <span class="badge mb-2 px-3 py-1 text-uppercase fw-bold" style="background-color: #245A91;">Administrator Portal</span>
            <h2 class="fw-bold mb-1 text-white">Welcome back, {{ Auth::user()->name ?? 'Administrator' }}!</h2>
            <p class="text-white-50 mb-0" style="max-width: 580px;">
                Manage community aid programs, verify online donations, oversee volunteers, and track field assistance across all regional operations.
            </p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.services.create') }}" class="btn btn-outline-light">
                <i class="fa-solid fa-hand-holding-heart me-1"></i> Add Service/Course
            </a>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-light fw-bold text-navy">
                <i class="fa-solid fa-plus text-teal me-1"></i> Add Project
            </a>
            <a href="{{ route('admin.campaigns.create') }}" class="btn btn-outline-light">
                <i class="fa-solid fa-bullhorn me-1"></i> New Campaign
            </a>
            <a href="{{ route('admin.donations.index') }}" class="btn btn-light fw-bold text-teal">
                <i class="fa-solid fa-receipt me-1"></i> View Donations
            </a>
        </div>
    </div>

    <!-- B. STATISTICS CARDS -->
    <div class="row g-3 g-lg-4 mb-4">
        <!-- Card 1: Total Projects -->
        <div class="col-6 col-md-4 col-xl-3">
            <a href="{{ route('admin.projects.index') }}" class="admin-stat-card">
                <div class="stat-icon-wrapper icon-teal">
                    <i class="fa-solid fa-folder-tree"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $totalProjects }}</div>
                    <div class="stat-title">Total Projects</div>
                </div>
            </a>
        </div>

        <!-- Card 2: Active Campaigns -->
        <div class="col-6 col-md-4 col-xl-3">
            <a href="{{ route('admin.campaigns.index') }}" class="admin-stat-card">
                <div class="stat-icon-wrapper icon-amber">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $activeCampaigns }}</div>
                    <div class="stat-title">Active Campaigns</div>
                </div>
            </a>
        </div>

        <!-- Card 3: Verified Donations -->
        <div class="col-6 col-md-4 col-xl-3">
            <a href="{{ route('admin.donations.index') }}" class="admin-stat-card">
                <div class="stat-icon-wrapper icon-blue">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
                <div>
                    <div class="stat-value">Rs. {{ number_format($verifiedDonationsTotal, 2) }}</div>
                    <div class="stat-title">Verified Donations (LKR)</div>
                </div>
            </a>
        </div>

        <!-- Card 4: Registered Donors -->
        <div class="col-6 col-md-4 col-xl-3">
            <a href="{{ route('admin.donors.index') }}" class="admin-stat-card">
                <div class="stat-icon-wrapper icon-navy">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $totalDonors }}</div>
                    <div class="stat-title">Registered Donors</div>
                </div>
            </a>
        </div>

        <!-- Card 5: Volunteers -->
        <div class="col-6 col-md-4 col-xl-3">
            <a href="{{ route('admin.volunteers.index') }}" class="admin-stat-card">
                <div class="stat-icon-wrapper icon-purple">
                    <i class="fa-solid fa-hands-holding-child"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $registeredVolunteers }}</div>
                    <div class="stat-title">Volunteers</div>
                </div>
            </a>
        </div>

        <!-- Card 5B: Council Members -->
        <div class="col-6 col-md-4 col-xl-3">
            <a href="{{ route('admin.members.index') }}" class="admin-stat-card">
                <div class="stat-icon-wrapper" style="background-color: #EFF6FF; color: #0059FF;">
                    <i class="fa-solid fa-users-viewfinder"></i>
                </div>
                <div>
                    <div class="stat-value text-primary">{{ $registeredMembers ?? 0 }}</div>
                    <div class="stat-title">Council Members</div>
                </div>
            </a>
        </div>

        <!-- Card 6: Pending Beneficiaries -->
        <div class="col-6 col-md-4 col-xl-3">
            <a href="{{ route('admin.beneficiaries.index', ['status' => 'pending']) }}" class="admin-stat-card">
                <div class="stat-icon-wrapper icon-rose">
                    <i class="fa-solid fa-id-card-clip"></i>
                </div>
                <div>
                    <div class="stat-value text-danger">{{ $pendingBeneficiaries }}</div>
                    <div class="stat-title">Pending Beneficiaries</div>
                </div>
            </a>
        </div>

        <!-- Card 7: Total Users -->
        <div class="col-6 col-md-4 col-xl-3">
            <a href="{{ route('admin.users.index') }}" class="admin-stat-card">
                <div class="stat-icon-wrapper icon-teal">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $totalUsers }}</div>
                    <div class="stat-title">System Users</div>
                </div>
            </a>
        </div>

        <!-- Card 8: Quick Action -->
        <div class="col-6 col-md-4 col-xl-3">
            <a href="{{ route('admin.reports.index') }}" class="admin-stat-card" style="background: linear-gradient(135deg, #F8FAFC 0%, #E2E8F0 100%);">
                <div class="stat-icon-wrapper bg-white text-navy">
                    <i class="fa-solid fa-file-pdf"></i>
                </div>
                <div>
                    <div class="stat-value fs-5 text-navy">Audit Reports</div>
                    <div class="stat-title text-teal">Generate CSV / PDF &rarr;</div>
                </div>
            </a>
        </div>
    </div>

    <!-- C. CHARTS & PENDING ACTIONS -->
    <div class="row g-4 mb-4">
        <!-- Monthly Donations Trend Chart -->
        <div class="col-lg-8">
            <div class="admin-card h-100">
                <div class="admin-card-header">
                    <h5 class="admin-card-title"><i class="fa-solid fa-chart-line text-teal me-2"></i> Monthly Verified Giving Overview</h5>
                    <a href="{{ route('admin.donations.index') }}" class="small text-teal fw-semibold">View All Donations &rarr;</a>
                </div>
                <div class="admin-card-body">
                    <div style="height: 290px;">
                        <canvas id="monthlyDonationsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- F. Pending Action Required Tasks -->
        <div class="col-lg-4">
            <div class="admin-card h-100">
                <div class="admin-card-header">
                    <h5 class="admin-card-title"><i class="fa-solid fa-bell text-warning me-2"></i> Pending Action Queue</h5>
                </div>
                <div class="admin-card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                            <div>
                                <a href="{{ route('admin.requests.index') }}" class="text-decoration-none">
                                    <strong class="d-block text-navy"><i class="fa-solid fa-graduation-cap text-primary me-1"></i> Course & Service Requests</strong>
                                </a>
                                <span class="small text-muted">Students & applicants seeking admission</span>
                            </div>
                            <a href="{{ route('admin.requests.index') }}" class="text-decoration-none">
                                <span class="badge {{ ($pendingTasks['course_requests'] ?? 0) > 0 ? 'bg-danger' : 'bg-light text-muted' }} rounded-pill px-3 py-2 fs-6">
                                    {{ $pendingTasks['course_requests'] ?? 0 }}
                                </span>
                            </a>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                            <div>
                                <strong class="d-block text-navy">Beneficiary Requests</strong>
                                <span class="small text-muted">Awaiting household verification</span>
                            </div>
                            <span class="badge {{ $pendingTasks['beneficiaries'] > 0 ? 'bg-danger' : 'bg-light text-muted' }} rounded-pill px-3 py-2 fs-6">
                                {{ $pendingTasks['beneficiaries'] }}
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                            <div>
                                <strong class="d-block text-navy">Volunteer Applications</strong>
                                <span class="small text-muted">Awaiting coordinator review</span>
                            </div>
                            <span class="badge {{ $pendingTasks['volunteers'] > 0 ? 'bg-warning text-dark' : 'bg-light text-muted' }} rounded-pill px-3 py-2 fs-6">
                                {{ $pendingTasks['volunteers'] }}
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                            <div>
                                <strong class="d-block text-navy">Member Applications</strong>
                                <span class="small text-muted">Awaiting council admission screening</span>
                            </div>
                            <span class="badge {{ ($pendingTasks['members'] ?? 0) > 0 ? 'bg-warning text-dark' : 'bg-light text-muted' }} rounded-pill px-3 py-2 fs-6">
                                {{ $pendingTasks['members'] ?? 0 }}
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                            <div>
                                <strong class="d-block text-navy">Donations Verification</strong>
                                <span class="small text-muted">Bank wire transfers to confirm</span>
                            </div>
                            <span class="badge {{ $pendingTasks['pending_donations'] > 0 ? 'bg-info text-white' : 'bg-light text-muted' }} rounded-pill px-3 py-2 fs-6">
                                {{ $pendingTasks['pending_donations'] }}
                            </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                            <div>
                                <strong class="d-block text-navy">Active Appeals Ongoing</strong>
                                <span class="small text-muted">Campaigns with live targets</span>
                            </div>
                            <span class="badge bg-success rounded-pill px-3 py-2 fs-6">
                                {{ $pendingTasks['active_campaigns'] }}
                            </span>
                        </li>
                    </ul>

                    <div class="p-3 bg-light text-center border-top">
                        <a href="{{ route('admin.beneficiaries.index', ['status' => 'pending']) }}" class="btn btn-sm btn-teal w-100">
                            Review Pending Beneficiaries Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- E. RECENT DONATIONS TABLE & TOP CAMPAIGNS -->
    <div class="row g-4">
        <!-- Recent Donations Table -->
        <div class="col-lg-8">
            <div class="admin-card mb-0">
                <div class="admin-card-header">
                    <h5 class="admin-card-title"><i class="fa-solid fa-receipt text-teal me-2"></i> Recent Verified Donations</h5>
                    <a href="{{ route('admin.donations.index') }}" class="btn btn-sm btn-outline-navy">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table admin-table align-middle">
                        <thead>
                            <tr>
                                <th>Receipt Ref</th>
                                <th>Donor</th>
                                <th>Allocated Program</th>
                                <th>Amount (LKR / Rs.)</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-end">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentDonations as $d)
                                <tr>
                                    <td><span class="badge badge-receipt font-monospace">{{ $d->receipt_code }}</span></td>
                                    <td>
                                        <div class="fw-semibold text-navy">{{ $d->donor_name }}</div>
                                        <span class="small text-muted">{{ $d->email }}</span>
                                    </td>
                                    <td>
                                        <span class="text-truncate d-inline-block" style="max-width: 150px;">
                                            {{ $d->campaign->title ?? ($d->project->title ?? 'General Fund') }}
                                        </span>
                                    </td>
                                    <td><strong class="text-teal">Rs. {{ number_format($d->amount, 2) }}</strong></td>
                                    <td class="small text-muted">{{ $d->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge {{ $d->status === 'completed' ? 'bg-success' : 'bg-warning text-dark' }} text-capitalize">
                                            {{ $d->status }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.donations.show', $d->id) }}" class="btn-action-view" title="View Details">
                                            <i class="fa-solid fa-eye me-1"></i> Details
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No recent donations found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Top Campaigns Progress -->
        <div class="col-lg-4">
            <div class="admin-card mb-0">
                <div class="admin-card-header">
                    <h5 class="admin-card-title"><i class="fa-solid fa-bullhorn text-teal me-2"></i> Campaign Performance</h5>
                </div>
                <div class="admin-card-body">
                    @forelse($topCampaigns as $c)
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <strong class="small text-navy text-truncate" style="max-width: 200px;">{{ $c->title }}</strong>
                                <span class="badge small" style="background-color: #EBF3FC; color: #245A91;">{{ $c->progress_percent }}%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar" style="width: {{ $c->progress_percent }}%; background-color: #245A91;"></div>
                            </div>
                            <div class="d-flex justify-content-between text-muted small mt-1" style="font-size: 0.78rem;">
                                <span>Raised: Rs. {{ number_format($c->amount_raised, 0) }}</span>
                                <span>Goal: Rs. {{ number_format($c->target_amount, 0) }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted small">No campaigns recorded yet.</p>
                    @endforelse

                    <a href="{{ route('admin.campaigns.index') }}" class="btn btn-sm btn-outline-teal w-100 mt-2">Manage All Campaigns</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('monthlyDonationsChart');
        if (ctx) {
            const labels = {!! json_encode($monthlyDonations->pluck('month_label')) !!};
            const data = {!! json_encode($monthlyDonations->pluck('total')) !!};

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels.length ? labels : ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                    datasets: [{
                        label: 'Donations Received (Rs.)',
                        data: data.length ? data : [12000, 18500, 24000, 19200, 31000, 48500],
                        backgroundColor: '#245A91',
                        borderRadius: 6,
                        hoverBackgroundColor: '#12345A'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#F1F5F9' },
                            ticks: {
                                callback: function(val) { return 'Rs. ' + val.toLocaleString(); }
                            }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
