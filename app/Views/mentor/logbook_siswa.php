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
            <button type="button" class="btn btn-primary btn-sm tomboltambah"><i class="fa fa-plus-circle"></i> Tambah
                Data</button><br><br>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Logbook Siswa <?= $username_siswa ?></h4>
                    <h6 class="card-subtitle">berikut merupakan logbook dari <?= $username_siswa ?>.</h6>
                </div>
                <div class="table-responsive viewdata">

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

<div class="viewModal" style="display: none;"></div>
<script type="text/javascript">
    function studentLogbook() {
        $.ajax({
            url: "<?= site_url('studentlogbook/' . $username_siswa) ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    $(document).ready(function() {
        studentLogbook();

        $('.tomboltambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('logbook/addlogbook/' . $username_siswa) ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewModal').html(response.data).show();

                    $('#modaltambah').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        })
    });
</script>

<?= $this->endSection('content'); ?>