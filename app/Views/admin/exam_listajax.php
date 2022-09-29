<table id="dataExam" class="table table-bordered">
    <thead>
        <tr>
            <th>Exam Id</th>
            <th>Name</th>
            <th>Level</th>
            <th>marks right</th>
            <th>marks wrong</th>
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
                <td><a href="<?= base_url("exam/detail/$exam_id"); ?>" id="<?= $exam_id ?>">Detail</td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dataExam').DataTable();

    })
</script>