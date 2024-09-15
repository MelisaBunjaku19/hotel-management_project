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

        <!-- Sorting Form -->
        <form method="GET" action="{{ route('admin.show_blogs') }}" class="mb-3">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <select name="sort" class="form-control">
                        <option value="id" {{ $sortField === 'id' ? 'selected' : '' }}>ID</option>
                        <option value="title" {{ $sortField === 'title' ? 'selected' : '' }}>Title</option>
                    </select>
                </div>
                <div class="col-auto">
                    <select name="direction" class="form-control">
                        <option value="asc" {{ $sortDirection === 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ $sortDirection === 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Sort</button>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.show_blogs') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <section class="no-padding-bottom">
            <div class="row justify-content-center">
                <div class="col-md-12">
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
                                        <th>Category</th> <!-- New Column for Category -->
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
                                            <td>
                                                @if($blog->category)
                                                    {{ $blog->category->name }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if(is_string($blog->author))
                                                    {{ json_decode($blog->author)->name ?? 'N/A' }}
                                                @else
                                                    {{ $blog->author->name ?? 'N/A' }}
                                                @endif
                                            </td>
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

                            <!-- Pagination Links -->
                            <div class="pagination justify-content-center">
                                {{ $blogs->appends(['sort' => $sortField, 'direction' => $sortDirection])->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Inline styles -->
    <style>
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #fff;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: #fff;
        }

        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }

        /* Table styles */
        .table thead th {
            background-color: #343a40;
            color: #fff;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        /* Pagination styles */
        .pagination {
            margin: 20px 0;
        }

        .pagination .page-item {
            border: 1px solid #6c757d;
            border-radius: .25rem;
        }

        .pagination .page-link {
            color: #fff;
            background-color: #343a40;
            border-color: #6c757d;
        }

        .pagination .page-link:hover {
            color: #fff;
            background-color: #5a6268;
            border-color: #545b62;
        }

        .pagination .active .page-link {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</body>

</html>
