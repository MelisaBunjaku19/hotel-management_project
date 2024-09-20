<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit User - Dark Bootstrap Admin</title>
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

    <!-- intl-tel-input CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
</head>

<body style="background-color: #121417; color: #ccc;">
    <div class="container" style="padding: 30px 0;">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Edit User</h2>
            </div>
        </div>

        <!-- Back to Dashboard Button -->
        <div class="text-center mb-3">
            <a href="{{ route('home') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        <!-- Edit User Form Section -->
        <section class="no-padding-bottom">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="block">
                        <div class="block-body">
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.update_user', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter phone number" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                                </div>

                                <div class="form-group">
                                    <label for="usertype">Role</label>
                                    <select id="usertype" name="usertype" class="form-control">
                                        <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="user" {{ $user->usertype == 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>
        .btn-secondary, .btn-primary {
            background-color: #6c757d;
            border-color: #6c757d;
            color: #fff;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover, .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .form-group label {
            color: #ccc;
        }

        .form-control {
            background-color: #2a2e33;
            color: #fff;
            border: 1px solid #444;
        }

        .form-control:focus {
            background-color: #2a2e33;
            color: #fff;
            border-color: #007bff;
            box-shadow: none;
        }

        .intl-tel-input {
            width: 100%;
        }
    </style>

    <!-- intl-tel-input JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInputField = document.querySelector("#phone");
            window.intlTelInput(phoneInputField, {
                // No geoIpLookup and utilsScript
                initialCountry: "auto",
                nationalMode: true,
                separateDialCode: true,
                // You can add other options as needed
            });

            // Handle form submission
            document.querySelector("form").addEventListener("submit", function(e) {
                const phoneInput = phoneInputField.intlTelInput.getNumber();
                
                // Add the phone number with country code to a hidden input or directly submit it
                const hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "full_phone_number";
                hiddenInput.value = phoneInput;
                this.appendChild(hiddenInput);
            });
        });
    </script>
</body>

</html>
