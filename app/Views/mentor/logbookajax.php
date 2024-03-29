<table id="logbookSiswa" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Pertemuan</th>
            <th>Deskripsi Pertemuan</th>
            <th>Foto Kegiatan</th>
            <th>Aksi</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($studentlogbook as $row) {
            $tesss = (explode(",", $row->date_started));
        ?>

            <tr>
                <td><?= $no++ ?></td>
                <td><?= strftime("%a %d %b %Y", strtotime($row->date_mentoring)) ?></td>
                <td><?= $row->mentoring_description; ?></td>

                <td><button type="button" class="btn btn-info btn-sm" onclick="showPhoto('<?= $row->activity_photo ?>')">
                        <i class="fa fa-eye"></i>
                    </button></td>
                <td>
                    <?php $id_logbook_will_edit = $row->id_logbook;
                    $dataDate = strftime("%a %d %b %Y", strtotime($row->date_mentoring));
                    ?>
                    <?php if ($requestDetail->status_mentoring == '0') { ?>
                        <button type="button" class="btn btn-info btn-sm" onclick="editLogbook('<?= $id_logbook_will_edit ?>','<?= $id_request ?>')">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteLogbook('<?= $dataDate ?>', '<?= $id_logbook_will_edit ?>')">
                            <i class="fa fa-trash"></i>
                        </button>
                    <?php } else { ?>
                        -
                    <?php } ?>
                </td>
            </tr>

        <?php
        }
        ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#logbookSiswa').DataTable();
    });

    function editLogbook(id_logbook_will_edit, id_request) {
        $.ajax({
            type: "post",
            url: "<?= site_url('logbook/editLogbook') ?>",
            data: {
                id_logbook: id_logbook_will_edit,
                id_request: id_request
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

    function deleteLogbook(a, b) {
        Swal.fire({
            title: 'Hapus',
            text: `Apakah anda yakin menghapus logbook hari ${a} ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('logbook/deleteLogbook') ?>",
                    data: {
                        id_logbook: b,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            })
                            studentLogbook();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            }
        })
    }

    function showPhoto(id_logbook) {
        $.ajax({
            success: function(response) {
                Swal.fire({
                    imageUrl: "<?= base_url() ?>/file/logbook/" + id_logbook,

                    imageAlt: 'A tall image'
                })
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
</script>