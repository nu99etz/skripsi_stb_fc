-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 12 Okt 2021 pada 14.07
-- Versi server: 10.6.4-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP TABLE `activity_log`;
DROP TABLE `aturan`;
DROP TABLE `solusi_kerusakan`;
DROP TABLE `penyebab_kerusakan`;
DROP TABLE `kerusakan`;
DROP TABLE `gejala`;
DROP TABLE `ms_user`;
DROP TABLE `pegawai`;
DROP TABLE `ms_role`;

--
-- Database: `skripsi_fc`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activity_log` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activity_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_success` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `aturan`
--

CREATE TABLE `aturan` (
  `id` int(11) NOT NULL,
  `parent_kode_gejala` int(11) DEFAULT NULL,
  `child_kode_gejala` int(11) DEFAULT NULL,
  `kode_kerusakan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `id` int(11) NOT NULL,
  `kode_gejala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_gejala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kerusakan`
--

CREATE TABLE `kerusakan` (
  `id` int(11) NOT NULL,
  `kode_kerusakan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kerusakan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kerusakan`
--

INSERT INTO `kerusakan` (`id`, `kode_kerusakan`, `nama_kerusakan`) VALUES
(1, 'K1', 'Kabel Power Adaptor Bermasalah'),
(2, 'K2', 'Power Adaptor STB Bermasalah'),
(3, 'K3', 'STB Bermasalah'),
(4, 'K4', 'Mode On / Mata Merah'),
(5, 'K5', 'Mode Up / Bootloop'),
(6, 'K6', 'Kabel HDMI / RCA Bermasalah'),
(7, 'K7', 'Remote Control STB Bermasalah'),
(8, 'K8', 'Perangkat Antena Bermasalah'),
(9, 'K9', 'Data Channel Kosong'),
(10, 'K10', 'Sinyal Lemah'),
(11, 'K11', 'Masa Aktif Habis '),
(12, 'K12', 'Terkena Siaran Acak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_role`
--

CREATE TABLE `ms_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ms_role`
--

INSERT INTO `ms_role` (`id_role`, `nama_role`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Customer Service'),
(4, 'Teknisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_user`
--

CREATE TABLE `ms_user` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_login` int(11) DEFAULT 0,
  `login_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ms_user`
--

INSERT INTO `ms_user` (`id`, `id_user`, `username`, `password`, `is_login`, `login_date`, `last_login`) VALUES
(1, 1, 'admin', 'ee11cbb19052e40b07aac0ca060c23ee', 0, NULL, 'Tue Oct 12 21:07:13 WIB 2021');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `kode_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_pegawai` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_telepon_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `role_id`, `kode_pegawai`, `nama_pegawai`, `alamat_pegawai`, `nomor_telepon_pegawai`) VALUES
(1, 1, 'admin', 'admin', 'admin', '111');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyebab_kerusakan`
--

CREATE TABLE `penyebab_kerusakan` (
  `id` int(11) NOT NULL,
  `kode_kerusakan` int(11) DEFAULT NULL,
  `penyebab_kerusakan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penyebab_kerusakan`
--

INSERT INTO `penyebab_kerusakan` (`id`, `kode_kerusakan`, `penyebab_kerusakan`) VALUES
(4, 1, '<ul>\r\n	<li>Kabel Belum Terpasang Dengan Benar (Dari Buku Panduan)</li>\r\n	<li>Tergigit Tikus (Dari Narasumber)</li>\r\n</ul>\r\n'),
(5, 2, '<ul>\r\n	<li>Arus Listrik Sering Tidak Stabil (Dari Narasumber)</li>\r\n	<li>Usia Adaptor (Dari Narasumber)</li>\r\n</ul>\r\n'),
(6, 3, '<ul>\r\n	<li>Tegangan Listrik Sering Tidak Stabil (Dari Narasumber)</li>\r\n	<li>Terlalu Sering Mati Listrik Secara Tiba-Tiba (Dari Narasumber)</li>\r\n	<li>Terdapat Komponen Yang Short Atau Tidak Normal (Dari Narasumber)</li>\r\n</ul>\r\n'),
(7, 4, '<ul>\r\n	<li>Kegagalan Upgrade Frimware Ota&nbsp;(Over The Air) Maupun Via Usb&nbsp;(Dari Narasumber)</li>\r\n	<li>Terlalu Sering Mati Listrik Secara Tiba-Tiba (Dari Narasumber)</li>\r\n	<li>Terdapat Komponen Yang Tidak Dapat Mesuplay Daya Dengan Normal (Dari Narasumber)</li>\r\n</ul>\r\n'),
(8, 5, '<ul>\r\n	<li>Bug Pada Frimware (Dari Narasumber)</li>\r\n	<li>Kegagalan Upgrade Frimware Ota&nbsp;(Over The Air) Maupun Via Usb&nbsp;(Dari Narasumber)</li>\r\n	<li>Menggunakan Frimware Modifikasi. (Dari Narasumber)</li>\r\n</ul>\r\n'),
(9, 6, '<ul>\r\n	<li>Plug Hdmi/Rca&nbsp;Tidak Terpasang Dengan Benar (Dari Buku Panduan)</li>\r\n	<li>Salah Memilih Video Input Source Dari Menu Televisi (Dari Buku Panduan)</li>\r\n	<li>Kabel Putus&nbsp;(Dari Narasumber)</li>\r\n</ul>\r\n'),
(10, 7, '<ul>\r\n	<li>Baterai Tidak Terpasang Dengan Benar (Dari Buku Panduan)</li>\r\n	<li>Kapasitas Baterai Habis (Dari Narasumber)</li>\r\n	<li>Kesalahan Pemakaian (Dari Buku Panduan)</li>\r\n</ul>\r\n'),
(11, 8, '<ul>\r\n	<li>Antena Tidak Terpasang Dengan Tepat (Dari Buku Panduan)</li>\r\n	<li>Masalah Di Lnb&nbsp;(Dari Buku Panduan)</li>\r\n	<li>Kabel Antena Tidak Terpasang Dengan Kencang (Dari Buku Panduan)</li>\r\n</ul>\r\n'),
(12, 9, '<ul>\r\n	<li>Tidak Ada Channel Yang Tersimpan (Dari Buku Panduan)</li>\r\n	<li>Tidak Mengisi Data Pengaturan Antena&nbsp;(Dari Narasumber)</li>\r\n</ul>\r\n'),
(13, 10, '<ul>\r\n	<li>Sinyal Yang Ada Terlalu Lemah (Dari Buku Panduan)</li>\r\n	<li>Terdapat Banyak Halangan Di Sekitar Antena (Dari Narasumber)</li>\r\n</ul>\r\n'),
(14, 11, '<ul>\r\n	<li>Masa Paket Atau Voucher Berbayar Habis (Dari Narasumber)</li>\r\n</ul>\r\n'),
(15, 12, '<ul>\r\n	<li>Siaran Ekslusif / Hak Siar&nbsp;(Dari Narasumber)</li>\r\n	<li>Provider Mengunci Atau Mengacak Siaran&nbsp;(Dari Narasumber)</li>\r\n	<li>Receiver Belum Update Ke Frimware Terbaru&nbsp;(Dari Narasumber)</li>\r\n</ul>\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `solusi_kerusakan`
--

CREATE TABLE `solusi_kerusakan` (
  `id` int(11) NOT NULL,
  `kode_kerusakan` int(11) DEFAULT NULL,
  `solusi_kerusakan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `solusi_kerusakan`
--

INSERT INTO `solusi_kerusakan` (`id`, `kode_kerusakan`, `solusi_kerusakan`) VALUES
(5, 1, '<ul>\r\n	<li>Cek Pemasangan Kabel Power Dan Pastikan Pemasangannya Benar (Dari Buku Panduan)</li>\r\n	<li>Penggantian Power Adaptor (Dari Narasumber)</li>\r\n	<li>Jauhkan Sekiranya Dari Jangkauan Tikus (Dari Narasumber)</li>\r\n</ul>\r\n'),
(6, 2, '<ul>\r\n	<li>Penggantian Power Adaptor (Dari Narasumber)</li>\r\n</ul>\r\n'),
(7, 3, '<ul>\r\n	<li>Pastikan Tegangan Normal Dan Nilai Setiap Komponen Sesuai (Dari Narasumber)</li>\r\n	<li>Penggantian Komponen Yang Terindikasi Tidak Normal (Dari Narasumber)</li>\r\n	<li>Menawarkan Penggantian Stb&nbsp;(Dari Narasumber)</li>\r\n</ul>\r\n'),
(8, 4, '<ul>\r\n	<li>Pastikan Tegangan Normal Dan Nilai Setiap Komponen Sesuai. (Dari Narasumber)</li>\r\n	<li>Penggantian Komponen Yang Terindikasi Tidak Normal. (Dari Narasumber)</li>\r\n	<li>Lakukan Direct Flash Ke Ic Eprom&nbsp;Menggunakan Usb Ttl&nbsp;(Dari Narasumber)</li>\r\n	<li>Penggantian Stb&nbsp;(Dari Narasumber)</li>\r\n</ul>\r\n'),
(9, 5, '<ul>\r\n	<li>Flash Ulang Menggunakan Frimware Asli Dan Terbaru Menggunakan Metode Usb&nbsp;Flash. (Dari Narasumber)</li>\r\n</ul>\r\n'),
(10, 6, '<ul>\r\n	<li>Pastikan Hdmi/Rca Terpasang Dengan Benar &nbsp;(Dari Buku Panduan)</li>\r\n	<li>Pastikan Televisi Tidak Dalam Mode Mute. (Dari Buku Panduan)</li>\r\n	<li>Pastikan Pilihan Video Input Source Pada Televisi Benar (Dari Buku Panduan)</li>\r\n	<li>Penggantian Kabel Hdmi/Rca (Dari Narasumber)</li>\r\n</ul>\r\n'),
(11, 7, '<ul>\r\n	<li>Pastikan Pemasangan Baterai Tepat (Dari Buku Panduan)</li>\r\n	<li>Penggantian Baterai (Dari Narasumber)</li>\r\n	<li>Penggantian Remote Control (Dari Buku Panduan)</li>\r\n</ul>\r\n'),
(12, 8, '<ul>\r\n	<li>Luruskan Antenna Secara Tepat Dan Periksa Kekuatan Sinyal Pada Menu Auto Scan (Dari Buku Panduan)</li>\r\n	<li>Penggantian Perangkat Lnb&nbsp;Yang Sesuai (Dari Buku Panduan)</li>\r\n	<li>Periksa Kabel Antena Dan Kencangkan (Dari Buku Panduan)</li>\r\n	<li>Lakukan Penggantian Kabel Antena Bila Diperlukan&nbsp;(Dari Narasumber)</li>\r\n</ul>\r\n'),
(13, 9, '<ul>\r\n	<li>Isi Data Pengaturan Antena Sesuai Data Dari Penyedia Layanan&nbsp;(Dari Narasumber)</li>\r\n	<li>Pilih Menu Auto Scan Atau Manual Scan Dan Lakukan Scan Ulang (Dari Buku Panduan)</li>\r\n</ul>\r\n'),
(14, 10, '<ul>\r\n	<li>Pindahkan Antenna Ke Tempat Yang Terhidar Dari Halangan (Dari Narasumber)</li>\r\n	<li>Periksa Sinyal Pada Menu Auto Scan Dan Arahkan Antenna Dengan Tepat (Dari Buku Panduan)</li>\r\n</ul>\r\n'),
(15, 11, '<ul>\r\n	<li>Beli Voucher Di Aplikasi Tanaka Voucher (Dari Narasumber)</li>\r\n	<li>Restart Receiver (Dari Narasumber)</li>\r\n</ul>\r\n'),
(16, 12, '<ul>\r\n	<li>Melakukan Refresh Akun Pada Aplikasi Tanaka (Dari Narasumber)</li>\r\n	<li>Update Frimware Terbaru&nbsp;(Dari Narasumber)</li>\r\n</ul>\r\n');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_kode_gejala` (`parent_kode_gejala`),
  ADD KEY `child_kode_gejala` (`child_kode_gejala`),
  ADD KEY `kode_kerusakan` (`kode_kerusakan`);

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kerusakan`
--
ALTER TABLE `kerusakan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_role`
--
ALTER TABLE `ms_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `ms_user`
--
ALTER TABLE `ms_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeks untuk tabel `penyebab_kerusakan`
--
ALTER TABLE `penyebab_kerusakan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_kerusakan` (`kode_kerusakan`);

--
-- Indeks untuk tabel `solusi_kerusakan`
--
ALTER TABLE `solusi_kerusakan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_kerusakan` (`kode_kerusakan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `aturan`
--
ALTER TABLE `aturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kerusakan`
--
ALTER TABLE `kerusakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `ms_role`
--
ALTER TABLE `ms_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ms_user`
--
ALTER TABLE `ms_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `penyebab_kerusakan`
--
ALTER TABLE `penyebab_kerusakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `solusi_kerusakan`
--
ALTER TABLE `solusi_kerusakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `aturan`
--
ALTER TABLE `aturan`
  ADD CONSTRAINT `aturan_ibfk_1` FOREIGN KEY (`parent_kode_gejala`) REFERENCES `gejala` (`id`),
  ADD CONSTRAINT `aturan_ibfk_2` FOREIGN KEY (`child_kode_gejala`) REFERENCES `gejala` (`id`),
  ADD CONSTRAINT `aturan_ibfk_3` FOREIGN KEY (`kode_kerusakan`) REFERENCES `kerusakan` (`id`);

--
-- Ketidakleluasaan untuk tabel `ms_user`
--
ALTER TABLE `ms_user`
  ADD CONSTRAINT `ms_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `pegawai` (`id`);

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `ms_role` (`id_role`);

--
-- Ketidakleluasaan untuk tabel `penyebab_kerusakan`
--
ALTER TABLE `penyebab_kerusakan`
  ADD CONSTRAINT `penyebab_kerusakan_ibfk_1` FOREIGN KEY (`kode_kerusakan`) REFERENCES `kerusakan` (`id`);

--
-- Ketidakleluasaan untuk tabel `solusi_kerusakan`
--
ALTER TABLE `solusi_kerusakan`
  ADD CONSTRAINT `solusi_kerusakan_ibfk_1` FOREIGN KEY (`kode_kerusakan`) REFERENCES `kerusakan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
