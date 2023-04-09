<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="<?= base_url(); ?>/">Mentor</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="<?= base_url(); ?>/index.html" class="logo me-auto"><img src="<?= base_url(); ?>/assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a href="<?= base_url(); ?>/">Dashboard</a></li>
                <li><a class="active" href="<?= base_url(); ?>/mentorchecked">Mentor</a></li>
                <li><a href="<?= base_url(); ?>/chat">Chat</a></li>

                <li><a class="" href="<?= base_url(); ?>/request-history">Pengajuan</a></li>
                <li><a class="" href="<?= base_url(); ?>/request-accepted">Mentoring</a></li>


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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet" />

<main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h4 style="text-align:left">Hai <strong><?= $usernow = session()->get('name'); ?></strong> ! Lokasi Anda adalah</h4>
            <p style="text-align:left"><strong><?= session()->get('address'); ?></strong></p><br />
            <?php
            $currentLat = session()->get('latitude');
            $currentLong = session()->get('longitude');
            $currentAddress = session()->get('address');
            ?>

            <!-- <button type="button" class="btn btn-light btn-sm " onclick="changeLocation()"><i class="ri ri-book-fill"></i> Ubah Lokasi </button></a> -->
            <p style="text-align:left" onclick="changeLocation()"><a class=" tombol-putih" href="<?= base_url(); ?>/location"><strong>Ubah Alamat</strong></a></p>
        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= Team Section ======= -->

    <br>



    <div class="container">
        <div class="row col-lg-6" style="position: absolute; right: 1%;">
            <div class="col-sm">

                <select id="matkul" class="form-select">
                    <option value="all">All</option>
                    <?php
                    foreach ($exam_list as $row) {
                    ?>
                        <option value="<?= $row['id_course'] ?>"><?= $row['name_course'] ?></option>

                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm">
                <select id="level" class="form-select">

                    <option value="all">All</option>
                    <option value="1">SD</option>
                    <option value="2">SMP</option>
                    <option value="3">SMA</option>
                </select>

            </div>
            <div class="col-sm">

                <select id="distance_or_quality" class="form-select">

                    <option value="1">Terdekat</option>
                    <option value="2">Kualitas</option>
                </select>
            </div>
            <div class="col-sm">

                <button class="btn btn-success" type="button" style="border-radius: 50px;background-color:#5fcf80" onclick="allMentor()"><i class="fa fa-search" aria-hidden="true"></i></button>

            </div>
        </div>
    </div>

    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">
            <div class="row  viewdata">


            </div>
        </div>
    </section><!-- End Team Section -->
</main><!-- End #main -->
<div class="form-popup" id="myForm">
    <div class="col-sm-8 col-sm-push-4 col-lg-12">
        <div class="box box-warning direct-chat direct-chat-warning">
            <div class="box-header with-border">
                <h3 class="box-title" id="recipient-name">Chat Messages</h3>
                <div class="box-tools pull-right">
                    <!-- <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="3 New Messages">20</span> -->
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>  -->
                    <button type="button" class="btn btn-box-tool close-chat" data-widget="remove"><i class="fa fa-times"></i> </button>
                </div>
            </div>
            <div class="box-body">
                <div class="direct-chat-messages" id="conversation">

                </div>
            </div>
            <div class="box-footer">
                <div class="input-group">
                    <?= csrf_field() ?>
                    <input type="text" name="message" id="comment" placeholder="Type Message ..." class="form-control"> <span class="input-group-btn">
                        <button type="button" id="send-message" class="btn btn-warning btn-flat" style=" background: #5fcf80;border-color: #5fcf80">Send</button> </span>
                </div>
            </div>
        </div>
    </div>

</div>




<div class="viewModal" style="display: none;"></div>
<script type="text/javascript">
    $('document').ready(function() {


        allMentor();

    });

    function changeLocation() {

        $.ajax({
            type: "post",
            url: "<?= site_url('location/index') ?>",
            data: {
                // latitude: lat,
                // longitude: long,
                // address: address,

            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewModal').html(response.sukses).show();
                    $('#modalEdit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function request(username_mentor) {
        var exam_id = '<? $exam_id ?>'
        $.ajax({
            type: "post",
            url: "<?= site_url('mentor/requestMentor') ?>",
            data: {
                username_mentor: username_mentor
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewModal').html(response.sukses).show();
                    $('#modalEdit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function showMatpelMentor(username_mentor) {
        var exam_id = '<? $exam_id ?>'
        $.ajax({
            type: "post",
            url: "<?= site_url('exam/showmatpelmentor') ?>",
            data: {
                username_mentor: username_mentor
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewModal').html(response.sukses).show();
                    $('#modalEdit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function allMentor() {
        var matkul = document.getElementById("matkul").value;
        var level = document.getElementById("level").value;
        var distance_or_quality = document.getElementById("distance_or_quality").value;
        $.ajax({
            url: "<?= site_url('mentor/allMentor') ?>",
            data: {
                matkul: matkul,
                level: level,
                distance_or_quality: distance_or_quality,
            },
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function showLocation(lat, long, name, address) {
        $.ajax({
            type: "post",
            url: "<?= site_url('users/showLocation') ?>",
            data: {
                lat: lat,
                long: long,
                name: name,
                address: address
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewModal').html(response.sukses).show();
                    $('#modalEdit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
</script>
<?= $this->endSection() ?>