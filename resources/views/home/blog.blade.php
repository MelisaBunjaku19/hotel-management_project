<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog - HotelH</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
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
        }
        .header {
      background: #333; /* Dark gray background */
      color:white; /* Light gray text */
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
    </style>
</head>
<body>

@include('home.header')

<div class="blog">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Blog</h2>
                    <p>Discover our latest updates and stories on hotel management, travel tips, and more.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="blog_card card">
                    <div class="blog_img card-img-top">
                    <img src="{{ asset('images/' . $blog->image) }}" alt="{{ $blog->title }}">
               
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text">{{ Str::limit($blog->content, 100) }}</p>
                        <a href="{{ route('home.blog_details', $blog->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@include('home.footer')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
