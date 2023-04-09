<table id="dataExam" class="table table-bordered">
    <thead>
        <tr>
            <!-- <th>Exam Id</th> -->
            <th>No</th>
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
                <td><?= $no++ ?></td>
                <!-- <td><?= $row['exam_id'] ?></td> -->
                <td><?= $row['exam_name'] ?></td>
                <?php
                $name_exam_based_level = '';
                $level_exam = '';
                if ($row['level'] == 1) {
                    $name_exam_based_level = '<span class="badge bg-danger rounded">SD</span>';
                    $level_exam = $row['level'] + 5;
                } elseif ($row['level'] == 2) {
                    $name_exam_based_level = '<span class="badge bg-primary rounded">SMP</span>';
                    $level_exam = $row['level'] + 7;
                } else {
                    $name_exam_based_level = '<span class="badge bg-secondary rounded">SMA</span>';
                    $level_exam = $row['level'] + 9;
                } ?>

                <td><?= $name_exam_based_level ?></td>

                <td><span class="badge bg-success rounded">+ <?= $row['marks_per_right_answer'] ?></span></td>
                <td><span class="badge bg-danger rounded">- <?= $row['marks_per_wrong_answer'] ?></span></td>
                <td><?= $row['time'] ?> menit</td>

                <?php
                $passornot = '';
                if ($users_detail->kelas >= $level_exam) {
                    $passornot = '<a href="' . base_url("exam/started/$exam_id") . '" id="' . $exam_id . '">Mulai';
                } else {
                    $passornot = 'Syarat tak terpenuhi';
                } ?>

                <td><?= $passornot ?></td>


            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dataExam').DataTable();

    })
</script>