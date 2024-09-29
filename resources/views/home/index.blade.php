<!DOCTYPE html>
<html lang="en">
<head>
  @include('home.css')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    /* General Styles */
    body {
      font-family: Arial, sans-serif;
      color: #f5f5f5; /* Light gray text for dark backgrounds */
      background: #333; /* Dark gray background for body */
      margin: 0;
      padding: 0;
    }

    /* Notification Styles */
    .notification {
      display: none;
      position: fixed;
      top: 10px;
      right: 10px;
      padding: 20px;
      background-color: #4CAF50;
      color: white;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      z-index: 1000;
      font-size: 16px;
    }
    .notification.error {
      background-color: #f44336;
    }

    /* Header Styles */
    .header {
      background: #333; /* Dark gray background */
      color:white; /* Light gray text */
      padding: 15px 0;
      border-bottom: 2px solid #444; /* Slightly lighter gray border */
    }

    /* Welcome Section Styles */
    .welcome-section {
      background: #333; /* Dark gray background */
      color: #f5f5f5; /* Light gray text */
      padding: 60px 0;
      border-bottom: 2px solid #444; /* Slightly lighter gray border for separation */
    }

    .welcome-section h1 {
      position: relative;
      font-size: 40px;
      color: #f5f5f5;
      line-height: 45px;
      font-weight: bold;
      text-transform: uppercase;
      padding: 0;
      margin: 35px 0;
    }

    .welcome-section h1::before {
      position: absolute;
      content: "";
 /* Medium gray for the pseudo-element */
      width: 20px;
      height: 4px;
      transform: rotate(-36deg);
      top: 0;
      left: 0;
    }

    .welcome-section p {
      font-size: 1.3rem;
      margin-bottom: 30px;
    }

    .welcome-section .btn-primary {
      background-color: #555; /* Medium gray */
      border-color: #555;
      color: #fff;
      padding: 12px 25px;
      border-radius: 30px;
      font-size: 14px;
      text-transform: uppercase;
      transition: background-color 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .welcome-section .btn-primary:hover {
      background-color: #333; /* Darker gray on hover */
    }

    /* Gallery Section Styles */
    .gallery {
      background: #333; /* Dark gray background */
      color: #f5f5f5; /* Light gray text */
      padding: 60px 0;
      border-bottom: 2px solid #444; /* Slightly lighter gray border */
    }

    .gallery h2 {
      font-size: 40px;
      color: #f5f5f5; /* Light gray */
      line-height: 45px;
      font-weight: bold;
      text-transform: uppercase;
      margin: 35px 0;
      padding: 0;
    }

    /* Testimonials Section Styles */
    .testimonials {
      background-color: #444; /* Slightly lighter dark gray */
      color: #f5f5f5; /* Light gray text */
      padding: 60px 0;
    }

    .testimonials h2 {
      font-size: 40px;
      color: #f5f5f5; /* Light gray */
      line-height: 45px;
      font-weight: bold;
      text-transform: uppercase;
      margin: 35px 0;
      position: relative;
      padding: 0;
    }

    .testimonial-item {
      background-color: #555; /* Medium gray */
      border: 1px solid #666; /* Slightly lighter gray */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      padding: 20px;
      border-radius: 10px;
    }

    .testimonial-item:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .carousel-inner {
      padding: 20px;
    }

    .carousel-control-prev,
    .carousel-control-next {
      width: 5%;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      background-color: rgba(0, 0, 0, 0.5);
      border-radius: 50%;
      width: 30px;
      height: 30px;
    }

    .carousel-control-prev-icon {
      background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"%3E%3Cpath d="M4.854 4.854a.5.5 0 0 0 0-.708L2.707 2.707a.5.5 0 0 0-.707.707L3.5 4l-1.5 1.5a.5.5 0 0 0 .707.707l1.5-1.5z" fill="%23fff"/%3E%3C/svg%3E');
    }

    .carousel-control-next-icon {
      background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8"%3E%3Cpath d="M3.146 3.146a.5.5 0 0 1 0 .708L1.293 5.293a.5.5 0 0 1-.707-.707L2.5 4l-1.5-1.5a.5.5 0 0 1 .707-.707l1.5 1.5z" fill="%23fff"/%3E%3C/svg%3E');
    }

    /* Footer Styles */
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

  <!-- Include the header only once -->
  @include('home.header')

  <!-- Welcome Section -->
  <section class="welcome-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Welcome to OnlineHotel</h1>
                <p>Your comfort is our priority. Explore our range of rooms and enjoy a luxurious stay. Whether you are here for business or leisure, our hotel offers the best amenities and services to ensure your stay is memorable.</p>
                <a href="/about" class="btn btn-primary">About Us</a>
            </div>
        </div>
    </div>
  </section>

  <!-- Gallery Section -->
  @include('home.gallery')

  <!-- Customer Testimonials -->
  <section class="testimonials">
    <div class="container">
      <h2 class="text-center mb-4">What Our Guests Say</h2>

      <!-- Testimonials Carousel -->
      <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="testimonial-item">
                  <blockquote>
                    <p>"Amazing stay! The service was top-notch and the room was beautiful. The staff went above and beyond to make our visit memorable."</p>
                    <footer>- John Doe</footer>
                  </blockquote>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="testimonial-item">
                  <blockquote>
                    <p>"I loved the view from my room. The amenities were excellent, and the location was perfect for exploring the city."</p>
                    <footer>- Jane Smith</footer>
                  </blockquote>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="testimonial-item">
                  <blockquote>
                    <p>"A fantastic experience from start to finish. The hotel is modern, clean, and comfortable. Highly recommend!"</p>
                    <footer>- Michael Brown</footer>
                  </blockquote>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#testimonialsCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#testimonialsCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </a>
      </div>
    </div>
  </section>
  <!-- Featured Rooms Section -->
<section class="featured-rooms">
  <div class="container">
    <h2 class="text-center mb-4">Featured Rooms</h2>
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="room-item">
          <img src="{{ asset('images/room5.jpg') }}" alt="Deluxe Room" class="img-fluid">
          <div class="room-info">
            <h3>Deluxe Room</h3>
            <p class="price">$150 per night</p>
            <p>Experience luxury with our deluxe rooms featuring modern amenities and a stunning view.</p>
            <a href="/rooms" class="btn btn-primary">View Our Rooms</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="room-item">
          <img src="{{ asset('images/room2.jpg') }}" alt="Suite Room" class="img-fluid">
          <div class="room-info">
            <h3>Suite Room</h3>
            <p class="price">$250 per night</p>
            <p>Our suite rooms offer ample space, premium furnishings, and the ultimate comfort for a relaxing stay.</p>
            <a href="/rooms" class="btn btn-primary">View Our Rooms</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="room-item">
          <img src="{{ asset('images/room3.jpg') }}" alt="Executive Room" class="img-fluid">
          <div class="room-info">
            <h3>Executive Room</h3>
            <p class="price">$200 per night</p>
            <p>Perfect for business travelers, our executive rooms are equipped with all the necessary amenities for a productive stay.</p>
            <a href="/rooms" class="btn btn-primary">View Our Rooms</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- Additional Carousel Section -->
<section class="featured-blogs text-center">
  <div class="container">
    <h2 class="text-center mb-4">Explore More</h2>
    <div class="row justify-content-center">
      <!-- Centered View Blogs -->
      <div class="col-md-6 mb-4">
        <div class="blog-item">
          <img src="{{ asset('images/blogimage.jpg') }}" alt="Read Blogs" class="img-fluid">
          <div class="blog-info">
            <h3>Read Our Latest Blogs</h3>
            <p>Stay updated with our latest blogs.</p>
            <a href="{{ route('blog.index') }}" class="btn btn-primary">View Blogs</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




<!-- Add this to the styles -->
<style>
  .featured-rooms {
    background: #444; /* Slightly lighter dark gray for better contrast */
    color: #f5f5f5; /* Light gray text */
    padding: 60px 0;
  }

  .featured-rooms h2 {
    font-size: 40px;
    color: #f5f5f5; /* Light gray */
    line-height: 45px;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 40px;
  }

  .room-item {
    background-color: #555; /* Medium gray background for room items */
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .room-item img {
    width: 100%;
    height: auto;
  }

  .room-info {
    padding: 20px;
    text-align: center;
  }

  .room-info h3 {
    font-size: 24px;
    color: #f5f5f5; /* Light gray */
    margin-bottom: 10px;
  }

  .room-info .price {
    font-size: 20px;
    color: #ff5733; /* Accent color for price */
    margin-bottom: 10px;
  }

  .room-info p {
    margin-bottom: 20px;
  }

  .room-info .btn-primary {
    background-color: #ff5733; /* Accent color */
    border-color: #ff5733;
    color: #fff;
    padding: 12px 25px;
    border-radius: 30px;
    font-size: 14px;
    text-transform: uppercase;
    transition: background-color 0.3s ease;
    text-decoration: none;
    display: inline-block;
  }

  .room-info .btn-primary:hover {
    background-color: #e94e3a; /* Darker accent color on hover */
  }
  .featured-blogs {
    background: #444; /* Slightly lighter dark gray for better contrast */
    color: #f5f5f5; /* Light gray text */
    padding: 60px 0;
  }

  .featured-blogs h2 {
    font-size: 40px;
    color: #f5f5f5; /* Light gray */
    line-height: 45px;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 40px;
  }

  .blog-item {
    background-color: #555; /* Medium gray background */
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .blog-item img {
    width: 100%;
    height: auto;
  }

  .blog-info {
    padding: 20px;
    text-align: center;
  }

  .blog-info h3 {
    font-size: 24px;
    color: #f5f5f5; /* Light gray */
    margin-bottom: 10px;
  }

  .blog-info p {
    margin-bottom: 20px;
  }

  .blog-info .btn-primary {
    background-color: #ff5733; /* Accent color */
    border-color: #ff5733;
    color: #fff;
    padding: 12px 25px;
    border-radius: 30px;
    font-size: 14px;
    text-transform: uppercase;
    transition: background-color 0.3s ease;
    text-decoration: none;
    display: inline-block;
  }

  .blog-info .btn-primary:hover {
    background-color: #e94e3a; /* Darker accent color on hover */
  }
</style>


  <!-- Footer -->
  @include('home.footer')

  @include('home.js')

  <!-- Notification Script -->
  <script>
    function showNotification(message, type = 'success') {
      const notification = document.createElement('div');
      notification.className = `notification ${type}`;
      notification.innerText = message;
      document.body.appendChild(notification);

      // Show notification
      notification.style.display = 'block';

      // Hide notification after 5 seconds
      setTimeout(() => {
        notification.style.display = 'none';
        document.body.removeChild(notification);
      }, 5000);
    }

    // Example of using the showNotification function
    // showNotification('This is a success message!');
    // showNotification('This is an error message!', 'error');
  </script>

</body>

</html>

