<?php

namespace App\Http\Controllers;

use App\Models\MemberApplication;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function create()
    {
        $userApplications = collect();
        if (Auth::check()) {
            $userApplications = MemberApplication::where('user_id', Auth::id())
                ->orWhere('email', Auth::user()->email)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('member.register', compact('userApplications'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:150',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:40',
            'email' => 'nullable|email|max:150',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer|min:16|max:100',
            'nic_no' => 'required|string|max:40',
            'membership_type' => 'required|string|max:100',
            'education_qualification' => 'required|string|max:255',
            'occupation' => 'required|string|max:150',
            'other_qualification' => 'nullable|string|max:2000',
            'statement' => 'nullable|string|max:3000',
            'photo_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Process Member Photo upload
        if ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $uploadTargetDir = public_path('images/members');
            if (!file_exists($uploadTargetDir)) {
                mkdir($uploadTargetDir, 0777, true);
            }
            $filename = 'mbr_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadTargetDir, $filename);
            $validated['photo'] = 'images/members/' . $filename;
        }

        $validated['user_id'] = Auth::id() ?? null;
        if (empty($validated['email']) && Auth::check()) {
            $validated['email'] = Auth::user()->email;
        }
        $validated['status'] = 'pending';

        $member = MemberApplication::create($validated);

        // Notify Admin Portal
        try {
            if (class_exists(AdminNotification::class)) {
                AdminNotification::notify(
                    'member_registered',
                    'New Member Application: ' . $member->full_name,
                    "{$member->full_name} ({$member->membership_type} • {$member->occupation}) submitted an SDC membership registration with NIC {$member->nic_no}.",
                    route('admin.members.show', $member->id),
                    'fa-solid fa-users',
                    'bg-success-subtle text-success'
                );
            }
        } catch (\Throwable $e) {
            Log::error('AdminNotification error on member register: ' . $e->getMessage());
        }

        return redirect()->route('member.register')
            ->with('success', 'Your SDC Membership Application has been submitted successfully! The executive council committee will review your credentials and issue your official Member Identification.');
    }
}

