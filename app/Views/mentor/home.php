<?= $this->extend('layout/templateMentor') ?>
<?= $this->section('content') ?>


<?php
foreach ($dataMentor as $dt)
    $pp = "";
$id = "";
$ujian = "";
$verif = "";
$ppsampul = "";
$address = "";

if (is_null($dt->profile_picture) && is_null($dt->identity_file)) {
    $id = '<span class="badge bg-danger"> <i class="fa fa-times"></i></span>';
} elseif (is_null($dt->identity_file)) {
    $id = '<span class="badge bg-danger"> <i class="fa fa-times"></i></span>';
} elseif (is_null($dt->profile_picture)) {
    $id = '<span class="badge bg-danger"> <i class="fa fa-times"></i></span>';
} else {
    $id = '<span class="badge bg-success"> <i class="fa fa-check"></i></span>';
}



if (is_null($dt->profile_picture)) {
    $ppsampul = "default.jpg";
} else {
    $ppsampul = $dt->profile_picture;
}

if (is_null($dt->address)) {
    $address = '<span class="badge bg-danger"> <i class="fa fa-times"></i></span>';
} else {
    $address = '<span class="badge bg-success"> <i class="fa fa-check"></i></span>';
}

if ($dt->level_mentor = 0) {
    $ujian = '<span class="badge bg-danger"> <i class="fa fa-times"></i></span>';
} else {
    $ujian = '<span class="badge bg-success"> <i class="fa fa-check"></i></span>';
}
if ($dt->status_verified = 1) {
    $verif = '<span class="badge bg-success"> <i class="fa fa-check"></i></span>';
} else {
    $verif = '<span class="badge bg-danger"> <i class="fa fa-times"></i></span>';
}

$level_mentor = '';
if ($dt->level_mentor == '0') {
    $level_mentor = 'Belum melakukan Ujian';
} elseif ($dt->level_mentor == '1') {
    $level_mentor = 'SD';
} elseif ($dt->level_mentor == '2') {
    $level_mentor = 'SD - SMP';
} elseif ($dt->level_mentor == '3') {
    $level_mentor = 'SD - SMA';
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

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-hands-helping fa-2x text-gray-300"></i>
                                </div>
                                <div class="col mr-2" style="margin-left: 5%;">
                                    <b>Permintaan</b><br><b> Mentoring</b>
                                </div>
                                <div class="col-auto">
                                    <?php foreach ($total_request as $row) ?>
                                    <b> <?= $row ?></b>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-users-slash fa-2x text-gray-300"></i>
                                </div>
                                <div class="col mr-2" style="margin-left: 5%;">
                                    <b>Permintaan</b><br><b> Ditolak</b>
                                </div>
                                <div class="col-auto">
                                    <?php foreach ($total_request_decline as $row) ?>
                                    <b> <?= $row ?></b>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                                </div>
                                <div class="col mr-2" style="margin-left: 5%;">
                                    <b>Siswa</b><br><b> Dimbimbing</b>
                                </div>
                                <div class="col-auto">
                                    <?php foreach ($total_student_mentored as $row) ?>
                                    <b> <?= $row ?></b>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                                </div>
                                <div class="col mr-2" style="margin-left: 5%;">
                                    <b>Total </b><br><b>mentoring</b>
                                </div>
                                <div class="col-auto">
                                    <?php foreach ($total_bimbingan as $row) ?>
                                    <b> <?= $row ?></b>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->

            <div class="row">
                <!-- <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <style>
                                body {
                                    background: #eee;
                                }

                                .fonts {
                                    font-size: 11px;
                                }
                            </style>
                            <div class="text-center">
                                <img src="<?= base_url() ?>/file/profile/<?= $ppsampul ?>" width="200" height="200" class="rounded-circle">
                            </div>

                            <div class="text-center mt-3">
                                <h2 class="mt-2 mb-0"><?= $dt->name ?></h2> <br>
                                <span>Level Mentor : <?= $level_mentor ?></span>
                                <br>
                                <div class="px-3 mt-1">
                                    <span>Alamat : <?= $dt->address ?></span>
                                    <br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Area Chart -->


                <!-- Pie Chart -->
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
                                    <i class="mdi mdi-account-card-details fs-4"></i>
                                </span>
                                <div class="ms-3">
                                    <h5 class="mb-0 fw-bold">Lengkapi Data Diri</h5>
                                    <span class="text-muted fs-6">Lengkapi data diri. Unggah foto profil dan foto identitas</span>
                                </div>
                                <div class="ms-auto">
                                    <?= $id ?>
                                </div>
                            </div>
                            <div class="py-3 d-flex align-items-center">
                                <span class="btn btn-success btn-circle d-flex align-items-center">
                                    <i class="mdi mdi-home-map-marker text-white fs-4"></i>
                                </span>
                                <div class="ms-3">
                                    <h5 class="mb-0 fw-bold">Atur Alamat</h5>
                                    <span class="text-muted fs-6">Atur Alamat Anda</span>
                                </div>
                                <div class="ms-auto">
                                    <?= $address ?>
                                </div>
                            </div>
                            <div class="py-3 d-flex align-items-center">
                                <span class="btn btn-info btn-circle d-flex align-items-center">
                                    <i class="mdi mdi-pencil fs-4 text-white"></i>
                                </span>
                                <div class="ms-3">
                                    <h5 class="mb-0 fw-bold">Ujian</h5>
                                    <span class="text-muted fs-6">Lakukan Ujian</span>
                                </div>
                                <div class="ms-auto">
                                    <?= $ujian ?>
                                </div>
                            </div>

                            <div class="pt-3 d-flex align-items-center">
                                <span class="btn btn-danger btn-circle d-flex align-items-center">
                                    <i class="mdi mdi-verified fs-4 text-white"></i>
                                </span>
                                <div class="ms-3">
                                    <h5 class="mb-0 fw-bold">Verifikasi</h5>
                                    <span class="text-muted fs-6">Tunggu Verifikasi oleh Admin</span>
                                </div>
                                <div class="ms-auto">
                                    <?= $verif ?>
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