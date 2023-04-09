<?= $this->extend('layout/template2'); ?>
<?= $this->section('content'); ?>
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="<?= base_url(); ?>/index.html">Mentor</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="<?= base_url(); ?>/index.html" class="logo me-auto"><img src="<?= base_url(); ?>/assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a href="<?= base_url(); ?>/">Dashboard</a></li>
                <li><a href="<?= base_url(); ?>/mentorchecked">Mentor</a></li>
                <li><a href="<?= base_url(); ?>/chat">Chat</a></li>

                <li><a class="" href="<?= base_url(); ?>/mentor/request">Riwayat Permintaan</a></li>
                <li><a class="active" href="<?= base_url(); ?>/mylogbook">Logbook</a></li>

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
<main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h4 style="text-align:left">Hai <b><?= $usernow = session()->get('name'); ?></b>. Ini Mentor kamu</h4>

        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php
                $no = 1;

                $username_siswa = session()->get('username');
                foreach ($mentor as $row) {
                    $username_mentor = $row->username;
                    $pp = "";
                    if (is_null($row->profile_picture)) {
                        $pp = "default.jpg";
                    } else {
                        $pp = $row->profile_picture;
                    }
                ?>
                    <div class="col-lg-6 mt-4">
                        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                            <div class="pic"><img src="<?= base_url() ?>/file/profile/<?= $pp ?>" class="img-fluid" alt="" style="width: 100%; height:150px"></div>
                            <div class="member-info">
                                <h4><?= $row->name; ?></h4>
                                <span> </span>
                                <p><?= $row->address; ?></p>
                                <div class="social">
                                    <!-- <a href="<?= base_url("mylogbook/details/$row->username"); ?>"><i class="ri-book-fill"></i></a>
                                 -->
                                    <a onclick="showLogbook('<?= $username_mentor ?>')"><i class="ri ri-book-fill"></i></a>

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
<script src="<?= base_url() ?>/assets/mbohtable/js/jquery.min.js"></script>


<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url() ?>/assets/mbohtable/js/app.js"></script>
<div class="viewModal" style="display: none;"></div>
<script>
    var username_siswa = '<?= $username_siswa ?>';
    $(document).ready(function() {
        // $('#dataMentored').DataTable();

    });

    function showLogbook(username_mentor) {
        $.ajax({
            type: "post",
            url: "<?= site_url('logbook/showLogbookStudent') ?>",
            data: {
                username_mentor: username_mentor,
                username_siswa: username_siswa
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewModal').html(response.sukses).show();
                    $('#modaltambah').modal('show');

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
</script>
<?= $this->endSection('content'); ?>