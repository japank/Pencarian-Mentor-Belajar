<?= $this->extend('layout/templateMentor') ?>
<?= $this->section('content') ?>
<!-- <div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
            <h1 class="mb-0 fw-bold">Dashboard</h1>
        </div>
        <div class="col-6">
            <div class="text-end upgrade-btn">
                <a href="https://www.wrappixel.com/templates/flexy-bootstrap-admin-template/" class="btn btn-primary text-white" target="_blank">Upgrade to Pro</a>
            </div>
        </div>
    </div>
</div> -->
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Sales chart -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-lg-4">
            <a href="<?= base_url(); ?>/mentor/requested">
                <div class="card bg-warning">
                    <div class="card-body">
                        <div class="py-0 d-flex align-items-center">

                            <span class="btn btn-dark btn-circle text-white fs-4 d-flex align-items-center">
                                <?php foreach ($total_request as $row) ?>
                                <b> <?= $row ?></b>
                            </span>

                            <div class="ms-3">
                                <h4 class="mb-0 fw-bold">Permintaan Mentoring</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4">
            <a href="<?= base_url(); ?>/mentor/request-history">
                <div class="card bg-danger">
                    <div class="card-body">
                        <div class="py-0 d-flex align-items-center">

                            <span class="btn btn-light btn-circle d-flex align-items-center">
                                <?php foreach ($total_request_decline as $row) ?>
                                <b> <?= $row ?></b>
                            </span>

                            <div class="ms-3">
                                <h4 class="mb-0 fw-bold text-white fs-4">Permintaan Ditolak</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-4">
            <a href="<?= base_url(); ?>/logbook">
                <div class="card bg-success">
                    <div class="card-body">
                        <div class="py-0 d-flex align-items-center">

                            <span class="btn btn-light btn-circle   d-flex align-items-center">
                                <?php foreach ($total_student_mentored as $row) ?>
                                <b> <?= $row ?></b>
                            </span>

                            <div class="ms-3 ">
                                <h4 class="mb-0 fw-bold text-white fs-4">Siswa dimbimbing</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
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
        <div class="col-lg-7">
            <div class="card">
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
        </div>

        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Selesaikan Pendaftaran Kamu</h4>

                    <div class="mt-5 pb-3 d-flex align-items-center">
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
    </div>
    <!-- ============================================================== -->
    <!-- Sales chart -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Table -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Recent comment and chats -->
    <!-- ============================================================== -->
</div>
<!-- <script>
                $(document).ready(function(){
                    $.ajax({
                        url:"<?= base_url('/logbook') ?>",
                        dataType:"json",
                        success: function(res){
                            $(".list_student_test").html(res)
                        }
                    })
                })
            </script> -->
<?= $this->endSection() ?>