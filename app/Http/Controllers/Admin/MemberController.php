<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = MemberApplication::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('nic_no', 'like', "%{$search}%")
                  ->orWhere('membership_type', 'like', "%{$search}%")
                  ->orWhere('occupation', 'like', "%{$search}%")
                  ->orWhere('education_qualification', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('category')) {
            $query->where('membership_type', $request->input('category'));
        }

        $members = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();

        return view('admin.members.index', compact('members'));
    }

    public function show($id)
    {
        $member = MemberApplication::findOrFail($id);
        return view('admin.members.show', compact('member'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected',
        ]);

        $member = MemberApplication::findOrFail($id);
        $member->update(['status' => $validated['status']]);

        return back()->with('success', "Membership status for {$member->full_name} updated to " . ucfirst(str_replace('_', ' ', $validated['status'])) . ".");
    }

    public function destroy($id)
    {
        $member = MemberApplication::findOrFail($id);

        // Delete photo if local
        if ($member->photo && !str_starts_with($member->photo, 'http')) {
            $photoPath = public_path($member->photo);
            if (File::exists($photoPath)) {
                File::delete($photoPath);
            }
        }

        $name = $member->full_name;
        $member->delete();

        return redirect()->route('admin.members.index')
            ->with('success', "Member application record for '{$name}' has been permanently deleted.");
    }
}

