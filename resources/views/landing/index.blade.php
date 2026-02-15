<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laskar Panglipur</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo_lp.png') }}?v=1.1">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>


    {{-- ================= NAVBAR ================= --}}
    @include('layouts.navbar')
    @include('landing.sections.hero')
    @include('landing.sections.sejarah')
    @include('landing.sections.informasi_prestasi')
    @include('landing.sections.pendaftaran')
    @include('landing.sections.galeri')
    @include('layouts.footer')




        </div>
    </div>
</footer>


</body>
</html>
