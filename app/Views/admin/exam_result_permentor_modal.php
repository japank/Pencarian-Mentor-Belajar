<!-- DataTables -->
<link href="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/mbohtable/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<link href="<?= base_url() ?>/assets/mbohtable/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>/assets/mbohtable/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>/assets/mbohtable/css/style.css" rel="stylesheet" type="text/css">

<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Test Mentor <b><?= $username_mentor ?> </b></h5><br>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="table-responsive">
                <table id="dataAllLogbook" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Test</th>
                            <th>Skor Akhir</th>
                            <th>Biaya Per Pertemuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($exam_result as $row) {

                        ?>
                            <tr>
                                <td><?= $row['exam_name']; ?>
                                    <?php
                                    $level = '';
                                    if ($row['level'] == '1') {
                                        $level = '<span class="badge bg-danger rounded style=" margin-left:3%">SD</span>';
                                    } elseif ($row['level'] == '2') {
                                        $level = '<span class="badge bg-primary rounded style=" margin-left:3%"">SMP</span>';
                                    } else {
                                        $level = '<span class="badge bg-secondary rounded style=" margin-left:3%"">SMA</span>';
                                    } ?>
                                    <?= $level ?><br></td>
                                <td>
                                    <?php
                                    $passornot = '';
                                    if ($row['score'] >= $row['pass_score']) {
                                        $passornot = '<span class="badge bg-success rounded style=" margin-left:3%">Lulus</span>';
                                    } else {
                                        $passornot = '<span class="badge bg-danger rounded style=" margin-left:3%"">Gagal</span>';
                                    } ?>
                                    <?= $row['score']; ?> <?= $passornot ?></td>
                                <td>
                                    <?php
                                    $price = '';
                                    if ($row['level'] == '1') {
                                        $price = '<span class="badge bg-success rounded style=" margin-left:3%">' . $row['price_sd'] . ' rb</span>';
                                    } elseif ($row['level'] == '2') {
                                        $price = '<span class="badge bg-success rounded style=" margin-left:3%"">' . $row['price_smp'] . ' rb</span>';
                                    } else {
                                        $price = '<span class="badge bg-sucsess rounded style=" margin-left:3%"">' . $row['price_sma'] . ' rb</span>';
                                    } ?>
                                    <?= $price ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table><br><br>


            </div>


        </div>
    </div>
</div>
<!-- <div class="viewModal" style="display: none;"></div> -->
<!-- <script src="<?= base_url() ?>/assets/mbohtable/js/jquery.min.js"></script> -->


<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url() ?>/assets/mbohtable/js/app.js"></script>
<script>
    $(document).ready(function() {
        $('#dataAllLogbook').DataTable();

    });

    function showPhoto(id_logbook) {
        $.ajax({
            type: "post",
            url: "<?= site_url('logbook/showPhoto') ?>",
            data: {
                id_logbook: id_logbook,
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
</script>