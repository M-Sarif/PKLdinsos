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
        <title>Login</title>
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
    <?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
		}
	}
	?>

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
                                    <h3>Masuk</h3>
                                </div>
                            </div>
                            <div class="modal-body d-grid gap-md-0 gap-5 align-items-center">
                                <div class="modal-common-content">
                                    <div class="box">

                                    <!-- dashboard1/main.php?module=dashboard -->
                                        <form action="cek_login.php" method="POST" class="login-form">
                                            <div class="form-grp" style="margin-bottom: 20px;">
                                                <input type="email" name="email" placeholder="Email Address" required style="height: 50px; width: 100%; color: black; border-radius: 5px; padding: 10px;">
                                            </div>
                                            <div class="form-grp" style="margin-bottom: 20px;">
                                                <input type="password" id="password" name="password" placeholder="Enter Password" required style="height: 50px; width: 100%; color: black; border-radius: 5px; padding: 10px;">
                                            </div>
                                            <div class="toggle-password" style="margin-bottom: 20px;">
                                                <input type="checkbox" id="show-password">
                                                <label for="show-password">Show Password</label>
                                            </div>
                                            <div class="d-flex forgot-inner-area cmn-mb justify-content-between gap-2 flex-wrap align-items-center" style="margin-bottom: 20px;">
                                                <div class="form-check checkmark-inner">
                                                    <a href="#" class="form-check-label" for="flexCheckChecked">
                                                        Forgot Your password?
                                                    </a>
                                                </div>
                                                <a href="#" class="forgot">
                                                    <!-- Content for the forgot password link if needed -->
                                                </a>
                                            </div>
                                            <button type="submit" class="theme-btn w-100">
                                                <span>
                                                    Log in
                                                </span>
                                            </button>
                                        </form>
                                        
                                        <script>
                                            document.getElementById('show-password').addEventListener('change', function() {
                                                const passwordField = document.getElementById('password');
                                                if (this.checked) {
                                                    passwordField.type = 'text';
                                                } else {
                                                    passwordField.type = 'password';
                                                }
                                            });
                                        </script>
                                        
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