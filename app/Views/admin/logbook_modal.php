<!-- DataTables -->
<link href="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/mbohtable/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<link href="<?= base_url() ?>/assets/mbohtable/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>/assets/mbohtable/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>/assets/mbohtable/css/style.css" rel="stylesheet" type="text/css">

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Logbook Mentor "<strong><?= $username_mentor ?></strong>" dengan Siswa "<strong><?= $username_siswa ?></strong>"</h5><br>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="card-body">
                <h5 class="card-title" style="position: absolute; right: 7%;">
                    <?php
                    if ($request_mentor->status_mentoring == '0') {
                        echo '<span class="badge bg-warning"><strong>Proses Mentoring</strong></span>';
                    } else {
                        echo '<span class="badge bg-success"><strong>Mentoring Selesai</strong></span>';
                    }
                    ?></h5>


                <h6 class="modal-title" id=" exampleModalLabel">Mata Pelajaran "<strong><?= $request_mentor->topic ?></strong>"</h6>
                <h6 class="modal-title" id=" exampleModalLabel">Topik "<strong><?= $request_mentor->description ?></strong>"</h6><br>
            </div>
            <div class="table-responsive">
                <table id="dataLogbook" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal Pertemuan</th>
                            <th>Deskripsi Pertemuan</th>
                            <th>Foto Kegiatan</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($logbook as $row) {

                        ?>
                            <tr>
                                <td><?= strftime(" %A, %d %b %Y", strtotime($row->date_mentoring)) ?></td>
                                <td><?= $row->mentoring_description ?></a></td>
                                <td><button type="button" class="btn btn-info btn-sm" onclick="showPhoto('<?= $row->id_logbook ?>')">
                                        <i class="fa fa-eye"></i>
                                    </button></td>

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
    $(document).ready(function() {
        $('#dataLogbook').DataTable();

    });
</script>