<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Room List - Dark Bootstrap Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/font-awesome/css/font-awesome.min.css') }}">

    <!-- Custom Font Icons CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">

    <!-- Google Fonts - Muli -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">

    <!-- Theme Stylesheet -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.default.css') }}" id="theme-stylesheet">

    <!-- Custom Stylesheet - for your changes -->
    <link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/img/favicon.ico') }}">
</head>

<body style="background-color: #121417; color: #ccc;">
    <div class="container" style="padding: 30px 0;">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Room List</h2>
            </div>
        </div>

        <!-- Back to Dashboard Button -->
        <div class="text-center mb-3">
            <a href="{{ route('home') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>


        <section class="no-padding-bottom">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="block">
                        <div class="block-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if($rooms->isEmpty())
                                <p class="text-center">No rooms found.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>Room Title</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Room Type</th>
                                                <th>WiFi</th>
                                                <th style="width: 300px;">Actions</th> <!-- Made the Actions column wider -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($rooms as $room)
                                                <tr>
                                                    <td>{{ $room->id }}</td>
                                                    <td>{{ $room->room_title }}</td>
                                                    <td><img src="{{ asset('images/' . $room->image) }}" alt="Room Image" width="100"></td>

                                                    <td>{{ Str::limit($room->description, 50) }}</td>
                                                    <td>${{ $room->price }}</td>
                                                    <td>{{ $room->room_type }}</td>
                                                    <td>{{ $room->wifi ? 'Yes' : 'No' }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                         
                                                            <a href="{{ route('admin.edit_room', $room->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                                            <form action="{{ route('admin.delete_room', $room->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Inline styles for buttons -->
    <style>
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #fff;
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: #fff;
        }

        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }

        /* Table styles */
        .table thead th {
            background-color: #343a40;
            color: #fff;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        .table td img {
            max-width: 100px;
            height: auto;
        }

        /* Custom styling for better layout */
        .table-responsive {
            margin-top: 20px;
        }

        .d-flex {
            display: flex;
            align-items: center;
        }

        .me-2 {
            margin-right: 8px;
        }
    </style>

    <!-- Include jQuery and Bootstrap JS -->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
