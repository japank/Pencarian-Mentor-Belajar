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
    <?php foreach ($dataMentor as $row) {
        $pp = "";
        if (is_null($row->profile_picture)) {
            $pp = "default.jpg";
        } else {
            $pp = $row->profile_picture;
        } ?>

        <div class="row">
<<<<<<< HEAD
=======
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert bg-warning alert-dismissible fade show" role="alert">
                    <h4>Periksa Entrian Form</h4>
                    </hr />
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <!-- Column -->
>>>>>>> b60230be6a74b6e83a6ed782e122e1adfb91890e
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30"> <img src="<?= base_url() ?>/file/profile/<?= $pp ?>" class="rounded-circle" width="150" height="160" />

                            <h3 class="card-title m-t-10"><?= $row->name ?></h3>

                            <?php
                            $status_verif = '';
                            if ($row->status_verified == '1') {
                                $status_verif = 'Aktif <span class="badge bg-success"> <i class="fa fa-check"></i></span>';
                            } else {
                                $status_verif = 'Nonaktif <span class="badge bg-danger"> <i class="fa fa-times"></i></span>';
                            }
                            ?>

                            <h6>Status : <?= $status_verif ?></h6>
                        </center>
                    </div>

                    <div class="card-body">
                        <!-- <small class="text-muted">Level mengajar mentor </small> -->

                        <?php
                        $level_mentor = '';
                        if ($row->level_mentor == '0') {
                            $level_mentor = 'Belum melakukan Ujian';
                        } elseif ($row->level_mentor == '1') {
                            $level_mentor = 'SD';
                        } elseif ($row->level_mentor == '2') {
                            $level_mentor = 'SD - SMP';
                        } elseif ($row->level_mentor == '3') {
                            $level_mentor = 'SD - SMA';
                        } ?>
                        <!-- <h6><?= $level_mentor ?></h6> -->
                        <small class="text-muted p-t-30 db">Alamat</small>
                        <h6><?= $row->address ?>
                            <a href="<?= site_url('location'); ?>"><button type="button" onclick="changeLocation()" class="btn btn-info btn-sm">
                                    <i class="fa fa-pencil"></i>
                                </button></a>
                        </h6>
                        <a href="<?= site_url('location'); ?>"> <button class="btn btn-success text-white">Ubah Lokasi</button></a>
                        <button class="btn btn-primary text-white" onclick="changePw('<?= $row->username ?>')">Ganti Password</button>

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
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="col-md-12">Username</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="" value="<?= $row->username ?>" disabled class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Full Name</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="" id="name" name="name" value="<?= $row->name ?>" class="form-control form-control-line">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" placeholder="" id="email" name="email" value="<?= $row->email ?>" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Kelas</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="" id="kelas" name="kelas" value="<?= $row->kelas ?>" class="form-control form-control-line">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <label for="example-email" class="col-md-12"> Biaya Per Pertemuan</label>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">SD</label>
                                    <div class="col-md-8">
                                        <input type="number" placeholder="" id="price_sd" name="price_sd" value="<?= $row->price_sd ?>" class="form-control form-control-line">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">SMP</label>
                                    <div class="col-md-8">
                                        <input type="number" placeholder="" id="price_smp" name="price_smp" value="<?= $row->price_smp ?>" class="form-control form-control-line">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">SMA</label>
                                    <div class="col-md-8">
                                        <input type="number" placeholder="" id="price_sma" name="price_sma" value="<?= $row->price_sma ?>" class="form-control form-control-line">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">File Identitas</label>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-info btn-sm" onclick="showIdentity('<?= $row->username ?>')">
                                    <i class="fa fa-eye"></i> Lihat File Identitas
                                </button><br><br>
                                <i>Tekan tombol pilih file dibawah untuk mengubah file identitas anda (opsional)</i>
                                <input type="file" class="form-control" id="identity_file" name="identity_file">
                                <br>
                                <i>Tekan tombol pilih file dibawah untuk mengubah foto profil (opsional)</i>
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col">
                                <button class="btn btn-success text-white btnsimpan">Update Profile</button>
                            </div>
                        </div>

                        <?= form_close() ?>

                    </div>
                </div>
            </div>

        </div>

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

<?= $this->endSection('content'); ?>