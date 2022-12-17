<table id="dataMentored" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>About Student</th>
            <th>Action</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($list_mentored_student as $row) {
            $username_siswa = $row['username'];
            $pp = "";
            if (is_null($row['profile_picture'])) {
                $pp = "default.jpg";
            } else {
                $pp = $row['profile_picture'];
            }
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <style>
                        body {

                            background-color: #B3E5FC;
                            border-radius: 10px;

                        }


                        .card {
                            width: 400px;
                            border: none;
                            border-radius: 10px;

                            background-color: #fff;
                        }



                        .stats {

                            background: #f2f5f8 !important;

                            color: #000 !important;
                        }

                        .articles {
                            font-size: 10px;
                            color: #a1aab9;
                        }

                        .number1 {
                            font-weight: 500;
                        }

                        .followers {
                            font-size: 10px;
                            color: #a1aab9;

                        }

                        .number2 {
                            font-weight: 500;
                        }

                        .rating {
                            font-size: 10px;
                            color: #a1aab9;
                        }

                        .number3 {
                            font-weight: 500;
                        }
                    </style>
                    <div class="d-flex align-items-center">
                        <div class="image">
                            <img src="<?= base_url() ?>/file/profile/<?= $pp ?>" class="rounded" width="155" height="155">
                        </div>
                        <div class="ml-3 w-100">
                            <h6 class="mb-0 mt-0"> <?= $row['name'] ?></h6>
                            <span> <?= $row['username'] ?></span><br>
                            <span> <?= $row['email'] ?></span>
                            <div class="p-2 mt-2  d-flex justify-content-between rounded stats">
                                <span style="font-size: small;"> <?= $row['address'] ?></span>
                            </div>
                        </div>
                    </div>
                </td>
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