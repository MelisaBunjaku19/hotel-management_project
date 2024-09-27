<!-- resources/views/hotel-pamphlet.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Pamphlet</title>
    @viteReactRefresh <!-- Enables React's hot reloading during development -->
    @vite('resources/js/app.jsx') <!-- Ensure this matches the correct JS entry file -->
</head>
<body>
    <div id="hotel-pamphlet-root"></div> <!-- React will mount here -->
</body>
</html>
