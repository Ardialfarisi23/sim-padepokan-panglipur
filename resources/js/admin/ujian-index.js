document.addEventListener('DOMContentLoaded', function() {
    
    // --- 1. FUNGSI KALKULASI UJIAN ---
    const hitungHasilUjian = (modalElement) => {
        // Cari elemen di dalam modal yang sedang aktif
        const inputs = modalElement.querySelectorAll('.input-nilai');
        const totalDisplay = modalElement.querySelector('.input-total-nilai');
        const minNilaiInput = modalElement.querySelector('.input-min-nilai');
        const statusDisplay = modalElement.querySelector('.input-status-display');
        const summaryCard = modalElement.querySelector('.result-summary-box'); // Pastikan class sesuai Blade

        if (!totalDisplay || !statusDisplay) return;

        // Hitung Total Nilai
        let total = 0;
        inputs.forEach(input => {
            total += parseInt(input.value) || 0;
        });

        // Tampilkan Total Nilai
        totalDisplay.value = total;
        const nilaiMin = parseInt(minNilaiInput?.value) || 600;

        // Logika Kelulusan & Perubahan UI Card
        if (total >= nilaiMin) {
            statusDisplay.value = 'LULUS';
            statusDisplay.style.color = '#16a34a'; // Hijau tua
            
            if (summaryCard) {
                summaryCard.style.backgroundColor = "#ecfdf5"; // Hijau pudar
                summaryCard.style.borderColor = "#10b981";
            }
        } else {
            statusDisplay.value = 'TIDAK LULUS';
            statusDisplay.style.color = '#dc2626'; // Merah tua
            
            if (summaryCard) {
                summaryCard.style.backgroundColor = "#f8fafc"; // Abu/Putih pudar
                summaryCard.style.borderColor = "#e2e8f0";
            }
        }
    };

    // --- 2. EVENT LISTENER INPUT ---
    // Menggunakan delegasi agar lebih ringan
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('input-nilai')) {
            const parentModal = e.target.closest('.modal');
            if (parentModal) hitungHasilUjian(parentModal);
        }
    });

    // --- 3. INISIALISASI SAAT MODAL DIBUKA ---
    const allModals = document.querySelectorAll('.modal');
    allModals.forEach(modal => {
        modal.addEventListener('shown.bs.modal', function () {
            hitungHasilUjian(this);
        });
    });

    // --- 4. SKELETON LOADING ---
    const filterForm = document.getElementById('filterForm');
    if (filterForm) {
        filterForm.addEventListener('submit', function() {
            const tableBody = document.querySelector('.pg-pelatih-table tbody');
            const columnCount = document.querySelectorAll('.pg-pelatih-table thead th').length;
            
            // Buat 5 baris skeleton loading
            let skeletonRows = '';
            for (let i = 0; i < 5; i++) {
                skeletonRows += `
                    <tr>
                        <td colspan="${columnCount}" class="p-3">
                            <div class="skeleton" style="height: 25px; width: 100%;"></div>
                        </td>
                    </tr>
                `;
            }
            tableBody.innerHTML = skeletonRows;
        });
    }
});