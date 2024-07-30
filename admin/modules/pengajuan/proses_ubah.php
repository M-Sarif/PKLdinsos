<?php
require_once "../../config/koneksi.php";

if (isset($_POST['simpan'])) {
    $id_pengajuan = $mysqli->real_escape_string($_POST['id_pengajuan']);
    $nomor_kk = $mysqli->real_escape_string($_POST['nomor_kk']);
    $alamat = $mysqli->real_escape_string($_POST['alamat']);
    $rt = $mysqli->real_escape_string($_POST['rt']);
    $rw = $mysqli->real_escape_string($_POST['rw']);
    $desa = $mysqli->real_escape_string($_POST['desa']);
    $kecamatan = $mysqli->real_escape_string($_POST['kecamatan']);

    $query = "UPDATE pengajuan SET 
              nomor_kk = '$nomor_kk',
              alamat = '$alamat',
              rt = '$rt',
              rw = '$rw',
              desa = '$desa',
              kecamatan = '$kecamatan'
              WHERE id_pengajuan = '$id_pengajuan'";

    // Handle file uploads (SKTM, DTKS, Kartu Keluarga, KTP)
    $file_fields = ['sktm', 'dtks', 'kartu_keluarga', 'ktp'];
    foreach ($file_fields as $field) {
        if (!empty($_FILES[$field]['name'])) {
            $file_name = $_FILES[$field]['name'];
            $file_tmp = $_FILES[$field]['tmp_name'];
            $file_destination = "../../uploads/" . $file_name; // Adjust the path as needed

            if (move_uploaded_file($file_tmp, $file_destination)) {
                $query .= ", $field = '$file_name'";
            }
        }
    }

    if ($mysqli->query($query)) {
        header("Location: ../../index.php?module=pengajuan&pesan=updated");
    } else {
        echo "Error updating record: " . $mysqli->error;
    }
}
?>