/**
 * Laskar Panglipur - Jadwal Management Logic
 */

let currentMonth = new Date().getMonth() + 1;
let currentYear = new Date().getFullYear();

// State untuk melacak bulan di modal
let modalMonth = new Date().getMonth() + 1;
let modalYear = new Date().getFullYear();

document.addEventListener('DOMContentLoaded', function() {
    // 1. Load data pertama kali
    fetchJadwal(currentMonth, currentYear);

    

    // 2. Event Listener Navigasi Bulan Utama
    const btnPrev = document.getElementById('btn-prev-month');
    const btnNext = document.getElementById('btn-next-month');

    if (btnPrev && btnNext) {
        btnPrev.addEventListener('click', () => {
            currentMonth--;
            if (currentMonth < 1) { currentMonth = 12; currentYear--; }
            fetchJadwal(currentMonth, currentYear);
        });

        btnNext.addEventListener('click', () => {
            currentMonth++;
            if (currentMonth > 12) { currentMonth = 1; currentYear++; }
            fetchJadwal(currentMonth, currentYear);
        });
    }

    

    // 3. Trigger Buka Modal
    document.getElementById('btnOpenTambah')?.addEventListener('click', () => openModalJadwal(document.getElementById('modalTambahJadwal'), 'tambah'));
    document.getElementById('btnOpenEdit')?.addEventListener('click', () => openModalJadwal(document.getElementById('modalEditJadwal'), 'edit'));
    document.getElementById('btnOpenHapus')?.addEventListener('click', () => openModalJadwal(document.getElementById('modalHapusJadwal'), 'hapus'));

    // 4. Global Close Modal Button
    document.querySelectorAll('.close-modal').forEach(btn => {
        btn.onclick = () => {
            const modal = btn.closest('.modal-jadwal');
            modal.classList.remove('active');
            if (modal.id === 'modalEditJadwal') window.resetModalEdit();
        };
    });

    // Letakkan di dalam DOMContentLoaded
const formTambah = document.getElementById('formTambahJadwal');
if (formTambah) {
    formTambah.addEventListener('submit', function(e) {
        const tglInput = document.getElementById('input_tgl_tambah').value;
        
        // Jika input tanggal kosong
        if (!tglInput || tglInput === "") {
            e.preventDefault(); // Hentikan pengiriman form
            
            Swal.fire({
                title: 'Tanggal Belum Dipilih',
                text: 'Silakan klik salah satu tanggal pada kalender mini di sisi kiri sebelum menyimpan.',
                icon: 'warning',
                iconColor: '#facc15',
                confirmButtonText: 'Siap, Mengerti',
                buttonsStyling: false,
                customClass: {
                    popup: 'swal-popup-rounded',
                    title: 'swal-title-custom',
                    confirmButton: 'swal-btn-confirm' // Menggunakan class yang sama agar konsisten
                }
            });
        }
    });
}

    // 5. Navigasi Mini Kalender
    document.getElementById('prevMiniTambah')?.addEventListener('click', () => updateModalMonth(-1, 'tambah'));
    document.getElementById('nextMiniTambah')?.addEventListener('click', () => updateModalMonth(1, 'tambah'));
    document.getElementById('prevMiniEdit')?.addEventListener('click', () => updateModalMonth(-1, 'edit'));
    document.getElementById('nextMiniEdit')?.addEventListener('click', () => updateModalMonth(1, 'edit'));
    document.getElementById('prevMiniHapus')?.addEventListener('click', () => updateModalMonth(-1, 'hapus'));
    document.getElementById('nextMiniHapus')?.addEventListener('click', () => updateModalMonth(1, 'hapus'));
});

/**
 * FUNGSI CORE
 */

function fetchJadwal(month, year) {
    const url = `/admin/jadwal?month=${month}&year=${year}`;
    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
    .then(res => res.json())
    .then(data => {
        document.getElementById('display-month-year').innerText = data.month_name;
        const listContainer = document.getElementById('agenda-list-container');
        if (listContainer) listContainer.innerHTML = data.html;
        renderMainCalendar(month, year, data.days_in_month, data.first_day, data.agenda);
    });
}

function renderMainCalendar(month, year, daysInMonth, firstDay, agendaList) {
    const grid = document.getElementById('calendar-grid');
    if (!grid) return;
    grid.innerHTML = '';
    const offset = firstDay === 7 ? 0 : firstDay;
    for (let i = 0; i < offset; i++) grid.appendChild(document.createElement('span'));

    for (let day = 1; day <= daysInMonth; day++) {
        const el = document.createElement('span');
        el.classList.add('cal-date');
        el.innerText = day;
        const dateStr = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const agenda = agendaList.find(a => a.tanggal.split('T')[0] === dateStr);
        if (agenda) {
            el.classList.add(`date-${getStatusClass(agenda.status)}`);
            el.title = agenda.agenda;
        }
        grid.appendChild(el);
    }
}

function getStatusClass(status) {
    switch(status?.toLowerCase()) {
        case 'latihan': return 'green';
        case 'nasional': return 'blue';
        case 'internasional': return 'yellow';
        default: return 'green-faded';
    }
}

