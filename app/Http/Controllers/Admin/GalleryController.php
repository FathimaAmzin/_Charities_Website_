<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $categories = GalleryImage::select('category')->distinct()->pluck('category');
        $query = GalleryImage::query();

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $images = $query->orderBy('order', 'asc')->orderBy('id', 'desc')->paginate(12)->withQueryString();

        return view('admin.gallery.index', compact('images', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:12288',
            'image_path' => 'nullable|string|max:1000',
            'order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image_file')) {
            $uploadTargetDir = public_path('images/gallery');
            if (!file_exists($uploadTargetDir)) {
                mkdir($uploadTargetDir, 0777, true);
            }
            $file = $request->file('image_file');
            $filename = 'gallery_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadTargetDir, $filename);
            $validated['image_path'] = 'images/gallery/' . $filename;
        }

        if (empty($validated['image_path'])) {
            return back()->withErrors(['image_file' => 'Please select a photo file from your device or provide an image link.'])->withInput();
        }

        $validated['order'] = $validated['order'] ?? 0;

        GalleryImage::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'] ?? null,
            'image_path' => $validated['image_path'],
            'order' => $validated['order'],
        ]);

        return back()->with('success', 'Photograph uploaded and added to public gallery successfully!');
    }

    public function destroy($id)
    {
        $image = GalleryImage::findOrFail($id);

        if (!empty($image->image_path) && !str_starts_with($image->image_path, 'http')) {
            $localFile = public_path($image->image_path);
            if (file_exists($localFile) && is_file($localFile)) {
                @unlink($localFile);
            }
        }

        $image->delete();

        return back()->with('success', 'Photo removed from gallery.');
    }
}
