<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeneficiaryController extends Controller
{
    public function index(Request $request)
    {
        $query = Beneficiary::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('application_ref', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('nic_or_id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $beneficiaries = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.beneficiaries.index', compact('beneficiaries'));
    }

    public function create()
    {
        return view('admin.beneficiaries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:150',
            'phone' => 'required|string|max:40',
            'email' => 'nullable|email|max:100',
            'nic_or_id' => 'nullable|string|max:50',
            'address' => 'required|string|max:300',
            'category' => 'required|string|max:100',
            'family_members_count' => 'required|integer|min:1',
            'monthly_income' => 'nullable|numeric|min:0',
            'assistance_requested' => 'required|string',
            'assigned_staff' => 'nullable|string|max:100',
            'review_notes' => 'nullable|string',
        ]);

        $validated['application_ref'] = 'SDC-BEN-' . date('Y') . '-' . strtoupper(Str::random(4));
        $validated['status'] = 'pending';

        Beneficiary::create($validated);

        return redirect()->route('admin.beneficiaries.index')
            ->with('success', "Beneficiary application {$validated['application_ref']} recorded successfully!");
    }

    public function show($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        return view('admin.beneficiaries.show', compact('beneficiary'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected,completed',
            'review_notes' => 'nullable|string',
            'assigned_staff' => 'nullable|string|max:100',
        ]);

        $beneficiary = Beneficiary::findOrFail($id);
        $beneficiary->update($validated);

        return back()->with('success', "Beneficiary record {$beneficiary->application_ref} updated successfully.");
    }
}
