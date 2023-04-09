<table id="dataMentored" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Pertemuan</th>
            <th>Siswa</th>
            <th>Topik</th>
            <th>Status Mentoring</th>
            <th>Aksi</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($mentoring as $row) {
            $username_siswa = $row['username'];
            $pp = "";
            if (is_null($row['profile_picture'])) {
                $pp = "default.jpg";
            } else {
                $pp = $row['profile_picture'];
            }
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?php
                    $dateExplode = explode(",", $row['date_started']);
                    foreach ($dateExplode as $dateExplode2) {
                        echo strftime("%a, %d %b %Y", strtotime($dateExplode2)) . '<br/>';
                    }
                    ?>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="image">
                            <img src="<?= base_url() ?>/file/profile/<?= $pp ?>" class="rounded-circle" width="100" height="100" />
                        </div>
                        <div class="ml-3 w-100">
                            <h6 class="mb-0 mt-0"><i class="fa fa-id-card-o" style="margin-right: 5%;"></i> <b><?= $row['name'] ?></b></h6>
                            <?php
                            $kelas = '';
                            if ($row['kelas'] <= 6) {
                                $kelas =   '<span class="badge bg-danger">' . $row['kelas'] . ' SD</span>';
                            } elseif ($row['kelas'] > 6 && $row['kelas'] <= 10) {
                                $kelas = '<span class="badge bg-primary">' . $row['kelas'] - 6 . ' SMP</span>';
                            } else {
                                $kelas = '<span class="badge bg-secondary">' . $row['kelas'] - 9 . ' SMA</span>';
                            }
                            ?>
                            <span class="mb-0 mt-0"><i class="fa fa-graduation-cap" style="margin-right: 5%;"></i><?= $kelas ?></span><br>

                            <div class="p-2 mt-2  d-flex justify-content-between rounded stats">
                                <div class="social">
                                    <button type="button" style="border-radius: 50px;" class="btn btn-success btn-sm" onclick="showLocation('<?= $row['latitude'] ?>','<?= $row['longitude'] ?>','<?= $row['username_siswa'] ?>','<?= $row['address'] ?>')">
                                        <i class="fa fa-map"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </td>

                <!-- <td><?= strftime("%a %d %b %Y", strtotime($row['date_started'])) ?></td> -->
                <td><?= $row['topic']; ?>:<br><?= $row['description']; ?></td>
                <td><?php
                    if ($row['status_mentoring'] == '0') {
                        echo '<span class="badge bg-warning">Proses Mentoring</span>';
                    } else {
                        echo '<span class="badge bg-success">Selesai</span>';
                    }
                    ?>
                </td>

                <td>
                    <?php $dataedit = $row['id_request_mentor']; ?>
                    <button type="button" class="btn btn-info btn-sm" onclick="showLogbook('<?= $dataedit ?>','<?= $row['username_siswa'] ?>')">
                        <i class="fa fa-book"></i>
                    </button>
            </tr>
        <?php } ?>
    </tbody>
</table><br><br>

<script>
    var username_mentor = '<?= $username_mentor ?>';
    $(document).ready(function() {
        $('#dataMentored').DataTable();

    });

    function showLogbook(id_request, username_siswa) {
        $.ajax({
            type: "post",
            url: "<?= site_url('logbook/showLogbookStudent') ?>",
            data: {
                id_request_mentor: id_request,
                username_siswa: username_siswa,
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