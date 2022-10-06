<table id="dataMentor" class="table table-bordered">
    <thead>
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Address</th>
            <th>email</th>
            <th>joined</th>
            <th>Action</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($list_student as $row) {
            $username_siswa = $row['username'];
        ?>
            <tr>
                <td><?= $row['username'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['address'] ?></a></td>
                <td><?= $row['email'] ?></td>
                <td><?= strftime("%a %d %b %Y", strtotime($row['created_at'])) ?></td>
                <td> <a href="<?= base_url("logbook/listMentorFromStudent/$username_siswa"); ?>"><button type="button" class="btn btn-info btn-sm">
                            <i class="fa fa-address-book"></i>
                        </button></a>
                    <button type="button" class="btn btn-info btn-sm " onclick="showAllLogbook('<?= $username_siswa ?>')"><i class="fa fa-book"></i> </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table><br><br>
<script>
    $(document).ready(function() {
        $('#dataMentor').DataTable();

    });

    function showAllLogbook(username_siswa) {
        $.ajax({
            type: "post",
            url: "<?= site_url('logbook/showAllLogbook') ?>",
            data: {
                username_siswa: username_siswa
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewModal').html(response.sukses).show();
                    $('#modaltambah').modal('show');

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
</script>