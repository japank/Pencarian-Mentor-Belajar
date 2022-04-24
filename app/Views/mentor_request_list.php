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
                    <hr>
                    <!-- Page Heading -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">History Request Mentor</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mentor</th>
                                            <th>Tanggal Pertemuan</th>
                                            <th>Topik</th>
                                            <th>Deskripsi Topik</th>
                                            <th>Status Permintaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($requestMentorList as $row) {
                                            ?>
                                            <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['username_mentor']; ?></td>
                                            <td><?= strftime("%a %d %b %Y", strtotime($row['date_started']))?></td>
                                            <td><?= $row['topic']; ?></td>
                                            <td><?= $row['description']; ?></td>
                                            <td><?php
                                                if($row['status_request'] == '2'){
                                                    echo 'Menunggu Verifikasi';
                                                }elseif($row['status_request'] == '1'){
                                                    echo 'Diterima';
                                                }else{
                                                    echo 'Ditolak';
                                                }
                                                ?>
                                            <td>
                                                <?php $dataedit = $row['id_request_mentor'];?>
                                                <?php 
                                                if($row['status_request'] == '2'){
                                                ?>
                                            <a title="Edit" href="<?= base_url("mentor/edit/$dataedit") ?>" class="btn btn-info mt-2" style="width:75px;">Edit</a>
                                            <a title="Delete" href="<?= base_url("mentor/delete/$dataedit") ?>" class="btn btn-danger mt-2" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')">Delete</a></p>
                                                <?php }
                                                else{
                                                    echo "-";
                                                }
                                            ?>
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