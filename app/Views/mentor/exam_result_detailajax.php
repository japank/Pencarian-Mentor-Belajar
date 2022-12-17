<table id="dataExamResultDetail" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Soal</th>
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
        foreach ($exam_result as $row) {
            $exam_id = $row['exam_id'];
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <p class="text-justify h5 pb-2 font-weight-bold" style="font-size: large;"><?= $row['question_title'] ?></p>
                    <div class="options py-3">
                        <?php foreach ($option as $rowoption) if ($rowoption['question_id'] == $row['question_id']) : ?>
                            <label class="rounded p-2 option">
                                <?php
                                $huruf = '';
                                if ($rowoption['option_number'] == 1) {
                                    $huruf = 'A';
                                } elseif ($rowoption['option_number'] == 2) {
                                    $huruf = 'B';
                                } elseif ($rowoption['option_number'] == 3) {
                                    $huruf = 'C';
                                } elseif ($rowoption['option_number'] == 4) {
                                    $huruf = 'D';
                                }

                                $benar = "";
                                if ($rowoption['question_id'] == $row['question_id'] && $rowoption['option_number'] == $row['answer_option']) :
                                    $benar = '<span class="badge bg-success rounded">Correct Answer</span>';
                                endif;

                                $marks = '';
                                $user_answer = "";
                                if ($rowoption['option_number'] == $row['user_answer_option'] && $rowoption['question_id'] == $row['question_id']) {
                                    if ($row['marks'] > 0) {
                                        $marks = '<span class="badge bg-success rounded">+' . $row['marks'] . '</span>';
                                    } else {
                                        $marks = '<span class="badge bg-danger rounded">' . $row['marks'] . '</span>';
                                    }
                                    $user_answer = '<span class="badge bg-primary rounded" style="margin-right:1%">Jawaban Anda  </span>' . $marks;
                                }
                                ?>
                                <?= $huruf ?> . <?= $rowoption['option_title'] ?>

                                <span><?= $benar ?></span>
                                <span><?= $user_answer ?></span>
                            </label>
                        <?php endif; ?>
                    </div>

                </td>


            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dataExamResultDetail').DataTable();

    })
</script>