<!DOCTYPE html>
<html lang="id">
    

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Admin')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- CSS --}}
    @vite(['resources/css/admin/admin.css'])
    {{-- JS --}}
    @vite(['resources/js/admin/topbar.js'])
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:FILL@1"
      rel="stylesheet" />
</head>
<body class="admin-body" data-page="@yield('page')">


    {{-- TOPBAR --}}
    @include('admin.partials.topbar')

    <div class="admin-wrapper">

        {{-- SIDEBAR --}}
        @include('admin.partials.sidebar')

        {{-- CONTENT --}}
        <main class="admin-main">
            @yield('content')
        </main>

    </div>


</body>
</html>
