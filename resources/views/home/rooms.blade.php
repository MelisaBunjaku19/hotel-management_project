<!-- resources/views/home/rooms.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rooms - HotelH</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="icon" href="{{ asset('images/your-icon.png') }}" type="image/png">
    <style>
        body {
            background-color: #f7f7f7;
            color: #333;
            font-family: 'Poppins', sans-serif;
        }

        .rooms .titlepage h2 {
            font-size: 40px;
            color: #333;
            text-align: center;
            margin-bottom: 50px;
        }

        .rooms .titlepage p {
            text-align: center;
            color: #555;
        }

        .rooms {
            padding-top: 100px;
        }

        .room_card {
            background-color: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .room_card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .room_card .card-img-top {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .room_card:hover .card-img-top {
            transform: scale(1.05);
        }

        .room_card .card-body {
            color: #333;
            padding: 20px;
        }

        .room_card .card-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .room_card .card-text {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        .header {
            background: #333;
            color: #fff;
            padding: 15px 0;
            border-bottom: 2px solid #444;
        }

        .footer {
            background: #333;
            color: #f5f5f5;
            padding: 40px 0;
            text-align: center;
            border-top: 2px solid #444;
        }

        .btn-book-room {
            background-color: #28a745; /* Changed to a green color for "Available" */
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            text-align: center;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            border: none;
            text-decoration: none; /* Remove underline */
        }

        .btn-book-room:hover {
            background-color: #218838; /* Darker green on hover */
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
        }

        .badge-booked {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #dc3545; /* Red badge for booked rooms */
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
        }

        .badge-booked-user {
            background-color: #17a2b8; /* Blue badge for user's own bookings */
        }
    </style>
</head>
<body>

@include('home.header')

<div class="rooms">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Rooms</h2>
                    <p>Explore our selection of rooms and find the perfect stay for your needs.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($rooms as $room)
                <div class="col-md-4 mb-4">
                    <div class="room_card">
                        @if ($room->image)
                            <img src="{{ asset('images/' . $room->image) }}" class="card-img-top" alt="{{ $room->room_title }}">
                        @else
                            <img src="{{ asset('images/default-room.jpg') }}" class="card-img-top" alt="Default Room Image">
                        @endif

                        @if(in_array($room->id, $bookedRoomIds))
                            @if(in_array($room->id, $userBookedRoomIds))
                                <span class="badge-booked badge-booked-user">Booked by You</span>
                            @else
                                <span class="badge-booked">Booked</span>
                            @endif
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $room->room_title }}</h5>
                            <p class="card-text">{{ $room->description }}</p>
                            <p class="card-text"><strong>Price:</strong> ${{ number_format($room->price, 2) }}</p>
                            <p class="card-text"><strong>Type:</strong> {{ $room->room_type }}</p>
                            <p class="card-text"><strong>Wi-Fi:</strong> {{ $room->wifi ? 'Yes' : 'No' }}</p>
                            @if(in_array($room->id, $bookedRoomIds))
                                @if(in_array($room->id, $userBookedRoomIds))
                                    <!-- Optionally, allow users to manage their own bookings -->
                                    <a href="{{ route('bookings.index', $room->id) }}" class="btn btn-info w-100">Manage Booking</a>
                                @else
                                    <button class="btn btn-secondary w-100" disabled>Unavailable</button>
                                @endif
                            @else
                                <a href="{{ route('payment.page', $room->id) }}" class="btn-book-room">Book Now</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No available rooms at the moment. Please check back later.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

@include('home.footer')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<!-- FontAwesome for icons (optional) -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
</html>
