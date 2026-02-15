document.addEventListener('DOMContentLoaded', function () {
    // 1. Inisialisasi Elemen
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar       = document.querySelector('.anggota-sidebar');
    const menuToggle    = document.getElementById('menuToggle');
    const menuDropdown  = document.getElementById('menuDropdown');
    const aboutBtn      = document.getElementById('openAboutModal');
    const aboutModal    = document.getElementById('aboutModal');
    const closeAboutBtn = document.getElementById('closeAboutModal');

    // 2. Buat Overlay (Jika belum ada)
    let overlay = document.querySelector('.sidebar-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay';
        document.body.appendChild(overlay);
    }

    // 3. Fungsi Toggle Sidebar (Mobile)
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            sidebar.classList.toggle('show');
            overlay.classList.toggle('active');
        });
    }

    // 4. Fungsi Toggle Dropdown Profil (Titik Tiga)
    if (menuToggle && menuDropdown) {
        menuToggle.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            menuDropdown.classList.toggle('show');
        });
    }

    // 5. Fungsi Modal Tentang
    if (aboutBtn && aboutModal) {
        aboutBtn.addEventListener('click', function (e) {
            e.preventDefault();
            aboutModal.classList.add('show');
            menuDropdown.classList.remove('show'); // Tutup dropdown saat modal buka
        });

        closeAboutBtn.addEventListener('click', () => aboutModal.classList.remove('show'));
    }

    // 6. Logika Klik Di Luar (Global Close)
    document.addEventListener('click', function (e) {
        // Tutup Sidebar jika klik di overlay
        if (e.target === overlay) {
            sidebar.classList.remove('show');
            overlay.classList.remove('active');
        }

        // Tutup Dropdown jika klik di luar area menu
        if (menuDropdown && menuDropdown.classList.contains('show')) {
            if (!menuToggle.contains(e.target) && !menuDropdown.contains(e.target)) {
                menuDropdown.classList.remove('show');
            }
        }

        // Tutup Modal jika klik di area background hitam modal
        if (e.target === aboutModal) {
            aboutModal.classList.remove('show');
        }
    });
});