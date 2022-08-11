<?= $this->extend('layout/templateMentor'); ?>
<?= $this->section('content'); ?>
<div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item active" aria-current="page">Logbook</li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">Logbook Siswa</h1> 
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
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Siswa yang kamu mentorin</h4>
                                <h6 class="card-subtitle">Dibawah ini adalah daftar siswa yang kamu mentorin.</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $no = 1;
                                    foreach ($siswaMentored as $row){ ?>
                                    
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= $row->name; ?></td>
                                            <td><?= $row->address; ?></td>
                                            <td><a href="<?= base_url("logbook/details/$row->username"); ?>">Logbok</a></td>
                                        </tr>
                                        
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

<?= $this->endSection('content'); ?>