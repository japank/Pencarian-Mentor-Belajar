<table class="table table-bordered" id="dataRequestList">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Pertemuan</th>
            <th>Siswa</th>
            <th>Topik</th>
            <th>Status Permintaan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($requestMentorList as $row) {
            foreach ($jarak as $jrk)
                $pp = "";
            if (is_null($row['profile_picture'])) {
                $pp = "default.jpg";
            } else {
                $pp = $row['profile_picture'];
            } ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?php
                    $dateExplode = explode(",", $row['date_started']);
                    foreach ($dateExplode as $dateExplode2) {
                        echo strftime("%a, %d %b %Y", strtotime($dateExplode2)) . '<br/>';
                    }
                    ?>
                    <strong><?= date('G:i', strtotime($row['time_mentoring'])) ?></strong>
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
                            <span><i class="fa fa-map-marker" style="margin-right: 10%;margin-left:2%;"></i><?= number_format((float)$row['jarak_km'], 2, '.', ''); ?> km</span>
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

                <td><?= $row['topic']; ?>:<br><?= $row['description']; ?></td>
                <td><?php
                    if ($row['status_request'] == '2') {
                        echo '<span class="badge bg-warning">Menunggu Verifikasi</span>';
                    } elseif ($row['status_request'] == '1') {
                        echo '<span class="badge bg-success">Diterima</span>';
                    } else {
                        echo '<span class="badge bg-danger">Ditolak</span>';
                    }
                    ?>
                <td>
                    <?php $dataedit = $row['id_request_mentor']; ?>
                    <button type="button" class="btn btn-success btn-sm" onclick="accRequestMentored('<?= $dataedit ?>')">
                        <i class="fa fa-check"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="decRequestMentored('<?= $dataedit ?>')">
                        <i class="fa fa-close"></i>
                    </button>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table><br><br>
<script>
    $(document).ready(function() {
        $('#dataRequestList').DataTable();

    });

    function accRequestMentored(dataedit) {
        $.ajax({
            type: "post",
            url: "<?= site_url('mentor/accRequestMentored') ?>",
            data: {
                id_request_mentor: dataedit
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.sukses,
                    })
                    requestMentoredList();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function decRequestMentored(dataedit) {
        $.ajax({
            type: "post",
            url: "<?= site_url('mentor/decRequestMentored') ?>",
            data: {
                id_request_mentor: dataedit
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.sukses,
                    })
                    requestMentoredList();
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