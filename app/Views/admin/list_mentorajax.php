<table id="dataMentor" class="table table-bordered">
    <thead>
        <tr>
            <th>About</th>



            <th>level</th>

            <th>Skor Test</th>
            <th>Status</th>
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
                <td><?= $row['username'] ?><br><?= $row['name'] ?><br><?= $row['email'] ?><br><i><?= $row['address'] ?></i><br>Joined : <?= strftime("%d %b %Y", strtotime($row['created_at'])) ?></td>



                <?php
                $name_exam_based_level = '';
                if ($row['level_mentor'] == 0) {
                    $name_exam_based_level = 'Belum Ujian';
                } elseif ($row['level_mentor'] == 1) {
                    $name_exam_based_level = 'SD';
                } elseif ($row['level_mentor'] == 2) {
                    $name_exam_based_level = 'SD-SMP';
                } else {
                    $name_exam_based_level = 'SD-SMA';
                } ?>

                <td><?= $name_exam_based_level ?></td>


                <td><?php foreach ($list_score as $score) {
                        if ($score['username'] == $row['username']) {
                    ?>
                            <?= $score['name'] ?>
                            : <?= $score['score'] ?><br>
                    <?php
                        }
                    } ?>
                </td>
                <td>ID : <button type="button" class="btn btn-info btn-sm" onclick="showIdentity('<?= $username_mentor ?>')"><i class="fa fa-eye"></i></button><br><br><br> <br> Active</td>
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

    function showIdentity(username) {
        $.ajax({
            type: "post",
            url: "<?= site_url('profile/showIdentity') ?>",
            data: {
                username: username,
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewModal').html(response.sukses).show();
                    $('#modalEdit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
</script>