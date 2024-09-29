<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Details - OnlineHotel</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Blog Details Container */
        .blog-details {
            background-color: #f8f9fa; /* Light background color */
            padding: 40px 0;
        }

        /* Title Style */
        .blog-details .titlepage h2 {
            font-size: 32px;
            color: #111111;
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
        }

        /* Blog Box */
        .blog-details .blog_box {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px;
            margin-bottom: 30px;
        }

        /* Blog Image */
        .blog-details .blog_img img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Blog Content */
        .blog-details .blog_room {
            padding: 20px;
        }

        .blog-details .blog_room h3 {
            font-size: 24px;
            color: #111111;
            margin-bottom: 15px;
        }

        .blog-details .blog_room p {
            font-size: 16px;
            color: #666666;
            line-height: 1.6;
        }

        /* Category Label */
        .category-label {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            color: #fff; /* White text color */
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px; /* Add some space below */
        }

        .category-travel { background-color: #007bff; } /* Blue */
        .category-luxury { background-color: #28a745; } /* Green */
        .category-budget { background-color: #ffc107; } /* Yellow */
        .category-eco-friendly { background-color: #17a2b8; } /* Teal */
        .category-technology { background-color: #dc3545; } /* Red */
        .category-destinations { background-color: #6f42c1; } /* Purple */
        .category-tips { background-color: #fd7e14; } /* Orange */

        /* Comments Section */
        .blog-details .comments {
            margin-top: 20px;
        }

        .blog-details .comment {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .blog-details .comment p {
            margin: 0;
        }

        /* Like Section */
        .like-section .liked {
    color: red; /* Color when liked */
}

.like-section .like-text {
    margin-left: 5px;
}


        .like-section .like-count {
            margin-left: 10px;
            font-size: 18px;
            color: #666666;
        }

        /* Centered Text */
        .text-center {
            text-align: center;
        }

        /* Margin Top for Spacing */
        .mt-4 {
            margin-top: 1.5rem;
        }

        /* Button */
        .blog-details .btn-primary {
            background-color: #343a40; /* Dark background color */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .blog-details .btn-primary:hover {
            background-color: #495057; /* Darker color on hover */
        }
    </style>
</head>
<body>

   <!-- Blog Details -->
   <div class="blog-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Blog Details</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="blog_box">
                        <div class="blog_img">
                            <figure>
                                <img src="{{ asset('images/' . $blog->image) }}" alt="Blog Image"/>
                            </figure>
                        </div>
                        <div class="blog_room">
                            <h3>{{ $blog->title }}</h3>

                            <!-- Category Label -->
                            @if($blog->category)
                                <span class="category-label category-{{ strtolower(str_replace(' ', '-', $blog->category->name)) }}">
                                    {{ $blog->category->name }}
                                </span>
                            @endif

                            <p>{{ $blog->content }}</p>
                        </div>
                    </div>

                    <!-- Like Button -->
                 <!-- Like/Unlike Button -->
<div class="like-section">
    <button class="btn btn-primary like-button" data-id="{{ $blog->id }}">
        <i class="fas fa-heart {{ $blog->isLikedByUser() ? 'liked' : '' }}"></i> 
        <span class="like-text">{{ $blog->isLikedByUser() ? 'Unlike' : 'Like' }}</span>
    </button>
    <span class="like-count">{{ $blog->likes->count() }} Likes</span>
</div>


                    <!-- Comments Form -->
                    <form action="{{ route('blog.comment.store', $blog->id) }}" method="POST">
                        @csrf
                        <div class="form-group mt-4">
                            <label for="comment">Add a Comment</label>
                            <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </form>

                    <!-- Display Comments -->
                    <div class="comments mt-4">
                        <h4>Comments:</h4>
                        @foreach($blog->comments as $comment)
                            <div class="comment mb-3">
                                <p>{{ $comment->content }} - <em>by User {{ $comment->user->name }}</em></p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Back to Blog Button -->
            <div class="text-center mt-4">
                <a href="{{ route('blog.index') }}" class="btn btn-primary">Back to Blogs</a>
            </div>
        </div>
    </div>

    <!-- jQuery Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $('.like-button').on('click', function() {
        const blogId = $(this).data('id');

        $.ajax({
            url: `/blog/${blogId}/like`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Update like count
                $('.like-count').text(response.likes_count + ' Likes');

                // Toggle the like/unlike state
                if (response.liked) {
                    $('.like-button i').addClass('liked');
                    $('.like-button .like-text').text('Unlike');
                } else {
                    $('.like-button i').removeClass('liked');
                    $('.like-button .like-text').text('Like');
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
</script>



</body>
</html>