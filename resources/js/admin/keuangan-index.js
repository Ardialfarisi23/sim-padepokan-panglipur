document.addEventListener('DOMContentLoaded', function () {
    const el = {
        tabs: document.querySelectorAll('.tab-btn'),
        container: document.getElementById('transaction_container'),
        title: document.getElementById('display-title'),
        bulanSelect: document.getElementById('filterBulanTabel'),
    tahunSelect: document.getElementById('filterTahunTabel'),
        searchInput: document.getElementById('searchTransaksi'),
        btnTambah: document.getElementById('btnOpenModalTambah'),
        modalEl: document.getElementById('modalTransaksi'),
        form: document.getElementById('formTransaksi'),
        kasValue: document.querySelector('.kas-value'),
        totalMasuk: document.getElementById('total-pemasukan-rekap'), // Pastikan ID ini ada di HTML Anda
        totalKeluar: document.getElementById('total-pengeluaran-rekap') // Pastikan ID ini ada di HTML Anda
    };

    let currentType = 'pemasukan';
    let transaksiModal = null;
    let isEdit = false;
    let currentEditId = null;

    if (el.modalEl && typeof bootstrap !== 'undefined') {
        transaksiModal = new bootstrap.Modal(el.modalEl);
    }

    // --- 1. Fungsi Ambil Data ---
    function fetchData(type) {
        if (!el.container) return;
        
        // Ambil nilai bulan DAN tahun dari dropdown
        const bulan = el.bulanSelect ? el.bulanSelect.value : (new Date().getMonth() + 1);
        const tahun = el.tahunSelect ? el.tahunSelect.value : new Date().getFullYear();

        el.container.innerHTML = `<div class="text-center py-5"><div class="spinner-border text-success"></div></div>`;

        // Tambahkan parameter tahun di URL
        fetch(`/admin/keuangan?bulan=${bulan}&tahun=${tahun}&type=${type}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            // Update Tabel
            el.container.innerHTML = data.html;

            // Update Kas Utama Global (Pojok Kanan Atas)
            if (data.saldo_global && el.kasValue) {
                el.kasValue.innerText = `Rp. ${data.saldo_global},`;
            }

            // Update Rekap Bulanan (Angka Pemasukan/Pengeluaran di bawah filter)
            if (data.rekap_bulanan) {
                if (el.totalMasuk) el.totalMasuk.innerText = `Rp. ${data.rekap_bulanan.total_pemasukan}`;
                if (el.totalKeluar) el.totalKeluar.innerText = `Rp. ${data.rekap_bulanan.total_pengeluaran}`;
            }
        })
        .catch((err) => {
            console.error(err);
            el.container.innerHTML = '<div class="text-center py-5 text-danger">Gagal memuat data.</div>';
        });
    }

    // Tambahkan listener untuk Tahun jika belum ada di bawah
    if (el.tahunSelect) {
        el.tahunSelect.addEventListener('change', () => fetchData(currentType));
    }

    // --- 2. Event Klik Edit (Event Delegation) ---
    // --- FUNGSI EDIT GLOBAL ---
    window.editTransaksi = function(id, type) {
        isEdit = true;
        currentEditId = id;
        
        fetch(`/admin/keuangan/${id}/edit`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('modalLabel').innerText = `Edit ${type.charAt(0).toUpperCase() + type.slice(1)}`;
                document.getElementById('labelSumberKeperluan').innerText = type === 'pemasukan' ? 'Sumber' : 'Keperluan';
                
                el.form.querySelector('[name="tanggal"]').value = data.tanggal;
                el.form.querySelector('[name="sumber_keperluan"]').value = data.sumber || data.keperluan;
                el.form.querySelector('[name="metode"]').value = data.metode;
                el.form.querySelector('[name="nominal"]').value = data.nominal;

                transaksiModal.show();
            })
            .catch(() => alert("Gagal mengambil data"));
    };

    // --- FUNGSI HAPUS GLOBAL ---
    window.hapusTransaksi = function(id, type) {
    Swal.fire({
        title: 'Hapus Data?',
        text: "Data transaksi ini akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f34e4e', // Warna merah sesuai gambar
        cancelButtonColor: '#fff',     // Background putih untuk batal
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true,          // Menukar posisi tombol agar 'Batal' di kiri
        customClass: {
            container: 'custom-swal-container',
            popup: 'custom-swal-popup',
            title: 'custom-swal-title',
            confirmButton: 'custom-swal-confirm',
            cancelButton: 'custom-swal-cancel'
        },
        buttonsStyling: false,         // Kita akan pakai CSS custom agar lebih presisi
    }).then((result) => {
        if (result.isConfirmed) {
            // ... (logika fetch delete Anda tetap sama)
            fetch(`/admin/keuangan/${id}?type=${type}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    fetchData(currentType);
                }
            });
        }
    });
};
    // --- 3. Event Tombol Tambah (Reset State) ---
    if (el.btnTambah) {
        el.btnTambah.addEventListener('click', function() {
            isEdit = false;
            currentEditId = null;
            document.getElementById('modalLabel').innerText = `Tambah ${currentType.charAt(0).toUpperCase() + currentType.slice(1)}`;
            document.getElementById('labelSumberKeperluan').innerText = currentType === 'pemasukan' ? 'Sumber' : 'Keperluan';
            el.form.reset();
            transaksiModal.show();
        });
    }

    // --- 4. Submit Form (Tambah & Update) ---
    if (el.form) {
        el.form.addEventListener('submit', function(e) {
            e.preventDefault();
            const btnSubmit = this.querySelector('button[type="submit"]');
            const originalText = btnSubmit.innerText;

            const formData = new FormData(this);
            formData.append('type', currentType);
            
            // Logika ganti URL dan Method jika Edit
            let url = "/admin/keuangan/store-transaksi";
            if (isEdit) {
                url = `/admin/keuangan/${currentEditId}/update`;
                formData.append('_method', 'PUT'); // Spoofing method PUT untuk Laravel
            }

            btnSubmit.disabled = true;
            btnSubmit.innerText = 'Memproses...';

            fetch(url, {
                method: "POST", // Tetap POST karena FormData memerlukan POST, _method PUT akan menghandlenya
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => {
                if (!response.ok) return response.json().then(err => { throw err; });
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    transaksiModal.hide();
                    el.form.reset();
                    
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    }
                    fetchData(currentType);
                }
            })
            .catch(error => {
                alert('Gagal: ' + (error.message || 'Terjadi kesalahan'));
            })
            .finally(() => {
                btnSubmit.disabled = false;
                btnSubmit.innerText = originalText;
            });
        });
    }

    // --- 5. Tabs & Filters ---
    el.tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            if (!type || type === currentType) return;
            el.tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            currentType = type;
            if (el.title) el.title.innerText = type.charAt(0).toUpperCase() + type.slice(1);
            fetchData(currentType);
        });
    });

    if (el.bulanSelect) el.bulanSelect.addEventListener('change', () => fetchData(currentType));
    
    // Load pertama kali
    fetchData(currentType);
});