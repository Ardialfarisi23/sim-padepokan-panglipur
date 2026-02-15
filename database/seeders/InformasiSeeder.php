<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Informasi;
use Illuminate\Support\Str;

class InformasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'judul' => 'Latihan Rutin Mingguan',
                'ringkasan' => 'Latihan rutin dilaksanakan setiap minggu untuk meningkatkan kemampuan anggota.',
                'konten' => 'Isi lengkap informasi latihan rutin mingguan Laskar Panglipur.',
            ],
            [
                'judul' => 'Prestasi Kejuaraan Daerah',
                'ringkasan' => 'Laskar Panglipur berhasil meraih juara pada kejuaraan daerah.',
                'konten' => 'Isi lengkap berita prestasi kejuaraan daerah.',
            ],
            [
                'judul' => 'Penerimaan Anggota Baru',
                'ringkasan' => 'Pendaftaran anggota baru resmi dibuka untuk umum.',
                'konten' => 'Informasi lengkap penerimaan anggota baru.',
            ],
            [
                'judul' => 'Kegiatan Sosial',
                'ringkasan' => 'Laskar Panglipur mengadakan kegiatan sosial untuk masyarakat.',
                'konten' => 'Isi lengkap kegiatan sosial.',
            ],
            [
                'judul' => 'Agenda Latihan Khusus',
                'ringkasan' => 'Latihan khusus menjelang perlombaan besar.',
                'konten' => 'Detail agenda latihan khusus.',
            ],
            [
                'judul' => 'Pengumuman Libur Latihan',
                'ringkasan' => 'Latihan diliburkan sementara karena kegiatan tertentu.',
                'konten' => 'Pengumuman resmi libur latihan.',
            ],
        ];

        foreach ($data as $item) {
            Informasi::create([
                'judul' => $item['judul'],
                'slug' => Str::slug($item['judul']),
                'ringkasan' => $item['ringkasan'],
                'konten' => $item['konten'],
                'thumbnail' => null,
            ]);
        }
    }
}
