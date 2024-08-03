-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Agu 2024 pada 17.06
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
-- Database: `dinsos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(40) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `intansi` varchar(50) NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `alamat`, `tgl_lahir`, `jenis_kelamin`, `telepon`, `intansi`, `id_user`) VALUES
(1, 'fahrul', 'jl. anjir serapat timur', '2024-06-04', 'laki laki', '090888899909', 'Staf Puskesos Dinas Sosial Kapuas', 1),
(2, 'musafir', 'jl. kertak hanyar', '2016-07-22', 'laki laki', '4234', 'dinkes', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `chat` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `chat`
--

INSERT INTO `chat` (`id_chat`, `id_admin`, `id_user`, `chat`, `created_at`, `is_read`) VALUES
(0, NULL, 2, 'tes', '2024-07-22 01:53:14', 1),
(0, 4, 2, 'tes', '2024-07-22 01:53:38', 1),
(0, 1, 2, 'hai', '2024-07-24 22:14:45', 0),
(0, NULL, 2, 'tes', '2024-07-25 09:04:12', 1),
(0, NULL, 3, 'aida\r\n', '2024-07-25 09:04:41', 1),
(0, NULL, 2, 'hgh', '2024-07-25 16:16:32', 1),
(0, 1, 3, 'tes', '2024-07-25 16:18:28', 0),
(0, 1, 2, 'tes', '2024-07-25 16:18:36', 0),
(0, 1, 2, 'hh', '2024-07-25 16:45:14', 0),
(0, NULL, 7, 'hai\r\n', '2024-07-25 18:31:18', 1),
(0, 1, 7, 'hai', '2024-07-25 18:34:08', 0),
(0, NULL, 17, 'permisi mau pengecekan penerima bpjs dengan nik 6203014204190004', '2024-08-03 13:21:20', 1),
(0, 1, 17, 'baik pengecekan akan kami lakukan mohon di tunggu sebentar', '2024-08-03 13:27:38', 0),
(0, NULL, 17, 'ok bai', '2024-08-03 13:28:02', 1),
(0, NULL, 18, 'pengecekan dengan nik 6203014104020004', '2024-08-03 14:44:46', 1),
(0, 1, 18, 'okeh tunggu sebentar', '2024-08-03 14:45:07', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pengajuan`
--

