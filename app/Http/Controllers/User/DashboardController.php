<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CourseRequest;
use App\Models\Donation;
use App\Models\VolunteerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class DashboardController extends Controller
{
    /**
     * Display the authenticated user's personal dashboard.
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Fetch user's course & humanitarian service requests
        $courseRequests = CourseRequest::with('service')
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id);
                if (!empty($user->email)) {
                    $query->orWhere('email', $user->email);
                }
            })
            ->latest()
            ->get();

        // Fetch user's donations
        $donations = Donation::with(['project', 'campaign'])
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id);
                if (!empty($user->email)) {
                    $query->orWhere('email', $user->email);
                }
            })
            ->latest()
            ->get();

        // Fetch user's volunteer applications
        $volunteers = VolunteerApplication::where(function ($query) use ($user) {
                $query->where('user_id', $user->id);
                if (!empty($user->email)) {
                    $query->orWhere('email', $user->email);
                }
            })
            ->latest()
            ->get();

        // Compute metrics
        $metrics = [
            'total_requests'     => $courseRequests->count(),
            'approved_requests'  => $courseRequests->where('status', 'approved')->count(),
            'pending_requests'   => $courseRequests->where('status', 'pending')->count(),
            'rejected_requests'  => $courseRequests->where('status', 'rejected')->count(),
            'total_donations'    => $donations->sum('amount'),
            'donations_count'    => $donations->count(),
            'volunteer_count'    => $volunteers->count(),
        ];

        $activeTab = $request->query('tab', 'overview');

        return view('user.dashboard', compact('user', 'courseRequests', 'donations', 'volunteers', 'metrics', 'activeTab'));
    }

    /**
     * Update user profile information.
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name'     => 'required|string|max:150',
            'phone'    => 'nullable|string|max:40',
            'country'  => 'nullable|string|max:100',
            'address'  => 'nullable|string|max:255',
            'bio'      => 'nullable|string|max:1000',
        ]);

        $user->update($validated);

        return redirect()->route('user.dashboard', ['tab' => 'profile'])
            ->with('success', 'Your profile information has been updated successfully!');
    }

    /**
     * Update user password from dashboard.
     */
    public function updatePassword(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'string', 'confirmed', Password::min(8)],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('user.dashboard', ['tab' => 'security'])
            ->with('success', 'Your password has been changed successfully!');
    }
}

