<?php
include 'config/koneksi.php';

function displayImage($filename, $altText) {
    if (!empty($filename)) {
        $imagePath = "uploads/" . $filename;
        if (file_exists($imagePath)) {
            echo "<img src='$imagePath' alt='$altText' class='img-fluid' style='max-width: 300px;'>";
            echo "<br><a href='$imagePath' target='_blank' class='btn btn-sm btn-primary mt-2'>Lihat Gambar Penuh</a>";
        } else {
            echo "File tidak ditemukan.";
        }
    } else {
        echo "Tidak ada file yang diunggah.";
    }
}

// Check if id_pengajuan is set in the URL
if (isset($_GET['id'])) {
    $id_pengajuan = $mysqli->real_escape_string($_GET['id']);

    // Query to fetch pengajuan data including BLOB fields
    $query_pengajuan = "SELECT *, sktm, dtks, ktp, kartu_keluarga FROM pengajuan WHERE id_pengajuan = '$id_pengajuan'";
    $result_pengajuan = $mysqli->query($query_pengajuan);
    $data_pengajuan = $result_pengajuan->fetch_assoc();

    // Query to fetch detail_pengajuan data
    $query_detail = "SELECT * FROM detail_pengajuan WHERE id_pengajuan = '$id_pengajuan'";
    $result_detail = $mysqli->query($query_detail);

    // Check if data exists
    if (!$data_pengajuan) {
        echo "Data pengajuan tidak ditemukan.";
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

<div class="mb-5">
    <div class="d-grid gap-3 d-sm-flex flex-sm-row-reverse">
        <div class="d-grid gap-3 d-sm-flex">
            <a href="?module=form_ubah_pengajuan&id=<?php echo $id_pengajuan; ?>" class="btn btn-outline-brand px-4">
                <i class="fa-regular fa-pen-to-square me-2"></i> Ubah
            </a>
            <a href="modules/pengajuan/proses_hapus.php?id=<?php echo $id_pengajuan; ?>" onclick="return confirm('Anda yakin ingin menghapus data pengajuan <?php echo $data_pengajuan['nomor_kk']; ?>?')" class="btn btn-outline-brand px-4">
                <i class="fa-regular fa-trash-can me-2"></i> Hapus
            </a>
        </div>
        <a href="?module=pengajuan" class="btn btn-outline-secondary px-4 me-sm-auto">
            <i class="fa-solid fa-angle-left me-2"></i> Kembali
        </a>
    </div>
</div>

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
        <td><?php displayImage($data_pengajuan['sktm'], 'SKTM'); ?></td>
    </tr>
    <tr>
        <td>DTKS</td>
        <td>:</td>
        <td><?php displayImage($data_pengajuan['dtks'], 'DTKS'); ?></td>
    </tr>
    <tr>
        <td>KTP</td>
        <td>:</td>
        <td><?php displayImage($data_pengajuan['ktp'], 'KTP'); ?></td>
    </tr>
    <tr>
        <td>Kartu Keluarga</td>
        <td>:</td>
        <td><?php displayImage($data_pengajuan['kartu_keluarga'], 'Kartu Keluarga'); ?></td>
    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-4 shadow-sm p-4 mb-4">
    <div class="alert alert-secondary rounded-4 mb-5" role="alert">
        <i class="fa-solid fa-list-ul me-2"></i> Detail Anggota
        <
    </div>
    <div class="mb-5">
        <div class="d-grid gap-3 d-sm-flex flex-sm-row-reverse">
        <div class="d-grid gap-3 d-sm-flex">
        <a href="?module=tambah_anggota&id=<?php echo $id_pengajuan; ?>" class="btn btn-outline-brand px-4">
        <i class="fa-regular fa-pen-to-square me-2"></i> tambah anggota
        </a>
            
        </div>
        
    </div>
</div>
    <div class="d-flex flex-column flex-xl-row">
        <div class="flex-grow-1 text-muted fw-light ms-xl-5">
            <div class="table-responsive">
                <table class="table table-striped lh-lg">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>aksi</th>
                           
                        </tr>
                    </thead>
                    <tbody>
    <?php while ($row = $result_detail->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($row['nik']); ?></td>
        <td><?php echo htmlspecialchars($row['nama']); ?></td>
        <td>
            <a href="?module=biodata_anggota&id=<?php echo $row['detail_pengajuan']; ?>" class="btn btn-primary">Detail</a>
        </td>
    </tr>
    <?php endwhile; ?>
</tbody>
                </table>
            </div>
        </div>
    </div>
</div>