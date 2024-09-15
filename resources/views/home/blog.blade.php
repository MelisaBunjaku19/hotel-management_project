<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog - HotelH</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/your-icon.png') }}" type="image/png" />
    
    <style>
        /* Custom styles for the blog page */
        .blog .titlepage h2 {
            font-size: 40px;
            color: white;
        }
        .blog .card {
            border: none;
            border-radius: 15px;
        }
        .blog .btn-primary {
            background-color: #343a40;
            border-color: #343a40;
        }
        .blog .btn-primary:hover {
            background-color: #212529;
            border-color: #212529;
        }
        .header {
            background: #333; /* Dark gray background */
            color: white; /* Light gray text */
            padding: 15px 0;
            border-bottom: 2px solid #444; /* Slightly lighter gray border */
        }
        .footer {
            background: #333; /* Dark gray background */
            color: #f5f5f5; /* Light gray text */
            padding: 40px 0;
            text-align: center;
            border-top: 2px solid #444; /* Slightly lighter gray border */
        }
        .search-form {
            margin-bottom: 20px;
        }
        .search-form input[type="text"],
        .search-form select,
        .search-form input[type="date"] {
            border-radius: 0;
        }
        .search-form button {
            border-radius: 0;
            border-color: #343a40;
            background-color: #343a40;
            color: white;
        }
        .search-form button:hover {
            background-color: #212529;
            border-color: #212529;
        }
        .category-label {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            color: #fff; /* White text color */
            font-size: 14px;
            font-weight: bold;
        }

        .category-travel { background-color: #007bff; } /* Blue */
        .category-luxury { background-color: #28a745; } /* Green */
        .category-budget { background-color: #ffc107; } /* Yellow */
        .category-eco-friendly { background-color: #17a2b8; } /* Teal */
        .category-technology { background-color: #dc3545; } /* Red */
        .category-destinations { background-color: #6f42c1; } /* Purple */
        .category-tips { background-color: #fd7e14; } /* Orange */
    </style>
</head>
<body>

    <!-- Header -->
    @include('home.header')

    <!-- Blog Section -->
    <div class="blog">
        <div class="container">
            <!-- Search Form -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="search-form">
                        <form method="GET" action="{{ route('blog.index') }}">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="searchQuery" placeholder="Search blogs by title" value="{{ request()->input('searchQuery') }}">
                                <select class="form-control" name="category">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request()->input('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="titlepage text-center">
                        <h2>Blog</h2>
                        <p>Discover our latest updates and stories on hotel management, travel tips, and more.</p>
                    </div>
                </div>
            </div>

            <!-- Blog Posts -->
            <div class="row">
                @forelse($blogs as $blog)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="blog_card card h-100">
                            <div class="blog_img card-img-top">
                                <img src="{{ asset('images/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text">{{ Str::limit($blog->content, 100) }}</p>

                                <!-- Displaying the single category -->
                                @if($blog->category)
                                    <span class="category-label category-{{ strtolower(str_replace(' ', '-', $blog->category->name)) }}">
                                        {{ $blog->category->name }}
                                    </span>
                                @endif

                                <a href="{{ route('home.blog_details', $blog->id) }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <p>No blog posts found.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    <!-- Footer -->
    @include('home.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
