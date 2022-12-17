<table id="dataExam" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Level</th>
            <th>Correct Answer</th>
            <th>Wrong Answer</th>
            <th>Pass Score</th>
            <th>Time</th>
            <th>Action</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($list_exam as $row) {
            $exam_id = $row['exam_id'];
            $level = '';
            if ($row['level'] == 1) {
                $level = '<span class="badge bg-danger rounded">SD</span>';
            } elseif ($row['level'] == 2) {
                $level = '<span class="badge bg-primary rounded">SMP</span>';
            } else {
                $level = '<span class="badge bg-secondary rounded">SMA</span>';
            }
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $level ?></a></td>
                <td><span class="badge bg-success rounded">+ <?= $row['marks_per_right_answer'] ?></span></td>
                <td><span class="badge bg-danger rounded">- <?= $row['marks_per_wrong_answer'] ?></span></td>

                <td><?= $row['pass_score'] ?></td>
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