<?php
include '../../config/koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assume user ID is stored in session after login
    $id_pemohon = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
    if (!$id_pemohon) {
        die("User not logged in");
    }

    $nomor_kk = mysqli_real_escape_string($mysqli, $_POST['nomor_kk']);
    $alamat = mysqli_real_escape_string($mysqli, $_POST['alamat']);
    $rt = mysqli_real_escape_string($mysqli, $_POST['rt']);
    $rw = mysqli_real_escape_string($mysqli, $_POST['rw']);
    $desa = mysqli_real_escape_string($mysqli, $_POST['desa']);
    $kecamatan = mysqli_real_escape_string($mysqli, $_POST['kecamatan']);

    // Function to handle file upload
    function uploadFile($file) {
        if ($file['error'] != 0) {
            return null;
        }

        $target_dir = "../../images/";
        $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $nama_file_enkripsi = sha1(md5(time() . $file["name"])) . '.' . $extension;
        $target_file = $target_dir . $nama_file_enkripsi;

        // Check file size
        if ($file["size"] > 1000000) { // 1MB limit
            echo "Sorry, your file is too large.";
            return null;
        }

        // Allow certain file formats
        if($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "pdf") {
            echo "Sorry, only JPG, JPEG, PNG & PDF files are allowed.";
            return null;
        }

        // If everything is ok, try to upload file
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $nama_file_enkripsi;
        } else {
            echo "Sorry, there was an error uploading your file.";
            return null;
        }
    }

    // Handle file uploads
    $sktm_filename = uploadFile($_FILES['sktm']);
    $dtks_filename = uploadFile($_FILES['dtks']);
    $kartu_keluarga_filename = uploadFile($_FILES['kartu_keluarga']);
    $ktp_filename = uploadFile($_FILES['ktp']);

    // Check if all files were uploaded successfully
    if ($sktm_filename === null || $dtks_filename === null || $kartu_keluarga_filename === null || $ktp_filename === null) {
        die("Error uploading one or more files.");
    }

    // Insert data into database
    $query = "INSERT INTO pengajuan (id_pemohon, nomor_kk, alamat, rt, rw, desa, kecamatan, sktm, dtks, kartu_keluarga, ktp)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "issssssssss", $id_pemohon, $nomor_kk, $alamat, $rt, $rw, $desa, $kecamatan, $sktm_filename, $dtks_filename, $kartu_keluarga_filename, $ktp_filename);

    if (mysqli_stmt_execute($stmt)) {
        echo "Data berhasil disimpan.";
        // Redirect to another page or show success message
        header("Location: ../../index.php?module=pengajuan&message=success");
        exit();
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }

    mysqli_stmt_close($stmt);
}
?>