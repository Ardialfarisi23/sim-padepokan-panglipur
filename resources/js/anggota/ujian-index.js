document.addEventListener('DOMContentLoaded', function() {
    const selectSabuk = document.getElementById('selectSabuk');
    const resultContent = document.getElementById('resultContent');
    const emptyState = document.getElementById('emptyStateUjian');

    selectSabuk.addEventListener('change', function() {
        const sabuk = this.value;
        
        fetch(`/anggota/hasil-ujian/detail/${sabuk}`)
            .then(response => response.json())
            .then(res => {
                if(res.success) {
                    const data = res.data;
                    const nilai = data.rincian_nilai;

                    // Update Info Utama
                    document.getElementById('tglUjian').innerText = data.tanggal_ujian;
                    document.getElementById('namaPenguji').innerText = data.penguji;
                    document.getElementById('minNilai').innerText = data.nilai_minimum;
                    document.getElementById('totalNilai').innerText = data.total_nilai;

                    // Update Table
                    const rows = [
                        ['Teknik Dasar', nilai.teknik_dasar],
                        ['Jurus Wajib', nilai.jurus_wajib],
                        ['Jurus Tambahan', nilai.jurus_tambahan],
                        ['Seni', nilai.seni],
                        ['Tanding', nilai.tanding],
                        ['Fisik', nilai.fisik],
                        ['Mental Sikap', nilai.mental_sikap],
                        ['Teori', nilai.teori]
                    ];

                    let htmlRows = '';
                    rows.forEach(row => {
                        htmlRows += `<tr><td>${row[0]}</td><td class="text-center">${row[1]}</td></tr>`;
                    });
                    document.getElementById('tableBodyNilai').innerHTML = htmlRows;

                    // Update Badge Status
                    const badge = document.getElementById('statusBadge');
                    badge.innerText = data.status.toUpperCase();
                    badge.className = 'status-lulus-badge ' + (data.status === 'lulus' ? 'status-lulus' : 'status-tidak');

                    // Switch View
                    resultContent.style.display = 'block';
                    emptyState.style.display = 'none';
                }
            });
    });
});