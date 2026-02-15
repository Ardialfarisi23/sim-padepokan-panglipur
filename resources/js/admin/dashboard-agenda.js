/**
 * Laskar Panglipur Dashboard Agenda Logic
 * Handled via Vite & AJAX
 */

// Inisialisasi variabel global untuk melacak bulan dan tahun yang sedang ditampilkan
let currentMonth = new Date().getMonth() + 1;
let currentYear = new Date().getFullYear();

document.addEventListener('DOMContentLoaded', function() {
    // Jalankan pertama kali saat halaman dimuat
    fetchAgenda(currentMonth, currentYear);

    // Event Listener untuk tombol bulan sebelumnya
    const btnPrev = document.getElementById('btn-prev-month');
    const btnNext = document.getElementById('btn-next-month');

    if (btnPrev && btnNext) {
        btnPrev.addEventListener('click', function() {
            currentMonth--;
            if (currentMonth < 1) {
                currentMonth = 12;
                currentYear--;
            }
            fetchAgenda(currentMonth, currentYear);
        });

        btnNext.addEventListener('click', function() {
            currentMonth++;
            if (currentMonth > 12) {
                currentMonth = 1;
                currentYear++;
            }
            fetchAgenda(currentMonth, currentYear);
        });
    }
});

/**
 * Fungsi Utama: Mengambil data dari server
 */
function fetchAgenda(month, year) {
    const url = `/admin/dashboard?month=${month}&year=${year}`;

    fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        // 1. Update Judul Bulan & Tahun
        document.getElementById('display-month-year').innerText = data.month_name;

        // 2. Update List Agenda di sisi kiri (HTML dikirim dari Controller)
        const listContainer = document.getElementById('agenda-list-container');
        if (listContainer) {
            listContainer.innerHTML = data.html;
        }

        // 3. Gambar Ulang Kalender di sisi kanan
        renderCalendar(month, year, data.days_in_month, data.first_day, data.agenda);
    })
    .catch(error => {
        console.error('Fetch Error:', error);
    });
}

/**
 * Fungsi Render Kalender
 */
function renderCalendar(month, year, daysInMonth, firstDay, agendaList) {
    const grid = document.getElementById('calendar-grid');
    if (!grid) return;
    
    grid.innerHTML = '';

    // Penyesuaian Offset: 
    // Carbon firstDay (1=Senin, 7=Minggu). 
    // Jika kalender kita mulai dari Minggu, maka 7 (Minggu) jadi 0.
    const offset = firstDay === 7 ? 0 : firstDay;

    // Slot kosong untuk awal bulan
    for (let i = 0; i < offset; i++) {
        const emptyBox = document.createElement('span');
        grid.appendChild(emptyBox);
    }

    // Render Angka Tanggal (1 s/d 31)
    for (let day = 1; day <= daysInMonth; day++) {
        const dateElement = document.createElement('span');
        dateElement.classList.add('cal-date');
        dateElement.innerText = day;

        // Cek apakah ada agenda di tanggal ini
        // Format tanggal dari DB biasanya YYYY-MM-DD
        const formattedDate = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        
        const agendaHariIni = agendaList.find(item => {
            // Kita pastikan formatnya string YYYY-MM-DD
            const itemDate = item.tanggal.split('T')[0]; 
            return itemDate === formattedDate;
        });

        // Jika ada agenda, tempelkan class warna berdasarkan status
        if (agendaHariIni) {
            const statusColor = getStatusColorClass(agendaHariIni.status);
            dateElement.classList.add(`date-${statusColor}`);
            
            // Opsional: Tambahkan tooltip sederhana
            dateElement.title = agendaHariIni.agenda;
        }

        // Tandai hari ini (real-time)
        const today = new Date();
        if (day === today.getDate() && month === (today.getMonth() + 1) && year === today.getFullYear()) {
            dateElement.style.border = "1px solid #ffcc4d";
        }

        grid.appendChild(dateElement);
    }
}

/**
 * Helper: Mapping Status Database ke Class CSS
 */
function getStatusColorClass(status) {
    const s = status ? status.toLowerCase() : '';
    switch(s) {
        case 'latihan': return 'green';
        case 'nasional': return 'blue';
        case 'internasional': return 'yellow';
        case 'lainnya': return 'green-faded';
        default: return 'green-faded';
    }
}