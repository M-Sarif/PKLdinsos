<?php
// Include database connection
require_once "config/koneksi.php";

// Check if id_pengajuan is set in the URL
if (isset($_GET['id'])) {
    $id_pengajuan = $mysqli->real_escape_string($_GET['id']);

    // Fetch the existing data for this id_pengajuan
    $query = "SELECT * FROM pengajuan WHERE id_pengajuan = '$id_pengajuan'";
    $result = $mysqli->query($query);
    $data = $result->fetch_assoc();

    if (!$data) {
        die("Data pengajuan tidak ditemukan.");
    }
} else {
    die("ID Pengajuan tidak ditemukan.");
}
?>

<div class="d-flex flex-column flex-lg-row mb-4">
    <div class="flex-grow-1 d-flex align-items-center">
        <i class="fa-regular fa-user icon-title"></i>
        <h3>Ubah Data Pengajuan</h3>
    </div>
    <div class="ms-5 ms-lg-0 pt-lg-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="text-dark text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item"><a href="?module=pengajuan" class="text-dark text-decoration-none">Pengajuan</a></li>
                <li class="breadcrumb-item" aria-current="page">Ubah</li>
            </ol>
        </nav>
    </div>
</div>

<div class="bg-white rounded-4 shadow-sm p-4 mb-4">
    <div class="alert alert-secondary rounded-4 mb-5" role="alert">
        <i class="fa-solid fa-pen-to-square me-2"></i> Ubah Data Pengajuan
    </div>
    <form action="modules/pengajuan/proses_ubah.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <input type="hidden" name="id_pengajuan" value="<?php echo $id_pengajuan; ?>">
        <div class="row">
            <div class="col-xl-6">
                <div class="mb-3">
                    <label class="form-label">Nomor KK <span class="text-danger">*</span></label>
                    <input type="text" name="nomor_kk" class="form-control" value="<?php echo htmlspecialchars($data['nomor_kk']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat <span class="text-danger">*</span></label>
                    <input type="text" name="alamat" class="form-control" value="<?php echo htmlspecialchars($data['alamat']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">RT <span class="text-danger">*</span></label>
                    <input type="text" name="rt" class="form-control" value="<?php echo htmlspecialchars($data['rt']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">RW <span class="text-danger">*</span></label>
                    <input type="text" name="rw" class="form-control" value="<?php echo htmlspecialchars($data['rw']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Desa <span class="text-danger">*</span></label>
                    <input type="text" name="desa" class="form-control" value="<?php echo htmlspecialchars($data['desa']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                    <input type="text" name="kecamatan" class="form-control" value="<?php echo htmlspecialchars($data['kecamatan']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">SKTM <small class="text-muted">(Biarkan kosong jika tidak ingin mengubah)</small></label>
                    <input type="file" name="sktm" class="form-control" accept=".pdf, .jpg, .png">
                </div>
                <div class="mb-3">
                    <label class="form-label">DTKS <small class="text-muted">(Biarkan kosong jika tidak ingin mengubah)</small></label>
                    <input type="file" name="dtks" class="form-control" accept=".pdf, .jpg, .png">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kartu Keluarga <small class="text-muted">(Biarkan kosong jika tidak ingin mengubah)</small></label>
                    <input type="file" name="kartu_keluarga" class="form-control" accept=".pdf, .jpg, .png">
                </div>
                <div class="mb-3">
                    <label class="form-label">KTP <small class="text-muted">(Biarkan kosong jika tidak ingin mengubah)</small></label>
                    <input type="file" name="ktp" class="form-control" accept=".pdf, .jpg, .png">
                </div>
            </div>
        </div>
        <div class="pt-4 pb-2 mt-5 border-top">
            <div class="d-grid gap-3 d-sm-flex justify-content-md-start pt-1">
                <input type="submit" name="simpan" value="Simpan Perubahan" class="btn btn-outline-brand px-4">
                <a href="?module=pengajuan" class="btn btn-outline-secondary px-4">Batal</a>
            </div>
        </div>
    </form>
</div>

<script>
    // Add your JavaScript validation here if needed
</script>