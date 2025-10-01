<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ ('resources/css/app.css') }}">

   @vite(['resources/css/app.css', 'resources/js/app.js'])


    <title>Booking System</title>
</head>
<body>
 @include('layout.navbar')
    <div class="container mx-auto mt-4">
        @yield('content')
    </div>
  @include('layout.footer')
</body>
</html>
