<table id="dataMentored" class="table table-bordered">
    <thead>
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>alamat</th>
            <th>action</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($list_mentored_student as $row) {
            $username_siswa = $row['username']
        ?>
            <tr>
                <td><?= $row['username'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['address'] ?></td>
                <td> <button type="button" class="btn btn-primary btn-sm " onclick="showLogbook('<?= $username_siswa ?>')"><i class="fa fa-book"></i> </button></a></td>

            </tr>
        <?php } ?>
    </tbody>
</table><br><br>

<script>
    var username_mentor = '<?= $username_mentor ?>';
    $(document).ready(function() {
        $('#dataMentored').DataTable();

    });

    function showLogbook(username_siswa) {
        $.ajax({
            type: "post",
            url: "<?= site_url('logbook/showLogbookByMentor') ?>",
            data: {
                username_mentor: username_mentor,
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