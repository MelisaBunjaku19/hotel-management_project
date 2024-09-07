<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success - HotelH</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>
<body>
    <div class="container">
        <div class="titlepage">
            <h2>Payment Successful!</h2>
            <p>Thank you for your booking. Your payment was successful.</p>
            <a href="{{ route('bookings.index') }}" class="btn btn-primary">View Your Booking</a>
        </div>
    </div>
</body>
</html>
