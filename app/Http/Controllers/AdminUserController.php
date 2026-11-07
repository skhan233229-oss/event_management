<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // Show all users
    public function index(Request $request)
    {
        $query = User::latest();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    // Update user role
    public function updateRole(Request $request, User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own role.');
        }

        $validated = $request->validate([
            'role' => 'required|in:admin,user',
        ]);

        if (
            $user->role === 'admin' &&
            $validated['role'] === 'user' &&
            User::where('role', 'admin')->count() <= 1
        ) {
            return back()->with('error', 'The last Admin cannot be demoted.');
        }

        $user->update([
            'role' => $validated['role'],
        ]);

        return back()->with('success', 'User role updated successfully!');
    }

    // Delete user
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        if (
            $user->role === 'admin' &&
            User::where('role', 'admin')->count() <= 1
        ) {
            return back()->with('error', 'The last Admin cannot be deleted.');
        }

        $hasEvents = Event::where('created_by', $user->id)->exists();

        if ($hasEvents) {
            return back()->with(
                'error',
                'This user has created events. Delete or reassign those events first.'
            );
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully!');
    }
}