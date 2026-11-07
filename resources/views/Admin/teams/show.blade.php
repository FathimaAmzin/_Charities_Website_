@extends('admin.layouts.app')

@section('title', 'View ' . $member->name)
@section('page_title', $member->name)

@section('content')

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                @if($member->category === 'board_of_directors')
                    <span class="badge bg-primary-subtle text-primary text-uppercase fw-bold">
                        <i class="fa-solid fa-user-tie me-1"></i> Board of Directors
                    </span>
                @else
                    <span class="badge bg-success-subtle text-success text-uppercase fw-bold">
                        <i class="fa-solid fa-gears me-1"></i> Managing Executives
                    </span>
                @endif
                <span class="badge {{ $member->status === 'active' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($member->status) }}</span>
            </div>
            <h4 class="fw-bold text-navy mb-0">{{ $member->name }}</h4>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.teams.edit', $member->id) }}" class="btn btn-teal">
                <i class="fa-solid fa-pen me-1"></i> Edit Member
            </a>
            <a href="{{ route('teams.index') }}#{{ $member->category === 'board_of_directors' ? 'board-of-directors' : 'managing-executives' }}" target="_blank" class="btn btn-outline-primary">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> View on Public Page
            </a>
            <a href="{{ route('admin.teams.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Teams
            </a>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-lg-6">
            <div class="admin-card p-4 text-center">
                <div class="position-relative mx-auto mb-4" style="width: 160px; height: 160px;">
                    <img src="{{ asset($member->image) }}" alt="{{ $member->name }}" class="rounded-circle w-100 h-100 shadow" style="object-fit: cover; border: 4px solid #1E4A7A;" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=1E4A7A&color=fff&size=200'">
                </div>

                <span class="badge bg-light text-navy border px-3 py-1 rounded-pill small fw-bold mb-2">
                    {{ $member->badge ?? $member->role }}
                </span>
                <h3 class="fw-bold text-navy mb-1">{{ $member->name }}</h3>
                <div class="text-primary fw-semibold fs-6 mb-4">{{ $member->role }}</div>

                <p class="text-muted mb-4 text-start" style="line-height: 1.8;">
                    {{ $member->bio ?: 'No biographical details provided.' }}
                </p>

                <hr>

                <div class="row g-3 text-start">
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Sub-Team</small>
                        <span class="fw-bold text-navy">{{ $member->category === 'board_of_directors' ? 'Board of Directors' : 'Managing Executive Members' }}</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Display Order</small>
                        <span class="fw-bold text-navy">#{{ $member->order }}</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Email</small>
                        <span class="fw-semibold text-navy">{{ $member->email ?: 'N/A' }}</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted d-block">Phone</small>
                        <span class="fw-semibold text-navy">{{ $member->phone ?: 'N/A' }}</span>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-2 mt-4 pt-3 border-top">
                    <a href="{{ route('admin.teams.edit', $member->id) }}" class="btn btn-teal px-4">
                        <i class="fa-solid fa-pen me-1"></i> Edit
                    </a>
                    <form action="{{ route('admin.teams.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this team member?')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger px-4">
                            <i class="fa-solid fa-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

