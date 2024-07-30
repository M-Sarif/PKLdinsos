<?php
session_start();
include 'config/koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id_pemohon'])) {
    header("Location: login.php");
    exit();
}

// Inisialisasi array anggota dan data utama jika belum ada
if (!isset($_SESSION['anggota_temp'])) {
    $_SESSION['anggota_temp'] = array();
}
if (!isset($_SESSION['data_utama_temp'])) {
    $_SESSION['data_utama_temp'] = array();
}

// Fungsi untuk menambah anggota keluarga
if (isset($_POST['add_family_member'])) {
    $new_member = array(
        'nik' => $_POST['nik'],
        'nama' => $_POST['nama'],
        'jenis_kelamin' => $_POST['jenis_kelamin'],
        'tempat_lahir' => $_POST['tempat_lahir'],
        'tgl_lahir' => $_POST['tgl_lahir'],
        'hubungan_keluarga' => $_POST['hubungan_keluarga']
    );
    $_SESSION['anggota_temp'][] = $new_member;
}

// Fungsi untuk menghapus anggota keluarga
if (isset($_GET['hapus_anggota'])) {
    $index = intval($_GET['hapus_anggota']);
    if (isset($_SESSION['anggota_temp'][$index])) {
        unset($_SESSION['anggota_temp'][$index]);
        $_SESSION['anggota_temp'] = array_values($_SESSION['anggota_temp']); // Re-index array
    }
}

// Jika form utama disubmit
if (isset($_POST['simpan'])) {
    $id_pemohon = $_SESSION['id_pemohon'];
    $nomor_kk = $_SESSION['data_utama_temp']['nomor_kk'];
    $alamat = $_SESSION['data_utama_temp']['alamat'];
    $rt = $_SESSION['data_utama_temp']['rt'];
    $rw = $_SESSION['data_utama_temp']['rw'];
    $desa = $_SESSION['data_utama_temp']['desa'];
    $kecamatan = $_SESSION['data_utama_temp']['kecamatan'];
    $sktm = $_SESSION['data_utama_temp']['sktm'];
    $dtks = $_SESSION['data_utama_temp']['dtks'];
    $kartu_keluarga = $_SESSION['data_utama_temp']['kartu_keluarga'];
    $ktp = $_SESSION['data_utama_temp']['ktp'];
    $tgl_pengajuan = date('Y-m-d');

    $query = "INSERT INTO pengajuan (id_pemohon, nomor_kk, alamat, rt, rw, desa, kecamatan, sktm, dtks, kartu_keluarga, ktp, tgl_pengajuan) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("isssssssssss", $id_pemohon, $nomor_kk, $alamat, $rt, $rw, $desa, $kecamatan, $sktm, $dtks, $kartu_keluarga, $ktp, $tgl_pengajuan);
    
    if ($stmt->execute()) {
        $id_pengajuan = $mysqli->insert_id;
        
        // Simpan anggota keluarga
        foreach ($_SESSION['anggota_temp'] as $anggota) {
            $query_anggota = "INSERT INTO detail_pengajuan (id_pengajuan, nik, nama, jenis_kelamin, tempat_lahir, tgl_lahir, hubungan_keluarga) 
                              VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt_anggota = $mysqli->prepare($query_anggota);
            $stmt_anggota->bind_param("issssss", $id_pengajuan, $anggota['nik'], $anggota['nama'], $anggota['jenis_kelamin'], 
                                      $anggota['tempat_lahir'], $anggota['tgl_lahir'], $anggota['hubungan_keluarga']);
            $stmt_anggota->execute();
        }

        // Bersihkan session
        unset($_SESSION['anggota_temp']);
        unset($_SESSION['data_utama_temp']);

        $_SESSION['success'] = "Pengajuan berhasil disimpan.";
        header("Location: ?module=pengajuan");
        exit();
    } else {
        $_SESSION['error'] = "Gagal menyimpan pengajuan: " . $mysqli->error;
    }
}

