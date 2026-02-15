import "./bootstrap";
import "../css/app.css";
// Hati-hati: dashboard-agenda mungkin error juga jika tidak diproteksi
import './admin/dashboard-agenda'; 

import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

import AOS from "aos";
import "aos/dist/aos.css";

// Inisialisasi AOS di awal agar lebih aman
AOS.init({
    duration: 800,
    easing: "ease-in-out",
    once: false,
    mirror: true,
});

import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'

window.FullCalendar = { Calendar, dayGridPlugin }

document.addEventListener("DOMContentLoaded", function () {
    let calendarEl = document.getElementById("calendar");

    // PROTEKSI: Hanya jalankan jika elemen #calendar ditemukan (di halaman admin)
    if (calendarEl) {
        let calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin],
            initialView: "dayGridMonth",
            headerToolbar: {
                left: "prev",
                center: "title",
                right: "next",
            },
            datesSet(info) {
                // fetchAgenda juga hanya dipanggil jika kalender ada
                if (typeof fetchAgenda === 'function') {
                    fetchAgenda(info.startStr, info.endStr);
                }
            },
        });

        calendar.render();
    }
});

// fetchAgenda juga sebaiknya dicek agar tidak error saat dipanggil
function fetchAgenda(start, end) {
    fetch(`/admin/jadwal?start=${start}&end=${end}`)
        .then((res) => {
            if (!res.ok) throw new Error("Unauthorized or Not Found");
            return res.json();
        })
        .then((data) => {
            // Hanya jalankan jika fungsi renderAgendaList tersedia
            if (typeof renderAgendaList === 'function') {
                renderAgendaList(data);
            }
        })
        .catch(err => console.log("Agenda fetch skipped: ", err.message));
}