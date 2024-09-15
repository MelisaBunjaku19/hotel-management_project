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
        .bookings .titlepage h2 {
            font-size: 40px;
            color: black;
        }
        .bookings .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }
        .bookings .card:hover {
            transform: translateY(-10px);
        }
        .bookings .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .bookings .btn-primary {
            background-color: #343a40;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .bookings .btn-primary:hover {
            background-color: #495057;
            transform: scale(1.05);
        }
        .header {
            background: #333;
            color: white;
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
        .confirmed {
            background-color: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.875rem;
            font-weight: bold;
        }
        .btn-cancel {
            background-color: #dc3545;
            color: white;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-cancel:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }
        /* Message and modal button enhancements */
        .alert-success {
        background-color: #28a745;
        color: white;
        border: none;
        font-size: 1rem;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
        position: relative;
        top: 20px;
        z-index: 999;
    }

    /* Fade out animation */
    .alert-success.fade-out {
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }

        .modal-footer .btn-secondary {
            background-color: #6c757d;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .modal-footer .btn-secondary:hover {
            background-color: #5a6268;
            transform: scale(1.05);
        }
        .modal-footer .btn-danger {
            background-color: #dc3545;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .modal-footer .btn-danger:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
@include('home.header')

<div class="bookings">
    <div class="container">
        @if(session('success'))
            <div id="successMessage" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="titlepage text-center">
                    <h2>My Bookings</h2>
                    <p>Here you can view your most recent bookings.</p>
                </div>
            </div>
        </div>

        <div class="row">
            @if($bookings->count())
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
                                <button class="btn btn-cancel" data-toggle="modal" data-target="#cancelModal" data-id="{{ $booking->id }}" data-room="{{ $booking->room->room_title }}">Cancel Booking</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12 text-center">
                    <p>You have no bookings.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Cancel Confirmation Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Cancel Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel your booking for <strong id="roomTitle"></strong>?</p>
                <p>This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
            <form id="cancelForm" method="POST" action="{{ route('bookings.cancel') }}">
    @csrf
    <input type="hidden" name="booking_id" id="bookingId">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-danger">Confirm Cancellation</button>
</form>

            </div>
        </div>
    </div>
</div>

@include('home.footer')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<script>
    $('#cancelModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var bookingId = button.data('id');
        var roomTitle = button.data('room');

        var modal = $(this);
        modal.find('#roomTitle').text(roomTitle);
        modal.find('#bookingId').val(bookingId);
    });

    $(document).ready(function() {
        setTimeout(function() {
            $('#successMessage').addClass('fade-out');
        }, 5000);

        setTimeout(function() {
            $('#successMessage').remove();
        }, 6000);
    });
</script>

</body>
</html>