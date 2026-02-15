document.addEventListener('DOMContentLoaded', function() {
    // === 1. LOGIKA FILTER PANEL ===
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

    // BARU: Cek jika ada filter yang aktif, buka panel secara otomatis
    if (window.isFiltering) {
        filterPanel.classList.add('active');
        toggleBtn.classList.add('active');
        if (arrowIcon) arrowIcon.style.transform = 'rotate(180deg)';
    }
}

    // === 2. LOGIKA MODAL TAMBAH PELATIH ===
    const modalTambah = document.getElementById('modalTambahPelatih');
    const btnOpenTambah = document.getElementById('btnOpenModalTambah');
    const closeTambahBtns = document.querySelectorAll('.close-tambah');

    if (btnOpenTambah && modalTambah) {
        btnOpenTambah.addEventListener('click', () => {
            modalTambah.classList.add('active');
        });
    }

    closeTambahBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            modalTambah.classList.remove('active');
        });
    });

    // === 3. LOGIKA MODAL EDIT PELATIH ===
const modalEdit = document.getElementById('modalEditPelatih');
const formEdit = document.getElementById('formEditPelatih');
const closeEditBtns = document.querySelectorAll('.close-edit');

document.querySelectorAll('.btn-edit-trigger').forEach(button => {
    button.onclick = function(e) {
        e.preventDefault();
        e.stopPropagation(); // Menghentikan event agar tidak naik ke form filter

        const id = this.getAttribute('data-id');
        const nama = this.getAttribute('data-nama');
        const email = this.getAttribute('data-email');
        const telepon = this.getAttribute('data-telepon');
        const alamat = this.getAttribute('data-alamat');
        const gender = this.getAttribute('data-gender');
        const tingkat = this.getAttribute('data-tingkat');
        const tanggal = this.getAttribute('data-tanggal');

        // Isi input dengan pengecekan eksistensi elemen
        if(document.getElementById('edit_nama')) document.getElementById('edit_nama').value = nama || '';
        if(document.getElementById('edit_email')) document.getElementById('edit_email').value = email || '';
        if(document.getElementById('edit_telepon')) document.getElementById('edit_telepon').value = telepon || '';
        if(document.getElementById('edit_alamat')) document.getElementById('edit_alamat').value = alamat || '';
        if(document.getElementById('edit_tanggal')) document.getElementById('edit_tanggal').value = tanggal || '';
        if(document.getElementById('edit_tingkat')) document.getElementById('edit_tingkat').value = tingkat || '';

        const displayGender = document.getElementById('edit_gender_display');
        const valueGender = document.getElementById('edit_gender_value');
        if(displayGender && valueGender) {
            displayGender.value = (gender === 'laki_laki') ? 'Laki-laki' : 'Perempuan';
            valueGender.value = gender;
        }

        if(formEdit) formEdit.action = `/admin/pelatih/${id}`;
        if(modalEdit) modalEdit.classList.add('active');
    };
});

    // === 4. GLOBAL CLICK ===
    window.addEventListener('click', (e) => {
        if (e.target === modalTambah) modalTambah.classList.remove('active');
        if (e.target === modalEdit) modalEdit.classList.remove('active');
    });

    // === 5. LOGIKA SWEETALERT HAPUS ===
document.querySelectorAll('.btn-delete-trigger').forEach(button => {
    button.onclick = function(e) {
        e.preventDefault();
        e.stopPropagation();

        const id = this.getAttribute('data-id');
        const deleteForm = document.getElementById(`delete-form-${id}`);

        if (!deleteForm) return;

        Swal.fire({
            title: 'Hapus Data Pelatih?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            iconColor: '#ef4444',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
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
                deleteForm.submit();
            }
        });
    };
});
});