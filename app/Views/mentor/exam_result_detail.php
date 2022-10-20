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
                    <h4 class="card-title">Hasil dari Tes <i>"<?= $name ?>"</i></h4>
                    <h6 class="card-title">Score kamu <?= $score ?></h6>
                    <?php
                    $passedOrNot = '';
                    if ($score >= $pass_score) {
                        $passedOrNot = 'Selamat Anda Lulus Ujian';
                    } else {
                        $passedOrNot = 'Maaf Anda Belum Lulus Ujian, Skor minimal kelulusan adalah ' . $pass_score;
                    }
                    ?>

                    <h6 class="card-title"><?= $passedOrNot ?> </h6>
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
<script type="text/javascript">
    function listExamResult() {
        $.ajax({
            url: "<?= site_url('exam/loadresultdetail/' . $exam_id) ?>",
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
        listExamResult();


    });
</script>

<?= $this->endSection('content'); ?>