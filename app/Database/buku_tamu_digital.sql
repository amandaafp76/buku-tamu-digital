-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 12, 2026 at 07:58 AM
-- Server version: 8.0.30
-- PHP Version: 8.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buku_tamu_digital`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `action` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `entity` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `entity_id` int UNSIGNED DEFAULT NULL,
  `activity` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `action`, `entity`, `entity_id`, `activity`, `created_at`, `updated_at`) VALUES
(1, 1, 'CREATE', 'users', 1, 'Membuat akun administrator.', '2026-09-22 02:51:26', '2026-09-22 02:51:26'),
(2, 1, 'CREATE', 'users', 2, 'Membuat akun petugas.', '2026-09-22 02:51:26', '2026-09-22 02:51:26'),
(3, 2, 'CHECK_IN', 'visits', 1, 'Melakukan check-in kunjungan VIS-0001.', '2026-09-22 02:51:26', '2026-09-22 02:51:26'),
(4, 1, 'create', 'department', 7, 'Menambahkan Bagian/Departemen \"Manajemen2\".', '2026-09-29 03:19:38', '2026-09-29 03:19:38'),
(5, 1, 'logout', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil logout.', '2026-09-29 04:19:05', '2026-09-29 04:19:05'),
(6, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-09-29 04:19:16', '2026-09-29 04:19:16'),
(7, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-09-29 06:22:57', '2026-09-29 06:22:57'),
(8, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-09-29 15:12:35', '2026-09-29 15:12:35'),
(9, 1, 'logout', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil logout.', '2026-09-29 15:14:34', '2026-09-29 15:14:34'),
(10, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-09-29 15:14:45', '2026-09-29 15:14:45'),
(11, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-09-29 15:15:15', '2026-09-29 15:15:15'),
(12, 2, 'logout', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil logout.', '2026-09-29 15:16:06', '2026-09-29 15:16:06'),
(13, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-09-29 15:16:33', '2026-09-29 15:16:33'),
(14, 2, 'logout', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil logout.', '2026-09-29 15:17:58', '2026-09-29 15:17:58'),
(15, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-09-29 15:18:10', '2026-09-29 15:18:10'),
(16, 1, 'logout', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil logout.', '2026-09-29 15:18:27', '2026-09-29 15:18:27'),
(17, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-09-29 15:18:48', '2026-09-29 15:18:48'),
(18, 2, 'logout', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil logout.', '2026-09-29 15:24:12', '2026-09-29 15:24:12'),
(19, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-09-29 15:39:08', '2026-09-29 15:39:08'),
(20, 2, 'logout', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil logout.', '2026-09-29 15:45:44', '2026-09-29 15:45:44'),
(21, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-09-29 15:45:52', '2026-09-29 15:45:52'),
(22, 1, 'logout', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil logout.', '2026-09-29 15:48:33', '2026-09-29 15:48:33'),
(23, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-09-29 15:48:43', '2026-09-29 15:48:43'),
(24, 2, 'logout', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil logout.', '2026-09-29 16:19:17', '2026-09-29 16:19:17'),
(25, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-09-29 16:20:08', '2026-09-29 16:20:08'),
(26, 1, 'logout', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil logout.', '2026-09-29 16:20:49', '2026-09-29 16:20:49'),
(27, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-09-29 16:21:05', '2026-09-29 16:21:05'),
(28, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-09-30 02:41:22', '2026-09-30 02:41:22'),
(29, 1, 'logout', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil logout.', '2026-09-30 09:46:28', '2026-09-30 09:46:28'),
(30, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-09-30 09:46:39', '2026-09-30 09:46:39'),
(31, 1, 'logout', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil logout.', '2026-09-30 09:50:30', '2026-09-30 09:50:30'),
(32, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-09-30 15:33:43', '2026-09-30 15:33:43'),
(33, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-01 09:58:58', '2026-10-01 09:58:58'),
(34, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-01 13:41:08', '2026-10-01 13:41:08'),
(35, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-01 22:52:39', '2026-10-01 22:52:39'),
(36, 1, 'logout', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil logout.', '2026-10-01 22:52:59', '2026-10-01 22:52:59'),
(37, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-02 09:39:53', '2026-10-02 09:39:53'),
(38, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-02 13:15:14', '2026-10-02 13:15:14'),
(39, 1, 'logout', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil logout.', '2026-10-02 15:54:46', '2026-10-02 15:54:46'),
(40, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-02 15:54:57', '2026-10-02 15:54:57'),
(41, 2, 'logout', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil logout.', '2026-10-02 15:55:23', '2026-10-02 15:55:23'),
(42, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-02 15:55:34', '2026-10-02 15:55:34'),
(43, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-04 21:28:10', '2026-10-04 21:28:10'),
(44, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-05 09:31:33', '2026-10-05 09:31:33'),
(45, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-05 09:33:02', '2026-10-05 09:33:02'),
(46, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-05 13:42:30', '2026-10-05 13:42:30'),
(47, 1, 'delete', 'visit', 6, 'Menghapus data kunjungan dengan kode \"VIS-70D92A3F\".', '2026-10-05 15:48:57', '2026-10-05 15:48:57'),
(48, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-06 09:18:49', '2026-10-06 09:18:49'),
(49, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-06 09:54:14', '2026-10-06 09:54:14'),
(50, 1, 'update', 'visit', 9, 'Memperbarui data kunjungan \"VIS-3B3AD0B7\".', '2026-10-06 10:13:26', '2026-10-06 10:13:26'),
(51, 1, 'update', 'visit', 9, 'Memperbarui data kunjungan \"VIS-3B3AD0B7\".', '2026-10-06 10:20:54', '2026-10-06 10:20:54'),
(52, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-06 22:10:18', '2026-10-06 22:10:18'),
(53, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-06 22:12:09', '2026-10-06 22:12:09'),
(54, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-07 09:19:20', '2026-10-07 09:19:20'),
(55, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-07 09:20:06', '2026-10-07 09:20:06'),
(56, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-07 13:19:05', '2026-10-07 13:19:05'),
(57, 1, 'update', 'employee', 3, 'Memperbarui data pegawai \"Andi Pratama Yuda Tama\".', '2026-10-07 14:47:53', '2026-10-07 14:47:53'),
(58, 1, 'create', 'employee', 7, 'Menambahkan pegawai \"Man\".', '2026-10-07 14:51:43', '2026-10-07 14:51:43'),
(59, 1, 'delete', 'employee', 7, 'Menghapus pegawai \"Man\".', '2026-10-07 14:51:53', '2026-10-07 14:51:53'),
(60, 1, 'update', 'department', 1, 'Memperbarui Bagian/Departemen \"Administrasi Bisnis\".', '2026-10-07 16:42:15', '2026-10-07 16:42:15'),
(61, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-07 19:22:11', '2026-10-07 19:22:11'),
(62, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-07 19:23:19', '2026-10-07 19:23:19'),
(63, 1, 'update', 'user', 5, 'Menonaktifkan pengguna \"sasa\".', '2026-10-07 19:33:38', '2026-10-07 19:33:38'),
(64, 1, 'update', 'user', 5, 'Mengaktifkan pengguna \"sasa\".', '2026-10-07 19:33:42', '2026-10-07 19:33:42'),
(65, 1, 'update', 'user', 6, 'Menonaktifkan pengguna \"reka\".', '2026-10-07 19:33:52', '2026-10-07 19:33:52'),
(66, 1, 'update', 'user', 5, 'Menonaktifkan pengguna \"sasa\".', '2026-10-07 19:33:55', '2026-10-07 19:33:55'),
(67, 1, 'update', 'user', 2, 'Menonaktifkan pengguna \"petugas@bukutamu.com\".', '2026-10-07 19:33:56', '2026-10-07 19:33:56'),
(68, 1, 'update', 'user', 2, 'Mengaktifkan pengguna \"petugas@bukutamu.com\".', '2026-10-07 19:37:16', '2026-10-07 19:37:16'),
(69, 1, 'update', 'user', 6, 'Mengaktifkan pengguna \"reka\".', '2026-10-07 19:37:19', '2026-10-07 19:37:19'),
(70, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-07 22:11:53', '2026-10-07 22:11:53'),
(71, 1, 'update', 'setting', 1, 'Memperbarui konfigurasi sistem untuk institusi \"Buku Tamu Digital Pernikahan\".', '2026-10-08 00:03:39', '2026-10-08 00:03:39'),
(72, 1, 'update', 'setting', 1, 'Memperbarui konfigurasi sistem untuk institusi \"Buku Tamu Digital Pernikahan\".', '2026-10-08 00:05:11', '2026-10-08 00:05:11'),
(73, 1, 'update', 'setting', 1, 'Memperbarui konfigurasi sistem untuk institusi \"Buku Tamu Digital Pernikahan\".', '2026-10-08 00:06:05', '2026-10-08 00:06:05'),
(74, 1, 'update', 'setting', 1, 'Memperbarui konfigurasi sistem untuk institusi \"Buku Tamu Digital Pernikahan\".', '2026-10-08 00:16:53', '2026-10-08 00:16:53'),
(75, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-08 09:07:02', '2026-10-08 09:07:02'),
(76, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-08 09:07:29', '2026-10-08 09:07:29'),
(77, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-08 13:09:33', '2026-10-08 13:09:33'),
(78, 2, 'logout', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil logout.', '2026-10-08 13:23:52', '2026-10-08 13:23:52'),
(79, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-08 13:24:37', '2026-10-08 13:24:37'),
(80, 2, 'logout', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil logout.', '2026-10-08 13:36:53', '2026-10-08 13:36:53'),
(81, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-08 13:54:21', '2026-10-08 13:54:21'),
(82, 1, 'create', 'notification_template', 4, 'Menambahkan template pesan \"visit_warning\" untuk penerima \"guest\".', '2026-10-08 13:56:00', '2026-10-08 13:56:00'),
(83, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-09 09:11:44', '2026-10-09 09:11:44'),
(84, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-09 09:12:21', '2026-10-09 09:12:21'),
(85, 1, 'logout', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil logout.', '2026-10-09 09:23:52', '2026-10-09 09:23:52'),
(86, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-09 09:23:56', '2026-10-09 09:23:56'),
(87, 1, 'logout', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil logout.', '2026-10-09 09:24:14', '2026-10-09 09:24:14'),
(88, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-09 09:43:44', '2026-10-09 09:43:44'),
(89, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-09 16:48:33', '2026-10-09 16:48:33'),
(90, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-09 16:57:53', '2026-10-09 16:57:53'),
(91, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-10 18:38:26', '2026-10-10 18:38:26'),
(92, 2, 'logout', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil logout.', '2026-10-10 18:39:16', '2026-10-10 18:39:16'),
(93, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-10 18:39:27', '2026-10-10 18:39:27'),
(94, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-10 18:39:47', '2026-10-10 18:39:47'),
(95, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-10 22:35:18', '2026-10-10 22:35:18'),
(96, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-11 09:04:41', '2026-10-11 09:04:41'),
(97, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-11 09:17:59', '2026-10-11 09:17:59'),
(98, 1, 'create', 'employee', 8, 'Menambahkan pegawai \"Susi\".', '2026-10-11 10:37:45', '2026-10-11 10:37:45'),
(99, 1, 'update', 'employee', 8, 'Memperbarui data pegawai \"Susi Linawati\".', '2026-10-11 10:38:04', '2026-10-11 10:38:04'),
(100, 1, 'delete', 'employee', 8, 'Menghapus pegawai \"Susi Linawati\".', '2026-10-11 10:38:11', '2026-10-11 10:38:11'),
(101, 1, 'restore', 'employee', 8, 'Memulihkan pegawai \"Susi Linawati\".', '2026-10-11 10:53:22', '2026-10-11 10:53:22'),
(102, 1, 'create', 'department', 8, 'Menambahkan Bagian/Departemen \"Teknisi\".', '2026-10-11 11:19:53', '2026-10-11 11:19:53'),
(103, 1, 'update', 'department', 8, 'Memperbarui Bagian/Departemen \"Teknisi\".', '2026-10-11 11:20:04', '2026-10-11 11:20:04'),
(104, 1, 'delete', 'department', 8, 'Menghapus Bagian/Departemen \"Teknisi\".', '2026-10-11 11:20:13', '2026-10-11 11:20:13'),
(105, 1, 'restore', 'department', 8, 'Memulihkan Bagian/Departemen \"Teknisi\".', '2026-10-11 11:20:20', '2026-10-11 11:20:20'),
(106, 1, 'create', 'visit_purpose', 8, 'Menambahkan Tujuan Kunjungan \"Diskusi\".', '2026-10-11 11:36:07', '2026-10-11 11:36:07'),
(107, 1, 'update', 'visit_purpose', 8, 'Memperbarui Tujuan Kunjungan \"Diskusi\".', '2026-10-11 11:36:17', '2026-10-11 11:36:17'),
(108, 1, 'delete', 'visit_purpose', 8, 'Menghapus Tujuan Kunjungan \"Diskusi\".', '2026-10-11 11:36:22', '2026-10-11 11:36:22'),
(109, 1, 'restore', 'visit_purpose', 8, 'Memulihkan Tujuan Kunjungan \"Diskusi\".', '2026-10-11 11:36:28', '2026-10-11 11:36:28'),
(110, 1, 'delete', 'user', 5, 'Menghapus pengguna \"sasa\".', '2026-10-11 13:29:15', '2026-10-11 13:29:15'),
(111, 1, 'restore', 'user', 5, 'Memulihkan pengguna \"sasa\".', '2026-10-11 13:29:23', '2026-10-11 13:29:23'),
(112, 1, 'delete', 'visit', 3, 'Menghapus data kunjungan dengan kode \"VIS-0003\".', '2026-10-11 13:54:04', '2026-10-11 13:54:04'),
(113, 1, 'restore', 'visit', 3, 'Memulihkan data kunjungan dengan kode \"VIS-0003\".', '2026-10-11 13:54:11', '2026-10-11 13:54:11'),
(114, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-11 13:56:26', '2026-10-11 13:56:26'),
(115, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-11 16:52:54', '2026-10-11 16:52:54'),
(116, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-11 17:00:04', '2026-10-11 17:00:04'),
(117, 1, 'update', 'visit', 11, 'Memperbarui data kunjungan \"VIS-76FA59FC\".', '2026-10-11 18:03:02', '2026-10-11 18:03:02'),
(118, 1, 'update', 'setting', 1, 'Memperbarui konfigurasi sistem untuk institusi \"Buku Tamu Digital Pernikahan\".', '2026-10-11 19:08:51', '2026-10-11 19:08:51'),
(119, 1, 'update', 'setting', 1, 'Memperbarui konfigurasi sistem untuk institusi \"Buku Tamu Digital Pernikahan\".', '2026-10-11 19:10:08', '2026-10-11 19:10:08'),
(120, 1, 'update', 'institution', 1, 'Memperbarui identitas institusi \"Buku Tamu Digital Pernikahan\".', '2026-10-11 19:11:27', '2026-10-11 19:11:27'),
(121, 1, 'update', 'institution', 1, 'Memperbarui identitas institusi \"Buku Tamu Digital Pernikahan\".', '2026-10-11 19:11:47', '2026-10-11 19:11:47'),
(122, 1, 'create', 'notification_template', 5, 'Menambahkan template pesan \"new_guest_arrival\" untuk penerima \"employee\".', '2026-10-11 20:12:02', '2026-10-11 20:12:02'),
(123, 1, 'create', 'notification_template', 6, 'Menambahkan template pesan \"visit_approved\" untuk penerima \"guest\".', '2026-10-11 20:12:24', '2026-10-11 20:12:24'),
(124, 1, 'create', 'notification_template', 7, 'Menambahkan template pesan \"visit_completed\" untuk penerima \"guest\".', '2026-10-11 20:13:01', '2026-10-11 20:13:01'),
(125, 1, 'update', 'wakita', 1, 'Memperbarui konfigurasi WAKITA untuk institusi \"Buku Tamu Digital Pernikahan\".', '2026-10-11 20:21:21', '2026-10-11 20:21:21'),
(126, 1, 'update', 'wakita', 1, 'Memperbarui konfigurasi WAKITA untuk institusi \"Buku Tamu Digital Pernikahan\".', '2026-10-11 20:21:59', '2026-10-11 20:21:59'),
(127, 1, 'update', 'wakita', 1, 'Memperbarui konfigurasi WAKITA untuk institusi \"Buku Tamu Digital Pernikahan\".', '2026-10-11 20:31:21', '2026-10-11 20:31:21'),
(128, 1, 'update', 'wakita', 1, 'Memperbarui konfigurasi WAKITA untuk institusi \"Buku Tamu Digital Pernikahan\".', '2026-10-11 20:37:09', '2026-10-11 20:37:09'),
(129, 1, 'create', 'employee', 9, 'Menambahkan pegawai \"Manda\".', '2026-10-11 20:51:54', '2026-10-11 20:51:54'),
(130, 2, 'logout', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil logout.', '2026-10-11 23:19:56', '2026-10-11 23:19:56'),
(131, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-11 23:35:21', '2026-10-11 23:35:21'),
(132, 2, 'logout', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil logout.', '2026-10-11 23:44:24', '2026-10-11 23:44:24'),
(133, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-11 23:51:26', '2026-10-11 23:51:26'),
(134, 2, 'login', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil login.', '2026-10-12 09:27:58', '2026-10-12 09:27:58'),
(135, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-12 11:35:26', '2026-10-12 11:35:26'),
(136, 2, 'logout', 'auth', 2, 'Pengguna \"petugas@bukutamu.com\" berhasil logout.', '2026-10-12 13:22:03', '2026-10-12 13:22:03'),
(137, 1, 'login', 'auth', 1, 'Pengguna \"admin@bukutamu.com\" berhasil login.', '2026-10-12 13:49:59', '2026-10-12 13:49:59'),
(138, 1, 'update', 'setting', 1, 'Memperbarui konfigurasi sistem untuk institusi \"Buku Tamu Digital Pernikahan\".', '2026-10-12 13:51:26', '2026-10-12 13:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrasi Bisnis', 'Bagian administrasi dan pelayanan umum.', 1, '2026-09-22 02:25:53', '2026-10-07 16:42:15', NULL),
(2, 'Keuangan', 'Bagian pengelolaan administrasi keuangan.', 1, '2026-09-22 02:25:53', '2026-09-22 02:25:53', NULL),
(3, 'Kepegawaian', 'Bagian pengelolaan administrasi kepegawaian.', 1, '2026-09-22 02:25:53', '2026-09-22 02:25:53', NULL),
(4, 'Teknologi Informasi', 'Bagian pengelolaan teknologi informasi.', 1, '2026-09-22 02:25:53', '2026-09-22 02:25:53', NULL),
(6, 'Manajemen', NULL, 1, '2026-09-28 18:04:35', '2026-09-28 18:04:41', '2026-09-28 18:04:41'),
(7, 'Manajemen2', NULL, 1, '2026-09-29 03:19:38', '2026-09-29 03:19:38', NULL),
(8, 'Teknisi', NULL, 0, '2026-10-11 11:19:53', '2026-10-11 11:20:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int UNSIGNED NOT NULL,
  `department_id` int UNSIGNED NOT NULL,
  `employee_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `department_id`, `employee_name`, `phone`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Budi Santoso', '081234567891', 1, '2026-09-22 02:27:59', '2026-09-22 02:27:59', NULL),
