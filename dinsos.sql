-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Bulan Mei 2025 pada 08.05
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
(5, NULL, 19, 'permisi mau melakukan pengecekan BPJS dengan nik 6203015104020006\r\n', '2024-08-04 14:14:30', 1),
(6, 1, 19, 'baik silahkan di tunggu', '2024-08-04 14:14:58', 0),
(7, NULL, 19, 'cek BPJS dengan Nik 6203015406040005', '2024-08-06 06:17:50', 1);

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
(34, 1, '620302137540002', 'AHMAD KURNIAWAN', '1', 'KUALA KAPUAS', '1978-08-28', 'KEPALA KELUARGA'),
(35, 1, '6203014646000005', 'SYAFRINA CAHAYA WATI', '2', 'KUALA KAPUAS', '1987-03-10', 'ISTRI'),
(36, 1, '6253601246710009', 'MUHAMMAD JANNUAR', '1', 'KAPUAS', '2004-05-18', 'ANAK'),
(37, 1, '6203018787220006', 'NOR ANISA AZZAHRA', '2', 'KAPUAS', '2011-01-28', 'ANAK'),
(38, 2, '620301546430006', 'Hj. ARBAINAH', '2', 'KUALA KAPUAS', '1990-12-03', 'KEPALA KELUARGA');

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
(17, 'aida wahyuni', 'jl. pemuda', '2002-04-11', 'Perempuan', '081549300158', 19);

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
(5, 1, '620301235310003', '2024-07-25', 'JL. TERATAI', 26, 3, 'SELAT TENGAH', 'SELAT', '17233604986826.png', '17233604982763.png', '17233604987705.png', '17233604986574.png', 0),
(5, 2, '6203011511200001', '2024-07-25', 'JL. MAHAKAM GG. 4 NO. 32', 20, 2, 'SELAT TENGAH', 'SELAT', '17233604986826.png', '17233604982763.png', '17233604987705.png', '17233604986574.png', 0);

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
(19, '$2y$10$vLgyfpFdKMt6deVkI8vgI.scTEbhFgHJ5sOHXdRLq2NG09UIDPFnC', 'aidawahyuni@gmail.com', 'pemohon');

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
(40, 1, 55, '1', ''),
(41, 1, 56, '1', ''),
(42, 1, 1, '1', ' '),
(43, 1, 2, '1', ' '),
(44, 1, 3, '1', ' '),
(45, 1, 4, '1', ' '),
(46, 1, 5, '1', ' '),
(47, 1, 6, '1', ' '),
(48, 1, 7, '1', ' '),
(49, 1, 8, '1', ' '),
(50, 1, 9, '1', ' '),
(51, 1, 10, '1', ' '),
(52, 1, 11, '1', ' '),
(53, 1, 12, '1', ' '),
(54, 1, 13, '1', ' '),
(55, 1, 14, '1', ' '),
(56, 1, 15, '1', ' '),
(57, 1, 16, '1', ' '),
(58, 1, 17, '1', ' '),
(59, 1, 18, '1', ' '),
(60, 1, 19, '1', ' '),
(61, 1, 20, '1', ' '),
(62, 1, 21, '1', ' '),
(63, 1, 22, '1', ' '),
(64, 1, 23, '1', ' '),
(65, 1, 24, '1', ' '),
(66, 1, 25, '1', ' '),
(67, 1, 26, '1', ' '),
(68, 1, 27, '1', ' '),
(69, 1, 28, '1', ' '),
(70, 1, 29, '1', ' '),
(71, 1, 30, '1', ' '),
(72, 1, 31, '1', ' '),
(73, 1, 32, '1', ' '),
(74, 1, 33, '1', ' '),
(75, 1, 34, '1', ' '),
(76, 1, 35, '1', ' '),
(77, 1, 36, '1', ' '),
(78, 1, 37, '1', ' '),
(79, 1, 38, '1', ' '),
(80, 1, 39, '1', ' '),
(81, 1, 40, '1', ' '),
(82, 1, 41, '1', ' '),
(83, 1, 42, '1', ' '),
(84, 1, 43, '1', ' '),
(85, 1, 44, '1', ' '),
(86, 1, 45, '1', ' '),
(87, 1, 46, '1', ' '),
(88, 1, 47, '1', ' '),
(89, 1, 48, '1', ' '),
(90, 1, 49, '1', ' '),
(91, 1, 50, '1', ' '),
(92, 1, 58, '1', ' '),
(93, 1, 59, '1', ' '),
(94, 1, 60, '1', ' '),
(95, 1, 61, '1', ' '),
(96, 1, 62, '1', ' '),
(97, 1, 63, '1', ' '),
(98, 1, 64, '1', ' '),
(99, 1, 65, '1', ' '),
(100, 1, 66, '1', ' '),
(101, 1, 67, '1', ' '),
(102, 1, 68, '1', ' '),
(103, 1, 69, '1', ' '),
(104, 1, 70, '1', ' '),
(105, 1, 71, '1', ' '),
(106, 1, 72, '1', ' '),
(107, 1, 73, '1', ' '),
(108, 1, 74, '1', ' '),
(109, 1, 75, '1', ' '),
(110, 1, 76, '1', ' '),
(111, 1, 77, '1', ' '),
(112, 1, 78, '1', ' '),
(113, 1, 79, '1', ' '),
(114, 1, 80, '1', ' '),
(115, 1, 81, '1', ' '),
(116, 1, 82, '1', ' '),
(117, 1, 83, '1', ' '),
(118, 1, 84, '1', ' '),
(119, 1, 85, '1', ' '),
(120, 1, 86, '1', ' '),
(121, 1, 87, '0', ' '),
(122, 1, 90, '1', ' '),
(123, 1, 91, '1', ' '),
(124, 1, 92, '1', ' '),
(125, 1, 93, '1', ' '),
(126, 1, 94, '1', ' '),
(127, 1, 95, '1', ' '),
(128, 1, 96, '1', ' '),
(129, 1, 97, '1', ' '),
(130, 1, 98, '1', ' '),
(131, 1, 99, '1', ' '),
(132, 1, 100, '1', ' '),
(133, 1, 101, '1', ' '),
(134, 1, 102, '1', ' '),
(135, 1, 103, '1', ' '),
(136, 1, 104, '1', ' '),
(137, 1, 105, '1', ' '),
(138, 1, 106, '1', ' '),
(139, 1, 107, '1', ' '),
(140, 1, 108, '1', ' '),
(141, 1, 109, '1', ' '),
(142, 1, 110, '1', ' '),
(143, 1, 111, '1', ' '),
(144, 1, 112, '1', ' '),
(145, 1, 113, '1', ' '),
(146, 1, 114, '1', ' '),
(147, 1, 115, '1', ' '),
(148, 1, 116, '1', ' '),
(149, 1, 117, '1', ' '),
(150, 1, 118, '1', ' '),
(151, 1, 119, '1', ' '),
(152, 1, 120, '1', ' '),
(153, 1, 121, '1', ' '),
(154, 1, 122, '1', ' '),
(155, 1, 123, '1', ' '),
(156, 1, 124, '1', ' '),
(157, 1, 125, '1', ' '),
(158, 1, 126, '1', ' '),
(159, 1, 127, '1', ' '),
(160, 1, 128, '1', ' '),
(161, 1, 129, '1', ' '),
(162, 1, 130, '1', ' '),
(163, 1, 131, '1', ' '),
(164, 1, 132, '1', ' '),
(165, 1, 133, '1', ' '),
(166, 1, 134, '1', ' '),
(167, 1, 135, '1', ' '),
(168, 1, 136, '1', ' '),
(169, 1, 137, '1', ' '),
(170, 1, 138, '1', ' '),
(171, 1, 139, '1', ' '),
(172, 1, 140, '1', ' '),
(173, 1, 141, '1', ' '),
(174, 1, 142, '1', ' '),
(175, 1, 143, '1', ' '),
(176, 1, 144, '1', ' '),
(177, 1, 145, '1', ' '),
(178, 1, 146, '1', ' '),
(179, 1, 147, '1', ' '),
(180, 1, 148, '1', ' '),
(181, 1, 149, '1', ' '),
(182, 1, 150, '1', ' '),
(183, 1, 151, '1', ' '),
(184, 1, 152, '1', ' '),
(185, 1, 153, '1', ' '),
(186, 1, 154, '1', ' '),
(187, 1, 155, '1', ' '),
(188, 1, 156, '1', ' '),
(189, 1, 157, '1', ' '),
(190, 1, 158, '1', ' '),
(191, 1, 159, '1', ' '),
(192, 1, 160, '1', ' '),
(193, 1, 161, '1', ' '),
(194, 1, 162, '1', ' '),
(195, 1, 163, '1', ' '),
(196, 1, 164, '1', ' '),
(197, 1, 165, '1', ' '),
(198, 1, 166, '1', ' '),
(199, 1, 167, '1', ' '),
(200, 1, 168, '1', ' '),
(201, 1, 169, '1', ' '),
(202, 1, 170, '1', ' '),
(203, 1, 171, '1', ' '),
(204, 1, 172, '1', ' '),
(205, 1, 173, '1', ' '),
(206, 1, 174, '1', ' '),
(207, 1, 175, '1', ' '),
(208, 1, 176, '1', ' '),
(209, 1, 177, '1', ' '),
(210, 1, 178, '1', ' '),
(211, 1, 179, '1', ' '),
(212, 1, 180, '1', ' '),
(213, 1, 181, '1', ' '),
(214, 1, 182, '1', ' '),
(215, 1, 183, '1', ' '),
(216, 1, 184, '1', ' '),
(217, 1, 185, '1', ' '),
(218, 1, 186, '1', ' '),
(219, 1, 187, '1', ' '),
(220, 1, 188, '1', ' '),
(221, 1, 189, '1', ' '),
(222, 1, 190, '1', ' '),
(223, 1, 191, '1', ' '),
(224, 1, 192, '1', ' '),
(225, 1, 193, '1', ' '),
(226, 1, 194, '1', ' '),
(227, 1, 195, '1', ' '),
(228, 1, 196, '1', ' '),
(229, 1, 197, '1', ' '),
(230, 1, 198, '1', ' '),
(231, 1, 199, '1', ' '),
(232, 1, 200, '1', ' '),
(233, 1, 201, '1', ' '),
(234, 1, 202, '1', ' '),
(235, 1, 203, '1', ' '),
(236, 1, 204, '1', ' '),
(237, 1, 205, '1', ' '),
(238, 1, 88, '1', ''),
(239, 1, 57, '1', '');

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
-- Indeks untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

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
-- AUTO_INCREMENT untuk tabel `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `detail_pengajuan`
--
ALTER TABLE `detail_pengajuan`
  MODIFY `detail_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=586;

--
-- AUTO_INCREMENT untuk tabel `pemohon`
--
ALTER TABLE `pemohon`
  MODIFY `id_pemohon` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `verifikasi`
--
ALTER TABLE `verifikasi`
  MODIFY `id_verifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

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
