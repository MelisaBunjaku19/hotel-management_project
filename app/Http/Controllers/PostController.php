<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Display all posts
    public function index(Request $request)
    {
        $query = Post::query();
    
        // Check for a search term and apply the filter
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }
    
        // Get the posts, optionally paginated
        $posts = $query->paginate(10); // Adjust the number to change the number of items per page
    
        // Check if no posts are found
        $noPostsFound = $posts->isEmpty() && $request->has('search');
    
        return view('posts.index', compact('posts', 'noPostsFound'));
    }
    
    
    
    // Show the form for creating a new post
    public function create()
    {
        return view('posts.create'); // Create this Blade view
    }

    // Store a newly created post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create($request->only(['title', 'content'])); // Use only necessary fields

        // Redirect to the newly created post or the index
        return redirect()->route('posts.show', $post->id)->with('message', 'Post created successfully.');
    }

    // Show the specified post
    public function show(Post $post)
    {
        return view('posts.show', compact('post')); // Use 'show' view to display the post
    }

    // Show the form for editing the specified post
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post')); // Use 'edit' view to show the form
    }

    // Update the specified post
  // Update the specified post
  public function update(Request $request, $id)
  {
      $post = Post::findOrFail($id);
      $post->update($request->all());
  
      return response()->json([
          'success' => true,
          'message' => 'Post updated successfully!',
          'redirect' => route('posts.index'), // This can be adjusted based on your needs
      ]);
  }
  

    // Remove the specified post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully!',
        ]);
    }
    
}
