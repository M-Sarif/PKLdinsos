<?php
session_start();
include 'config/koneksi.php';

// Periksa apakah user sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: index.php");
    exit();
}

// Ambil data pemohon berdasarkan id_user yang login
$id_user = $_SESSION['id_user'];
$query = "SELECT pemohon.id_pemohon, pemohon.nama, pemohon.alamat, pemohon.tgl_lahir, pemohon.jenis_kelamin, pemohon.telepon
          FROM pemohon 
          WHERE pemohon.id_user = ?";
          
$stmt = mysqli_prepare($mysqli, $query);
mysqli_stmt_bind_param($stmt, "i", $id_user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user_data = mysqli_fetch_assoc($result);

if (!$user_data) {
    die("Data pemohon tidak ditemukan.");
}

$id_pemohon = $user_data['id_pemohon'];

// Hitung total pengajuan untuk pemohon ini
$query_total_pengajuan = "SELECT COUNT(*) as total FROM pengajuan WHERE id_pemohon = ?";
$stmt_total_pengajuan = mysqli_prepare($mysqli, $query_total_pengajuan);
mysqli_stmt_bind_param($stmt_total_pengajuan, "i", $id_pemohon);
mysqli_stmt_execute($stmt_total_pengajuan);
$result_total_pengajuan = mysqli_stmt_get_result($stmt_total_pengajuan);
$total_pengajuan = mysqli_fetch_assoc($result_total_pengajuan)['total'];

// Hitung total terverifikasi untuk pemohon ini
$query_terverifikasi = "SELECT COUNT(*) as total FROM pengajuan p
                        JOIN verifikasi v ON p.id_pengajuan = v.id_pengajuan
                        WHERE p.id_pemohon = ? AND v.statuss = 1";
$stmt_terverifikasi = mysqli_prepare($mysqli, $query_terverifikasi);
mysqli_stmt_bind_param($stmt_terverifikasi, "i", $id_pemohon);
mysqli_stmt_execute($stmt_terverifikasi);
$result_terverifikasi = mysqli_stmt_get_result($stmt_terverifikasi);
$total_terverifikasi = mysqli_fetch_assoc($result_terverifikasi)['total'];

// Hitung total ditolak untuk pemohon ini
$query_ditolak = "SELECT COUNT(*) as total FROM pengajuan p
                  JOIN verifikasi v ON p.id_pengajuan = v.id_pengajuan
                  WHERE p.id_pemohon = ? AND v.statuss = 0";
$stmt_ditolak = mysqli_prepare($mysqli, $query_ditolak);
mysqli_stmt_bind_param($stmt_ditolak, "i", $id_pemohon);
mysqli_stmt_execute($stmt_ditolak);
$result_ditolak = mysqli_stmt_get_result($stmt_ditolak);
$total_ditolak = mysqli_fetch_assoc($result_ditolak)['total'];

// Hitung total belum diverifikasi untuk pemohon ini
$query_pending = "SELECT COUNT(*) as total FROM pengajuan 
                  WHERE id_pemohon = ? AND id_pengajuan NOT IN (SELECT id_pengajuan FROM verifikasi)";
$stmt_pending = mysqli_prepare($mysqli, $query_pending);
mysqli_stmt_bind_param($stmt_pending, "i", $id_pemohon);
mysqli_stmt_execute($stmt_pending);
$result_pending = mysqli_stmt_get_result($stmt_pending);
$total_pending = mysqli_fetch_assoc($result_pending)['total'];

?>

<div style="background-color:azure; height: 100%;">
    <div class="d-flex flex-column flex-lg-row mb-4">
        <div class="flex-grow-1 d-flex align-items-center">
            <i class="fa-solid fa-chart-simple icon-title"></i>
            <h3>Dashboard</h3>
        </div>
    </div>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-3 d-block mt-xxl-n4">
                <img class="img-fluid px-xl-4 mt-xxl-n5" src="assets/img/PUSKESOS.png" alt="PUSKESOS Logo">
            </div>
            <div class="col-lg-9">
                <h4 class="mt-3 mt-lg-0 mb-2">Selamat datang <?php echo htmlspecialchars($user_data['nama']); ?> <strong> di Pusat Kesejahteraan Sosial</strong></h4>
                <p class="text-muted fw-light mb-4">Layanan Untuk Pengajuan BPJS Gratis Yang Didanai Oleh Pemerintah Daerah Kapuas</p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Total Pengajuan -->
        <div class="col-lg-3">
            <div class="bg-white rounded-4 shadow-sm p-4 p-lg-4-2 mb-4">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="me-4">
                        <i class="fa-solid fa-file-alt icon-widget"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1"><small>Total Pengajuan</small></p>
                        <h5 class="fw-bold mb-0"><?php echo number_format($total_pengajuan, 0, '', '.'); ?></h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Terverifikasi -->
        <div class="col-lg-3">
            <div class="bg-white rounded-4 shadow-sm p-4 p-lg-4-2 mb-4">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="me-4">
                        <i class="fa-solid fa-check-circle icon-widget"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1"><small>Terverifikasi</small></p>
                        <h5 class="fw-bold mb-0"><?php echo number_format($total_terverifikasi, 0, '', '.'); ?></h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ditolak -->
        <div class="col-lg-3">
            <div class="bg-white rounded-4 shadow-sm p-4 p-lg-4-2 mb-4">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="me-4">
                        <i class="fa-solid fa-times-circle icon-widget"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1"><small>Ditolak</small></p>
                        <h5 class="fw-bold mb-0"><?php echo number_format($total_ditolak, 0, '', '.'); ?></h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Belum Diverifikasi -->
        <div class="col-lg-3">
            <div class="bg-white rounded-4 shadow-sm p-4 p-lg-4-2 mb-4">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="me-4">
                        <i class="fa-solid fa-clock icon-widget"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1"><small>Belum Diverifikasi</small></p>
                        <h5 class="fw-bold mb-0"><?php echo number_format($total_pending, 0, '', '.'); ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>