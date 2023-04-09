<table id="dataMentor" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>About Student</th>

            <th>joined</th>
            <th>Action</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($list_student as $row) {
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

                            <h5 class="mb-0 mt-0"> <?= $row['name'] ?></h5>

                            <span><i class="fa fa-id-card-o" style="margin-right: 5%;"></i> <?= $row['username'] ?></span><br>
                            <span><i class="fa fa-envelope-o" style="margin-right: 5%;"></i> <?= $row['email'] ?></span><br>
                            <span><i class="fa fa-graduation-cap" style="margin-right: 5%;"></i><?= $row['kelas'] ?></span>
                            <div class="p-2 mt-2  d-flex justify-content-between rounded  stats">
                                <span style="font-size: small;" onclick="showLocation('<?= $row['latitude'] ?>','<?= $row['longitude'] ?>','<?= $row['username'] ?>','<?= $row['address'] ?>')"><i class="fa fa-map" style="margin-right: 5%;"></i> <?= $row['address'] ?></span>
                            </div>
                        </div>
                    </div>
                </td>
                <td><?= strftime("%a %d %b %Y", strtotime($row['created_at'])) ?></td>
                <td>
                    <!-- <a href="<?= base_url("logbook/listMentorFromStudent/$username_siswa"); ?>"><button type="button" class="btn btn-info btn-sm">
                            <i class="fa fa-address-book"></i>
                        </button></a> -->
                    <a href="<?= base_url("mentor/mentoringHistoryFromSiswa/$username_siswa"); ?>"><button type="button" class="btn btn-info btn-sm">
                            <i class="fa fa-address-book"></i> Mentoring
                        </button></a> <br><br>
                    <!-- <button type="button" class="btn btn-info btn-sm " onclick="showAllLogbook('<?= $username_siswa ?>')"><i class="fa fa-book"></i> </button> -->
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

    function showLocation(lat, long, name, address) {
        $.ajax({
            type: "post",
            url: "<?= site_url('users/showLocation') ?>",
            data: {
                lat: lat,
                long: long,
                name: name,
                address: address
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