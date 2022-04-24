<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
    <!-- Page Wrapper -->
    <div id="wrapper" style=" padding-top:100px">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <?php if (!empty(session()->getFlashdata('message'))) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo session()->getFlashdata('message'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif; ?>   
                <a href="<?= base_url('/logbook/add/'. $username_siswa); ?>" class="btn btn-success btn-icon-split" >
                    <span class="text">Tambah Logbook</span>
                    </a>
                    <hr>
                    <!-- Page Heading -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Logbook Siswa <?= $username_siswa?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Pertemuan</th>
                                            <th>Topik</th>
                                            <th>Deskripsi Topik</th>
                                            <th>Deskripsi Pertemuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($dataLogbook as $row) {
                                            ?>
                                            <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= strftime("%a %d %b %Y", strtotime($row->date_mentoring))?></td>
                                            <td><?= $row->topic; ?></td>
                                            <td><?= $row->topic_description; ?></td>
                                            <td><?= $row->description; ?>
                                            <td>
                                                <?php $dataedit = $row->id_logbook;?>
                                            <a title="Edit" href="<?= base_url("logbook/edit/$dataedit") ?>" class="btn btn-info mt-2" style="width:75px;">Edit</a>
                                            <a title="Delete" href="<?= base_url("logbook/delete/$dataedit") ?>" class="btn btn-danger mt-2" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')">Delete</a></p>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url("admin/vendor/jquery/jquery.min.js"); ?>"></script>
    <script src="<?= base_url("admin/vendor/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url("admin/vendor/jquery-easing/jquery.easing.min.js"); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url("admin/js/sb-admin-2.min.js"); ?>"></script>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?= $this->endSection('content'); ?>