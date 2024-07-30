<?php
session_start();
include 'helper/koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT u.*, p.nama, p.id_pemohon 
          FROM user u
          LEFT JOIN pemohon p ON u.id_user = p.id_user
          WHERE u.email=?";
$stmt = mysqli_prepare($mysqli, $query);
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) > 0){
    $data = mysqli_fetch_assoc($result);
    
    // Periksa password menggunakan password_verify
    if(password_verify($password, $data['password'])) {
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $data['role'];
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['id_pemohon'] = $data['id_pemohon'];
        $_SESSION['nama'] = $data['nama'];

        switch($data['role']) {
            case 'admin':
                header("location:admin/main.php?module=dashboard");
                break;
            case 'pemohon':
                header("location:dashboard1/main.php?module=dashboard");
                break;
            case 'pengurus':
                header("location:halaman_pengurus.php");
                break;
            default:
                header("location:index.php?pesan=role_tidak_valid");
                break;
        }
    } else {
        // Jika password salah, cek apakah password belum di-hash
        if($password === $data['password']) {
            // Jika password belum di-hash, hash dan update di database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $update_query = "UPDATE user SET password = ? WHERE id_user = ?";
            $update_stmt = mysqli_prepare($mysqli, $update_query);
            mysqli_stmt_bind_param($update_stmt, 'si', $hashed_password, $data['id_user']);
            mysqli_stmt_execute($update_stmt);
            mysqli_stmt_close($update_stmt);

            // Set session dan redirect
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $data['role'];
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['id_pemohon'] = $data['id_pemohon'];
            $_SESSION['nama'] = $data['nama'];

            switch($data['role']) {
                case 'admin':
                    header("location:index-2.php");
                    break;
                case 'pemohon':
                    header("location:dashboard1/main.php?module=dashboard");
                    break;
                case 'pengurus':
                    header("location:halaman_pengurus.php");
                    break;
                default:
                    header("location:index.php?pesan=role_tidak_valid");
                    break;
            }
        } else {
            header("location:index.php?pesan=password_salah");
        }
    }
} else {
    header("location:index.php?pesan=email_tidak_ditemukan");
}

mysqli_stmt_close($stmt);
mysqli_close($mysqli);
?>