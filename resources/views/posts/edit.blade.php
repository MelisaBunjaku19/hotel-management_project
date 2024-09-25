@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Post</h1>

    <form id="edit-post-form" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
            <div class="invalid-feedback">
                Please provide a title.
            </div>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $post->content }}</textarea>
            <div class="invalid-feedback">
                Please provide content for the post.
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

    <div id="alert" class="alert mt-3 d-none"></div>
</div>

<script>
    // Bootstrap validation styling
    (() => {
        'use strict';

        const forms = document.querySelectorAll('.needs-validation');

        Array.prototype.slice.call(forms).forEach((form) => {
            form.addEventListener('submit', (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();

    // JavaScript form handling with Fetch API
    document.getElementById('edit-post-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        const formData = new FormData(this);
        const alertBox = document.getElementById('alert');

        fetch(`/posts/{{ $post->id }}`, {
            method: 'POST', // Use POST method since PUT is overridden
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-HTTP-Method-Override': 'PUT' // Override to trigger PUT request in Laravel
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alertBox.className = 'alert alert-success';
                alertBox.textContent = data.message;
                alertBox.classList.remove('d-none');

                // Redirect to the posts index after success
                setTimeout(() => {
                    window.location.href = data.redirect || '{{ route("posts.index") }}'; // Default redirect if none provided
                }, 2000);
            } else {
                alertBox.className = 'alert alert-danger';
                alertBox.textContent = data.error || 'An error occurred while updating the post.';
                alertBox.classList.remove('d-none');
            }
        })
        .catch(error => {
            alertBox.className = 'alert alert-danger';
            alertBox.textContent = 'An error occurred. Please try again later.';
            alertBox.classList.remove('d-none');
        });
    });
</script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5hb5g+6l5+4+L9E9kA9kGYBhb5ucFtbmeoxM7g" crossorigin="anonymous">
@endsection
