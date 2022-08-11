<?= $this->extend('layout/templateMentor'); ?>
<?= $this->section('content'); ?>
<div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item active" aria-current="page">Permintaan Mentoring</li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">Permintaan Mentoring</h1>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
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
                                            <td><?= $row['username_siswa']; ?></td>
                                            <td><?= strftime("%a %d %b %Y", strtotime($row['date_started']))?></td>
                                            <td><?= $row['topic']; ?></td>
                                            <td><?= $row['description']; ?></td>
                                            <td><?php
                                                if($row['status_request'] == '2'){
                                                    echo '<span class="btn btn-warning">Menunggu Verifikasi</span>';
                                                }elseif($row['status_request'] == '1'){
                                                    echo '<span style="color: white;" class="btn btn-success">Diterima</span>';
                                                }else{
                                                    echo '<span style="color: white;" class="btn btn-danger">Ditolak</span>';
                                                }
                                                ?>
                                            <td>
                                                <?php $dataedit = $row['id_request_mentor'];?>
                                                <form method="post" action="<?= base_url('mentor/verification/'. $dataedit) ?>">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" class="form-control" id="status_request" name="status_request" value="1" readonly="">
                                                <input  style="color: white;" type="submit" value="Y" class="btn btn-success" />
                                            </form>
                                            <form method="post" action="<?= base_url('mentor/verification/'. $dataedit) ?>">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" class="form-control" id="status_request" name="status_request" value="0" readonly="">
                                                <input style="color: white;" type="submit" value="X" class="btn btn-danger" />
                                            </form>
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

                </div>
            </div>

<?= $this->endSection('content'); ?>