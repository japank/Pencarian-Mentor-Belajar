                            <table class="table table-bordered" id="dataRequestList">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto siswa</th>
                                        <th>Detail Siswa</th>
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
                                        } ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td>

                                                <img src="<?= base_url() ?>/file/profile/<?= $pp ?>" class="rounded-circle" width="80" height="80" />

                                            </td>
                                            <td>
                                                <b><?= $row['username_siswa']; ?></b><br>
                                                <span><?= number_format((float)$jrk->jarak_km, 2, '.', ''); ?> km</span>
                                                <br>
                                                <i><?= $row['address']; ?></i>

                                            </td>
                                            <td><?php
                                                $dateExplode = explode(",", $row['date_started']);
                                                foreach ($dateExplode as $dateExplode2) {
                                                    echo strftime("%a, %d %b %Y", strtotime($dateExplode2)) . '<br/>';
                                                }
                                                ?>
                                            </td>

                                            <!-- <td><?= strftime("%a %d %b %Y", strtotime($row['date_started'])) ?></td> -->
                                            <td><?= $row['topic']; ?>:<br><?= $row['description']; ?></td>
                                            <td><?php
                                                if ($row['status_request'] == '2') {
                                                    echo '<span class="btn btn-warning">Menunggu Verifikasi</span>';
                                                } elseif ($row['status_request'] == '1') {
                                                    echo '<span style="color: white;" class="btn btn-success">Diterima</span>';
                                                } else {
                                                    echo '<span style="color: white;" class="btn btn-danger">Ditolak</span>';
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
                            </script>