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
        }

        .room_card .btn-primary {
            background-color: #d9534f;
            border: none;
        }

        .room_card .btn-primary:hover {
            background-color: #c9302c;
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
    background-color: #d9534f; /* Primary button color */
    color: #fff; /* Ensure text stays white */
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
    background-color: #c9302c; /* Darker shade for hover */
    box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    color: #fff; /* Keep text white on hover */
}

.btn-book-room:active {
    background-color: #b52d29; /* Slightly darker on click */
    box-shadow: inset 0px 4px 8px rgba(0, 0, 0, 0.1);
    color: #fff; /* Keep text white */
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
                        <div class="card-body">
                            <h5 class="card-title">{{ $room->room_title }}</h5>
                            <p class="card-text">{{ $room->description }}</p>
                            <p class="card-text">Price: ${{ $room->price }}</p>
                            <p class="card-text">Type: {{ $room->room_type }}</p>
                            <p class="card-text">Wi-Fi: {{ $room->wifi ? 'Yes' : 'No' }}</p>
                            <a href="{{ route('payment.page', $room->id) }}" class="btn-book-room">Book Now</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p>No rooms available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@include('home.footer')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
