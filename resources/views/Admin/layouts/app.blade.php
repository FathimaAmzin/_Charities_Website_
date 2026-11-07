<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') | Social Development Council</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo-sdc.jpg') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons 6.5.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" />

    <!-- Bootstrap 5.3.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Chart.js 4.4.2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Admin Modern Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/darkmode.css') }}">

    <!-- Immediate Theme Initialization (Prevents FOUC) -->
    <script>
        (function() {
            var t = localStorage.getItem('sdc_theme') || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', t);
        })();
    </script>

    @stack('styles')
</head>
<body class="admin-body">

    <!-- A. LEFT BLACK SIDEBAR -->
    <aside class="admin-sidebar" id="adminSidebar">
        <!-- Brand Header with Mobile Close Button -->
        <div class="d-flex align-items-center justify-content-between admin-brand-container">
            <a href="{{ route('admin.dashboard') }}" class="admin-brand flex-grow-1">
                <img src="{{ asset('images/logo-sdc.jpg') }}" alt="SDC Logo" onerror="this.src='https://ui-avatars.com/api/?name=SDC&background=12345A&color=fff&size=80'">
                <div>
                    <div class="admin-brand-title">SDC Admin</div>
                    <div class="admin-brand-sub">Charity Operations</div>
                </div>
            </a>
            <button type="button" class="btn btn-sm btn-outline-secondary d-lg-none me-3" id="adminSidebarCloseBtn" aria-label="Close Sidebar">
                <i class="fa-solid fa-xmark text-white"></i>
            </button>
        </div>

        <!-- Navigation Menu -->
        <ul class="sidebar-nav">
            <li class="sidebar-heading">Main Overview</li>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-heading">Programs & Causes</li>
            <li>
                <a href="{{ route('admin.services.index') }}" class="sidebar-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                    <span>Manage Services</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.requests.index') }}" class="sidebar-link {{ request()->routeIs('admin.requests*') ? 'active' : '' }}">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>Course Requests</span>
                    @if(isset($unreadRequestsCount) && $unreadRequestsCount > 0)
                        <span class="badge bg-danger rounded-pill ms-auto px-2 py-1" style="font-size: 0.7rem;">{{ $unreadRequestsCount }}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects*') ? 'active' : '' }}">
                    <i class="fa-solid fa-folder-tree"></i>
                    <span>Manage Projects</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.campaigns.index') }}" class="sidebar-link {{ request()->routeIs('admin.campaigns*') ? 'active' : '' }}">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span>Manage Campaigns</span>
                </a>
            </li>

            <li class="sidebar-heading">Donations & Donors</li>
            <li>
                <a href="{{ route('admin.donors.index') }}" class="sidebar-link {{ request()->routeIs('admin.donors*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Manage Donors</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.donations.index') }}" class="sidebar-link {{ request()->routeIs('admin.donations*') ? 'active' : '' }}">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                    <span>Manage Donations</span>
                </a>
            </li>

            <li class="sidebar-heading">Community & Volunteers</li>
            <li>
                <a href="{{ route('admin.teams.index') }}" class="sidebar-link {{ request()->routeIs('admin.teams*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users-gear"></i>
                    <span>Manage Teams</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.volunteers.index') }}" class="sidebar-link {{ request()->routeIs('admin.volunteers*') ? 'active' : '' }}">
                    <i class="fa-solid fa-hands-holding-child"></i>
                    <span>Manage Volunteers</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.members.index') }}" class="sidebar-link {{ request()->routeIs('admin.members*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users-viewfinder"></i>
                    <span>Manage Members</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.beneficiaries.index') }}" class="sidebar-link {{ request()->routeIs('admin.beneficiaries*') ? 'active' : '' }}">
                    <i class="fa-solid fa-id-card-clip"></i>
                    <span>Manage Beneficiaries</span>
                </a>
            </li>

            <li class="sidebar-heading">Content & Media</li>
            <li>
                <a href="{{ route('admin.news.index') }}" class="sidebar-link {{ request()->routeIs('admin.news*') ? 'active' : '' }}">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Manage News</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.gallery.index') }}" class="sidebar-link {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}">
                    <i class="fa-solid fa-images"></i>
                    <span>Manage Gallery</span>
                </a>
            </li>

            <li class="sidebar-heading">Insights & System</li>
            <li>
                <a href="{{ route('admin.reports.index') }}" class="sidebar-link {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-invoice"></i>
                    <span>Reports & Exports</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-shield"></i>
                    <span>User & Role Mgmt</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                    <i class="fa-solid fa-gear"></i>
                    <span>System Settings</span>
                </a>
            </li>

            <li class="sidebar-heading">Navigation</li>
            <li>
                <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span>Public Website</span>
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" id="sidebarLogoutForm">
                    @csrf
                    <a href="javascript:void(0)" onclick="document.getElementById('sidebarLogoutForm').submit()" class="sidebar-link text-danger">
                        <i class="fa-solid fa-power-off text-danger"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div class="admin-sidebar-backdrop" id="adminSidebarBackdrop"></div>

    <!-- B. TOP NAVIGATION BAR -->
    <header class="admin-topbar">
        <div class="d-flex align-items-center gap-3">
            <!-- Sidebar Toggle Button -->
            <button class="btn btn-sm btn-outline-secondary d-lg-none" type="button" id="sidebarToggleBtn" aria-label="Toggle Sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Page Title / Breadcrumb Indicator -->
            <div class="d-none d-sm-block">
                <h5 class="fw-bold mb-0 text-navy" style="font-size: 1.1rem;">@yield('page_title', 'Management Portal')</h5>
                <small class="text-muted">SDC Central Administration System</small>
            </div>
        </div>

        <!-- Right User Actions -->
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-navy d-none d-md-inline-flex align-items-center gap-2">
                <i class="fa-solid fa-globe"></i> View Public Site
            </a>

            <!-- Language Selector Dropdown -->
            <div class="dropdown custom-lang-dropdown">
                <button class="btn btn-sm lang-btn dropdown-toggle d-inline-flex align-items-center gap-2" type="button" id="adminLangDropdown" data-bs-toggle="dropdown" aria-expanded="false" title="Translate Dashboard">
                    <span class="current-lang-flag">🇬🇧</span>
                    <span class="current-lang-name d-none d-sm-inline">English</span>
                    <i class="fa-solid fa-chevron-down" style="font-size: 0.65rem;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 p-1 lang-dropdown-menu" aria-labelledby="adminLangDropdown">
                    <li>
                        <button class="dropdown-item d-flex align-items-center justify-content-between py-2 rounded-2" type="button" data-lang-select="en" onclick="sdcChangeLanguage('en')">
                            <span class="d-inline-flex align-items-center gap-2">
                                <span>🇬🇧</span>
                                <span>English</span>
                            </span>
                            <i class="fa-solid fa-check text-primary small lang-check" data-lang="en"></i>
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item d-flex align-items-center justify-content-between py-2 rounded-2" type="button" data-lang-select="ta" onclick="sdcChangeLanguage('ta')">
                            <span class="d-inline-flex align-items-center gap-2">
                                <span>🇱🇰</span>
                                <span>தமிழ் (Tamil)</span>
                            </span>
                            <i class="fa-solid fa-check text-primary small lang-check d-none" data-lang="ta"></i>
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item d-flex align-items-center justify-content-between py-2 rounded-2" type="button" data-lang-select="si" onclick="sdcChangeLanguage('si')">
                            <span class="d-inline-flex align-items-center gap-2">
                                <span>🇱🇰</span>
                                <span>සිංහල (Sinhala)</span>
                            </span>
                            <i class="fa-solid fa-check text-primary small lang-check d-none" data-lang="si"></i>
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Dark Mode Toggle Button -->
            <button class="theme-toggle-btn" type="button" title="Switch Theme" aria-label="Toggle Dark / Light Theme">
                <i class="fa-solid fa-moon theme-icon-moon"></i>
                <i class="fa-solid fa-sun theme-icon-sun d-none"></i>
            </button>

            <!-- Interactive Notification Bell & Panel -->
            <div class="dropdown">
                <button class="btn notification-bell-btn p-0 border-0" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false" title="System & User Notifications">
                    <i class="fa-solid fa-bell fs-5"></i>
                    @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                        <span class="notification-badge-pulse">{{ $unreadNotificationsCount > 99 ? '99+' : $unreadNotificationsCount }}</span>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-end notification-dropdown-menu shadow-lg" aria-labelledby="notificationDropdown">
                    <!-- Notification Header -->
                    <div class="notification-header d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="fw-bold mb-0 text-navy" style="font-size: 0.95rem;">Notifications</h6>
                            @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                                <span class="badge bg-danger text-white rounded-pill px-2 py-1" style="font-size: 0.7rem;">{{ $unreadNotificationsCount }} New</span>
                            @endif
                        </div>
                        @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                            <form action="{{ route('admin.requests.markAllRead') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 text-decoration-none small text-primary fw-semibold" style="font-size: 0.75rem;">
                                    <i class="fa-solid fa-check-double me-1"></i>Mark all read
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- Notification Items List -->
                    <div class="notification-list">
                        @forelse($recentAdminNotifications ?? [] as $notif)
                            <a href="{{ $notif->link ?: route('admin.requests.index') }}" class="notification-item {{ !$notif->is_read ? 'unread' : '' }}">
                                <div class="notification-icon-wrap {{ $notif->badge_class ?? 'bg-primary-subtle text-primary' }}">
                                    <i class="{{ $notif->icon ?? 'fa-solid fa-bell' }}"></i>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="d-flex align-items-center justify-content-between gap-2 mb-1">
                                        <span class="fw-bold text-navy text-truncate small" style="max-width: 175px;">{{ $notif->title }}</span>
                                        <span class="text-muted" style="font-size: 0.7rem;">{{ $notif->created_at ? $notif->created_at->diffForHumans() : 'Recently' }}</span>
                                    </div>
                                    <p class="text-secondary small mb-1 text-truncate-2" style="font-size: 0.78rem; line-height: 1.4;">
                                        {{ $notif->message }}
                                    </p>
                                    <div class="d-flex align-items-center justify-content-between pt-1">
                                        <span class="badge {{ $notif->type === 'user_registered' ? 'bg-info-subtle text-info border' : 'bg-primary-subtle text-primary' }}" style="font-size: 0.68rem;">
                                            {{ $notif->type === 'user_registered' ? 'User Member' : 'Course / Service' }}
                                        </span>
                                        @if(!$notif->is_read)
                                            <span class="badge bg-danger text-white" style="font-size: 0.62rem;">Unread</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="p-4 text-center text-muted">
                                <i class="fa-regular fa-bell-slash fs-3 text-secondary opacity-50 mb-2"></i>
                                <div class="small fw-semibold">No recent activity</div>
                                <div class="text-muted" style="font-size: 0.75rem;">New user registrations and requests will appear here in real-time.</div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Notification Footer -->
                    <div class="notification-footer d-flex gap-2">
                        <a href="{{ route('admin.requests.index') }}" class="btn btn-sm btn-navy flex-grow-1 rounded-pill fw-semibold py-1" style="font-size: 0.78rem;">
                            <i class="fa-solid fa-graduation-cap me-1"></i> Course Requests
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary flex-grow-1 rounded-pill fw-semibold py-1" style="font-size: 0.78rem;">
                            <i class="fa-solid fa-users me-1"></i> Users List
                        </a>
                    </div>
                </div>
            </div>

            <!-- Admin Profile Dropdown -->
            <div class="dropdown">
                <button class="btn p-0 border-0 d-flex align-items-center gap-2" type="button" id="adminUserDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=12345A&color=fff&size=40" class="rounded-circle" width="38" height="38" alt="Admin Avatar">
                    <div class="text-start d-none d-md-block">
                        <div class="fw-bold text-navy small mb-0 lh-1">{{ Auth::user()->name ?? 'Administrator' }}</div>
                        <span class="badge small text-capitalize" style="font-size: 0.65rem; background-color: #EBF3FC; color: #245A91;">
                            {{ Auth::user()->role ?? 'Admin' }}
                        </span>
                    </div>
                    <i class="fa-solid fa-angle-down text-muted small ms-1"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" aria-labelledby="adminUserDropdown">
                    <li class="px-3 py-2 border-bottom">
                        <div class="fw-bold text-navy small">{{ Auth::user()->name ?? 'Administrator' }}</div>
                        <div class="text-muted small text-truncate" style="max-width: 180px;">{{ Auth::user()->email ?? 'admin@charity.org' }}</div>
                    </li>
                    <li><a class="dropdown-item py-2 small" href="{{ route('admin.settings.index') }}"><i class="fa-solid fa-gear me-2 text-teal"></i> Settings</a></li>
                    <li><a class="dropdown-item py-2 small" href="{{ route('home') }}" target="_blank"><i class="fa-solid fa-globe me-2 text-teal"></i> Visit Public Site</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 small text-danger">
                                <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Log Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- C. MAIN CONTENT AREA -->
    <div class="admin-main-wrapper">
        <main class="admin-content">
            <!-- Flash Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 rounded-3 shadow-sm" role="alert">
                    <i class="fa-solid fa-circle-check fs-5 text-success"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 rounded-3 shadow-sm" role="alert">
                    <i class="fa-solid fa-triangle-exclamation fs-5 text-danger"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-warning alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                    <div class="fw-bold mb-1"><i class="fa-solid fa-circle-exclamation me-1"></i> Please check the form errors:</div>
                    <ul class="mb-0 ps-3 small">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- D. BLACK FOOTER -->
        <footer class="admin-footer">
            <div class="container-fluid d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <div>
                    &copy; {{ date('Y') }} <strong>Social Development Council Maligaikadu</strong>. All rights reserved.
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-dark border text-muted">SDC Central Portal v2.4.0</span>
                    <a href="{{ route('admin.settings.index') }}" class="small">System Status</a>
                    <span class="text-muted">&bull;</span>
                    <a href="{{ route('home') }}" target="_blank" class="small">Public Website</a>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap 5.3.3 Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Sidebar Mobile Drawer Toggle & Backdrop JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const closeBtn = document.getElementById('adminSidebarCloseBtn');
            const backdrop = document.getElementById('adminSidebarBackdrop');
            const sidebar = document.getElementById('adminSidebar');

            function openSidebar() {
                if (sidebar) sidebar.classList.add('show');
                if (backdrop) backdrop.classList.add('show');
                document.body.classList.add('sidebar-open');
            }

            function closeSidebar() {
                if (sidebar) sidebar.classList.remove('show');
                if (backdrop) backdrop.classList.remove('show');
                document.body.classList.remove('sidebar-open');
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    if (sidebar && sidebar.classList.contains('show')) {
                        closeSidebar();
                    } else {
                        openSidebar();
                    }
                });
            }

            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if (backdrop) backdrop.addEventListener('click', closeSidebar);

            // Auto-close drawer on mobile when clicking any navigation link
            document.querySelectorAll('.admin-sidebar .sidebar-link').forEach(link => {
                link.addEventListener('click', function () {
                    if (window.innerWidth < 992) {
                        closeSidebar();
                    }
                });
            });
        });
    </script>

    <!-- Universal Admin Delete Confirmation Modal (Yes / No) -->
    <div class="modal fade" id="universalDeleteModal" tabindex="-1" aria-labelledby="universalDeleteModalLabel" aria-hidden="true" style="z-index: 1099;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-danger text-white border-0 py-3 px-4">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation fs-5"></i>
                        <h5 class="modal-title fw-bold mb-0" id="universalDeleteModalLabel">Confirm Deletion</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle" style="width: 72px; height: 72px;">
                        <i class="fa-solid fa-trash-can fa-2x"></i>
                    </div>
                    <h5 class="fw-bold text-navy mb-2" id="universalDeleteModalHeading">Do you want to delete this record?</h5>
                    <p class="text-muted small mb-3" id="universalDeleteModalDesc">
                        Are you sure you want to proceed? This will be permanently removed.
                    </p>
                    <div class="alert alert-warning py-2 px-3 small text-start border-0 rounded-3 mb-0 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation text-danger fs-5 flex-shrink-0"></i>
                        <span><strong>Warning:</strong> Deleting this will take immediate effect across the admin dashboard and public website.</span>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light px-4 py-3 d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-secondary rounded-pill px-4 fw-semibold shadow-xs" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark me-1"></i> No, Cancel
                    </button>
                    <button type="button" class="btn btn-danger rounded-pill px-4 fw-bold shadow-xs" id="universalDeleteConfirmBtn">
                        <i class="fa-solid fa-trash me-1"></i> Yes, Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Universal Delete Interceptor Script (Yes or No Confirmation Modal) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let activeDeleteForm = null;
            const deleteModalEl = document.getElementById('universalDeleteModal');
            if (!deleteModalEl) return;
            const deleteModal = bootstrap.Modal.getOrCreateInstance(deleteModalEl);
            const headingEl = document.getElementById('universalDeleteModalHeading');
            const descEl = document.getElementById('universalDeleteModalDesc');
            const confirmBtn = document.getElementById('universalDeleteConfirmBtn');

            function interceptDeleteForms() {
                document.querySelectorAll('form').forEach(form => {
                    const methodInput = form.querySelector('input[name="_method"][value="DELETE"]');
                    const isDeleteAction = (form.action && (form.action.includes('destroy') || form.action.includes('delete')));
                    const hasDeleteBtn = form.querySelector('button[type="submit"].btn-danger, button[type="submit"].btn-outline-danger, button[type="submit"] i.fa-trash, button[type="submit"] i.fa-trash-can');

                    if (methodInput || isDeleteAction || hasDeleteBtn || form.dataset.confirmDelete === 'true') {
                        // Strip native confirm to avoid browser system popups
                        if (form.hasAttribute('onsubmit')) {
                            const originalOnsubmit = form.getAttribute('onsubmit');
                            const match = originalOnsubmit.match(/confirm\(\s*['"`](.*?)['"`]\s*\)/);
                            if (match && match[1]) {
                                form.dataset.confirmPrompt = match[1];
                            }
                            form.removeAttribute('onsubmit');
                        }

                        // Also remove any inline onclick with confirm on the submit button
                        const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
                        if (submitBtn && submitBtn.hasAttribute('onclick')) {
                            const btnOnclick = submitBtn.getAttribute('onclick');
                            const matchBtn = btnOnclick.match(/confirm\(\s*['"`](.*?)['"`]\s*\)/);
                            if (matchBtn && matchBtn[1]) {
                                form.dataset.confirmPrompt = matchBtn[1];
                            }
                            submitBtn.removeAttribute('onclick');
                        }

                        form.addEventListener('submit', function (e) {
                            if (form.dataset.confirmed === 'true') {
                                return true;
                            }

                            e.preventDefault();
                            e.stopPropagation();
                            activeDeleteForm = form;

                            // Formulate prompt text
                            let prompt = form.dataset.confirmPrompt;
                            if (prompt) {
                                prompt = prompt.trim();
                                if (!prompt.toLowerCase().startsWith('do you want') && !prompt.toLowerCase().startsWith('are you sure')) {
                                    prompt = 'Do you want to delete ' + prompt.replace(/\?+$/, '') + '?';
                                }
                            } else {
                                // Extract item title from nearest card/row if possible
                                const row = form.closest('tr, .admin-card, .card, .list-group-item');
                                let itemName = '';
                                if (row) {
                                    const titleEl = row.querySelector('.card-title, h5, h6, strong, .fw-bold, td:nth-child(2)');
                                    if (titleEl) {
                                        itemName = titleEl.textContent.trim().replace(/\s+/g, ' ');
                                    }
                                }
                                if (itemName && itemName.length < 50) {
                                    prompt = `Do you want to delete "${itemName}"?`;
                                } else {
                                    prompt = 'Do you want to delete this record?';
                                }
                            }

                            headingEl.textContent = prompt;
                            descEl.textContent = 'Are you sure you want to proceed? This item will be permanently removed from the system and public website.';
                            deleteModal.show();
                        });
                    }
                });
            }

            interceptDeleteForms();

            // When user clicks "Yes, Delete" in modal
            confirmBtn.addEventListener('click', function () {
                if (activeDeleteForm) {
                    confirmBtn.disabled = true;
                    confirmBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Deleting...';
                    activeDeleteForm.dataset.confirmed = 'true';
                    activeDeleteForm.submit();
                }
            });

            // Reset state when modal is closed / canceled
            deleteModalEl.addEventListener('hidden.bs.modal', function () {
                activeDeleteForm = null;
                confirmBtn.disabled = false;
                confirmBtn.innerHTML = '<i class="fa-solid fa-trash me-1"></i> Yes, Delete';
            });
        });
    </script>

    <!-- Dark Mode & Multi-Language Translation Manager -->
    <script src="{{ asset('js/theme-lang.js') }}"></script>

    @stack('scripts')
</body>
</html>
