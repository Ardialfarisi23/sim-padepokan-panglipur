-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Feb 2026 pada 16.23
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laskar_panglipur`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenis_kelamin` enum('laki_laki','perempuan') NOT NULL,
  `status` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif',
  `email` varchar(100) DEFAULT NULL,
  `tingkat` enum('putih','kuning','hijau','merah','hitam') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id`, `user_id`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_telepon`, `created_at`, `updated_at`, `jenis_kelamin`, `status`, `email`, `tingkat`) VALUES
(1, 201, 'Andi Wijaya', 'Yogyakarta', '2005-03-12', 'Jl. Malioboro No. 21, Yogyakarta', '081233445566', '2025-12-31 16:38:32', '2026-02-03 05:33:33', 'laki_laki', 'aktif', 'andi@email.com', 'hijau'),
(2, 202, 'Siti Aminah', 'Semarang', '2007-07-22', 'Jl. Pandanaran No. 5, Semarang', '085711223344', '2025-12-31 16:38:32', '2026-02-03 04:55:34', 'perempuan', 'aktif', 'siti@email.com', 'hijau'),
(4, 204, 'Asep Sunandar', 'Garut', '2006-05-10', 'Jl. Ahmad Yani No. 12, Tarogong Kidul, Garut', '081223344550', '2026-01-31 08:15:41', '2026-01-31 08:15:41', 'laki_laki', 'aktif', 'asep@email.com', 'hijau'),
(5, 205, 'Cecep Mulyana', 'Garut', '2008-01-15', 'Kp. Cimuncang, Wanaraja, Garut', '081334455661', '2026-01-31 08:15:41', '2026-02-03 05:21:52', 'laki_laki', 'aktif', 'cecep@email.com', 'hijau'),
(6, 206, 'Neng Fitri', 'Garut', '2007-09-20', 'Jl. Raya Bayongbong, Garut', '085778899002', '2026-01-31 08:15:41', '2026-02-03 04:25:50', 'perempuan', 'aktif', 'fitri@email.com', 'putih'),
(7, 207, 'Dadang Konelo', 'Garut', '2004-12-25', 'Jl. Cimanuk, Jayaraga, Garut', '081299001122', '2026-01-31 08:15:41', '2026-02-03 05:02:35', 'laki_laki', 'aktif', 'dadang@email.com', 'hitam'),
(11, 1, 'Budi Santoso', 'Surabaya', '1991-01-15', 'Jl. Pahlawan No. 22, Surabaya', '085612345678', '2026-01-31 08:16:54', '2026-01-31 07:30:30', 'laki_laki', 'aktif', 'budi@example.com', 'hijau'),
(12, 1, 'Dewi Lestari', 'Yogyakarta', '2000-11-30', 'Jl. Malioboro No. 45, DIY', '087755554444', '2026-01-31 08:16:54', '2026-01-31 08:16:54', 'perempuan', 'aktif', 'dewi@example.com', 'putih'),
(13, 1, 'Rian Hidayat', 'Malang', '1993-03-25', 'Jl. Ijen No. 12, Malang', '081399887766', '2026-01-31 08:16:54', '2026-01-31 08:16:54', 'laki_laki', 'aktif', 'rian@example.com', 'merah'),
(14, 1, 'Putri Indah', 'Semarang', '1997-07-07', 'Jl. Pandanaran No. 8, Semarang', '082211223344', '2026-01-31 08:16:54', '2026-01-31 08:16:54', 'perempuan', 'aktif', 'putri@example.com', 'hijau'),
(15, 1, 'Eko Prasetyo', 'Medan', '1992-12-12', 'Jl. Gatot Subroto No. 3, Medan', '085266778899', '2026-01-31 08:16:54', '2026-02-03 04:19:20', 'laki_laki', 'aktif', 'eko@example.com', 'hijau'),
(16, 1, 'Maya Sari', 'Denpasar', '1999-04-02', 'Jl. Sunset Road No. 100, Bali', '081900112233', '2026-01-31 08:16:54', '2026-02-03 04:50:00', 'perempuan', 'aktif', 'maya@example.com', 'kuning'),
(18, 1, 'Lani Rahmawati', 'Palembang', '1994-06-10', 'Jl. Ampera No. 7, Palembang', '087833445566', '2026-01-31 08:16:54', '2026-01-31 03:40:31', 'perempuan', 'aktif', 'lani1@example.com', 'merah'),
(19, 1, 'Dedi Kurniawan', 'Solo', '1991-02-28', 'Jl. Slamet Riyadi No. 15, Solo', '081288990011', '2026-01-31 08:16:54', '2026-01-31 08:16:54', 'laki_laki', 'aktif', 'dedi@example.com', 'hijau'),
(20, 1, 'Anisa Fitri', 'Bogor', '2001-10-05', 'Jl. Pajajaran No. 9, Bogor', '085777889900', '2026-01-31 08:16:54', '2026-01-31 08:16:54', 'perempuan', 'aktif', 'anisa@example.com', 'putih'),
(21, 1, 'Fajar Nugraha', 'Tangerang', '1995-12-25', 'Jl. Serpong No. 50, Tangerang', '081311223344', '2026-01-31 08:16:54', '2026-01-31 08:16:54', 'laki_laki', 'aktif', 'fajar@example.com', 'kuning'),
(22, 1, 'Hana Wijaya', 'Bekasi', '1998-03-14', 'Jl. Ahmad Yani No. 12, Bekasi', '082155667788', '2026-01-31 08:16:54', '2026-01-31 08:16:54', 'perempuan', 'aktif', 'hana@example.com', 'merah'),
(24, 4, 'Ardi Alfarisi', 'Bandung', '2004-02-23', 'Jalan raya Lapangsari, Kampung Lapangsari RT 01 RW 18, Desa Cibeureum, Kecmatan Kertasari\r\nKabupaten Bandung, Provinsi Jawa Barat Indonesia', '083149322332', '2026-02-03 09:22:42', '2026-02-03 09:22:42', 'laki_laki', 'aktif', 'ardialfarisikece@gmail.com', 'putih');

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
--

