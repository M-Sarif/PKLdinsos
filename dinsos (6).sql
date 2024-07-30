-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Jul 2024 pada 11.01
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
(0, 4, 2, 'tes', '2024-07-22 01:53:38', 0);

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
(1, 5, '6203010308020007', 'sarif', '1', 'asdada', '2024-07-03', 'anak'),
(2, 15, '6203034607020005', 'maulina', '2', 'kapuas', '2002-07-06', 'anak'),
(3, 18, '6203034607020005', 'maulina', '2', 'kapuas', '2002-07-06', 'anak'),
(4, 19, '788772123110002', 'dubai', '1', 'kelayan', '2004-02-03', 'kepala keluarga'),
(5, 19, '3414122441340002', 'ifah', '2', 'hsu', '2003-03-21', 'istri'),
(6, 21, '6203010308020007', 'sarif', '2', 'asdada', '2024-07-19', 'anak'),
(7, 24, '6203010308020007', 'sarif', '1', 'kuala kapuas', '2024-07-13', 'anak'),
(8, 26, '6203010308020007', 'dasda', '1', 'asdada', '2024-07-12', 'anak'),
(9, 26, '6203010308020007', 'dasda', '1', 'kuala kapuas', '2024-07-04', 'anak'),
(10, 40, '99990', 'dasda', '1', 'kuala kapuas', '2223-02-01', '3'),
(11, 40, '67', 'gh', '1', 'jjh', '0007-07-06', 'hj'),
(12, 40, '78', 'jkkk', '1', 'ghh', '0008-08-07', 'jk'),
(13, 40, '99990', 'sarif', '1', 'asdada', '0000-00-00', '1'),
(14, 45, '6203034607020005', 'maulina', '2', 'kapuas', '2002-07-06', 'istri'),
(15, 46, '6203034607020005', 'sarif', '1', 'panamas', '2002-03-06', 'kepala keluarga'),
(16, 47, '6203034607020005', 'maulina', '2', 'panamas', '2002-07-06', 'istri');

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
(2, 'aida', 'jl. barito', '2002-04-11', 'perempuan', '08329391283458', 3);

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
(2, 5, '88888888888', '2024-07-08', 'panamas', 12, 2, 'dmssdaj', 'scc', '668b4ce49cd96.png', '668b4ce49d3f6.png', '668b4ce49dba9.png', '668b4ce49d840.png', 1),
(2, 7, '88888888888', '2024-07-08', 'panamas', 32, 13, 'dsdas', 'sas', '668ba8b28dd38.png', '668ba8b28e220.png', '668ba8b28e577.png', '668ba8b28e3d2.png', 1),
(1, 15, '532112', '0000-00-00', 'sungai baras', 2, 1, 'selat utara', 'selat', 'uploads/Screenshot 2024-07-14 192827.png', 'uploads/Screenshot 2024-07-14 192827.png', 'uploads/Screenshot 2024-07-14 192827.png', 'uploads/Screenshot 2024-07-14 192827.png', 0),
(2, 16, '532112', '0000-00-00', 'sungai baras', 2, 31, 'selat utara', 'selat', 'sktm_1e46500b.png', 'dtks_c8cfa6e1.png', 'kk_033e0eda.jpg', 'ktp_dbf38953.jpg', 0),
(1, 17, '5221212', '0000-00-00', 'sungai baras', 2, 1, 'selat utara', 'selat', 'sktm_669683731b21b.png', 'dtks_669683731b99b.jpg', 'kk_669683731bd62.png', 'ktp_669683731c2a1.png', 0),
(1, 18, '4211', '2024-07-16', 'sungai baras', 2, 21, 'selat utara', 'selat', 'sktm_669685a32eb8e.jpg', 'dtks_669685a32eff4.jpg', 'kk_669685a32f24d.jpg', 'ktp_669685a32f544.jpg', 1),
(1, 19, '099883712323', '2024-07-16', 'banjarmasin', 21, 32, 'banjarmasin utara', 'banjarmasin timur', 'sktm_6696885cca2d9.jpg', 'dtks_6696885cca9ae.jpg', 'kk_6696885ccacd4.jpg', 'ktp_6696885ccaf12.jpg', 1),
(1, 20, '88760', '2024-07-17', 'panmas', 2, 1, 'sasd', 'selat', 'sktm_66979d20be385.png', 'dtks_66979d20beddc.png', 'kk_66979d20bf2eb.jpg', 'ktp_66979d20bf9bd.jpg', 0),
(1, 21, '231', '2024-07-22', 'panamas', 12, 13, 'dsdasda', 'sas', 'sktm_669d99c661a5d.png', 'dtks_669d99c6621ec.jpg', 'kk_669d99c662972.jpg', 'ktp_669d99c662e1c.jpg', 0),
(1, 23, '88888888888', '2024-07-22', 'panamas', 12, 13, 'dmssdaj', 'sas', 'sktm_669dc131a8bad.png', 'dtks_669dc131a96ef.png', 'kk_669dc131a9af6.jpg', 'ktp_669dc131aa066.png', 0),
(1, 24, '787776', '2024-07-22', 'panamas', 12, 13, 'asa', 'scc', 'sktm_669dc19a2c51b.jpg', 'dtks_669dc19a2c8f4.jpg', 'kk_669dc19a2cc33.jpg', 'ktp_669dc19a2cf7e.jpg', 0),
(1, 25, '311232', '2024-07-22', 'panamas', 12, 13, 'dmssdaj', 'asd', 'sktm_669dc20307865.jpg', 'dtks_669dc20307f97.png', 'kk_669dc203086a9.png', 'ktp_669dc20308c65.jpg', 0),
(1, 26, '231', '2024-07-22', 'panamas', 12, 2, 'asa', 'sas', 'sktm_669dc345bb308.png', 'dtks_669dc345bb8ff.png', 'kk_669dc345bbd0d.png', 'ktp_669dc345bc665.png', 0),
(1, 27, '231', '2024-07-22', 'panamas', 12, 13, 'dsdasda', 'scc', 'sktm_669dc40d57932.png', 'dtks_669dc40d587c9.png', 'kk_669dc40d58bcc.png', 'ktp_669dc40d58f4a.png', 0),
(1, 28, '1122', '2024-07-22', 'qsas', 21, 31, '2dasa', 'sa', 'sktm_669dc6ce50554.png', 'dtks_669dc6ce50def.png', 'kk_669dc6ce514e6.png', 'ktp_669dc6ce51d0c.png', 0),
(1, 29, '1122', '2024-07-22', 'qsas', 21, 31, '2dasa', 'sa', 'sktm_669dc72426fbb.png', 'dtks_669dc72427789.png', 'kk_669dc72428193.png', 'ktp_669dc72428d3a.png', 0),
(1, 30, '452231', '2024-07-22', 'panamas', 12, 13, 'dsdasda', 'sas', 'sktm_669dc745b9d78.png', 'dtks_669dc745ba943.png', 'kk_669dc745bc046.png', 'ktp_669dc745bc928.png', 0),
(1, 31, '452231', '2024-07-22', 'panamas', 12, 13, 'dsdasda', 'sas', 'sktm_669dc79e72b0c.png', 'dtks_669dc79e731f8.png', 'kk_669dc79e7386f.png', 'ktp_669dc79e73e53.png', 0),
(1, 32, '3244', '2024-07-22', 'sdccs', 21, 23, 'asa', 'scc', 'sktm_669dc833af8ed.png', 'dtks_669dc833b06b4.png', 'kk_669dc833b124f.png', 'ktp_669dc833b1b6a.png', 0),
(1, 33, '88888888888', '2024-07-22', 'panamas', 12, 13, 'dmssdaj', 'scc', 'sktm_669dc87c822d2.png', 'dtks_669dc87c83505.png', 'kk_669dc87c83d93.png', 'ktp_669dc87c84482.png', 0),
(1, 34, '231', '2024-07-22', 'panamas', 12, 13, 'asa', 'asd', 'sktm_669dc9a6adc13.png', 'dtks_669dc9a6ae50d.png', 'kk_669dc9a6aebfa.png', 'ktp_669dc9a6af26c.png', 0),
(1, 35, '231', '2024-07-22', 'panamas', 12, 31, 'adasd', 'asdadsa', 'sktm_669dcc1adeb08.png', 'dtks_669dcc1adf3d4.png', 'kk_669dcc1adfa99.png', 'ktp_669dcc1ae00c7.png', 0),
(1, 36, '231', '2024-07-22', 'panamas', 12, 31, 'adasd', 'asdadsa', 'sktm_669dcc80a1020.png', 'dtks_669dcc80a1eea.png', 'kk_669dcc80a26a9.png', 'ktp_669dcc80a2d05.png', 0),
(1, 37, '231', '2024-07-22', 'panamas', 12, 31, 'adasd', 'asdadsa', 'sktm_669dcc8500341.png', 'dtks_669dcc8500b62.png', 'kk_669dcc8501712.png', 'ktp_669dcc8502085.png', 0),
(1, 38, '231', '2024-07-22', 'panamas', 12, 31, 'adasd', 'asdadsa', 'sktm_669dcc922085b.png', 'dtks_669dcc922110b.png', 'kk_669dcc92217a3.png', 'ktp_669dcc9221ed8.png', 0),
(1, 39, '1234567890', '2024-07-22', 'panamas', 9, 78, 'hkkmkm', 'sdsa', 'sktm_669dce9f3cae7.png', 'dtks_669dce9f3d3b8.png', 'kk_669dce9f3db20.png', 'ktp_669dce9f3e1f9.png', 0),
(1, 40, '090932', '2024-07-22', 'jbhn', 78, 67, '7bansbman', 'hbsdabj', 'sktm_669dd76ac426f.png', 'dtks_669dd76ac534f.png', 'kk_669dd76ac5c52.png', 'ktp_669dd76ac62ed.png', 0),
(1, 42, '532112', '2024-07-23', 'sungai baras', 2, 6, 'banjarmasin utara', 'banjarmasin timur', 'sktm_669fe6c26b501.png', 'dtks_669fe6c26bee2.png', 'kk_669fe6c26c681.png', 'ktp_669fe6c26d092.jpg', 0),
(1, 43, '12300087667', '2024-07-23', 'sungai baras', 2, 31, 'selat utara', 'selat', 'sktm_669febd9340bb.png', 'dtks_669febd934a91.png', 'kk_669febd93548b.png', 'ktp_669febd935e65.png', 0),
(1, 44, '532112', '2024-07-23', 'sungai baras', 2, 1, 'banjarmasin utara', 'banjarmasin timur', 'sktm_669ff6fbe28d5.png', 'dtks_669ff6fbe31d7.png', 'kk_669ff6fbe399c.png', 'ktp_669ff6fbe42ae.png', 0),
(1, 45, '003227', '2024-07-24', 'sungai baras', 2, 1, 'selat utara', 'selat', 'uploads/sktm_66a0bb884547a.png', 'uploads/dtks_66a0bb8846716.png', 'uploads/kk_66a0bb884710c.png', 'uploads/ktp_66a0bb8847736.png', 0),
(2, 46, '532112', '2024-07-24', 'sungai baras', 2, 1, '212', 'banjarmasin timur', 'uploads/sktm_66a0bc4259e68.png', 'uploads/dtks_66a0bc425a9dd.png', 'uploads/kk_66a0bc425b0e0.png', 'uploads/ktp_66a0bc425b8db.png', 0),
(2, 47, '532112', '2024-07-24', 'sungai baras', 12, 1, 'selat utara', 'selat', '17218110952075.png', '17218110952544.png', '', '17218110959951.png', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(40) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama`, `alamat`, `tgl_lahir`, `jenis_kelamin`, `telepon`, `id_user`) VALUES
(1, 'M. Sarif', 'panamas', '2024-07-03', 'Laki-laki', '081549310752', 2),
(2, 'M. Sarif', 'panamas', '2024-07-03', 'Laki-laki', '081549310752', 3);

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
(4, '$2y$10$Ngmj99fXcKqoqneHpMh7Oul9gT26R5pqi2YHLJCkHVUEUjyqFBvAy', 'musa@gmail.com', 'admin');

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
(18, 1, 9, '1', 'sasa'),
(23, 1, 10, '1', ''),
(24, 1, 11, '0', 'berkas belum lengkap'),
(25, 1, 12, '1', 'hsa=='),
(27, 1, 5, '1', ''),
(29, 1, 7, '1', ''),
(30, 1, 8, '1', 'KARNA BEBAN'),
(31, 1, 18, '1', 'semua data diterima'),
(32, 1, 19, '1', ''),
(33, 1, 20, '1', ''),
(34, 2, 21, '0', '');

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
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `id_user` (`id_user`);

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
  MODIFY `detail_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pemohon`
--
ALTER TABLE `pemohon`
  MODIFY `id_pemohon` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `verifikasi`
--
ALTER TABLE `verifikasi`
  MODIFY `id_verifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
  ADD CONSTRAINT `pemohon_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pemohon_ibfk_2` FOREIGN KEY (`id_pemohon`) REFERENCES `pengajuan` (`id_pemohon`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`id_pemohon`) REFERENCES `pemohon` (`id_pemohon`);

--
-- Ketidakleluasaan untuk tabel `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD CONSTRAINT `verifikasi_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
