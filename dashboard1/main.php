<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Aplikasi Pengelolaan Data Siswa Kursus">
    <meta name="author" content="Indra Styawantoro">

    <!-- Title -->
    <title>PUSKESOS</title>

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="assets/img/Lambang_Kabupaten_Kapuas.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css" integrity="sha256-RXPAyxHVyMLxb0TYCM2OW5R4GWkcDe02jdYgyZp41OU=" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .navbar-brand img {
            height: 30px;
            margin-right: 10px;
        }
        .navbar-nav .nav-link {
            color: #333;
            font-weight: 500;
            padding: 0.5rem 1rem;
        }
        .navbar-nav .nav-link.active {
            color: #007bff;
            border-bottom: 2px solid #007bff;
        }
        .container-fluid {
            min-height: 100%;
        }
        main {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }
        body, main {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body style="background-color: #EBF4F6;">
    <!-- Sidebar Menu -->
    <nav class="navbar navbar-expand-lg navbar-light" >
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="assets/img/Lambang_Kabupaten_Kapuas.png" alt="Logo">
                Dinas Sosial
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php include "sidebar_menu.php"; ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <main class="d-block">
        <div>
            <?php include "content.php"; ?>
        </div>
    </main>

    <!-- Mobile Menu -->
    <section class="mobile-menu d-block d-md-none">
        <div class="row bottom-navigation">
            <div class="col-12 col-lg-12">
                <div class="card-menu shadow-lg">
                    <div class="row justify-content-center">
                        <?php include "mobile_menu.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js" integrity="sha256-AkQap91tDcS4YyQaZY2VV34UhSCxu2bDEIgXXXuf5Hg=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/l10n/id.js" integrity="sha256-cvHCpHmt9EqKfsBeDHOujIlR5wZ8Wy3s90da1L3sGkc=" crossorigin="anonymous"></script>

    <!-- Custom Scripts -->
    <script src="assets/js/flatpickr.js"></script>
    <script src="assets/js/form-validation.js"></script>
</body>

</html>
