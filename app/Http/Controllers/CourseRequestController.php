<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\CourseRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CourseRequestController extends Controller
{
    /**
     * Store a newly created course enrollment request or service assistance request.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_title' => 'required|string|max:255',
            'service_id' => 'nullable|integer',
            'type' => 'nullable|string|in:course,service',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:40',
            'email' => 'nullable|email|max:255',
            'nic' => 'nullable|string|max:50',
            'district' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'education_level' => 'nullable|string|max:100',
            'preferred_schedule' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:3000',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['type'] = $validated['type'] ?? 'course';
        $validated['status'] = 'pending';
        $validated['is_read'] = false;

        $courseRequest = CourseRequest::create($validated);

        // Notify Administrator of new application/request
        try {
            $isCourse = $courseRequest->type === 'course';
            AdminNotification::notify(
                type: $isCourse ? 'course_request' : 'service_request',
                title: $isCourse ? 'New Course Enrollment' : 'New Service Request',
                message: "{$courseRequest->full_name} applied for {$courseRequest->course_title} ({$courseRequest->district}).",
                link: route('admin.requests.index', ['search' => $courseRequest->phone ?: $courseRequest->full_name]),
                icon: $isCourse ? 'fa-solid fa-graduation-cap' : 'fa-solid fa-hand-holding-heart',
                badgeClass: $isCourse ? 'bg-primary text-white' : 'bg-success text-white',
                data: ['request_id' => $courseRequest->id, 'phone' => $courseRequest->phone, 'course' => $courseRequest->course_title]
            );
        } catch (\Throwable $e) {
            Log::error('AdminNotification error on course request: ' . $e->getMessage());
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Your application for "' . $courseRequest->course_title . '" has been submitted successfully! Our team will contact you shortly.',
                'data' => $courseRequest,
            ]);
        }

        $typeLabel = $validated['type'] === 'course' ? 'course enrollment application' : 'assistance request';

        return back()->with('success', 'Your ' . $typeLabel . ' for "' . $courseRequest->course_title . '" has been received successfully! Our coordinators will contact you soon.');
    }
}

