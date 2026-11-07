<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of services and courses.
     */
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $services = $query->orderBy('order', 'asc')->orderBy('id', 'desc')->paginate(12)->withQueryString();
        $totalServices = Service::where('type', 'service')->count();
        $totalCourses = Service::where('type', 'course')->count();

        return view('admin.services.index', compact('services', 'totalServices', 'totalCourses'));
    }

    /**
     * Show the form for creating a new service or course.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service or course in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_title' => 'nullable|string|max:100',
            'category' => 'required|string|max:150',
            'type' => 'required|in:service,course',
            'icon' => 'nullable|string|max:100',
            'accent_color' => 'nullable|string|max:30',
            'summary' => 'required|string|max:500',
            'description' => 'required|string',
            'impact' => 'nullable|string|max:150',
            'course_duration' => 'nullable|string|max:150',
            'course_level' => 'nullable|string|max:150',
            'highlights_input' => 'nullable|string',
            'support_details' => 'nullable|string',
            'request_details' => 'nullable|string',
            'provide_title' => 'nullable|string|max:255',
            'provide_details' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'order' => 'nullable|integer|min:0',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
            'support_image' => 'nullable|string',
            'support_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
            'request_image' => 'nullable|string',
            'request_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
            'provide_image' => 'nullable|string',
            'provide_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(100, 999);
        $validated['icon'] = $validated['icon'] ?: ($validated['type'] === 'course' ? 'fa-solid fa-graduation-cap' : 'fa-solid fa-hand-holding-heart');
        $validated['accent_color'] = $validated['accent_color'] ?: '#2563EB';
        $validated['order'] = $validated['order'] ?? 0;

        // Process Highlights from newline-separated string
        if ($request->filled('highlights_input')) {
            $lines = array_filter(array_map('trim', explode("\n", $request->input('highlights_input'))));
            $validated['highlights'] = array_values($lines);
        } else {
            $validated['highlights'] = [];
        }

        // Handle Image Uploads
        $uploadTargetDir = public_path('images/services');
        if (!file_exists($uploadTargetDir)) {
            mkdir($uploadTargetDir, 0777, true);
        }

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'srv_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadTargetDir, $filename);
            $validated['image'] = 'images/services/' . $filename;
        }

        if ($request->hasFile('support_image_file')) {
            $file = $request->file('support_image_file');
            $filename = 'support_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadTargetDir, $filename);
            $validated['support_image'] = 'images/services/' . $filename;
        }

        if ($request->hasFile('request_image_file')) {
            $file = $request->file('request_image_file');
            $filename = 'request_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadTargetDir, $filename);
            $validated['request_image'] = 'images/services/' . $filename;
        }

        if ($request->hasFile('provide_image_file')) {
            $file = $request->file('provide_image_file');
            $filename = 'provide_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadTargetDir, $filename);
            $validated['provide_image'] = 'images/services/' . $filename;
        }

        // Default fallbacks if images still null
        if (empty($validated['image'])) {
            $validated['image'] = 'images/services/education.jpg';
        }
        if (empty($validated['support_image'])) {
            $validated['support_image'] = $validated['image'];
        }
        if (empty($validated['request_image'])) {
            $validated['request_image'] = $validated['image'];
        }
        if (empty($validated['provide_image'])) {
            $validated['provide_image'] = $validated['image'];
        }

        // Process Gallery, Servicing Roles & Provide Servicing Cards
        $extra = $this->processGalleryAndRoles($request);
        $validated['gallery'] = $extra['gallery'];
        $validated['servicing_roles'] = $extra['servicing_roles'];
        $validated['servicing_cards'] = $this->processServicingCards($request);

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', ucfirst($validated['type']) . ' created successfully!');
    }

    /**
     * Display the specified service.
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_title' => 'nullable|string|max:100',
            'category' => 'required|string|max:150',
            'type' => 'required|in:service,course',
            'icon' => 'nullable|string|max:100',
            'accent_color' => 'nullable|string|max:30',
            'summary' => 'required|string|max:500',
            'description' => 'required|string',
            'impact' => 'nullable|string|max:150',
            'course_duration' => 'nullable|string|max:150',
            'course_level' => 'nullable|string|max:150',
            'highlights_input' => 'nullable|string',
            'support_details' => 'nullable|string',
            'request_details' => 'nullable|string',
            'provide_title' => 'nullable|string|max:255',
            'provide_details' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'order' => 'nullable|integer|min:0',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
            'support_image' => 'nullable|string',
            'support_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
            'request_image' => 'nullable|string',
            'request_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
            'provide_image' => 'nullable|string',
            'provide_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
        ]);

        if ($request->filled('highlights_input')) {
            $lines = array_filter(array_map('trim', explode("\n", $request->input('highlights_input'))));
            $validated['highlights'] = array_values($lines);
        }

        $uploadTargetDir = public_path('images/services');
        if (!file_exists($uploadTargetDir)) {
            mkdir($uploadTargetDir, 0777, true);
        }

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'srv_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadTargetDir, $filename);
            $validated['image'] = 'images/services/' . $filename;
        }

        if ($request->hasFile('support_image_file')) {
            $file = $request->file('support_image_file');
            $filename = 'support_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadTargetDir, $filename);
            $validated['support_image'] = 'images/services/' . $filename;
        }

        if ($request->hasFile('request_image_file')) {
            $file = $request->file('request_image_file');
            $filename = 'request_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadTargetDir, $filename);
            $validated['request_image'] = 'images/services/' . $filename;
        }

        if ($request->hasFile('provide_image_file')) {
            $file = $request->file('provide_image_file');
            $filename = 'provide_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadTargetDir, $filename);
            $validated['provide_image'] = 'images/services/' . $filename;
        }

        // Process Gallery & Servicing Roles from Admin Form
        $extra = $this->processGalleryAndRoles($request);
        if ($request->has('gallery_submitted')) {
            $validated['gallery'] = $extra['gallery'];
        }
        if ($request->has('roles_submitted')) {
            $validated['servicing_roles'] = $extra['servicing_roles'];
        }
        if ($request->has('cards_submitted')) {
            $validated['servicing_cards'] = $this->processServicingCards($request);
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', ucfirst($service->type) . ' updated successfully!');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $type = $service->type;
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', ucfirst($type) . ' deleted successfully!');
    }

    /**
     * Delete a specific gallery photo directly from the service.
     * This immediately updates the database and public website.
     */
    public function deleteGalleryPhoto(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $gallery = is_array($service->gallery) ? $service->gallery : [];

        $targetUrl = $request->input('url');
        $targetIndex = $request->input('index');

        $filteredGallery = [];
        $deleted = false;

        foreach ($gallery as $idx => $item) {
            // Match either by index or exact URL
            $matchedByIndex = ($targetIndex !== null && (int)$targetIndex === (int)$idx);
            $matchedByUrl = (!empty($targetUrl) && isset($item['url']) && $item['url'] === $targetUrl);

            if (!$deleted && ($matchedByIndex || $matchedByUrl)) {
                $deleted = true;
                // Delete physical uploaded file if unique to this upload
                if (!empty($item['url']) && str_starts_with($item['url'], 'images/services/gal_')) {
                    $filePath = public_path($item['url']);
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                    }
                }
                continue;
            }
            $filteredGallery[] = $item;
        }

        $service->update([
            'gallery' => array_values($filteredGallery)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Visual gallery photo deleted successfully from service and public website.',
            'remaining_count' => count($filteredGallery)
        ]);
    }

    /**
     * Process dynamic gallery photos and servicing roles submitted from Admin form.
     */
    protected function processGalleryAndRoles(Request $request): array
    {
        $gallery = [];
        $titles = $request->input('gallery_titles', []);
        $tags = $request->input('gallery_tags', []);
        $urls = $request->input('gallery_urls', []);
        $descs = $request->input('gallery_descs', []);
        $files = $request->file('gallery_files', []);

        $uploadTargetDir = public_path('images/services');
        if (!file_exists($uploadTargetDir)) {
            mkdir($uploadTargetDir, 0777, true);
        }

        $count = max(
            is_array($titles) ? count($titles) : 0,
            is_array($urls) ? count($urls) : 0,
            is_array($files) ? count($files) : 0
        );

        for ($i = 0; $i < $count; $i++) {
            $title = $titles[$i] ?? '';
            $tag = $tags[$i] ?? 'SDC Deliverable';
            $desc = $descs[$i] ?? '';
            $url = $urls[$i] ?? '';

            if (isset($files[$i]) && $files[$i]->isValid()) {
                $f = $files[$i];
                $fname = 'gal_' . time() . '_' . $i . '_' . Str::slug(pathinfo($f->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $f->getClientOriginalExtension();
                $f->move($uploadTargetDir, $fname);
                $url = 'images/services/' . $fname;
            }

            if (!empty($url) || !empty($title)) {
                $gallery[] = [
                    'url' => $url ?: 'images/services/education.jpg',
                    'title' => $title ?: 'Field Operation Photo',
                    'tag' => $tag ?: 'SDC Project',
                    'desc' => $desc,
                ];
            }
        }

        // Process Multiple Photos Uploaded Directly From Computer Files
        if ($request->hasFile('bulk_gallery_files')) {
            $bulkFiles = $request->file('bulk_gallery_files');
            if (is_array($bulkFiles)) {
                foreach ($bulkFiles as $bIdx => $bFile) {
                    if ($bFile instanceof \Illuminate\Http\UploadedFile && $bFile->isValid()) {
                        $bName = 'gal_' . time() . '_bulk_' . $bIdx . '_' . Str::slug(pathinfo($bFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $bFile->getClientOriginalExtension();
                        $bFile->move($uploadTargetDir, $bName);

                        $cleanTitle = ucwords(str_replace(['-', '_'], ' ', pathinfo($bFile->getClientOriginalName(), PATHINFO_FILENAME)));

                        $gallery[] = [
                            'url' => 'images/services/' . $bName,
                            'title' => $cleanTitle ?: 'Community Deliverable',
                            'tag' => 'Field Operation',
                            'desc' => 'SDC humanitarian field work record.',
                        ];
                    }
                }
            }
        }

        // Process Servicing Roles
        $servicingRoles = [];
        $roles = $request->input('roles_role', []);
        $rDescs = $request->input('roles_desc', []);

        if (is_array($roles)) {
            for ($j = 0; $j < count($roles); $j++) {
                $roleName = trim($roles[$j] ?? '');
                $roleDesc = trim($rDescs[$j] ?? '');

                if (!empty($roleName)) {
                    $servicingRoles[] = [
                        'role' => $roleName,
                        'desc' => $roleDesc,
                    ];
                }
            }
        }

        return [
            'gallery' => $gallery,
            'servicing_roles' => $servicingRoles,
        ];
    }

    /**
     * Process dynamic Provide Servicing Cards submitted from Admin form.
     */
    protected function processServicingCards(Request $request): array
    {
        $cards = [];
        $titles = $request->input('card_titles', []);
        $tags = $request->input('card_tags', []);
        $dates = $request->input('card_dates', []);
        $urls = $request->input('card_urls', []);
        $descs = $request->input('card_descs', []);
        $files = $request->file('card_files', []);

        $uploadTargetDir = public_path('images/services');
        if (!file_exists($uploadTargetDir)) {
            mkdir($uploadTargetDir, 0777, true);
        }

        $count = max(
            is_array($titles) ? count($titles) : 0,
            is_array($urls) ? count($urls) : 0,
            is_array($files) ? count($files) : 0,
            is_array($descs) ? count($descs) : 0
        );

        for ($i = 0; $i < $count; $i++) {
            $title = trim($titles[$i] ?? '');
            $tag = trim($tags[$i] ?? 'SERVICING');
            $date = trim($dates[$i] ?? date('Y-m-d'));
            $desc = trim($descs[$i] ?? '');
            $url = trim($urls[$i] ?? '');

            if (isset($files[$i]) && $files[$i] instanceof \Illuminate\Http\UploadedFile && $files[$i]->isValid()) {
                $f = $files[$i];
                $fname = 'card_' . time() . '_' . $i . '_' . Str::slug(pathinfo($f->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $f->getClientOriginalExtension();
                $f->move($uploadTargetDir, $fname);
                $url = 'images/services/' . $fname;
            }

            if (!empty($title) || !empty($url) || !empty($desc)) {
                $cards[] = [
                    'title' => $title ?: 'Community Servicing Initiative',
                    'desc'  => $desc ?: 'Volunteer or partner with SDC on this deliverable.',
                    'date'  => $date ?: date('Y-m-d'),
                    'tag'   => $tag ?: 'SERVICING',
                    'image' => $url ?: 'images/services/education.jpg',
                ];
            }
        }

        return $cards;
    }
}
