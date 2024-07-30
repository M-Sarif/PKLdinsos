<?php
include 'config/koneksi.php';

// Check if id_pengajuan is set in the URL
if (isset($_GET['id'])) {
    // Sanitize the input
    $id_pengajuan = mysqli_real_escape_string($mysqli, $_GET['id']);

    // Query to fetch data from detail_pengajuan table
    $query = "SELECT dp.*, p.nomor_kk 
              FROM detail_pengajuan dp
              INNER JOIN pengajuan p ON dp.id_pengajuan = p.id_pengajuan
              WHERE dp.detail_pengajuan = '$id_pengajuan'";
    
    $result = mysqli_query($mysqli, $query) or die('Ada kesalahan pada query tampil data: ' . mysqli_error($mysqli));

    // Fetch the data
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID Pengajuan tidak ditemukan.";
    exit;
}
?>

<div class="d-flex flex-column flex-lg-row mb-4">
    <div class="flex-grow-1 d-flex align-items-center">
        <i class="fa-regular fa-user icon-title"></i>
        <h3>Detail Pengajuan</h3>
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
                    <tr>
                        <td width="200">NIK</td>
                        <td width="10">:</td>
                        <td><?php echo htmlspecialchars($data['nik']); ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?php echo htmlspecialchars($data['nama']); ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                       <td><?php echo htmlspecialchars($data['jenis_kelamin'] == 1 ? 'Laki-laki' : 'Perempuan'); ?></td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>:</td>
                        <td><?php echo htmlspecialchars($data['tempat_lahir']); ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td><?php echo htmlspecialchars($data['tgl_lahir']); ?></td>
                    </tr>
                    <tr>
                        <td>Hubungan Keluarga</td>
                        <td>:</td>
                        <td><?php echo htmlspecialchars($data['hubungan_keluarga']); ?></td>
                    </tr>
                    <tr>
                        <td>Nomor KK</td>
                        <td>:</td>
                        <td><?php echo htmlspecialchars($data['nomor_kk']); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div