<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
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

                <li><a class="" href="<?= base_url(); ?>/request-history">Pengajuan</a></li>
                <li><a class="" href="<?= base_url(); ?>/request-accepted">Mentoring</a></li>

                <li class="dropdown active"><a href="<?= base_url(); ?>/#"><span><?= session()->get('username') ?></span> <i class="bi bi-chevron-down"></i></a>
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
<div class="breadcrumbs" style="margin-top: 3%;">
    <div class="container">
        <h4 style="text-align:left">Tentang kamu</h4>
    </div>
</div>

<section style="background-color: #eee;">

    <div class="container py-5" style="margin-top: -5%;">

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <?php foreach ($dataUsers as $row) {
                        $pp = "";
                        if (is_null($row->profile_picture)) {
                            $pp = "default.jpg";
                        } else {
                            $pp = $row->profile_picture;
                        }
                    ?>
                        <div class="card-body text-center">
                            <img src="<?= base_url() ?>/file/profile/<?= $pp ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 170px; height:190px">
                            <h5 class="my-3">
                                <?= $row->name; ?></h5>
                            <p class="text-muted mb-1"><?= $row->role ?></p>

                            <p class="text-muted mb-4"> <?= $row->address; ?><a href="<?= site_url('location'); ?>"><i class="ri-pencil-fill contact"></i></a> </p>
                            <div class="d-flex justify-content-center mb-2">
                                <!-- <button type="button" class="btn btn-primary" onclick="changeLocation()">Ubah Alamat</button> -->

                                <a href="<?= site_url('location'); ?>"> <button type="button" class="btn btn-primary ms-1">Ubah Alamat</button></a>
                                <button type="button" class="btn btn-primary ms-1" onclick="changePw('<?= $row->username ?>')">Ubah Password</button>
                            </div>
                        </div>
                </div>

            </div>
            <div class="col-lg-8">
                <?= form_open_multipart('profile/updateSiswa/' . $row->username, ['class' => 'formProfile']) ?>
                <?= csrf_field(); ?>
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Username</p>
                            </div>
                            <div class="col-sm-9">
                                <!-- <p class="text-muted mb-0"><?= $row->username; ?></p> -->
                                <input type="text" placeholder="" value="<?= $row->username ?>" class="form-control form-control-line" readonly>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <!-- <p class="text-muted mb-0"><?= $row->name; ?></p> -->
                                <input type="text" placeholder="" id="name" name="name" value="<?= $row->name ?>" class="form-control form-control-line">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <!-- <p class="text-muted mb-0"><?= $row->email; ?></p> -->
                                <input type="email" placeholder="" id="email" name="email" value="<?= $row->email ?>" class="form-control form-control-line" name="example-email" id="example-email">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Kelas</p>
                            </div>
                            <div class="col-sm-9">
                                <!-- <p class="text-muted mb-0"><?= $row->email; ?></p> -->
                                <input type="text" placeholder="" id="kelas" name="kelas" value="<?= $row->kelas ?>" class="form-control form-control-line" name="example-email" id="example-email">
                            </div>
                        </div>
                        <hr>
                        <!-- <div class="row">
                        
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">(097) 234-5678</p>
                            </div>
                        </div> -->



                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Ganti Foto Profil <i>(opsional)</i></p>
                            </div>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3">
                                <button class="btn btn-success text-white btnsimpan">Update Profile</button>
                            </div>

                            <div class="col-sm-9">

                            </div>
                        </div>

                    </div>
                </div>
                <?= form_close() ?>
            </div>
        <?php } ?>
        </div>
    </div>
    <div class="viewModal" style="display: none;"></div>
    <script type="text/javascript">
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

        function changePw(username) {
            $.ajax({
                type: "post",
                url: "<?= site_url('profile/changePw') ?>",
                data: {
                    username: username,
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

        $(document).ready(function() {



            $('.formProfile').submit(function(e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: formData,
                    enctype: 'multipart/form-data',
                    async: false,
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.btnsimpan').attr('disable', 'disabled');
                        $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                    },
                    complete: function() {
                        $('.btnsimpan').removeAttr('disable', 'disabled');
                        $('.btnsimpan').html('Update');

                    },
                    success: function(response) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        })

                        window.location = '<?= base_url(); ?>/profile';

                        // $('#modalEdit').modal('hide');
                        // studentLogbook();


                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            });

        });
    </script>
</section>
<?= $this->endSection() ?>