CREATE TABLE `informasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `ringkasan` text NOT NULL,
  `konten` longtext NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `informasi`
--

INSERT INTO `informasi` (`id`, `judul`, `slug`, `ringkasan`, `konten`, `thumbnail`, `created_at`, `updated_at`) VALUES
(1, 'Laskar Panglipur Berpartisipasi dalam kegiatan National Day ‘Arriving In Harmony’', 'laskar-panglipur-national-day', 'ini menjadi moment yang membanggakan untuk padepokan karena ini merupakan ajang pertama bertaraf internasional padepokan di 2025.', 'Laskar Panglipur berpartisipasi dalam kegiatan National Day bertajuk “Arriving In Harmony” yang digelar sebagai bagian dari perayaan berskala internasional. Keikutsertaan ini menjadi momen yang membanggakan bagi Padepokan Panglipur, mengingat ajang tersebut merupakan penampilan perdana padepokan di tingkat internasional pada tahun 2025.\r\n\r\nDalam kegiatan tersebut, Laskar Panglipur menampilkan seni bela diri pencak silat yang memadukan unsur teknik, seni gerak, dan nilai filosofi budaya. Penampilan ini mendapat perhatian dari para peserta dan pengunjung yang hadir, sekaligus menjadi sarana memperkenalkan pencak silat Panglipur sebagai bagian dari kekayaan budaya Indonesia di kancah global.\r\n\r\nPartisipasi Laskar Panglipur dalam event internasional ini diharapkan dapat membuka peluang kolaborasi budaya serta meningkatkan eksistensi padepokan di tingkat nasional maupun internasional. Selain menjadi ajang unjuk prestasi, kegiatan ini juga menjadi langkah awal Padepokan Panglipur dalam memperluas perannya sebagai pelestari seni bela diri tradisional Indonesia.', 'informasi/info2.jpg', '2025-12-24 01:33:37', '2025-12-24 01:33:37'),
(2, 'Laskar Panglipur Sumbang Atlet Pencak SIlat dalam kejuaran Sea Games Thailand 2025', 'laskar-panglipur-emas-sea-games-2025', 'sebanyak 25 Atlet dari laskar panglipur ikut berpartisipasi dalam ajang bergengsi 2 tahunan tersebut, yang mana membuat harum nama padepokan agar terlihar di mata asia tenggara.', 'Laskar Panglipur menyumbangkan atlet pencak silat dalam ajang SEA Games Thailand 2025. Sebanyak 25 atlet dari Laskar Panglipur turut berpartisipasi dalam kejuaraan bergengsi dua tahunan tersebut, menjadi representasi penting dalam mengharumkan nama padepokan di tingkat Asia Tenggara.\r\n\r\nKeikutsertaan para atlet ini merupakan hasil dari proses pembinaan dan latihan berkelanjutan yang dilakukan Padepokan Panglipur. Para atlet tidak hanya membawa kemampuan teknik dan fisik, tetapi juga menjunjung tinggi nilai sportivitas, disiplin, serta filosofi pencak silat sebagai warisan budaya bangsa Indonesia.\r\n\r\nPartisipasi Laskar Panglipur dalam SEA Games 2025 diharapkan dapat memperkuat eksistensi padepokan di kancah internasional serta meningkatkan kepercayaan dunia terhadap kualitas atlet pencak silat Indonesia. Capaian ini sekaligus menjadi kebanggaan tersendiri bagi padepokan dan motivasi untuk terus berkontribusi dalam prestasi olahraga pencak silat di tingkat regional maupun global.', 'informasi/info3.jpg', '2025-12-24 01:33:37', '2025-12-24 01:33:37'),
(3, 'Laskar Panglipur Sabet Medali Emas di Kejuarann POMNAS 2025 Jawa Tengah', 'laskar-panglipur-emas-pomnas-2025', 'Laskar Panglipur Garut Kembali sabet medali medali emas berturut - turut untuk 2 edisi POMNAS berbeda.', 'Laskar Panglipur Garut kembali menorehkan prestasi membanggakan dengan meraih medali emas dalam Kejuaraan Pekan Olahraga Mahasiswa Nasional (POMNAS) 2025 yang digelar di Jawa Tengah. Capaian ini menegaskan konsistensi Laskar Panglipur sebagai salah satu padepokan pencak silat berprestasi di tingkat nasional.\r\n\r\nKeberhasilan tersebut melanjutkan tren positif Laskar Panglipur yang mampu menyabet medali emas secara berturut-turut dalam dua edisi POMNAS yang berbeda. Prestasi ini merupakan hasil dari pembinaan atlet yang terstruktur, latihan disiplin, serta dukungan penuh dari padepokan dalam mengembangkan potensi atlet pencak silat di kalangan mahasiswa.\r\n\r\nRaihan medali emas ini tidak hanya menjadi kebanggaan bagi Laskar Panglipur Garut, tetapi juga mengharumkan nama daerah dan pencak silat Indonesia. Pencapaian tersebut diharapkan dapat menjadi motivasi bagi para atlet muda untuk terus berprestasi dan membawa pencak silat Indonesia semakin diperhitungkan di kancah nasional maupun internasional.', 'informasi/info4.jpg', '2025-12-24 01:33:37', '2025-12-24 01:33:37'),
(4, 'Atlet Laskar Panglipur Tampil Memuaskan di Ajang bergengsi Sea Games Thailand 2025', 'laskar-panglipur-sea-games-thailand-2025', 'Sebanyak 25 Atlet dari laskar panglipur ikut berpartisipasi dalam kegiatan tersebut, mereka menyumbang 2 medali perunggu dan 5 medali perak di cabang pencak silat.', 'Atlet Laskar Panglipur menunjukkan performa memuaskan dalam ajang bergengsi SEA Games Thailand 2025. Sebanyak 25 atlet dari Laskar Panglipur turut ambil bagian dalam kompetisi tersebut dan berhasil memberikan kontribusi nyata bagi pencak silat Indonesia di tingkat Asia Tenggara.\r\n\r\nDalam kejuaraan ini, para atlet Laskar Panglipur sukses menyumbangkan total tujuh medali pada cabang olahraga pencak silat, terdiri dari dua medali perunggu dan lima medali perak. Raihan tersebut mencerminkan kemampuan teknis, ketangguhan mental, serta kesiapan atlet dalam menghadapi persaingan ketat di level internasional.\r\n\r\nCapaian ini menjadi kebanggaan tersendiri bagi Laskar Panglipur sekaligus membuktikan kualitas pembinaan atlet yang dilakukan padepokan. Prestasi tersebut diharapkan dapat menjadi motivasi untuk terus meningkatkan prestasi dan membawa pencak silat Indonesia semakin diperhitungkan di ajang olahraga internasional.', 'informasi/info5.jpg', '2025-12-24 01:33:38', '2025-12-24 01:33:38'),
(5, 'Laskar Panglipur Berpartisipasi dalam kegiatan National Day ‘Arriving In Harmony’', 'arriving-in-harmony', 'ini menjadi moment yang membanggakan untuk padepokan karena ini merupakan ajang pertama bertaraf internasional padepokan di 2025.', 'Laskar Panglipur berpartisipasi dalam kegiatan National Day bertajuk “Arriving In Harmony” yang digelar sebagai bagian dari perayaan berskala internasional. Keikutsertaan ini menjadi momen yang membanggakan bagi Padepokan Panglipur, mengingat ajang tersebut merupakan penampilan perdana padepokan di tingkat internasional pada tahun 2025.\r\n\r\nDalam kegiatan tersebut, Laskar Panglipur menampilkan seni bela diri pencak silat yang memadukan unsur teknik, seni gerak, dan nilai filosofi budaya. Penampilan ini mendapat perhatian dari para peserta dan pengunjung yang hadir, sekaligus menjadi sarana memperkenalkan pencak silat Panglipur sebagai bagian dari kekayaan budaya Indonesia di kancah global.\r\n\r\nPartisipasi Laskar Panglipur dalam event internasional ini diharapkan dapat membuka peluang kolaborasi budaya serta meningkatkan eksistensi padepokan di tingkat nasional maupun internasional. Selain menjadi ajang unjuk prestasi, kegiatan ini juga menjadi langkah awal Padepokan Panglipur dalam memperluas perannya sebagai pelestari seni bela diri tradisional Indonesia.', 'informasi/info6.jpg', '2025-12-24 01:33:38', '2025-12-24 01:33:38'),
(6, 'Laskar Panglipur Bawa Nama Garut Tampil di Event Internasional', 'laskar-panglipur-bawa-garut-internasional', 'Tampil di event kesenian bela diri pencak silat di Dubai, Uni Emirat Arab pada Bulan Februari Tahun 2025', 'Seni bela diri pencak silat Laskar Panglipur Garut tampil dalam sebuah event kesenian bela diri internasional yang digelar di Dubai, Uni Emirat Arab, pada Februari 2025. Penampilan tersebut menjadi momen penting dalam memperkenalkan pencak silat sebagai warisan budaya Indonesia kepada masyarakat dunia serta menunjukkan eksistensinya di kancah internasional.\r\n\r\nDalam event tersebut, pencak silat ditampilkan melalui rangkaian gerak yang menggabungkan unsur ketangkasan, seni, dan filosofi luhur. Penampilan ini berhasil menarik perhatian para pengunjung dan peserta dari berbagai negara, sekaligus menjadi sarana promosi budaya Indonesia melalui jalur seni dan olahraga tradisional.\r\n\r\nKeikutsertaan dalam ajang internasional ini diharapkan mampu meningkatkan apresiasi global terhadap pencak silat, sekaligus memperkuat citra Indonesia sebagai negara yang kaya akan seni, budaya, dan tradisi.\r\nSelain itu, kehadiran pencak silat di panggung dunia juga menjadi bentuk diplomasi budaya yang mempererat hubungan antarbangsa.', 'informasi/info1.jpg', '2025-12-25 11:09:54', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `agenda` varchar(255) NOT NULL,
  `status` enum('latihan','nasional','internasional','lainnya') NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `tanggal`, `lokasi`, `created_at`, `updated_at`, `agenda`, `status`, `keterangan`) VALUES
(1, '2025-12-28', 'Padepokan Laskar Panglipur', NULL, NULL, 'Latihan Rutin', 'latihan', 'Latihan kuda kuda dasar'),
(2, '2026-01-07', 'Bekasi', NULL, NULL, 'Kejuaraan Pencak Silat Nasional', 'nasional', 'Target Medali Emas'),
(4, '2026-01-17', 'Shanghai', NULL, NULL, 'Asian Games Shanghai 2032', 'internasional', 'Asian Games Shanghai 2032'),
(5, '2026-01-05', 'Padepokan Pusat', '2026-01-31 08:12:27', '2026-01-31 08:12:27', 'Latihan Rutin Mingguan', 'latihan', 'Fokus pada teknik dasar pernapasan'),
(6, '2026-01-12', 'Gedung Serbaguna', '2026-01-31 08:12:27', '2026-01-31 08:12:27', 'Persiapan Seleksi Daerah', 'latihan', 'Latihan fisik intensif untuk calon atlet'),
(7, '2026-01-15', 'Stadion Utama Gelora', '2026-01-31 08:12:27', '2026-01-31 08:12:27', 'Kejuaraan Nasional IPSI', 'nasional', 'Turnamen tingkat nasional antar perguruan'),
(8, '2026-01-20', 'Ruang Rapat Utama', '2026-01-31 08:12:27', '2026-01-31 08:12:27', 'Rapat Koordinasi Pengurus', 'lainnya', 'Membahas program kerja tahun 2026'),
(9, '2026-01-28', 'Kuala Lumpur, Malaysia', '2026-01-31 08:12:27', '2026-01-31 08:12:27', 'International Silat Open', 'internasional', 'Kejuaraan silat internasional undangan'),
(10, '2026-02-02', 'Padepokan Pusat Wanaraja', '2026-01-31 08:12:27', '2026-01-31 12:38:17', 'Ujian Kenaikan Tingkat', 'latihan', 'Evaluasi sabuk hijau ke biru'),
(11, '2026-02-10', 'Aula Kecamatan', '2026-01-31 08:12:27', '2026-01-31 11:46:59', 'Workshop Teknik Beladiri', 'lainnya', 'Terbuka untuk umum dan anggota'),
(12, '2026-02-14', 'Jakarta Convention Center', '2026-01-31 08:12:27', '2026-01-31 08:12:27', 'Grand Slam Pencak Silat', 'nasional', 'Pertandingan ekshibisi nasional'),
(13, '2026-02-22', 'Singapura', '2026-01-31 08:12:27', '2026-01-31 08:12:27', 'Lion City Championship', 'internasional', 'Turnamen internasional tahunan'),
(14, '2026-02-25', 'Area Parkir Padepokan', '2026-01-31 08:12:27', '2026-01-31 08:12:27', 'Kerja Bakti Massal', 'lainnya', 'Pembersihan area latihan bersama'),
(15, '2026-02-15', 'Padepokan Laskar Panglipur', '2026-01-31 10:20:42', '2026-01-31 10:20:42', 'Latihan Gabungan Panglipur', 'latihan', 'Latihan Kebugaran'),
(16, '2026-02-21', 'IPI Garut', '2026-01-31 10:24:00', '2026-01-31 10:24:00', 'Kejuaraan IPI Garut', 'nasional', 'Tingkat Nasional'),
(18, '2026-06-16', 'IPI Garut', '2026-01-31 12:27:19', '2026-01-31 12:27:19', 'Kejuaraan IPI Garut', 'internasional', 'lomba'),
(19, '2026-02-13', 'Alun - Alun Garut', '2026-01-31 12:34:44', '2026-01-31 12:34:44', 'Latihan Gabungan Panglipur', 'latihan', 'latihan fisik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keuangan`
--

