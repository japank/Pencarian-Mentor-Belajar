<table id="dataExamResult" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Username Mentor</th>
            <th>Test</th>
            <th>Skor Akhir</th>
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

            $passornot = '';
            if ($row['score'] >= $row['pass_score']) {
                $passornot = '<span class="badge bg-success rounded style="margin-left:3%">Lulus</span>';
            } else {
                $passornot = '<span class="badge bg-danger rounded style="margin-left:3%"">Gagal</span>';
            }
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['exam_name']; ?> <br><?= $level ?></td>
                <td> <?= $row['score']; ?> <?= $passornot ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dataExamResult').DataTable();

    })
</script>