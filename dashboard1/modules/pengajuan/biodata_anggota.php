<?php
session_start();

if (isset($_GET['index']) && isset($_SESSION['anggota_temp'][$_GET['index']])) {
    $anggota = $_SESSION['anggota_temp'][$_GET['index']];
} else {
    header("Location: ?module=form_entri_pengajuan");
    exit();
}
?>

<div class="d-flex flex-column flex-lg-row mb-4">
    <div class="flex-grow-1 d-flex align-items-center">
        <i class="fa-regular fa-user icon-title"></i>
        <h3>Detail Anggota Keluarga</h3>
    </div>
</div>

<div class="bg-white rounded-4 shadow-sm p-4 mb-4">
    <table class="table">
        <tr>
            <th>NIK</th>
            <td><?php echo htmlspecialchars($anggota['nik']); ?></td>
        </tr>
        <tr>
            <th>Nama</th>
            <td><?php echo htmlspecialchars($anggota['nama']); ?></td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td><?php echo $anggota['jenis_kelamin'] == 1 ? 'Laki-laki' : 'Perempuan'; ?></td>
        </tr>
        <tr>
            <th>Tempat Lahir</th>
            <td><?php echo htmlspecialchars($anggota['tempat_lahir']); ?></td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td><?php echo htmlspecialchars($anggota['tgl_lahir']); ?></td>
        </tr>
        <tr>
            <th>Hubungan Keluarga</th>
            <td><?php echo htmlspecialchars($anggota['hubungan_keluarga']); ?></td>
        </tr>
    </table>
    <div class="mt-4">
        <a href="?module=form_entri_pengajuan" class="btn btn-secondary">Kembali</a>
    </div>
</div>