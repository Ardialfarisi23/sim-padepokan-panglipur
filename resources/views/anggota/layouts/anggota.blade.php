<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Anggota')</title>
    
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo_lp.png') }}?v=1.1">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />

    {{-- FullCalendar CSS (Karena Dashboard Anggota ada Agenda) --}}
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">

    {{-- Core CSS Anggota (Menggunakan Folder yang Kita Susun Sebelumnya) --}}
    @vite([
    'resources/css/anggota/base/global.css',
    'resources/css/anggota/layout/layout.css',
    'resources/css/anggota/layout/sidebar.css',
    'resources/css/anggota/layout/topbar.css',
    'resources/css/anggota/layout/footer.css',
    'resources/css/anggota/components/button.css',
    'resources/css/anggota/components/dropdown.css',
    'resources/css/anggota/components/modal.css',
    'resources/css/anggota/profile-page.css',
    'resources/css/anggota/pages/dashboard/dashboard-page.css' {{-- Tambahkan /pages/ --}}
])

    {{-- JS --}}
    @vite(['resources/js/anggota/topbar.js'])

    {{-- Slot khusus CSS per Halaman --}}
    @stack('styles')
</head>
<body>

<div class="anggota-wrapper">

    {{-- TOPBAR --}}
    @include('anggota.partials.topbar')

    <div class="anggota-layout">

        {{-- SIDEBAR --}}
        @include('anggota.partials.sidebar')

        {{-- CONTENT --}}
        <main class="anggota-content">
    @yield('content')
</main>

    </div>

    {{-- FOOTER --}}
    @include('anggota.partials.footer')
</div>

{{-- External Scripts (Sesuai Struktur Admin) --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Core JS Anggota --}}
@vite([
    'resources/js/anggota/topbar.js'
])

{{-- Slot khusus JS per Halaman --}}
@stack('scripts')

</body>
</html>