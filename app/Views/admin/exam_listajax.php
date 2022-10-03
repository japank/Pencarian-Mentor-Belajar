<table id="dataExam" class="table table-bordered">
    <thead>
        <tr>
            <th>Exam Id</th>
            <th>Name</th>
            <th>Level</th>
            <th>marks right</th>
            <th>marks wrong</th>
            <th>waktu</th>
            <th>Action</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($list_exam as $row) {
            $exam_id = $row['exam_id'];
        ?>
            <tr>
                <td><?= $row['exam_id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['level'] ?></a></td>
                <td><?= $row['marks_per_right_answer'] ?></td>
                <td><?= $row['marks_per_wrong_answer'] ?></td>
                <td><?= $row['time'] ?> menit</td>
                <td><a href="<?= base_url("exam/detail/$exam_id"); ?>" id="<?= $exam_id ?>">
                        <button type="button" class="btn btn-warning btn-sm">
                            <i class="fa fa-book"></i>
                        </button></a>
                    <button type="button" class="btn btn-info btn-sm" onclick="editExam('<?= $exam_id ?>')">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteExam('<?= $exam_id ?>')">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table><br><br>
<script>
    $(document).ready(function() {
        $('#dataExam').DataTable();

    });

    function editExam(exam_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('exam/editExam') ?>",
            data: {
                exam_id: exam_id
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

    function deleteExam(a) {
        Swal.fire({
            title: 'Hapus',
            text: `Apakah anda yakin menghapus pertanyaan dengan id ${a} ?`,
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
                    url: "<?= site_url('exam/deleteExam') ?>",
                    data: {
                        exam_id: a,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            })
                            listExamByAdmin();
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