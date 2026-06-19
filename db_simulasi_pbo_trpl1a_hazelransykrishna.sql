-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 19, 2026 at 02:31 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simulasi_pbo_trpl1a_hazelransykrishna`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pendaftaran`
--

CREATE TABLE `tabel_pendaftaran` (
  `id_pendaftaran` int NOT NULL,
  `nama_calon` varchar(100) NOT NULL,
  `asal_sekolah` varchar(150) NOT NULL,
  `nilai_ujian` decimal(5,2) NOT NULL,
  `biaya_pendaftaran_dasar` decimal(12,2) NOT NULL,
  `jalur_pendaftaran` enum('Reguler','Prestasi','Kedinasan') NOT NULL,
  `pilihan_prodi` varchar(100) DEFAULT NULL,
  `lokasi_kampus` varchar(100) DEFAULT NULL,
  `jenis_prestasi` varchar(100) DEFAULT NULL,
  `tingkat_prestasi` enum('Kota','Provinsi','Nasional','Internasional') DEFAULT NULL,
  `sk_ikatan_dinas` varchar(50) DEFAULT NULL,
  `instansi_sponsor` varchar(150) DEFAULT NULL
) ;

--
-- Dumping data for table `tabel_pendaftaran`
--

INSERT INTO `tabel_pendaftaran` (`id_pendaftaran`, `nama_calon`, `asal_sekolah`, `nilai_ujian`, `biaya_pendaftaran_dasar`, `jalur_pendaftaran`, `pilihan_prodi`, `lokasi_kampus`, `jenis_prestasi`, `tingkat_prestasi`, `sk_ikatan_dinas`, `instansi_sponsor`) VALUES
(1, 'Ahmad Fauzi', 'SMA Negeri 1 Jakarta', '85.50', '250000.00', 'Reguler', 'Teknik Informatika', 'Jakarta', NULL, NULL, NULL, NULL),
(2, 'Budi Santoso', 'SMA Negeri 3 Bandung', '78.25', '250000.00', 'Reguler', 'Manajemen Bisnis', 'Bandung', NULL, NULL, NULL, NULL),
(3, 'Citra Dewi', 'SMA Negeri 5 Surabaya', '92.00', '250000.00', 'Reguler', 'Kedokteran Umum', 'Surabaya', NULL, NULL, NULL, NULL),
(4, 'Dian Purnama', 'SMA Negeri 1 Yogyakarta', '74.75', '250000.00', 'Reguler', 'Psikologi', 'Yogyakarta', NULL, NULL, NULL, NULL),
(5, 'Eka Wijaya', 'SMA Negeri 2 Medan', '81.40', '250000.00', 'Reguler', 'Teknik Sipil', 'Medan', NULL, NULL, NULL, NULL),
(6, 'Fajar Nugroho', 'SMA Negeri 4 Semarang', '69.80', '250000.00', 'Reguler', 'Ekonomi Pembangunan', 'Semarang', NULL, NULL, NULL, NULL),
(7, 'Gita Rahayu', 'SMA Negeri 6 Makassar', '88.60', '250000.00', 'Reguler', 'Ilmu Komunikasi', 'Makassar', NULL, NULL, NULL, NULL),
(8, 'Hendra Gunawan', 'SMA Negeri 7 Palembang', '76.30', '250000.00', 'Reguler', 'Teknik Elektro', 'Palembang', NULL, NULL, NULL, NULL),
(9, 'Indra Saputra', 'SMA Negeri 2 Jakarta', '90.00', '200000.00', 'Prestasi', 'Teknik Informatika', 'Jakarta', 'Olimpiade Matematika', 'Nasional', NULL, NULL),
(10, 'Joko Prasetyo', 'SMA Negeri 1 Bandung', '87.50', '200000.00', 'Prestasi', 'Fisika', 'Bandung', 'Olimpiade Fisika', 'Provinsi', NULL, NULL),
(11, 'Karina Sari', 'SMA Negeri 3 Surabaya', '95.25', '200000.00', 'Prestasi', 'Kedokteran Gigi', 'Surabaya', 'Juara LKTI', 'Nasional', NULL, NULL),
(12, 'Larasati Putri', 'SMA Negeri 2 Yogyakarta', '84.75', '200000.00', 'Prestasi', 'Biologi', 'Yogyakarta', 'Olimpiade Biologi', 'Kota', NULL, NULL),
(13, 'Mulyono Hadi', 'SMA Negeri 5 Medan', '91.30', '200000.00', 'Prestasi', 'Teknik Mesin', 'Medan', 'Juara Robotika', 'Internasional', NULL, NULL),
(14, 'Nadia Fitri', 'SMA Negeri 3 Semarang', '88.90', '200000.00', 'Prestasi', 'Kimia', 'Semarang', 'Olimpiade Kimia', 'Provinsi', NULL, NULL),
(15, 'Oka Permana', 'SMA Negeri 4 Makassar', '93.40', '200000.00', 'Prestasi', 'Arsitektur', 'Makassar', 'Juara Desain', 'Nasional', NULL, NULL),
(16, 'Putri Ayu', 'SMA Negeri 8 Palembang', '86.20', '200000.00', 'Prestasi', 'Akuntansi', 'Palembang', 'Olimpiade Ekonomi', 'Provinsi', NULL, NULL),
(17, 'Rina Anggraini', 'SMA Negeri 9 Jakarta', '82.30', '150000.00', 'Kedinasan', 'Administrasi Publik', 'Jakarta', NULL, NULL, 'SK-001/2026', 'Kemenpan RB'),
(18, 'Surya Dharma', 'SMA Negeri 6 Bandung', '79.65', '150000.00', 'Kedinasan', 'Hubungan Internasional', 'Bandung', NULL, NULL, 'SK-002/2026', 'Kemlu'),
(19, 'Tiara Maharani', 'SMA Negeri 7 Surabaya', '85.90', '150000.00', 'Kedinasan', 'Ilmu Pemerintahan', 'Surabaya', NULL, NULL, 'SK-003/2026', 'Kemendagri'),
(20, 'Umar Faruq', 'SMA Negeri 3 Yogyakarta', '77.40', '150000.00', 'Kedinasan', 'Teknik Pertanian', 'Yogyakarta', NULL, NULL, 'SK-004/2026', 'Kementan'),
(21, 'Vina Lestari', 'SMA Negeri 4 Medan', '83.70', '150000.00', 'Kedinasan', 'Kesehatan Masyarakat', 'Medan', NULL, NULL, 'SK-005/2026', 'Kemenkes'),
(22, 'Wahyu Setiawan', 'SMA Negeri 2 Semarang', '80.25', '150000.00', 'Kedinasan', 'Teknik Lingkungan', 'Semarang', NULL, NULL, 'SK-006/2026', 'KLHK'),
(23, 'Xena Patricia', 'SMA Negeri 5 Makassar', '87.60', '150000.00', 'Kedinasan', 'Manajemen Transportasi', 'Makassar', NULL, NULL, 'SK-007/2026', 'Kemenhub'),
(24, 'Yusuf Rahman', 'SMA Negeri 1 Palembang', '78.80', '150000.00', 'Kedinasan', 'Statistika', 'Palembang', NULL, NULL, 'SK-008/2026', 'BPS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
