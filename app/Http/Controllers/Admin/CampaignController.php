<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Campaign::with('category');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        $campaigns = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('admin.campaigns.index', compact('campaigns', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.campaigns.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'target_amount' => 'required|numeric|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,upcoming,completed',
            'image' => 'nullable|string',
            'featured' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);
        $validated['amount_raised'] = 0;
        $validated['donor_count'] = 0;
        $validated['featured'] = $request->boolean('featured');

        Campaign::create($validated);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign appeal created successfully!');
    }

    public function show($id)
    {
        $campaign = Campaign::with('category', 'donations')->findOrFail($id);
        return view('admin.campaigns.show', compact('campaign'));
    }

    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        $categories = Category::all();
        return view('admin.campaigns.edit', compact('campaign', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'target_amount' => 'required|numeric|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:active,upcoming,completed',
            'image' => 'nullable|string',
            'featured' => 'nullable|boolean',
        ]);

        $validated['featured'] = $request->boolean('featured');

        $campaign->update($validated);

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign updated successfully!');
    }

    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();

        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign deleted successfully!');
    }
}
