<div class="d-flex flex-column flex-lg-row mb-4">
    <!-- judul halaman -->
    <div class="flex-grow-1 d-flex align-items-center">
        <i class="fa-regular fa-user icon-title"></i>
        <h3>Siswa</h3>
    </div>
    <!-- breadcrumbs -->
    <div class="ms-5 ms-lg-0 pt-lg-2">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="https://pustakakoding.com/" class="text-dark text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item"><a href="?module=siswa" class="text-dark text-decoration-none">Siswa</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">Entri</li>
            </ol>
        </nav>
    </div>
</div>
<?php
// Pastikan ini ada di awal file form_entri_detailpengajuan.php
if (isset($_GET['id'])) {
    $id_pengajuan = $mysqli->real_escape_string($_GET['id']);
} else {
    echo "ID Pengajuan tidak ditemukan.";
    exit;
}
?>

<div class="bg-white rounded-4 shadow-sm p-4 mb-4">
    <!-- judul form -->
    <div class="alert alert-secondary rounded-4 mb-5" role="alert">
        <i class="fa-solid fa-pen-to-square me-2"></i> Entri Data Siswa
    </div>
    <!-- form entri data -->
    <form action="modules/pengajuan/anggota/proses_simpan.php" method="post" class="needs-validation" novalidate>
    <input type="hidden" name="id_pengajuan" value="<?php echo htmlspecialchars($id_pengajuan); ?>">
    <div class="row">
        <div class="col-xl-6">
            <div class="row g-0">
                <div class="mb-3 col-xl-6 pe-xl-3">
                    <div>
                        <label class="form-label">NIK <span class="text-danger">*</span></label>
                        <input type="text" name="nik" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" name="tempat_lahir" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label">Tanggal Lahir<span class="text-danger">*</span></label>
                        <input type="date" name="tgl_lahir" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label">Hubungan Keluarga <span class="text-danger">*</span></label>
                        <input type="text" name="hubungan_keluarga" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="pt-4 pb-2 mt-5 border-top">
                <div class="d-grid gap-3 d-sm-flex justify-content-md-start pt-1">
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-outline-brand px-4">
                    <a href="?module=pengajuan" class="btn btn-outline-secondary px-4">Batal</a>
                </div>
            </div>
        </div>
    </div>
</form>
</div>


