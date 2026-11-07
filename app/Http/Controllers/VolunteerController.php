<?php

namespace App\Http\Controllers;

use App\Models\VolunteerApplication;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class VolunteerController extends Controller
{
    public function create()
    {
        $userApplications = collect();
        if (Auth::check()) {
            $userApplications = VolunteerApplication::where('user_id', Auth::id())
                ->orWhere('email', Auth::user()->email)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('volunteer.register', compact('userApplications'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:150',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:40',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer|min:14|max:100',
            'nic_no' => 'required|string|max:40',
            'education_qualification' => 'required|string|max:255',
            'occupation' => 'required|string|max:150',
            'other_qualification' => 'nullable|string|max:2000',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'email' => 'nullable|email|max:150',
            'country' => 'nullable|string|max:100',
            'area_of_interest' => 'nullable|string|max:150',
            'availability' => 'nullable|string|max:100',
            'skills' => 'nullable|string|max:255',
            'introduction' => 'nullable|string|max:3000',
        ]);

        // Process Volunteer Photo upload
        if ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $uploadTargetDir = public_path('images/volunteers');
            if (!file_exists($uploadTargetDir)) {
                mkdir($uploadTargetDir, 0777, true);
            }
            $filename = 'vol_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadTargetDir, $filename);
            $validated['photo'] = 'images/volunteers/' . $filename;
        }

        $validated['user_id'] = Auth::id() ?? null;
        if (empty($validated['email']) && Auth::check()) {
            $validated['email'] = Auth::user()->email;
        }
        $validated['status'] = 'pending';

        $volunteer = VolunteerApplication::create($validated);

        // Notify Admin Portal
        try {
            if (class_exists(AdminNotification::class)) {
                AdminNotification::notify(
                    'volunteer_registered',
                    'New Volunteer Application: ' . $volunteer->full_name,
                    "{$volunteer->full_name} ({$volunteer->occupation}) registered as a volunteer with NIC {$volunteer->nic_no}.",
                    route('admin.volunteers.show', $volunteer->id),
                    'fa-solid fa-hand-holding-heart',
                    'bg-success-subtle text-success'
                );
            }
        } catch (\Throwable $e) {
            Log::error('AdminNotification error on volunteer register: ' . $e->getMessage());
        }

        return redirect()->route('volunteer.register')
            ->with('success', 'Your volunteer registration and profile photo have been submitted successfully! SDC volunteer coordination committee will review your application and contact you soon.');
    }
}
