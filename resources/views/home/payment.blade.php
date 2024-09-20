<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm My Booking - HotelH</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap & Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="icon" href="{{ asset('images/your-icon.png') }}" type="image/png" />
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        body {
            background-color: #f5f5f5;
            color: #333;
            font-family: 'Poppins', sans-serif;
        }
        .container {
            max-width: 800px;
            margin-top: 40px;
            padding: 20px;
        }
        .titlepage {
            text-align: center;
            margin-bottom: 40px;
        }
        .titlepage h2 {
            font-size: 32px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }
        .titlepage p {
            font-size: 18px;
            color: #666;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }
        .titlepage a {
            display: inline-block;
            font-size: 16px;
            color: #fff;
            background: linear-gradient(45deg, #ff6f61, #d84a59);
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 30px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-top: 20px;
        }
        .titlepage a:hover {
            background: linear-gradient(45deg, #d84a59, #ff6f61);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            background-color: #fff;
            overflow: hidden;
        }
        .card-img-top {
            height: 250px;
            object-fit: cover;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }
        .card-text {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ccc;
            box-shadow: none;
            padding: 10px 15px;
            font-size: 16px;
        }
        .btn-submit-container {
            text-align: center;
            margin-top: 30px;
        }
        .btn-primary {
            background-color: #ff6f61;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #e65b53;
        }
        .btn-primary:disabled {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="titlepage">
            <h2>Confirm Your Booking</h2>
            <p>Review your selected room and confirm your booking details below. We’re excited to have you stay with us!</p>
        </div>

        <div class="card mb-4">
            <img src="{{ asset('images/' . $room->image) }}" class="card-img-top" alt="{{ $room->room_title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $room->room_title }}</h5>
                <p class="card-text"><strong>Description:</strong> {{ $room->description }}</p>
                <p class="card-text"><strong>Price:</strong> ${{ number_format($room->price, 2) }}</p>
                <p class="card-text"><strong>Wi-Fi:</strong> {{ $room->wifi }}</p>
                <p class="card-text"><strong>Room Type:</strong> {{ $room->room_type }}</p>
            </div>
        </div>

        <form id="payment-form">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            <div class="form-group">
                <label for="arrival_date">Arrival Date:</label>
                <input type="date" class="form-control" id="arrival_date" name="arrival_date" required>
            </div>
            <div class="form-group">
                <label for="departure_date">Departure Date:</label>
                <input type="date" class="form-control" id="departure_date" name="departure_date" required>
            </div>
            <div class="btn-submit-container">
                <button type="submit" class="btn btn-primary">Confirm and Pay</button>
            </div>
        </form>
    </div>

    @include('home.footer')

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('pk_test_51PsAoEInW0Dbu067ayd1POjtVJcOYZutsLJxMaT8j497hwHR1kIA82yZ8kWSU5n8witREQkW9x2cRBwzZGa0Y46400IGcJLwjj');

        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();

            var arrivalDate = document.getElementById('arrival_date').value;
            var departureDate = document.getElementById('departure_date').value;
            var submitButton = document.querySelector('.btn-primary');
            submitButton.disabled = true;

            if (new Date(departureDate) < new Date(arrivalDate)) {
                alert('Departure date must be after or equal to arrival date.');
                submitButton.disabled = false;
                return;
            }

            fetch('{{ route('create.checkout.session') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    room_id: document.querySelector('input[name="room_id"]').value,
                    arrival_date: arrivalDate,
                    departure_date: departureDate
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Server error:', data.error);
                    alert('Error: ' + data.error);
                    submitButton.disabled = false;
                } else if (data.id) {
                    return stripe.redirectToCheckout({ sessionId: data.id });
                } else {
                    throw new Error('Invalid session ID.');
                }
            })
            .then(result => {
                if (result.error) {
                    alert(result.error.message);
                    submitButton.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error processing your payment.');
                submitButton.disabled = false;
            });
        });
    </script>
</body>
</html>
