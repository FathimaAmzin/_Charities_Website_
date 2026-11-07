<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsEventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes - SDC International Charity & Community System
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// About Us
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Teams (Board of Directors & Managing Executive Members)
Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');

// Our Services (Electricity, Education, House, Water Supply, Basic Facilities, Livelihood, Widows & Families, Disabilities)
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Vocational Courses & Free Seminars
Route::get('/courses', [ServiceController::class, 'courses'])->name('courses.index');

// Course & Service Application Submission
Route::post('/course-requests', [\App\Http\Controllers\CourseRequestController::class, 'store'])->name('course.request.store');

// Projects (Retained for existing projects & slugs)
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');

// Campaigns
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::get('/campaigns/{slug}', [CampaignController::class, 'show'])->name('campaigns.show');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

// News & Events
Route::get('/news-events', [NewsEventController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsEventController::class, 'showNews'])->name('news.show');
Route::get('/events/{slug}', [NewsEventController::class, 'showEvent'])->name('events.show');

// Contact Us
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Volunteer Registration
Route::get('/volunteer', [VolunteerController::class, 'create'])->name('volunteer.register');
Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteer.store');

// Member Registration
Route::get('/members/register', [\App\Http\Controllers\MemberController::class, 'create'])->name('member.register');
Route::post('/members/register', [\App\Http\Controllers\MemberController::class, 'store'])->name('member.store');

// Donation
Route::get('/donate', [DonationController::class, 'create'])->name('donate');
Route::post('/donate', [DonationController::class, 'store'])->name('donate.store');
Route::get('/donate/confirmation/{receipt_code}', [DonationController::class, 'confirmation'])->name('donate.confirmation');

// Authentication (Preserving Login route & functionality)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [\App\Http\Controllers\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [\App\Http\Controllers\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [\App\Http\Controllers\ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [\App\Http\Controllers\ForgotPasswordController::class, 'reset'])->name('password.update');

// User Personal Dashboard & Member Portal (Protected by auth)
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/profile', [\App\Http\Controllers\User\DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/password', [\App\Http\Controllers\User\DashboardController::class, 'updatePassword'])->name('password.update');
});

