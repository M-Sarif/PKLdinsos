<?php
// panggil file "database.php" untuk koneksi ke database
require_once "../../config/koneksi.php";

// mengecek data GET "id_pengajua"
if (isset($_GET['id'])) {
    // ambil data GET dari tombol hapus
    $id_pengajua = mysqli_real_escape_string($mysqli, $_GET['id']);

    

    // sql statement untuk delete data dari tabel "tbl_siswa" berdasarkan "id_pengajua"
    $delete = mysqli_query($mysqli, "DELETE FROM pengajuan WHERE id_pengajuan='$id_pengajua'")
                                     or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));
    // cek query
    // jika proses delete berhasil
    if ($delete) {
        // alihkan ke halaman data siswa dan tampilkan pesan berhasil hapus data
        header('location: ../../main.php?module=pengajuan&pesan=2');
    }
}
