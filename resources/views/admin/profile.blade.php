<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Profile - Dark Bootstrap Admin</title>
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
                <h2 class="h5 no-margin-bottom">Admin Profile</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="block">
                    <div class="block-body">
                        <!-- Profile Update Form -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.update_profile') }}" method="POST">
    @csrf
    <!-- Form fields for updating profile -->
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="form-group">
        <label for="password">Password (leave blank to keep current password)</label>
        <input type="password" id="password" name="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Update Profile</button>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inline styles as before -->
</body>

</html>