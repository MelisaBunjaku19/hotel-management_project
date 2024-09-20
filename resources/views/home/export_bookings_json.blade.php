<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Bookings - JSON</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="icon" href="{{ asset('images/your-icon.png') }}" type="image/png" />
    <style>
        .export-page {
            margin: 50px auto;
            text-align: center;
        }
        .export-page h1 {
            font-size: 2rem;
            color: #343a40;
            margin-bottom: 20px;
        }
        .export-page .btn-export {
            background-color: #343a40;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .export-page .btn-export:hover {
            background-color: #495057;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    @include('home.header')

    <div class="export-page">
        <h1>Export Bookings as JSON</h1>
        <a href="{{ route('export.bookings.json') }}" class="btn btn-export">Download as JSON</a>
    </div>

    @include('home.footer')

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
