<table id="dataSiswa" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Foto siswa</th>
            <th>Detail Siswa</th>
            <th>Action</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($listsiswa as $row) {
            $username_siswa = $row['username'];
            $pp = "";
            if (is_null($row['profile_picture'])) {
                $pp = "default.jpg";
            } else {
                $pp = $row['profile_picture'];
            } ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>

                    <img src="<?= base_url() ?>/file/profile/<?= $pp ?>" class="rounded-circle" width="80" height="80" />

                </td>
                <td>
                    <b><?= $row['name']; ?></b><br>
                    Kelas : <?= $row['kelas'] ?><br>
                    <i><?= $row['address']; ?></i>
                </td>
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