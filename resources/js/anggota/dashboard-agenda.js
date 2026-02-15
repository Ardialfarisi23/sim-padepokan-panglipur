/**
 * Laskar Panglipur Dashboard Agenda Logic (Anggota Side)
 */

let currentMonth = new Date().getMonth() + 1;
let currentYear = new Date().getFullYear();

document.addEventListener('DOMContentLoaded', function() {
    // 1. Inisialisasi awal
    fetchAgenda(currentMonth, currentYear);

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

function fetchAgenda(month, year) {
    // ENDPOINT UNTUK ANGGOTA
    const url = `/anggota/dashboard?month=${month}&year=${year}`;

    fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        // Update Label Bulan
        document.getElementById('display-month-year').innerText = data.month_name;

        // Update List Agenda (Kiri)
        const listContainer = document.getElementById('agenda-list-container');
        if (listContainer) {
            listContainer.innerHTML = data.html;
        }

        // Gambar Kalender (Kanan)
        renderCalendar(month, year, data.days_in_month, data.first_day, data.agenda);
    })
    .catch(error => console.error('Error fetching agenda:', error));
}

function renderCalendar(month, year, daysInMonth, firstDay, agendaList) {
    const grid = document.getElementById('calendar-grid');
    if (!grid) return;
    
    grid.innerHTML = '';

    // Offset: 7 (Minggu) di Carbon disesuaikan jadi 0 untuk kalender kita
    const offset = firstDay === 7 ? 0 : firstDay;

    for (let i = 0; i < offset; i++) {
        grid.appendChild(document.createElement('span'));
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const dateElement = document.createElement('span');
        dateElement.classList.add('cal-date');
        dateElement.innerText = day;

        const formattedDate = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        
        const agendaHariIni = agendaList.find(item => {
            const itemDate = item.tanggal.split('T')[0]; 
            return itemDate === formattedDate;
        });

        if (agendaHariIni) {
            const statusColor = getStatusColorClass(agendaHariIni.status);
            dateElement.classList.add(`date-${statusColor}`);
            dateElement.title = agendaHariIni.agenda;
        }

        // Highlight hari ini
        const today = new Date();
        if (day === today.getDate() && month === (today.getMonth() + 1) && year === today.getFullYear()) {
            dateElement.classList.add('date-today'); 
            // Tambahkan class khusus 'date-today' di CSS jika ingin border kuning
        }

        grid.appendChild(dateElement);
    }
}

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