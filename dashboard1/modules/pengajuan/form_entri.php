<?php
session_start();
include 'config/koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id_pemohon'])) {
    header("Location: login.php");
    exit();
}

// Inisialisasi session untuk menyimpan data form utama
if (!isset($_SESSION['data_utama_temp'])) {
    $_SESSION['data_utama_temp'] = array();
}

// Fungsi untuk mengunggah file
function upload_file($file_key, $upload_dir) {
    if (isset($_FILES[$file_key]) && $_FILES[$file_key]['error'] == 0) {
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'pdf');
        $file_extension = strtolower(pathinfo($_FILES[$file_key]["name"], PATHINFO_EXTENSION));
        
        if (in_array($file_extension, $allowed_extensions)) {
            $new_filename = time() . rand(1000, 9999) . '.' . $file_extension;
            $target_file = $upload_dir . $new_filename;
            
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            if (move_uploaded_file($_FILES[$file_key]["tmp_name"], $target_file)) {
                return $new_filename; // Mengembalikan hanya nama file baru
            }
        }
    }
    return "";
}

function getCurrentDateTime() {
    return date('Y-m-d');
}

// Jika form utama disubmit
// Jika form utama disubmit
if (isset($_POST['simpan']) || isset($_POST['lanjut'])) {
    $id_pemohon = $_SESSION['id_pemohon'];
    $nomor_kk = mysqli_real_escape_string($mysqli, $_POST['nomor_kk']);
    $alamat = mysqli_real_escape_string($mysqli, $_POST['alamat']);
    $rt = mysqli_real_escape_string($mysqli, $_POST['rt']);
    $rw = mysqli_real_escape_string($mysqli, $_POST['rw']);
    $desa = mysqli_real_escape_string($mysqli, $_POST['desa']);
    $kecamatan = mysqli_real_escape_string($mysqli, $_POST['kecamatan']);
    $tgl_pengajuan = getCurrentDateTime();
    
    $upload_dir = "uploads/";
    $sktm = upload_file('sktm', $upload_dir);
    $dtks = upload_file('dtks', $upload_dir);
    $kartu_keluarga = upload_file('kartu_keluarga', $upload_dir);
    $ktp = upload_file('ktp', $upload_dir);

    // Simpan data sementara
    $_SESSION['data_utama_temp'] = array(
        'nomor_kk' => $nomor_kk,
        'alamat' => $alamat,
        'rt' => $rt,
        'rw' => $rw,
        'desa' => $desa,
        'kecamatan' => $kecamatan,
        'sktm' => $sktm,
        'dtks' => $dtks,
        'kartu_keluarga' => $kartu_keluarga,
        'ktp' => $ktp
    );

    if (isset($_POST['simpan'])) {
        if (empty($nomor_kk) || empty($alamat) || empty($rt) || empty($rw) || empty($desa) || empty($kecamatan) || !$sktm || !$dtks || !$ktp || !$kartu_keluarga) {
            $_SESSION['error'] = "Semua field harus diisi dan file harus diunggah.";
        } else {
            $query = "INSERT INTO pengajuan (id_pemohon, nomor_kk, alamat, rt, rw, desa, kecamatan, sktm, dtks, kartu_keluarga, ktp, tgl_pengajuan) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("isssssssssss", $id_pemohon, $nomor_kk, $alamat, $rt, $rw, $desa, $kecamatan, $sktm, $dtks, $kartu_keluarga, $ktp, $tgl_pengajuan);
            
            if ($stmt->execute()) {
                $id_pengajuan = $mysqli->insert_id;
                $_SESSION['id_pengajuan'] = $id_pengajuan;
                
                // Bersihkan session
                unset($_SESSION['data_utama_temp']);

                $_SESSION['success'] = "Pengajuan berhasil disimpan.";
                header("Location: ?module=pengajuan");
                exit();
            } else {
                $_SESSION['error'] = "Gagal menyimpan pengajuan: " . $mysqli->error;
            }
        }
    } elseif (isset($_POST['lanjut'])) {
        // Redirect ke halaman entri_detailpengajuan
        header("Location: ?module=entri_detailpengajuan");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Entri Pengajuan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="d-flex align-items-center mb-3">
        <i class="fas fa-user-circle fs-2 me-2"></i>
        <h2 class="mb-0">Pengajuan Baru</h2>
    </div>
  
    <div class="card shadow-sm mb-4">
        <div class="card-body bg-light">
            <div class="d-flex align-items-center">
                <i class="fas fa-pen-to-square me-2"></i>
                <span class="fw-bold">Entri Data pengajuan</span>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <!-- Form fields -->
        <div class="row">
            <div class="col-12 mb-3">
                <label class="form-label">Nomor KK <span class="text-danger">*</span></label>
                <input type="text" name="nomor_kk" class="form-control" value="<?php echo isset($_SESSION['data_utama_temp']['nomor_kk']) ? htmlspecialchars($_SESSION['data_utama_temp']['nomor_kk']) : ''; ?>" required>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">Alamat <span class="text-danger">*</span></label>
                <input type="text" name="alamat" class="form-control" value="<?php echo isset($_SESSION['data_utama_temp']['alamat']) ? htmlspecialchars($_SESSION['data_utama_temp']['alamat']) : ''; ?>" required>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">RT <span class="text-danger">*</span></label>
                <input type="text" name="rt" class="form-control" value="<?php echo isset($_SESSION['data_utama_temp']['rt']) ? htmlspecialchars($_SESSION['data_utama_temp']['rt']) : ''; ?>" required>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">RW <span class="text-danger">*</span></label>
                <input type="text" name="rw" class="form-control" value="<?php echo isset($_SESSION['data_utama_temp']['rw']) ? htmlspecialchars($_SESSION['data_utama_temp']['rw']) : ''; ?>" required>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">Desa/Kelurahan <span class="text-danger">*</span></label>
                <input type="text" name="desa" class="form-control" value="<?php echo isset($_SESSION['data_utama_temp']['desa']) ? htmlspecialchars($_SESSION['data_utama_temp']['desa']) : ''; ?>" required>
            </div>
            <div class="col-12 mb-3">
                <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                <input type="text" name="kecamatan" class="form-control" value="<?php echo isset($_SESSION['data_utama_temp']['kecamatan']) ? htmlspecialchars($_SESSION['data_utama_temp']['kecamatan']) : ''; ?>" required>
            </div>
        </div>

        <!-- File upload fields -->
        <div class="row">
        <div class="col-12 mb-3">
        <label class="form-label">SKTM <span class="text-danger">*</span></label>
        <input type="file" name="sktm" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
        <?php if (isset($_SESSION['data_utama_temp']['sktm'])): ?>
            <p>File yang diunggah: <?php echo htmlspecialchars($_SESSION['data_utama_temp']['sktm']); ?></p>
        <?php endif; ?>
    </div>
    <div class="col-12 mb-3">
        <label class="form-label">DTKS <span class="text-danger">*</span></label>
        <input type="file" name="dtks" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
        <?php if (isset($_SESSION['data_utama_temp']['dtks'])): ?>
            <p>File yang diunggah: <?php echo htmlspecialchars($_SESSION['data_utama_temp']['sktm']); ?></p>
        <?php endif; ?>
    </div>
    <div class="col-12 mb-3">
        <label class="form-label">KTP <span class="text-danger">*</span></label>
        <input type="file" name="ktp" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
        <?php if (isset($_SESSION['data_utama_temp']['ktp'])): ?>
            <p>File yang diunggah: <?php echo htmlspecialchars($_SESSION['data_utama_temp']['sktm']); ?></p>
        <?php endif; ?>
    </div>
    <div class="col-12 mb-3">
        <label class="form-label">KARTU KELUARGA <span class="text-danger">*</span></label>
        <input type="file" name="kartu_keluarga" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
        <?php if (isset($_SESSION['data_utama_temp']['kartu_keluarga'])): ?>
            <p>File yang diunggah: <?php echo htmlspecialchars($_SESSION['data_utama_temp']['sktm']); ?></p>
        <?php endif; ?>
    </div>
    
        </div>

        <div class="mt-4">
           
            <button type="submit" name="lanjut" class="btn btn-secondary">Lanjut</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>