<link href="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/mbohtable/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<link href="<?= base_url() ?>/assets/mbohtable/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>/assets/mbohtable/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>/assets/mbohtable/css/style.css" rel="stylesheet" type="text/css">

<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mata Pelajaran yang mentor <strong>"<?= $username_mentor->name ?>"</strong> kuasai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">

                <div class="table-responsive">
                    <table id="dataAllLogbook" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Tingkat</th>
                                <th>Biaya per Pertemuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($exam_result as $row) {

                            ?>
                                <tr>
                                    <td><?= $row['name_course']; ?> <br></td>
                                    <td>
                                        <?php
                                        $passornot = '';
                                        if ($row['level'] == '1') {
                                            $passornot = '<span class="badge bg-danger rounded style=" margin-left:3%">SD</span>';
                                        } elseif ($row['level'] == '2') {
                                            $passornot = '<span class="badge bg-primary rounded style=" margin-left:3%"">SMP</span>';
                                        } else {
                                            $passornot = '<span class="badge bg-secondary rounded style=" margin-left:3%"">SMA</span>';
                                        } ?>
                                        <?= $passornot ?></td>
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
                    </table>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>


        </div>
    </div>
</div>
<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.js"></script>


<script>
    $(document).ready(function() {
        $('#dataAllLogbook').DataTable();

    });
</script>