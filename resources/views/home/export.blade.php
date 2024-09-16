<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Welcome to the Home Page</h1>
        
        <!-- Export Users Button -->
        <a href="{{ url('/export-users') }}" class="btn btn-primary">Export Users</a>
    </div>
</body>
</html>
