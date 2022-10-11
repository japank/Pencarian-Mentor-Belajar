<table id="dataExamResultDetail" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Question</th>
            <th>Option 1</th>
            <th>Option 2</th>
            <th>Option 3</th>
            <th>Option 4</th>
            <th>Answer</th>
            <th>Your Answer</th>
            <th>Marks</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($exam_result as $row) {
            $exam_id = $row['exam_id'];
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= substr($row['question_title'], 0, 70) ?></td>
                <?php foreach ($option as $rowoption) if ($rowoption['question_id'] == $row['question_id']) : ?>
                    <td> <?= $rowoption['option_title'] ?></td>
                <?php endif; ?>
                <?php foreach ($option as $rowoption) if ($rowoption['question_id'] == $row['question_id'] && $rowoption['option_number'] == $row['answer_option']) : ?>
                    <td> <?= $rowoption['option_title'] ?></td>
                <?php endif; ?>
                <?php foreach ($option as $rowoption) if ($rowoption['option_number'] == $row['user_answer_option'] && $rowoption['question_id'] == $row['question_id']) : ?>
                    <?php if ($row['user_answer_option'] == $row['answer_option']) { ?>
                        <td><a class="btn btn-success"> <?= $rowoption['option_title'] ?> <i class="fa fa-check"></i> </a></td>
                    <?php } else { ?>
                        <td><a class="btn btn-danger"> <?= $rowoption['option_title'] ?> <i class="fa fa-close"></i> </a></td>
                    <?php } ?>
                <?php endif; ?>
                <td> <?= $row['marks'] ?></td>

            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dataExamResultDetail').DataTable();

    })
</script>