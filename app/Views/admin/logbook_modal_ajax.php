<table id="dataExam" class="table table-bordered">
    <thead>
        <tr>
            <th>Exam Id</th>
            <th>Name</th>
            <th>Level</th>
        </tr>
    </thead>


    <tbody>
        <?php
        $no = 1;
        foreach ($logbook as $row) {

        ?>
            <tr>
                <td><?= $row['date_mentoring'] ?></td>
                <td><?= $row['topic'] ?></td>
                <td><?= $row['topic_description'] ?></a></td>

            </tr>
        <?php } ?>
    </tbody>
</table><br><br>
<script>
    $(document).ready(function() {
        $('#dataExam').DataTable();

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