@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Posts</h1>

    <!-- Create Post Button -->
    <div class="mb-4">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Create New Post</a>
    </div>

    <!-- Search Form -->
    <div class="mb-4">
        <form method="GET" action="{{ route('posts.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search posts..." value="{{ request()->get('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <!-- Posts Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td class="text-center">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm delete-post" data-id="{{ $post->id }}">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            {{ $noPostsFound ? 'No posts found for your search.' : 'No posts available.' }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $posts->links() }} <!-- This will generate the pagination links -->
    </div>

    <!-- Alert Box -->
    <div id="alert" class="alert mt-3 d-none"></div>
</div>

<script>
    document.querySelectorAll('.delete-post').forEach(button => {
        button.addEventListener('click', function() {
            const postId = this.dataset.id;

            if (confirm('Are you sure you want to delete this post?')) {
                fetch(`/posts/${postId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const alertBox = document.getElementById('alert');
                    if (data.success) {
                        alertBox.className = 'alert alert-success';
                        alertBox.textContent = 'Post deleted successfully!';
                        alertBox.classList.remove('d-none');
                        setTimeout(() => location.reload(), 2000); // Reload after 2 seconds
                    } else {
                        alertBox.className = 'alert alert-danger';
                        alertBox.textContent = data.error || 'An error occurred while deleting the post.';
                        alertBox.classList.remove('d-none');
                    }
                })
                .catch(error => {
                    const alertBox = document.getElementById('alert');
                    alertBox.className = 'alert alert-danger';
                    alertBox.textContent = 'An error occurred. Please try again later.';
                    alertBox.classList.remove('d-none');
                });
            }
        });
    });
</script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
@endsection
