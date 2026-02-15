<!DOCTYPE html>
<html lang="id">
   
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded"
      rel="stylesheet" />


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>


    {{-- CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>


    {{-- NAVBAR --}}
    @include('layouts.navbar')


    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>


    {{-- FOOTER --}}
    @include('layouts.footer')


</body>
</html>