(2, 1, 'Siti Aminah', '081234567892', 1, '2026-09-22 02:27:59', '2026-09-22 02:27:59', NULL),
(3, 2, 'Andi Pratama Yuda Tama', '081234567893', 1, '2026-09-22 02:27:59', '2026-10-07 14:47:53', NULL),
(4, 3, 'Dewi Lestari', '081234567894', 1, '2026-09-22 02:27:59', '2026-09-22 02:27:59', NULL),
(5, 4, 'Rizky Maulana', '081234567895', 1, '2026-09-22 02:27:59', '2026-09-22 02:27:59', NULL),
(6, 1, 'man', '087666666', 1, '2026-09-24 09:30:25', '2026-09-28 17:41:18', '2026-09-28 17:41:18'),
(7, 1, 'Man', '081234567890', 0, '2026-10-07 14:51:43', '2026-10-07 14:51:53', '2026-10-07 14:51:53'),
(8, 2, 'Susi Linawati', '08123456789', 1, '2026-10-11 10:37:45', '2026-10-11 10:38:11', NULL),
(9, 1, 'Manda', '085730435430', 1, '2026-10-11 20:51:54', '2026-10-11 20:51:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` int UNSIGNED NOT NULL,
  `guest_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `institution` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `guest_name`, `phone`, `address`, `institution`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad Fauzi', '081234567896', 'Jl. Merdeka No. 10', 'PT Maju Jaya', '2026-09-22 02:29:36', '2026-09-22 02:29:36'),
(2, 'Rina Wulandari', '081234567897', 'Jl. Diponegoro No. 20', 'CV Sejahtera', '2026-09-22 02:29:36', '2026-09-22 02:29:36'),
(3, 'Fajar Hidayat', '081234567898', 'Jl. Sudirman No. 15', 'Universitas Nusantara', '2026-09-22 02:29:36', '2026-09-22 02:29:36'),
(4, 'Amanda Fahma Putri', '+6285730435430', 'Kedungrejo, Pilangkenceng', 'Politeknik Negeri Madiun', '2026-10-02 14:15:49', '2026-10-02 14:15:49'),
(5, 'Amanda Fahma Putri', '+6285730435430', 'Kedungrejo, Pilangkenceng', 'Politeknik Negeri Madiun', '2026-10-02 14:44:17', '2026-10-02 14:44:17'),
(6, 'Amanda Fahma Putri', '+6285730435430', 'Kedungrejo, Pilangkenceng', 'kantor jawa timur', '2026-10-04 21:27:13', '2026-10-04 21:27:13'),
(7, 'Amanda', '+6285730435555', 'Madiun', 'PT Kusuma Wijaya', '2026-10-04 23:37:26', '2026-10-04 23:37:26'),
(8, 'manda', '085222666098', 'Madiun', 'PT Argo Moro', '2026-10-05 09:50:56', '2026-10-05 09:50:56'),
(9, 'Amanda Fahma', '085730435123', 'Jakarta Selatan', 'PT Jaya Abadi', '2026-10-06 09:22:48', '2026-10-06 10:20:54'),
(10, 'Putri Fahma', '0865432990', 'Solo', 'PT Argo Moro', '2026-10-08 00:08:02', '2026-10-08 00:08:02'),
(11, 'Putri', '085730444999', 'Kalimantan', 'PT Mawar Indah', '2026-10-09 11:06:33', '2026-10-11 18:03:02'),
(12, 'Idha', '08834567890', 'Bandung', 'PT Bandung Abadi', '2026-10-11 20:16:28', '2026-10-11 20:16:28'),
(13, 'Laila', '081946220711', 'Madiun', 'PT Jaya Abadi', '2026-10-11 20:24:29', '2026-10-11 20:24:29'),
(14, 'Idha Lailatul', '081946220711', 'Madiun Jawa Timur', 'PT Kusuma Wijaya', '2026-10-11 20:30:04', '2026-10-11 20:30:04'),
(15, 'Amanda Putri', '081946220711', 'Pilangkenceng Madiun', 'PT Kusuma Wijaya', '2026-10-11 20:38:58', '2026-10-11 20:38:58'),
(16, 'Mawar', '081946220711', 'Madiun', 'PT Mawar Indah', '2026-10-11 20:53:56', '2026-10-11 20:53:56'),
(17, 'Ros', '081946220711', 'Madiun', 'PT Argo Moro', '2026-10-11 21:01:33', '2026-10-11 21:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `phone` varchar(17) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`id`, `name`, `address`, `phone`, `email`, `logo`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Buku Tamu Digital Pernikahan', 'Jl. Ahmad Yani No. 1', '081234567890', 'admin@bukutamu.test', 'uploads/institutions/1791720687_ecf9a83455ca3ed9f464.png', 1, '2026-09-22 02:23:20', '2026-10-11 19:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-09-21-070837', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1789974732, 1),
(2, '2026-09-21-071851', 'App\\Database\\Migrations\\CreateInstitutionsTable', 'default', 'App', 1789975413, 2),
(3, '2026-09-21-073033', 'App\\Database\\Migrations\\CreateDepartmentsTable', 'default', 'App', 1789975969, 3),
(4, '2026-09-21-075125', 'App\\Database\\Migrations\\CreateEmployeesTable', 'default', 'App', 1789977358, 4),
(5, '2026-09-21-075637', 'App\\Database\\Migrations\\CreateGuestsTable', 'default', 'App', 1789977736, 5),
(6, '2026-09-21-080324', 'App\\Database\\Migrations\\CreateVisitPurposesTable', 'default', 'App', 1789977962, 6),
(9, '2026-09-21-080703', 'App\\Database\\Migrations\\CreateVisitsTable', 'default', 'App', 1789980578, 7),
(10, '2026-09-21-081052', 'App\\Database\\Migrations\\CreateNotificationTemplatesTable', 'default', 'App', 1789980578, 7),
(11, '2026-09-21-081425', 'App\\Database\\Migrations\\CreateSettingsTable', 'default', 'App', 1789980578, 7),
(12, '2026-09-21-085154', 'App\\Database\\Migrations\\CreateActivityLogsTable', 'default', 'App', 1789980879, 8),
(13, '2026-09-28-173107', 'App\\Database\\Migrations\\AddDeletedAtToCrudTables', 'default', 'App', 1790616783, 9);

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` int UNSIGNED NOT NULL,
  `recipient_type` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `notification_type` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `template_message` text COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `recipient_type`, `notification_type`, `template_message`, `active`, `created_at`, `updated_at`) VALUES
