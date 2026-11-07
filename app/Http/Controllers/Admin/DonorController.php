<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'donor')->with('donations');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $donors = $query->paginate(10)->withQueryString();

        return view('admin.donors.index', compact('donors'));
    }

    public function show($id)
    {
        $donor = User::with('donations.campaign', 'donations.project')->findOrFail($id);
        $totalContributed = $donor->donations()->where('status', 'completed')->sum('amount');
        return view('admin.donors.show', compact('donor', 'totalContributed'));
    }
}
