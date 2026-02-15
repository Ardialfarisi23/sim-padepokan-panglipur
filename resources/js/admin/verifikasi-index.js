document.addEventListener('DOMContentLoaded', function () {
    // 1. Logika untuk Tombol Verifikasi (Konfirmasi)
    const verifButtons = document.querySelectorAll('.btn-verif-trigger');

    verifButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');

            Swal.fire({
                title: 'Verifikasi Anggota?',
                html: `Apakah Anda yakin ingin memverifikasi <b>${nama}</b>?<br><small>Sistem akan membuatkan akun otomatis.</small>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#22c55e', // Warna Hijau sesuai CSS
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Verifikasi!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading saat proses
                    Swal.showLoading();
                    document.getElementById(`form-verif-${id}`).submit();
                }
            });
        });
    });

    // 2. Logika untuk Tombol Tolak (Hapus)
    const rejectButtons = document.querySelectorAll('.btn-reject-trigger');

    rejectButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');

            Swal.fire({
                title: 'Tolak Pendaftaran?',
                html: `Anda akan menghapus data pendaftaran <b>${nama}</b>. Tindakan ini tidak dapat dibatalkan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444', // Warna Merah sesuai CSS
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Tolak!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.showLoading();
                    document.getElementById(`form-reject-${id}`).submit();
                }
            });
        });
    });
});