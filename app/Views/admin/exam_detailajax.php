<table id="logbookSiswa" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Question ID</th>
            <th>question title</th>
            <th>Option 1</th>
            <th>Option 2</th>
            <th>Option 3</th>
            <th>Option 4</th>
            <th>Correct Answer</th>
            <th>action</th>

        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($exam_detail as $row) {
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['question_id'] ?></td>
                <td><?= $row['question_title'] ?></td>
                <?php foreach ($option as $rowoption) if ($rowoption['question_id'] == $row['question_id']) : ?>
                    <td> <?= $rowoption['option_title'] ?></td>
                <?php endif; ?>
                <?php foreach ($option as $rowoption) if ($rowoption['question_id'] == $row['question_id'] && $rowoption['option_number'] == $row['answer_option']) : ?>
                    <td> <?= $rowoption['option_title'] ?></td>
                <?php endif; ?>
                <td>Ubah soal, ubah option</td>
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

    function editLogbook(id_logbook_will_edit) {
        $.ajax({
            type: "post",
            url: "<?= site_url('logbook/editLogbook') ?>",
            data: {
                id_logbook: id_logbook_will_edit,
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
</script>