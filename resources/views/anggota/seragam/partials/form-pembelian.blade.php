<form action="{{ route('anggota.seragam.store') }}" method="POST" id="formOrderSeragam">
    @csrf
    <div class="order-form-grid">
        <div class="input-box">
            <label>Nama Lengkap</label>
            <div class="input-readonly">
                <span class="material-symbols-rounded">person</span>
                <input type="text" value="{{ $anggota->nama_lengkap }}" readonly>
            </div>
        </div>

        <div class="input-box">
    <label>Jenis Kelamin</label>
    <div class="input-readonly">
        {{-- Ikon otomatis berubah sesuai gender --}}
        <span class="material-symbols-rounded">
            {{ $anggota->jenis_kelamin == 'laki_laki' ? 'man' : 'woman' }}
        </span>
        
        <input type="text" 
               value="{{ $anggota->jenis_kelamin == 'laki_laki' ? 'Laki - laki' : 'Perempuan' }}" 
               readonly>
    </div>
</div>

        <div class="input-box">
            <label for="ukuran">Pilih Ukuran</label>
            <div class="input-wrapper">
                <span class="material-symbols-rounded">straighten</span>
                <select name="ukuran" id="ukuranSelect" required onchange="hitungTotal()">
                    <option value="" disabled selected>Pilih Ukuran Seragam</option>
                    <option value="S" data-harga="150000">Ukuran S - Rp 150.000</option>
                    <option value="M" data-harga="155000">Ukuran M - Rp 155.000</option>
                    <option value="L" data-harga="160000">Ukuran L - Rp 160.000</option>
                    <option value="XL" data-harga="165000">Ukuran XL - Rp 165.000</option>
                    <option value="XXL" data-harga="175000">Ukuran XXL - Rp 175.000</option>
                </select>
            </div>
        </div>

        <div class="input-box">
            <label for="jumlah">Jumlah</label>
            <div class="input-wrapper">
                <span class="material-symbols-rounded">production_quantity_limits</span>
                <input type="number" name="jumlah" id="jumlahInput" value="1" min="1" required oninput="hitungTotal()">
            </div>
        </div>

        <div class="total-summary-card">
            <input type="hidden" name="harga" id="hargaSatuan">
            <div class="total-label">Estimasi Total Pembayaran:</div>
            <div class="total-value">Rp <span id="displayTotal">0</span></div>
        </div>

        <button type="submit" class="btn-submit-order">
            <span>Ajukan Pembelian Seragam</span>
            <span class="material-symbols-rounded">send</span>
        </button>
    </div>
</form>