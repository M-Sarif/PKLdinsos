<?php
// panggil file "database.php" untuk koneksi ke database
require_once "../../config/koneksi.php";

// mengecek data GET "id_pengajuan"
if (isset($_GET['id'])) {
    // ambil data GET dari tombol hapus
    $id_pengajuan = mysqli_real_escape_string($mysqli, $_GET['id']);

    // sql statement untuk delete data dari tabel "pengajuan" berdasarkan "id_pengajuan"
    $delete = mysqli_query($mysqli, "DELETE FROM pengajuan WHERE id_pengajuan='$id_pengajuan'")
                                     or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));
    // cek query
    // jika proses delete berhasil
    if ($delete) {
        // alihkan ke halaman data siswa dan tampilkan pesan berhasil hapus data
        header('location: ../../main.php?module=pengajuan&pesan=2');
    }
}
