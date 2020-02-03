-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jan 2020 pada 16.48
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ftsl_legalisir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori_pengajuan`
--

CREATE TABLE `histori_pengajuan` (
  `id_histori` int(11) NOT NULL,
  `id_pengajuan` int(5) NOT NULL DEFAULT '0',
  `waktu_perubahan` datetime NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `by` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_pos`
--

CREATE TABLE `history_pos` (
  `id_pos` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `no_ijazah` varchar(100) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `provinsi_asal` varchar(100) NOT NULL,
  `kota_asal` varchar(100) NOT NULL,
  `provinsi_tujuan` varchar(100) NOT NULL,
  `kota_tujuan` varchar(100) NOT NULL,
  `berat` varchar(100) NOT NULL,
  `kurir` varchar(100) NOT NULL,
  `service` varchar(100) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `history_pos`
--

INSERT INTO `history_pos` (`id_pos`, `id_pengajuan`, `no_ijazah`, `nim`, `nama`, `provinsi_asal`, `kota_asal`, `provinsi_tujuan`, `kota_tujuan`, `berat`, `kurir`, `service`, `alamat_lengkap`, `tanggal`) VALUES
(3, 12, 'mur007', 'A2.1700065', 'Ma\'mur Mulyawan', '3', '402', '4', '183', '1', 'tiki', 'REG -- Rp.52000 3 Hari', 'Sumedang', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `idjurusan` int(10) UNSIGNED NOT NULL,
  `nama_jurusan` varchar(255) COLLATE utf8_bin NOT NULL,
  `kode_jurusan` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `seq` int(10) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`idjurusan`, `nama_jurusan`, `kode_jurusan`, `seq`, `deleted`) VALUES
(1, 'Teknik Informatika\r\n', 'TI', 1, 0),
(2, 'Sistem Informasi', 'SI', 2, 0),
(3, 'Manajemen Informatika', 'MI', 3, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` int(11) NOT NULL,
  `nama_layanan` varchar(255) COLLATE utf8_bin NOT NULL,
  `deskripsi` text COLLATE utf8_bin NOT NULL,
  `biaya` int(11) NOT NULL,
  `min_qty` int(3) NOT NULL,
  `max_qty` int(3) NOT NULL,
  `aktif` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `deleted` char(1) COLLATE utf8_bin DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `deskripsi`, `biaya`, `min_qty`, `max_qty`, `aktif`, `deleted`) VALUES
(123, 'Legalisir Ijazah', 'Legalisir', 100000, 1, 1, '1', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `no_ijazah` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `nim` varchar(20) COLLATE utf8_bin NOT NULL,
  `nama` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `angkatan` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `ttl` date DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `prodi` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status_verifikasi` int(4) DEFAULT NULL COMMENT '1:verified;0:to-verified;2:not-verified;',
  `waktu_verifikasi` datetime DEFAULT NULL,
  `user_verifikasi` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `no_hp` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `provinsi` varchar(50) COLLATE utf8_bin NOT NULL,
  `kota` varchar(50) COLLATE utf8_bin NOT NULL,
  `alamat` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `file_ijazah` varchar(50) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`no_ijazah`, `nim`, `nama`, `angkatan`, `ttl`, `email`, `prodi`, `created_at`, `status_verifikasi`, `waktu_verifikasi`, `user_verifikasi`, `password`, `last_login`, `no_hp`, `provinsi`, `kota`, `alamat`, `file_ijazah`) VALUES
('mur007', 'A2.1700065', 'Ma\'mur Mulyawan', '2015', '1998-12-06', 'A2.1700065@mhs.stmik-sumedang.ac.id', 'Teknik Informatika\r\n', '2020-01-08 11:10:19', 1, '2020-01-08 11:11:34', 'admin', 'c44a471bd78cc6c2fea32b9fe028d30a', '2020-01-24 00:36:52', '+6281573031026', '9', '440', 'Dsn. Setiabakti RT 02 RW 04 Desa Sukatali Kec. Situraja 45371 Kab. Sumedang', 'Ijazah4.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa_dokumen`
--

CREATE TABLE `mahasiswa_dokumen` (
  `no_ijazah` varchar(100) COLLATE utf8_bin NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `ukuran` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `ext` char(10) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_bayar` int(10) NOT NULL,
  `id_pengajuan` int(10) DEFAULT NULL,
  `nim` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `nama` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `waktu_pengajuan` datetime DEFAULT NULL,
  `waktu_bayar` datetime DEFAULT NULL,
  `biaya_total` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_bayar`, `id_pengajuan`, `nim`, `nama`, `waktu_pengajuan`, `waktu_bayar`, `biaya_total`) VALUES
(9, 12, 'A2.1700065', 'Ma\'mur Mulyawan', '2020-01-08 11:24:00', '2020-01-08 12:06:11', 100000),
(10, 14, 'A2.1700065', 'Ma\'mur Mulyawan', '2020-01-19 14:27:07', '2020-01-19 16:53:38', 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int(10) NOT NULL,
  `nim` varchar(20) COLLATE utf8_bin NOT NULL,
  `nama` varchar(200) COLLATE utf8_bin NOT NULL,
  `prodi` varchar(200) COLLATE utf8_bin NOT NULL,
  `total_tagihan` int(10) DEFAULT NULL,
  `waktu_pengajuan` datetime NOT NULL,
  `status` char(1) COLLATE utf8_bin NOT NULL COMMENT '1:pengajuan/belum bayar;2:sudah_bayar;3:selesai;4:sudah_diambil;',
  `perubahan_status` datetime DEFAULT NULL,
  `bukti_transfer` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_detail`
--

CREATE TABLE `pengajuan_detail` (
  `id_pengajuan_detail` int(10) NOT NULL,
  `id_pengajuan` int(10) NOT NULL,
  `id_layanan` int(10) NOT NULL,
  `jumlah` int(2) NOT NULL,
  `nama_layanan` varchar(255) COLLATE utf8_bin NOT NULL,
  `deskripsi_layanan` text COLLATE utf8_bin NOT NULL,
  `biaya_satuan` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tracer_form`
--

CREATE TABLE `tracer_form` (
  `id_form` int(10) UNSIGNED NOT NULL,
  `seq` int(11) NOT NULL,
  `label` text COLLATE utf8_bin NOT NULL,
  `tipedata` enum('singleword','text','longtext','radio','check','combo','email','url','number','decimal','date') COLLATE utf8_bin DEFAULT NULL,
  `mandatory` char(1) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `instruksi` text COLLATE utf8_bin,
  `aktif` char(1) COLLATE utf8_bin NOT NULL DEFAULT '1',
  `deleted` char(1) COLLATE utf8_bin NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tracer_form`
--

INSERT INTO `tracer_form` (`id_form`, `seq`, `label`, `tipedata`, `mandatory`, `instruksi`, `aktif`, `deleted`) VALUES
(1, 3, 'Nama Alumni', 'singleword', '1', '', '1', '0'),
(2, 4, 'Nomor Mahasiswa', 'singleword', '1', '', '1', '0'),
(3, 6, 'Jurusan / Program Studi', 'combo', '1', '', '1', '0'),
(4, 5, 'Jenis Kelamin', 'radio', '1', '', '1', '0'),
(5, 7, 'Tahun Kelulusan', 'singleword', '1', '', '1', '0'),
(6, 8, 'Nama Perusahaan/Instansi', 'singleword', '1', '', '1', '0'),
(7, 9, 'No. Telepon/HP/WA', 'singleword', '1', '', '1', '0'),
(8, 14, 'Alamat Rumah Terakhir', 'singleword', '0', '', '1', '0'),
(9, 15, 'Nomor Telepon Rumah', 'singleword', '0', '', '1', '0'),
(10, 16, 'Alamat Kantor Terakhir', 'singleword', '0', '', '1', '0'),
(11, 17, 'Nomor Telepon Kantor', 'singleword', '0', '', '1', '0'),
(12, 18, '1. Berapa lama waktu tunggu anda mendapatkan pekerjaan pertama kali.', 'radio', '1', '', '1', '0'),
(13, 20, '2. Dimana pertama kali anda bekerja', 'radio', '1', '', '1', '0'),
(14, 22, '3. Berapa kali anda pindah tempat bekerja?', 'radio', '1', 'Jika Jawaban anda \"Tidak Pernah Pindah\", langsung ke pertanyaan nomor 5', '1', '0'),
(15, 23, '4. Alasan anda pindah kerja', 'radio', '0', '', '1', '0'),
(16, 24, '5. Apakah latar belakang pendidikan anda mendukung karir untuk menduduki jabatan tertentu ditempat anda bekerja sekarang?', 'radio', '1', '', '1', '0'),
(17, 25, '6. Berapa IPK standar yang dibutuhkan ditempat Perusahaan/Instansi anda bekerja.', 'radio', '1', '', '1', '0'),
(18, 26, '7. Pendidikan terakhir?', 'radio', '1', '', '1', '0'),
(19, 27, '8. Sejauh mana Perusahaan/Instansi tempat anda bekerja membutuhkan kemampuan berbahasa Inggris?', 'radio', '1', '', '1', '0'),
(20, 28, 'Tuliskan score toefl anda jika ada?', 'singleword', '0', '', '1', '0'),
(21, 29, '9. Apakah kompetensi lulusan program studi anda sudah sesuai dengan permintaan pasar kerja di Perusahaan/Instansi anda bekerja?', 'radio', '1', '', '1', '0'),
(22, 30, '10. Apakah anda puas dengan keahlian teknis yang diperoleh dari STMIK Sumedang untuk melaksanakan pekerjaan sekarang?', 'radio', '1', '', '1', '0'),
(23, 32, '11. Berapakah nilai gaji pertama anda bekerja? Rp.', 'number', '1', '', '1', '0'),
(24, 33, '12. Gaji terakhir? Rp.', 'number', '1', '', '1', '0'),
(25, 35, '13. Sebutkan beberapa mata kuliah yang dibutuhkan untuk bekerja di Perusahaan/Instansi anda bagi lulusan D3/S1', 'longtext', '1', 'Sesuai program studi anda', '1', '0'),
(26, 36, '14. Berikan informasi tentang perkembangan Ilmu Pengetahuan dan Teknologi (IPTEK) di Perusahaan/Instansi anda bekerja', 'longtext', '1', 'Sesuai program studi anda', '1', '0'),
(27, 37, '15. Berikan saran untuk peningkatan kurikulum program studi anda agar sesuai dengan perkembangan IPTEK dan pasar kerja', 'longtext', '1', '', '1', '0'),
(28, 38, '16. Tuliskan pengalaman pekerjaan dan jabatan anda', 'longtext', '1', 'Format : No.Urut, Nama Perusahaan/Instansi, Tahun, Jabatan dan keterangan', '1', '0'),
(29, 21, '', 'singleword', '0', '', '1', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tracer_form_data`
--

CREATE TABLE `tracer_form_data` (
  `id_form` int(10) UNSIGNED NOT NULL,
  `no_ijazah` varchar(100) COLLATE utf8_bin NOT NULL,
  `jurusan` varchar(200) COLLATE utf8_bin NOT NULL,
  `seq` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8_bin NOT NULL,
  `data` text COLLATE utf8_bin,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tracer_form_data`
--

INSERT INTO `tracer_form_data` (`id_form`, `no_ijazah`, `jurusan`, `seq`, `label`, `data`, `created_at`, `updated_at`) VALUES
(1, 'mur007', 'Teknik Informatika\r\n', 3, 'Nama Alumni', 'Ma\'mur Mulyawan', '2020-01-08 00:00:00', NULL),
(2, 'mur007', 'Teknik Informatika\r\n', 4, 'Nomor Mahasiswa', 'A2.1700065', '2020-01-08 00:00:00', NULL),
(3, 'mur007', 'Teknik Informatika\r\n', 6, 'Jurusan / Program Studi', 'Teknik Informatika', '2020-01-08 00:00:00', NULL),
(4, 'mur007', 'Teknik Informatika\r\n', 5, 'Jenis Kelamin', 'Laki-laki', '2020-01-08 00:00:00', NULL),
(5, 'mur007', 'Teknik Informatika\r\n', 7, 'Tahun Kelulusan', '2021', '2020-01-08 00:00:00', NULL),
(6, 'mur007', 'Teknik Informatika\r\n', 8, 'Nama Perusahaan/Instansi', 'Google', '2020-01-08 00:00:00', NULL),
(7, 'mur007', 'Teknik Informatika\r\n', 9, 'No. Telepon/HP/WA', '081573031026', '2020-01-08 00:00:00', NULL),
(8, 'mur007', 'Teknik Informatika\r\n', 14, 'Alamat Rumah Terakhir', 'Sumedang', '2020-01-08 00:00:00', NULL),
(9, 'mur007', 'Teknik Informatika\r\n', 15, 'Nomor Telepon Rumah', '', '2020-01-08 00:00:00', NULL),
(10, 'mur007', 'Teknik Informatika\r\n', 16, 'Alamat Kantor Terakhir', '', '2020-01-08 00:00:00', NULL),
(11, 'mur007', 'Teknik Informatika\r\n', 17, 'Nomor Telepon Kantor', '', '2020-01-08 00:00:00', NULL),
(12, 'mur007', 'Teknik Informatika\r\n', 18, '1. Berapa lama waktu tunggu anda mendapatkan pekerjaan pertama kali.', 'Telah bekerja sebelum lulus', '2020-01-08 00:00:00', NULL),
(13, 'mur007', 'Teknik Informatika\r\n', 20, '2. Dimana pertama kali anda bekerja', 'Lainnya, Sebutkan', '2020-01-08 00:00:00', NULL),
(14, 'mur007', 'Teknik Informatika\r\n', 22, '3. Berapa kali anda pindah tempat bekerja?', '1 kali', '2020-01-08 00:00:00', NULL),
(15, 'mur007', 'Teknik Informatika\r\n', 23, '4. Alasan anda pindah kerja', 'Gaji tidak memuaskan', '2020-01-08 00:00:00', NULL),
(16, 'mur007', 'Teknik Informatika\r\n', 24, '5. Apakah latar belakang pendidikan anda mendukung karir untuk menduduki jabatan tertentu ditempat anda bekerja sekarang?', 'Sangat mendukung', '2020-01-08 00:00:00', NULL),
(17, 'mur007', 'Teknik Informatika\r\n', 25, '6. Berapa IPK standar yang dibutuhkan ditempat Perusahaan/Instansi anda bekerja.', '3,51 - 4,00', '2020-01-08 00:00:00', NULL),
(18, 'mur007', 'Teknik Informatika\r\n', 26, '7. Pendidikan terakhir?', 'S1', '2020-01-08 00:00:00', NULL),
(19, 'mur007', 'Teknik Informatika\r\n', 27, '8. Sejauh mana Perusahaan/Instansi tempat anda bekerja membutuhkan kemampuan berbahasa Inggris?', 'Sangat membutuhkan', '2020-01-08 00:00:00', NULL),
(20, 'mur007', 'Teknik Informatika\r\n', 28, 'Tuliskan score toefl anda jika ada?', '', '2020-01-08 00:00:00', NULL),
(21, 'mur007', 'Teknik Informatika\r\n', 29, '9. Apakah kompetensi lulusan program studi anda sudah sesuai dengan permintaan pasar kerja di Perusahaan/Instansi anda bekerja?', 'Sangat sesuai', '2020-01-08 00:00:00', NULL),
(22, 'mur007', 'Teknik Informatika\r\n', 30, '10. Apakah anda puas dengan keahlian teknis yang diperoleh dari STMIK Sumedang untuk melaksanakan pekerjaan sekarang?', 'Sangat memuaskan', '2020-01-08 00:00:00', NULL),
(23, 'mur007', 'Teknik Informatika\r\n', 32, '11. Berapakah nilai gaji pertama anda bekerja? Rp.', '10.000.000', '2020-01-08 00:00:00', NULL),
(24, 'mur007', 'Teknik Informatika\r\n', 33, '12. Gaji terakhir? Rp.', '20.000.000', '2020-01-08 00:00:00', NULL),
(25, 'mur007', 'Teknik Informatika\r\n', 35, '13. Sebutkan beberapa mata kuliah yang dibutuhkan untuk bekerja di Perusahaan/Instansi anda bagi lulusan D3/S1', 'Programming', '2020-01-08 00:00:00', NULL),
(26, 'mur007', 'Teknik Informatika\r\n', 36, '14. Berikan informasi tentang perkembangan Ilmu Pengetahuan dan Teknologi (IPTEK) di Perusahaan/Instansi anda bekerja', 'Sangat Pesat', '2020-01-08 00:00:00', NULL),
(27, 'mur007', 'Teknik Informatika\r\n', 37, '15. Berikan saran untuk peningkatan kurikulum program studi anda agar sesuai dengan perkembangan IPTEK dan pasar kerja', 'Tingkatkan kualitas SDM', '2020-01-08 00:00:00', NULL),
(28, 'mur007', 'Teknik Informatika\r\n', 38, '16. Tuliskan pengalaman pekerjaan dan jabatan anda', '1. Google, 2021, Kepala Software Engineering,', '2020-01-08 00:00:00', NULL),
(29, 'mur007', 'Teknik Informatika\r\n', 21, '', 'Perusahaan', '2020-01-08 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tracer_form_options`
--

CREATE TABLE `tracer_form_options` (
  `id_option` int(10) UNSIGNED NOT NULL,
  `id_form` int(10) UNSIGNED NOT NULL,
  `label` varchar(100) COLLATE utf8_bin NOT NULL,
  `seq` int(3) NOT NULL,
  `value` varchar(100) COLLATE utf8_bin NOT NULL,
  `selected_value` char(1) COLLATE utf8_bin DEFAULT NULL,
  `deleted` char(1) COLLATE utf8_bin NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tracer_form_options`
--

INSERT INTO `tracer_form_options` (`id_option`, `id_form`, `label`, `seq`, `value`, `selected_value`, `deleted`) VALUES
(1, 3, 'Sistem Informasi', 2, 'Sistem Informasi', '0', '0'),
(2, 3, 'Teknik Informatika', 1, 'Teknik Informatika', '1', '0'),
(3, 3, 'Manajemen Informatika', 3, 'Manajemen Informatika', '0', '0'),
(4, 4, 'Laki-laki', 1, 'Laki-laki', NULL, '0'),
(5, 4, 'Perempuan', 2, 'Perempuan', NULL, '0'),
(6, 12, 'Telah bekerja sebelum lulus', 1, 'Telah bekerja sebelum lulus', NULL, '0'),
(7, 12, 'Kurang dari 3 bulan', 2, 'Kurang dari 3 bulan', NULL, '0'),
(8, 12, '3 - 6 bulan', 3, '3 - 6 bulan', NULL, '0'),
(9, 12, '6 - 12 bulan', 4, '6 - 12 bulan', NULL, '0'),
(10, 12, '12 - 24 bulan', 5, '12 - 24 bulan', NULL, '0'),
(11, 12, '> 24 bulan', 6, '> 24 bulan', NULL, '0'),
(12, 13, 'Pemerintah/PNS', 1, 'Pemerintah/PNS', NULL, '0'),
(13, 13, 'Swasta', 2, 'Swasta', NULL, '0'),
(14, 13, 'Wirausaha', 3, 'Wirausaha', NULL, '0'),
(15, 13, 'Lainnya, Sebutkan', 4, 'Lainnya, Sebutkan', NULL, '0'),
(16, 14, 'Tidak pernah pindah', 1, 'Tidak pernah pindah', NULL, '0'),
(17, 14, '1 kali', 2, '1 kali', NULL, '0'),
(18, 14, '2 kali', 3, '2 kali', NULL, '0'),
(19, 14, '> 2 kali', 4, '> 2 kali', NULL, '0'),
(20, 15, 'Gaji tidak memuaskan', 1, 'Gaji tidak memuaskan', '0', '0'),
(21, 15, 'Suasana kerja tidak nyaman', 2, 'Suasana kerja tidak nyaman', '0', '0'),
(22, 15, 'Sulit untuk mengembangkan karir', 3, 'Sulit untuk mengembangkan karir', '0', '0'),
(23, 15, 'Bidang pekerjaan tidak sesuai dengan bidang ilmu/jurusan yang di miliki', 4, 'Bidang pekerjaan tidak sesuai dengan bidang ilmu/jurusan yang di miliki', '0', '0'),
(24, 16, 'Sangat mendukung', 1, 'Sangat mendukung', NULL, '0'),
(25, 16, 'Mendukung', 2, 'Mendukung', NULL, '0'),
(26, 16, 'Hanya sebagian mendukung', 3, 'Hanya sebagian mendukung', NULL, '0'),
(27, 16, 'Tidak mendukung', 4, 'Tidak mendukung', NULL, '0'),
(28, 17, '2,00 - 2,50', 1, '2,00 - 2,50', NULL, '0'),
(29, 17, '2,51 - 3,00', 2, '2,51 - 3,00', NULL, '0'),
(30, 17, '3,01 - 3,50', 3, '3,01 - 3,50', NULL, '0'),
(31, 17, '3,51 - 4,00', 4, '3,51 - 4,00', NULL, '0'),
(32, 18, 'D3', 1, 'D3', NULL, '0'),
(33, 18, 'S1', 2, 'S1', NULL, '0'),
(34, 18, 'S2', 3, 'S2', NULL, '0'),
(35, 18, 'S3', 4, 'S3', NULL, '0'),
(36, 19, 'Sangat membutuhkan', 1, 'Sangat membutuhkan', NULL, '0'),
(37, 19, 'Membutuhkan', 2, 'Membutuhkan', NULL, '0'),
(38, 19, 'Kurang membutuhkan', 3, 'Kurang membutuhkan', NULL, '0'),
(39, 21, 'Sangat sesuai', 1, 'Sangat sesuai', NULL, '0'),
(40, 21, 'Sesuai', 2, 'Sesuai', NULL, '0'),
(41, 21, 'Kurang sesuai', 3, 'Kurang sesuai', NULL, '0'),
(42, 21, 'TIdak sesuai', 4, 'TIdak sesuai', NULL, '0'),
(43, 22, 'Sangat memuaskan', 1, 'Sangat memuaskan', NULL, '0'),
(44, 22, 'Memuaskan', 2, 'Memuaskan', NULL, '0'),
(45, 22, 'Kurang memuaskan', 3, 'Kurang memuaskan', NULL, '0'),
(46, 22, 'Tidak memuaskan', 4, 'Tidak memuaskan', NULL, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tracer_form_options_data`
--

CREATE TABLE `tracer_form_options_data` (
  `id_form` int(10) UNSIGNED NOT NULL,
  `nim` varchar(15) COLLATE utf8_bin NOT NULL,
  `prodi` varchar(200) COLLATE utf8_bin NOT NULL,
  `id_option` int(11) NOT NULL,
  `option_label` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `option_value` text COLLATE utf8_bin,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `username` varchar(150) COLLATE utf8_bin NOT NULL,
  `password` varchar(70) COLLATE utf8_bin NOT NULL,
  `role` enum('keu','adm','akd') COLLATE utf8_bin NOT NULL DEFAULT 'adm',
  `last_login` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `aktif` int(1) DEFAULT '1',
  `deleted` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `password`, `role`, `last_login`, `created_at`, `aktif`, `deleted`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'adm', '2020-01-21 15:49:54', NULL, 1, 0),
('akademik', '0b5652714faf87700d60a912f753cc55', 'akd', '2019-10-12 19:18:14', '2019-10-12 19:17:54', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `histori_pengajuan`
--
ALTER TABLE `histori_pengajuan`
  ADD PRIMARY KEY (`id_histori`);

--
-- Indeks untuk tabel `history_pos`
--
ALTER TABLE `history_pos`
  ADD PRIMARY KEY (`id_pos`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`idjurusan`);

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD KEY `no_ijazah` (`no_ijazah`),
  ADD KEY `nim` (`nim`);

--
-- Indeks untuk tabel `mahasiswa_dokumen`
--
ALTER TABLE `mahasiswa_dokumen`
  ADD PRIMARY KEY (`no_ijazah`,`id_layanan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indeks untuk tabel `pengajuan_detail`
--
ALTER TABLE `pengajuan_detail`
  ADD PRIMARY KEY (`id_pengajuan_detail`);

--
-- Indeks untuk tabel `tracer_form`
--
ALTER TABLE `tracer_form`
  ADD PRIMARY KEY (`id_form`);

--
-- Indeks untuk tabel `tracer_form_data`
--
ALTER TABLE `tracer_form_data`
  ADD PRIMARY KEY (`id_form`,`no_ijazah`),
  ADD KEY `seq` (`seq`);

--
-- Indeks untuk tabel `tracer_form_options`
--
ALTER TABLE `tracer_form_options`
  ADD PRIMARY KEY (`id_option`),
  ADD KEY `id_form` (`id_form`);

--
-- Indeks untuk tabel `tracer_form_options_data`
--
ALTER TABLE `tracer_form_options_data`
  ADD PRIMARY KEY (`id_form`,`nim`,`prodi`,`id_option`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `histori_pengajuan`
--
ALTER TABLE `histori_pengajuan`
  MODIFY `id_histori` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `history_pos`
--
ALTER TABLE `history_pos`
  MODIFY `id_pos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `idjurusan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_bayar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_detail`
--
ALTER TABLE `pengajuan_detail`
  MODIFY `id_pengajuan_detail` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tracer_form`
--
ALTER TABLE `tracer_form`
  MODIFY `id_form` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tracer_form_options`
--
ALTER TABLE `tracer_form_options`
  MODIFY `id_option` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
