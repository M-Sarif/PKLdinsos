<?php
// session_start();
include 'config/koneksi.php';

// Periksa apakah user sudah login sebagai admin
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

// Ambil data admin berdasarkan id_user yang login
$id_user = $_SESSION['id_user'];
$query = "SELECT admin.id_admin, admin.nama, admin.alamat, admin.tgl_lahir, admin.jenis_kelamin, admin.telepon, admin.intansi
          FROM admin 
          WHERE admin.id_user = ?";
          
$stmt = mysqli_prepare($mysqli, $query);
mysqli_stmt_bind_param($stmt, "i", $id_user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$admin_data = mysqli_fetch_assoc($result);

if (!$admin_data) {
    die("Data admin tidak ditemukan.");
}

$id_admin = $admin_data['id_admin'];

// Hitung total pengajuan
$query_total_pengajuan = "SELECT COUNT(*) as total FROM pengajuan";
$result_total_pengajuan = mysqli_query($mysqli, $query_total_pengajuan);
$total_pengajuan = mysqli_fetch_assoc($result_total_pengajuan)['total'];

// Hitung total terverifikasi (status = 1)
$query_terverifikasi = "SELECT COUNT(*) as total FROM verifikasi WHERE statuss = 1";
$result_terverifikasi = mysqli_query($mysqli, $query_terverifikasi);
$total_terverifikasi = mysqli_fetch_assoc($result_terverifikasi)['total'];

// Hitung total ditolak (status = 0)
$query_ditolak = "SELECT COUNT(*) as total FROM detail_pengajuan";
$result_ditolak = mysqli_query($mysqli, $query_ditolak);
$total_ditolak = mysqli_fetch_assoc($result_ditolak)['total'];

// Hitung total belum diverifikasi (tidak ada dalam tabel verifikasi)
$query_pending = "SELECT COUNT(*) as total FROM pengajuan 
                  WHERE id_pengajuan NOT IN (SELECT id_pengajuan FROM verifikasi)";
$result_pending = mysqli_query($mysqli, $query_pending);
$total_pending = mysqli_fetch_assoc($result_pending)['total'];

?>

<div style="height: 100%;">
    <div class="d-flex flex-column flex-lg-row mb-4">
        <div class="flex-grow-1 d-flex align-items-center">
            <i class="fa-solid fa-chart-simple icon-title"></i>
            <h3>Dashboard Admin</h3>
        </div>
    </div>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-3 d-block mt-xxl-n4">
                <img class="img-fluid px-xl-4 mt-xxl-n5" src="assets/img/PUSKESOS.png" alt="PUSKESOS Logo">
            </div>
            <div class="col-lg-9">
                <h4 class="mt-3 mt-lg-0 mb-2">Selamat datang <?php echo htmlspecialchars($admin_data['nama']); ?> <strong> di Pusat Kesejahteraan Sosial</strong></h4>
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

         <!-- Ditolak -->
         <div class="col-lg-3">
            <div class="bg-white rounded-4 shadow-sm p-4 p-lg-4-2 mb-4">
                <div class="d-flex align-items-center justify-content-start">
                    <div class="me-4">
                        <i class="fa-solid fa-user icon-widget"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-1"><small>Total Anggota</small></p>
                        <h5 class="fw-bold mb-0"><?php echo number_format($total_ditolak, 0, '', '.'); ?></h5>
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