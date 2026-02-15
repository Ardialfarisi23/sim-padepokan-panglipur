<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
    
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo_lp.png') }}?v=1.1">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />


    {{-- CSS --}}
    @vite(['resources/css/admin/admin.css'])
    @vite(['resources/css/admin/anggota-page.css'])
    @vite(['resources/css/admin/pelatih-page.css'])
  
    {{-- JS --}}
    @vite(['resources/js/admin/topbar.js'])
    @vite(['resources/js/admin/dashboard-agenda.js'])


    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">




</head>
<body>


<div class="admin-wrapper">


    {{-- TOPBAR FULL WIDTH --}}
    @include('admin.partials.topbar')


    <div class="admin-layout">


        {{-- SIDEBAR --}}
        @include('admin.partials.sidebar')


        {{-- CONTENT --}}
        <main class="admin-content">
            @yield('content')
        </main>


    </div>


</div>
@include('admin.partials.footer')
</div>

<script src="{{ asset('js/admin/anggota-index.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>



@stack('scripts')
</body>
</html>
