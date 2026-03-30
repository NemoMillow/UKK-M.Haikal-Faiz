-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Mar 2026 pada 18.32
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
-- Database: `db_aspirasi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'Nemo', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aspirasi`
--

CREATE TABLE `aspirasi` (
  `id_aspirasi` int(15) NOT NULL,
  `status` enum('Menunggu','Proses','Selesai') NOT NULL DEFAULT 'Menunggu',
  `id_pelaporan` int(5) NOT NULL,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `aspirasi`
--

INSERT INTO `aspirasi` (`id_aspirasi`, `status`, `id_pelaporan`, `feedback`) VALUES
(1, 'Selesai', 1, 'AC sudah diperbaiki'),
(2, 'Proses', 2, 'Sedang dibersihkan'),
(3, 'Menunggu', 3, NULL),
(4, 'Selesai', 4, 'Buku sudah ditambah'),
(5, 'Proses', 5, 'Alat sedang dipesan'),
(6, 'Menunggu', 6, NULL),
(7, 'Selesai', 7, 'Kantin sudah dibersihkan'),
(8, 'Proses', 8, 'Lampu sedang diganti'),
(9, 'Menunggu', 9, NULL),
(10, 'Selesai', 10, 'Sound system sudah diganti'),
(11, 'Proses', 11, 'Teknisi sedang memeriksa'),
(12, 'Menunggu', 12, NULL),
(13, 'Selesai', 13, 'CCTV sudah diaktifkan'),
(14, 'Proses', 14, 'Jadwal sedang disusun'),
(15, 'Menunggu', 15, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `input_aspirasi`
--

CREATE TABLE `input_aspirasi` (
  `id_pelaporan` int(5) NOT NULL,
  `nis` int(10) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `input_aspirasi`
--

INSERT INTO `input_aspirasi` (`id_pelaporan`, `nis`, `id_kategori`, `lokasi`, `ket`, `created_at`) VALUES
(1, 2024001, 1, 'Kelas X-RPL 1', 'AC tidak berfungsi', '2026-02-27 18:36:55'),
(2, 2024002, 2, 'Toilet Lantai 1', 'Toilet kotor dan bau', '2026-02-27 18:36:55'),
(3, 2024003, 3, 'Parkiran', 'Pagar parkiran rusak', '2026-02-27 18:36:55'),
(4, 2024004, 4, 'Ruang Kelas XI-PF 2', 'Buku pelajaran kurang', '2026-02-27 18:36:55'),
(5, 2024005, 5, 'Lapangan', 'Alat olahraga rusak', '2026-02-27 18:36:55'),
(6, 2024006, 1, 'Laboratorium', 'Komputer lab rusak', '2026-02-27 18:36:55'),
(7, 2024007, 2, 'Kantin', 'Kantin kurang bersih', '2026-02-27 18:36:55'),
(8, 2024008, 3, 'Gerbang Sekolah', 'Lampu gerbang mati', '2026-02-27 18:36:55'),
(9, 2024009, 4, 'Perpustakaan', 'Buku referensi minim', '2026-02-27 18:36:55'),
(10, 2024010, 5, 'Aula', 'Sound system rusak', '2026-02-27 18:36:55'),
(11, 2024011, 1, 'Kelas X-PPLG 2', 'Proyektor tidak nyala', '2026-02-27 18:36:55'),
(12, 2024012, 2, 'Kamar Mandi', 'Wastafel bocor', '2026-02-27 18:36:55'),
(13, 2024013, 3, 'Koridor Lantai 2', 'CCTV tidak aktif', '2026-02-27 18:36:55'),
(14, 2024014, 4, 'Ruang Guru', 'Jadwal ujian tidak jelas', '2026-02-27 18:36:55'),
(15, 2024015, 5, 'Lapangan Basket', 'Ring basket patah', '2026-02-27 18:36:55'),
(18, 2024015, 5, 'tes', 'tes', '2026-02-27 18:36:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `ket_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `ket_kategori`) VALUES
(1, 'Fasilitas'),
(2, 'Kebersihan'),
(3, 'Keamanan'),
(4, 'Akademik'),
(5, 'Ekstrakulikuler'),
(8, 'Guru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` int(10) NOT NULL,
  `kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `kelas`) VALUES
(2024001, 'X-PPLG 1'),
(2024002, 'X-PPLG 2'),
(2024003, 'X-PPLG 3'),
(2024004, 'XI-RPL 1'),
(2024005, 'XI-RPL 2'),
(2024006, 'XI-RPL 3'),
(2024007, 'XII-RPL 1'),
(2024008, 'XII-RPL 2'),
(2024009, 'XII-RPL 3'),
(2024010, 'X-BP 1'),
(2024011, 'X-BP 2'),
(2024012, 'XI-PF 1'),
(2024013, 'XI-PF 2'),
(2024014, 'XII-PF 1'),
(2024015, 'XII-PF 3');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD PRIMARY KEY (`id_aspirasi`),
  ADD KEY `id_pelaporan` (`id_pelaporan`);

--
-- Indeks untuk tabel `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  ADD PRIMARY KEY (`id_pelaporan`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `aspirasi`
--
ALTER TABLE `aspirasi`
  MODIFY `id_aspirasi` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  MODIFY `id_pelaporan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD CONSTRAINT `aspirasi_ibfk_1` FOREIGN KEY (`id_pelaporan`) REFERENCES `input_aspirasi` (`id_pelaporan`);

--
-- Ketidakleluasaan untuk tabel `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  ADD CONSTRAINT `input_aspirasi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`),
  ADD CONSTRAINT `input_aspirasi_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
