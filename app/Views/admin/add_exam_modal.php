<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Exam</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open('exam/addingExam', ['class' => 'formExam']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">

                <input type="hidden" class="form-control" id="username_mentor" name="username_mentor" value="<?= session()->get('username'); ?>" readonly="">

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="name" name="name">
                        <div class="invalid-feedback errorName">

                        </div>
                    </div>
                    <!-- </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Level</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="level" name="level">
                        <div class="invalid-feedback errorLevel">

                        </div>
                    </div>
                </div> -->
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Level</label>
                        <div class="col-sm-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="level" name="level" value="1">
                                <label class="form-check-label" for="">SD</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="level" name="level" value="2">
                                <label class="form-check-label" for="">SMP</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="level" name="level" value="3">
                                <label class="form-check-label" for="">SMA</label>
                            </div>
                            <div class="invalid-feedback errorLevel">

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Point per 1 jawaban benar</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="marks_per_right_answer" name="marks_per_right_answer">
                            <div class="invalid-feedback errorMarksRight">

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Point per 1 jawaban salah </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="marks_per_wrong_answer" name="marks_per_wrong_answer">
                            <div class="invalid-feedback errorMarksWrong">

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Skor minimal kelulusan </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="pass_score" name="pass_score">
                            <div class="invalid-feedback errorPassScore">

                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Waktu <br><i>(dalam menit)</i></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="time" name="time">
                            <div class="invalid-feedback errorTime">

                            </div>
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
                            if (response.error.name) {
                                $('#name').addClass('is-invalid');
                                $('.errorName').html(response.error.name);
                            } else {
                                $('#name').removeClass('is-invalid');
                                $('.errorName').html('');
                            }

                            if (response.error.level) {
                                $('#level').addClass('is-invalid');
                                $('.errorLevel').html(response.error.level);
                            } else {
                                $('#level').removeClass('is-invalid');
                                $('.errorLevel').html('');
                            }

                            if (response.error.marks_per_right_answer) {
                                $('#marks_per_right_answer').addClass('is-invalid');
                                $('.errorMarksRight').html(response.error.marks_per_right_answer);
                            } else {
                                $('#marks_per_right_answer').removeClass('is-invalid');
                                $('.errorMarksRight').html('');
                            }

                            if (response.error.marks_per_wrong_answer) {
                                $('#marks_per_wrong_answer').addClass('is-invalid');
                                $('.errorMarksWrong').html(response.error.marks_per_wrong_answer);
                            } else {
                                $('#marks_per_wrong_answer').removeClass('is-invalid');
                                $('.errorMarksWrong').html('');
                            }

                            if (response.error.pass_score) {
                                $('#pass_score').addClass('is-invalid');
                                $('.errorPassScore').html(response.error.pass_score);
                            } else {
                                $('#pass_score').removeClass('is-invalid');
                                $('.errorPassScore').html('');
                            }

                            if (response.error.time) {
                                $('#time').addClass('is-invalid');
                                $('.errorTime').html(response.error.time);
                            } else {
                                $('#time').removeClass('is-invalid');
                                $('.errorTime').html('');
                            }

                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            })

                            $('#modaltambah').modal('hide');
                            listExamByAdmin();

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