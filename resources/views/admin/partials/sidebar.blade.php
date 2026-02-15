<aside class="admin-sidebar">
    <nav class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="material-symbols-rounded">home</span>
            Beranda
        </a>

        <a href="{{ route('admin.anggota.index') }}"
           class="sidebar-item {{ request()->routeIs('admin.anggota.*') ? 'active' : '' }}">
            <span class="material-symbols-rounded">groups</span>
            Anggota
        </a>

        <a href="{{ route('admin.pelatih.index') }}"
           class="sidebar-item {{ request()->routeIs('admin.pelatih.*') ? 'active' : '' }}">
            <span class="material-symbols-rounded">sports_martial_arts</span>
            Pelatih
        </a>

        <a href="{{ route('admin.logistik.index') }}"
           class="sidebar-item {{ request()->routeIs('admin.logistik.*') ? 'active' : '' }}">
            <span class="material-symbols-rounded">inventory_2</span>
            Logistik
        </a>

        <a href="{{ route('admin.jadwal.index') }}"
           class="sidebar-item {{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}">
            <span class="material-symbols-rounded">event</span>
            Jadwal
        </a>

        <a href="{{ route('admin.keuangan.index') }}"
           class="sidebar-item {{ request()->routeIs('admin.keuangan.*') ? 'active' : '' }}">
            <span class="material-symbols-rounded">payments</span>
            Keuangan
        </a>

        <a href="{{ route('admin.ujian.index') }}"
           class="sidebar-item {{ request()->routeIs('admin.ujian.*') ? 'active' : '' }}">
            <span class="material-symbols-rounded">grading</span>
            Hasil Ujian
        </a>

        <a href="{{ route('admin.seragam.index') }}"
           class="sidebar-item {{ request()->routeIs('admin.seragam.*') ? 'active' : '' }}">
            <span class="material-symbols-rounded">checkroom</span>
            Seragam
        </a>

        <a href="{{ route('admin.verifikasi.index') }}"
           class="sidebar-item {{ request()->routeIs('admin.verifikasi.*') ? 'active' : '' }}">
            <span class="material-symbols-rounded">how_to_reg</span>
            Pendaftaran
        </a>
    </nav>
</aside>