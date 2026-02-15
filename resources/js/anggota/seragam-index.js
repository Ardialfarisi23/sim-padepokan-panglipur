/**
 * Logika Perhitungan Harga Otomatis
 */
window.hitungTotal = function() {
    const selectUkuran = document.getElementById('ukuranSelect');
    const inputJumlah = document.getElementById('jumlahInput');
    const displayTotal = document.getElementById('displayTotal');
    const inputHargaSatuan = document.getElementById('hargaSatuan');

    if (!selectUkuran || !inputJumlah || !displayTotal) return;

    const selectedOption = selectUkuran.options[selectUkuran.selectedIndex];
    
    // Proteksi jika user belum pilih ukuran
    if (selectedOption.value === "") {
        displayTotal.innerText = "0";
        return;
    }

    const hargaSatuan = parseInt(selectedOption.getAttribute('data-harga')) || 0;
    let jumlah = parseInt(inputJumlah.value) || 0;

    if (jumlah < 1) jumlah = 1;

    const total = hargaSatuan * jumlah;

    // Update Hidden Input & Tampilan
    if(inputHargaSatuan) inputHargaSatuan.value = hargaSatuan;
    displayTotal.innerText = total.toLocaleString('id-ID');

    // Efek Pop Animasi
    displayTotal.parentElement.style.transform = 'scale(1.1)';
    setTimeout(() => {
        displayTotal.parentElement.style.transform = 'scale(1)';
    }, 100);
}