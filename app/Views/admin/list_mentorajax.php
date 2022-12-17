<table id="dataMentor" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>

            <th>About Mentor</th>



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
                <!-- <td>
                    <img src="<?= base_url() ?>/file/profile/<?= $pp ?>" class="rounded-circle" width="80" height="80" />
                </td>
                <td>
                    <b> <?= $row['username'] ?></b><br><?= $row['name'] ?><br><?= $row['email'] ?><br><i><?= $row['address'] ?></i><br>Joined : <?= strftime("%d %b %Y", strtotime($row['created_at'])) ?>
                </td> -->



                <?php
                $name_exam_based_level = '';
                if ($row['level_mentor'] == 0) {
                    $name_exam_based_level = '<span class="badge bg-warning rounded">Belum Ujian</span>';
                } elseif ($row['level_mentor'] == 1) {
                    $name_exam_based_level = '<span class="badge bg-danger rounded">SD</span>';
                } elseif ($row['level_mentor'] == 2) {
                    $name_exam_based_level = '<span class="badge bg-primary rounded">SD-SMP</span>';
                } else {
                    $name_exam_based_level = '<span class="badge bg-secondary rounded">SD-SMA</span>';
                } ?>

                <td><?= $name_exam_based_level ?></td>


                <td><?php foreach ($list_score as $score) {
                        if ($score['username'] == $row['username']) {
                    ?>
                            <span class="badge bg-info rounded">
                                <?= $score['name'] ?>
                                : <?= $score['score'] ?><br>
                            </span>
                    <?php
                        }
                    } ?>
                </td>
                <?php
                $status = '';
                if ($row['status_verified'] == 0) {
                    $status = '<span class="badge bg-warning rounded">Belum Diverifikasi</span>';
                } elseif ($row['status_verified'] == 1) {
                    $status = '<span class="badge bg-success rounded">Diterima</span>';
                } else {
                    $status = '<span class="badge bg-danger rounded">Ditolak</span>';
                } ?>
                <td>ID : <button type="button" class="btn btn-info btn-sm" onclick="showIdentity('<?= $username_mentor ?>')"><i class="fa fa-eye"></i></button><br><br><?= $status ?> <br> </td>
                <td> <a href="<?= base_url("logbook/mentoredStudent/$username_mentor"); ?>"><button type="button" class="btn btn-info btn-sm">
                            <i class="fa fa-address-book"></i> Daftar siswa
                        </button></a> <br><br>
                    <button type="button" class="btn btn-info btn-sm " onclick="showAllLogbookFromMentor('<?= $username_mentor ?>')"><i class="fa fa-book"></i>Logbook </button> <br><br>
                    <button type="button" class="btn btn-info btn-sm " onclick="verifyMentor('<?= $username_mentor ?>')"><i class="fa fa-question"></i>Verifikasi </button>

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

    function verifyMentor(username) {
        Swal.fire({
            title: 'Persetujuan',
            text: `Setujui Mentor ?`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('mentor/accMentor') ?>",
                    data: {
                        username_mentor: username,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            })
                            listMentor();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            } else {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('mentor/decMentor') ?>",
                    data: {
                        username_mentor: username,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            })
                        }
                        listMentor();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            }
        })
    }
</script>