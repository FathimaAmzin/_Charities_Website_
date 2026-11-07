<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    /**
     * Display a listing of team members.
     */
    public function index(Request $request)
    {
        $query = TeamMember::query();

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%")
                  ->orWhere('bio', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $members = $query->orderBy('order', 'asc')->orderBy('id', 'desc')->paginate(12)->withQueryString();
        
        $totalBoard = TeamMember::boardOfDirectors()->count();
        $totalExecutives = TeamMember::managingExecutives()->count();
        $totalMembers = TeamMember::count();

        return view('admin.teams.index', compact('members', 'totalBoard', 'totalExecutives', 'totalMembers'));
    }

    /**
     * Show the form for creating a new team member.
     */
    public function create()
    {
        return view('admin.teams.create');
    }

    /**
     * Store a newly created team member in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'role' => 'required|string|max:150',
            'category' => 'required|in:board_of_directors,managing_executives',
            'badge' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:150',
            'phone' => 'nullable|string|max:50',
            'linkedin' => 'nullable|url|max:255',
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['order'] = $validated['order'] ?? 0;
        $validated['badge'] = $validated['badge'] ?: ($validated['category'] === 'board_of_directors' ? 'Director of Board' : 'Executive Member');

        // Handle Image Upload
        if ($request->hasFile('image_file')) {
            $uploadTargetDir = public_path('images/team');
            if (!file_exists($uploadTargetDir)) {
                mkdir($uploadTargetDir, 0777, true);
            }

            $file = $request->file('image_file');
            $filename = 'team_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadTargetDir, $filename);
            $validated['image'] = 'images/team/' . $filename;
        }

        if (empty($validated['image'])) {
            $validated['image'] = 'images/team/mohammed-musthafa-azath-raheem.jpg';
        }

        TeamMember::create($validated);

        return redirect()->route('admin.teams.index')
            ->with('success', 'Team member added successfully!');
    }

    /**
     * Display the specified team member.
     */
    public function show($id)
    {
        $member = TeamMember::findOrFail($id);
        return view('admin.teams.show', compact('member'));
    }

    /**
     * Show the form for editing the specified team member.
     */
    public function edit($id)
    {
        $member = TeamMember::findOrFail($id);
        return view('admin.teams.edit', compact('member'));
    }

    /**
     * Update the specified team member in storage.
     */
    public function update(Request $request, $id)
    {
        $member = TeamMember::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'role' => 'required|string|max:150',
            'category' => 'required|in:board_of_directors,managing_executives',
            'badge' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:150',
            'phone' => 'nullable|string|max:50',
            'linkedin' => 'nullable|url|max:255',
            'order' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        if ($request->hasFile('image_file')) {
            $uploadTargetDir = public_path('images/team');
            if (!file_exists($uploadTargetDir)) {
                mkdir($uploadTargetDir, 0777, true);
            }

            $file = $request->file('image_file');
            $filename = 'team_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadTargetDir, $filename);
            $validated['image'] = 'images/team/' . $filename;
        }

        $member->update($validated);

        return redirect()->route('admin.teams.index')
            ->with('success', 'Team member updated successfully!');
    }

    /**
     * Remove the specified team member from storage.
     */
    public function destroy($id)
    {
        $member = TeamMember::findOrFail($id);
        $name = $member->name;
        $member->delete();

        return redirect()->route('admin.teams.index')
            ->with('success', "Team member '{$name}' deleted successfully!");
    }
}

