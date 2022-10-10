<table id="dataSiswa" class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
            <th>Kelas</th>
            <th>Action</th>
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
                <td><?= $row['email'] ?></td>
                <td><?= $row['kelas'] ?></td>
                <td>
                    <a href="<?= base_url("logbook/details/$username_siswa"); ?>"><button type="button" class="btn btn-info btn-sm">
                            <i class="fa fa-address-book"></i>
                        </button></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dataSiswa').DataTable();
    });
</script>