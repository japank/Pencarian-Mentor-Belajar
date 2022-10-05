<table id="dataMentor" class="table table-bordered">
    <thead>
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Address</th>
            <th>email</th>
            <th>joined</th>
            <th>Action</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($list_student as $row) {
            $username_siswa = $row['username'];
        ?>
            <tr>
                <td><?= $row['username'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['address'] ?></a></td>
                <td><?= $row['email'] ?></td>
                <td><?= strftime("%a %d %b %Y", strtotime($row['created_at'])) ?></td>
                <td> <a href="<?= base_url("logbook/listmentoredstudentbyadmin/$username_siswa"); ?>"><button type="button" class="btn btn-info btn-sm">
                            <i class="fa fa-book"></i>

                        </button></a>
                    <button type="button" class="btn btn-info btn-sm">
                        <i class="fa fa-address-book"></i>
                        <!-- list request mentor -->
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table><br><br>
<script>
    $(document).ready(function() {
        $('#dataMentor').DataTable();

    });

    function editExam(exam_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('exam/editExam') ?>",
            data: {
                exam_id: exam_id
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

    function deleteExam(a) {
        Swal.fire({
            title: 'Hapus',
            text: `Apakah anda yakin menghapus pertanyaan dengan id ${a} ?`,
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
                    url: "<?= site_url('exam/deleteExam') ?>",
                    data: {
                        exam_id: a,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            })
                            listExamByAdmin();
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