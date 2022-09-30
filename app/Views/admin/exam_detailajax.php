<table id="examListQuestionOption" class="table table-bordered">
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
            $id_question_option = $row['question_id'];
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['question_id'] ?></td>
                <td><?= $row['question_title'] ?></td> <?php foreach ($option as $rowoption) if ($rowoption['question_id'] == $row['question_id']) : ?>
                    <td> <?= $rowoption['option_title'] ?></td>
                <?php endif; ?>

                <?php foreach ($option as $rowoption) if ($rowoption['question_id'] == $row['question_id'] && $rowoption['option_number'] == $row['answer_option']) : ?>
                    <td> <?= $rowoption['option_title'] ?></td>
                <?php endif; ?>
                <td>

                    <?php foreach ($option as $rowoption)
                        if ($rowoption['question_id'] == $row['question_id'] && $rowoption['option_number'] == '1') {
                            $id_option1 = $rowoption['id_option'];
                        } elseif ($rowoption['question_id'] == $row['question_id'] && $rowoption['option_number'] == '2') {
                            $id_option2 = $rowoption['id_option'];
                        } elseif ($rowoption['question_id'] == $row['question_id'] && $rowoption['option_number'] == '3') {
                            $id_option3 = $rowoption['id_option'];
                        } elseif ($rowoption['question_id'] == $row['question_id'] && $rowoption['option_number'] == '4') {
                            $id_option4 = $rowoption['id_option'];
                        }
                    ?>

                    <button type="button" class="btn btn-info btn-sm" onclick="editQuestionOption('<?= $id_question_option ?>','<?= $id_option1 ?>','<?= $id_option2 ?>','<?= $id_option3 ?>','<?= $id_option4 ?>')">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteQuestionOption('<?= $id_question_option ?>')">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#examListQuestionOption').DataTable();
    });

    function editQuestionOption(id_question_option, id_option1, id_option2, id_option3, id_option4) {
        var exam_id = '<? $exam_id ?>'
        $.ajax({
            type: "post",
            url: "<?= site_url('exam/editQuestion') ?>",
            data: {
                id_question: id_question_option,
                id_option1: id_option1,
                id_option2: id_option2,
                id_option3: id_option3,
                id_option4: id_option4
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

    function deleteQuestionOption(a) {
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
                    url: "<?= site_url('exam/deleteQuestion') ?>",
                    data: {
                        id_question: a,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            })
                            examDetail();
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