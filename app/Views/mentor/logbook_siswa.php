<?= $this->extend('layout/templateMentor'); ?>
<?= $this->section('content'); ?>
<div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item active" aria-current="page">Logbook Siswa <?= $username_siswa?></li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">Logbook Siswa <?= $username_siswa?></h1> 
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                <div class="row">
                <div class="col-12">
                    
                <a href="<?= base_url('/logbook/add/'. $username_siswa); ?>" class="btn btn-success btn-icon-split" >
                    <span style="color: white;" class="text">Tambah Logbook</span>
                    </a><br><br>
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-striped">
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
                                            <a  style="color: white;" title="Edit" href="<?= base_url("logbook/edit/$dataedit") ?>" class="btn btn-info mt-2" style="width:75px;">Edit</a>
                                            <a  style="color: white;" title="Delete" href="<?= base_url("logbook/delete/$dataedit") ?>" class="btn btn-danger mt-2" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')">Delete</a></p>
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