CREATE TABLE `keuangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `periode_bulan` tinyint(2) NOT NULL,
  `periode_tahun` year(4) NOT NULL,
  `saldo_awal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_pemasukan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_pengeluaran` decimal(15,2) NOT NULL DEFAULT 0.00,
  `saldo_akhir` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `keuangan`
--

INSERT INTO `keuangan` (`id`, `periode_bulan`, `periode_tahun`, `saldo_awal`, `total_pemasukan`, `total_pengeluaran`, `saldo_akhir`, `created_at`, `updated_at`) VALUES
(1, 1, '2026', 0.00, 8000000.00, 7000000.00, 1000000.00, '2026-02-01 08:40:06', '2026-02-01 09:53:11'),
(2, 2, '2026', 1000000.00, 20000000.00, 20050000.00, 950000.00, '2026-02-01 08:40:06', '2026-02-01 10:42:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logistik`
--

CREATE TABLE `logistik` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `kondisi` enum('baik','rusak') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `logistik`
--

INSERT INTO `logistik` (`id`, `nama_barang`, `jumlah`, `satuan`, `kondisi`, `created_at`, `updated_at`) VALUES
(7, 'Body Protector Size M', 10, 'Pcs', 'baik', '2026-01-31 15:01:58', '2026-01-31 08:20:44'),
(8, 'Body Protector Size L', 8, 'Pcs', 'baik', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(9, 'Pecing Pad Standar', 15, 'Buah', 'baik', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(10, 'Pecing Pad Jumbo', 5, 'Buah', 'rusak', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(11, 'Samsak Gantung 120cm', 4, 'Set', 'baik', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(12, 'Target Double Kicking', 12, 'Buah', 'baik', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(13, 'Matras Puzzle Hitam', 50, 'Lembar', 'baik', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(14, 'Matras Puzzle Hijau', 40, 'Lembar', 'rusak', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(15, 'Head Guard Merah', 6, 'Pcs', 'baik', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(16, 'Head Guard Biru', 6, 'Pcs', 'baik', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(17, 'Shin Guard (Pelindung Tulang Kering)', 20, 'Pasang', 'baik', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(18, 'Hand Glove Silat', 15, 'Pasang', 'rusak', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(19, 'Golok Seni Standar', 5, 'Bilah', 'baik', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(20, 'Toya Rotan Pilihan', 25, 'Batang', 'baik', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(21, 'Seragam Latihan Pemula', 30, 'Stel', 'baik', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(22, 'Sabuk Putih Standar', 100, 'Pcs', 'baik', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(23, 'Sabuk Hijau Standar', 20, 'Pcs', 'baik', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(24, 'Papan Pecah Ujian', 50, 'Keping', 'baik', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(25, 'Kabel Roll (Inventaris Event)', 3, 'Unit', 'rusak', '2026-01-31 15:01:58', '2026-01-31 15:01:58'),
(26, 'Sound System Portable', 1, 'Set', 'baik', '2026-01-31 15:01:58', '2026-01-31 15:01:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_ujian`
--

CREATE TABLE `nilai_ujian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ujian_id` bigint(20) UNSIGNED NOT NULL,
  `teknik_dasar` int(11) DEFAULT 0,
  `jurus_wajib` int(11) DEFAULT 0,
  `jurus_tambahan` int(11) DEFAULT 0,
  `seni` int(11) DEFAULT 0,
  `tanding` int(11) DEFAULT 0,
  `fisik` int(11) DEFAULT 0,
  `mental_sikap` int(11) DEFAULT 0,
  `teori` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai_ujian`
--

INSERT INTO `nilai_ujian` (`id`, `ujian_id`, `teknik_dasar`, `jurus_wajib`, `jurus_tambahan`, `seni`, `tanding`, `fisik`, `mental_sikap`, `teori`, `created_at`, `updated_at`) VALUES
(2, 2, 50, 50, 40, 60, 55, 60, 55, 50, '2026-02-02 11:24:22', '2026-02-02 11:24:22'),
(6, 6, 70, 70, 89, 76, 67, 89, 76, 63, '2026-02-03 03:09:15', '2026-02-03 03:09:15'),
(7, 7, 80, 80, 80, 60, 80, 80, 80, 80, '2026-02-03 04:18:41', '2026-02-03 04:18:41'),
(8, 8, 70, 70, 89, 76, 67, 89, 76, 63, '2026-02-03 04:19:20', '2026-02-03 04:19:20'),
(13, 13, 80, 80, 80, 80, 80, 80, 80, 80, '2026-02-03 04:50:00', '2026-02-03 04:50:00'),
(14, 14, 50, 50, 50, 50, 50, 50, 50, 50, '2026-02-03 04:50:53', '2026-02-03 04:50:53'),
(15, 15, 100, 100, 100, 100, 100, 100, 100, 100, '2026-02-03 04:55:34', '2026-02-03 04:55:34'),
(16, 16, 100, 100, 100, 100, 100, 100, 100, 100, '2026-02-03 05:02:35', '2026-02-03 05:02:35'),
(17, 17, 100, 100, 100, 100, 100, 100, 100, 0, '2026-02-03 05:20:31', '2026-02-03 05:33:33'),
(18, 18, 80, 80, 80, 80, 80, 80, 80, 80, '2026-02-03 05:21:52', '2026-02-03 05:21:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelatih`
--

CREATE TABLE `pelatih` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jenis_kelamin` enum('laki_laki','perempuan') NOT NULL,
  `tingkat` enum('putih','kuning','hijau','merah','hitam') DEFAULT 'hitam',
  `usia` int(11) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelatih`
--

INSERT INTO `pelatih` (`id`, `email`, `created_at`, `updated_at`, `nama_lengkap`, `jenis_kelamin`, `tingkat`, `usia`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_telepon`) VALUES
(1, 'asep.putih@email.com', '2026-01-31 11:44:13', '2026-01-31 07:26:46', 'Asep Sunandar', 'laki_laki', 'putih', 19, 'Garut', '2006-05-10', 'Jl. Raya Cipanas No. 12, Tarogong Kaler, Garut', '081234567890'),
(2, 'siti.kuning@email.com', '2026-01-31 11:44:13', '2026-01-31 06:45:13', 'Siti Aminah', 'perempuan', 'kuning', 21, 'Garut', '2004-08-15', 'Kp. Nagrog, Desa Rancabango, Tarogong Kaler, Garut', '082122334455'),
(3, 'dadang.hijau@email.com', '2026-01-31 11:44:13', '2026-01-31 11:44:13', 'Dadang Hermawan', 'laki_laki', 'hijau', 25, 'Garut', '2001-01-20', 'Perumahan Kadungora Indah Blok C, Kadungora, Garut', '085711223344'),
(4, 'nina.merah@email.com', '2026-01-31 11:44:13', '2026-01-31 11:44:13', 'Nina Marlina', 'perempuan', 'merah', 28, 'Garut', '1998-11-05', 'Jl. Papandayan No. 45, Kota Kulon, Garut Kota', '089988776655'),
(5, 'yudi.hitam@email.com', '2026-01-31 11:44:13', '2026-01-31 11:44:13', 'Yudi Guntara', 'laki_laki', 'hitam', 35, 'Garut', '1991-03-12', 'Jl. Ahmad Yani No. 88, Pengkolan, Garut Kota', '081122233344');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `keuangan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `sumber` varchar(255) NOT NULL,
  `metode` varchar(100) NOT NULL,
  `nominal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemasukan`
--

INSERT INTO `pemasukan` (`id`, `keuangan_id`, `tanggal`, `sumber`, `metode`, `nominal`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-01-05', 'Gaji Bulanan', 'Transfer', 8000000.00, 'Gaji pokok Januari', '2026-02-01 08:40:14', '2026-02-01 08:40:14'),
(4, 2, '2026-02-15', 'Hasil Penjualan Online', 'Transfer', 5000000.00, 'Penjualan barang hobi', '2026-02-01 08:40:14', '2026-02-01 09:53:00'),
(6, 2, '2026-02-01', 'Hadiah Perlombaan', 'Transfer', 5000000.00, NULL, '2026-02-01 08:57:31', '2026-02-01 09:30:09'),
(7, 2, '2026-02-01', 'Hadiah Perlombaan', 'Transfer', 10000000.00, NULL, '2026-02-01 09:21:48', '2026-02-01 09:29:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `keuangan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `metode` varchar(100) NOT NULL,
  `nominal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `keuangan_id`, `tanggal`, `keperluan`, `metode`, `nominal`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-01-07', 'Bayar Kos', 'Transfer', 2000000.00, 'Kos bulan Januari', '2026-02-01 08:40:23', '2026-02-01 08:40:23'),
(2, 1, '2026-01-10', 'Belanja Bulanan', 'Cash', 3000000.00, 'Kebutuhan pokok', '2026-02-01 08:40:23', '2026-02-01 08:40:23'),
(3, 1, '2026-01-25', 'Cicilan Motor', 'Transfer', 2000000.00, 'Cicilan ke-10', '2026-02-01 08:40:23', '2026-02-01 08:40:23'),
(4, 2, '2026-02-07', 'Bayar Kos', 'Transfer', 2000000.00, 'Kos bulan Februari', '2026-02-01 08:40:23', '2026-02-01 08:40:23'),
(5, 2, '2026-02-12', 'Service Mobil', 'Transfer', 4000000.00, 'Ganti oli dan ban', '2026-02-01 08:40:23', '2026-02-01 08:40:23'),
(6, 2, '2026-02-28', 'Makan & Hiburan', 'Cash', 3000000.00, 'Akumulasi makan sebulan', '2026-02-01 08:40:23', '2026-02-01 08:40:23'),
(7, 2, '2026-02-01', 'Transportasi', 'Cash', 5000.00, NULL, '2026-02-01 08:59:05', '2026-02-01 08:59:05'),
(8, 2, '2026-02-01', 'Uang Pendaftaran', 'Cash', 995000.00, NULL, '2026-02-01 09:53:46', '2026-02-01 09:53:46'),
(9, 2, '2026-02-01', 'Jalan Jalan', 'Cash', 50000.00, NULL, '2026-02-01 09:56:11', '2026-02-01 09:56:11'),
(10, 2, '2026-02-01', 'Iuran Padepokan', 'Cash', 10000000.00, NULL, '2026-02-01 10:42:53', '2026-02-01 10:42:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasi`
--

CREATE TABLE `prestasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `ringkasan` text DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `kategori` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `prestasi`
--

INSERT INTO `prestasi` (`id`, `judul`, `slug`, `ringkasan`, `thumbnail`, `kategori`, `tanggal`, `created_at`, `updated_at`) VALUES
(2, 'Laskar Panglipur Sabet Medali Emas di Kejuarann POMNAS 2025 Jawa Tengah', 'emas-pomnas-2025-jawa-tengah', 'Laskar Panglipur Garut Kembali sabet medali medali emas berturut - turut untuk 2 edisi POMNAS berbeda.', 'prestasi/prestasi1.jpg', 'Nasional', '2024-10-10', '2025-12-24 18:21:12', '2025-12-24 18:21:12'),
(4, 'Laskar Panglipur Sabet Medali Emas di\r\nKejuarann POMNAS 2025 Jawa Tengah', 'emas-pomnas-2024-jawa-tengah', 'Laskar Panglipur Garut Kembali sabet medali medali emas berturut - turut\r\nuntuk 2 edisi POMNAS berbeda.', 'prestasi/prestasi2.jpeg', 'Nasional', '2024-10-11', '2025-12-24 18:32:05', '2025-12-24 18:32:05'),
(5, 'Laskar Panglipur Sabet Medali Emas di\r\nKejuarann POMNAS 2025 Jawa Tengah', 'emas-pomnas-3-jawa-tengah', 'Laskar Panglipur Garut Kembali sabet medali medali emas berturut - turut\r\nuntuk 2 edisi POMNAS berbeda.', 'prestasi/prestasi3.jpeg', 'Nasional', '2024-10-11', '2025-12-24 18:33:39', '2025-12-24 18:33:39'),
(6, 'Laskar Panglipur Sabet Medali Emas di\r\nKejuarann POMNAS 2025 Jawa Tengah', 'emas-pomnas-4-jawa-tengah', 'Laskar Panglipur Garut Kembali sabet medali medali emas berturut - turut\r\nuntuk 2 edisi POMNAS berbeda.', 'prestasi/prestasi4.jpeg', 'Nasional', '2024-10-12', '2025-12-24 18:34:13', '2025-12-24 18:34:13'),
(7, 'Laskar Panglipur Sabet Medali Emas di\r\nKejuarann POMNAS 2025 Jawa Tengah', 'emas-pomnas-5-jawa-tengah', 'Laskar Panglipur Garut Kembali sabet medali medali emas berturut - turut\r\nuntuk 2 edisi POMNAS berbeda.', 'prestasi/prestasi5.jpeg', 'Nasional', '2024-10-12', '2025-12-24 18:34:45', '2025-12-24 18:34:45'),
(8, 'Laskar Panglipur Sabet Medali Emas di\r\nKejuarann POMNAS 2025 Jawa Tengah', 'emas-pomnas-6-jawa-tengah', 'Laskar Panglipur Garut Kembali sabet medali medali emas berturut - turut\r\nuntuk 2 edisi POMNAS berbeda.', 'prestasi/prestasi6.jpeg', 'Nasional', '2024-10-12', '2025-12-24 18:35:18', '2025-12-24 18:35:18'),
(9, 'Laskar Panglipur Sabet Medali Emas di\r\nKejuarann POMNAS 2025 Jawa Tengah', 'emas-pomnas-7-jawa-tengah', 'Laskar Panglipur Garut Kembali sabet medali medali emas berturut - turut\r\nuntuk 2 edisi POMNAS berbeda.', 'prestasi/prestasi7.jpeg', 'Nasional', '2024-10-12', '2025-12-24 18:35:44', '2025-12-24 18:35:44'),
(10, 'Laskar Panglipur Sabet Medali Emas di\r\nKejuarann POMNAS 2025 Jawa Tengah', 'emas-pomnas-8-jawa-tengah', 'Laskar Panglipur Garut Kembali sabet medali medali emas berturut - turut\r\nuntuk 2 edisi POMNAS berbeda.', 'prestasi/prestasi8.jpeg', 'Nasional', '2024-10-12', '2025-12-24 18:36:12', '2025-12-24 18:36:12'),
(11, 'Laskar Panglipur Sabet Medali Emas di\r\nKejuarann POMNAS 2025 Jawa Tengah', 'emas-pomnas-9-jawa-tengah', 'Laskar Panglipur Garut Kembali sabet medali medali emas berturut - turut\r\nuntuk 2 edisi POMNAS berbeda.', 'prestasi/prestasi9.jpeg', 'Nasional', '2024-10-12', '2025-12-24 18:36:42', '2025-12-24 18:36:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `seragam`
--

CREATE TABLE `seragam` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ukuran` enum('S','M','L','XL','XXL') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `seragam`
--

INSERT INTO `seragam` (`id`, `ukuran`, `created_at`, `updated_at`, `stok`) VALUES
(6, 'S', '2026-02-03 08:06:23', '2026-02-03 08:19:11', 19),
(7, 'M', '2026-02-03 08:06:49', '2026-02-03 08:06:49', 20),
(8, 'L', '2026-02-03 08:06:55', '2026-02-03 08:06:55', 20),
(9, 'XL', '2026-02-03 08:07:02', '2026-02-03 08:10:49', 20),
(10, 'XXL', '2026-02-03 08:07:06', '2026-02-03 08:07:06', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `seragam_orders`
--

CREATE TABLE `seragam_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anggota_id` bigint(20) UNSIGNED NOT NULL,
  `ukuran` varchar(10) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `status` enum('menunggu','diproses','siap diambil','selesai') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `seragam_orders`
--

INSERT INTO `seragam_orders` (`id`, `anggota_id`, `ukuran`, `jumlah`, `harga`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'XL', 1, 250000, 'selesai', '2026-01-31 08:15:41', '2026-02-03 08:11:28'),
(2, 5, 'M', 2, 500000, 'menunggu', '2026-01-31 08:15:41', '2026-01-31 08:15:41'),
(3, 6, 'S', 1, 250000, 'diproses', '2026-01-31 08:15:41', '2026-02-03 08:19:11'),
(4, 7, 'L', 1, 250000, 'menunggu', '2026-01-31 08:15:41', '2026-01-31 08:15:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `seragam_stock_logs`
--

CREATE TABLE `seragam_stock_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seragam_id` bigint(20) UNSIGNED NOT NULL,
  `tipe` enum('masuk','keluar') NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `seragam_stock_logs`
--

INSERT INTO `seragam_stock_logs` (`id`, `seragam_id`, `tipe`, `jumlah`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 6, 'masuk', 20, 'Restock manual oleh Admin', NULL, NULL),
(2, 7, 'masuk', 20, 'Restock manual oleh Admin', NULL, NULL),
(3, 8, 'masuk', 20, 'Restock manual oleh Admin', NULL, NULL),
(4, 9, 'masuk', 20, 'Restock manual oleh Admin', NULL, NULL),
(5, 10, 'masuk', 5, 'Restock manual oleh Admin', NULL, NULL),
(6, 9, 'keluar', 1, 'Pesanan anggota: 1', NULL, NULL),
(7, 9, 'masuk', 1, 'Restock manual oleh Admin', '2026-02-03 08:10:49', '2026-02-03 08:10:49'),
(8, 6, 'keluar', 1, 'Pesanan anggota: 3', '2026-02-03 08:19:11', '2026-02-03 08:19:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian`
--

CREATE TABLE `ujian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `anggota_id` bigint(20) UNSIGNED NOT NULL,
  `sabuk_diuji` varchar(50) DEFAULT NULL,
  `tanggal_ujian` date NOT NULL,
  `periode` varchar(100) DEFAULT NULL,
  `penguji` varchar(100) DEFAULT NULL,
  `total_nilai` int(11) DEFAULT NULL,
  `nilai_minimum` int(11) DEFAULT 600,
  `status` enum('lulus','tidak') DEFAULT 'tidak',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ujian`
--

INSERT INTO `ujian` (`id`, `anggota_id`, `sabuk_diuji`, `tanggal_ujian`, `periode`, `penguji`, `total_nilai`, `nilai_minimum`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 'kuning', '2026-02-01', NULL, 'Asep Sunandar', 420, 600, 'tidak', '2026-02-02 11:24:22', '2026-02-02 11:24:22'),
(6, 15, 'hijau', '2026-02-03', NULL, 'Pelatih', 600, 600, 'lulus', '2026-02-03 03:09:15', '2026-02-03 03:09:15'),
(7, 2, 'kuning', '2026-02-03', NULL, 'Asep Sunandar', 620, 600, 'lulus', '2026-02-03 04:18:41', '2026-02-03 04:18:41'),
(8, 15, 'hijau', '2026-02-03', NULL, 'Dadang Hermawan', 600, 600, 'lulus', '2026-02-03 04:19:20', '2026-02-03 04:19:20'),
(13, 16, 'kuning', '2026-02-03', NULL, 'Siti Aminah', 640, 600, 'lulus', '2026-02-03 04:50:00', '2026-02-03 04:50:01'),
(14, 16, 'hijau', '2026-02-03', NULL, 'Dadang Hermawan', 400, 600, 'tidak', '2026-02-03 04:50:53', '2026-02-03 04:50:53'),
(15, 2, 'hijau', '2026-02-03', NULL, 'Dadang Hermawan', 800, 600, 'lulus', '2026-02-03 04:55:34', '2026-02-03 04:55:34'),
(16, 7, 'hitam', '2026-02-03', NULL, 'Yudi Guntara', 800, 600, 'lulus', '2026-02-03 05:02:35', '2026-02-03 05:02:35'),
(17, 1, 'hijau', '2026-02-03', NULL, 'Dadang Hermawan', 700, 600, 'lulus', '2026-02-03 05:20:31', '2026-02-03 05:33:33'),
(18, 5, 'hijau', '2026-02-03', NULL, 'Dadang Hermawan', 640, 600, 'lulus', '2026-02-03 05:21:52', '2026-02-03 05:21:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('admin','anggota') NOT NULL DEFAULT 'anggota',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin Utama', 'admin@laskar.com', 'admin', NULL, '$2y$12$X1lAECWkQXsL6UFv7sWtTekHUaz6Q7Mj3M21djpblNlk4up3MiHJu', NULL, '2025-12-25 20:33:29', '2026-01-16 21:45:56'),
(3, 'Anggota Test', 'anggota@test.com', 'anggota', NULL, '$2y$12$tThtO02ocMiL8wO5CrI.ruwmNMXFbfvlEZfabmgqj30W2iPev4fw2', NULL, '2026-01-16 21:19:28', '2026-01-16 21:19:28'),
(4, 'ardialfarisi', 'ardialfarisikece@gmail.com', 'anggota', NULL, '$2y$12$CqhBRux0FCClKMIIH1RTYujUQ8zq8iiMtDQn063/.LB5/QJD9PzrK', NULL, '2026-02-03 09:22:42', '2026-02-03 09:22:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `verifikasi_pendaftaran`
--

CREATE TABLE `verifikasi_pendaftaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('laki_laki','perempuan') NOT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `status` enum('pending','diterima','ditolak') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `verifikasi_pendaftaran`
--

INSERT INTO `verifikasi_pendaftaran` (`id`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `email`, `no_telepon`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Renal Andiandri', 'Garut', '2025-12-10', 'laki_laki', 'garut sirnajaya', 'renaladriandri@gmail.com', '083128312321', 'pending', '2025-12-25 12:19:20', '2025-12-25 12:19:20'),
(4, 'Dadan Hamdani', 'Garut', '2005-05-12', 'laki_laki', 'Jl. Otista No. 45, Tarogong Kaler, Garut', 'dadan.hamdani@gmail.com', '081223456789', 'pending', '2026-01-31 08:16:11', '2026-01-31 08:16:11'),
(5, 'Lilis Karlina', 'Garut', '2006-08-20', 'perempuan', 'Kp. Bojong Larang RT 03 RW 05, Desa Sukamentri, Garut Kota', 'lilis.k@gmail.com', '085221122334', 'pending', '2026-01-31 08:16:11', '2026-01-31 08:16:11'),
(6, 'Rizky Ramadhan', 'Bandung', '2003-10-10', 'laki_laki', 'Jl. Terusan Buah Batu No. 102, Cipagalo, Bandung', 'rizky.ram@gmail.com', '081394455667', 'pending', '2026-01-31 08:16:11', '2026-01-31 08:16:11'),
(7, 'Sandi Kurnia', 'Garut', '2007-01-15', 'laki_laki', 'Kecamatan Bayongbong, Kp. Cigedug Hilir', 'sandi.kurnia@gmail.com', '087766554433', 'pending', '2026-01-31 08:16:11', '2026-01-31 08:16:11'),
(8, 'Fitriani Nur', 'Garut', '2008-03-25', 'perempuan', 'Perumahan Bumi Karangpawitan Blok B4, Garut', 'fitri.nur@gmail.com', '089988776655', 'pending', '2026-01-31 08:16:11', '2026-01-31 08:16:11'),
(9, 'Euis Rohayati', 'Bandung', '2005-11-30', 'perempuan', 'Cisirung, Kec. Dayeuhkolot, Kabupaten Bandung', 'euis.roh@gmail.com', '082112233445', 'pending', '2026-01-31 08:16:11', '2026-01-31 08:16:11'),
(10, 'Agus Junaedi', 'Garut', '2004-07-04', 'laki_laki', 'Jl. Cimanuk No. 12, Jayaraga, Kec. Tarogong Kidul', 'agus.jun@gmail.com', '081122334455', 'pending', '2026-01-31 08:16:11', '2026-01-31 08:16:11');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_anggota_user_id` (`user_id`);

--
-- Indeks untuk tabel `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `informasi_slug_unique` (`slug`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_periode` (`periode_bulan`,`periode_tahun`);

--
-- Indeks untuk tabel `logistik`
--
ALTER TABLE `logistik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_ujian`
--
ALTER TABLE `nilai_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nilai_ujian_ref` (`ujian_id`);

--
-- Indeks untuk tabel `pelatih`
--
ALTER TABLE `pelatih`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pemasukan_keuangan` (`keuangan_id`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pengeluaran_keuangan` (`keuangan_id`);

--
-- Indeks untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prestasi_slug_unique` (`slug`);

--
-- Indeks untuk tabel `seragam`
--
ALTER TABLE `seragam`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `seragam_orders`
--
ALTER TABLE `seragam_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anggota_id` (`anggota_id`);

--
-- Indeks untuk tabel `seragam_stock_logs`
--
ALTER TABLE `seragam_stock_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ujian_anggota` (`anggota_id`),
  ADD KEY `idx_anggota_history` (`anggota_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `verifikasi_pendaftaran`
--
ALTER TABLE `verifikasi_pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `logistik`
--
ALTER TABLE `logistik`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `nilai_ujian`
--
ALTER TABLE `nilai_ujian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pelatih`
--
ALTER TABLE `pelatih`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `seragam`
--
ALTER TABLE `seragam`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `seragam_orders`
--
ALTER TABLE `seragam_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `seragam_stock_logs`
--
ALTER TABLE `seragam_stock_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `verifikasi_pendaftaran`
--
ALTER TABLE `verifikasi_pendaftaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `nilai_ujian`
--
ALTER TABLE `nilai_ujian`
  ADD CONSTRAINT `fk_nilai_ujian_ref` FOREIGN KEY (`ujian_id`) REFERENCES `ujian` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_ujian_ibfk_1` FOREIGN KEY (`ujian_id`) REFERENCES `ujian` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `fk_pemasukan_keuangan` FOREIGN KEY (`keuangan_id`) REFERENCES `keuangan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `fk_pengeluaran_keuangan` FOREIGN KEY (`keuangan_id`) REFERENCES `keuangan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `seragam_orders`
--
ALTER TABLE `seragam_orders`
  ADD CONSTRAINT `seragam_orders_ibfk_1` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ujian`
--
ALTER TABLE `ujian`
  ADD CONSTRAINT `fk_ujian_anggota` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ujian_ibfk_1` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
