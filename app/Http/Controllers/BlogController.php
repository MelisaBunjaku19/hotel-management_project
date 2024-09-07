<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\ElasticsearchService;

class BlogController extends Controller
{
    protected $elasticsearch;

    public function __construct(ElasticsearchService $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

  
    
        public function index()
        {
            $searchQuery = request()->input('searchQuery', '');
    
            if ($searchQuery) {
                // Perform the search query
                $results = $this->elasticsearch->search('blogs', $searchQuery);
                $blogs = collect($results['hits']['hits'])->map(function ($hit) {
                    return $hit['_source'];
                });
            } else {
                $blogs = Blog::all();
            }
    
            return view('home.blog', compact('blogs'));
        }
    
    
    
    // Show the details of a single blog post
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('home.blog_details', compact('blog'));
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

    public function showAdmin()
    {
        $blogs = Blog::all(); // Fetch all blog posts for admin
        return view('admin.show_blogs', compact('blogs'));
    }

    // Show the form to edit a blog post
    public function edit($id)
    {
        $blog = Blog::findOrFail($id); // Fetch the blog by ID or fail if not found
        return view('admin.edit_show', compact('blog')); // Return the edit view with the blog data
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validate image file
            'excerpt' => 'required|string|max:255',
        ]);

        // Find the blog post by ID
        $blog = Blog::findOrFail($id);

        // Update the blog post fields
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->excerpt = $request->input('excerpt');

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

    public function create()
    {
        return view('admin.add_blog'); // Make sure this view file exists
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'content' => 'required|string',
            'excerpt' => 'required|string',
        ]);

        // Create a new blog instance
        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->excerpt = $request->input('excerpt');

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
