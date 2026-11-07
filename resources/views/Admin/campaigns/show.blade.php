@extends('admin.layouts.app')

@section('title', 'Campaign: ' . $campaign->title)
@section('page_title', 'Campaign Details')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('admin.campaigns.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Campaigns
        </a>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="btn btn-sm btn-outline-primary">
                <i class="fa-solid fa-pen me-1"></i> Edit Campaign
            </a>
            <a href="{{ route('campaigns.show', $campaign->slug) }}" target="_blank" class="btn btn-sm btn-outline-teal">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> View Live on Website
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">{{ $campaign->title }}</h5>
                    <span class="badge {{ $campaign->status === 'active' ? 'bg-success' : 'bg-secondary' }} text-capitalize">
                        {{ $campaign->status }}
                    </span>
                </div>
                <div class="admin-card-body">
                    <img src="{{ $campaign->image_url }}" alt="{{ $campaign->title }}" class="img-fluid rounded-3 mb-4 w-100" style="max-height: 380px; object-fit: cover;">

                    <h6 class="fw-bold text-navy mb-2">Campaign Narrative</h6>
                    <p class="text-body" style="line-height: 1.8;">{{ $campaign->description }}</p>
                </div>
            </div>

            <!-- Recent Verified Donors to this Campaign -->
            <div class="admin-card">
                <div class="admin-card-header">
                    <h5 class="admin-card-title"><i class="fa-solid fa-heart text-danger me-2"></i> Verified Donors to this Campaign</h5>
                </div>
                <div class="table-responsive">
                    <table class="table admin-table align-middle">
                        <thead>
                            <tr>
                                <th>Receipt Ref</th>
                                <th>Donor Name</th>
                                <th>Email</th>
                                <th>Amount (LKR / Rs.)</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($campaign->donations()->where('status', 'completed')->take(10)->get() as $cd)
                                <tr>
                                    <td><span class="badge badge-receipt">{{ $cd->receipt_code }}</span></td>
                                    <td><strong>{{ $cd->donor_name }}</strong></td>
                                    <td class="small text-muted">{{ $cd->email }}</td>
                                    <td class="fw-bold text-teal">Rs. {{ number_format($cd->amount, 2) }}</td>
                                    <td class="small text-muted">{{ $cd->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No verified donations yet for this appeal.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-4">
                <div class="admin-card-header">
                    <h5 class="admin-card-title">Fundraising Performance</h5>
                </div>
                <div class="admin-card-body">
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-3 small">
                        <li>
                            <span class="text-muted d-block">Target Goal:</span>
                            <strong class="text-navy fs-5">Rs. {{ number_format($campaign->target_amount, 2) }}</strong>
                        </li>
                        <li>
                            <span class="text-muted d-block">Total Verified Raised:</span>
                            <strong class="text-teal fs-4">Rs. {{ number_format($campaign->amount_raised, 2) }}</strong>
                        </li>
                        <li>
                            <span class="text-muted d-block">Progress:</span>
                            <div class="progress mt-1" style="height: 10px;">
                                <div class="progress-bar" style="width: {{ $campaign->progress_percent }}%; background-color: #245A91;"></div>
                            </div>
                            <span class="fw-bold text-teal">{{ $campaign->progress_percent }}% Funded</span>
                        </li>
                        <li>
                            <span class="text-muted d-block">Total Donors:</span>
                            <strong class="text-navy"><i class="fa-solid fa-users text-teal me-1"></i> {{ $campaign->donor_count }} supporters</strong>
                        </li>
                        <li>
                            <span class="text-muted d-block">Category:</span>
                            <span>{{ $campaign->category->name ?? 'General' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
