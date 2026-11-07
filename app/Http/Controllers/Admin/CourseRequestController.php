<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\RequestDecisionMail;
use App\Models\AdminNotification;
use App\Models\CourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CourseRequestController extends Controller
{
    /**
     * Display a listing of course and service requests.
     */
    public function index(Request $request)
    {
        $query = CourseRequest::query()->with(['user', 'service'])->latest();

        // Filter by Type (course / service)
        if ($request->filled('type') && in_array($request->type, ['course', 'service'])) {
            $query->where('type', $request->type);
        }

        // Filter by Status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search Keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('course_title', 'like', "%{$search}%")
                  ->orWhere('district', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        $requests = $query->paginate(15)->withQueryString();

        // Statistics Cards
        $totalCount = CourseRequest::count();
        $pendingCount = CourseRequest::where('status', 'pending')->count();
        $approvedCount = CourseRequest::where('status', 'approved')->count();
        $contactedCount = CourseRequest::where('status', 'contacted')->count();
        $courseCount = CourseRequest::where('type', 'course')->count();
        $serviceCount = CourseRequest::where('type', 'service')->count();

        return view('admin.requests.index', compact(
            'requests',
            'totalCount',
            'pendingCount',
            'approvedCount',
            'contactedCount',
            'courseCount',
            'serviceCount'
        ));
    }

    /**
     * Display the specified request details (and mark as read).
     */
    public function show($id)
    {
        $item = CourseRequest::with(['user', 'service'])->findOrFail($id);

        if (!$item->is_read) {
            $item->update(['is_read' => true]);
        }

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $item,
            ]);
        }

        return view('admin.requests.show', compact('item'));
    }

    /**
     * Update the status and internal admin notes of a request, and dispatch email notification.
     */
    public function updateStatus(Request $request, $id)
    {
        $item = CourseRequest::with('user')->findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,contacted,approved,completed,rejected',
            'admin_notes' => 'nullable|string|max:2000',
            'send_email' => 'nullable|boolean',
        ]);

        $item->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'] ?? $item->admin_notes,
            'is_read' => true,
        ]);

        // Dispatch decision email to the applicant if approved or rejected
        $recipientEmail = $item->email ?: ($item->user ? $item->user->email : null);
        $emailSent = false;
        $shouldSendEmail = $request->input('send_email', true);

        if ($shouldSendEmail && !empty($recipientEmail) && in_array($validated['status'], ['approved', 'rejected'])) {
            try {
                Mail::to($recipientEmail)->send(new RequestDecisionMail($item, $validated['status'], $item->admin_notes));
                $emailSent = true;
            } catch (\Throwable $e) {
                Log::error('Failed to send decision email to ' . $recipientEmail . ': ' . $e->getMessage());
            }
        }

        $emailMsg = '';
        if ($emailSent) {
            $emailMsg = ' An official decision email was dispatched to ' . $recipientEmail . '.';
        } elseif (!empty($recipientEmail) && in_array($validated['status'], ['approved', 'rejected'])) {
            $emailMsg = ' (Note: Email was logged or queued for ' . $recipientEmail . ').';
        } elseif (in_array($validated['status'], ['approved', 'rejected'])) {
            $emailMsg = ' (Note: Candidate provided no email; please contact via phone/WhatsApp: ' . $item->phone . ').';
        }

        return back()->with('success', 'Application for "' . $item->course_title . '" updated to ' . ucfirst($item->status) . '!' . $emailMsg);
    }

    /**
     * Quick 1-click decision (Approve or Reject) directly from table or modal.
     */
    public function quickDecision(Request $request, $id, $decision)
    {
        if (!in_array($decision, ['approved', 'rejected'])) {
            abort(400, 'Invalid decision action.');
        }

        $item = CourseRequest::with('user')->findOrFail($id);
        $notes = $request->input('admin_notes', $item->admin_notes);

        $item->update([
            'status' => $decision,
            'admin_notes' => $notes,
            'is_read' => true,
        ]);

        // Dispatch decision email to the applicant
        $recipientEmail = $item->email ?: ($item->user ? $item->user->email : null);
        $emailSent = false;

        if (!empty($recipientEmail)) {
            try {
                Mail::to($recipientEmail)->send(new RequestDecisionMail($item, $decision, $notes));
                $emailSent = true;
            } catch (\Throwable $e) {
                Log::error('Quick decision email failed for ' . $recipientEmail . ': ' . $e->getMessage());
            }
        }

        $decisionLabel = $decision === 'approved' ? 'Approved & Admitted' : 'Rejected';
        $emailMsg = $emailSent ? " Decision email sent to {$recipientEmail}." : (!empty($recipientEmail) ? " Email logged for {$recipientEmail}." : " No email on file; please phone {$item->phone}.");

        return back()->with('success', "Application from {$item->full_name} ({$item->course_title}) marked as {$decisionLabel}!{$emailMsg}");
    }

    /**
     * Mark all requests & notifications as read.
     */
    public function markAllAsRead()
    {
        CourseRequest::where('is_read', false)->update(['is_read' => true]);
        AdminNotification::where('is_read', false)->update(['is_read' => true]);

        return back()->with('success', 'All notifications and requests marked as read.');
    }

    /**
     * Remove the specified request from storage.
     */
    public function destroy($id)
    {
        $item = CourseRequest::findOrFail($id);
        $title = $item->course_title;
        $name = $item->full_name;
        $item->delete();

        return back()->with('success', 'Application from ' . $name . ' (' . $title . ') removed successfully.');
    }
}


