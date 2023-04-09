<table id="dataCourse" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Course</th>
            <th>Name Course</th>
            <th>Soal</th>
            <th>Action</th>

        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($list_course as $row) {
            $id_course = $row['id_course'];

        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['id_course'] ?></td>
                <td><?= $row['name_course'] ?></td>

                <td> <a href="<?= base_url("exam/list2/$id_course"); ?>"><button type="button" class="btn btn-info btn-sm">
                            <i class="fa fa-address-book"></i>
                        </button></a></td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" onclick="editCourse('<?= $id_course ?>')">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteCourse('<?= $id_course ?>','<?= $row['name_course'] ?>')">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table><br><br>
<script>
    $(document).ready(function() {
        $('#dataCourse').DataTable();

    });

    function editCourse(id_course) {
        $.ajax({
            type: "post",
            url: "<?= site_url('exam/editCourse') ?>",
            data: {
                id_course: id_course
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

    function deleteCourse(a, b) {
        Swal.fire({
            title: 'Hapus',
            text: `Apakah anda yakin menghapus mata pelajaran ${b} ?`,
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
                    url: "<?= site_url('exam/deleteCourse') ?>",
                    data: {
                        id_course: a,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            })
                            listCourseByAdmin();
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