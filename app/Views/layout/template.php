<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="<?= csrf_meta() ?>">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>Trainers - Mentor Bootstrap Template</title>
<meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link href="<?= base_url(); ?>/assets/img/favicon.png" rel="icon">
<link href="<?= base_url(); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="<?= base_url(); ?>/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/vendor/aos/aos.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="<?= base_url(); ?>/assets/css/style.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/css/wa.css" rel="stylesheet">

<!-- =======================================================
* Template Name: Mentor - v4.7.0
* Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
======================================================== -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <!-- <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
<div class="container d-flex align-items-center">

    <h1 class="logo me-auto"><a href="<?= base_url(); ?>/index.html">Mentor</a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="<?= base_url(); ?>/index.html" class="logo me-auto"><img src="<?= base_url(); ?>/assets/img/logo.png" alt="" class="img-fluid"></a>-->

    <nav id="navbar" class="navbar order-last order-lg-0">
    <ul>
        <li><a href="<?= base_url(); ?>/">Home</a></li>
        <li><a class="active" href="<?= base_url(); ?>/mentor">Mentor</a></li>
        <li><a href="<?= base_url(); ?>/chat">Chat</a></li>
        <!-- <li><a href="<?= base_url(); ?>/events.html">Events</a></li>
        <li><a href="<?= base_url(); ?>/pricing.html">Pricing</a></li> 
-->
<?php 
    $tes = session()->get('role');
    if($tes == 'pendamping'){
?>
        <li class="dropdown"><a href="<?= base_url(); ?>/#"><span>Logbook</span> <i class="bi bi-chevron-down"></i></a>
        <ul>
            <li><a href="<?= base_url(); ?>/mylogbook">Logbook Saya</a></li>
            <li><a href="<?= base_url(); ?>/logbook">Logbook Siswa</a></li>
        </ul>
        </li>

        <li class="dropdown"><a href="<?= base_url(); ?>/#"><span>Request</span> <i class="bi bi-chevron-down"></i></a>
        <ul>
            <li><a href="<?= base_url(); ?>/mentor/request">Request Mentoring</a></li>
            <li><a href="<?= base_url(); ?>/mentor/requested">Request Jadi Mentor</a></li>
        </ul>
        </li>
<?php }else{ ?>
        <li><a href="<?= base_url(); ?>/mentor/request">Request</a></li>
        <li><a href="<?= base_url(); ?>/mylogbook">Logbook</a></li>
<?php }
?>
    </ul>
    <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

    <a href="<?= base_url(); ?>/logout" class="get-started-btn"><?= session()->get('username')?></a>

</div>
</header><!-- End Header -->
<?= $this->renderSection('home')?>
<?= $this->renderSection('trainer')?>
<?= $this->renderSection('chat')?>
<?= $this->renderSection('content') ?>
<!-- ======= Footer ======= -->
<br/>
<footer id="footer">

<!-- <div class="footer-top">
    <div class="container">
    <div class="row">

        <div class="col-lg-3 col-md-6 footer-contact">
        <h3>Mentor</h3>
        <p>
            A108 Adam Street <br>
            New York, NY 535022<br>
            United States <br><br>
            <strong>Phone:</strong> +1 5589 55488 55<br>
            <strong>Email:</strong> info@example.com<br>
        </p>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
        <h4>Useful Links</h4>
        <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url(); ?>/#">Home</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url(); ?>/#">About us</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url(); ?>/#">Services</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url(); ?>/#">Terms of service</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url(); ?>/#">Privacy policy</a></li>
        </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
        <h4>Our Services</h4>
        <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url(); ?>/#">Web Design</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url(); ?>/#">Web Development</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url(); ?>/#">Product Management</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url(); ?>/#">Marketing</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url(); ?>/#">Graphic Design</a></li>
        </ul>
        </div>

        <div class="col-lg-4 col-md-6 footer-newsletter">
        <h4>Join Our Newsletter</h4>
        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
        <form action="" method="post">
            <input type="email" name="email"><input type="submit" value="Subscribe">
        </form>
        </div>

    </div>
    </div>
</div> -->

<div class="container d-md-flex py-4">

    <div class="me-md-auto text-center text-md-start">
    <div class="copyright">
        &copy; Copyright <strong><span>Mentor</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/ -->
        Designed by <a href="<?= base_url(); ?>/https://bootstrapmade.com/">BootstrapMade</a>
    </div>
    </div>
    <div class="social-links text-center text-md-right pt-3 pt-md-0">
    <a href="<?= base_url(); ?>/#" class="twitter"><i class="bx bxl-twitter"></i></a>
    <a href="<?= base_url(); ?>/#" class="facebook"><i class="bx bxl-facebook"></i></a>
    <a href="<?= base_url(); ?>/#" class="instagram"><i class="bx bxl-instagram"></i></a>
    <a href="<?= base_url(); ?>/#" class="google-plus"><i class="bx bxl-skype"></i></a>
    <a href="<?= base_url(); ?>/#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
    </div>
</div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="<?= base_url(); ?>/#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= base_url(); ?>/assets/vendor/purecounter/purecounter.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/aos/aos.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="<?= base_url(); ?>/assets/js/main.js"></script>

</body>

</html>