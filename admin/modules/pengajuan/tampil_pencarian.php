<?php
// session_start();
include 'config/koneksi.php';

// Periksa apakah pengguna sudah login dan merupakan admin
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Ambil kata kunci pencarian
$search = isset($_GET['search']) ? mysqli_real_escape_string($mysqli, $_GET['search']) : '';

// Query untuk mengambil data pengajuan dengan pencarian
$query = "SELECT p.id_pengajuan, p.nomor_kk, p.tgl_pengajuan, 
          COALESCE(v.statuss, 'Belum Diverifikasi') as status_verifikasi, 
          v.pesan, d.nik, d.nama
          FROM pengajuan p
          LEFT JOIN verifikasi v ON p.id_pengajuan = v.id_pengajuan 
          LEFT JOIN detail_pengajuan d ON p.id_pengajuan = d.id_pengajuan
          WHERE p.nomor_kk LIKE '%$search%' 
          OR d.nik LIKE '%$search%' 
          OR d.nama LIKE '%$search%'
          GROUP BY p.id_pengajuan
          ORDER BY p.tgl_pengajuan DESC";

$result = mysqli_query($mysqli, $query);
$pengajuan = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Hasil Pencarian Pengajuan</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
</head>
<body>
    <div style="background-color:azure; height: 100%;">
        <div class="d-flex flex-column flex-lg-row mb-4">
            <div class="flex-grow-1 d-flex align-items-center">
                <i class="fa-solid fa-search icon-title"></i>
                <h3>Hasil Pencarian Pengajuan</h3>
            </div>
        </div>
        
        <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
            <h4>Hasil pencarian untuk: "<?php echo htmlspecialchars($search); ?>"</h4>
            <a href="?module=perngajuan" class="btn btn-secondary">Kembali ke Daftar Pengajuan</a>
        </div>

        <?php if (empty($pengajuan)): ?>
            <p>Tidak ada hasil yang ditemukan.</p>
        <?php else: ?>
            <table class="table table-striped" border="3">
                <thead>
                    <tr>
                        <th>Nomor KK</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($pengajuan as $data): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($data['nomor_kk']); ?></td>
                        <td><?php echo htmlspecialchars($data['nik']); ?></td>
                        <td><?php echo htmlspecialchars($data['nama']); ?></td>
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
                                echo "<span style='background-color: #9BEC00;'>Terverifikasi</span>";
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
        <?php endif; ?>
    </div>
</body>
</html>