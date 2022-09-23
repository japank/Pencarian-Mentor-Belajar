<table id="dataSiswa" class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($listsiswa as $row) {
            $username_siswa = $row['username']; ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['address'] ?></td>
                <td><a href="<?= base_url("logbook/details/$username_siswa"); ?>">Logbook</a></td>
                <td>a</td>
                <td>a</td>
                <td>a</td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dataSiswa').DataTable();
    });
</script>