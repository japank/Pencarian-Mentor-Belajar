<table id="dataMentor" class="table table-bordered">
    <thead>
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Address</th>
            <th>email</th>
            <th>joined</th>
            <th>Status</th>
            <th>Skor Test</th>
            <th>Action</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($list_mentor as $row) {
            $username_mentor = $row['username'];
        ?>
            <tr>
                <td><?= $row['username'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['address'] ?></a></td>
                <td><?= $row['email'] ?></td>
                <td><?= strftime("%a %d %b %Y", strtotime($row['created_at'])) ?></td>
                <td>Not verifed Id</td>
                <td>90(v)</td>
                <td> <a href="<?= base_url("logbook/mentoredStudent/$username_mentor"); ?>"><button type="button" class="btn btn-info btn-sm">
                            <i class="fa fa-address-book"></i>
                        </button></a>
                    <button type="button" class="btn btn-info btn-sm " onclick="showAllLogbookFromMentor('<?= $username_mentor ?>')"><i class="fa fa-book"></i> </button>
                </td>

            </tr>
        <?php } ?>
    </tbody>
</table><br><br>
<script>
    $(document).ready(function() {
        $('#dataMentor').DataTable();

    });

    function showAllLogbookFromMentor(username_mentor) {
        $.ajax({
            type: "post",
            url: "<?= site_url('logbook/showAllLogbookFromMentor') ?>",
            data: {
                username_mentor: username_mentor
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