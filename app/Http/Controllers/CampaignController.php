<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $activeQuery = Campaign::with('category')->where('status', 'active');
        $upcomingQuery = Campaign::with('category')->where('status', 'upcoming');
        $completedQuery = Campaign::with('category')->where('status', 'completed');

        if ($request->filled('category')) {
            $catSlug = $request->input('category');
            $activeQuery->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
            $upcomingQuery->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
            $completedQuery->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $activeQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
            $upcomingQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
            $completedQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $activeCampaigns = $activeQuery->orderBy('featured', 'desc')->get();
        $upcomingCampaigns = $upcomingQuery->get();
        $completedCampaigns = $completedQuery->get();

        return view('campaigns.index', compact(
            'activeCampaigns',
            'upcomingCampaigns',
            'completedCampaigns',
            'categories'
        ));
    }

    public function show($slug)
    {
        $campaign = Campaign::with('category', 'donations')
            ->where('slug', $slug)
            ->firstOrFail();

        $recentDonations = $campaign->donations()
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('campaigns.show', compact('campaign', 'recentDonations'));
    }
}
