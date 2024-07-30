<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $anggota = array(
        'nik' => $_POST['nik'],
        'nama' => $_POST['nama'],
        'jenis_kelamin' => $_POST['jenis_kelamin'],
        'tempat_lahir' => $_POST['tempat_lahir'],
        'tgl_lahir' => $_POST['tgl_lahir'],
        'hubungan_keluarga' => $_POST['hubungan_keluarga']
    );

    $_SESSION['anggota_temp'][] = $anggota;

    header("Location: ?module=entri_detailpengajuan");
    exit();
}
?>

<div class="d-flex flex-column flex-lg-row mb-4">
    <div class="flex-grow-1 d-flex align-items-center">
        <i class="fa-regular fa-user icon-title"></i>
        <h3>Tambah Anggota Keluarga</h3>
    </div>
</div>

<div class="bg-white rounded-4 shadow-sm p-4 mb-4">
    <form action="" method="post" class="needs-validation" novalidate>
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
            <select name="jenis_kelamin" class="form-control" required>
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
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Tambah Anggota</button>
            <a href="?module=entri_detailpengajuan" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>