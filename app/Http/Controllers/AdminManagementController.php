<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminManagementController extends Controller
{
    /**
     * Display a listing of admins.
     */
    public function index()
    {
        $admins = User::where('role', 'admin')
                     ->latest()
                     ->paginate(10);

        $totalAdmins = User::where('role', 'admin')->count();
        $totalUsers = User::where('role', 'user')->count();

        return view('admin.admin-management', compact('admins', 'totalAdmins', 'totalUsers'));
    }

    /**
     * Show the form for creating a new admin.
     */
    public function create()
    {
        return view('admin.admin-create');
    }

    /**
     * Store a newly created admin in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.admin-management.index')
                        ->with('success', 'Admin berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified admin.
     */
    public function edit(User $admin)
    {
        // Ensure we're editing an admin
        if ($admin->role !== 'admin') {
            abort(403, 'User is not an admin.');
        }

        return view('admin.admin-edit', compact('admin'));
    }

    /**
     * Update the specified admin in storage.
     */
    public function update(Request $request, User $admin)
    {
        // Ensure we're updating an admin
        if ($admin->role !== 'admin') {
            abort(403, 'User is not an admin.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $admin->id],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if (!empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return redirect()->route('admin.admin-management.index')
                        ->with('success', 'Admin berhasil diperbarui!');
    }

    /**
     * Remove the specified admin from storage.
     */
    public function destroy(User $admin)
    {
        // Ensure we're deleting an admin
        if ($admin->role !== 'admin') {
            abort(403, 'User is not an admin.');
        }

        // Prevent deleting yourself
        if ($admin->id === auth()->id()) {
            return redirect()->route('admin.admin-management.index')
                           ->with('error', 'Anda tidak bisa menghapus akun Anda sendiri!');
        }

        // Check if there are other admins
        $adminCount = User::where('role', 'admin')->count();
        if ($adminCount <= 1) {
            return redirect()->route('admin.admin-management.index')
                           ->with('error', 'Tidak bisa menghapus admin terakhir!');
        }

        $admin->delete();

        return redirect()->route('admin.admin-management.index')
                        ->with('success', 'Admin berhasil dihapus!');
    }
}
