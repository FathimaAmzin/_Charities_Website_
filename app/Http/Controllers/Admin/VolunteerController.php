<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VolunteerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VolunteerController extends Controller
{
    public function index(Request $request)
    {
        $query = VolunteerApplication::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('nic_no', 'like', "%{$search}%")
                  ->orWhere('occupation', 'like', "%{$search}%")
                  ->orWhere('education_qualification', 'like', "%{$search}%")
                  ->orWhere('skills', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('area')) {
            $query->where('area_of_interest', $request->input('area'));
        }

        $volunteers = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();

        return view('admin.volunteers.index', compact('volunteers'));
    }

    public function show($id)
    {
        $volunteer = VolunteerApplication::findOrFail($id);
        return view('admin.volunteers.show', compact('volunteer'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected',
        ]);

        $volunteer = VolunteerApplication::findOrFail($id);
        $volunteer->update(['status' => $validated['status']]);

        return back()->with('success', "Volunteer application for {$volunteer->full_name} status updated to " . ucfirst(str_replace('_', ' ', $validated['status'])) . ".");
    }

    public function destroy($id)
    {
        $volunteer = VolunteerApplication::findOrFail($id);

        // Delete photo if exists
        if ($volunteer->photo && !str_starts_with($volunteer->photo, 'http')) {
            $photoPath = public_path($volunteer->photo);
            if (File::exists($photoPath)) {
                File::delete($photoPath);
            }
        }

        $name = $volunteer->full_name;
        $volunteer->delete();

        return redirect()->route('admin.volunteers.index')
            ->with('success', "Volunteer record for '{$name}' has been permanently deleted.");
    }
}
