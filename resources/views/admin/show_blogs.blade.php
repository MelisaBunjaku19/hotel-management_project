<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Show Blogs - Dark Bootstrap Admin</title>
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
                <h2 class="h5 no-margin-bottom">Show Blogs</h2>
            </div>
        </div>

        <!-- Back to Dashboard Button -->
        <div class="text-center mb-3">
            <a href="{{ route('home') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        <section class="no-padding-bottom">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="block">
                        <div class="block-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogs as $blog)
                                        <tr>
                                            <td>{{ $blog->id }}</td>
                                            <td>{{ $blog->title }}</td>
                                            <td>{{ $blog->author }}</td>
                                            <td>
                                                @if($blog->created_at)
                                                    {{ $blog->created_at->format('d-m-Y') }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('home.blog_details', $blog->id) }}" class="btn btn-info btn-sm" style="margin-right: 5px;">View</a>
                                                    <a href="{{ route('admin.edit_blog', $blog->id) }}" class="btn btn-warning btn-sm" style="margin-right: 5px;">Edit</a>
                                                    <form action="{{ route('admin.delete_blog', $blog->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
    </style>
</body>

</html>
