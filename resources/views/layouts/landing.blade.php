<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Laskar Panglipur')</title>


    <meta name="viewport" content="width=device-width, initial-scale=1">


    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded"
      rel="stylesheet" />


    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-poppins bg-white">


    {{-- NAVBAR LANDING --}}
    @include('layouts.navbar')


    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>


    {{-- FOOTER --}}
    @include('layouts.footer')


</body>
</html>
