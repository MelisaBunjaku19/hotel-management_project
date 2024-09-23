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
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* Subtle text shadow */
    transition: color 0.3s ease, transform 0.3s ease; /* Smooth transition */
}

.about .titlepage h2:hover {
    color: #ff6f61; /* Change color on hover */
    transform: translateY(-5px); /* Slightly move up */
}

.about .titlepage p {
    font-size: 18px;
    color: #666; /* Softer text color */
    max-width: 800px;
    margin: 0 auto 30px; /* Centered text with margin */
    line-height: 1.8;
    transition: color 0.3s ease; /* Smooth transition */
}

.about .titlepage p:hover {
    color: #555; /* Darken color on hover */
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
    transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease; /* Smooth transition */
    margin-top: 20px;
}

.about .titlepage a:hover {
    background: linear-gradient(45deg, #d84a59, #ff6f61); /* Inverted gradient on hover */
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25); /* Darker shadow on hover */
    transform: translateY(-3px); /* Slightly move up on hover */
}

.about .about_img img {
    width: 100%;
    border-radius: 15px; /* Rounded corners */
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2); /* Soft shadow */
    margin-top: 30px;
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition */
}

.about .about_img img:hover {
    transform: scale(1.05); /* Zoom in on hover */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3); /* Deeper shadow on hover */
}

.about .more-info {
    display: none; /* Hidden by default */
    margin-top: 50px;
    padding: 20px;
}

.about .more-info .info-item {
    background-color: #fff; /* White background */
    border-radius: 20px; /* Rounded corners with larger radius */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Deeper shadow */
    padding: 30px;
    margin-bottom: 30px;
    text-align: left; /* Left-aligned text for readability */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition */
    position: relative; /* For pseudo-element positioning */
    overflow: hidden; /* Ensure rounded corners apply to content */
}

.about .more-info .info-item:hover {
    transform: translateY(-10px); /* Move up on hover */
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3); /* Darker shadow on hover */
}

.about .more-info .info-item::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.05)); /* Gradient overlay */
    opacity: 0.3;
    z-index: 1;
}

.about .more-info h3 {
    font-size: 26px;
    color: #212121; /* Dark text for titles */
    font-weight: 700;
    margin-bottom: 15px;
    font-family: 'Roboto', sans-serif; /* Better font for headers */
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle text shadow */
    transition: color 0.3s ease, transform 0.3s ease; /* Smooth transition */
}

.about .more-info h3:hover {
    color: #ff6f61; /* Change color on hover */
    transform: translateY(-3px); /* Slightly move up on hover */
}

.about .more-info p {
    font-size: 18px;
    color: #555; /* Softer text color */
    line-height: 1.7;
    font-family: 'Open Sans', sans-serif; /* Better font for paragraphs */
    margin-bottom: 20px;
}

.about .more-info a.btn-primary {
    background-color: #ff6f61; /* Primary button color */
    border-color: #ff6f61;
    color: #fff;
    padding: 12px 25px;
    border-radius: 30px;
    font-size: 14px;
    text-transform: uppercase;
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition */
    position: relative; /* For pseudo-element positioning */
    overflow: hidden; /* Ensure rounded corners apply to button */
}

.about .more-info a.btn-primary:hover {
    background-color: #d84a59; /* Darker color on hover */
    transform: scale(1.05); /* Slight zoom on hover */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Add shadow on hover */
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
/* FAQ section */
.faq {
        background: #fff; /* White background for FAQ section */
        padding: 40px 20px; /* Padding for the FAQ section */
        border-radius: 15px; /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow */
        margin-top: 50px;
    }

    .faq h2 {
        font-size: 36px;
        color: #ff6f61; /* Accent color for FAQ section */
        font-weight: 700;
        margin-bottom: 30px;
    }

    .faq-item {
        margin-bottom: 20px;
    }

    .faq-question {
        background: #f8f9fa; /* Light gray background */
        border: none;
        border-radius: 10px;
        color: #333; /* Dark text color */
        cursor: pointer;
        font-size: 18px;
        font-weight: 600;
        padding: 15px;
        width: 100%;
        text-align: left;
        transition: background 0.3s ease, color 0.3s ease;
    }

    .faq-question:hover {
        background: #ff6f61; /* Accent color on hover */
        color: #fff; /* White text on hover */
    }

    .faq-answer {
        display: none; /* Hidden by default */
        padding: 15px;
        background: #f1f1f1; /* Light background for answers */
        border-radius: 10px;
        font-size: 16px;
        line-height: 1.6;
    }

    .faq-answer p {
        margin: 0;
    }

    .header {
        background: #333; /* Dark gray background */
        color: white; /* Light gray text */
        padding: 15px 0;
        border-bottom: 2px solid #444; /* Slightly lighter gray border */
    }
    .flashcards {
    display: flex;
    justify-content: space-between;
    margin-top: 50px;
}

.flashcard {
    width: 320px; /* Increased width for a wider card */
    height: 400px; /* Increased height for a taller card */
    perspective: 1000px;
    margin: 0 10px; /* Side margin for spacing */
}

.flashcard-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.6s;
    transform-style: preserve-3d;
}

