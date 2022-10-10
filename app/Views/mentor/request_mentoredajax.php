                            <table class="table table-bordered" id="dataRequestList">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Tanggal Pertemuan</th>
                                        <th>Topik</th>
                                        <th>Deskripsi Topik</th>
                                        <th>Status Permintaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($requestMentorList as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['username_siswa']; ?></td>
                                            <td><?= strftime("%a %d %b %Y", strtotime($row['date_started'])) ?></td>
                                            <td><?= $row['topic']; ?></td>
                                            <td><?= $row['description']; ?></td>
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