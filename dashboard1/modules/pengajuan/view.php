<div class="container mt-4">
    <div class="d-flex align-items-center mb-3">
        <i class="fas fa-user-circle fs-2 me-2"></i>
        <h2 class="mb-0">Pengajuan Baru</h2>
    </div>
  
    <div class="card shadow-sm mb-4">
        <div class="card-body bg-light">
            <div class="d-flex align-items-center">
                <i class="fas fa-pen-to-square me-2"></i>
                <span class="fw-bold">Entri Data anggota yang diusulkan</span>
            </div>
        </div>
    </div>

    <?php
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    ?>
     <div class="mt-4">
        
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Hubungan Keluarga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['anggota_temp'] as $index => $anggota): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($anggota['nik']); ?></td>
                        <td><?php echo htmlspecialchars($anggota['nama']); ?></td>
                        <td><?php echo htmlspecialchars($anggota['jenis_kelamin'] == 1 ? 'Laki-laki' : 'Perempuan'); ?></td>
                        <td><?php echo htmlspecialchars($anggota['tempat_lahir']); ?></td>
                        <td><?php echo htmlspecialchars($anggota['tgl_lahir']); ?></td>
                        <td><?php echo htmlspecialchars($anggota['hubungan_keluarga']); ?></td>
                        <td>
                            <a href="?module=form_entri_pengajuan&hapus_anggota=<?php echo $index; ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?');">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <a href="?module=entri_detailpengajuan" class="btn btn-success">Tambah Anggota</a>
        </div>

        <br>
<div>