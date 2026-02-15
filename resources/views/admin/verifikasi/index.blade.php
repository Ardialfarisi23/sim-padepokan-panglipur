@extends('admin.layouts.admin')

@vite(['resources/css/admin/verifikasi-page.css', 'resources/js/admin/verifikasi-index.js'])

@section('content')
<div class="pg-verifikasi-wrapper">
    <div class="pg-verifikasi-header">
        <h2 class="pg-verifikasi-title">Verifikasi Pendaftaran</h2>
        <p class="pg-verifikasi-subtitle">Proses calon anggota baru untuk menjadi bagian dari Laskar Panglipur</p>
    </div>

    <div class="pg-verifikasi-table-container">
        <table class="pg-verifikasi-table">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat, Tgl Lahir</th>
                    <th>Alamat</th>
                    <th>Kontak</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendaftar as $item)
                <tr>
                    <td><strong>{{ $item->nama_lengkap }}</strong></td>
                    <td>{{ $item->jenis_kelamin == 'laki_laki' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d/m/Y') }}</td>
                    <td class="cell-truncate" title="{{ $item->alamat }}">{{ $item->alamat }}</td>
                    <td>
                        <div class="contact-info">
                            <span><i class="material-symbols-rounded">mail</i> {{ $item->email }}</span>
                            <span><i class="material-symbols-rounded">call</i> {{ $item->no_telepon }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="pg-verifikasi-actions">
                            {{-- Tombol Konfirmasi --}}
                            <button type="button" class="btn-action-circle btn-approve btn-verif-trigger" 
                                data-id="{{ $item->id }}" 
                                data-nama="{{ $item->nama_lengkap }}">
                                <span class="material-symbols-rounded">check_circle</span>
                            </button>

                            {{-- Tombol Tolak --}}
                            <button type="button" class="btn-action-circle btn-reject btn-reject-trigger" 
                                data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama_lengkap }}">
                                <span class="material-symbols-rounded">cancel</span>
                            </button>
                        </div>

                        {{-- Form Hidden untuk Aksi --}}
                        <form id="form-verif-{{ $item->id }}" action="{{ route('admin.verifikasi.konfirmasi', $item->id) }}" method="POST" style="display:none;">
                            @csrf
                        </form>
                        <form id="form-reject-{{ $item->id }}" action="{{ route('admin.verifikasi.tolak', $item->id) }}" method="POST" style="display:none;">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="empty-state">
                            <span class="material-symbols-rounded">person_search</span>
                            <p>Tidak ada pendaftaran baru yang perlu diverifikasi.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/js/admin/verifikasi-index.js'])
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    html: `{!! session('success') !!}`,
                    confirmButtonColor: '#28a745'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ session('error') }}",
                });
            @endif
        });
    </script>
@endpush
@endsection