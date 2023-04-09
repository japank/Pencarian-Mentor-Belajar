<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="<?= base_url(); ?>/index.html">Mentor</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="<?= base_url(); ?>/index.html" class="logo me-auto"><img src="<?= base_url(); ?>/assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="active" href="<?= base_url(); ?>/">Dashboard</a></li>
                <li><a href="<?= base_url(); ?>/mentorchecked">Mentor</a></li>
                <li><a href="<?= base_url(); ?>/chat">Chat</a></li>

<<<<<<< HEAD
                <li><a class="" href="<?= base_url(); ?>/request-history">Pengajuan</a></li>
                <li><a class="" href="<?= base_url(); ?>/request-accepted">Mentoring</a></li>
=======
                <li><a class="" href="<?= base_url(); ?>/mentor/request">Riwayat Permintaan</a></li>
                <li><a class="" href="<?= base_url(); ?>/mylogbook">Logbook</a></li>
>>>>>>> b60230be6a74b6e83a6ed782e122e1adfb91890e

                <li class="dropdown"><a href="<?= base_url(); ?>/profile"><span><?= session()->get('username') ?></span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="<?= base_url(); ?>/profile">Profile</a></li>
                        <li><a href="<?= base_url(); ?>/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>

            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->


    </div>
</header><!-- End Header -->
<br><br>
<?php
foreach ($dataUsers as $dt)

    if (is_null($dt->name) || is_null($dt->email)) {
        $id = '<span class="badge bg-danger"> <i class="fa fa-times"></i></span>';
    } else {
        $id = '<span class="badge bg-success"> <i class="fa fa-check"></i></span>';
    }

if (is_null($dt->profile_picture)) {
    $pp = '<span class="badge bg-danger"> <i class="fa fa-times"></i></span>';
} else {
    $pp = '<span class="badge bg-success"> <i class="fa fa-check"></i></span>';
}

if (is_null($dt->address)) {
    $address = '<span class="badge bg-danger"> <i class="fa fa-times"></i></span>';
} else {
    $address = '<span class="badge bg-success"> <i class="fa fa-check"></i></span>';
}

if (is_null($dt->name) || is_null($dt->email) || is_null($dt->profile_picture) || is_null($dt->address)) {
    $search_mentor = '<span class="badge bg-danger"> <i class="fa fa-times"></i></span>';
} else {
    $search_mentor = '<span class="badge bg-success"> <i class="fa fa-check"></i></span>';
}


?>

<!-- Custom fonts for this template-->
<link href="<?= base_url(); ?>/assets/dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="<?= base_url(); ?>/assets/dashboard/css/sb-admin-2.min.css" rel="stylesheet">

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h3 class="mb-0 fw-bold">Dashboard</h3>

            </div>

            <!-- Content Row -->
            <div class="row">

                <div class="col-xl-4 col-md-4 mb-4">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-hands-helping fa-2x text-gray-300"></i>
                                </div>
                                <div class="col mr-2" style="margin-left: 5%;">
                                    <strong>Permintaan Mentoring</strong>
                                </div>
                                <div class="col-auto">
                                    <h3><?php foreach ($total_request as $row) ?>
                                        <strong> <?= $row ?></strong>
                                    </h3>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 mb-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                                </div>
                                <div class="col mr-2" style="margin-left: 5%;">
                                    <strong>Total Mentor</strong>
                                </div>
                                <div class="col-auto">
                                    <h3><?php foreach ($total_mentor as $row) ?>
                                        <strong> <?= $row ?></strong>
                                    </h3>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 mb-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                                </div>
                                <div class="col mr-2" style="margin-left: 5%;">
                                    <strong>Bimbingan Terselesaikan</strong>
                                </div>
                                <div class="col-auto">
                                    <h3><?php foreach ($total_bimbingan as $row) ?>
                                        <strong> <?= $row ?></strong>
                                    </h3>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->

            <div class="row">

                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-dark">Selesaikan Syarat berikut</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class=" pb-3 d-flex align-items-center">
                                <span class="btn btn-primary btn-circle d-flex align-items-center">
                                    <i class="fas fa-address-card"></i>
                                </span>
                                <div class="ms-3">
                                    <h5 class="mb-0 fw-bold">Lengkapi Data Diri</h5>
                                    <span class="text-muted fs-6">Lengkapi data diri anda</span>
                                </div>
                                <div class="ms-auto">
                                    <?= $id ?>
                                </div>
                            </div>
                            <div class="py-3 d-flex align-items-center">
                                <span class="btn btn-success btn-circle d-flex align-items-center">
                                    <i class="fas fa-portrait"></i>
                                </span>
                                <div class="ms-3">
                                    <h5 class="mb-0 fw-bold">Unggah Foto Profil</h5>
                                    <span class="text-muted fs-6">Unggah foto profil anda</span>
                                </div>
                                <div class="ms-auto">
                                    <?= $pp ?>
                                </div>
                            </div>
                            <div class="py-3 d-flex align-items-center">
                                <span class="btn btn-info btn-circle d-flex align-items-center">
                                    <i class="fas fa-home"></i>
                                </span>
                                <div class="ms-3">
                                    <h5 class="mb-0 fw-bold">Atur Alamat</h5>
                                    <span class="text-muted fs-6">Atur alamat rumah kamu</span>
                                </div>
                                <div class="ms-auto">
                                    <?= $address ?>
                                </div>
                            </div>

                            <div class="pt-3 d-flex align-items-center">
                                <span class="btn btn-danger btn-circle d-flex align-items-center">
                                    <i class="fas fa-search"></i>
                                </span>
                                <div class="ms-3">
                                    <h5 class="mb-0 fw-bold">Cari Mentor</h5>
                                    <span class="text-muted fs-6">Cari mentor yang kamu inginkan </span>
                                </div>
                                <div class="ms-auto">
                                    <?= $search_mentor ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pengumuman</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;height:10rem" src="<?= base_url(); ?>/assets/dashboard/img/undraw_posting_photo.svg" alt="...">
                            </div>
                            <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a
                                constantly updated collection of beautiful svg images that you can use
                                completely free and without attribution!</p>
                            <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                unDraw &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
    <!-- End of Main Content -->


    <?= $this->endSection() ?>