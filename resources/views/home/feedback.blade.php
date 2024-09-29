<!-- resources/views/feedback.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - OnlineHotel</title>
    
    <!-- CSRF Token for Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- This is required for Vite's hot reloading during development -->
    @viteReactRefresh 

    <!-- Link to the entry file for your React app -->
    @vite('resources/js/app.jsx')
</head>
<body>
    <!-- Div for React app to mount -->
    <div id="feedback-root"></div>
</body>
</html>
