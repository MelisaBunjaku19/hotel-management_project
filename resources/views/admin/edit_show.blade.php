<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Blog Post - Dark Bootstrap Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/font-awesome/css/font-awesome.min.css') }}">

    <!-- Custom Font Icons CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">

    <!-- Google Fonts - Muli -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">

    <!-- Theme Stylesheet -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.default.css') }}" id="theme-stylesheet">

    <!-- Custom Stylesheet - for your changes -->
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/img/favicon.ico') }}">
</head>
<body style="background-color: #121417; color: #ccc;">
    <div class="container" style="padding: 30px 0;">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Edit Blog Post</h2>
            </div>
        </div>

        <!-- Back to Blog List Button -->
        <div class="text-center mb-3">
            <a href="{{ route('admin.show_blogs') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back to Blog List
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="block">
                    <div class="block-body">
                        <!-- Form for editing blog post -->
                        <form action="{{ route('admin.update_blog', $blog->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Validation Errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Title Field -->
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
                            </div>

                            <!-- Excerpt Field -->
                            <div class="form-group">
                                <label for="excerpt">Excerpt</label>
                                <textarea id="excerpt" name="excerpt" class="form-control" rows="3" required>{{ old('excerpt', $blog->excerpt) }}</textarea>
                            </div>

                            <!-- Content Field -->
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea id="content" name="content" class="form-control" rows="5" required>{{ old('content', $blog->content) }}</textarea>
                            </div>

                            <!-- Category Field -->
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select id="category_id" name="category_id" class="form-control" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == old('category_id', $blog->category_id) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Current Image Display -->
                            @if ($blog->image)
                                <div class="form-group">
                                    <label>Current Image</label>
                                    <div>
                                        <img src="{{ asset('images/' . $blog->image) }}" alt="Blog Image" class="img-fluid" style="max-width: 200px;">
                                    </div>
                                </div>
                            @endif

                            <!-- Image Upload Field -->
                            <div class="form-group">
                                <label for="image">Change Blog Image (Optional)</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/jpeg,image/png,image/jpg">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inline styles (unchanged) -->
    <style>
        /* Button styles */
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</body>
</html>
