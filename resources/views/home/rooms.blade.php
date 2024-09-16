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
    background-color: #28a745; /* Green for available rooms */
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

.btn-booked {
    background-color: #dc3545; /* Red for booked rooms */
    color: #fff;
    cursor: not-allowed; /* Optional: show a not-allowed cursor to indicate unavailability */
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

.filter-form {
    margin-bottom: 30px;
}

.filter-form .form-row {
    display: flex;
    flex-wrap: wrap;
    gap: 15px; /* Space between the form elements */
}

.filter-form .form-group {
    margin-bottom: 0;
}

.filter-form .form-control {
    width: 100%;
}

.filter-form label {
    display: block; /* Ensures the label takes the full width */
    font-weight: bold;
    margin-bottom: 5px; /* Space between label and input */
}

.filter-form button {
    margin-top: 20;
}
.filter-form button:hover {
    background-color: #0056b3; /* Darker blue on hover */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}


.filter-form label {
    margin-right: 10px;
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

      <!-- Filtering Form -->
<!-- Filtering Form -->
<!-- Filtering Form -->
<div class="row mb-4">
    <div class="col-md-12">
        <form method="GET" action="{{ route('rooms.index') }}" class="filter-form">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="room_type">Room Type</label>
                    <select name="room_type" id="room_type" class="form-control">
                        <option value="">All Types</option>
                        <option value="single" {{ request('room_type') == 'single' ? 'selected' : '' }}>Single</option>
                        <option value="double" {{ request('room_type') == 'double' ? 'selected' : '' }}>Double</option>
                        <option value="suite" {{ request('room_type') == 'suite' ? 'selected' : '' }}>Suite</option>
                        <option value="family" {{ request('room_type') == 'family' ? 'selected' : '' }}>Family</option>
                        <option value="penthouse" {{ request('room_type') == 'penthouse' ? 'selected' : '' }}>Penthouse</option>
                        <option value="economy" {{ request('room_type') == 'economy' ? 'selected' : '' }}>Economy</option>
                        <option value="business" {{ request('room_type') == 'business' ? 'selected' : '' }}>Business</option>
                        <option value="standard" {{ request('room_type') == 'standard' ? 'selected' : '' }}>Standard</option>
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label for="min_price">Min Price</label>
                    <input type="number" name="min_price" id="min_price" class="form-control" placeholder="0" min="0" value="{{ request('min_price') }}">
                </div>

                <div class="form-group col-md-2">
                    <label for="max_price">Max Price</label>
                    <input type="number" name="max_price" id="max_price" class="form-control" placeholder="1000" min="0" value="{{ request('max_price') }}">
                </div>

                <div class="form-group col-md-2">
                    <label for="wifi">Wi-Fi</label>
                    <select name="wifi" id="wifi" class="form-control">
                        <option value="">Any</option>
                        <option value="yes" {{ request('wifi') == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ request('wifi') == 'no' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="form-group col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary btn-lg w-100">Apply Filters</button>
                </div>
            </div>
        </form>
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
                                <button class="btn-book-room" disabled>Booked</button>

                                @endif
                            @else
                                <a href="{{ route('payment.page', $room->id) }}" class="btn-book-room">Book Now</a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <p>No rooms found.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@include('home.footer')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