.flashcard:hover .flashcard-inner {
    transform: rotateY(180deg);
}

.flashcard-front, .flashcard-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 10px; /* Rounded corners */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Soft shadow */
    overflow: hidden; /* Ensure images fit nicely */
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 10px; /* Padding for text */
}

.flashcard-front {
    background-color: #fff; /* Front background color */
}

.flashcard-back {
    background-color: #f0f0f0; /* Back background color */
    transform: rotateY(180deg); /* Back is initially rotated */
    padding: 20px; /* Padding for better text spacing */
    display: flex;
    flex-direction: column; /* Stack text vertically */
}

.flashcard-image {
    width: 100%;
    height: 75%; /* Adjusted height for images to fit the new size */
    object-fit: cover; /* Ensures the image covers the area */
}

.flashcard-back h3 {
    margin: 0;
    font-size: 1.5rem; /* Larger heading font */
    font-weight: bold; /* Bold for emphasis */
}

.flashcard-back p {
    font-size: 1rem; /* Standard paragraph size */
    line-height: 1.5; /* Improved line spacing for readability */
    color: #555; /* Darker text color for contrast */
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
                    <p>OnlineHotel provides top-notch management systems that streamline operations and enhance guest experiences. Discover how our management system transforms hotel operations into a seamless and efficient process.</p>
                    <a class="read_more" href="javascript:void(0)" id="readMoreBtn">Read More</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about_img">
                    <img src="images/3026238.jpg" alt="Hotel Management System"/>
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
  

        </div>
    </div>
</div>
<div class="faq">
    <h2>Frequently Asked Questions</h2>
    <div class="faq-item">
        <button class="faq-question">What is OnlineHotel?</button>
        <div class="faq-answer">
            <p>OnlineHotel is a comprehensive platform designed to simplify hotel management, streamline booking processes, and enhance the overall guest experience. It offers features such as real-time availability, booking management, payment processing, and detailed reporting.</p>
        </div>
    </div>
    <div class="faq-item">
        <button class="faq-question">How do I get started with OnlineHotel?</button>
        <div class="faq-answer">
            <p>Getting started with OnlineHotel is easy! Sign up for an account, follow the setup guide to configure your hotel details, rooms, and pricing, and you're ready to start managing your bookings.</p>
        </div>
    </div>
    <div class="faq-item">
        <button class="faq-question">What features does OnlineHotel offer?</button>
        <div class="faq-answer">
            <p>OnlineHotel offers a range of features including real-time room availability, integrated booking system, payment processing, guest management, booking analytics, and customizable reports. It’s designed to meet the needs of hotels of all sizes.</p>
        </div>
    </div>
    <div class="faq-item">
        <button class="faq-question">Can I integrate OnlineHotel with my existing website?</button>
        <div class="faq-answer">
            <p>Yes, OnlineHotel can be integrated with your existing website through our API and widgets. This allows you to seamlessly incorporate our booking system into your site, providing a consistent experience for your guests.</p>
        </div>
    </div>
    <div class="faq-item">
        <button class="faq-question">How does OnlineHotel handle payment processing?</button>
        <div class="faq-answer">
            <p>OnlineHotel integrates with secure payment gateways like Stripe to handle payment processing. This ensures that transactions are secure and your guests can pay using a variety of methods, including credit cards and online payment systems.</p>
        </div>
    </div>
    <div class="faq-item">
        <button class="faq-question">What support options are available?</button>
        <div class="faq-answer">
            <p>We offer a range of support options including online documentation, video tutorials, and a dedicated support team available via email and live chat. Our goal is to ensure you have all the resources you need to succeed with OnlineHotel.</p>
        </div>
    </div>
    <div class="faq-item">
        <button class="faq-question">Is OnlineHotel suitable for small boutique hotels?</button>
        <div class="faq-answer">
            <p>Absolutely! OnlineHotel is designed to be flexible and scalable, making it suitable for small boutique hotels as well as large chains. It offers a range of features that can be tailored to fit the specific needs of your hotel.</p>
        </div>
    </div>
    <div class="faq-item">
        <button class="faq-question">How do I update my hotel information?</button>
        <div class="faq-answer">
            <p>Updating your hotel information is simple. Log in to your OnlineHotel account, navigate to the settings section, and make the necessary changes to your hotel details, room information, or pricing. Changes are updated in real-time.</p>
        </div>
    </div>
    <div class="faq-item">
        <button class="faq-question">Can I customize the booking experience for my guests?</button>
        <div class="faq-answer">
            <p>Yes, OnlineHotel allows you to customize the booking experience to match your hotel's branding. You can modify booking forms, confirmation messages, and more to ensure a seamless and personalized experience for your guests.</p>
        </div>
    </div>
    <div class="faq-item">
        <button class="faq-question">What is the pricing model for OnlineHotel?</button>
        <div class="faq-answer">
            <p>OnlineHotel offers a variety of pricing plans to suit different hotel sizes and needs. Our pricing is based on the features you choose and the size of your property. Contact our sales team for a detailed quote and to find the plan that best fits your needs.</p>
        </div>
    </div>
</div>

<div class="flashcards">
    <div class="flashcard">
        <div class="flashcard-inner">
            <div class="flashcard-front">
                <img src="/images/20945944.jpg" alt="Efficient Booking Management" class="flashcard-image">
            </div>
            <div class="flashcard-back">
           
                <p>Our system simplifies the booking process, ensuring that room reservations are handled with efficiency and accuracy.</p>
            </div>
        </div>
    </div>
    <div class="flashcard">
        <div class="flashcard-inner">
            <div class="flashcard-front">
                <img src="/images/3909116.jpg" alt="Comprehensive Guest Services" class="flashcard-image">
            </div>
            <div class="flashcard-back">
         
                <p>Enhance the guest experience with our comprehensive service management tools.</p>
            </div>
        </div>
    </div>
    <div class="flashcard">
        <div class="flashcard-inner">
            <div class="flashcard-front">
                <img src="/images/8608981.jpg" alt="Advanced Reporting" class="flashcard-image">
            </div>
            <div class="flashcard-back">
             
                <p>Get insights into bookings and guest preferences with our reporting tools.</p>
            </div>
        </div>
    </div>
</div>



<script> 
    const flashcards = document.querySelectorAll('.flashcard');

flashcards.forEach(card => {
    card.addEventListener('click', () => {
        card.querySelector('.flashcard-inner').classList.toggle('flipped');
    });
});

</script>

@include('home.footer')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const readMoreBtn = document.getElementById('readMoreBtn');
        const moreInfoSection = document.getElementById('moreInfoSection');
        const visitBlogBtn = document.querySelector('.info-item a.btn-primary');

        // Toggle more info section visibility
        readMoreBtn.addEventListener('click', function() {
            if (moreInfoSection.style.display === 'block') {
                moreInfoSection.style.display = 'none';
                readMoreBtn.textContent = 'Read More';
            } else {
                moreInfoSection.style.display = 'block';
                readMoreBtn.textContent = 'Read Less';
            }
        });

        // Handle the visit blog button click
        visitBlogBtn.addEventListener('click', function(event) {
            // Optional: Add any animations or conditions here before redirecting
            // For example, show a loading spinner or perform an AJAX request

            // Redirect to the blog index page
            window.location.href = "{{ route('blog.index') }}";
        });
    });
</script>

<script>

document.addEventListener('DOMContentLoaded', function() {
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const answer = this.nextElementSibling;
            if (answer.style.display === 'block') {
                answer.style.display = 'none';
            } else {
                answer.style.display = 'block';
            }
        });
    });
});

    </script>

</body>
</html>
