<?php
session_start();
include 'config/koneksi.php';

// Periksa apakah user sudah login
if (!isset($_SESSION['id_pemohon'])) {
    header("Location: index.php");
    exit();
}

// Ambil data pengajuan berdasarkan id_pemohon yang login
$id_pemohon = $_SESSION['id_pemohon'];
$query = "SELECT p.id_pengajuan, p.nomor_kk, p.tgl_pengajuan, 
          COALESCE(v.statuss, 'Belum Diverifikasi') as status_verifikasi, 
          v.pesan 
          FROM pengajuan p
          LEFT JOIN verifikasi v ON p.id_pengajuan = v.id_pengajuan 
          WHERE p.id_pemohon = ?
          ORDER BY p.tgl_pengajuan DESC";

$stmt = mysqli_prepare($mysqli, $query);
mysqli_stmt_bind_param($stmt, "i", $id_pemohon);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$pengajuan = [];

// Fetch the data if there are rows returned
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $pengajuan[] = $row;
    }
}

mysqli_stmt_close($stmt);
mysqli_close($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengajuan</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
</head>
<body>
    <div class="d-flex flex-column flex-lg-row mb-4">
        <div class="flex-grow-1 d-flex align-items-center">
            <i class="fa-regular fa-user icon-title"></i>
            <h3>Pengajuan</h3>
        </div>
    </div>

    <div class="mb-5">
        <div class="row flex-lg-row-reverse align-items-center">
            <div class="col-lg-5 col-xl-3">
                <a href="?module=form_entri_pengajuan" class="btn btn-outline-brand float-lg-end px-4 mb-4 mb-lg-0">
                    <i class="fa-solid fa-plus me-2"></i> Entri Pengajuan
                </a>
            </div>
            <div class="col-lg-7 col-xl-9">
                <form action="?module=tampil_pencarian_pengajuan" method="post" class="form-search needs-validation" novalidate>
                    <input type="text" name="kata_kunci" class="form-control rounded-pill" placeholder="Cari Pengajuan ..." autocomplete="off" required>
                    <div class="invalid-feedback">Masukan Nomor KK atau tanggal pengajuan yang ingin Anda cari.</div>
                </form>
            </div>
        </div>
    </div>

    <?php if (!empty($pengajuan)): ?>
        <table class="table table-striped">
            <thead>
                <p> proses pengajuan sedang berlangsung silahkan hubungi admin 1 bulan sejak status pengajuan diterima untuk pengecekan penerima BPJS Gratis</p>
                <tr style="background-color:#BBE9FF;">
                    <th>Nomor KK</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status pengajuan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pengajuan as $data): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($data['nomor_kk']); ?></td>
                        <td><?php echo htmlspecialchars($data['tgl_pengajuan']); ?></td>
                        <td>
                        <?php
                        if ($data['status_verifikasi'] === 'Belum Diverifikasi') {
                            echo "<span style='background-color: #F6F5F5;'>Belum Diverifikasi</span>";
                        } elseif ($data['status_verifikasi'] == '0') {
                            echo "<span style='background-color: #FF0000;'>Ditolak</span>";
                            if (!empty($data['pesan'])) {
                                echo " (" . htmlspecialchars($data['pesan']) . ")";
                            }
                        } elseif ($data['status_verifikasi'] == '1') {
                            echo "<span style='background-color: #9BEC00;'>pengajuan di terima </span>";
                           
                            if (!empty($data['pesan'])) {
                                echo " (" . htmlspecialchars($data['pesan']) . ")";
                            }
                        } else {
                            echo "Status Tidak Diketahui";
                        }
                        ?>
                        </td>
                        <td>
                            <a href="?module=tampil_detail_pengajuan&id=<?php echo $data['id_pengajuan']; ?>" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Tidak ada data pengajuan ditemukan.</p>
    <?php endif; ?>
</body>
</html>