(1, 'guest', 'registration', 'Registrasi kunjungan Anda berhasil. Kode kunjungan: {visit_code}.', 1, '2026-09-22 02:47:33', '2026-09-22 02:47:33'),
(2, 'guest', 'check_in', 'Kunjungan dengan kode {visit_code} telah dikonfirmasi. Selamat datang.', 1, '2026-09-22 02:47:33', '2026-09-22 02:47:33'),
(3, 'employee', 'check_out', 'Kunjungan dengan kode {visit_code} telah selesai. Terima kasih atas kunjungan Anda.', 1, '2026-09-22 02:47:33', '2026-09-28 04:21:07'),
(4, 'guest', 'visit_warning', 'Halloo', 1, '2026-10-08 13:56:00', '2026-10-08 13:56:00'),
(5, 'employee', 'new_guest_arrival', 'Halo {employee_name},\r\n\r\nAda tamu yang ingin bertemu dengan Anda.\r\n\r\nNama: {guest_name}\r\nInstansi: {institution}\r\nNo. HP: {guest_phone}\r\nKeperluan: {purpose_name}\r\nJumlah Rombongan: {group_size}\r\nWaktu: {arrival_time}\r\n\r\nMohon konfirmasi kesediaan Anda dengan membalas pesan ini.\r\n\r\nTerima kasih.', 1, '2026-10-11 20:12:02', '2026-10-11 20:12:02'),
(6, 'guest', 'visit_approved', 'Halo {guest_name},\r\n\r\nKunjungan Anda telah dikonfirmasi. Selamat datang.\r\n\r\nKode Kunjungan: {visit_code}\r\nWaktu Check-in: {check_in}\r\n\r\nMohon simpan kode kunjungan Anda untuk proses check-out nanti.\r\n\r\nTerima kasih.', 1, '2026-10-11 20:12:24', '2026-10-11 20:12:24'),
(7, 'guest', 'visit_completed', 'Halo {guest_name},\r\n\r\nTerima kasih atas kunjungan Anda.\r\n\r\nKode Kunjungan: {visit_code}\r\nWaktu Check-out: {check_out}\r\n\r\nSemoga dapat melayani Anda dengan baik.', 1, '2026-10-11 20:13:01', '2026-10-11 20:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int UNSIGNED NOT NULL,
  `institution_id` int UNSIGNED NOT NULL,
  `primary_color` varchar(7) COLLATE utf8mb4_general_ci NOT NULL,
  `require_photo` tinyint(1) NOT NULL DEFAULT '1',
  `require_signature` tinyint(1) NOT NULL DEFAULT '1',
  `warning_limit` int UNSIGNED NOT NULL DEFAULT '0',
  `photo_size` int UNSIGNED NOT NULL DEFAULT '0',
  `wakita_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `wakita_api_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `wakita_api_key` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `wakita_sender` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `institution_id`, `primary_color`, `require_photo`, `require_signature`, `warning_limit`, `photo_size`, `wakita_enabled`, `wakita_api_url`, `wakita_api_key`, `wakita_sender`, `created_at`, `updated_at`) VALUES
