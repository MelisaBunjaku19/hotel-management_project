<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - HotelH</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="icon" href="{{ asset('images/your-icon.png') }}" type="image/png" />
    <style>
        /* Modern and sleek styles for the About Us page */
        body {
            background-color: #f4f4f4; /* Light gray background */
            color: #333; /* Dark text color for contrast */
            font-family: 'Open Sans', sans-serif; /* Clean and modern font */
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .about {
            padding: 60px 20px; /* Responsive padding */
            text-align: center;
        }

        .about .titlepage h2 {
            font-size: 42px;
            color: #212121; /* Darker color for title */
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .about .titlepage p {
            font-size: 18px;
            color: #666; /* Softer text color */
            max-width: 800px;
            margin: 0 auto 30px; /* Centered text with margin */
            line-height: 1.8;
        }

        .about .titlepage a {
            display: inline-block;
            font-size: 16px;
            color: #fff; /* White text */
            background: linear-gradient(45deg, #ff6f61, #d84a59); /* Modern gradient background */
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 30px; /* Rounded button */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2); /* Soft shadow */
            transition: all 0.3s ease; /* Smooth transition */
            margin-top: 20px;
        }

        .about .titlepage a:hover {
            background: linear-gradient(45deg, #d84a59, #ff6f61); /* Reverse gradient on hover */
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25); /* Deeper shadow on hover */
            transform: translateY(-3px); /* Slight lift on hover */
        }

        .about .about_img img {
            width: 100%;
            border-radius: 15px; /* Rounded corners */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2); /* Soft shadow */
            margin-top: 30px;
        }

        .about .more-info {
            display: none; /* Hidden by default */
            margin-top: 50px;
            padding: 20px;
        }

        .about .more-info .info-item {
            background-color: #fff; /* White background */
            border-radius: 12px; /* Rounded corners */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); /* Soft shadow */
            padding: 30px;
            margin-bottom: 30px;
            text-align: left; /* Left-aligned text for readability */
        }

        .about .more-info h3 {
            font-size: 24px;
            color: #212121; /* Dark text for titles */
            font-weight: 600;
            margin-bottom: 15px;
        }

        .about .more-info p {
            font-size: 16px;
            color: #555; /* Softer text color */
            line-height: 1.7;
        }

        .about .more-info a.btn-primary {
            background-color: #ff6f61; /* Primary button color */
            border-color: #ff6f61;
            color: #fff;
            padding: 12px 25px;
            border-radius: 30px;
            font-size: 14px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }

        .about .more-info a.btn-primary:hover {
            background-color: #d84a59; /* Darker color on hover */
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

<div class="about">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="titlepage">
                    <h2>About OnlineHotel</h2>
                    <p>Hotel-H provides top-notch management systems that streamline operations and enhance guest experiences. Discover how our management system transforms hotel operations into a seamless and efficient process.</p>
                    <a class="read_more" href="javascript:void(0)" id="readMoreBtn">Read More</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about_img">
                    <img src="images/about.png" alt="Hotel Management System"/>
                </div>
            </div>
        </div>
        <div class="more-info" id="moreInfoSection">
            <div class="info-item">
                <h3>Efficient Booking Management</h3>
                <p>Our system simplifies the booking process, ensuring that room reservations are handled with efficiency and accuracy. With real-time updates and intuitive interfaces, managing bookings has never been easier.</p>
            </div>
            <div class="info-item">
                <h3>Comprehensive Guest Services</h3>
                <p>Enhance the guest experience with our comprehensive service management tools. From check-in to checkout, our system ensures that guests receive top-tier service, making their stay memorable and hassle-free.</p>
            </div>
            <div class="info-item">
                <h3>Advanced Reporting and Analytics</h3>
                <p>Gain valuable insights into your hotel’s operations with our advanced reporting and analytics features. Track performance metrics, analyze trends, and make data-driven decisions to optimize your hotel management.</p>
            </div>
            <div class="info-item">
                <h3>Explore Our Blog</h3>
                <p>Stay updated with the latest trends in hotel management, travel tips, and more by following our blog. Our experts share insights and advice to help you make the most of your hotel stay or business.</p>
                <a href="{{ route('blog.index') }}" class="btn btn-primary">Visit Our Blog</a>
            </div>
        </div>
    </div>
</div>

@include('home.footer')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const readMoreBtn = document.getElementById('readMoreBtn');
        const moreInfoSection = document.getElementById('moreInfoSection');

        readMoreBtn.addEventListener('click', function() {
            if (moreInfoSection.style.display === 'block') {
                moreInfoSection.style.display = 'none';
                readMoreBtn.textContent = 'Read More';
            } else {
                moreInfoSection.style.display = 'block';
                readMoreBtn.textContent = 'Read Less';
            }
        });
    });
</script>

</body>
</html>
