<?php
// session_start();
include 'config/koneksi.php';

// Periksa apakah pengguna sudah login dan merupakan admin
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Ambil data admin berdasarkan id_user yang login
$id_user = $_SESSION['id_user'];
$query_admin = "SELECT id_admin, nama FROM admin WHERE id_user = ?";
$stmt_admin = mysqli_prepare($mysqli, $query_admin);
mysqli_stmt_bind_param($stmt_admin, "i", $id_user);
mysqli_stmt_execute($stmt_admin);
$result_admin = mysqli_stmt_get_result($stmt_admin);
$admin_data = mysqli_fetch_assoc($result_admin);

if (!$admin_data) {
    die("Data admin tidak ditemukan.");
}

$id_admin = $admin_data['id_admin'];

// Ambil semua pengajuan beserta status verifikasinya
$query = "SELECT p.id_pengajuan, p.nomor_kk, p.tgl_pengajuan, 
          COALESCE(v.statuss, 'Belum Diverifikasi') as status_verifikasi, 
          v.pesan
          FROM pengajuan p
          LEFT JOIN verifikasi v ON p.id_pengajuan = v.id_pengajuan 
          ORDER BY p.tgl_pengajuan DESC";

$result = mysqli_query($mysqli, $query);
$pengajuan = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Tangani pengajuan verifikasi (jika ada)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify'])) {
    $id_pengajuan = $_POST['id_pengajuan'];
    $statuss = $_POST['statuss'];
    $pesan = $_POST['pesan'];
    
    $verify_query = "INSERT INTO verifikasi (id_pengajuan, id_admin, statuss, pesan) 
                     VALUES (?, ?, ?, ?) 
                     ON DUPLICATE KEY UPDATE statuss = ?, pesan = ?";
    
    $stmt = mysqli_prepare($mysqli, $verify_query);
    mysqli_stmt_bind_param($stmt, "iiisss", $id_pengajuan, $id_admin, $statuss, $pesan, $statuss, $pesan);
    mysqli_stmt_execute($stmt);
    
    // Segarkan halaman untuk menampilkan data yang diperbarui
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$search = isset($_GET['search']) ? mysqli_real_escape_string($mysqli, $_GET['search']) : '';

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
mysqli_close($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Data Pengajuan</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
</head>
<body>
    <div style="height: 100%;">
        <div class="d-flex flex-column flex-lg-row mb-4">
            <div class="flex-grow-1 d-flex align-items-center">
                <i class="fa-solid fa-file-alt icon-title"></i>
                <h3>Data Pengajuan</h3>
            </div>
        </div>
        

        <div class="bg-white rounded-4 shadow-sm p-4 mb-5">
            <h4>Selamat datang <?php echo htmlspecialchars($admin_data['nama']); ?></h4>
            <p>Berikut adalah daftar pengajuan yang perlu diverifikasi:</p>

            <div class="col-lg-7 col-xl-9">
                <form action="" method="get" class="form-search needs-validation" novalidate>
                    <input type="hidden" name="module" value="tampil_data">
                    <input type="text" name="search" class="form-control rounded-pill" placeholder="Cari Pengajuan ..." autocomplete="off" required value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <div class="invalid-feedback">Masukkan Nomor KK, NIK, atau nama yang ingin Anda cari.</div>
                </form>
            </div>
        </div>
        

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
    </div>
</body>
</html>