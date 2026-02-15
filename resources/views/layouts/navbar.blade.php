<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
        <a href="{{ route('landing') }}" class="navbar-brand d-flex align-items-center">
            <img src="{{ asset('assets/img/logo_lp.png') }}" alt="Laskar Panglipur" class="navbar-logo me-2">
            <span class="d-none d-sm-inline fw-bold text-white small">LASKAR PANGLIPUR</span>
        </a>

        <button class="navbar-toggler" type="button" onclick="document.getElementById('navbarMain').classList.toggle('show')">
    <span class="navbar-toggler-icon"></span>
</button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav mx-auto text-uppercase">
                <li class="nav-item">
                    <a class="nav-link" href="#sejarah">Sejarah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#informasi">Informasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#prestasi">Prestasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#pendaftaran">Pendaftaran</a>
                </li>
            </ul>

            <div class="d-flex">
                <a href="{{ route('login') }}" class="btn-login w-100 text-center">Login</a>
            </div>
        </div>
    </div>
</nav>