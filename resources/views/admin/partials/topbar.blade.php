<header class="admin-topbar">
    <div class="topbar-left">
        <img src="{{ asset('assets/img/logo_lp.png') }}" alt="Logo" class="topbar-logo">
        <span class="topbar-title">SIM Padepokan Laskar Panglipur</span>
    </div>

    <div class="topbar-right">
        {{-- Username dengan Background Baru --}}
        <div class="user-badge">
            <span class="material-symbols-rounded user-icon">person</span>
            <span class="user-name">{{ auth()->user()->username }}</span>
        </div>

        <div class="topbar-menu">
            <button class="icon-btn" id="menuToggle">
                <span class="material-symbols-rounded">more_vert</span>
            </button>

            <div class="dropdown-menu" id="menuDropdown">
                <a href="#" class="dropdown-item about" id="openAboutModal">
                    <span class="material-symbols-rounded icon about-icon">info</span>
                    Tentang
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item logout">
                        <span class="material-symbols-rounded icon logout-icon">logout</span>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

{{-- Modal Tentang --}}
<div class="modal-overlay" id="aboutModal">
    <div class="modal-box">
        <span class="material-symbols-rounded modal-icon">info</span>
        <h3>Developer:</h3>
        <ul class="developer-list">
            <li>Ismi Nurcahyani</li>
            <li>Ardi Alfarisi</li>
            <li>Renal Andiandri</li>
        </ul>
        <button class="btn-close" id="closeAboutModal">Kembali</button>
    </div>
</div>