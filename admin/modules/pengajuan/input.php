<?php 
// session_start();
include '../../config/koneksi.php';

if (!isset($_SESSION['id_pengguna'])) {
    header("location:../../index.php?pesan=not_logged_in");
    exit();
}

$id_pengguna = $_SESSION['id_pengguna'];

function getInput($key, $isFile = false) {
    if ($isFile) {
        return isset($_FILES[$key]) ? $_FILES[$key] : null;
    }
    return isset($_POST[$key]) ? $_POST[$key] : null;
}

function handleFileUpload($file) {
    if ($file && $file['error'] == 0) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (!in_array($fileExtension, $allowedExtensions)) {
            return null;
        }
        
        if ($file['size'] > 1000000) { // 1MB limit
            return null;
        }
        
        $fileName = uniqid() . '.' . $fileExtension;
        $uploadPath = '../../uploads/' . $fileName;
        
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return $fileName;
        }
    }
    return null;
}

$nomor_kk = getInput('nomor_kk');
$tgl_pengajuan = date('Y-m-d H:i:s');
$alamat = getInput('alamat');
$rt = getInput('rt');
$rw = getInput('rw');
$desa = getInput('desa');
$kecamatan = getInput('kecamatan');

$sktm = handleFileUpload(getInput('sktm', true));
$dtks = handleFileUpload(getInput('dtks', true));
$ktp = handleFileUpload(getInput('ktp', true));
$kartu_keluarga = handleFileUpload(getInput('kartu_keluarga', true));

if (empty($nomor_kk) || empty($alamat) || empty($rt) || empty($rw) || empty($desa) || empty($kecamatan) || !$sktm || !$dtks || !$ktp || !$kartu_keluarga) {
    header("location:../../index.php?module=pengajuan&pesan=input_incomplete");
    exit();
}

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$stmt = $mysqli->prepare("INSERT INTO pengajuan (id_pengguna, nomor_kk, tgl_pengajuan, alamat, rt, rw, desa, kecamatan, sktm, dtks, kartu_keluarga, ktp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Error in prepare statement: " . $mysqli->error);
}

$stmt->bind_param("isssssssssss", $id_pengguna, $nomor_kk, $tgl_pengajuan, $alamat, $rt, $rw, $desa, $kecamatan, $sktm, $dtks, $kartu_keluarga, $ktp);

if ($stmt->execute()) {
    header("location:../../index.php?module=pengajuan&pesan=success");
} else {
    header("location:../../index.php?module=pengajuan&pesan=failed&error=" . urlencode($stmt->error));
}

$stmt->close();
$mysqli->close();
?>