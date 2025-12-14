<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display form to create new menu.
     */
    public function create()
    {
        return view('admin.create-votes');
    }

    /**
     * Store a newly created menu.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vote_start' => 'required|date|after_or_equal:today',
            'vote_end' => 'required|date|after:vote_start',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menus', 'public');
        }

        Menu::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
            'vote_start' => $validated['vote_start'],
            'vote_end' => $validated['vote_end'],
            'created_by' => Auth::id(),
            'is_active' => true,
        ]);

        return redirect()->route('admin.view-votes')
                         ->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Display all menus.
     */
    public function index()
    {
        $menus = Menu::with('creator')
                    ->withCount(['votes' => function($query) {
                        $query->where('is_current', true);
                    }])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view('admin.view-votes', compact('menus'));
    }

    /**
     * Show the form for editing the specified menu.
     */
    public function edit(Menu $menu)
    {
        return view('admin.edit-vote', compact('menu'));
    }

    /**
     * Update the specified menu.
     */
    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vote_start' => 'required|date',
            'vote_end' => 'required|date|after:vote_start',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($menu->image_path) {
                Storage::disk('public')->delete($menu->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($validated);

        return redirect()->route('admin.view-votes')
                         ->with('success', 'Menu berhasil diupdate!');
    }

    /**
     * Remove the specified menu.
     */
    public function destroy(Menu $menu)
    {
        // Delete image
        if ($menu->image_path) {
            Storage::disk('public')->delete($menu->image_path);
        }

        $menu->delete();

        return redirect()->route('admin.view-votes')
                         ->with('success', 'Menu berhasil dihapus!');
    }

    /**
     * Toggle menu active status.
     */
    public function toggleActive(Menu $menu)
    {
        $menu->update(['is_active' => !$menu->is_active]);

        $status = $menu->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()
                         ->with('success', "Menu berhasil {$status}!");
    }
}
