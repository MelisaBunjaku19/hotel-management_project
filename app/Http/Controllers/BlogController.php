<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Display all blogs with optional search and category filtering
    public function index(Request $request)
    {
        $searchQuery = $request->input('searchQuery');
        $category = $request->input('category');
        $sortBy = $request->input('sortBy');
    
        // Start building the query for blogs
        $query = Blog::with('category')
                    ->withCount('likes'); 
    
        // Search by title
        if ($searchQuery) {
            $query->where('title', 'like', '%' . $searchQuery . '%');
        }
    
        // Filter by category
        if ($category) {
            $query->where('category_id', $category);
        }
    
        // Sorting based on user input
        if ($sortBy == 'most_liked') {
            $query->orderBy('likes_count', 'desc');
        } elseif ($sortBy == 'created_at') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('id', 'asc'); // Default sort
        }
    
        // Get paginated results and append query parameters
        $blogs = $query->paginate(6)->appends([
            'searchQuery' => $searchQuery,
            'category' => $category,
            'sortBy' => $sortBy,
        ]);
    
        // Fetch all categories for the filter
        $categories = Category::all();
    
        return view('home.blog', compact('blogs', 'categories'));
    }
    
    

    public function toggleLike(Blog $blog)
    {
        $userId = auth()->user()->id;
    
        // Check if the user already liked the blog
        if ($blog->likes()->where('user_id', $userId)->exists()) {
            // If liked, unlike it
            $blog->likes()->detach($userId);
            $liked = false;
        } else {
            // If not liked, like it
            $blog->likes()->attach($userId);
            $liked = true;
        }
    
        return response()->json([
            'likes_count' => $blog->likes()->count(),
            'liked' => $liked,
        ]);
    }
    
    
    // Store a new comment for a specific blog post
    public function storeComment(Request $request, $blogId)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $blog = Blog::findOrFail($blogId);

        $comment = new Comment();
        $comment->content = $request->input('comment');
        $comment->blog_id = $blog->id;
        $comment->user_id = auth()->id(); // Assuming the user is logged in
        $comment->save();

        return redirect()->route('home.blog_details', $blog->id)->with('success', 'Comment added successfully!');
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('home.blog_details', compact('blog'));
    }

    // Show the admin panel for managing blogs
    public function showAdmin(Request $request)
    {
        $sortField = $request->input('sort', 'id'); // Default to sorting by ID
        $sortDirection = $request->input('direction', 'asc'); // Default to ascending order
        $categoryId = $request->input('category_id'); // Get the selected category ID
    
        // Validate sort field and direction
        $validSortFields = ['id', 'title', 'created_at'];
        if (!in_array($sortField, $validSortFields)) {
            $sortField = 'id'; // Default to ID if invalid field
        }
        if (!in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'asc'; // Default to ascending if invalid direction
        }
    
        // Fetch and sort blogs with pagination, filtered by category if provided
        $query = Blog::with('category'); // Eager load category
    
        if ($categoryId) {
            $query->where('category_id', $categoryId); // Filter by category
        }
    
        $blogs = $query->orderBy($sortField, $sortDirection)
                       ->paginate(10); // Adjust pagination size as needed
    
        // Get all categories for the filter dropdown
        $categories = Category::all();
    
        return view('admin.show_blogs', compact('blogs', 'sortField', 'sortDirection', 'categories'));
    }
    
    // Show the form to edit a blog post
    public function edit($id)
    {
        $blog = Blog::findOrFail($id); // Fetch the blog by ID or fail if not found
        $categories = Category::all(); // Fetch all categories for the dropdown
        return view('admin.edit_show', compact('blog', 'categories')); // Pass categories to the edit view
    }

    // Update a blog post
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate image file
            'excerpt' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id' // Validate category_id
        ]);

        // Find the blog post by ID
        $blog = Blog::findOrFail($id);

        // Update the blog post fields
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->excerpt = $request->input('excerpt');
        $blog->category_id = $request->input('category_id'); // Update the category_id

        // Check if a new image has been uploaded
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($blog->image && file_exists(public_path('images/' . $blog->image))) {
                unlink(public_path('images/' . $blog->image));
            }
            
            // Store new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $blog->image = $imageName;
        }

        // Save the updated blog post
        $blog->save();

        // Redirect back to the blog list with a success message
        return redirect()->route('admin.show_blogs')->with('success', 'Blog updated successfully.');
    }

    // Show the confirmation for deleting a blog post
    public function confirmDelete($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.delete_show', compact('blog'));
    }

    // Delete a blog post
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin.show_blogs')->with('success', 'Blog deleted successfully.');
    }

    // Show the form to create a new blog post
    public function create()
    {
        $categories = Category::all(); // Fetch all categories for the dropdown
        return view('admin.add_blog', compact('categories')); // Pass categories to the create view
    }

    // Store a new blog post
  // Store a new blog post
public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'content' => 'required|string',
        'excerpt' => 'required|string',
        'category_id' => 'required|exists:categories,id' // Validate category_id
    ]);

    // Create a new blog instance
    $blog = new Blog();
    $blog->title = $request->input('title');
    $blog->content = $request->input('content');
    $blog->excerpt = $request->input('excerpt');
    $blog->category_id = $request->input('category_id'); // Set the category_id

    // Set the user_id to the currently logged-in user's ID
    $blog->user_id = auth()->id(); // Set user_id

    // Handle the image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $filename);
        $blog->image = $filename;
    }

    // Save the blog
    $blog->save();

    return redirect()->route('admin.show_blogs')->with('success', 'Blog created successfully!');
}

}
