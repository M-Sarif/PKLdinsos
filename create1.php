<?php
session_start();
include 'helper/koneksi.php';

function sanitize($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = sanitize($_POST['nama_lengkap']);
    $alamat = sanitize($_POST['alamat']);
    $tanggal_lahir = sanitize($_POST['tanggal_lahir']);
    $jenis_kelamin = isset($_POST['jenis_kelamin']) ? sanitize($_POST['jenis_kelamin']) : '';
    $nomor_telepon = sanitize($_POST['nomor_telepon']);

    // Validation
    if (empty($nama_lengkap) || empty($alamat) || empty($tanggal_lahir) || empty($jenis_kelamin) || empty($nomor_telepon)) {
        $error = "Semua field harus diisi.";
    } elseif (strtotime($tanggal_lahir) > time()) {
        $error = "Tanggal lahir tidak valid.";
    } elseif (!preg_match("/^[0-9]{10,13}$/", $nomor_telepon)) {
        $error = "Format nomor telepon tidak valid.";
    } else {
        $_SESSION['biodata'] = [
            'nama_lengkap' => $nama_lengkap,
            'alamat' => $alamat,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'nomor_telepon' => $nomor_telepon
        ];
        
        header("Location: create2.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <!--<< Header Area >>-->
    <head>
        <!-- ========== Meta Tags ========== -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="gramentheme">
        <meta name="description" content="Web hosting & WHMCS Html Template ">
        <!-- ======== Page title ============ -->
        <title>DAFTAR</title>
        <!--<< Favcion >>-->
        <link rel="shortcut icon" href="assets/img/logo/Lambang_Kabupaten_Kapuas.png">
        <!--<< Bootstrap min.css >>-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!--<< All Min Css >>-->
        <link rel="stylesheet" href="assets/css/all.min.css">
        <!--<< Animate.css >>-->
        <link rel="stylesheet" href="assets/css/animate.css">
        <!--<< Magnific Popup.css >>-->
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <!--<< MeanMenu.css >>-->
        <link rel="stylesheet" href="assets/css/meanmenu.css">
        <!--<< Swiper Bundle.css >>-->
        <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
        <!--<< Nice Select.css >>-->
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <!--<< Color.css >>-->
        <link rel="stylesheet" href="assets/css/color.css">
        <!--<< Main.css >>-->
        <link rel="stylesheet" href="assets/css/main.css">
    </head>
    <body>

        <!-- Preloader Start -->
        <div id="preloader" class="preloader">
            <div class="animation-preloader">
                <div class="spinner">                
                </div>
                <div class="txt-loading">
                    <span data-text-preloader="P" class="letters-loading">
                    P
                    </span>
                    <span data-text-preloader="U" class="letters-loading">
                        U
                    </span>
                    <span data-text-preloader="S" class="letters-loading">
                        S
                    </span>
                    <span data-text-preloader="K" class="letters-loading">
                        K
                    </span>
                    <span data-text-preloader="E" class="letters-loading">
                        E
                    </span>
                    <span data-text-preloader="S" class="letters-loading">
                        S
                    </span>
                    <span data-text-preloader="O" class="letters-loading">
                        O
                    </span>
                    <span data-text-preloader="S" class="letters-loading">
                        S
                    </span>
                </div>
                <p class="text-center">Loading</p>
            </div>
            <div class="loader">
                <div class="row">
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                </div>
            </div>
        </div>

        <!--<< Mouse Cursor Start >>-->  
        <div class="mouse-cursor cursor-outer"></div>
        <div class="mouse-cursor cursor-inner"></div>

       

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

        <!--<< Login >>-->
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
                                    <h3>Isi Data Diri</h3>
                                </div>
                            </div>
                            <div class="modal-body d-grid gap-md-0 gap-5 align-items-center">
                                <div class="modal-common-content">
                                    <div class="box">
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-form">
                                            <div class="form-grp" style="margin-bottom: 20px;">
                                                <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required style="height: 50px; width: 100%; color: black; border-radius: 5px; padding: 10px;">
                                            </div>
                                            <div class="form-grp" style="margin-bottom: 20px;">
                                                <input type="text" name="alamat" placeholder="Alamat" required style="height: 50px; width: 100%; color: black; border-radius: 5px; padding: 10px;">
                                            </div>
                                            <div class="form-grp" style="margin-bottom: 20px;">
                                                <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" required style="height: 50px; width: 100%; color: black; border-radius: 5px; padding: 10px;">
                                            </div>
                                            <div class="form-grp" style="margin-bottom: 20px;">
                                                <label><input type="radio" name="jenis_kelamin" value="Laki-laki" required> Laki-laki</label>
                                                <label><input type="radio" name="jenis_kelamin" value="Perempuan" required> Perempuan</label>
                                            </div>
                                            <div class="form-grp" style="margin-bottom: 20px;">
                                                <input type="text" name="nomor_telepon" placeholder="Nomor Telepon" required style="height: 50px; width: 100%; color: black; border-radius: 5px; padding: 10px;">
                                            </div>
                                            <button type="submit" class="theme-btn w-100">
                                                <span>Lanjut</span>
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
        
        

       
     

        <!--<< All JS Plugins >>-->
        <script src="assets/js/jquery-3.7.1.min.js"></script>
        <!--<< Viewport Js >>-->
        <script src="assets/js/viewport.jquery.js"></script>
        <!--<< Bootstrap Js >>-->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <!--<< Nice Select Js >>-->
        <script src="assets/js/jquery.nice-select.min.js"></script>
        <!--<< Waypoints Js >>-->
        <script src="assets/js/jquery.waypoints.js"></script>
        <!--<< Counterup Js >>-->
        <script src="assets/js/jquery.counterup.min.js"></script>
        <!--<< Swiper Slider Js >>-->
        <script src="assets/js/swiper-bundle.min.js"></script>
        <!--<< MeanMenu Js >>-->
        <script src="assets/js/jquery.meanmenu.min.js"></script>
        <!--<< Magnific Popup Js >>-->
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <!--<< Wow Animation Js >>-->
        <script src="assets/js/wow.min.js"></script>
        <!--<< Main.js >>-->
        <script src="assets/js/main.js"></script>
        <script>
            const passwordInput = document.getElementById('password');
            const showPasswordCheckbox = document.getElementById('show-password');
    
            showPasswordCheckbox.addEventListener('change', () => {
                if (showPasswordCheckbox.checked) {
                    passwordInput.setAttribute('type', 'text');
                } else {
                    passwordInput.setAttribute('type', 'password');
                }
            });
        </script>
    </body>
</html>