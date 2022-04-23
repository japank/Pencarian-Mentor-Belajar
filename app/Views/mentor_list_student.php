<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<main id="main" data-aos="fade-in">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
    <div class="container">
    <h4 style="text-align:left">Hai <?= $usernow = session()->get('username'); ?> Ini siswa yang kamu mentorin</h4>
    <!-- <p style="text-align:left"><?= session()->get('address');?></p><br/> -->
    <!-- <p style="text-align:left"><a href="<?= site_url('location'); ?>" class="tombol-putih" ><b>Ubah Lokasi</b></a></p>     -->
</div>
</div><!-- End Breadcrumbs -->
<!-- ======= Team Section ======= -->
<section id="team" class="team section-bg">
    <div class="container" data-aos="fade-up">

    <div class="row">
    <?php
            $no = 1;

            $usernow = session()->get('username');
            foreach ($siswaMentored as $row){
            ?>
        <div class="col-lg-6">
        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
            <div class="pic"><img src="<?= base_url(); ?>/assets/img/trainers/trainer-1.jpg" class="img-fluid" alt=""></div>
            <div class="member-info">
            <h4><?= $row->name; ?></h4>
            <span> km</span>
            <p><?= $row->address; ?></p>
            <div class="social">
                <a href="<?= base_url("logbook/details/$row->username"); ?>"><i class="ri-book-fill"></i></a>
            </div>
            </div>
        </div>
        </div>
        <?php
            }
            ?>


    </div>

    </div>
</section><!-- End Team Section -->
</main><!-- End #main -->
<?= $this->endSection('content'); ?>