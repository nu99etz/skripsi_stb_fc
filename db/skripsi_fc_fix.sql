-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2021 at 02:54 PM
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
-- Database: `skripsi_fc_fix`
--

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

INSERT INTO `activity_log` (`id`, `username`, `ip_address`, `activity_log`, `activity_date`, `parameters`, `is_success`) VALUES
(60, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 9:42:50 WIB 2021', '{\"kode_kerusakan\":\"1\",\"kode_gejala\":[\"1\",\"4\"]}', 1),
(61, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 9:43:34 WIB 2021', '{\"kode_kerusakan\":\"1\",\"kode_gejala\":[\"1\",\"4\"]}', 1),
(62, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 9:46:22 WIB 2021', '{\"kode_kerusakan\":\"1\",\"kode_gejala\":[\"1\",\"4\"]}', 0),
(63, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 9:48:53 WIB 2021', '{\"kode_kerusakan\":\"1\",\"kode_gejala\":[\"1\",\"4\"]}', 0),
(64, 'admin', '::1', 'login', 'Wed Oct 27 10:47:29 WIB 2021', '{\"username\":\"admin\"}', 0),
(65, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 11:24:57 WIB 2021', '{\"kode_kerusakan\":\"2\",\"kode_gejala\":[\"1\",\"5\",\"6\"]}', 0),
(66, 'admin', '::1', 'login', 'Wed Oct 27 13:02:42 WIB 2021', '{\"username\":\"admin\"}', 0),
(67, 'admin', '::1', 'update-aturan', 'Wed Oct 27 13:58:35 WIB 2021', '{\"kode_kerusakan\":\"1\",\"kode_gejala\":[\"1\",\"4\",\"7\",\"8\",\"9\"]}', 0),
(68, 'admin', '::1', 'update-aturan', 'Wed Oct 27 13:59:09 WIB 2021', '{\"kode_kerusakan\":\"2\",\"kode_gejala\":[\"1\",\"5\",\"6\",\"7\"]}', 0),
(69, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 14:00:10 WIB 2021', '{\"kode_kerusakan\":\"1\",\"kode_gejala\":[\"1\",\"4\"]}', 0),
(70, 'admin', '::1', 'update-aturan', 'Wed Oct 27 14:00:19 WIB 2021', '{\"kode_kerusakan\":\"1\",\"kode_gejala\":[\"1\",\"4\",\"5\"]}', 0),
(71, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 14:03:03 WIB 2021', '{\"kode_kerusakan\":\"1\",\"kode_gejala\":[\"1\",\"4\"]}', 0),
(72, 'admin', '::1', 'update-aturan', 'Wed Oct 27 14:03:09 WIB 2021', '{\"kode_kerusakan\":\"1\",\"kode_gejala\":[\"1\",\"4\",\"5\",\"6\"]}', 0),
(73, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 14:44:54 WIB 2021', '{\"kode_kerusakan\":\"1\",\"kode_gejala\":[\"1\",\"4\"]}', 0),
(74, 'admin', '::1', 'login', 'Wed Oct 27 15:53:19 WIB 2021', '{\"username\":\"admin\"}', 0),
(75, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 16:06:23 WIB 2021', '{\"kode_kerusakan\":\"2\",\"kode_gejala\":[\"1\",\"5\",\"6\"]}', 0),
(76, 'admin', '::1', 'update-aturan', 'Wed Oct 27 16:24:42 WIB 2021', '{\"kode_kerusakan\":\"2\",\"kode_gejala\":[\"1\",\"5\",\"6\",\"7\"]}', 0),
(77, 'admin', '::1', 'update-aturan', 'Wed Oct 27 16:24:52 WIB 2021', '{\"kode_kerusakan\":\"2\",\"kode_gejala\":[\"1\",\"5\",\"6\"]}', 0),
(78, 'admin', '::1', 'hapus-aturan', 'Wed Oct 27 16:27:25 WIB 2021', '{\"aturan\":[{\"id\":\"10\",\"kode_gejala\":\"1\",\"kode_kerusakan\":\"2\"},{\"id\":\"11\",\"kode_gejala\":\"5\",\"kode_kerusakan\":\"2\"},{\"id\":\"12\",\"kode_gejala\":\"6\",\"kode_kerusakan\":\"2\"}]}', 0),
(79, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 16:27:58 WIB 2021', '{\"kode_kerusakan\":\"2\",\"kode_gejala\":[\"1\",\"5\",\"6\"]}', 0),
(80, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 16:28:44 WIB 2021', '{\"kode_kerusakan\":\"3\",\"kode_gejala\":[\"1\",\"7\",\"8\"]}', 0),
(81, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 16:28:58 WIB 2021', '{\"kode_kerusakan\":\"4\",\"kode_gejala\":[\"2\",\"9\"]}', 0),
(82, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 16:30:12 WIB 2021', '{\"kode_kerusakan\":\"5\",\"kode_gejala\":[\"2\",\"10\",\"11\"]}', 0),
(83, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 16:30:46 WIB 2021', '{\"kode_kerusakan\":\"6\",\"kode_gejala\":[\"3\",\"12\",\"13\"]}', 0),
(84, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 16:31:39 WIB 2021', '{\"kode_kerusakan\":\"7\",\"kode_gejala\":[\"3\",\"14\"]}', 0),
(85, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 16:32:03 WIB 2021', '{\"kode_kerusakan\":\"8\",\"kode_gejala\":[\"3\",\"15\",\"16\",\"17\"]}', 0),
(86, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 16:32:22 WIB 2021', '{\"kode_kerusakan\":\"9\",\"kode_gejala\":[\"3\",\"18\"]}', 0),
(87, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 16:32:37 WIB 2021', '{\"kode_kerusakan\":\"10\",\"kode_gejala\":[\"3\",\"19\",\"20\"]}', 0),
(88, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 16:32:55 WIB 2021', '{\"kode_kerusakan\":\"11\",\"kode_gejala\":[\"21\",\"22\"]}', 0),
(89, 'admin', '::1', 'update-aturan', 'Wed Oct 27 16:33:10 WIB 2021', '{\"kode_kerusakan\":\"11\",\"kode_gejala\":[\"3\",\"21\",\"22\"]}', 0),
(90, 'admin', '::1', 'insert-aturan', 'Wed Oct 27 16:33:42 WIB 2021', '{\"kode_kerusakan\":\"12\",\"kode_gejala\":[\"3\",\"23\",\"24\"]}', 0),
(91, 'admin', '::1', 'login', 'Thu Oct 28 10:14:53 WIB 2021', '{\"username\":\"admin\"}', 0),
(92, 'admin', '::1', 'login', 'Fri Oct 29 18:46:43 WIB 2021', '{\"username\":\"admin\"}', 0),
(93, 'admin', '::1', 'login', 'Sat Oct 30 8:22:07 WIB 2021', '{\"username\":\"admin\"}', 0),
(95, 'admin', '::1', 'insert-pegawai', 'Sat Oct 30 8:50:37 WIB 2021', '{\"nama_pegawai\":\"\",\"role_id\":\"\",\"alamat_pegawai\":\"\",\"nomor_telepon_pegawai\":\"\"}', 1),
(96, 'admin', '::1', 'insert-pegawai', 'Sat Oct 30 8:50:46 WIB 2021', '{\"nama_pegawai\":\"jaka\",\"role_id\":\"4\",\"alamat_pegawai\":\"jagiran\",\"nomor_telepon_pegawai\":\"0887777\"}', 0),
(97, 'admin', '::1', 'insert-perbaikan', 'Sat Oct 30 9:10:52 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"\",\"alamat_customer\":\"\",\"nama_teknisi\":\"\"},\"kerusakan\":[]}', 1),
(98, 'admin', '::1', 'login', 'Mon Nov 1 9:20:07 WIB 2021', '{\"username\":\"admin\"}', 1),
(99, 'admin', '::1', 'login', 'Mon Nov 1 9:20:11 WIB 2021', '{\"username\":\"admin\"}', 0),
(100, 'admin', '::1', 'insert-perbaikan', 'Mon Nov 1 9:27:36 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"\",\"alamat_customer\":\"\",\"nama_teknisi\":\"\"},\"kerusakan\":[]}', 1),
(101, 'admin', '::1', 'insert-perbaikan', 'Mon Nov 1 9:27:39 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"\",\"alamat_customer\":\"\",\"nama_teknisi\":\"\"},\"kerusakan\":[]}', 1),
(102, 'admin', '::1', 'insert-perbaikan', 'Mon Nov 1 9:30:27 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"\",\"alamat_customer\":\"\",\"nama_teknisi\":\"\"},\"kerusakan\":[]}', 1),
(103, 'admin', '::1', 'insert-perbaikan', 'Mon Nov 1 9:34:31 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"\",\"alamat_customer\":\"\",\"nama_teknisi\":\"\",\"question\":[\"2\",\"3\"]},\"kerusakan\":[]}', 1),
(104, 'admin', '::1', 'insert-perbaikan', 'Mon Nov 1 9:35:59 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"\",\"alamat_customer\":\"\",\"nama_teknisi\":\"\",\"question\":[\"3\",\"6\"]},\"kerusakan\":[]}', 1),
(105, 'admin', '::1', 'insert-perbaikan', 'Mon Nov 1 9:39:29 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"\",\"alamat_customer\":\"\",\"nama_teknisi\":\"\",\"question\":[\"4\",\"6\"]},\"kerusakan\":[]}', 1),
(106, 'admin', '::1', 'insert-perbaikan', 'Mon Nov 1 9:39:52 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"joko\",\"alamat_customer\":\"jagiran\",\"nama_teknisi\":\"3\",\"question\":[\"1\",\"4\",\"5\",\"6\",\"7\"]},\"kerusakan\":[1,2,3]}', 1),
(107, 'admin', '::1', 'insert-perbaikan', 'Mon Nov 1 9:40:41 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"joko\",\"alamat_customer\":\"jagiran\",\"nama_teknisi\":\"3\",\"question\":[\"1\",\"4\",\"5\",\"6\",\"7\"]},\"kerusakan\":[1,2,3]}', 0),
(108, 'admin', '::1', 'insert-perbaikan', 'Mon Nov 1 9:42:26 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"jaka\",\"alamat_customer\":\"jagiran\",\"nama_teknisi\":\"3\",\"question\":[\"1\",\"4\",\"5\",\"6\"]},\"kerusakan\":[1,2]}', 0),
(109, 'admin', '::1', 'insert-perbaikan', 'Mon Nov 1 9:45:39 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"joko\",\"alamat_customer\":\"jagiran\",\"nama_teknisi\":\"3\",\"question\":[\"1\",\"4\",\"20\"]},\"kerusakan\":[1]}', 0),
(110, 'admin', '::1', 'insert-perbaikan', 'Mon Nov 1 10:06:42 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"jena\",\"alamat_customer\":\"jagiran\",\"nama_teknisi\":\"3\",\"question\":[\"1\",\"2\",\"4\",\"11\",\"12\"]},\"kerusakan\":[1,5]}', 0),
(111, 'admin', '::1', 'insert-pegawai', 'Mon Nov 1 11:07:44 WIB 2021', '{\"nama_pegawai\":\"Sonya Prakasawa\",\"role_id\":\"3\",\"alamat_pegawai\":\"Jl. Jagiran\",\"nomor_telepon_pegawai\":\"089764\"}', 0),
(112, 'admin', '::1', 'update-user', 'Mon Nov 1 11:07:56 WIB 2021', '{\"password\":\"81dc9bdb52d04dc20036dbd8313ed055\"}', 0),
(113, 'admin', '::1', 'logout', 'Mon Nov 1 11:08:00 WIB 2021', '{\"username\":\"admin\"}', 0),
(114, 'CS4', '::1', 'login', 'Mon Nov 1 11:08:11 WIB 2021', '{\"username\":\"CS4\"}', 0),
(115, 'Sonya Prakasawa', '::1', 'logout', 'Mon Nov 1 11:12:07 WIB 2021', '{\"username\":\"Sonya Prakasawa\"}', 0),
(116, 'CS4', '::1', 'login', 'Mon Nov 1 11:12:42 WIB 2021', '{\"username\":\"CS4\"}', 0),
(117, 'Sonya Prakasawa', '::1', 'insert-perbaikan', 'Mon Nov 1 11:13:08 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"adinda\",\"alamat_customer\":\"jojoran\",\"nama_teknisi\":\"3\",\"question\":[\"3\",\"23\",\"24\"]},\"kerusakan\":[12]}', 0),
(118, 'Sonya Prakasawa', '::1', 'logout', 'Mon Nov 1 11:48:55 WIB 2021', '{\"username\":\"Sonya Prakasawa\"}', 0),
(119, 'admin', '::1', 'login', 'Mon Nov 1 11:49:03 WIB 2021', '{\"username\":\"admin\"}', 0),
(120, 'admin', '::1', 'insert-solusi-kerusakan', 'Mon Nov 1 11:50:55 WIB 2021', '{\"kode_kerusakan\":\"\",\"solusi_kerusakan\":\"\"}', 1),
(121, 'admin', '::1', 'logout', 'Mon Nov 1 11:51:02 WIB 2021', '{\"username\":\"admin\"}', 0),
(122, 'CS4', '::1', 'login', 'Mon Nov 1 11:51:14 WIB 2021', '{\"username\":\"CS4\"}', 0),
(123, 'Sonya Prakasawa', '::1', 'logout', 'Mon Nov 1 11:52:47 WIB 2021', '{\"username\":\"Sonya Prakasawa\"}', 0),
(124, 'admin', '::1', 'login', 'Tue Nov 2 1:29:35 WIB 2021', '{\"username\":\"admin\"}', 0),
(125, 'CS4', '::1', 'login', 'Tue Nov 2 9:51:09 WIB 2021', '{\"username\":\"CS4\"}', 0),
(126, 'Sonya Prakasawa', '::1', 'logout', 'Tue Nov 2 10:03:59 WIB 2021', '{\"username\":\"Sonya Prakasawa\"}', 0),
(127, '', '::1', 'login', 'Tue Nov 2 10:11:47 WIB 2021', '{\"username\":\"\"}', 1),
(128, 'admin', '::1', 'login', 'Tue Nov 2 10:11:51 WIB 2021', '{\"username\":\"admin\"}', 0),
(129, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 10:47:50 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"joko\",\"alamat_customer\":\"jagiran\",\"nama_teknisi\":\"3\",\"question\":[\"3\",\"15\",\"16\"]},\"kerusakan\":[8]}', 0),
(130, 'admin', '::1', 'update-aturan', 'Tue Nov 2 10:48:06 WIB 2021', '{\"kode_kerusakan\":\"9\",\"kode_gejala\":[\"3\",\"15\",\"18\"]}', 0),
(131, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 10:48:20 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"joko\",\"alamat_customer\":\"jagiran\",\"nama_teknisi\":\"3\",\"question\":[\"3\",\"15\"]},\"kerusakan\":[9]}', 0),
(132, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 10:52:21 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"joko\",\"alamat_customer\":\"jk\",\"nama_teknisi\":\"3\",\"question\":[\"3\",\"15\",\"16\"]},\"kerusakan\":[8,9]}', 0),
(133, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 10:54:32 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"adinda\",\"alamat_customer\":\"jo\",\"nama_teknisi\":\"3\",\"question\":[\"3\",\"15\",\"16\",\"17\",\"18\"]},\"kerusakan\":[8,9]}', 0),
(134, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 10:56:12 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"joko\",\"alamat_customer\":\"jg\",\"nama_teknisi\":\"3\",\"question\":[\"3\",\"15\"]},\"kerusakan\":[7,9]}', 0),
(135, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 10:56:43 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"jena\",\"alamat_customer\":\"kode\",\"nama_teknisi\":\"3\",\"question\":[\"1\"]},\"kerusakan\":[1]}', 0),
(136, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 10:57:01 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"jena\",\"alamat_customer\":\"jaka\",\"nama_teknisi\":\"3\",\"question\":[\"2\"]},\"kerusakan\":[4]}', 0),
(137, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 10:57:52 WIB 2021', '{\"perbaikan\":{\"nama_customer\":\"adinda\",\"alamat_customer\":\"jagiran\",\"nama_teknisi\":\"3\",\"question\":[\"3\"]},\"kerusakan\":[7]}', 0),
(138, 'admin', '::1', 'login', 'Tue Nov 2 14:01:15 WIB 2021', '{\"username\":\"admin\"}', 0),
(139, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 15:28:02 WIB 2021', '{\"konsultasi\":{\"nama_customer\":\"\",\"alamat_customer\":\"\",\"no_telepon_customer\":\"\",\"question\":[\"1\"]},\"kerusakan\":[1]}', 1),
(140, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 15:28:26 WIB 2021', '{\"konsultasi\":{\"nama_customer\":\"\",\"alamat_customer\":\"\",\"no_telepon_customer\":\"\",\"question\":[\"1\"]},\"kerusakan\":[1]}', 1),
(141, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 15:28:28 WIB 2021', '{\"konsultasi\":{\"nama_customer\":\"\",\"alamat_customer\":\"\",\"no_telepon_customer\":\"\",\"question\":[\"1\"]},\"kerusakan\":[1]}', 1),
(142, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 15:28:50 WIB 2021', '{\"konsultasi\":{\"nama_customer\":\"\",\"alamat_customer\":\"\",\"no_telepon_customer\":\"\",\"question\":[\"1\"]},\"kerusakan\":[1]}', 1),
(143, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 15:29:13 WIB 2021', '{\"konsultasi\":{\"nama_customer\":\"\",\"alamat_customer\":\"\",\"no_telepon_customer\":\"\",\"question\":[\"1\"]},\"kerusakan\":[1]}', 1),
(144, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 15:31:21 WIB 2021', '{\"konsultasi\":{\"nama_customer\":\"joko\",\"alamat_customer\":\"jagiran\",\"no_telepon_customer\":\"09865434\",\"question\":[\"1\",\"4\",\"5\",\"6\"]},\"kerusakan\":[1,2]}', 0),
(145, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 15:32:31 WIB 2021', '{\"konsultasi\":{\"nama_customer\":\"adinda\",\"alamat_customer\":\"jagiran\",\"no_telepon_customer\":\"09865434\",\"question\":[\"1\",\"21\"]},\"kerusakan\":[1]}', 0),
(146, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 15:57:31 WIB 2021', '{\"konsultasi\":{\"nama_customer\":\"joko\",\"alamat_customer\":\"jagiran\",\"no_telepon_customer\":\"09865434\",\"question\":[\"3\",\"15\"]},\"kerusakan\":[7,9]}', 0),
(147, 'admin', '::1', 'insert-perbaikan', 'Tue Nov 2 16:39:22 WIB 2021', '{\"konsultasi\":{\"nama_customer\":\"adinda\",\"alamat_customer\":\"sddd\",\"no_telepon_customer\":\"09865434\",\"question\":[\"1\",\"2\",\"4\",\"9\"]},\"kerusakan\":[1,4]}', 0),
(148, 'admin', '::1', 'login', 'Wed Nov 3 8:55:46 WIB 2021', '{\"username\":\"admin\"}', 0),
(149, 'admin', '::1', 'login', 'Wed Nov 3 10:27:50 WIB 2021', '{\"username\":\"admin\"}', 0),
(150, 'admin', '::1', 'login', 'Thu Nov 4 10:00:23 WIB 2021', '{\"username\":\"admin\"}', 0),
(151, 'admin', '::1', 'login', 'Thu Nov 4 12:28:12 WIB 2021', '{\"username\":\"admin\"}', 0),
(152, 'admin', '::1', 'insert-aturan', 'Thu Nov 4 12:46:32 WIB 2021', '{\"kode_kerusakan\":\"1\",\"kode_gejala\":[\"1\",\"4\"]}', 0),
(153, 'admin', '::1', 'insert-aturan', 'Thu Nov 4 12:47:56 WIB 2021', '{\"kode_kerusakan\":\"2\",\"kode_gejala\":[\"1\",\"5\",\"6\"]}', 0),
(154, 'admin', '::1', 'insert-aturan', 'Thu Nov 4 12:48:37 WIB 2021', '{\"kode_kerusakan\":\"3\",\"kode_gejala\":[\"1\",\"7\",\"8\"]}', 0),
(155, 'admin', '::1', 'insert-aturan', 'Thu Nov 4 12:48:55 WIB 2021', '{\"kode_kerusakan\":\"4\",\"kode_gejala\":[\"2\",\"9\"]}', 0),
(156, 'admin', '::1', 'insert-aturan', 'Thu Nov 4 12:49:20 WIB 2021', '{\"kode_kerusakan\":\"5\",\"kode_gejala\":[\"2\",\"10\",\"11\"]}', 0),
(157, 'admin', '::1', 'insert-aturan', 'Thu Nov 4 12:50:08 WIB 2021', '{\"kode_kerusakan\":\"6\",\"kode_gejala\":[\"3\",\"12\",\"13\"]}', 0),
(158, 'admin', '::1', 'insert-aturan', 'Thu Nov 4 12:50:30 WIB 2021', '{\"kode_kerusakan\":\"7\",\"kode_gejala\":[\"3\",\"14\"]}', 0),
(159, 'admin', '::1', 'insert-aturan', 'Thu Nov 4 12:50:57 WIB 2021', '{\"kode_kerusakan\":\"8\",\"kode_gejala\":[\"3\",\"15\",\"16\",\"17\"]}', 0),
(160, 'admin', '::1', 'insert-aturan', 'Thu Nov 4 12:51:24 WIB 2021', '{\"kode_kerusakan\":\"9\",\"kode_gejala\":[\"3\",\"18\"]}', 0),
(161, 'admin', '::1', 'insert-aturan', 'Thu Nov 4 12:51:42 WIB 2021', '{\"kode_kerusakan\":\"10\",\"kode_gejala\":[\"3\",\"19\",\"20\"]}', 0),
(162, 'admin', '::1', 'insert-aturan', 'Thu Nov 4 12:51:54 WIB 2021', '{\"kode_kerusakan\":\"11\",\"kode_gejala\":[\"3\",\"21\",\"22\"]}', 0),
(163, 'admin', '::1', 'insert-aturan', 'Thu Nov 4 12:52:04 WIB 2021', '{\"kode_kerusakan\":\"12\",\"kode_gejala\":[\"3\",\"23\",\"24\"]}', 0),
(164, 'admin', '127.0.0.1', 'login', 'Thu Nov 4 16:51:05 WIB 2021', '{\"username\":\"admin\"}', 0),
(165, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 4 18:14:28 WIB 2021', '{\"kode_kerusakan\":\"1\",\"kode_gejala\":[\"1\",\"4\"]}', 0),
(166, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 4 18:14:36 WIB 2021', '{\"kode_kerusakan\":\"2\",\"kode_gejala\":[\"1\",\"5\",\"6\"]}', 0),
(167, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 4 18:15:41 WIB 2021', '{\"kode_kerusakan\":\"3\",\"kode_gejala\":[\"1\",\"7\",\"8\"]}', 0),
(168, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 4 18:15:59 WIB 2021', '{\"kode_kerusakan\":\"4\",\"kode_gejala\":[\"2\",\"9\"]}', 0),
(169, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 4 18:16:10 WIB 2021', '{\"kode_kerusakan\":\"5\",\"kode_gejala\":[\"2\",\"10\",\"11\"]}', 0),
(170, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 4 18:16:36 WIB 2021', '{\"kode_kerusakan\":\"6\",\"kode_gejala\":[\"3\",\"12\",\"13\"]}', 0),
(171, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 4 18:17:13 WIB 2021', '{\"kode_kerusakan\":\"7\",\"kode_gejala\":[\"3\",\"14\"]}', 0),
(172, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 4 18:17:31 WIB 2021', '{\"kode_kerusakan\":\"8\",\"kode_gejala\":[\"3\",\"15\",\"16\",\"17\"]}', 0),
(173, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 4 18:18:04 WIB 2021', '{\"kode_kerusakan\":\"9\",\"kode_gejala\":[\"3\",\"15\",\"18\"]}', 0),
(174, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 4 18:18:40 WIB 2021', '{\"kode_kerusakan\":\"10\",\"kode_gejala\":[\"3\",\"19\",\"20\"]}', 0),
(175, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 4 18:20:17 WIB 2021', '{\"kode_kerusakan\":\"11\",\"kode_gejala\":[\"3\",\"21\",\"22\"]}', 0),
(176, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 4 18:20:28 WIB 2021', '{\"kode_kerusakan\":\"12\",\"kode_gejala\":[\"3\",\"23\",\"24\"]}', 0),
(177, 'admin', '::1', 'login', 'Fri Nov 5 10:14:43 WIB 2021', '{\"username\":\"admin\"}', 0),
(178, 'admin', '::1', 'login', 'Wed Nov 10 17:53:48 WIB 2021', '{\"username\":\"admin\"}', 0),
(179, 'admin', '::1', 'login', 'Wed Nov 10 18:56:47 WIB 2021', '{\"username\":\"admin\"}', 0),
(180, 'admin', '::1', 'login', 'Thu Nov 11 12:43:23 WIB 2021', '{\"username\":\"admin\"}', 0),
(181, 'admin', '::1', 'insert-konsul-tmp', 'Thu Nov 11 13:41:43 WIB 2021', '{\"nama_customer\":\"\",\"alamat_customer\":\"\",\"no_telepon_customer\":\"\"}', 1),
(182, 'admin', '::1', 'insert-konsul-tmp', 'Thu Nov 11 13:41:52 WIB 2021', '{\"nama_customer\":\"joko\",\"alamat_customer\":\"<p>dddddd<\\/p>\\r\\n\",\"no_telepon_customer\":\"09865434\"}', 0),
(183, 'admin', '::1', 'insert-konsul-tmp', 'Thu Nov 11 13:42:15 WIB 2021', '{\"nama_customer\":\"joko\",\"alamat_customer\":\"<p>fffff<\\/p>\\r\\n\",\"no_telepon_customer\":\"09865434\"}', 0),
(184, 'admin', '::1', 'insert-konsul-tmp', 'Thu Nov 11 13:55:34 WIB 2021', '{\"nama_customer\":\"joko\",\"alamat_customer\":\"<p>ssss<\\/p>\\r\\n\",\"no_telepon_customer\":\"09865434\"}', 0),
(185, 'admin', '::1', 'insert-konsul-tmp', 'Thu Nov 11 13:59:29 WIB 2021', '{\"nama_customer\":\"adinda\",\"alamat_customer\":\"<p>ddddd<\\/p>\\r\\n\",\"no_telepon_customer\":\"09865434\"}', 0),
(186, 'admin', '::1', 'insert-konsul-tmp', 'Thu Nov 11 14:12:30 WIB 2021', '{\"nama_customer\":\"joko\",\"alamat_customer\":\"<p>dddd<\\/p>\\r\\n\",\"no_telepon_customer\":\"09865434\"}', 0),
(187, 'admin', '::1', 'insert-konsul-tmp', 'Thu Nov 11 14:16:18 WIB 2021', '{\"nama_customer\":\"joko\",\"alamat_customer\":\"<p>ffff<\\/p>\\r\\n\",\"no_telepon_customer\":\"09865434\"}', 0),
(188, 'admin', '::1', 'insert-konsul-tmp', 'Thu Nov 11 14:22:04 WIB 2021', '{\"nama_customer\":\"joko\",\"alamat_customer\":\"<p>dddd<\\/p>\\r\\n\",\"no_telepon_customer\":\"09865434\"}', 0),
(189, 'admin', '::1', 'insert-konsul-tmp', 'Thu Nov 11 15:04:25 WIB 2021', '{\"id_kerusakan\":\"4\",\"nama_customer\":\"\",\"alamat_customer\":\"\",\"no_telepon_customer\":\"\",\"id_teknisi\":\"\"}', 1),
(190, 'admin', '::1', 'insert-konsul-tmp', 'Thu Nov 11 15:04:28 WIB 2021', '{\"id_kerusakan\":\"4\",\"nama_customer\":\"\",\"alamat_customer\":\"\",\"no_telepon_customer\":\"\",\"id_teknisi\":\"\"}', 1),
(191, 'admin', '::1', 'insert-konsul-tmp', 'Thu Nov 11 15:05:24 WIB 2021', '{\"id_kerusakan\":\"1\",\"nama_customer\":\"\",\"alamat_customer\":\"\",\"no_telepon_customer\":\"\",\"id_teknisi\":\"\"}', 1),
(192, 'admin', '::1', 'insert-konsul-tmp', 'Thu Nov 11 15:05:28 WIB 2021', '{\"id_kerusakan\":\"1\",\"nama_customer\":\"\",\"alamat_customer\":\"\",\"no_telepon_customer\":\"\",\"id_teknisi\":\"\"}', 1),
(193, 'admin', '::1', 'insert-perbaikan', 'Thu Nov 11 15:43:34 WIB 2021', '{\"id_kerusakan\":\"5\",\"nama_customer\":\"joko\",\"alamat_customer\":\"<p>dddd<\\/p>\\r\\n\",\"no_telepon_customer\":\"09865434\",\"id_teknisi\":\"3\"}', 0),
(194, 'admin', '::1', 'insert-perbaikan', 'Thu Nov 11 15:56:00 WIB 2021', '{\"id_kerusakan\":\"5\",\"nama_customer\":\"adinda\",\"alamat_customer\":\"<p>ggg<\\/p>\\r\\n\",\"no_telepon_customer\":\"09865434\",\"id_teknisi\":\"3\"}', 0),
(195, 'admin', '::1', 'insert-perbaikan', 'Thu Nov 11 16:17:02 WIB 2021', '{\"id_kerusakan\":\"9\",\"nama_customer\":\"adinda\",\"alamat_customer\":\"<p>ffff<\\/p>\\r\\n\",\"no_telepon_customer\":\"09865434\",\"id_teknisi\":\"3\"}', 0),
(196, 'admin', '127.0.0.1', 'login', 'Thu Nov 11 20:56:05 WIB 2021', '{\"username\":\"admin\"}', 0),
(197, 'admin', '127.0.0.1', 'insert-perbaikan', 'Thu Nov 11 20:56:46 WIB 2021', '{\"id_kerusakan\":\"1\",\"nama_customer\":\"coki\",\"alamat_customer\":\"<p>jagiran<\\/p>\\r\\n\",\"no_telepon_customer\":\"087654432\",\"id_teknisi\":\"3\"}', 0),
(198, 'admin', '127.0.0.1', 'update-perbaikan', 'Thu Nov 11 21:27:48 WIB 2021', '{\"tanggal_selesai_perbaikan\":\"2021-11-11\",\"status_perbaikan\":1}', 0),
(199, 'admin', '127.0.0.1', 'update-perbaikan', 'Thu Nov 11 21:28:49 WIB 2021', '{\"tanggal_selesai_perbaikan\":\"2021-11-11\",\"status_perbaikan\":1}', 0),
(200, 'admin', '127.0.0.1', 'update-perbaikan', 'Thu Nov 11 21:28:55 WIB 2021', '{\"tanggal_selesai_perbaikan\":\"2021-11-11\",\"status_perbaikan\":1}', 0),
(201, 'admin', '127.0.0.1', 'update-perbaikan', 'Thu Nov 11 21:29:19 WIB 2021', '{\"tanggal_selesai_perbaikan\":\"2021-11-11\",\"status_perbaikan\":1}', 0),
(202, 'admin', '127.0.0.1', 'logout', 'Thu Nov 11 21:33:27 WIB 2021', '{\"username\":\"admin\"}', 0),
(203, 'CS4', '127.0.0.1', 'login', 'Thu Nov 11 21:33:34 WIB 2021', '{\"username\":\"CS4\"}', 1),
(204, 'admin', '127.0.0.1', 'login', 'Thu Nov 11 21:33:45 WIB 2021', '{\"username\":\"admin\"}', 0),
(205, 'admin', '127.0.0.1', 'update-user', 'Thu Nov 11 21:33:58 WIB 2021', '{\"password\":\"81dc9bdb52d04dc20036dbd8313ed055\"}', 0),
(206, 'admin', '127.0.0.1', 'logout', 'Thu Nov 11 21:34:03 WIB 2021', '{\"username\":\"admin\"}', 0),
(207, 'CS4', '127.0.0.1', 'login', 'Thu Nov 11 21:34:10 WIB 2021', '{\"username\":\"CS4\"}', 0),
(208, 'Sonya Prakasawa', '127.0.0.1', 'insert-perbaikan', 'Thu Nov 11 21:34:37 WIB 2021', '{\"id_kerusakan\":\"5\",\"nama_customer\":\"alan\",\"alamat_customer\":\"<p>jagiran<\\/p>\\r\\n\",\"no_telepon_customer\":\"089993\",\"id_teknisi\":\"3\"}', 0),
(209, 'Sonya Prakasawa', '127.0.0.1', 'logout', 'Thu Nov 11 22:19:07 WIB 2021', '{\"username\":\"Sonya Prakasawa\"}', 0),
(210, 'admin', '127.0.0.1', 'login', 'Thu Nov 11 22:19:14 WIB 2021', '{\"username\":\"admin\"}', 0),
(211, 'admin', '127.0.0.1', 'logout', 'Thu Nov 11 22:19:47 WIB 2021', '{\"username\":\"admin\"}', 0),
(212, '', '127.0.0.1', 'login', 'Thu Nov 11 22:19:55 WIB 2021', '{\"username\":\"\"}', 1),
(213, 'admin', '127.0.0.1', 'login', 'Thu Nov 11 22:23:18 WIB 2021', '{\"username\":\"admin\"}', 0),
(214, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 11 22:51:54 WIB 2021', '{\"kode_kerusakan\":\"1\",\"kode_gejala\":[\"1\",\"4\"]}', 0),
(215, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 11 22:52:04 WIB 2021', '{\"kode_kerusakan\":\"2\",\"kode_gejala\":[\"1\",\"5\",\"6\"]}', 0),
(216, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 11 22:52:14 WIB 2021', '{\"kode_kerusakan\":\"3\",\"kode_gejala\":[\"1\",\"7\",\"8\"]}', 0),
(217, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 11 22:52:23 WIB 2021', '{\"kode_kerusakan\":\"4\",\"kode_gejala\":[\"2\",\"9\"]}', 0),
(218, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 11 22:53:14 WIB 2021', '{\"kode_kerusakan\":\"5\",\"kode_gejala\":[\"2\",\"10\",\"11\"]}', 0),
(219, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 11 22:53:59 WIB 2021', '{\"kode_kerusakan\":\"6\",\"kode_gejala\":[\"3\",\"12\",\"13\"]}', 0),
(220, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 11 22:54:11 WIB 2021', '{\"kode_kerusakan\":\"7\",\"kode_gejala\":[\"3\",\"14\"]}', 0),
(221, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 11 22:54:35 WIB 2021', '{\"kode_kerusakan\":\"8\",\"kode_gejala\":[\"3\",\"15\",\"16\",\"17\"]}', 0),
(222, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 11 22:54:52 WIB 2021', '{\"kode_kerusakan\":\"9\",\"kode_gejala\":[\"3\",\"15\",\"18\"]}', 0),
(223, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 11 22:55:10 WIB 2021', '{\"kode_kerusakan\":\"10\",\"kode_gejala\":[\"3\",\"19\",\"20\"]}', 0),
(224, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 11 22:55:22 WIB 2021', '{\"kode_kerusakan\":\"11\",\"kode_gejala\":[\"3\",\"21\",\"22\"]}', 0),
(225, 'admin', '127.0.0.1', 'insert-aturan', 'Thu Nov 11 22:55:28 WIB 2021', '{\"kode_kerusakan\":\"12\",\"kode_gejala\":[\"3\",\"23\",\"24\"]}', 0),
(226, 'admin', '127.0.0.1', 'logout', 'Thu Nov 11 23:05:39 WIB 2021', '{\"username\":\"admin\"}', 0),
(227, 'admin', '::1', 'login', 'Fri Nov 12 10:35:55 WIB 2021', '{\"username\":\"admin\"}', 0),
(228, 'admin', '::1', 'logout', 'Fri Nov 12 10:43:50 WIB 2021', '{\"username\":\"admin\"}', 0),
(229, 'admin', '::1', 'login', 'Fri Nov 12 11:22:36 WIB 2021', '{\"username\":\"admin\"}', 0),
(230, 'admin', '::1', 'login', 'Fri Nov 12 19:40:37 WIB 2021', '{\"username\":\"admin\"}', 0),
(231, 'admin', '::1', 'insert-aturan', 'Fri Nov 12 19:41:22 WIB 2021', '{\"kode_kerusakan\":\"\"}', 1),
(232, 'admin', '::1', 'insert-aturan', 'Fri Nov 12 20:14:19 WIB 2021', '{\"kode_kerusakan\":\"1\",\"kode_gejala\":[\"1\",\"4\"]}', 0),
(233, 'admin', '::1', 'insert-aturan', 'Fri Nov 12 20:14:43 WIB 2021', '{\"kode_kerusakan\":\"2\",\"kode_gejala\":[\"1\",\"5\",\"6\"]}', 0),
(234, 'admin', '::1', 'insert-aturan', 'Fri Nov 12 20:29:01 WIB 2021', '{\"kode_kerusakan\":\"3\",\"kode_gejala\":[\"1\",\"7\",\"8\"]}', 0),
(235, 'admin', '::1', 'insert-aturan', 'Fri Nov 12 20:29:19 WIB 2021', '{\"kode_kerusakan\":\"4\",\"kode_gejala\":[\"2\",\"9\"]}', 0),
(236, 'admin', '::1', 'insert-aturan', 'Fri Nov 12 20:29:32 WIB 2021', '{\"kode_kerusakan\":\"5\",\"kode_gejala\":[\"2\",\"10\",\"11\"]}', 0),
(237, 'admin', '::1', 'insert-aturan', 'Fri Nov 12 20:29:59 WIB 2021', '{\"kode_kerusakan\":\"6\",\"kode_gejala\":[\"3\",\"12\",\"13\"]}', 0),
(238, 'admin', '::1', 'insert-aturan', 'Fri Nov 12 20:30:29 WIB 2021', '{\"kode_kerusakan\":\"7\",\"kode_gejala\":[\"3\",\"14\"]}', 0),
(239, 'admin', '::1', 'insert-aturan', 'Fri Nov 12 20:31:21 WIB 2021', '{\"kode_kerusakan\":\"8\",\"kode_gejala\":[\"3\",\"15\",\"16\",\"17\"]}', 0),
(240, 'admin', '::1', 'insert-aturan', 'Fri Nov 12 20:31:32 WIB 2021', '{\"kode_kerusakan\":\"9\",\"kode_gejala\":[\"3\",\"15\",\"18\"]}', 0),
(241, 'admin', '::1', 'insert-aturan', 'Fri Nov 12 20:31:51 WIB 2021', '{\"kode_kerusakan\":\"10\",\"kode_gejala\":[\"3\",\"19\",\"20\"]}', 0),
(242, 'admin', '::1', 'insert-aturan', 'Fri Nov 12 20:32:01 WIB 2021', '{\"kode_kerusakan\":\"11\",\"kode_gejala\":[\"3\",\"21\",\"22\"]}', 0),
(243, 'admin', '::1', 'insert-aturan', 'Fri Nov 12 20:32:09 WIB 2021', '{\"kode_kerusakan\":\"12\",\"kode_gejala\":[\"3\",\"23\",\"24\"]}', 0),
(244, 'admin', '::1', 'insert-perbaikan', 'Fri Nov 12 20:32:27 WIB 2021', '{\"id_kerusakan\":\"5\",\"nama_customer\":\"adinda\",\"alamat_customer\":\"<p>ffff<\\/p>\\r\\n\",\"no_telepon_customer\":\"09865434\",\"id_teknisi\":\"3\"}', 0),
(245, 'admin', '::1', 'insert-perbaikan', 'Fri Nov 12 20:32:54 WIB 2021', '{\"id_kerusakan\":\"8\",\"nama_customer\":\"adinda\",\"alamat_customer\":\"<p>ffff<\\/p>\\r\\n\",\"no_telepon_customer\":\"09865434\",\"id_teknisi\":\"3\"}', 0),
(246, 'admin', '::1', 'insert-perbaikan', 'Fri Nov 12 20:33:41 WIB 2021', '{\"id_kerusakan\":\"2\",\"nama_customer\":\"jena\",\"alamat_customer\":\"<p>cccc<\\/p>\\r\\n\",\"no_telepon_customer\":\"09865434\",\"id_teknisi\":\"3\"}', 0),
(247, 'admin', '::1', 'insert-aturan', 'Fri Nov 12 21:04:16 WIB 2021', '{\"kode_kerusakan\":\"\"}', 1),
(248, 'admin', '::1', 'insert-aturan', 'Fri Nov 12 21:18:49 WIB 2021', '{\"kode_kerusakan\":\"3\",\"kode_gejala\":[\"1\",\"4\",\"6\",\"7\",\"8\"]}', 0),
(249, 'admin', '::1', 'update-aturan', 'Fri Nov 12 21:18:57 WIB 2021', '{\"id\":\"13\",\"kode_kerusakan\":\"3\",\"kode_gejala\":[\"1\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\"]}', 0),
(250, 'admin', '::1', 'update-aturan', 'Fri Nov 12 21:19:05 WIB 2021', '{\"id\":\"13\",\"kode_kerusakan\":\"3\",\"kode_gejala\":[\"1\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"10\"]}', 0),
(251, 'admin', '::1', 'hapus-aturan', 'Fri Nov 12 21:20:54 WIB 2021', '{\"rule_breadth\":[{\"id\":\"33\",\"id_rule\":\"13\",\"parent_kode_gejala\":\"1\",\"child_kode_gejala\":\"3\",\"kode_kerusakan\":null},{\"id\":\"34\",\"id_rule\":\"13\",\"parent_kode_gejala\":\"3\",\"child_kode_gejala\":\"4\",\"kode_kerusakan\":null},{\"id\":\"35\",\"id_rule\":\"13\",\"parent_kode_gejala\":\"4\",\"child_kode_gejala\":\"5\",\"kode_kerusakan\":null},{\"id\":\"36\",\"id_rule\":\"13\",\"parent_kode_gejala\":\"5\",\"child_kode_gejala\":\"6\",\"kode_kerusakan\":null},{\"id\":\"37\",\"id_rule\":\"13\",\"parent_kode_gejala\":\"6\",\"child_kode_gejala\":\"7\",\"kode_kerusakan\":null},{\"id\":\"38\",\"id_rule\":\"13\",\"parent_kode_gejala\":\"7\",\"child_kode_gejala\":\"8\",\"kode_kerusakan\":null},{\"id\":\"39\",\"id_rule\":\"13\",\"parent_kode_gejala\":\"8\",\"child_kode_gejala\":\"10\",\"kode_kerusakan\":\"3\"}],\"rule\":{\"id\":\"13\",\"kode_kerusakan\":\"3\",\"gejala\":\"1->3->4->5->6->7->8->10\"}}', 0),
(252, 'admin', '::1', 'logout', 'Fri Nov 12 21:53:59 WIB 2021', '{\"username\":\"admin\"}', 0);

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
-- Table structure for table `konsultasi_tmp`
--

CREATE TABLE `konsultasi_tmp` (
  `id` int(11) NOT NULL,
  `id_customer_service` int(11) DEFAULT NULL,
  `id_gejala` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 1, 'admin', 'ee11cbb19052e40b07aac0ca060c23ee', 0, NULL, 'Fri Nov 12 21:53:59 WIB 2021'),
(2, 4, 'CS4', '81dc9bdb52d04dc20036dbd8313ed055', 0, NULL, 'Thu Nov 11 22:19:07 WIB 2021');

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
(1, 1, 'admin', 'admin', 'admin', '111'),
(3, 4, 'TK2', 'Jaka', 'jagiran', '0887777'),
(4, 3, 'CS4', 'Sonya Prakasawa', 'Jl. Jagiran', '089764');

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
-- Table structure for table `perbaikan`
--

CREATE TABLE `perbaikan` (
  `id` int(11) NOT NULL,
  `id_customer_service` int(11) DEFAULT NULL,
  `id_kerusakan` int(11) DEFAULT NULL,
  `id_teknisi` int(11) DEFAULT NULL,
  `nama_customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_customer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telepon_customer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_konsultasi` date DEFAULT NULL,
  `tanggal_mulai_perbaikan` date DEFAULT NULL,
  `tanggal_selesai_perbaikan` date DEFAULT NULL,
  `status_perbaikan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perbaikan`
--

INSERT INTO `perbaikan` (`id`, `id_customer_service`, `id_kerusakan`, `id_teknisi`, `nama_customer`, `alamat_customer`, `no_telepon_customer`, `tanggal_konsultasi`, `tanggal_mulai_perbaikan`, `tanggal_selesai_perbaikan`, `status_perbaikan`) VALUES
(1, 1, 5, 3, 'joko', '<p>dddd</p>\r\n', '09865434', '2021-11-11', '2021-11-11', '2021-11-11', 1),
(2, 1, 5, 3, 'adinda', '<p>ggg</p>\r\n', '09865434', '2021-11-11', '2021-11-11', '2021-11-11', 1),
(3, 1, 9, 3, 'adinda', '<p>ffff</p>\r\n', '09865434', '2021-11-11', '2021-11-11', '2021-11-11', 1),
(4, 1, 1, 3, 'coki', '<p>jagiran</p>\r\n', '087654432', '2021-11-11', '2021-11-11', '2021-11-11', 1),
(5, 4, 5, 3, 'alan', '<p>jagiran</p>\r\n', '089993', '2021-11-11', '2021-11-11', NULL, 0),
(6, 1, 5, 3, 'adinda', '<p>ffff</p>\r\n', '09865434', '2021-11-12', '2021-11-12', NULL, 0),
(7, 1, 8, 3, 'adinda', '<p>ffff</p>\r\n', '09865434', '2021-11-12', '2021-11-12', NULL, 0),
(8, 1, 2, 3, 'jena', '<p>cccc</p>\r\n', '09865434', '2021-11-12', '2021-11-12', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `perbaikan_gejala`
--

CREATE TABLE `perbaikan_gejala` (
  `id` int(11) NOT NULL,
  `id_perbaikan` int(11) DEFAULT NULL,
  `id_gejala` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perbaikan_gejala`
--

INSERT INTO `perbaikan_gejala` (`id`, `id_perbaikan`, `id_gejala`) VALUES
(1, 1, 2),
(2, 1, 10),
(3, 1, 11),
(4, 2, 2),
(5, 2, 10),
(6, 2, 11),
(7, 3, 3),
(8, 3, 15),
(9, 3, 18),
(10, 4, 1),
(11, 4, 4),
(12, 5, 2),
(13, 5, 10),
(14, 5, 11),
(15, 6, 2),
(16, 6, 10),
(17, 6, 11),
(18, 7, 3),
(19, 7, 15),
(20, 7, 16),
(21, 7, 17),
(22, 8, 1),
(23, 8, 5),
(24, 8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `rule`
--

CREATE TABLE `rule` (
  `id` int(11) NOT NULL,
  `kode_kerusakan` int(11) DEFAULT NULL,
  `gejala` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id`, `kode_kerusakan`, `gejala`) VALUES
(1, 1, '1->4'),
(2, 2, '1->5->6'),
(3, 3, '1->7->8'),
(4, 4, '2->9'),
(5, 5, '2->10->11'),
(6, 6, '3->12->13'),
(7, 7, '3->14'),
(8, 8, '3->15->16->17'),
(9, 9, '3->15->18'),
(10, 10, '3->19->20'),
(11, 11, '3->21->22'),
(12, 12, '3->23->24');

-- --------------------------------------------------------

--
-- Table structure for table `rule_breadth`
--

CREATE TABLE `rule_breadth` (
  `id` int(11) NOT NULL,
  `id_rule` int(11) DEFAULT NULL,
  `parent_kode_gejala` int(11) DEFAULT NULL,
  `child_kode_gejala` int(11) DEFAULT NULL,
  `kode_kerusakan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rule_breadth`
--

INSERT INTO `rule_breadth` (`id`, `id_rule`, `parent_kode_gejala`, `child_kode_gejala`, `kode_kerusakan`) VALUES
(1, 1, 1, 4, 1),
(2, 2, 1, 5, NULL),
(3, 2, 5, 6, 2),
(4, 3, 1, 7, NULL),
(5, 3, 7, 8, 3),
(6, 4, 2, 9, 4),
(7, 5, 2, 10, NULL),
(8, 5, 10, 11, 5),
(9, 6, 3, 12, NULL),
(10, 6, 12, 13, 6),
(11, 7, 3, 14, 7),
(12, 8, 3, 15, NULL),
(13, 8, 15, 16, NULL),
(14, 8, 16, 17, 8),
(15, 9, 3, 15, NULL),
(16, 9, 15, 18, 9),
(17, 10, 3, 19, NULL),
(18, 10, 19, 20, 10),
(19, 11, 3, 21, NULL),
(20, 11, 21, 22, 11),
(21, 12, 3, 23, NULL),
(22, 12, 23, 24, 12);

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `konsultasi_tmp`
--
ALTER TABLE `konsultasi_tmp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer_service` (`id_customer_service`),
  ADD KEY `id_gejala` (`id_gejala`);

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
-- Indexes for table `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer_service` (`id_customer_service`),
  ADD KEY `id_kerusakan` (`id_kerusakan`),
  ADD KEY `id_teknisi` (`id_teknisi`);

--
-- Indexes for table `perbaikan_gejala`
--
ALTER TABLE `perbaikan_gejala`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perbaikan` (`id_perbaikan`),
  ADD KEY `id_gejala` (`id_gejala`);

--
-- Indexes for table `rule`
--
ALTER TABLE `rule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_kerusakan` (`kode_kerusakan`);

--
-- Indexes for table `rule_breadth`
--
ALTER TABLE `rule_breadth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rule` (`id_rule`),
  ADD KEY `parent_kode_gejala` (`parent_kode_gejala`),
  ADD KEY `child_kode_gejala` (`child_kode_gejala`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

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
-- AUTO_INCREMENT for table `konsultasi_tmp`
--
ALTER TABLE `konsultasi_tmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `ms_role`
--
ALTER TABLE `ms_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ms_user`
--
ALTER TABLE `ms_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `penyebab_kerusakan`
--
ALTER TABLE `penyebab_kerusakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `perbaikan`
--
ALTER TABLE `perbaikan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `perbaikan_gejala`
--
ALTER TABLE `perbaikan_gejala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rule`
--
ALTER TABLE `rule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rule_breadth`
--
ALTER TABLE `rule_breadth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `konsultasi_tmp`
--
ALTER TABLE `konsultasi_tmp`
  ADD CONSTRAINT `konsultasi_tmp_ibfk_1` FOREIGN KEY (`id_customer_service`) REFERENCES `pegawai` (`id`),
  ADD CONSTRAINT `konsultasi_tmp_ibfk_2` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id`);

--
-- Constraints for table `perbaikan`
--
ALTER TABLE `perbaikan`
  ADD CONSTRAINT `perbaikan_ibfk_1` FOREIGN KEY (`id_customer_service`) REFERENCES `pegawai` (`id`),
  ADD CONSTRAINT `perbaikan_ibfk_2` FOREIGN KEY (`id_kerusakan`) REFERENCES `kerusakan` (`id`),
  ADD CONSTRAINT `perbaikan_ibfk_3` FOREIGN KEY (`id_teknisi`) REFERENCES `pegawai` (`id`);

--
-- Constraints for table `perbaikan_gejala`
--
ALTER TABLE `perbaikan_gejala`
  ADD CONSTRAINT `perbaikan_gejala_ibfk_1` FOREIGN KEY (`id_perbaikan`) REFERENCES `perbaikan` (`id`),
  ADD CONSTRAINT `perbaikan_gejala_ibfk_2` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id`);

--
-- Constraints for table `rule`
--
ALTER TABLE `rule`
  ADD CONSTRAINT `rule_ibfk_1` FOREIGN KEY (`kode_kerusakan`) REFERENCES `kerusakan` (`id`);

--
-- Constraints for table `rule_breadth`
--
ALTER TABLE `rule_breadth`
  ADD CONSTRAINT `rule_breadth_ibfk_1` FOREIGN KEY (`id_rule`) REFERENCES `rule` (`id`),
  ADD CONSTRAINT `rule_breadth_ibfk_2` FOREIGN KEY (`parent_kode_gejala`) REFERENCES `gejala` (`id`),
  ADD CONSTRAINT `rule_breadth_ibfk_3` FOREIGN KEY (`child_kode_gejala`) REFERENCES `gejala` (`id`),
  ADD CONSTRAINT `rule_breadth_ibfk_4` FOREIGN KEY (`kode_kerusakan`) REFERENCES `kerusakan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
