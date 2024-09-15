<?php
// TaskController.php

// TaskController.php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Show all tasks
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        $tasks = Task::when($status !== 'all', function ($query) use ($status) {
            return $query->where('status', $status);
        })->get();
        
        return view('admin.tasks', compact('tasks'));
    }

    // Show the create task form
    public function create()
    {
        return view('admin.create');
    }

    // Store a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        Task::create([
            'title' => $request->input('title'),
            'status' => $request->input('status'),
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.tasks')->with('success', 'Task created successfully.');
    }
}
