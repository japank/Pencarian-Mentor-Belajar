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

<<<<<<< HEAD


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

=======
    <style>
        @import "//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css";

        .active-tabs {

            position: absolute;
            right: 7%;
        }

        .active-tabs input {
            opacity: 0;
            display: none;
            visibility: hidden;
        }

        .btnjar {
            background: #f1f1f1;
            color: darkslategrey;
            cursor: pointer;
            display: block;
            float: left;
            font-size: 15px;
            height: 47px;
            line-height: 35px;
            margin-right: 1px;
            text-align: center;
            width: 100px;
            opacity: 0.8;
            transition: all 0.4s;
        }

        .btnjar:hover {
            transform: translateY(-5px);
            opacity: 1;
        }

        .active-tabs input:checked+label {
            background: #5fcf80;
            opacity: 1;
            transform: translateY(-5px);
            box-shadow: 1px 0 0 0 rgba(0, 0, 0, 0.3);
            color: #f1f1f1;
        }

        .tabs-container {
            width: 100%;
            position: relative;
            float: left;
            top: -5px;
            background: #fff;
        }

        .tab-1,
        .tab-2 {
            height: 200px;
            width: 100%;
            box-shadow: 2px 2px 0 0 rgba(0, 0, 0, 0.3);
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s;
        }

        .tab-2 {
            height: 300px;
        }

        .tab-1 p,
        .tab-2 p {
            color: #1babbb;
            font-family: "Open Sans";
            font-size: 50px;
            line-height: 200px;
            text-align: center;
        }

        .tab-2 p,
        .tab-4 p,
        .tab-6 p {
            line-height: 300px;
        }

        .btnjar-1:checked~.tabs-container .tab-1,
        .btnjar-2:checked~.tabs-container .tab-2 {
            position: relative;
            visibility: visible;
            top: 0;
            left: 0;
            opacity: 1;
        }
    </style>
    <div class="active-tabs">
        <input type="radio" name="active_tabs" id="btnjar-1" class="btnjar-1" checked onclick="allMentor()">
        <label for="btnjar-1" class="btnjar"><i class="fa fa-map-marker"></i> Jarak</label>

        <input type="radio" name="active_tabs" id="btnjar-2" class="btnjar-2" onclick="allMentorByScore()">
        <label for="btnjar-2" class="btnjar"><i class="fa fa-book"></i> Nilai</label>

    </div>


>>>>>>> b60230be6a74b6e83a6ed782e122e1adfb91890e
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
<<<<<<< HEAD

=======
>>>>>>> b60230be6a74b6e83a6ed782e122e1adfb91890e
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