CREATE TABLE `detail_pengajuan` (
  `detail_pengajuan` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `hubungan_keluarga` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_pengajuan`
--

INSERT INTO `detail_pengajuan` (`detail_pengajuan`, `id_pengajuan`, `nik`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `hubungan_keluarga`) VALUES
(20, 51, '6203034607020005', 'maria jenesa', '2', 'kapuas', '1995-09-17', 'istri'),
(21, 51, '6202033907920004', 'cristino', '1', 'kapuas', '1992-07-09', 'kepala keluarga'),
(25, 54, '6203014104020003', 'Aida wahyuni', '2', 'banjarmasin', '2002-04-11', 'istri'),
(26, 54, '6203012508240005', 'ahmad husin', '1', 'kapuas', '2024-08-25', 'anak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemohon`
--

CREATE TABLE `pemohon` (
  `id_pemohon` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(40) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemohon`
--

INSERT INTO `pemohon` (`id_pemohon`, `nama`, `alamat`, `tgl_lahir`, `jenis_kelamin`, `telepon`, `id_user`) VALUES
(1, 'M. sarif', 'panamas', '2002-07-05', 'laki laki', '121', 2),
(2, 'aida', 'jl. barito', '2002-04-11', 'perempuan', '08329391283458', 3),
(3, 'M. Sarif', 'panamas', '2009-08-06', 'Laki-laki', '081549310752', 5),
(5, 'anisa', 'PANAMAS', '2002-09-06', 'Perempuan', '081549310752', 7),
(15, 'aida wahyuni', 'jl. pemuda', '1999-08-19', 'Perempuan', '081549300158', 17),
(16, 'aida wahyuni', 'jl. pemuda', '2002-08-23', 'Perempuan', '081549300158', 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pemohon` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `nomor_kk` varchar(25) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `rt` int(5) NOT NULL,
  `rw` int(5) NOT NULL,
  `desa` varchar(100) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `sktm` varchar(100) NOT NULL,
  `dtks` varchar(100) NOT NULL,
  `kartu_keluarga` varchar(100) NOT NULL,
  `ktp` varchar(100) NOT NULL,
  `id_verifikasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengajuan`
--

INSERT INTO `pengajuan` (`id_pemohon`, `id_pengajuan`, `nomor_kk`, `tgl_pengajuan`, `alamat`, `rt`, `rw`, `desa`, `kecamatan`, `sktm`, `dtks`, `kartu_keluarga`, `ktp`, `id_verifikasi`) VALUES
(5, 51, '6203010302010387', '2024-07-25', 'sungai baras', 2, 1, 'selat utara', 'selat', '17219317227962.png', '17219317229880.png', '17219317229580.png', '17219317224536.png', 0),
(16, 54, '6203016587946709', '2024-08-03', 'jl. pemuda', 2, 1, 'selat utara', 'selat', '17226957637666.png', '17226957639958.png', '17226957638785.png', '17226957631276.png', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `password`, `email`, `role`) VALUES
(1, '$2y$10$y6cC.cZRCsswk.HF/Vg1pecXALhBFaTi.b/gs05oK2AwlzJdknX5C', 'muhammadsyarif672582@gmail.com', 'admin'),
(2, '$2y$10$NUl/oGAXpIgZ94uUGOAFu.k9ExZs9soU//Fgwv/ywBoGIjEVumTW2', 'pdipmkapuas2507@gmail.com', 'pemohon'),
(3, '$2y$10$UTOsqjpEqGdLeyY8vGuXu.4.3/WmOVimEJZu9IYiwDob3rNjc5TiW', 'muhammadsyarif5822@gmail.com', 'pemohon'),
(4, '$2y$10$Ngmj99fXcKqoqneHpMh7Oul9gT26R5pqi2YHLJCkHVUEUjyqFBvAy', 'musa@gmail.com', 'admin'),
(5, '$2y$10$mMWjIPQYGCzR3XBdLin50.zEjSc1obR/ZO7juLtjcHMZE.VDEz0R6', 'sulis@gmail.com', 'pemohon'),
(7, '$2y$10$DDhzFTaVA69hgNenjYrwsOjpbfzpyRBJ0/kNq/Mk33FqNGe9AAfP2', 'anisa@gmail.com', 'pemohon'),
(17, '$2y$10$v7ELcjxTJd9FxKFXioZsyea3OEQOMvQ/.g/SI6UeJ0anolRvju.pi', 'aida@gmail.com', 'pemohon'),
(18, '$2y$10$IUiaKSO7gXD012I1cQHSLu4VbBVFwwN.njf93Y8wFnOeJOSo9g68W', 'aida1@gmail.com', 'pemohon');

-- --------------------------------------------------------

--
-- Struktur dari tabel `verifikasi`
--

CREATE TABLE `verifikasi` (
  `id_verifikasi` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `statuss` varchar(25) NOT NULL,
  `pesan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `verifikasi`
--

INSERT INTO `verifikasi` (`id_verifikasi`, `id_admin`, `id_pengajuan`, `statuss`, `pesan`) VALUES
(37, 1, 51, '1', ''),
(38, 1, 52, '1', ''),
(39, 1, 54, '1', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `detail_pengajuan`
--
ALTER TABLE `detail_pengajuan`
  ADD PRIMARY KEY (`detail_pengajuan`),
  ADD KEY `id_pengajuan` (`id_pengajuan`);

--
-- Indeks untuk tabel `pemohon`
--
ALTER TABLE `pemohon`
  ADD PRIMARY KEY (`id_pemohon`),
  ADD KEY `id_user` (`id_user`) USING BTREE;

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `id_verifikasi` (`id_verifikasi`),
  ADD KEY `id_pemohon` (`id_pemohon`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD PRIMARY KEY (`id_verifikasi`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_pengajuan` (`id_pengajuan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_pengajuan`
--
ALTER TABLE `detail_pengajuan`
  MODIFY `detail_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `pemohon`
--
ALTER TABLE `pemohon`
  MODIFY `id_pemohon` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `verifikasi`
--
ALTER TABLE `verifikasi`
  MODIFY `id_verifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `detail_pengajuan`
--
ALTER TABLE `detail_pengajuan`
  ADD CONSTRAINT `detail_pengajuan_ibfk_1` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan` (`id_pengajuan`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pemohon`
--
ALTER TABLE `pemohon`
  ADD CONSTRAINT `pemohon_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`id_pemohon`) REFERENCES `pemohon` (`id_pemohon`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD CONSTRAINT `verifikasi_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
