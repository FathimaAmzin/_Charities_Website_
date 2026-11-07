<?php

namespace App\Providers;

use App\Models\AdminNotification;
use App\Models\CourseRequest;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share live unread notifications, course requests, and user registrations with Admin portal
        View::composer(['admin.*', 'Admin.*'], function ($view) {
            try {
                $hasNotifTable = Schema::hasTable('admin_notifications');
                $hasReqTable = Schema::hasTable('course_requests');

                $unreadRequestsCount = $hasReqTable ? CourseRequest::where('is_read', false)->count() : 0;
                $unreadNotifCount = $hasNotifTable ? AdminNotification::where('is_read', false)->count() : 0;

                // Total badge is all unread admin notifications
                $totalUnreadCount = max($unreadNotifCount, $unreadRequestsCount);

                $recentAdminNotifications = $hasNotifTable 
                    ? AdminNotification::latest()->take(10)->get() 
                    : collect();

                // If admin_notifications is empty but course_requests has items, fallback to course requests
                if ($recentAdminNotifications->isEmpty() && $hasReqTable) {
                    $recentAdminNotifications = CourseRequest::latest()->take(7)->get()->map(function ($r) {
                        return (object) [
                            'id' => $r->id,
                            'type' => $r->type,
                            'title' => $r->type === 'course' ? 'Course Application' : 'Service Request',
                            'message' => "{$r->full_name} applied for {$r->course_title}",
                            'link' => route('admin.requests.index', ['search' => $r->phone ?: $r->full_name]),
                            'icon' => $r->type === 'course' ? 'fa-solid fa-graduation-cap' : 'fa-solid fa-hand-holding-heart',
                            'badge_class' => $r->type === 'course' ? 'bg-primary text-white' : 'bg-success text-white',
                            'is_read' => $r->is_read,
                            'created_at' => $r->created_at,
                        ];
                    });
                }

                $view->with('unreadRequestsCount', $unreadRequestsCount);
                $view->with('unreadNotificationsCount', $totalUnreadCount);
                $view->with('recentAdminNotifications', $recentAdminNotifications);
                $view->with('recentNotifications', $recentAdminNotifications);
            } catch (\Throwable $e) {
                $view->with('unreadRequestsCount', 0);
                $view->with('unreadNotificationsCount', 0);
                $view->with('recentAdminNotifications', collect());
                $view->with('recentNotifications', collect());
            }
        });
    }
}

