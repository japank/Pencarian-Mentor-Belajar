<?= $this->extend('layout/templateMentor') ?>
<?= $this->section('content') ?>
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
            <h1 class="mb-0 fw-bold">Test</h1>
        </div>
        <div class="col-6">
            <div class="text-end upgrade-btn">
                <a href="https://www.wrappixel.com/templates/flexy-bootstrap-admin-template/" class="btn btn-primary text-white" target="_blank">Upgrade to Pro</a>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <?php
    if (!isset($_SESSION['score'])) {
        $_SESSION['score'] = 0;
    }
    foreach ($total_question as $row) { ?>
        Skor sekarang : <?= $_SESSION['score']; ?> <br>
        Jumlah soal : <?= $row->total; ?><?php } ?> <br>
        <a href="<?= base_url(); ?>/teststart?n=1" class=" start">start quiz</a>
        <br />
        <a href="<?= base_url(); ?>/exam/started" class=" start">start quiz 2</a>
</div>
<?= $this->endSection() ?>