import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/admin/admin.css', // Tambahkan ini
                'resources/css/admin/pelatih-page.css', // Tambahkan ini
                'resources/css/admin/anggota-page.css', // Tambahkan ini
                'resources/css/admin/logistik-page.css', // Tambahkan ini
                'resources/css/admin/jadwal-page.css', // Tambahkan ini
                'resources/css/admin/keuangan-page.css', // Tambahkan ini
                'resources/css/admin/seragam-page.css', // Tambahkan ini
                'resources/css/admin/keuangan-rekap.css', // Tambahkan ini
                'resources/css/admin/ujian-page.css', // Tambahkan ini
                'resources/css/admin/ujian-index.js', // Tambahkan ini
                'resources/css/admin/seragam-index.js', // Tambahkan ini


                // CSS Dasar Anggota
    'resources/css/anggota/base/global.css',
    'resources/css/anggota/layout/layout.css',
    'resources/css/anggota/layout/sidebar.css',
    'resources/css/anggota/layout/topbar.css',
    'resources/css/anggota/layout/footer.css',
    'resources/css/anggota/components/button.css',
    'resources/css/anggota/components/dropdown.css',
    'resources/css/anggota/components/modal.css',

    // CSS Per Halaman Anggota
    'resources/css/anggota/pages/dashboard/dashboard-page.css',
    'resources/css/anggota/profile-page.css',
    'resources/css/anggota/pages/jadwal-page.css',
    'resources/css/anggota/pages/seragam-page.css',
    
    // JS Anggota
    'resources/js/anggota/topbar.js',
    'resources/js/anggota/dashboard-agenda.js',
                'resources/js/admin/topbar.js', // Tambahkan ini jika digunakan di layout
                'resources/js/admin/logistik-index.js', // Tambahkan ini jika digunakan di layout
                'resources/js/admin/jadwal-index.js', // Tambahkan ini jika digunakan di layout
                'resources/js/anggota/jadwal-index.js', // Tambahkan ini jika digunakan di layout
                'resources/js/admin/dashboard-agenda.js', // Tambahkan ini jika digunakan di layout
            ],
            refresh: true,
        }),
    ],
});