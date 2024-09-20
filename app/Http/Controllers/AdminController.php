<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AdminController extends Controller
{
    // Ensure that only authenticated users can access admin functions


    // Admin dashboard index
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Check user type
            $usertype = Auth::user()->usertype;

            if ($usertype === 'admin') {
                return view('admin.index'); // Redirects admin to their dashboard
            } else if ($usertype === 'user') {
                return view('home.index'); // Redirects users to the home page
            }

        return redirect()->route('login'); // Not authenticated, redirect to login
    }
    return redirect()->route('login'); // Redirects to login if not authenticated

} 

    // Home view for non-admin users
    public function home()
    {
        return view('home.index');
    }

    // Admin profile view
    public function profile()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('admin.profile', compact('user'));
    }

    // Update admin profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed', // Password confirmation validation
        ]);

        // Update profile details
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Check if the password field is filled before updating
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

    // Show the users list with optional role filtering and sorting
    public function showUsers(Request $request)
    {
        $roleFilter = $request->input('role', ''); // Optional filter by role
        $sortOrder = $request->input('sortOrder', 'asc'); // Default sort order

        $query = User::query();

        // Apply role filter if present
        if ($roleFilter) {
            $query->where('usertype', $roleFilter);
        }

        // Fetch and paginate users with sorting by name
        $users = $query->orderBy('name', $sortOrder)->paginate(10);

        return view('admin.show_users', compact('users'));
    }

    // Show form for adding a new user
    public function addUser()
    {
        return view('admin.add_user');
    }

    // Store a new user with validation
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'usertype' => 'required|string|in:admin,user',
            'full_phone_number' => 'required|string',
        ]);

        // Create and save new user
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'usertype' => $request->input('usertype'),
            'phone' => $request->input('full_phone_number'),
        ]);

        return redirect()->route('admin.show_users')->with('success', 'User added successfully.');
    }

    // Show form for editing a user
    public function editUser($id)
    {
        $user = User::findOrFail($id); // Find user by ID or fail
        return view('admin.edit_user', compact('user'));
    }

    // Update user details
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id); // Find user by ID

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed', // Optional password update
            'usertype' => 'required|string|in:admin,user',
        ]);

        // Update user details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->usertype = $request->input('usertype');

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('admin.show_users')->with('success', 'User updated successfully.');
    }

    // Confirm user deletion
    public function confirmDeleteUser($id)
    {
        $user = User::findOrFail($id); // Find user by ID
        return view('admin.confirm_delete_user', compact('user'));
    }

    // Delete user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id); // Find user by ID
        $user->delete(); // Delete the user

        return redirect()->route('admin.show_users')->with('success', 'User deleted successfully.');
    }
}  