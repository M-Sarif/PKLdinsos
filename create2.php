<?php
session_start();
include 'helper/koneksi.php';

if (!isset($_SESSION['biodata'])) {
    header("Location: create1.php");
    exit();
}

function sanitize($input) {
    global $mysqli;
    return mysqli_real_escape_string($mysqli, htmlspecialchars(trim($input)));
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $agree = isset($_POST['agree']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email tidak valid.";
    } elseif ($password !== $confirm_password) {
        $error = "Password tidak cocok.";
    } elseif (strlen($password) < 8) {
        $error = "Password harus minimal 8 karakter.";
    } elseif (!$agree) {
        $error = "Anda harus menyetujui persyaratan yang berlaku.";
    } else {
        mysqli_autocommit($mysqli, FALSE);

        try {
            // Insert into user table first
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = "pemohon";
            $email = sanitize($email);
        
            $query = "INSERT INTO user (email, password, role) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($mysqli, $query);
            mysqli_stmt_bind_param($stmt, "sss", $email, $hashed_password, $role);
            $result = mysqli_stmt_execute($stmt);
            
            if (!$result) {
                throw new Exception("Error inserting into user: " . mysqli_error($mysqli));
            }
            
            $id_user = mysqli_insert_id($mysqli);
        
            // Then insert into pemohon table
            $nama = sanitize($_SESSION['biodata']['nama_lengkap']);
            $alamat = sanitize($_SESSION['biodata']['alamat']);
            $tgl_lahir = sanitize($_SESSION['biodata']['tanggal_lahir']);
            $jenis_kelamin = sanitize($_SESSION['biodata']['jenis_kelamin']);
            $telepon = sanitize($_SESSION['biodata']['nomor_telepon']);
        
            $query = "INSERT INTO pemohon (nama, alamat, tgl_lahir, jenis_kelamin, telepon, id_user) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($mysqli, $query);
            mysqli_stmt_bind_param($stmt, "sssssi", $nama, $alamat, $tgl_lahir, $jenis_kelamin, $telepon, $id_user);
            $result = mysqli_stmt_execute($stmt);
            
            if (!$result) {
                throw new Exception("Error inserting into pemohon: " . mysqli_error($mysqli));
            }
        
            mysqli_commit($mysqli);
            
            unset($_SESSION['biodata']);
            header("Location: index.php");
            exit();
        } catch (Exception $e) {
            mysqli_rollback($mysqli);
            $error = "Terjadi kesalahan saat mendaftar: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar</title>
    <link rel="shortcut icon" href="assets/img/logo/Lambang_Kabupaten_Kapuas.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/meanmenu.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/color.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <!-- Header -->
    <header class="header-section-1">
        <div id="header-sticky" class="header-1">
            <div class="container">
                <div class="mega-menu-wrapper">
                    <div class="header-main">
                        <div class="header-left">
                            <div class="logo">
                                <a href="index.html" class="header-logo">
                                    <img src="assets/img/logo/dinsos-putih.png" alt="logo-img" style="height: 50px;">
                                </a>
                                <a href="index.html" class="header-logo-2">
                                    <img src="assets/img/logo/dinsos-hitam.png" alt="logo-img" style="height: 50px;">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Registration Form -->
    <div class="breadcrumb-wrapper bg-cover" style="background-image: url('assets/img/breadcrumb-1.jpg');">
        <div class="container" style="align-items: center; margin-top: -8%;">
            <div class="page-heading">
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay=".3s">
                    <div class="pricing-card-items responsive-pricing-style" style="background-color: white; padding: 20px; border-radius: 10px;">
                        <div class="wing-shape">
                            <img src="assets/img/wing-shape.png" alt="img">
                        </div>
                        <div class="pricing-header">
                            <div class="price-content">
                                <h3>Isi username</h3>
                            </div>
                        </div>
                        <div class="modal-body d-grid gap-md-0 gap-5 align-items-center">
                            <div class="modal-common-content">
                                <div class="box">
                                    <?php if (!empty($error)): ?>
                                        <div class="alert alert-danger"><?php echo $error; ?></div>
                                    <?php endif; ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-form">
                                        <div class="form-grp" style="margin-bottom: 20px;">
                                            <input type="email" name="email" placeholder="Email" required style="height: 50px; width: 100%; color: black; border-radius: 5px; padding: 10px;">
                                        </div>
                                        <div class="form-grp" style="margin-bottom: 20px;">
                                            <input type="password" id="password" name="password" placeholder="Password" required style="height: 50px; width: 100%; color: black; border-radius: 5px; padding: 10px;">
                                        </div>
                                        <div class="form-grp" style="margin-bottom: 20px;">
                                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Konfirmasi Password" required style="height: 50px; width: 100%; color: black; border-radius: 5px; padding: 10px;">
                                        </div>
                                        <div class="toggle-password" style="margin-bottom: 20px;">
                                            <input type="checkbox" id="show-password" onclick="togglePasswordVisibility()">
                                            <label for="show-password">Tampilkan Password</label>
                                        </div>
                                        <div class="toggle-password" style="margin-bottom: 20px;">
                                            <input type="checkbox" id="agree" name="agree" required>
                                            <label for="agree">Saya setuju dengan persyaratan yang berlaku</label>
                                        </div>
                                        <button type="submit" class="theme-btn w-100">
                                            <span>Daftar</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const agreeCheckbox = document.getElementById('agree');
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (!agreeCheckbox.checked) {
                alert('Anda harus menyetujui persyaratan yang berlaku.');
                e.preventDefault();
                return;
            }

            if (password !== confirmPassword) {
                alert('Password dan konfirmasi password tidak sama.');
                e.preventDefault();
                return;
            }
        });

        function togglePasswordVisibility() {
            const passwordFields = document.querySelectorAll('input[type="password"]');
            passwordFields.forEach(field => {
                field.type = field.type === 'password' ? 'text' : 'password';
            });
        }
    </script>
</body>
</html>