@extends('layouts.public')


@section('content')
<section class="register-wrapper">
    <div class="register-box">
<a href="{{ url()->previous() }}" class="btn-back">
    <span class="btn-back-icon"><</span>
    <span>Kembali</span>
</a>
        <h2 class="register-title">Isi Data Diri untuk Mendaftar</h2>


        <p class="register-subtitle">
            Kami membuka kesempatan bagi calon pendekar muda yang ingin belajar
            Pencak Silat, memperkuat fisik dan mental, serta menjaga tradisi budaya bangsa.
        </p>


        <form action="{{ route('pendaftaran.store') }}" method="POST">
            @csrf
@if(session('success'))
    <div style="background:#dcfce7;color:#166534;padding:12px;border-radius:10px;margin-bottom:20px;">
        {{ session('success') }}
    </div>
@endif
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
            </div>


            <div class="form-row">
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" required>
                </div>


                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" required>
                </div>
            </div>


            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>


            <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea name="alamat" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
            </div>


            <div class="form-row">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email">
                </div>


                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" name="no_hp">
                </div>
            </div>


            <button type="submit" class="btn-submit">
                Kirim
            </button>


        </form>
    </div>
</section>
@if(session('success'))
<div id="successPopup" class="popup-overlay">
    <div class="popup-box">
        <h3>Pendaftaran Berhasil</h3>
        <p>{{ session('success') }}</p>
        <button onclick="closePopup()">Tutup</button>
    </div>
</div>
@endif


@endsection


<script>
function closePopup() {
    document.getElementById('successPopup').style.display = 'none';
}
</script>
