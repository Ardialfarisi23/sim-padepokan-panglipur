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

        // Buka panel secara otomatis jika filter sedang aktif
        if (window.isFiltering) {
            filterPanel.classList.add('active');
            toggleBtn.classList.add('active');
            if (arrowIcon) arrowIcon.style.transform = 'rotate(180deg)';
        }
    }

    // === 2. LOGIKA MODAL TAMBAH BARANG ===
    const modalTambah = document.getElementById('modalTambahLogistik');
    const btnOpenTambah = document.getElementById('btnOpenModalTambah');
    const closeTambahBtns = document.querySelectorAll('.close-tambah');

    if (btnOpenTambah && modalTambah) {
        btnOpenTambah.addEventListener('click', () => {
            modalTambah.classList.add('active');
        });
    }

    closeTambahBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (modalTambah) modalTambah.classList.remove('active');
        });
    });

    // === 3. LOGIKA MODAL EDIT BARANG ===
    const modalEdit = document.getElementById('modalEditLogistik');
    const formEdit = document.getElementById('formEditLogistik');
    const closeEditBtns = document.querySelectorAll('.close-edit');

    document.querySelectorAll('.btn-edit-trigger').forEach(button => {
        button.onclick = function(e) {
            e.preventDefault();
            e.stopPropagation(); // Menghindari interferensi dengan event lain

            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            const jumlah = this.getAttribute('data-jumlah');
            const satuan = this.getAttribute('data-satuan');
            const kondisi = this.getAttribute('data-kondisi');

            // Isi input dengan pengecekan eksistensi elemen (Safe check)
            if(document.getElementById('edit_nama')) document.getElementById('edit_nama').value = nama || '';
            if(document.getElementById('edit_jumlah')) document.getElementById('edit_jumlah').value = jumlah || '0';
            if(document.getElementById('edit_satuan')) document.getElementById('edit_satuan').value = satuan || '';
            if(document.getElementById('edit_kondisi')) document.getElementById('edit_kondisi').value = kondisi || 'baik';

            // Update action route
            if(formEdit) formEdit.action = `/admin/logistik/${id}`;
            
            // Tampilkan modal
            if(modalEdit) modalEdit.classList.add('active');
        };
    });

    closeEditBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (modalEdit) modalEdit.classList.remove('active');
        });
    });

    // === 4. GLOBAL CLICK ===
    window.addEventListener('click', (e) => {
        if (e.target === modalTambah) modalTambah.classList.remove('active');
        if (e.target === modalEdit) modalEdit.classList.remove('active');
    });

    // === 5. LOGIKA SWEETALERT HAPUS BARANG ===
    document.querySelectorAll('.btn-delete-trigger').forEach(button => {
        button.onclick = function(e) {
            e.preventDefault();
            e.stopPropagation();

            const id = this.getAttribute('data-id');
            const deleteForm = document.getElementById(`delete-form-${id}`);

            if (!deleteForm) return;

            Swal.fire({
                title: 'Hapus Barang?',
                text: "Data inventaris ini akan dihapus secara permanen!",
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