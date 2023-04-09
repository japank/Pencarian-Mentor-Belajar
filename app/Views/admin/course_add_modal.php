<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open('exam/addingCourse', ['class' => 'formExam']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Name Mata Pelajaran</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name_course" name="name_course">
                        <div class="invalid-feedback errorNameCourse">

                        </div>
                    </div>
                </div>



                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnsimpan">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.formExam').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $('.btnsimpan').attr('disable', 'disabled');
                        $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                    },
                    complete: function() {
                        $('.btnsimpan').removeAttr('disable', 'disabled');
                        $('.btnsimpan').html('Tersimpan');

                    },
                    success: function(response) {
                        if (response.error) {
                            if (response.error.name_course) {
                                $('#name_course').addClass('is-invalid');
                                $('.errorNameCourse').html(response.error.name_course);
                            } else {
                                $('#name_course').removeClass('is-invalid');
                                $('.errorNameCourse').html('');
                            }

                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            })

                            $('#modaltambah').modal('hide');
                            listCourseByAdmin();

                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            });
            return false;
        })
    </script>