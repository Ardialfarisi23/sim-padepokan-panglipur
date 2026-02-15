import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', function() {
    // 1. Inisialisasi Toast SweetAlert
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    // 2. Notifikasi dari Session Laravel (Success/Error)
    const successMsg = document.querySelector('meta[name="success-message"]')?.content;
    const errorMsg = document.querySelector('meta[name="error-message"]')?.content;

    if (successMsg) {
        Toast.fire({ icon: 'success', title: successMsg });
    }
    if (errorMsg) {
        Toast.fire({ icon: 'error', title: errorMsg });
    }

    // 3. Konfirmasi untuk Tombol Tolak
const rejectButtons = document.querySelectorAll('.btn-action-danger');
rejectButtons.forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const form = this.closest('form'); // Cari form terdekat dari tombol yang diklik
        
        Swal.fire({
            title: 'Tolak Pesanan?',
            text: "Data pengajuan akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Tolak!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

    // 4. Efek Interaktif pada Size Selector Modal
    const sizeRadios = document.querySelectorAll('.btn-check');
    sizeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Memberikan efek feedback saat ukuran dipilih
            const label = document.querySelector(`label[for="${this.id}"]`);
            label.style.transform = 'scale(0.95)';
            setTimeout(() => {
                label.style.transform = 'scale(1)';
            }, 100);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
    const toasts = document.querySelectorAll('.toast-item');
    
    toasts.forEach(toast => {
        // Hilangkan toast secara otomatis setelah 4 detik
        setTimeout(() => {
            toast.classList.add('fade-out');
            setTimeout(() => {
                toast.remove();
            }, 500); // Tunggu animasi fade-out selesai
        }, 4000);
    });
});
});