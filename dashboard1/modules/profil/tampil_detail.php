<?php
session_start();
include 'config/koneksi.php';

// Check if user is logged in
if (!isset($_SESSION['id_user'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

$id_user = $_SESSION['id_user'];

// Fetch user data fmohonngguna table
$query = "SELECT p.*, u.email, u.role 
          FROM pemohon p 
          JOIN user u ON p.id_user = u.id_user 
          WHERE p.id_user = ?";

$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

// Check if user data exists
if (!$user_data) {
    echo "User data not found.";
    exit;
}
?>

<div class="d-flex flex-column flex-lg-row mb-4">
    <div class="flex-grow-1 d-flex align-items-center">
        <i class="fa-regular fa-user icon-title"></i>
        <h3>Profil</h3>
    </div>
</div>

<div class="bg-white rounded-4 shadow-sm p-4 mb-4">
    <div class="alert alert-secondary rounded-4 mb-5" role="alert">
        <i class="fa-solid fa-list-ul me-2"></i> Detail Profil
    </div>
    <div class="d-flex flex-column flex-xl-row">
        <div class="flex-grow-1 text-muted fw-light ms-xl-5">
            <div class="table-responsive">
                <table class="table table-striped lh-lg">
                    <tr>
                        <td width="200">Nama</td>
                        <td width="10">:</td>
                        <td><?php echo htmlspecialchars($user_data['nama']); ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo htmlspecialchars($user_data['alamat']); ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td><?php echo htmlspecialchars($user_data['tgl_lahir']); ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><?php echo htmlspecialchars($user_data['jenis_kelamin']); ?></td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td>:</td>
                        <td><?php echo htmlspecialchars($user_data['telepon']); ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo htmlspecialchars($user_data['email']); ?></td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>
</div>