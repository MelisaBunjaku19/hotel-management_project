<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Room - Dark Bootstrap Admin</title>
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
                <h2 class="h5 no-margin-bottom">Add Room</h2>
            </div>
        </div>

        <!-- Back to Show Rooms Button -->
        <div class="text-center mb-3">
            <a href="{{ route('admin.index_room') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back to Show Rooms
            </a>
        </div>

        <section class="no-padding-bottom">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="block">
                        <div class="block-body">
                            <!-- Form for Adding a Room -->
                            <form action="{{ route('admin.store_room') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Display Success Message -->
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <!-- Display Validation Errors -->
                                @error('room_title')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('description')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('price')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('room_type')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('wifi')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('image')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <!-- Room Title Field -->
                                <div class="form-group">
                                    <label for="room_title">Room Title</label>
                                    <input type="text" id="room_title" name="room_title" class="form-control" placeholder="Enter Room Title" value="{{ old('room_title') }}" required>
                                </div>

                                <!-- Image Field -->
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" id="image" name="image" class="form-control-file">
                                </div>

                                <!-- Description Field -->
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter Room Description" required>{{ old('description') }}</textarea>
                                </div>

                                <!-- Price Field -->
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" id="price" name="price" class="form-control" placeholder="Enter Room Price" value="{{ old('price') }}" required>
                                </div>

                                <!-- Room Type Field -->
                                <div class="form-group">
                                    <label for="room_type">Room Type</label>
                                    <input type="text" id="room_type" name="room_type" class="form-control" placeholder="Enter Room Type" value="{{ old('room_type') }}" required>
                                </div>

                                <!-- WiFi Availability Field -->
                                <div class="form-group">
                                    <label for="wifi">WiFi Availability</label>
                                    <select id="wifi" name="wifi" class="form-control" required>
                                        <option value="1" {{ old('wifi') == '1' ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('wifi') == '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Create Room</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
