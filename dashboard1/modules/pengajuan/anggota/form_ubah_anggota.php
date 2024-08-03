<?php
session_start();
include "config/database.php";

// Fungsi untuk mendapatkan data anggota berdasarkan ID
function getAnggotaById($id) {
    global $mysqli;
    $query = "SELECT * FROM detail_pengajuan WHERE detail_pengajuan = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

$id = isset($_GET['id']) ? $_GET['id'] : null;
$anggota = null;

if ($id) {
    $anggota = getAnggotaById($id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $hubungan_keluarga = $_POST['hubungan_keluarga'];

    // Update data anggota
    $query = "UPDATE detail_pengajuan SET nik = ?, nama = ?, jenis_kelamin = ?, tempat_lahir = ?, tgl_lahir = ?, hubungan_keluarga = ? WHERE detail_pengajuan = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssisssi", $nik, $nama, $jenis_kelamin, $tempat_lahir, $tgl_lahir, $hubungan_keluarga, $id);

    if ($stmt->execute()) {
        // Reset statuss dan pesan
        $resetVerifikasi = "UPDATE verifikasi v
                            JOIN pengajuan p ON v.id_pengajuan = p.id_pengajuan
                            JOIN detail_pengajuan dp ON p.id_pengajuan = dp.id_pengajuan
                            SET v.statuss = NULL, v.pesan = ''
                            WHERE dp.detail_pengajuan = ?";
        $stmtReset = $mysqli->prepare($resetVerifikasi);
        if ($stmtReset) {
            $stmtReset->bind_param("i", $id);
            $stmtReset->execute();
        } else {
            // Handle error jika query tidak bisa dipersiapkan
            $_SESSION['error_message'] = "Terjadi kesalahan saat menyiapkan query reset verifikasi: " . $mysqli->error;
        }

        $_SESSION['success_message'] = "Data berhasil diperbarui.";
        
        // Ambil id_pengajuan untuk redirect
        $queryGetIdPengajuan = "SELECT id_pengajuan FROM detail_pengajuan WHERE detail_pengajuan = ?";
        $stmtGetId = $mysqli->prepare($queryGetIdPengajuan);
        $stmtGetId->bind_param("i", $id);
        $stmtGetId->execute();
        $resultGetId = $stmtGetId->get_result();
        $rowGetId = $resultGetId->fetch_assoc();
        $id_pengajuan = $rowGetId['id_pengajuan'];

        header("Location: ?module=tampil_detail_pengajuan&id=" . $id_pengajuan);
        exit();
    } else {
        $_SESSION['error_message'] = "Terjadi kesalahan saat mengupdate data: " . $mysqli->error;
    }
}
?>

<div class="d-flex flex-column flex-lg-row mb-4">
    <div class="flex-grow-1 d-flex align-items-center">
        <i class="fa-regular fa-user icon-title"></i>
        <h3>Edit Anggota Keluarga</h3>
    </div>
</div>

<div class="bg-white rounded-4 shadow-sm p-4 mb-4">
    <form action="" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="mb-3">
            <label class="form-label">NIK <span class="text-danger">*</span></label>
            <input type="text" name="nik" class="form-control" value="<?php echo $anggota ? $anggota['nik'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama <span class="text-danger">*</span></label>
            <input type="text" name="nama" class="form-control" value="<?php echo $anggota ? $anggota['nama'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="1" <?php echo ($anggota && $anggota['jenis_kelamin'] == 1) ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="2" <?php echo ($anggota && $anggota['jenis_kelamin'] == 2) ? 'selected' : ''; ?>>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
            <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $anggota ? $anggota['tempat_lahir'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="date" name="tgl_lahir" class="form-control" value="<?php echo $anggota ? $anggota['tgl_lahir'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Hubungan Keluarga <span class="text-danger">*</span></label>
            <input type="text" name="hubungan_keluarga" class="form-control" value="<?php echo $anggota ? $anggota['hubungan_keluarga'] : ''; ?>" required>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Perbarui Anggota</button>
            <a href="?module=tampil_detail_pengajuan&id=<?php echo $anggota['id_pengajuan']; ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
