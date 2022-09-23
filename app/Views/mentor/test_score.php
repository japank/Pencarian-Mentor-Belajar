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
    foreach ($total_question as $row) { ?>
        Jumlah soal : <?= $row->total; ?><?php } ?>
        <?php if ($row->total - 1 <= $_SESSION['score']) { ?>
            <h1>Lulus</h1>
        <?php } else { ?> <h1>tidak lulus</h1> <?php
                                        } ?>
        <h1> skor : <?= $_SESSION['score']; ?> <br></h1>

</div>
<?= $this->endSection() ?>