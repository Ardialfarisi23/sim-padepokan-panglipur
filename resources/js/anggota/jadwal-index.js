/**
 * Laskar Panglipur - Anggota Jadwal Logic
 */

let currentMonth = new Date().getMonth() + 1;
let currentYear = new Date().getFullYear();

document.addEventListener('DOMContentLoaded', function() {
    // 1. Load data pertama kali
    fetchJadwal(currentMonth, currentYear);

    // 2. Navigasi Bulan
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
});

function fetchJadwal(month, year) {
    // Tambahkan /index agar sesuai dengan route di Laravel kamu
    const fetchUrl = `/anggota/jadwal/index?month=${month}&year=${year}`;
    
    fetch(fetchUrl, { 
        headers: { 
            'X-Requested-With': 'XMLHttpRequest', 
            'Accept': 'application/json' 
        } 
    })
    .then(res => {
        if (!res.ok) throw new Error('Route tidak ditemukan atau server error');
        return res.json();
    })
    .then(data => {
        // Update teks bulan
        const monthYearEl = document.getElementById('display-month-year');
        if(monthYearEl) monthYearEl.innerText = data.month_name;
        
        // Update list agenda
        const listContainer = document.getElementById('agenda-list-container');
        if (listContainer) listContainer.innerHTML = data.html;
        
        // Render Kalender
        renderCalendar(month, year, data.days_in_month, data.first_day, data.agenda);
    })
    .catch(err => console.error('Error fetching data:', err));
}

function renderCalendar(month, year, daysInMonth, firstDay, agendaList) {
    const grid = document.getElementById('calendar-grid');
    if (!grid) return;
    
    grid.innerHTML = '';
    
    // Offset hari (agar tanggal 1 sesuai nama harinya)
    // firstDay: 1 (Senin) - 7 (Minggu). 
    // Jika Minggu (7), offsetnya 0. Jika Senin (1), offsetnya 1.
    const offset = firstDay === 7 ? 0 : firstDay;
    for (let i = 0; i < offset; i++) {
        grid.appendChild(document.createElement('span'));
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const el = document.createElement('span');
        el.classList.add('cal-date');
        el.innerText = day;
        
        // Cek apakah ada agenda di tanggal ini
        const dateStr = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const agenda = agendaList.find(a => {
            // Memastikan perbandingan tanggal akurat
            const aDate = a.tanggal.includes('T') ? a.tanggal.split('T')[0] : a.tanggal;
            return aDate === dateStr;
        });

        if (agenda) {
            el.classList.add(`date-${getStatusClass(agenda.status)}`);
            el.title = agenda.agenda; // Tooltip nama agenda saat kursor di atas tanggal
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