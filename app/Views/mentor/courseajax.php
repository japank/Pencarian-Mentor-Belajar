<table id="dataExam" class="table table-bordered">
    <thead>
        <tr>
            <!-- <th>Exam Id</th> -->
            <th>No</th>
            <th>Name</th>
            <th>Aksi</th>
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
                <td><?= $row['name_course'] ?></td>
                <td> <a href="<?= base_url("exam/examlist/$id_course"); ?>"><button type="button" class="btn btn-info btn-sm">
                            <i class="fa fa-address-book"></i>
                        </button></a></td>



            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dataExam').DataTable();

    })
</script>