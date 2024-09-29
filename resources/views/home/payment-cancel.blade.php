<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Canceled - OnlineHotel</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>
<body>
    <div class="container">
        <div class="titlepage">
            <h2>Payment Canceled</h2>
            <p>{{ $message }}</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Try Booking Again</a>
        </div>
    </div>
</body>
</html>
