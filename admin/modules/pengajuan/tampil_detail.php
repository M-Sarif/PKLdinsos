<?php
// session_start();
include 'config/koneksi.php';

// Periksa apakah user sudah login sebagai admin
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

$id_user = $_SESSION['id_user'];
$query_admin = "SELECT id_admin FROM admin WHERE id_user = ?";
$stmt = $mysqli->prepare($query_admin);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result_admin = $stmt->get_result();
$admin_data = $result_admin->fetch_assoc();

if (!$admin_data) {
    die("Data admin tidak ditemukan.");
}

function tampilkanGambar($namaFile, $altText) {
    if (!empty($namaFile)) {
        $uploadPath = '../dashboard1/uploads/';
        $webPath = '/pkl/hostechhtml-10/buyer-file/dashboard1/uploads/' . $namaFile;
        $serverPath = $_SERVER['DOCUMENT_ROOT'] . $webPath;
        
        if (file_exists($serverPath)) {
            echo "<img src='$webPath' alt='$altText' class='img-fluid' style='max-width: 300px;'>";
            echo "<br><a href='$webPath' target='_blank' class='btn btn-sm btn-primary mt-2'>Lihat Gambar Penuh</a>";
        } else {
            echo "File tidak ditemukan. Path: $serverPath";
        }
    } else {
        echo "Tidak ada file yang diunggah.";
    }
}

// Periksa apakah id_pengajuan diatur di URL
if (isset($_GET['id'])) {
    $id_pengajuan = $mysqli->real_escape_string($_GET['id']);

    // Query untuk mengambil data pengajuan termasuk field BLOB
    $query_pengajuan = "SELECT *, sktm, dtks, ktp, kartu_keluarga FROM pengajuan WHERE id_pengajuan = '$id_pengajuan'";
    $result_pengajuan = $mysqli->query($query_pengajuan);
    $data_pengajuan = $result_pengajuan->fetch_assoc();

    // Query untuk mengambil data detail_pengajuan
    $query_detail = "SELECT * FROM detail_pengajuan WHERE id_pengajuan = '$id_pengajuan'";
    $result_detail = $mysqli->query($query_detail);

    // Periksa apakah data ada
    if (!$data_pengajuan) {
        echo "Data pengajuan tidak ditemukan.";
        exit;
    }
} else {
    echo "ID Pengajuan tidak ditemukan.";
    exit;
}

// Cek status verifikasi
$query_verifikasi = "SELECT * FROM verifikasi WHERE id_pengajuan = ?";
$stmt = $mysqli->prepare($query_verifikasi);
$stmt->bind_param("i", $id_pengajuan);
$stmt->execute();
$result_verifikasi = $stmt->get_result();
$verifikasi_data = $result_verifikasi->fetch_assoc();

