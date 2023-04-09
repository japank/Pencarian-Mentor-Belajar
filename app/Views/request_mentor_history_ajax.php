<table class="table table-bordered" id="dataRequestList">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Pertemuan</th>
            <th>Mentor</th>
            <th>Mata Pelajaran</th>
            <th>Status Mentoring</th>
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
            }
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?php
                    $dateExplode = explode(",", $row['date_started']);
                    foreach ($dateExplode as $dateExplode2) {
                        echo strftime("%A, %d %b %Y", strtotime($dateExplode2)) . '<br/>';
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
                            <h6 class="mb-0 mt-0"><i class="fa fa-id-card-o" style="margin-right: 5%;"></i> <strong><?= $row['name'] ?></strong></h6>
                            <span><i class="fa fa-map-marker" style="margin-right: 10%;margin-left:2%;"></i><?= number_format((float)$row['jarak_km'], 2, '.', ''); ?> km</span>
                            <div class="p-2 mt-2  d-flex justify-content-between rounded stats">
                                <div class="social">
                                    <button type="button" style="border-radius: 50px;" class="btn btn-success btn-sm" onclick="showLocation('<?= $row['latitude'] ?>','<?= $row['longitude'] ?>','<?= $row['username_mentor'] ?>','<?= $row['address'] ?>')">
                                        <i class="fa fa-map"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <img src="<?= base_url() ?>/file/profile/<?= $pp ?>" class="rounded-circle" width="80" height="80" />
                </td>
                <td>
                    <strong><?= $row['username_mentor']; ?></strong><br>
                    <span><?= number_format((float)$jrk->jarak_km, 2, '.', ''); ?> km</span>
                    <br>
                    <i><?= $row['address']; ?></i> -->

                </td>


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
                    <button type="button" class="btn btn-info btn-sm" onclick="showLogbook('<?= $dataedit ?>','<?= $row['username_mentor'] ?>')">
                        <i class="fa fa-book"></i>
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

    function showLogbook(id_request, username_mentor) {
        $.ajax({
            type: "post",
            url: "<?= site_url('logbook/showLogbookStudent') ?>",
            data: {
                id_request_mentor: id_request,
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