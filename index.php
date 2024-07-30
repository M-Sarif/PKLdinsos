<?php
require_once("helper/koneksi.php");

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
        <title>PUSKESOS</title>
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


        <!-- Header atas -->
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
       
        <!-- Hero Section Start -->
        <section class="hero-section hero-1 bg-cover fix" style="background-image: url('assets/img/hero/hero-bg-1.jpg'); ">
           
            <div class="container" style="margin-top: -10%;">
                <div class="row g-4 justify-content-between">
                    <div class="col-lg-6">
                        <div class="hero-content">
                            <span class="sub-text wow fadeInUp">
                           
                            Pusat Kesejahteraan Sosial
                            </span>
                            <h1 class="wow fadeInUp" data-wow-delay=".3s">
                                Layanan Pengajuan  BPJS Gratis
                            </h1>
                            <h6 class="wow fadeInUp" data-wow-delay=".5s">layanan untuk pengajuan BPJS Gratis yang didanai <br> Oleh Pemerintah Daerah Kapuas</h6>
                            <div class="hero-author">
                                <a href="login.php" class="theme-btn bg-color-2 wow fadeInUp" data-wow-delay=".7s">
                                Masuk <i class="fas "></i>
                                </a>
                                <div class="author-content wow fadeInUp" data-wow-delay=".9s;">
                                    
                                    <div class="content">
                                        <a href="create1.php" class="theme-btn bg-color-2 wow fadeInUp" data-wow-delay=".7s">
                                            Daftar <i class="fas"></i>
                                        </a>
                                        
                                      
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay=".4s">
                        <div class="hero-image">
                            <img src="assets/img/hero/bpjs.png" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </section>
      
       
        <!-- Pengertian PBI -->
        <section class="pricing-section fix section-padding section-bg">
            <div class="container">
                <div class="section-title text-center">

                    <h2 class="wow fadeInUp" data-wow-delay=".3s">Apa itu PBI APBD </h2>
                </div>
                <div class="pricing-tab-header">
                    <p class="wow fadeInUp" data-wow-delay=".3s" style="text-align: justify;">Program Bantuan Iuran (PBI) merupakan program dari Dinas Sosial yang bertujuan memberikan bantuan iuran kesehatan bagi masyarakat fakir miskin dan orang tidak mampu agar dapat menjadi peserta jaminan program kesehatan. Fakir miskin adalah orang yang sama sekali tidak memiliki sumber mata pencaharian, atau memiliki sumber mata pencaharian tetapi tidak mampu memenuhi kebutuhan dasar yang layak bagi kehidupan dirinya dan/atau keluarganya. Sementara itu, orang tidak mampu adalah orang yang memiliki sumber mata pencaharian, gaji, atau upah, namun hanya mampu memenuhi kebutuhan dasar yang layak dan tidak mampu membayar iuran bagi dirinya dan keluarganya </p>
                </div>
                
            </div>
        </section>
        <!-- Pengusulan gratis -->
        <section class="cta-contct-section section-padding bg-cover fix" style="background-image: url('assets/img/cta/cta-conact-bg.jpg');">
            <div class="container">
                <div class="row g-4 justify-content-between align-items-center">
                    <div class="col-xl-8 col-lg-7">
                        <div class="cta-contact-left">
                            <div class="section-title">
                                
                                <h2 class="text-white wow fadeInUp" data-wow-delay=".3s">Pengusulan Gratis <br> tanpa ada pungutan biaya
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
        <!-- dokumen-->

        <section class="hosting section-padding fix" style="margin-top: 0%;">
            <div class="container">
                <div class="hosting-wrapper">
                    <div>
                        <h2 class="wow fadeInUp" data-wow-delay=".3s" style="margin-bottom: 5%; text-align: center;"> Dokumen yang Diperlukan</h1>
                    </div>

                    <!-- SKTM -->

                    <div class="row g-4 justify-content-between align-items-center">
                        <div class="col-lg-6">
                            <div class="hosting-content">
                                <div class="section-title" style="margin-bottom: 10%;">
                                    <h3 class="wow fadeInUp" data-wow-delay=".3s"> 1. Surat Keterangan Tidak Mampu (SKTM)</h3>
                                </div>
                                <div class="hosting-items wow fadeInUp mt-4 mt-md-0" data-wow-delay=".5s">
                                    
                                    <div class="content">
                                        <ul>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                        <h4>SKTM yang ditanda tangani oleh RT, Kepala Desa/kelurahan dan diketahui oleh Camat</h4>
                                       </div>
                                </div>
                                <div class="hosting-items wow fadeInUp" data-wow-delay=".7s">
                                    <div class="content">
                                        <h4>SKTM bisa didapatkan di kantor desa atau keluharan</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 wow fadeInUp" data-wow-delay=".4s" style="border: 5px;">
                            <div class="hosting-image">
                                <img src="assets/img/berkas/SKTM.png" alt="img" style="width:80%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DTKS -->
      
        <section class="hosting section-padding fix" style="margin-top: -10%;">
            <div class="container">
                <div class="hosting-wrapper">
                    
                    <div class="row g-4 justify-content-between align-items-center">
                        <div class="col-lg-6">
                            <div class="hosting-content">
                                <div class="section-title" style="margin-bottom: 10%;">
                                    <h3 class="wow fadeInUp" data-wow-delay=".3s"> 2. Surat Data Terpadu Kesejahteraan Sosial (DTKS)</h3>
                                </div>
                                <div class="hosting-items wow fadeInUp mt-4 mt-md-0" data-wow-delay=".5s">
                                    <div class="content">
                                        <ul>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                        <h4> Surat DTKS harus ditanda tangani oleh Operator DTKS, RT dan diketahui oleh kepala Desa/kelurahan</h4>
                                       </div>
                                </div>
                                <div class="hosting-items wow fadeInUp" data-wow-delay=".7s">
                                    <div class="content">
                                        <h4>Surat DTKS bisa didapatkan di kantor desa atau keluharan</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 wow fadeInUp" data-wow-delay=".4s" style="border: 5px;">
                            <div class="hosting-image">
                                <img src="assets/img/berkas/DTKS.png" alt="img" style="width:80%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- KTP -->

        <section class="hosting section-padding fix" style="margin-top: -10%;">
            <div class="container">
                <div class="hosting-wrapper">
                    
                    <div class="row g-4 justify-content-between align-items-center">
                        <div class="col-lg-6">
                            <div class="hosting-content">
                                <div class="section-title" style="margin-bottom: 10%;">
                                    <h3 class="wow fadeInUp" data-wow-delay=".3s"> 3. Kartu Tanda Penduduk (KTP)</h3>
                                </div>
                                <div class="hosting-items wow fadeInUp mt-4 mt-md-0" data-wow-delay=".5s">
                                    <div class="content">
                                        <h4>Siapkan KTP yang akan diusulkan</h4>
                                       </div>
                                </div>
                                <div class="hosting-items wow fadeInUp" data-wow-delay=".7s">
                                    <div class="content">
                                        <h4>Jika yang diusulkan masih dibawah umur sehingga tidak memiliki KTP maka siapkan KTP Orang Tua pengusul</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 wow fadeInUp" data-wow-delay=".4s" style="border: 5px;">
                            <div class="hosting-image">
                                <img src="assets/img/berkas/KTP.png" alt="img" style="width:80%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kartu Keluarga -->

        <section class="hosting section-padding fix" style="margin-top: -10%;">
            <div class="container">
                <div class="hosting-wrapper">
                    
                    <div class="row g-4 justify-content-between align-items-center">
                        <div class="col-lg-6">
                            <div class="hosting-content">
                                <div class="section-title" style="margin-bottom: 10%;">
                                    <h3 class="wow fadeInUp" data-wow-delay=".3s"> 4. Kartu Keluarga (KK)</h3>
                                </div>
                                <div class="hosting-items wow fadeInUp mt-4 mt-md-0" data-wow-delay=".5s">
                                    <div class="content">
                                        <h4>Siapkan Kartu Keluarga yang akan diusulkan</h4>
                                       </div>
                                </div>
                                <div class="hosting-items wow fadeInUp" data-wow-delay=".7s">
                                    <div class="content">
                                        <h4>pastikan tulisan terlihat dengan jelas</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 wow fadeInUp" data-wow-delay=".4s" style="border: 5px;">
                            <div class="hosting-image">
                                <img src="assets/img/berkas/kk.png" alt="img" style="width:80%; background-color: rgb(186, 186, 186);">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Ketentuan -->
        <section class="testimonial-section fix section-padding bg-cover" style="background-image: url('assets/img/section-bg.jpg');">
            <div class="container">
                <div class="section-title-area">
                    <div class="section-title">
                        <h2 class="text-white wow fadeInUp" data-wow-delay=".3s">Ketentuan Pengusulan</h2>
                    </div>
                </div>
            <div>
                <ol class="text-white wow fadeInUp" data-wow-delay=".5s" style="color: white;">

                <li>
                    <p>bagi yang sudah mempuyai BPJS Mandiri tidak boleh ada tunggakan dan jika ada tunggakan harus dilunaskan terlebih dahulu</p>
                </li>

                <li>
                    <p>Apabila memiliki BPJS Mandiri atau berbayar dan masih aktif (tidak ada tunggakan) bisa langsung melakukan pengusulan</p>
                </li>

                <li >
                    <p>apabila sebelumnya mendapatkan BPJS gratis tetapi dinyatakan tidak aktif, pengusul bisa langsung melakukan pengusulan</p>
                </li>

                <li>
                    <p>jika sebelumnya tidak memiliki BPJS baik BPJS mandiri ataupun tidak ada BPJS sama sekali bisa langsung melakukan pengusulan</p>
                </li>

                <li>
                    <p>tidak disarankan status pekerjaan di dalam kartu keluarga yaitu Wirausaha, wiraswasta, pegawai honorer, aparatur negara, dan lain sebagainya yang memiliki gajih tetap diatas Upah Minimum Regional (UMR) atau Menerima Gajih dari Negara</p>
                </li>
                </ol>
            </div>
        
        </section>
        
       <!-- Logo Pemda -->
                <div class="brand-section pt-100 pb-0 fadeInUp" data-wow-delay=".5s">
                    <div class="container">
                        <div class="swiper brand-slider bor-bottom pb-100 pt-0">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="brand-img center">
                                        <img src="assets/img/brand/PNG/DINSOS.png" alt="img" style="width: 150%; margin-top: -15%;">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    
                                </div>
                                <div class="swiper-slide">
                                    <div class="brand-img center">
                                        <img src="assets/img/brand/PNG/PEMDA.png" alt="img" style="width: 150%; margin-top: -15%;">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    
                                </div>
                               
                                <div class="swiper-slide">
                                    <div class="brand-img center">
                                        <img src="assets/img/brand/PNG/PUSKESOS.png" alt="img" style="width: 180%; margin-top: -10%;">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    
                                </div>
                                <div class="swiper-slide">
                                    <div class="brand-img center">
                                        <img src="assets/img/brand/PNG/DINKES.png" alt="img" style="width: 150%; margin-top: -15%;">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    
                                </div>
                                
                                <div class="swiper-slide">
                                    <div class="brand-img center">
                                        <img src="assets/img/brand/BPJS_Kesehatan_logo.svg" alt="img" style="margin-top: 5%;">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
  
        <footer class="footer-section fix bg-cover" style="background-image: url('assets/img/section-bg.jpg');">
            <div class="footer-widgets-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
                            <div class="single-footer-widget">
                                <div class="widget-head">
                                    <a href="index.html">
                                    <img src="assets/img/logo/dinsos-putih.png" alt="logo-img" style="width: 100%;">
                                    </a>
                                </div>
                                <div class="footer-content">
                                    <p>
                                        Jl. Patih Rumbih Nomor 21, Kuala Kapuas, Kalimantan Tengah, kode Pos 73500 
                                    </p>
                                    <ul class="contact-info">
                                       
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.0812 13.1941C18.0812 14.883 16.7074 16.2547 15.0206 16.2547H4.97935C3.2926 16.2547 1.91873 14.883 1.91873 13.1941V6.805C1.91835 6.26068 2.06418 5.72624 2.34096 5.25754L7.24049 10.1571C7.9735 10.8922 8.9551 11.2973 10.001 11.2973C11.0448 11.2973 12.0264 10.8922 12.7594 10.1571L17.659 5.25754C17.9358 5.72623 18.0816 6.26067 18.0812 6.805V13.1941H18.0812ZM15.0206 3.74441H4.97935C4.28279 3.74441 3.63978 3.98016 3.12541 4.37238L8.07424 9.32336C8.5865 9.83344 9.27017 10.1164 10.001 10.1164C10.7297 10.1164 11.4135 9.83344 11.9257 9.32336L16.8745 4.37238C16.3602 3.98016 15.7172 3.74441 15.0206 3.74441ZM15.0206 2.56348H4.97935C2.64103 2.56348 0.737793 4.46672 0.737793 6.80504V13.1942C0.737793 15.5346 2.64103 17.4357 4.97935 17.4357H15.0206C17.3589 17.4357 19.2622 15.5346 19.2622 13.1942V6.805C19.2622 4.46668 17.3589 2.56348 15.0206 2.56348Z" fill="white"/>
                                            </svg>
                                            <a href="mailto:dissos@kapuaskab.go.id">dissos@kapuaskab.go.id</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="footer-wrapper d-flex align-items-center justify-content-between">
                        <p class="wow fadeInLeft" data-wow-delay=".3s">
                            © Dinas Sosial 2024 by <a href="index.html">Universitas Muhammadiyah Banjarmasin</a>
                        </p>
                    </div>
                </div>
                <a href="#" id="scrollUp" class="scroll-icon">
                <i class="far fa-arrow-up"></i>
                </a>
            </div>
        </footer>
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
    </body>
</html>