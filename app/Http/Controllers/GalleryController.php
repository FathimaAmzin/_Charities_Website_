<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $categories = GalleryImage::select('category')->distinct()->pluck('category');

        $query = GalleryImage::orderBy('order', 'asc')->orderBy('id', 'asc');

        if ($request->filled('category') && $request->input('category') !== 'all') {
            $query->where('category', $request->input('category'));
        }

        $images = $query->get();

        return view('gallery.index', compact('images', 'categories'));
    }
}
