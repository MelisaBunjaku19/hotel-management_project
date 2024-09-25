@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-light">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">{{ $post->title }}</h2>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <small class="text-muted">Posted on {{ $post->created_at->format('F j, Y') }} 
                @if($post->author)
                    by {{ $post->author->name }} 
                @endif
                </small>
            </div>
            <p class="card-text">{{ $post->content }}</p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <div>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
            </div>
            <div>
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this post?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">

<!-- Custom Styles -->
<style>
    .card {
        border-radius: 1rem;
        overflow: hidden;
    }

    .card-header {
        border-bottom: 2px solid #0056b3;
    }

    .btn-warning {
        margin-left: 10px;
    }

    .btn-danger {
        margin-left: 10px;
    }

    .text-muted {
        font-size: 0.9rem;
    }

    .card-text {
        font-size: 1.1rem;
        line-height: 1.5;
        color: #333;
    }
</style>
@endsection