// Fungsi untuk menampilkan gambar atau dokumen
function displayImage($fileName, $altText) {
    $filePath = "uploads/" . $fileName;
    if (!empty($fileName) && file_exists($filePath)) {
        return '<a href="' . htmlspecialchars($filePath) . '" target="_blank"><img src="' . htmlspecialchars($filePath) . '" alt="' . htmlspecialchars($altText) . '" style="max-width: 200px; max-height: 200px;"></a><br><a href="' . htmlspecialchars($filePath) . '" target="_blank" class="btn btn-sm btn-primary mt-2">Lihat Gambar Penuh</a>';
    } else {
        return '<span>Tidak ada gambar</span>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Entri Detail Pengajuan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex align-items-center mb-3">
        <i class="fas fa-user-circle fs-2 me-2"></i>
        <h2 class="mb-0">Detail Pengajuan</h2>
    </div>
  
    <div class="card shadow-sm mb-4">
        <div class="card-body bg-light">
            <div class="d-flex align-items-center">
                <i class="fas fa-pen-to-square me-2"></i>
                <span class="fw-bold">Data Pengajuan</span>
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

    <table class="table table-striped lh-lg">
        <tr>
            <td width="200">Nomor Kartu Keluarga</td>
            <td width="10">:</td>
            <td><?php echo htmlspecialchars($_SESSION['data_utama_temp']['nomor_kk'] ?? ''); ?></td>
        </tr>
        <tr>
            <td>Tanggal Daftar</td>
            <td>:</td>
            <td><?php echo htmlspecialchars(date('Y-m-d')); ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($_SESSION['data_utama_temp']['alamat'] ?? ''); ?></td>
        </tr>
        <tr>
            <td>RT</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($_SESSION['data_utama_temp']['rt'] ?? ''); ?></td>
        </tr>
        <tr>
            <td>RW</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($_SESSION['data_utama_temp']['rw'] ?? ''); ?></td>
        </tr>
        <tr>
            <td>Desa</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($_SESSION['data_utama_temp']['desa'] ?? ''); ?></td>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <td><?php echo htmlspecialchars($_SESSION['data_utama_temp']['kecamatan'] ?? ''); ?></td>
        </tr>
        <tr>
            <td>SKTM</td>
            <td>:</td>
            <td><?php echo displayImage($_SESSION['data_utama_temp']['sktm'] ?? '', 'SKTM'); ?></td>
        </tr>
        <tr>
            <td>DTKS</td>
            <td>:</td>
            <td><?php echo displayImage($_SESSION['data_utama_temp']['dtks'] ?? '', 'DTKS'); ?></td>
        </tr>
        <tr>
            <td>KTP</td>
            <td>:</td>
            <td><?php echo displayImage($_SESSION['data_utama_temp']['ktp'] ?? '', 'KTP'); ?></td>
        </tr>
        <tr>
            <td>Kartu Keluarga</td>
            <td>:</td>
            <td><?php echo displayImage($_SESSION['data_utama_temp']['kartu_keluarga'] ?? '', 'Kartu Keluarga'); ?></td>
        </tr>
    </table>

    <div class="card shadow-sm">
        <div class="card-body bg-light">
            <div class="d-flex align-items-center mb-3">
                <i class="fas fa-users me-2"></i>
                <span class="fw-bold">Anggota Keluarga</span>
            </div>
            

            <div class="mt-4">
                <h5>Daftar Anggota Keluarga</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
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
    <?php
    if (!empty($_SESSION['anggota_temp'])) {
        foreach ($_SESSION['anggota_temp'] as $index => $anggota) {
            echo '<tr>';
            echo '<td>' . ($index + 1) . '</td>';
            echo '<td>' . htmlspecialchars($anggota['nik']) . '</td>';
            echo '<td>' . htmlspecialchars($anggota['nama']) . '</td>';
            echo '<td>' . htmlspecialchars($anggota['jenis_kelamin'] == 1 ? 'Laki-laki' : 'Perempuan') . '</td>';
            echo '<td>' . htmlspecialchars($anggota['tempat_lahir']) . '</td>';
            echo '<td>' . htmlspecialchars($anggota['tgl_lahir']) . '</td>';
            echo '<td>' . htmlspecialchars($anggota['hubungan_keluarga']) . '</td>';
            echo '<td>
                    <a href="?module=entri_detailpengajuan&hapus_anggota=' . $index . '" 
                       class="btn btn-danger btn-sm" 
                       onclick="return confirm(\'Apakah Anda yakin ingin menghapus anggota ini?\');">
                        Hapus
                    </a>
                  </td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="8" class="text-center">Belum ada anggota keluarga yang ditambahkan.</td></tr>';
    }
    ?>
</tbody>

                </table>
            </div>

            <div class="action-buttons">
                <a href="?module=form_entri_detailpengajuan" class="btn btn-success">Tambah Anggota</a>
                <form method="post" action="" style="display: inline;">
                    <button type="submit" class="btn btn-primary" name="simpan"><i class="fas fa-save"></i> Simpan Pengajuan</button>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
