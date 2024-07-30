<?php
// Pastikan koneksi database sudah dibuat
include 'config/koneksi.php';

// Periksa apakah parameter id_pengajuan ada
if (isset($_GET['id'])) {
    $id_pengajuan = $mysqli->real_escape_string($_GET['id']);
} else {
    echo "ID Pengajuan tidak ditemukan.";
    exit;
}
?>

<div class="d-flex flex-column flex-lg-row mb-4">
    <div class="flex-grow-1 d-flex align-items-center">
        <i class="fa-regular fa-user icon-title"></i>
        <h3>Tambah Anggota Keluarga</h3>
    </div>
    <div class="ms-5 ms-lg-0 pt-lg-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="text-dark text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item"><a href="?module=pengajuan" class="text-dark text-decoration-none">Pengajuan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Anggota</li>
            </ol>
        </nav>
    </div>
</div>

<div class="bg-white rounded-4 shadow-sm p-4 mb-4">
    <div class="alert alert-secondary rounded-4 mb-5" role="alert">
        <i class="fa-solid fa-pen-to-square me-2"></i> Tambah Data Anggota Keluarga
    </div>
    <form action="modules/pengajuan/anggota/proses_simpan.php" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="id_pengajuan" value="<?php echo htmlspecialchars($id_pengajuan); ?>">
        <div class="row">
            <div class="col-xl-6">
                <div class="mb-3">
                    <label class="form-label">NIK <span class="text-danger">*</span></label>
                    <input type="text" name="nik" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="1">Laki-laki</option>
                        <option value="2">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                    <input type="text" name="tempat_lahir" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" name="tgl_lahir" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Hubungan Keluarga <span class="text-danger">*</span></label>
                    <input type="text" name="hubungan_keluarga" class="form-control" required>
                </div>
                <div class="pt-4 pb-2 mt-5 border-top">
                    <div class="d-grid gap-3 d-sm-flex justify-content-md-start pt-1">
                        <button type="submit" name="simpan" class="btn btn-primary px-4">Simpan</button>
                        <a href="?module=tampil_detail&id=<?php echo $id_pengajuan; ?>" class="btn btn-secondary px-4">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>