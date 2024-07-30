<?php

session_start();

// Perbaiki path ke file koneksi
require_once '../../config/koneksi.php';

// Periksa apakah user sudah login sebagai admin
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}

// Periksa koneksi
if (!$mysqli) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Query dasar
$query = "SELECT p.*, v.statuss, d.*
          FROM pengajuan p
          INNER JOIN verifikasi v ON p.id_pengajuan = v.id_pengajuan
          INNER JOIN detail_pengajuan d ON p.id_pengajuan = d.id_pengajuan
          WHERE v.statuss = 1";

// Jika ada filter tanggal, tambahkan ke query
if (isset($_GET['tanggal_awal']) && isset($_GET['tanggal_akhir'])) {
    $tanggal_awal = mysqli_real_escape_string($mysqli, $_GET['tanggal_awal']);
    $tanggal_akhir = mysqli_real_escape_string($mysqli, $_GET['tanggal_akhir']);
    $query .= " AND p.tgl_pengajuan BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
}

$result = mysqli_query($mysqli, $query);

if (!$result) {
    die("Query error: " . mysqli_error($mysqli));
}

?>

<html>
<head>
  <title>Data Anggota Terverifikasi</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
    <h2>Data Anggota Terverifikasi</h2>
    <h4>(Laporan)</h4>
    <div class="data-tables datatable-dark">
        <table class="table table-striped table-bordered" id="cetak">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NO KK</th>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>HUBUNGAN KELUARGA</th>
                    <th>Tempat Lahir</th>
                    <th>Tgl Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>RT</th>
                    <th>RW</th>
                    <th>Kecamatan</th>
                    <th>Desa/kelurahan</th>
                </tr>
            </thead>
            <tbody>
    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>'" . htmlspecialchars($row['nomor_kk']) . "</td>";
        echo "<td>'" . htmlspecialchars($row['nik']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
        echo "<td>" . htmlspecialchars($row['hubungan_keluarga']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tempat_lahir']) . "</td>";
        echo "<td>" . date('d/m/Y', strtotime($row['tgl_lahir'])) . "</td>";
        echo "<td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>";
        echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
        echo "<td>" . htmlspecialchars($row['rt']) . "</td>";
        echo "<td>" . htmlspecialchars($row['rw']) . "</td>";
        echo "<td>" . htmlspecialchars($row['kecamatan']) . "</td>";
        echo "<td>" . htmlspecialchars($row['desa']) . "</td>";
        echo "</tr>";
    }
    ?>
</tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#cetak').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'pdf', 'print'
        ]
    } );
} );
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

</body>
</html>