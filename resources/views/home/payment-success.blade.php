<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success - HotelH</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <style>
        body {
            background-color: #f5f5f5;
            color: #333;
            font-family: 'Poppins', sans-serif;
        }
        .titlepage {
            text-align: center;
            margin-top: 50px;
        }
        .titlepage h2 {
            font-size: 36px;
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
        .btn-primary {
            background-color: #ff6f61;
            border: none;
            padding: 12px 30px;
            border-radius: 30px;
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }
        .btn-primary:hover {
            background-color: #e65b53;
        }
        .card {
            margin: 20px auto;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .card-img-top {
            height: 240px;
            object-fit: cover;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }
        .card-text {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="titlepage">
            <h2>Payment Successful!</h2>
            <p>Thank you for your booking. Your payment was successful.</p>
            
            <!-- Display Room Details -->
            <div class="card">
                <img src="{{ asset('images/' . $room->image) }}" class="card-img-top" alt="{{ $room->room_title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->room_title }}</h5>
                    <p class="card-text"><strong>Description:</strong> {{ $room->description }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ number_format($room->price, 2) }}</p>
                    <p class="card-text"><strong>Arrival Date:</strong> {{ $arrivalDate }}</p>
                    <p class="card-text"><strong>Departure Date:</strong> {{ $departureDate }}</p>
                    <p class="card-text"><strong>Amount Paid:</strong> ${{ number_format($amountPaid, 2) }}</p>
                </div>
            </div>

            <a href="{{ route('bookings.index') }}" class="btn btn-primary">View Your Booking</a>
        </div>
    </div>
</body>
</html>
