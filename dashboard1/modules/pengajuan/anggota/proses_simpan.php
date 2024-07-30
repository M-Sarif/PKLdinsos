<?php
// Enable error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Sesuaikan path ini ke file koneksi.php Anda
include '../../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Periksa koneksi database
    if (!isset($mysqli) || !($mysqli instanceof mysqli)) {
        die("Koneksi database tidak tersedia.");
    }

    // Ambil dan bersihkan data dari form
    $id_pengajuan = isset($_POST['id_pengajuan']) ? mysqli_real_escape_string($mysqli, $_POST['id_pengajuan']) : '';
    $nik = isset($_POST['nik']) ? mysqli_real_escape_string($mysqli, $_POST['nik']) : '';
    $nama = isset($_POST['nama']) ? mysqli_real_escape_string($mysqli, $_POST['nama']) : '';
    $jenis_kelamin = isset($_POST['jenis_kelamin']) ? mysqli_real_escape_string($mysqli, $_POST['jenis_kelamin']) : '';
    $tempat_lahir = isset($_POST['tempat_lahir']) ? mysqli_real_escape_string($mysqli, $_POST['tempat_lahir']) : '';
    $tgl_lahir = isset($_POST['tgl_lahir']) ? mysqli_real_escape_string($mysqli, $_POST['tgl_lahir']) : '';
    $hubungan_keluarga = isset($_POST['hubungan_keluarga']) ? mysqli_real_escape_string($mysqli, $_POST['hubungan_keluarga']) : '';

    // Periksa semua field terisi
    if (empty($id_pengajuan) || empty($nik) || empty($nama) || empty($jenis_kelamin) || empty($tempat_lahir) || empty($tgl_lahir) || empty($hubungan_keluarga)) {
        die("Semua field harus diisi. Silakan kembali dan lengkapi semua field.");
    }

    // Periksa apakah id_pengajuan ada di tabel pengajuan
    $check_query = "SELECT id_pengajuan FROM pengajuan WHERE id_pengajuan = '$id_pengajuan'";
    $check_result = mysqli_query($mysqli, $check_query);

    if (!$check_result) {
        die("Error saat memeriksa id_pengajuan: " . mysqli_error($mysqli));
    }

    if (mysqli_num_rows($check_result) == 0) {
        die("ID Pengajuan tidak valid (ID: $id_pengajuan). Silakan kembali dan coba lagi.");
    }

    // Masukkan data ke database
    $query = "INSERT INTO detail_pengajuan (id_pengajuan, nik, nama, jenis_kelamin, tempat_lahir, tgl_lahir, hubungan_keluarga)
              VALUES ('$id_pengajuan', '$nik', '$nama', '$jenis_kelamin', '$tempat_lahir', '$tgl_lahir', '$hubungan_keluarga')";

    if (mysqli_query($mysqli, $query)) {
        // Redirect ke halaman detail pengajuan
        header("Location: ../../../main.php?module=pengajuan&id=$id_pengajuan&alert=success");
        exit();
    } else {
        // Tampilkan pesan error
        die("Error saat memasukkan data: " . mysqli_error($mysqli));
    }
} else {
    // Jika diakses langsung tanpa data POST, redirect ke halaman utama
    header("Location: ../../../main.php?module=pengajuan");
    exit();
}
?>