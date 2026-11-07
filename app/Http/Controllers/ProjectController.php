<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Project::with('category');

        if ($request->filled('category')) {
            $categorySlug = $request->input('category');
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $projects = $query->orderBy('featured', 'desc')
                          ->orderBy('id', 'desc')
                          ->paginate(9)
                          ->withQueryString();

        return view('projects.index', compact('projects', 'categories'));
    }

    public function show($slug)
    {
        $project = Project::with('category', 'donations')
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProjects = Project::where('category_id', $project->category_id)
            ->where('id', '!=', $project->id)
            ->take(3)
            ->get();

        return view('projects.show', compact('project', 'relatedProjects'));
    }
}
