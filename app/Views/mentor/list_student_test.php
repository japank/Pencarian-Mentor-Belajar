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

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Siswa yang kamu mentorin</h4>
                    <h6 class="card-subtitle">Dibawah ini adalah daftar siswa yang kamu mentorin.</h6>
                </div>
                <div class="table-responsive">
                    <table id="dataSiswa" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($siswaMentored as $row) { ?>
                                <tr>
                                    <td><?= $row->name; ?></td>
                                    <td><?= $row->address; ?></td>
                                    <td><a href="<?= base_url("logbook/details/$row->username"); ?>">Logbook</a></td>
                                    <td>a</td>
                                    <td>a</td>
                                    <td>a</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
</div>



<script src="<?= base_url() ?>/assets/mbohtable/js/jquery.min.js"></script>


<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url() ?>/assets/mbohtable/js/app.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#dataSiswa').DataTable();
    });
</script>

<?= $this->endSection('content'); ?>