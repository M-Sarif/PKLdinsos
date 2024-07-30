<?php
// session_start();
include 'config/koneksi.php';

// Periksa apakah user sudah login sebagai admin
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

// Query dasar
$query = "SELECT p.*, v.statuss, d.*
          FROM pengajuan p
          INNER JOIN verifikasi v ON p.id_pengajuan = v.id_pengajuan
          INNER JOIN detail_pengajuan d ON p.id_pengajuan = d.id_pengajuan
          WHERE v.statuss = 1";

// Jika ada filter tanggal, tambahkan ke query
if (isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir'])) {
    $tanggal_awal = $_GET['tanggal_awal'];
    $tanggal_akhir = $_GET['tanggal_akhir'];
    $query .= " AND p.tgl_pengajuan BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
}

$result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota Terverifikasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="alert alert-secondary rounded-4 mb-5" role="alert">
            <i class="fa-solid fa-calendar-days me-2"></i> Filter Tanggal Daftar
        </div>
        <form action="main.php" method="get" class="needs-validation" novalidate>
            <input type="hidden" name="module" value="terverifikasi">
            <div class="row">
                <div class="col-lg-4 col-xl-3 mb-4 mb-lg-0">
                    <label class="form-label">Tanggal Awal <span class="text-danger">*</span></label>
                    <input type="text" name="tanggal_awal" class="form-control datepicker" autocomplete="off" required>
                    <div class="invalid-feedback">Tanggal awal tidak boleh kosong.</div>
                </div>
                <div class="col-lg-4 col-xl-3 mb-4 mb-lg-0">
                    <label class="form-label">Tanggal Akhir <span class="text-danger">*</span></label>
                    <input type="text" name="tanggal_akhir" class="form-control datepicker" autocomplete="off" required>
                    <div class="invalid-feedback">Tanggal akhir tidak boleh kosong.</div>
                </div>
                <div class="col-lg-4 col-xl-3 align-self-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Anggota Terverifikasi</h2>
        <a href="modules/laporan/cetak.php<?php echo isset($_GET['tanggal_awal']) ? '?tanggal_awal='.$_GET['tanggal_awal'].'&tanggal_akhir='.$_GET['tanggal_akhir'] : ''; ?>" class="btn btn-success">
            <i class="fas fa-print"></i> Cetak
        </a>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NO KK</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>HUBUNGAN KELUARGA</th>
                <th>Tempat Lahir</th>
                <th>Tgl Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat Tempat Tinggal</th>
                <th>RT</th>
                <th>RW</th>
                <th>Nama Kecamatan</th>
                <th>Nama Desa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['nomor_kk']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nik']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                echo "<td>" . htmlspecialchars($row['hubungan_keluarga']) . "</td>";
                echo "<td>" . htmlspecialchars($row['tempat_lahir']) . "</td>";
                echo "<td>" . date('d/m/Y', strtotime($row['tgl_lahir'])) . "</td>";
                echo "<td>" . ($row['jenis_kelamin'] == 1 ? 'L' : 'P') . "</td>";
                echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
                echo "<td>" . htmlspecialchars($row['rt']) . "</td>";
                echo "<td>" . htmlspecialchars($row['rw']) . "</td>";
                echo "<td>" . htmlspecialchars($row['kecamatan']) . "</td>";
                echo "<td>" . htmlspecialchars($row['desa']) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function(){
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            language: 'id'
        });
    });
</script>
</body>
</html>