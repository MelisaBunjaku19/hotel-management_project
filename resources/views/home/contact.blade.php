<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us - HotelH</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="icon" href="{{ asset('images/your-icon.png') }}" type="image/png" />
    <style>
        body {
            background-color: #f5f5f5;
            color: #333;
            font-family: Arial, sans-serif;
        }

        .contact .titlepage h2 {
            font-size: 36px;
            color: #333;
            text-align: center;
            margin: 40px 0;
        }

        .contact .main_form {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .contact .main_form input,
        .contact .main_form textarea {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            width: 100%;
            background-color: #f9f9f9;
        }

        .contact .main_form input:focus,
        .contact .main_form textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        .contact .main_form button.send_btn {
            background-color: #ff5733;
            color: white;
            border-radius: 50px;
            padding: 12px 25px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }

        .contact .main_form button.send_btn:hover {
            background-color: #e94e3a;
            transform: scale(1.1);
        }

        .contact .main_form button.send_btn:active {
            background-color: #c70039;
        }

        .contact .map_main {
            margin-top: 20px;
        }

        .contact .map-responsive {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .notification {
            display: none;
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 15px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            font-size: 16px;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
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

<div class="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Contact Us</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form id="contact-form" class="main_form" method="POST" action="{{ route('contact.send') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <input class="contactus" placeholder="Name" type="text" name="name" required>
                        </div>
                        <div class="col-md-12">
                            <input class="contactus" placeholder="Email" type="email" name="email" required>
                        </div>
                        <div class="col-md-12">
                            <input class="contactus" placeholder="Phone Number" type="text" name="phone">
                        </div>
                        <div class="col-md-12">
                            <textarea class="textarea" placeholder="Message" name="message" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <button class="send_btn" type="submit">Send</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="map_main">
                    <div class="map-responsive">
                        <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Eiffel+Tower+Paris+France" width="600" height="400" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="notification" id="notification">
    Your message has been sent successfully!
</div>

@include('home.footer')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contact-form');
        const notification = document.getElementById('notification');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Show the notification
            notification.style.display = 'block';
            notification.style.opacity = 1;

            // Fade out notification after 3 seconds
            setTimeout(() => {
                notification.style.opacity = 0;
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 500); // Delay to allow fade-out effect
            }, 3000); // Adjust time as needed (in milliseconds)

            // Clear form fields (optional)
            form.reset();
        });
    });
</script>

</body>
</html>