/**
 * LOGIKA MODAL
 */

function openModalJadwal(targetModal, type) {
    targetModal.classList.add('active');
    renderMiniCalendar(modalMonth, modalYear, type);
}

function updateModalMonth(delta, type) {
    modalMonth += delta;
    if (modalMonth < 1) { modalMonth = 12; modalYear--; }
    if (modalMonth > 12) { modalMonth = 1; modalYear++; }
    renderMiniCalendar(modalMonth, modalYear, type);
}

function renderMiniCalendar(month, year, type) {
    const gridId = type === 'tambah' ? 'gridTambah' : (type === 'edit' ? 'gridEdit' : 'gridHapus');
    const displayId = type === 'tambah' ? 'monthYearTambah' : (type === 'edit' ? 'monthYearEdit' : 'monthYearHapus');
    const grid = document.getElementById(gridId);
    if (!grid) return;

    fetch(`/admin/jadwal?month=${month}&year=${year}`, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
    .then(res => res.json())
    .then(data => {
        document.getElementById(displayId).innerText = data.month_name;
        grid.innerHTML = '';
        const offset = data.first_day === 7 ? 0 : data.first_day;
        for (let i = 0; i < offset; i++) grid.appendChild(document.createElement('span'));

        for (let day = 1; day <= data.days_in_month; day++) {
            const el = document.createElement('span');
            el.innerText = day;
            el.classList.add('mini-date');
            const dateStr = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            const agenda = data.agenda.find(a => a.tanggal.split('T')[0] === dateStr);
            if (agenda) el.classList.add(`date-${getStatusClass(agenda.status)}`);
            
            el.onclick = () => {
                if(type === 'tambah') {
                    document.querySelectorAll('.mini-date').forEach(d => d.classList.remove('mini-date-selected'));
                    el.classList.add('mini-date-selected');
                    document.getElementById('input_tgl_tambah').value = dateStr;
                }
            };
            grid.appendChild(el);
        }
        if (type === 'edit' || type === 'hapus') updateModalAgendaList(data.agenda, type);
    });
}

function updateModalAgendaList(agendas, type) {
    const containerId = type === 'edit' ? 'edit-selection-list' : 'hapus-selection-list';
    const container = document.getElementById(containerId);
    if (!container) return;

    if (agendas.length === 0) {
        container.innerHTML = '<div class="empty-state"><p>Tidak ada agenda.</p></div>';
        return;
    }

    container.innerHTML = agendas.map(a => {
        const day = new Date(a.tanggal).getDate();
        return `
            <div class="sel-item item-with-badge border-${getStatusClass(a.status)}" onclick="window.handleAgendaSelect(${a.id}, '${type}')">
                <div class="sel-date-badge"><span class="day">${day}</span></div>
                <div class="sel-info">
                    <span class="sel-title">${a.agenda}</span>
                    <span class="sel-meta">${a.lokasi}</span>
                </div>
                <span class="material-symbols-rounded sel-arrow">chevron_right</span>
            </div>`;
    }).join('');
}

/**
 * GLOBAL FUNCTIONS (Tersedia untuk HTML onclick)
 */

window.handleAgendaSelect = function(id, type) {
    if (type === 'edit') {
        fetch(`/admin/jadwal/${id}/edit`, { headers: { 'Accept': 'application/json' } })
        .then(res => res.json())
        .then(data => {
            const form = document.getElementById('formEditJadwal');
            form.action = `/admin/jadwal/${id}`;
            document.getElementById('edit_tanggal').value = data.tanggal.split('T')[0];
            document.getElementById('edit_agenda').value = data.agenda;
            document.getElementById('edit_lokasi').value = data.lokasi;
            document.getElementById('edit_status').value = data.status;
            document.getElementById('edit_keterangan').value = data.keterangan || '';

            document.getElementById('edit-selection-list').style.display = 'none';
            form.style.display = 'block';
        });
    } else if (type === 'hapus') {
        window.confirmDelete(id);
    }
};

window.resetModalEdit = function() {
    const listArea = document.getElementById('edit-selection-list');
    const formArea = document.getElementById('formEditJadwal');
    if (listArea && formArea) {
        listArea.style.display = 'flex';
        formArea.style.display = 'none';
        formArea.reset();
    }
};

window.confirmDelete = function(id) {
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    Swal.fire({
        title: 'Hapus Agenda?',
        text: "Data akan dihapus permanen!",
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
            confirmButton: 'swal-btn-confirm',
            cancelButton: 'swal-btn-cancel',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.createElement('form');
            form.action = `/admin/jadwal/${id}`;
            form.method = 'POST';
            form.innerHTML = `<input type="hidden" name="_token" value="${token}"><input type="hidden" name="_method" value="DELETE">`;
            document.body.appendChild(form);
            form.submit();
        }
    });
};



// Click Outside Close
window.addEventListener('click', (e) => {
    if (e.target.classList.contains('modal-jadwal')) {
        e.target.classList.remove('active');
        if (e.target.id === 'modalEditJadwal') window.resetModalEdit();
    }
});