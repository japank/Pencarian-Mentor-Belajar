<?= $this->extend('layout/templateAdmin') ?>
<?= $this->section('content') ?>

<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Three charts -->
    <!-- ============================================================== -->
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Mentor yang perlu diverifikasi</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li class="text-warning">
                        <i class="fa fa-user  fa-3x" aria-hidden="true"></i><i class="fa fa-clock-o fa-2x" aria-hidden="true"></i>
                    </li>
                    <li class="ms-auto"><span class="counter text-warning"><?php foreach ($mentor_pending as $row) ?>
                            <b> <?= $row ?></b></span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Mentor Ditolak</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li class="text-danger">
                        <i class="fa fa-user-times  fa-3x" aria-hidden="true"></i></i>
                    </li>
                    <li class="ms-auto"><span class="counter text-danger"><?php foreach ($mentor_decline as $row) ?>
                            <b> <?= $row ?></b></span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Mentor Diterima</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li class="text-success">
                        <i class="fa fa-user  fa-3x" aria-hidden="true"></i><i class="fa fa-check-circle fa-2x" aria-hidden="true"></i>
                    </li>
                    <li class="ms-auto"><span class="counter text-success"><?php foreach ($mentor_accept as $row) ?>
                            <b> <?= $row ?></b></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Semua Mentor</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li class="text-primary">
                        <i class="fa fa-user  fa-3x" aria-hidden="true"></i><i class="fa fa-book fa-2x" aria-hidden="true"></i>
                    </li>
                    <li class="ms-auto"><span class="counter text-primary"><?php foreach ($total_all_mentor as $row) ?>
                            <b> <?= $row ?></b></span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Murid</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li class="text-info">
                        <i class="fa fa-user  fa-3x" aria-hidden="true"></i><i class="fa fa-graduation-cap fa-2x" aria-hidden="true"></i>
                    </li>
                    <li class="ms-auto"><span class="counter text-info"><?php foreach ($total_all_student as $row) ?>
                            <b> <?= $row ?></b></span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Total Test</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                    <li class="text-secondary">
                        <i class="fa fa-pencil-square-o  fa-3x" aria-hidden="true"></i>
                    </li>
                    <li class="ms-auto"><span class="counter text-secondary"><?php foreach ($total_test as $row) ?>
                            <b> <?= $row ?></b></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<?= $this->endSection() ?>