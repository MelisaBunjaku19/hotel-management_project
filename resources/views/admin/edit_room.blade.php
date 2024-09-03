<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Room - Dark Bootstrap Admin</title>
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
                <h2 class="h5 no-margin-bottom">Edit Room</h2>
            </div>
        </div>

        <!-- Back to Room List Button -->
        <div class="text-center mb-3">
            <a href="{{ route('admin.index_room') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back to Room List
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="block">
                    <div class="block-body">
                        <!-- Display Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Edit Room Form -->
                        <form action="{{ route('admin.update_room', $room->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Room Title Field -->
                            <div class="form-group">
                                <label for="room_title">Room Title</label>
                                <input type="text" id="room_title" name="room_title" class="form-control" value="{{ old('room_title', $room->room_title) }}" required>
                            </div>

                            <!-- Current Image Display -->
                            @if ($room->image)
                                <div class="form-group">
                                    <label>Current Image</label>
                                    <div>
                                        <img src="{{ asset('images/' . $room->image) }}" alt="Room Image" class="img-fluid" style="max-width: 200px;">
                                    </div>
                                </div>
                            @endif

                            <!-- Image Upload Field -->
                            <div class="form-group">
                                <label for="image">Change Room Image (Optional)</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/jpeg,image/png,image/jpg">
                            </div>

                            <!-- Description Field -->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control" rows="5" required>{{ old('description', $room->description) }}</textarea>
                            </div>

                            <!-- Price Field -->
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" id="price" name="price" class="form-control" value="{{ old('price', $room->price) }}" required>
                            </div>

                            <!-- Room Type Field -->
                            <div class="form-group">
                                <label for="room_type">Room Type</label>
                                <input type="text" id="room_type" name="room_type" class="form-control" value="{{ old('room_type', $room->room_type) }}" required>
                            </div>

                            <!-- WiFi Availability Field -->
                            <div class="form-group">
                                <label for="wifi">WiFi Availability</label>
                                <select id="wifi" name="wifi" class="form-control">
                                    <option value="1" {{ old('wifi', $room->wifi) ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ !old('wifi', $room->wifi) ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Update Room</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inline styles (unchanged) -->
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

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</body>

</html>
