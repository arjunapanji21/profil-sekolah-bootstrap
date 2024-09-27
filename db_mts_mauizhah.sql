-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2024 at 09:38 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mts_mauizhah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telp` int DEFAULT NULL,
  `tgl_dibuat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `username`, `password`, `alamat`, `telp`, `tgl_dibuat`) VALUES
(1, 'Admin', 'admin@admin.com', 'admin', '$2y$10$kgXTRwqNxW85vFqV23WXNuBQyBmb3/hsv4dKnrpq/wNALzEGsrscG', 'Jambi', 123, '2024-09-25 10:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int NOT NULL,
  `admin_id` int NOT NULL,
  `judul` varchar(100) NOT NULL,
  `sampul` varchar(50) DEFAULT NULL,
  `konten` longtext NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `jumlah_dilihat` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `admin_id`, `judul`, `sampul`, `konten`, `tanggal`, `jumlah_dilihat`) VALUES
(1, 1, 'Penerimaan Siswa Baru MTs Mauizhah Telah Dibuka!', NULL, 'Madrasah Tsanawiyah (MTs) Mauizhah, yang berlokasi di Desa Pulau Pauh, Kecamatan Renah Mendaluh, Kabupaten Tanjung Jabung Barat, dengan bangga mengumumkan bahwa penerimaan siswa baru untuk tahun ajaran 2024/2025 telah resmi dibuka!\r\n\r\nMTs Mauizhah, yang telah berdiri sejak tahun 2010, memiliki visi untuk mencetak generasi yang cerdas, berakhlak mulia, dan berdaya saing global. Dengan dukungan fasilitas yang memadai dan tenaga pengajar yang berpengalaman, MTs Mauizhah terus berkomitmen untuk memberikan pendidikan berkualitas yang berbasis keislaman.\r\n\r\nKeunggulan MTs Mauizhah:\r\nKurikulum Terpadu: Menggabungkan pendidikan agama Islam dengan ilmu pengetahuan umum, sehingga siswa dapat mengembangkan potensi akademik dan spiritual secara seimbang.\r\nFasilitas Pendukung: Ruang kelas yang nyaman, perpustakaan, laboratorium komputer, serta area olahraga yang luas.\r\nEkstrakurikuler Beragam: Berbagai kegiatan seperti Pramuka, seni, olahraga, dan kegiatan keagamaan, memungkinkan siswa untuk mengembangkan bakat dan minat mereka di luar jam pelajaran.\r\nLingkungan Islami: MTs Mauizhah menciptakan suasana pembelajaran yang mendukung tumbuh kembang siswa dalam suasana religius yang harmonis.', '2024-09-27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `calon_siswa`
--

CREATE TABLE `calon_siswa` (
  `id` int NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `tempat_lahir` varchar(25) NOT NULL,
  `tgl_lahir` varchar(255) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `agama` enum('Islam','Kristen','Protestan','Hindu','Buddha','Konghucu') NOT NULL,
  `anak_ke` int NOT NULL,
  `jml_saudara` int NOT NULL,
  `asal_sekolah` varchar(50) NOT NULL,
  `alamat_sekolah_asal` varchar(255) NOT NULL,
  `no_kk` varchar(50) NOT NULL,
  `nik_ayah` varchar(50) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `nik_ibu` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `pekerjaan_ayah` varchar(30) NOT NULL,
  `pekerjaan_ibu` varchar(30) NOT NULL,
  `kategori_penghasilan` enum('Rendah','Sedang','Tinggi','Sangat Tinggi') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `tgl_daftar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_diterima` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kepala_sekolah`
--

CREATE TABLE `kepala_sekolah` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telp` int DEFAULT NULL,
  `tgl_dibuat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kepala_sekolah`
--

INSERT INTO `kepala_sekolah` (`id`, `nama`, `email`, `username`, `password`, `alamat`, `telp`, `tgl_dibuat`) VALUES
(1, 'Kepala Sekolah', 'kepsek@gmail.com', 'kepala', '$2y$10$SV.JwcYxZv23vceUI4nroOREdGAYP2ZHqwq6obDh07hQXleY6rjm.', 'Jambi', 8123, '2024-09-25 21:55:42');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int NOT NULL,
  `calon_siswa_id` int NOT NULL,
  `pasfoto` varchar(50) DEFAULT NULL,
  `ijazah` varchar(50) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tgl_dibuat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `calon_siswa`
--
ALTER TABLE `calon_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kepala_sekolah`
--
ALTER TABLE `kepala_sekolah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calon_siswa_id` (`calon_siswa_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `calon_siswa`
--
ALTER TABLE `calon_siswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kepala_sekolah`
--
ALTER TABLE `kepala_sekolah`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`calon_siswa_id`) REFERENCES `calon_siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
