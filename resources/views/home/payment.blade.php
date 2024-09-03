<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm My Booking - HotelH</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="icon" href="{{ asset('images/your-icon.png') }}" type="image/png" />
    <style>
        /* Custom styles for the booking confirmation page */
        .titlepage {
            margin-top: 50px;
            text-align: center;
        }

        .titlepage h2 {
            font-size: 40px;
            color: black;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            border-radius: 15px 15px 0 0;
        }

        .card-body {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 0 0 15px 15px;
        }

        .card-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #333;
        }

        .card-text {
            font-size: 1rem;
            margin-bottom: 10px;
            color: #555;
        }

        .btn-primary {
            background-color: #343a40;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #212529;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 5px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            padding: 10px;
            background-color: #f8f9fa;
            color: #333;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        .btn-submit-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-submit-container button {
            width: 100%;
        }

        .footer {
            background: #333;
            color: #f5f5f5;
            padding: 40px 0;
            text-align: center;
            border-top: 2px solid #444;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="titlepage">
            <h2>Confirm Your Booking</h2>
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

        <form id="payment-form" action="{{ route('process.payment') }}" method="POST">
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
        var stripe = Stripe('pk_test_51PsAoEInW0Dbu067LIa7cmsL2f3lQiaSrSnHAznVS1sMIW3J3JWHW5yRYPCYuTFWeKs9gLs8E0qyIxF3PG0tgYCo00HGJ2PtGq');

        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();

            fetch('{{ route('create.checkout.session') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    room_id: document.querySelector('input[name="room_id"]').value,
                    arrival_date: document.querySelector('input[name="arrival_date"]').value,
                    departure_date: document.querySelector('input[name="departure_date"]').value
                }),
            })
            .then(response => response.json())
            .then(data => {
                return stripe.redirectToCheckout({ sessionId: data.id });
            })
            .then(result => {
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
