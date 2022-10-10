                            <table class="table table-bordered" id="dataRequestList">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mentor</th>
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
                                            <td><?= $row['username_mentor']; ?></td>
                                            <td><?= strftime("%a %d %b %Y", strtotime($row['date_started'])) ?></td>
                                            <td><?= $row['topic']; ?></td>
                                            <td><?= $row['description']; ?></td>
                                            <td><?php
                                                if ($row['status_request'] == '2') {
                                                    echo 'Menunggu Verifikasi';
                                                } elseif ($row['status_request'] == '1') {
                                                    echo 'Diterima';
                                                } else {
                                                    echo 'Ditolak';
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