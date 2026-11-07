<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            $isPub = $request->input('status') === 'published';
            $query->where('is_published', $isPub);
        }

        $news = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:news,event',
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
            'location' => 'nullable|string|max:150',
            'image' => 'nullable|string',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['is_published'] ? ($validated['published_at'] ?? now()) : null;

        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'News article created successfully!');
    }

    public function edit($id)
    {
        $article = News::findOrFail($id);
        return view('admin.news.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = News::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:news,event',
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
            'location' => 'nullable|string|max:150',
            'image' => 'nullable|string',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        if ($validated['is_published'] && !$article->published_at) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'News article updated successfully!');
    }

    public function destroy($id)
    {
        $article = News::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'News article deleted successfully!');
    }
}
