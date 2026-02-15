<aside class="anggota-sidebar">
    <nav class="sidebar-menu">
        <a href="{{ route('anggota.dashboard') }}"
           class="sidebar-item {{ request()->routeIs('anggota.dashboard') ? 'active' : '' }}">
            <span class="material-symbols-rounded">home</span>
            Dashboard
        </a>

        <a href="{{ route('anggota.jadwal.index') }}"
           class="sidebar-item {{ request()->routeIs('anggota.jadwal.*') ? 'active' : '' }}">
            <span class="material-symbols-rounded">event</span>
            Jadwal
        </a>

        <a href="{{ route('anggota.hasil-ujian.index') }}"
           class="sidebar-item {{ request()->routeIs('anggota.hasil-ujian.*') ? 'active' : '' }}">
            <span class="material-symbols-rounded">grading</span>
            Hasil Ujian
        </a>

        <a href="{{ route('anggota.seragam.index') }}"
           class="sidebar-item {{ request()->routeIs('anggota.seragam.*') ? 'active' : '' }}">
            <span class="material-symbols-rounded">checkroom</span>
            Seragam
        </a>
    </nav>
</aside>