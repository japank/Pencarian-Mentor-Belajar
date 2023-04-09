<table id="dataExamResult" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
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
                <td><?= $row['exam_name'] ?></td>
                <td><?= $level ?></td>
                <td><span class="badge bg-success rounded">+ <?= $row['marks_per_right_answer'] ?></span></td>
                <td><span class="badge bg-danger rounded">- <?= $row['marks_per_wrong_answer'] ?></span></td>
                <td><span class="badge bg-success rounded"> <?= $row['status'] ?></span></td>
                <td><a href="<?= base_url("exam/resultdetail/$exam_id"); ?>" id="<?= $exam_id ?>">Lihat hasil</td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dataExamResult').DataTable();

    })
</script>