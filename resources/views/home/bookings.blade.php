<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Bookings - HotelH</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="icon" href="{{ asset('images/your-icon.png') }}" type="image/png" />
    <style>
        /* Custom styles for the bookings page */
        .bookings .titlepage {
            margin-top: 50px; /* Adjust this value to move the title lower */
        }
        .bookings .titlepage h2 {
            font-size: 40px;
            color: black;
        }
        .bookings .card {
            border: none;
            border-radius: 15px;
        }
        .bookings .btn-primary {
            background-color: #343a40;
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
        .confirmed {
            background-color: #d4edda; /* Light green background */
            color: #155724; /* Dark green text */
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>

@include('home.header')

<div class="bookings">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>My Bookings</h2>
                    <p>Here you can view and manage all your bookings.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @if($bookings->isEmpty())
                <div class="col-md-12">
                    <p>You have no bookings.</p>
                </div>
            @else
                @foreach($bookings as $booking)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card">
                        <img src="{{ asset('images/' . $booking->room->image) }}" class="card-img-top" alt="{{ $booking->room->room_title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $booking->room->room_title }}</h5>
                            <p class="card-text"><strong>Arrival Date:</strong> {{ $booking->arrival_date }}</p>
                            <p class="card-text"><strong>Departure Date:</strong> {{ $booking->departure_date }}</p>
                            <p class="card-text"><strong>Amount Paid:</strong> ${{ number_format($booking->amount_paid, 2) }}</p>
                            <p class="card-text"><strong>Status:</strong> <span class="confirmed">Confirmed</span></p>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@include('home.footer')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
