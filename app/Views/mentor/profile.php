<?= $this->extend('layout/templateMentor2'); ?>
<?= $this->section('content'); ?>
<!-- DataTables -->
<link href="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/mbohtable/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<link href="<?= base_url() ?>/assets/mbohtable/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>/assets/mbohtable/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>/assets/mbohtable/css/style.css" rel="stylesheet" type="text/css">
<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>

<div class="container-fluid">
    <?php foreach ($dataUsers as $row) { ?>
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30"> <img src="<?= base_url() ?>/assets/mentor/assets/images/users/5.jpg" class="rounded-circle" width="150" />
                            <h4 class="card-title m-t-10"><?= $row->name ?></h4>
                            <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
                            <div class="row text-center justify-content-md-center">
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i>
                                        <font class="font-medium">254</font>
                                    </a></div>
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i>
                                        <font class="font-medium">54</font>
                                    </a></div>
                            </div>
                        </center>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="card-body"> <small class="text-muted">Email address </small>
                        <h6><?= $row->email ?></h6> <small class="text-muted p-t-30 db">Phone</small>
                        <h6>+91 654 784 547</h6> <small class="text-muted p-t-30 db">Address</small>
                        <h6><?= $row->address ?></h6>
                        <button type="button" onclick="changeLocation()" class="btn btn-info btn-sm">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <!-- <div class="map-box">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div> <small class="text-muted p-t-30 db">Social Profile</small>
                        <br />
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-facebook-f"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-twitter"></i></button>
                        <button class="btn btn-circle btn-secondary"><i class="fab fa-youtube"></i></button> -->
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <?= form_open_multipart('profile/update/' . $row->username, ['class' => 'formProfile']) ?>
                        <?= csrf_field(); ?>
                        <!-- <form class="form-horizontal form-material mx-2"> -->
                        <div class="form-group">
                            <label class="col-md-12">Username</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="" value="<?= $row->username ?>" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Full Name</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="" id="name" name="name" value="<?= $row->name ?>" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" placeholder="" id="email" name="email" value="<?= $row->email ?>" class="form-control form-control-line" name="example-email" id="example-email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input type="password" value="<?= $row->password ?>" id="password" name="password" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Phone No</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">File Identitas</label>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-info btn-sm" onclick="showIdentity('<?= $row->username ?>')">
                                    <i class="fa fa-eye"></i> Lihat File Identitas
                                </button><br><br><br>
                                <i>Tekan tombol pilih file dibawah untuk mengubah file identitas anda</i>
                                <input type="file" class="form-control" id="identity_file" name="identity_file">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                                <label class="col-sm-12">Select Country</label>
                                <div class="col-sm-12">
                                    <select class="form-select shadow-none form-control-line">
                                        <option>London</option>
                                        <option>India</option>
                                        <option>Usa</option>
                                        <option>Canada</option>
                                        <option>Thailand</option>
                                    </select>
                                </div>
                            </div> -->
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success text-white btnsimpan">Update Profile</button>
                            </div>
                        </div>

                        <?= form_close() ?>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    <?php } ?>
</div>
</div>



<script src="<?= base_url() ?>/assets/mbohtable/js/jquery.min.js"></script>


<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url() ?>/assets/mbohtable/js/app.js"></script>

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


    function showIdentity(username) {
        $.ajax({
            type: "post",
            url: "<?= site_url('profile/showIdentity') ?>",
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

<?= $this->endSection('content'); ?>