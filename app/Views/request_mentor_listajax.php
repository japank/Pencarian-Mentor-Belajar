                            <table class="table table-bordered" id="dataRequestList">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Detail Mentor</th>
                                        <th>Tanggal Pertemuan</th>
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
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td>

                                                <img src="<?= base_url() ?>/file/profile/<?= $pp ?>" class="rounded-circle" width="80" height="80" />

                                            </td>
                                            <td>
                                                <b><?= $row['username_mentor']; ?></b><br>
                                                <span><?= number_format((float)$jrk->jarak_km, 2, '.', ''); ?> km</span>
                                                <br>
                                                <i><?= $row['address']; ?></i>

                                            </td>

                                            <td><?php
                                                $dateExplode = explode(",", $row['date_started']);
                                                foreach ($dateExplode as $dateExplode2) {
                                                    echo strftime("%A, %d %b %Y", strtotime($dateExplode2)) . '<br/>';
                                                }
                                                ?>
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
                                                    <button type="button" class="btn btn-info btn-sm" onclick="editRequestMentor('<?= $dataedit ?>')">
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

                                function editRequestMentor(dataedit) {
                                    $.ajax({
                                        type: "post",
                                        url: "<?= site_url('mentor/editRequestMentor') ?>",
                                        data: {
                                            id_request_mentor: dataedit
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