// Tangani pengiriman formulir untuk verifikasi
if (isset($_POST['verify']) || isset($_POST['update_verify'])) {
    $id_pengajuan = $mysqli->real_escape_string($_POST['id_pengajuan']);
    $status_verifikasi = $mysqli->real_escape_string($_POST['statuss']);
    $pesan = $mysqli->real_escape_string($_POST['pesan']);

    // Mulai transaksi
    $mysqli->begin_transaction();

    try {
        if (isset($_POST['verify'])) {
            // Insert ke tabel verifikasi
            $query_insert = "INSERT INTO verifikasi (id_admin, id_pengajuan, statuss, pesan) VALUES (?, ?, ?, ?)";
            $stmt = $mysqli->prepare($query_insert);
            $stmt->bind_param("iiis", $admin_data['id_admin'], $id_pengajuan, $status_verifikasi, $pesan);
        } else {
            // Update tabel verifikasi
            $query_update_verifikasi = "UPDATE verifikasi SET statuss = ?, pesan = ? WHERE id_pengajuan = ?";
            $stmt = $mysqli->prepare($query_update_verifikasi);
            $stmt->bind_param("isi", $status_verifikasi, $pesan, $id_pengajuan);
        }
        $stmt->execute();

        // Update tabel pengajuan
        

        // Commit transaksi
        $mysqli->commit();

        echo "<div class='alert alert-success'>Verifikasi berhasil " . (isset($_POST['verify']) ? "disimpan" : "diubah") . ".</div>";
        
        // Refresh data verifikasi
        $stmt = $mysqli->prepare($query_verifikasi);
        $stmt->bind_param("i", $id_pengajuan);
        $stmt->execute();
        $result_verifikasi = $stmt->get_result();
        $verifikasi_data = $result_verifikasi->fetch_assoc();
    } catch (Exception $e) {
        // Jika terjadi kesalahan, rollback transaksi
        $mysqli->rollback();
        echo "<div class='alert alert-danger'>Gagal menyimpan verifikasi: " . $e->getMessage() . "</div>";
    }

    // Refresh data pengajuan setelah update
    $result_pengajuan = $mysqli->query($query_pengajuan);
    $data_pengajuan = $result_pengajuan->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengajuan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
    <div class="d-flex flex-column flex-lg-row mb-4">
        <div class="flex-grow-1 d-flex align-items-center">
            <i class="fa-regular fa-user icon-title"></i>
            <h3>Detail Pengajuan</h3>
        </div>
    </div>

    <div class="mb-5">
        <div class="d-grid gap-3 d-sm-flex flex-sm-row-reverse">
            <a href="?module=pengajuan" class="btn btn-outline-secondary px-4 me-sm-auto">
                <i class="fa-solid fa-angle-left me-2"></i> Kembali
            </a>
        </div>
    </div>

    <?php if (!$verifikasi_data): ?>
    <div id="verificationForm" class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="alert alert-secondary rounded-4 mb-3" role="alert">
            <i class="fa-solid fa-list-ul me-2"></i> Verifikasi Pengajuan
        </div>
        <form method="POST">
            <input type="hidden" id="id_pengajuan" name="id_pengajuan" value="<?php echo $id_pengajuan; ?>">
            <div class="mb-3">
                <label for="statuss" class="form-label">Status</label>
                <select id="statuss" name="statuss" class="form-select" required>
                    <option value="1">Terima</option>
                    <option value="0">Tolak</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="pesan" class="form-label">Pesan (opsional)</label>
                <textarea id="pesan" name="pesan" class="form-control" placeholder="Masukkan pesan verifikasi" rows="4"></textarea>
            </div>
            <button type="submit" name="verify" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php else: ?>
    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="alert alert-info rounded-4 mb-3" role="alert">
            <i class="fa-solid fa-info-circle me-2"></i> Pengajuan ini sudah diverifikasi
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateVerificationModal">
            Ubah Verifikasi
        </button>
    </div>

    <!-- Modal untuk mengubah verifikasi -->
    <div class="modal fade" id="updateVerificationModal" tabindex="-1" aria-labelledby="updateVerificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateVerificationModalLabel">Ubah Verifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="id_pengajuan" name="id_pengajuan" value="<?php echo $id_pengajuan; ?>">
                        <div class="mb-3">
                            <label for="statuss" class="form-label">Status</label>
                            <select id="statuss" name="statuss" class="form-select" required>
                                <option value="1" <?php echo $verifikasi_data['statuss'] == 1 ? 'selected' : ''; ?>>Terima</option>
                                <option value="0" <?php echo $verifikasi_data['statuss'] == 0 ? 'selected' : ''; ?>>Tolak</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan (opsional)</label>
                            <textarea id="pesan" name="pesan" class="form-control" placeholder="Masukkan pesan verifikasi" rows="4"><?php echo htmlspecialchars($verifikasi_data['pesan']); ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" name="update_verify" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="bg-white rounded-4 shadow-sm p-4 mb-4">
        <div class="alert alert-secondary rounded-4 mb-5" role="alert">
            <i class="fa-solid fa-list-ul me-2"></i> Detail pengusul
        </div>
        <div class="d-flex flex-column flex-xl-row">
            <div class="flex-grow-1 text-muted fw-light ms-xl-5">
                <div class="table-responsive">
                    <table class="table table-striped lh-lg">
                        <tr>
                            <td width="200">Nomor Kartu Keluarga</td>
                            <td width="10">:</td>
                            <td><?php echo htmlspecialchars($data_pengajuan['nomor_kk']); ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Daftar</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($data_pengajuan['tgl_pengajuan']); ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($data_pengajuan['alamat']); ?></td>
                        </tr>
                        <tr>
                            <td>RT</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($data_pengajuan['rt']); ?></td>
                        </tr>
                        <tr>
                            <td>RW</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($data_pengajuan['rw']); ?></td>
                        </tr>
                        <tr>
                            <td>Desa</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($data_pengajuan['desa']); ?></td>
                        </tr>
                        <tr>
                            <td>Kecamatan</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($data_pengajuan['kecamatan']); ?></td>
                        </tr>
                        <tr>
                            <td>SKTM</td>
                            <td>:</td>
                            <td><?php tampilkanGambar($data_pengajuan['sktm'], 'SKTM'); ?></td>
                        </tr>
                        <tr>
                            <td>DTKS</td>
                            <td>:</td>
                            <td><?php tampilkanGambar($data_pengajuan['dtks'], 'DTKS'); ?></td>
                        </tr>
                        <tr>
                            <td>KTP</td>
                            <td>:</td>
                            <td><?php tampilkanGambar($data_pengajuan['ktp'], 'KTP'); ?></td>
                        </tr>
                        <tr>
                            <td>Kartu Keluarga</td>
                            <td>:</td>
                            <td><?php tampilkanGambar($data_pengajuan['kartu_keluarga'], 'Kartu Keluarga'); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

<div class="bg-white rounded-4 shadow-sm p-4 mb-4">
    <div class="alert alert-secondary rounded-4 mb-5" role="alert">
        <i class="fa-solid fa-list-ul me-2"></i> Detail Anggota
    </div>
    
    <div class="d-flex flex-column flex-xl-row">
        <div class="flex-grow-1 text-muted fw-light ms-xl-5">
            <div class="table-responsive">
                <table class="table table-striped lh-lg">
                    <thead>
                        <tr class="table-info">
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result_detail->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nik']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td>
                                <a href="?module=biodata_anggota&id=<?php echo $row['detail_pengajuan']; ?>" class="btn btn-sm btn-primary">Detail</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>