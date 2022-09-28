<table id="dataExamResult" class="table table-bordered">
    <thead>
        <tr>
            <th>Exam Id</th>
            <th>Exam Name</th>
            <th>Level</th>
            <th>marks right</th>
            <th>marks wrong</th>
            <th>status</th>
            <th>Action</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($exam_result as $row) {
            $exam_id = $row['exam_id'];
        ?>
            <tr>
                <td><?= $row['exam_id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['level'] ?></a></td>
                <td><?= $row['marks_per_right_answer'] ?></td>
                <td><?= $row['marks_per_wrong_answer'] ?></td>
                <td><?= $row['status'] ?></td>
                <td><a href="<?= base_url("exam/resultdetail/$exam_id"); ?>" id="<?= $exam_id ?>">LIHat hasil</td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dataExamResult').DataTable();

    })
</script>