(1, 1, '#9A3F3F', 1, 0, 10, 2048, 1, 'https://wakita.aminsproject.com/api/v1', 'wgk_22_ca16eb61d6c02077909488dbdd6e2873', 'BUKUTAMUDIGITAL', '2026-09-22 02:49:38', '2026-10-12 13:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `role`, `created_at`, `updated_at`, `active`, `deleted_at`) VALUES
(1, 'admin@bukutamu.com', '$2y$12$wFqVoPBArImzcV9Il7EMuephZFZ0pJQFarsLgWeoitbc/30KfoVyi', 'administrator', '2026-09-22 02:20:54', '2026-09-22 02:20:54', 1, NULL),
(2, 'petugas@bukutamu.com', '$2y$12$w99ZJCN9hidxlnFlrH5iau/IDrO8YiK1YNNMim3FRuk2yFHkzKdC2', 'petugas', '2026-09-22 02:20:54', '2026-10-07 19:37:16', 1, NULL),
(4, 'nda', '$2y$12$xFJSRhGxiW95G0/QzsZqauCy662mfBYLhJwhXU/OYfnQprOL1ybEO', 'petugas', '2026-09-25 04:03:50', '2026-09-28 18:07:18', 0, '2026-09-28 18:07:18'),
(5, 'sasa', '$2y$12$KN/UHzP9p69aSTauyOGcf.5YDE7LQpmSgItYfJaNh4d3VlW7rwxa2', 'petugas', '2026-09-25 04:05:43', '2026-10-11 13:29:15', 0, NULL),
(6, 'reka', '$2y$12$UnHl0wXUFaM1rFw0CCh/.uTq.RZ3/S4FMkSHosx8tK8GUmcYhgkXa', 'petugas', '2026-09-25 06:29:35', '2026-10-07 19:37:19', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int UNSIGNED NOT NULL,
  `visit_code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `guest_id` int UNSIGNED NOT NULL,
  `department_id` int UNSIGNED NOT NULL,
  `employee_id` int UNSIGNED NOT NULL,
  `purpose_id` int UNSIGNED NOT NULL,
  `identity_type` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `identity_no` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `group_size` int UNSIGNED NOT NULL DEFAULT '1',
  `arrival_time` datetime DEFAULT NULL,
  `check_in` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL,
  `duration` int UNSIGNED DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `qr_token` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `consent` tinyint(1) NOT NULL DEFAULT '0',
  `photo_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `signature_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `visit_code`, `guest_id`, `department_id`, `employee_id`, `purpose_id`, `identity_type`, `identity_no`, `group_size`, `arrival_time`, `check_in`, `check_out`, `duration`, `status`, `qr_token`, `consent`, `photo_path`, `signature_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'VIS-0001', 1, 1, 1, 1, 'KTP', '3578010101010001', 1, '2026-09-22 02:33:12', '2026-09-22 02:33:12', '2026-10-05 10:55:36', 19222, 'Selesai', 'QR-VIS-0001', 1, NULL, NULL, '2026-09-22 02:33:12', '2026-10-05 10:55:36', NULL),
(2, 'VIS-0002', 2, 2, 3, 2, 'SIM', '3578020202020002', 2, '2026-09-22 02:33:12', NULL, NULL, NULL, 'Ditolak', 'QR-VIS-0002', 1, NULL, NULL, '2026-09-22 02:33:12', '2026-10-05 10:28:13', NULL),
(3, 'VIS-0003', 3, 4, 5, 2, 'KTP', '3578030303030003', 3, '2026-09-22 02:33:12', NULL, NULL, NULL, 'Ditolak', 'QR-VIS-0003', 1, NULL, NULL, '2026-09-22 02:33:12', '2026-10-11 13:54:04', NULL),
(4, 'VIS-21533155', 4, 3, 4, 1, 'KTP', '1234567', 2, '2026-10-02 14:15:49', NULL, NULL, NULL, 'Dibatalkan', 'f2123a4e76b747743b5509e9674b71262a515fff8650eed3c14dca7ae0031de5', 1, 'uploads/guest_photos/1790925312_11039d4f584e780106cd.jpg', 'uploads/guest_signatures/ab6ec2df6bb547074fc5772def83ac56.png', '2026-10-02 14:15:49', '2026-10-05 10:02:48', NULL),
(5, 'VIS-34944355', 5, 1, 1, 2, 'KTP', '1234567', 2, '2026-10-02 14:44:17', '2026-10-04 22:07:24', NULL, NULL, 'Masih Berkunjung', 'da6ead8b8ce669b059c9b1e05e202d0569c7102acedff779ceefcb9d41d111cc', 1, 'uploads/guest_photos/1790927048_542cab4b5eb82060a7eb.jpg', 'uploads/guest_signatures/f99fb2b7b14021b5c7a3be46643ccacf.png', '2026-10-02 14:44:17', '2026-10-04 22:07:24', NULL),
(7, 'VIS-408ED2BE', 7, 1, 2, 2, 'SIM', '777555234', 4, '2026-10-04 23:37:26', '2026-10-04 23:38:21', '2026-10-04 23:48:32', 10, 'Selesai', 'b1dd531358505969ed7e1aca3c8dccf38dffae038c34aa57bfa408df1c719685', 1, 'uploads/guest_photos/1791131808_67480fb6b24d4a5172b3.jpg', 'uploads/guest_signatures/ec0e32ead9921d815ce63a207bc1014f.png', '2026-10-04 23:37:26', '2026-10-04 23:48:32', NULL),
(8, 'VIS-7A6BDE58', 8, 2, 3, 1, 'KTP', '000777345789', 2, '2026-10-05 09:50:56', '2026-10-05 09:51:27', '2026-10-05 09:52:22', 0, 'Selesai', '6290508adbe6492f96015dad21699091cb38ebc3afe522a46e396cdeccb12a9b', 1, 'uploads/guest_photos/1791168646_efdc12c8de7c304555a3.jpg', 'uploads/guest_signatures/85b47debf5b552076ffd49724ce609be.png', '2026-10-05 09:50:56', '2026-10-05 09:52:22', NULL),
(9, 'VIS-3B3AD0B7', 9, 3, 4, 2, 'KTP', '00000123456', 3, '2026-10-06 09:22:48', NULL, NULL, NULL, 'Menunggu', '4e5e945742cf179c7562563f1f0760fb9f85651cd16c764fdf58f82808a44715', 1, 'uploads/guest_photos/1791253347_6c96066bdc922fc35b6e.jpg', 'uploads/guest_signatures/cfdfa261d1051ba6371ccb3c60381edf.png', '2026-10-06 09:22:48', '2026-10-06 10:20:54', NULL),
(10, 'VIS-D7C761DB', 10, 2, 3, 2, 'KTP', '123456777', 2, '2026-10-08 00:08:02', '2026-10-08 00:12:16', NULL, NULL, 'Masih Berkunjung', 'f924ae83920d190bce9e56789d95644cdb6b58102536587003c2cab3c79e9258', 1, 'uploads/guest_photos/1791392868_9f20a7da4f7bc4e304b6.jpg', 'uploads/guest_signatures/2628fcc2edbcc87163062cb430913215.png', '2026-10-08 00:08:02', '2026-10-08 00:12:16', NULL),
(11, 'VIS-76FA59FC', 11, 3, 4, 2, 'SIM', '12345678', 4, '2026-10-09 11:06:34', NULL, NULL, NULL, 'Menunggu', '193d912ff014a48f0fbe32a92b0d8bf0b640c77fe93894f63c0c1b2cdcf24814', 1, 'uploads/guest_photos/1791518741_2e7f419d5099cd1e4fff.jpg', 'uploads/guest_signatures/91411a05869de3083b9556bfcabe00a0.png', '2026-10-09 11:06:34', '2026-10-11 18:03:02', NULL),
(12, 'VIS-01D74796', 12, 2, 8, 1, 'SIM', '123456789', 2, '2026-10-11 20:16:28', '2026-10-11 20:17:42', '2026-10-11 20:18:12', 0, 'Selesai', 'aa9049e57d4380ce1e6ed0acaa80c838c539eea34fb69ec657a225acb2085922', 1, 'uploads/guest_photos/1791720623_6f23fe9dc8e143a64bd0.jpg', 'uploads/guest_signatures/671ab68f277dc22e0728cee3905adff8.png', '2026-10-11 20:16:28', '2026-10-11 20:18:12', NULL),
(13, 'VIS-80432FDE', 13, 1, 2, 1, 'KTP', '08888223456', 2, '2026-10-11 20:24:29', '2026-10-11 20:25:08', '2026-10-11 20:26:44', 1, 'Selesai', 'c7d5f4b32bf3f59646f37ae82ceaafc6d456798131111827e08fa9c2f263f99e', 1, 'uploads/guest_photos/1791725056_7a19d1be58252fceb6b2.jpg', 'uploads/guest_signatures/b5c46921ef1d8d019718de8e03453a75.png', '2026-10-11 20:24:29', '2026-10-11 20:26:44', NULL),
(14, 'VIS-80431325', 14, 1, 1, 2, 'KTP', '0987654321', 2, '2026-10-11 20:30:04', '2026-10-11 20:30:29', '2026-10-11 20:31:43', 1, 'Selesai', '99a3677c4bd9ebbe961e000650115da9b3137a37bacd8c2187045bc238446af9', 1, 'uploads/guest_photos/1791725392_d688dde532d48d705e02.jpg', 'uploads/guest_signatures/877d0004a59f0f45671470b48e45b023.png', '2026-10-11 20:30:04', '2026-10-11 20:31:43', NULL),
(15, 'VIS-C82F6795', 15, 1, 1, 2, 'KTP', '1112233764399', 2, '2026-10-11 20:38:58', '2026-10-11 20:39:24', '2026-10-11 20:40:09', 0, 'Selesai', 'aa27d85a5e12c3d8fca4cb0210e101b576002491489dcd7be15b4d104d47ac68', 1, 'uploads/guest_photos/1791725930_769f0ba8ce8601d540f4.jpg', 'uploads/guest_signatures/8938556a83c158b7e08bdb85d3106aef.png', '2026-10-11 20:38:58', '2026-10-11 20:40:09', NULL),
(16, 'VIS-894F52E4', 16, 1, 9, 1, 'KTP', '000987654', 2, '2026-10-11 20:53:56', '2026-10-11 20:54:55', '2026-10-11 21:09:05', 14, 'Selesai', '1ea2ec475444634815a73bc190d31ed9fae3e9e1cb124307359e88506e68434c', 1, 'uploads/guest_photos/1791726829_bf8a4fcec91adb112b1a.jpg', 'uploads/guest_signatures/e816cd23477b2d78010ab9b14244b748.png', '2026-10-11 20:53:56', '2026-10-11 21:09:05', NULL),
(17, 'VIS-046D5DAE', 17, 1, 9, 2, 'KTP', '3333367898', 1, '2026-10-11 21:01:33', '2026-10-11 21:02:16', '2026-10-11 21:03:03', 0, 'Selesai', 'c7b0563df9171d6e3c5b67625da4cde1d0d3a63834c6fa1028c6f58a57e0b8c0', 1, 'uploads/guest_photos/1791727283_6cb98c8e10c5429ec01f.jpg', 'uploads/guest_signatures/cfe05160c0aa929662f2a1aa93e2871f.png', '2026-10-11 21:01:33', '2026-10-11 21:03:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visit_purposes`
--

CREATE TABLE `visit_purposes` (
  `id` int UNSIGNED NOT NULL,
  `purpose_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visit_purposes`
--

INSERT INTO `visit_purposes` (`id`, `purpose_name`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pertemuan', 1, '2026-09-22 02:31:35', '2026-09-22 02:31:35', NULL),
(2, 'Konsultasi', 1, '2026-09-22 02:31:35', '2026-09-22 02:31:35', NULL),
(3, 'Pengurusan Dokumen', 1, '2026-09-22 02:31:35', '2026-09-28 18:09:31', '2026-09-28 18:09:31'),
(8, 'Diskusi', 0, '2026-10-11 11:36:07', '2026-10-11 11:36:22', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_department_id_foreign` (`department_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `institution_id` (`institution_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `visit_code` (`visit_code`),
  ADD UNIQUE KEY `qr_token` (`qr_token`),
  ADD KEY `visits_guest_id_foreign` (`guest_id`),
  ADD KEY `visits_department_id_foreign` (`department_id`),
  ADD KEY `visits_employee_id_foreign` (`employee_id`),
  ADD KEY `visits_purpose_id_foreign` (`purpose_id`);

--
-- Indexes for table `visit_purposes`
--
ALTER TABLE `visit_purposes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `institutions`
--
ALTER TABLE `institutions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `visit_purposes`
--
ALTER TABLE `visit_purposes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_institution_id_foreign` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `visits_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `visits_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `visits_purpose_id_foreign` FOREIGN KEY (`purpose_id`) REFERENCES `visit_purposes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
