<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Booking Confirmation</h1>
    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
    <p>Your booking has been confirmed. Here are the details:</p>
    <ul>
        <li>Arrival Date: {{ $booking->arrival_date }}</li>
        <li>Departure Date: {{ $booking->departure_date }}</li>
        <li>Booking ID: {{ $booking->id }}</li>
    </ul>
    <a href="{{ route('home') }}">Return to Home</a>
</body>
</html>
