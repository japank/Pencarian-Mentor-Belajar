<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet" />

<table class="table table-bordered" id="dataRequestList">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Pertemuan</th>
            <th>Mentor</th>
            <th>Mata Pelajaran</th>
            <th>Status Permintaan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($requestMentorList as $row) {

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
                    <!-- <strong><?= $row['username_mentor']; ?></strong><br>
                    <span><?= number_format((float)$row['jarak_km'], 2, '.', ''); ?> km</span>
                    <br>
                    <a onclick="showLocation('<?= $row['latitude'] ?>','<?= $row['longitude'] ?>','<?= $row['username_mentor'] ?>','<?= $row['address'] ?>')"><i class="ri-treasure-map-fill"></i></a> -->

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
                    <?php
                    if ($row['status_request'] == '2') {
                    ?>
                        <button type="button" class="btn btn-info btn-sm" onclick="editRequestMentor('<?= $dataedit ?>','<?= $row['username_mentor']; ?>')">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteRequestMentor('<?= $dataedit ?>')">
                            <i class="fa fa-trash"></i>
                        </button>

                    <?php } else {
                        echo "-";
                    }
                    ?>
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

    function editRequestMentor(dataedit, username_mentor) {
        $.ajax({
            type: "post",
            url: "<?= site_url('mentor/editRequestMentor') ?>",
            data: {
                id_request_mentor: dataedit,
                username_mentor: username_mentor
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

    function deleteRequestMentor(a) {
        Swal.fire({
            title: 'Hapus',
            text: `Apakah anda yakin menghapus permintaan metoring dengan id ${a} ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('mentor/deleteRequestMentor') ?>",
                    data: {
                        id_request_mentor: a,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            })
                            requestMentorList();
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            }
        })
    }
</script>