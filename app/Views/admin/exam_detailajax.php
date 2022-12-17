<table id="examListQuestionOption" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Question</th>
            <th>action</th>

        </tr>
    </thead>


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background: #eee;
        }

        .wrapper {
            max-width: 600px;
            margin: 20px auto;
        }

        .content {
            padding: 20px;
            padding-bottom: 50px;
        }

        a:hover {
            text-decoration: none;
        }

        /* a,
        span {
            font-size: 15px;
            font-weight: 600;
            color: rgb(50, 141, 245);
            padding-bottom: 30px;
        } */

        p.text-muted {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
        }

        b {
            font-size: 15px;
            font-weight: bolder;
        }

        .option {
            display: block;
            height: 50px;
            background-color: #f4f4f4;
            position: relative;
            width: 100%;
        }

        .option:hover {
            background-color: #e8e8e8;
            cursor: pointer;
        }

        .option input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark,
        .crossmark {
            position: absolute;
            top: 10px;
            right: 10px;
            height: 22px;
            width: 22px;
            background-color: #f4f4f4;
            border-radius: 2px;
            padding: 0;
        }

        .option:hover input~.checkmark,
        .option:hover input~.crossmark {
            background-color: #e8e8e8;
        }

        .option input:checked~.checkmark {
            background-color: #79d70f;
        }

        .option input:checked~.crossmark {
            background-color: #ec3838;
        }

        .checkmark:after,
        .crossmark:after {
            content: "\2714";
            position: absolute;
            background-color: #79d70f;
            display: none;
            color: #fff;
            padding-left: 4px;
            width: 22px;
            font-size: 16px;
        }

        p.mb-4 {
            border-left: 3px solid green;
        }

        p.my-2 {
            border-left: 3px solid red;
        }
    </style>
    <tbody>
        <?php
        $no = 1;
        foreach ($exam_detail as $row) {
            $id_question_option = $row['question_id'];
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <!-- <td><?= $row['question_id'] ?></td> -->

                <td>
                    <p class="text-justify h5 pb-2 font-weight-bold" style="font-size: large;"><?= $row['question_title'] ?></p>
                    <div class="options py-3">
                        <?php foreach ($option as $rowoption) if ($rowoption['question_id'] == $row['question_id']) : ?>
                            <label class="rounded p-2 option">
                                <?php $huruf = '';
                                if ($rowoption['option_number'] == 1) {
                                    $huruf = 'A';
                                } elseif ($rowoption['option_number'] == 2) {
                                    $huruf = 'B';
                                } elseif ($rowoption['option_number'] == 3) {
                                    $huruf = 'C';
                                } elseif ($rowoption['option_number'] == 4) {
                                    $huruf = 'D';
                                }
                                ?>
                                <?php
                                $benar = "";
                                if ($rowoption['question_id'] == $row['question_id'] && $rowoption['option_number'] == $row['answer_option']) :
                                    $benar = '<span class="badge bg-success rounded">Correct Answer</span>';
                                endif; ?>
                                <?= $huruf ?> . <?= $rowoption['option_title'] ?>

                                <span><?= $benar ?></span>
                            </label>
                        <?php endif; ?>
                    </div>

                </td>

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