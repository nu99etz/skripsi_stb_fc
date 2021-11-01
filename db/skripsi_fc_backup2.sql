-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2021 at 09:24 AM
-- Server version: 10.6.4-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_fc`
--

DROP TABLE `activity_log`;
DROP TABLE `aturan`;
DROP TABLE `solusi_kerusakan`;
DROP TABLE `penyebab_kerusakan`;
DROP TABLE `kerusakan`;
DROP TABLE `gejala`;
DROP TABLE `ms_user`;
DROP TABLE `pegawai`;
DROP TABLE `ms_role`;
DROP TABLE `v_aturan`;

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
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

--
-- Dumping data for table `activity_log`
--

-- --------------------------------------------------------

--
-- Table structure for table `aturan`
--

CREATE TABLE `aturan` (
  `id` int(11) NOT NULL,
  `kode_gejala` int(11) DEFAULT NULL,
  `kode_kerusakan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aturan`
--

-- INSERT INTO `aturan` (`id`, `parent_kode_gejala`, `child_kode_gejala`, `kode_kerusakan`) VALUES
-- (27, 1, '4', 1),
-- (28, 1, '5,6', 2),
-- (29, 1, '7,8', 3),
-- (30, 2, '9', 4),
-- (31, 2, '10,11', 5),
-- (32, 3, '12,13', 6),
-- (33, 3, '14', 7),
-- (34, 3, '15,16,17', 8),
-- (35, 3, '18', 9),
-- (36, 3, '19,20', 10),
-- (37, 3, '21,22', 11),
-- (38, 3, '23,24', 12);

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id` int(11) NOT NULL,
  `kode_gejala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_gejala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id`, `kode_gejala`, `nama_gejala`) VALUES
(1, 'G1', 'LED Pada Panel Depan STB Tidak Menyala'),
(2, 'G2', 'LED Pada Panel Depan STB Menyala Merah'),
(3, 'G3', 'LED Pada Panel Depan STB Menyala Hijau'),
(4, 'G4', 'Kabel Adaptor Power STB Terputus'),
(5, 'G5', 'Power Adaptor STB Terasa Panas Berlebih'),
(6, 'G6', 'Tersetrum Saat Power Adaptor STB Disentuh'),
(7, 'G7', 'Tersetrum Saat Menyentuh STB'),
(8, 'G8', 'Tercium Bau Gosong Pada STB'),
(9, 'G9', 'Display Pada STB Bertuliskan ON'),
(10, 'G10', 'Display Pada STB Bertuliskan UP'),
(11, 'G11', 'Tampilan Bootlogo STB Pada Televisi Hanya Diam Dalam Waktu Lama'),
(12, 'G12', 'Tidak Ada Video / Gambar Pada Layar Televisi'),
(13, 'G13', 'Tidak Keluar suara Pada Televisi'),
(14, 'G14', 'Remote Control STB Tidak Respon '),
(15, 'G15', 'Seluruh Channel Gelap'),
(16, 'G16', 'Tampil Pesan Error Searching For Signal'),
(17, 'G17', 'Bar Sinyal Naik Turun Tidak Stabil'),
(18, 'G18', 'Tampil Pesan  Data Channel Tidak Keluar'),
(19, 'G19', 'Gambar Jelek / Berkedip '),
(20, 'G20', 'Bar Sinyal <50%'),
(21, 'G21', 'Channel Berbayar Atau Berlogo $ Gelap'),
(22, 'G22', 'Terdapat Email Atau Notifikasi Peringatan Masa Aktif'),
(23, 'G23', 'Beberapa Channel FTA (Free To Air) Gelap'),
(24, 'G24', 'Tampil Program Yang Berbeda Dengan EPG (Electronic Program Guide)');

-- --------------------------------------------------------

--
-- Table structure for table `kerusakan`
--

CREATE TABLE `kerusakan` (
  `id` int(11) NOT NULL,
  `kode_kerusakan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kerusakan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kerusakan`
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
-- Table structure for table `ms_role`
--

CREATE TABLE `ms_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_role`
--

INSERT INTO `ms_role` (`id_role`, `nama_role`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Customer Service'),
(4, 'Teknisi');

-- --------------------------------------------------------

--
-- Table structure for table `ms_user`
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
-- Dumping data for table `ms_user`
--

INSERT INTO `ms_user` (`id`, `id_user`, `username`, `password`, `is_login`, `login_date`, `last_login`) VALUES
(1, 1, 'admin', 'ee11cbb19052e40b07aac0ca060c23ee', 1, 'Mon Oct 18 13:55:55 WIB 2021', 'Thu Oct 14 18:25:30 WIB 2021');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
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
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `role_id`, `kode_pegawai`, `nama_pegawai`, `alamat_pegawai`, `nomor_telepon_pegawai`) VALUES
(1, 1, 'admin', 'admin', 'admin', '111');

-- --------------------------------------------------------

--
-- Table structure for table `penyebab_kerusakan`
--

CREATE TABLE `penyebab_kerusakan` (
  `id` int(11) NOT NULL,
  `kode_kerusakan` int(11) DEFAULT NULL,
  `penyebab_kerusakan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penyebab_kerusakan`
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
-- Table structure for table `solusi_kerusakan`
--

CREATE TABLE `solusi_kerusakan` (
  `id` int(11) NOT NULL,
  `kode_kerusakan` int(11) DEFAULT NULL,
  `solusi_kerusakan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `solusi_kerusakan`
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

-- --------------------------------------------------------

--
-- Table structure for table `v_aturan`
--

CREATE TABLE `v_aturan` (
  `id` int(11) DEFAULT NULL,
  `parent_kode_gejala` int(11) DEFAULT NULL,
  `child_kode_gejala` int(11) DEFAULT NULL,
  `kode_kerusakan` int(11) DEFAULT NULL,
  `parent_gejala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `child_gejala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kerusakan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_kode_gejala` (`kode_gejala`),
  ADD KEY `kode_kerusakan` (`kode_kerusakan`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kerusakan`
--
ALTER TABLE `kerusakan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_role`
--
ALTER TABLE `ms_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `ms_user`
--
ALTER TABLE `ms_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `penyebab_kerusakan`
--
ALTER TABLE `penyebab_kerusakan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_kerusakan` (`kode_kerusakan`);

--
-- Indexes for table `solusi_kerusakan`
--
ALTER TABLE `solusi_kerusakan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_kerusakan` (`kode_kerusakan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `aturan`
--
ALTER TABLE `aturan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `kerusakan`
--
ALTER TABLE `kerusakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ms_role`
--
ALTER TABLE `ms_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ms_user`
--
ALTER TABLE `ms_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penyebab_kerusakan`
--
ALTER TABLE `penyebab_kerusakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
