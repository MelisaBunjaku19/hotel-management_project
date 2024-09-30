<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog - OnlineHotel</title>
    
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
            display: flex;
            flex-direction: column;
            height: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease; /* Add hover effect */
        }
        .blog .card:hover {
            transform: translateY(-5px); /* Subtle lift on hover */
        }
        .blog .card-img-top {
            width: 100%;
            height: 200px; /* Set a fixed height for all images */
            object-fit: cover; /* Ensures the image fits and crops if necessary */
            object-position: center;
        }
        .blog .card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .blog .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .blog .category-label {
            display: inline-block;
            margin-bottom: 10px;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 11px; /* Smaller font size */
            color: #fff;
            font-weight: bold;
            margin-right: auto; /* Align to the left */
        }
        .blog .card-text {
            flex-grow: 1;
            font-size: 16px;
            color: #555;
            margin-bottom: 15px;
        }
        .blog .btn-primary {
            background-color: #343a40;
            border-color: #343a40;
            width: fit-content; /* Adjust button width */
            padding: 8px 20px; /* Add padding for the button */
            margin: 0 auto; /* Center button */
        }
        .blog .btn-primary:hover {
            background-color: #212529;
            border-color: #212529;
        }
        .header {
            background: #333;
            color: white;
            padding: 15px 0;
            border-bottom: 2px solid #444;
        }
        .footer {
            background: #333;
            color: #f5f5f5;
            padding: 40px 0;
            text-align: center;
            border-top: 2px solid #444;
        }
        .search-form {
            margin-bottom: 20px;
        }
        .search-form input[type="text"],
        .search-form select {
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

        /* Additional styles for pagination and category colors */
        .pagination {
            justify-content: center; /* Center pagination */
            margin: 20px 0; /* Margin above and below */
        }
        .pagination .page-item {
            margin: 0 2px; /* Reduced space between pagination items */
        }
        .pagination .page-link {
            padding: 5px 8px; /* Smaller padding */
            font-size: 12px; /* Smaller font size */
            border-radius: 5px; /* Rounded corners */
            background-color: #343a40; /* Background color for links */
            color: white; /* Text color */
        }
        .pagination .page-link:hover {
            background-color: #495057; /* Darker background on hover */
            color: white; /* Keep text color white on hover */
        }
        .pagination .page-item.active .page-link {
            background-color: #007bff; /* Active page background color */
            color: white; /* Active page text color */
            border: none; /* Remove border for active link */
        }
        .pagination .page-item.disabled .page-link {
            color: #6c757d; /* Disabled link color */
        }

        /* Colors for specific categories */
        .category-travel { background-color: #007bff; }
        .category-luxury { background-color: #28a745; }
        .category-budget { background-color: #ffc107; }
        .category-eco-friendly { background-color: #17a2b8; }
        .category-technology { background-color: #dc3545; }
        .category-destinations { background-color: #6f42c1; }
        .category-tips { background-color: #fd7e14; }
    </style>
</head>
<body>
    <!-- Header -->
    @include('home.header')

    <!-- Blog Section -->
    <div class="blog">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="search-form">
                        <form method="GET" action="{{ route('blog.index') }}">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="searchQuery" placeholder="Search blogs by title" value="{{ request()->input('searchQuery') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <select class="form-control" name="category">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request()->input('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <select class="form-control" name="sortBy">
                                    <option value="unordered" {{ request()->input('sortBy') == 'unordered' ? 'selected' : '' }}>Sort by: Unordered</option>
                                    <option value="created_at" {{ request()->input('sortBy') == 'created_at' ? 'selected' : '' }}>Sort by: Newest</option>
                                    <option value="oldest" {{ request()->input('sortBy') == 'oldest' ? 'selected' : '' }}>Sort by: Oldest</option>
                                    <option value="most_liked" {{ request()->input('sortBy') == 'most_liked' ? 'selected' : '' }}>Sort by: Most Liked</option>
                                </select>

                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Apply</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="titlepage text-center">
                <h2>Blog</h2>
                <p>Discover our latest updates and stories on hotel management, travel tips, and more.</p>
            </div>

            <!-- Blog Posts -->
            <div class="row">
                @forelse($blogs as $blog)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card blog_card">
                            <img src="{{ asset('images/' . $blog->image) }}" alt="{{ $blog->title }}" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                @if($blog->category)
                                    <span class="category-label category-{{ strtolower(str_replace(' ', '-', $blog->category->name)) }}">
                                        {{ $blog->category->name }}
                                    </span>
                                @endif
                                <p class="card-text">{{ Str::limit($blog->content, 100) }}</p>

                                <!-- Like Count -->
                                <div class="like-count">
                                    <i class="fas fa-heart" style="color: red; font-size: 20px;"></i>
                                    <span style="margin-left: 5px; font-size: 16px;">{{ $blog->likes()->count() }} Likes</span>
                                </div>

                                <a href="{{ route('home.blog_details', $blog->id) }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">No blogs found.</div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $blogs->links('pagination::bootstrap-4', ['prevText' => 'Previous', 'nextText' => 'Next']) }}
            </div>

        </div>
    </div>

    <!-- Footer -->
    @include('home.footer')

    <!-- JavaScript -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>