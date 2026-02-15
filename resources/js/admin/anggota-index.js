document.addEventListener('DOMContentLoaded', function() {
    // 1. Logika Toggle Filter Panel
    const toggleBtn = document.getElementById('toggleFilterBtn');
    const filterPanel = document.getElementById('filterPanel');
    const arrowIcon = document.getElementById('arrowIcon');

    if (toggleBtn && filterPanel) {
        toggleBtn.addEventListener('click', function() {
            const isActive = filterPanel.classList.toggle('active');
            toggleBtn.classList.toggle('active');
            if (arrowIcon) {
                arrowIcon.style.transform = isActive ? 'rotate(180deg)' : 'rotate(0deg)';
            }
        });

        // Tetap buka panel jika sedang memfilter sesuatu (cek dari window variable)
        if (window.isFiltering) {
            filterPanel.classList.add('active');
            toggleBtn.classList.add('active');
            if (arrowIcon) arrowIcon.style.transform = 'rotate(180deg)';
        }
    }

    // 2. Logika Pop-up Hapus (SweetAlert2)
document.querySelectorAll('.btn-delete-trigger').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');

        Swal.fire({
            title: 'Hapus Data Anggota?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            iconColor: '#ef4444',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true, // Tombol 'Batal' di kiri, 'Hapus' di kanan
            buttonsStyling: false,
            customClass: {
                popup: 'swal-popup-rounded',
                title: 'swal-title-custom',
                htmlContainer: 'swal-text-custom',
                confirmButton: 'swal-btn-confirm',
                cancelButton: 'swal-btn-cancel',
                actions: 'swal-buttons-gap'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    });
});

    // --- Logika Modal Edit Anggota ---
    const modalEdit = document.getElementById('modalEditAnggota');
    const formEdit = document.getElementById('formEditAnggota');
    const btnClose = document.getElementById('btnCloseModal');
    const btnCancel = document.getElementById('btnCancelModal');

    // 1. Fungsi Membuka Modal & Isi Data
    document.querySelectorAll('.btn-edit-trigger').forEach(button => {
        button.addEventListener('click', function() {
            // Ambil data dari attribute tombol yang diklik
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            const tempat = this.getAttribute('data-tempat');
            const tanggal = this.getAttribute('data-tanggal');
            const tingkat = this.getAttribute('data-tingkat');
            const gender = this.getAttribute('data-gender');
            const email = this.getAttribute('data-email');
            const telepon = this.getAttribute('data-telepon');
            const alamat = this.getAttribute('data-alamat');

            // Masukkan data ke dalam input modal
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_tempat').value = tempat;
            document.getElementById('edit_tanggal').value = tanggal;
            document.getElementById('edit_tingkat').value = tingkat;
            document.getElementById('edit_gender').value = gender;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_telepon').value = telepon;
            document.getElementById('edit_alamat').value = alamat;

            // Update action form agar mengarah ke route update yang benar
            // Contoh: /admin/anggota/5
            formEdit.action = `/admin/anggota/${id}`;

            // Tampilkan modal
            modalEdit.classList.add('active');
        });
    });

    // 2. Fungsi Menutup Modal
    const closeModal = () => {
        modalEdit.classList.remove('active');
    };

    if(btnClose) btnClose.addEventListener('click', closeModal);
    if(btnCancel) btnCancel.addEventListener('click', closeModal);

    // Tutup modal jika user klik di luar area modal (di backdrop)
    window.addEventListener('click', (e) => {
        if (e.target === modalEdit) closeModal();
    });
});

