<!-- DataTables -->
<link href="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/mbohtable/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<link href="<?= base_url() ?>/assets/mbohtable/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>/assets/mbohtable/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>/assets/mbohtable/css/style.css" rel="stylesheet" type="text/css">

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logbook Mentor <b><?= $username_mentor ?> Dengan Semua Siswa</b></h5><br>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="table-responsive">
                <table id="dataAllLogbook" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal Pertemuan</th>
                            <th>Siswa</th>
                            <th>Topik</th>
                            <th>Deskripsi Topik</th>
                            <th>Deskripsi Pertemuan</th>
                            <th>Foto</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($logbook as $row) {
                            $id_logbook = $row['id_logbook'];
                        ?>
                            <tr>
                                <td><?= strftime("%d %b %Y, %A", strtotime($row['date_mentoring'])) ?></td>
                                <td><?= $row['username_siswa'] ?></td>
                                <td><?= $row['topic'] ?></td>
                                <td><?= $row['topic_description'] ?></a></td>
                                <td><?= $row['description'] ?></a></td>
                                <td><button type="button" class="btn btn-info btn-sm" onclick="showPhoto('<?= $id_logbook ?>')">
                                        <i class="fa fa-eye"></i></td>

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