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
                <td><?= $row['name'] ?></td>
                <?php
                $name_exam_based_level = '';
                if ($row['level'] == 1) {
                    $name_exam_based_level = '<span class="badge bg-danger rounded">SD</span>';
                } elseif ($row['level'] == 2) {
                    $name_exam_based_level = '<span class="badge bg-primary rounded">SMP</span>';
                } else {
                    $name_exam_based_level = '<span class="badge bg-secondary rounded">SMA</span>';
                } ?>

                <td><?= $name_exam_based_level ?></td>
                <td><span class="badge bg-success rounded">+ <?= $row['marks_per_right_answer'] ?></span></td>
                <td><span class="badge bg-danger rounded">- <?= $row['marks_per_wrong_answer'] ?></span></td>
                <td><?= $row['time'] ?> menit</td>

                <?php
                foreach ($mentor_detail as $mentor_detail2)
                    $level_mentor = $mentor_detail2->level_mentor;
                $level_mentor = $level_mentor + 1;

                // $nameExam = 
                if ($level_mentor == $row['level']) {
                ?>
                    <td><a href="<?= base_url("exam/started/$exam_id"); ?>" id="<?= $exam_id ?>">Mulai</td>
                <?php } elseif ($level_mentor < $row['level']) { ?>
                    <td>Syarat tak terpenuhi <br> Selesaikan
                        <?php
                        $level_prev = $row['level'] - 1;
                        $name_exam_based_level_prev = '';
                        if ($level_prev == 1) {
                            $name_exam_based_level_prev = 'SD';
                        } elseif ($level_prev == 2) {
                            $name_exam_based_level_prev = 'SMP';
                        } else {
                            $name_exam_based_level_prev = 'SMA';
                        }
                        echo $name_exam_based_level_prev ?>
                    </td>
                <?php } else { ?>
                    <td>Selesai</td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dataExam').DataTable();

    })
</script>