// Universal /dashboard route: Admin goes to admin.dashboard, members go to user.dashboard
Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Management Routes (Protected by AdminMiddleware)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    // Dashboard
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.root');
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Services & Courses Management CRUD
    Route::post('/services/{id}/gallery/delete', [\App\Http\Controllers\Admin\ServiceController::class, 'deleteGalleryPhoto'])->name('services.gallery.delete');
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);

    // Course & Service Applications Management
    Route::get('/requests', [\App\Http\Controllers\Admin\CourseRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/{id}', [\App\Http\Controllers\Admin\CourseRequestController::class, 'show'])->name('requests.show');
    Route::post('/requests/{id}/status', [\App\Http\Controllers\Admin\CourseRequestController::class, 'updateStatus'])->name('requests.updateStatus');
    Route::post('/requests/{id}/decision/{decision}', [\App\Http\Controllers\Admin\CourseRequestController::class, 'quickDecision'])->name('requests.quickDecision');
    Route::post('/requests/mark-all-read', [\App\Http\Controllers\Admin\CourseRequestController::class, 'markAllAsRead'])->name('requests.markAllRead');
    Route::delete('/requests/{id}', [\App\Http\Controllers\Admin\CourseRequestController::class, 'destroy'])->name('requests.destroy');

    // Teams Management CRUD (Board of Directors & Managing Executives)
    Route::resource('teams', \App\Http\Controllers\Admin\TeamController::class);

    // Projects CRUD
    Route::get('/projects', [\App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [\App\Http\Controllers\Admin\ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [\App\Http\Controllers\Admin\ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{id}', [\App\Http\Controllers\Admin\ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{id}/edit', [\App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{id}', [\App\Http\Controllers\Admin\ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{id}', [\App\Http\Controllers\Admin\ProjectController::class, 'destroy'])->name('projects.destroy');

    // Campaigns CRUD
    Route::get('/campaigns', [\App\Http\Controllers\Admin\CampaignController::class, 'index'])->name('campaigns.index');
    Route::get('/campaigns/create', [\App\Http\Controllers\Admin\CampaignController::class, 'create'])->name('campaigns.create');
    Route::post('/campaigns', [\App\Http\Controllers\Admin\CampaignController::class, 'store'])->name('campaigns.store');
    Route::get('/campaigns/{id}', [\App\Http\Controllers\Admin\CampaignController::class, 'show'])->name('campaigns.show');
    Route::get('/campaigns/{id}/edit', [\App\Http\Controllers\Admin\CampaignController::class, 'edit'])->name('campaigns.edit');
    Route::put('/campaigns/{id}', [\App\Http\Controllers\Admin\CampaignController::class, 'update'])->name('campaigns.update');
    Route::delete('/campaigns/{id}', [\App\Http\Controllers\Admin\CampaignController::class, 'destroy'])->name('campaigns.destroy');

    // Donors Management
    Route::get('/donors', [\App\Http\Controllers\Admin\DonorController::class, 'index'])->name('donors.index');
    Route::get('/donors/{id}', [\App\Http\Controllers\Admin\DonorController::class, 'show'])->name('donors.show');

    // Donations Management & Verification
    Route::get('/donations', [\App\Http\Controllers\Admin\DonationController::class, 'index'])->name('donations.index');
    Route::get('/donations/export/csv', [\App\Http\Controllers\Admin\DonationController::class, 'exportCsv'])->name('donations.export');
    Route::get('/donations/{id}', [\App\Http\Controllers\Admin\DonationController::class, 'show'])->name('donations.show');
    Route::post('/donations/{id}/verify', [\App\Http\Controllers\Admin\DonationController::class, 'verify'])->name('donations.verify');

    // Volunteers Management
    Route::get('/volunteers', [\App\Http\Controllers\Admin\VolunteerController::class, 'index'])->name('volunteers.index');
    Route::get('/volunteers/{id}', [\App\Http\Controllers\Admin\VolunteerController::class, 'show'])->name('volunteers.show');
    Route::post('/volunteers/{id}/status', [\App\Http\Controllers\Admin\VolunteerController::class, 'updateStatus'])->name('volunteers.updateStatus');
    Route::delete('/volunteers/{id}', [\App\Http\Controllers\Admin\VolunteerController::class, 'destroy'])->name('volunteers.destroy');

    // Members Management
    Route::get('/members', [\App\Http\Controllers\Admin\MemberController::class, 'index'])->name('members.index');
    Route::get('/members/{id}', [\App\Http\Controllers\Admin\MemberController::class, 'show'])->name('members.show');
    Route::post('/members/{id}/status', [\App\Http\Controllers\Admin\MemberController::class, 'updateStatus'])->name('members.updateStatus');
    Route::delete('/members/{id}', [\App\Http\Controllers\Admin\MemberController::class, 'destroy'])->name('members.destroy');

    // Beneficiaries Management
    Route::get('/beneficiaries', [\App\Http\Controllers\Admin\BeneficiaryController::class, 'index'])->name('beneficiaries.index');
    Route::get('/beneficiaries/create', [\App\Http\Controllers\Admin\BeneficiaryController::class, 'create'])->name('beneficiaries.create');
    Route::post('/beneficiaries', [\App\Http\Controllers\Admin\BeneficiaryController::class, 'store'])->name('beneficiaries.store');
    Route::get('/beneficiaries/{id}', [\App\Http\Controllers\Admin\BeneficiaryController::class, 'show'])->name('beneficiaries.show');
    Route::post('/beneficiaries/{id}/status', [\App\Http\Controllers\Admin\BeneficiaryController::class, 'updateStatus'])->name('beneficiaries.updateStatus');

    // News Management
    Route::get('/news', [\App\Http\Controllers\Admin\NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [\App\Http\Controllers\Admin\NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [\App\Http\Controllers\Admin\NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{id}/edit', [\App\Http\Controllers\Admin\NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{id}', [\App\Http\Controllers\Admin\NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{id}', [\App\Http\Controllers\Admin\NewsController::class, 'destroy'])->name('news.destroy');

    // Gallery Management
    Route::get('/gallery', [\App\Http\Controllers\Admin\GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [\App\Http\Controllers\Admin\GalleryController::class, 'store'])->name('gallery.store');
    Route::delete('/gallery/{id}', [\App\Http\Controllers\Admin\GalleryController::class, 'destroy'])->name('gallery.destroy');

    // Reports & Analytics
    Route::get('/reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export/csv', [\App\Http\Controllers\Admin\ReportController::class, 'export'])->name('reports.export');

    // User & Role Management
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

    // System Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});
