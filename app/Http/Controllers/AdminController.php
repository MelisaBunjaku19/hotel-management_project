<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Add this for request validation
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype === 'admin') {
                return view('admin.index'); // Redirects admin to their dashboard
            } else if ($usertype === 'user') {
                return view('home.index'); // Redirects users to the home page
            } else {
                return redirect()->route('login'); // Redirects to login if usertype is not recognized
            }
        }

        return redirect()->route('login'); // Redirects to login if not authenticated
    }

    public function home()
    {
        return view('home.index');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

    public function showUsers(Request $request)
    {
        // Fetch the role filter and sort order from the request
        $roleFilter = $request->input('role', '');
        $sortOrder = $request->input('sortOrder', 'asc'); // Default to ascending
    
        // Query to filter users by role and sort by username
        $query = User::query();
    
        if ($roleFilter) {
            $query->where('usertype', $roleFilter);
        }
    
        $users = $query->orderBy('name', $sortOrder)->paginate(10); // Pagination with 10 users per page
    
        return view('admin.show_users', compact('users'));
    }
    

    // Show form to add a new user
    public function addUser()
    {
        return view('admin.add_user');
    }

    // Store a new user
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'usertype' => 'required|string|in:admin,user'
        ]);
    
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'usertype' => $request->input('usertype'),
        ]);
    
        return redirect()->route('admin.show_users')->with('success', 'User added successfully.');
    }
    
    // Update user details
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }
    
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect()->route('admin.show_users')->with('success', 'User updated successfully');
    }
    

    // Confirm deletion of a user
    public function confirmDeleteUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.confirm_delete_user', compact('user'));
    }

    // Delete a user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.show_users')->with('success', 'User deleted successfully.');
    }
}
