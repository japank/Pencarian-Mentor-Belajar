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
            <h1 class="mb-0 fw-bold">starttest</h1>
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
    $number = (int) $_GET['n'];
    foreach ($question as $row) { ?>
        <div class="current">question <?= $row->question_number; ?> of
            <?php
            foreach ($total_question as $totalrow) { ?>
                <?= $totalrow->total; ?><?php } ?> <br></div>
        <p class="question">
            <?= $row->text; ?>
        </p>
    <?php } ?>

    <form method="post" action="<?= site_url('test/process?n=' . $number); ?>">
        <?= csrf_field(); ?>
        <ul class="choices">
            <?php
            foreach ($choices as $row) { ?>
                <li><input name="choice" id="choice" type="radio" value="<?= $row->id; ?>" /><?= $row->text; ?></li>
            <?php } ?>
        </ul>
        <input type="submit" value="submit" />
        <input type="hidden" value="<?= $number ?>" id="number" name="number" />
    </form>
</div>
<?= $this->endSection() ?>