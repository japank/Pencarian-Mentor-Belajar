<!-- Button trigger modal
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pertanyaan <?php foreach ($exam_detail as $row) ?>
                    <i>"<?= $row ?>"</i>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open('exam/process/' . $exam_id, ['class' => 'formQuestion']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">

                <input type="hidden" class="form-control" id="username_mentor" name="username_mentor" value="<?= session()->get('username'); ?>" readonly="">

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Question</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="question_title" name="question_title">
                        <div class="invalid-feedback errorQuestiontitle">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Option 1</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="option1" name="option1">
                        <div class="invalid-feedback errorOption1">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Option 2</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="option2" name="option2">
                        <div class="invalid-feedback errorOption2">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Option3 </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="option3" name="option3">
                        <div class="invalid-feedback errorOption3">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Option 4</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="option4" name="option4">
                        <div class="invalid-feedback errorOption4">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Correct Answer</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="correct_answer" name="correct_answer" value="1">
                            <label class="form-check-label" for="">Option 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="correct_answer" name="correct_answer" value="2">
                            <label class="form-check-label" for="option2">Option 2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="correct_answer" name="correct_answer" value="3">
                            <label class="form-check-label" for="option3">Option 3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="correct_answer" name="correct_answer" value="4">
                            <label class="form-check-label" for="option4">Option 4</label>
                        </div>
                        <!-- <input type="text" class="form-control" id="correct_answer" name="correct_answer">
                        <div class="invalid-feedback errorCorrectanswer"> -->

                        <!-- </div> -->
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
        $('.formQuestion').submit(function(e) {
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
                        if (response.error.question_title) {
                            $('#question_title').addClass('is-invalid');
                            $('.errorQuestiontitle').html(response.error.question_title);
                        } else {
                            $('#question_title').removeClass('is-invalid');
                            $('.errorQuestiontitle').html('');
                        }

                        if (response.error.option1) {
                            $('#option1').addClass('is-invalid');
                            $('.errorOption1').html(response.error.option1);
                        } else {
                            $('#option1').removeClass('is-invalid');
                            $('.errorOption1').html('');
                        }

                        if (response.error.option2) {
                            $('#option2').addClass('is-invalid');
                            $('.errorOption2').html(response.error.option2);
                        } else {
                            $('#option2').removeClass('is-invalid');
                            $('.errorOption2').html('');
                        }

                        if (response.error.option3) {
                            $('#option3').addClass('is-invalid');
                            $('.errorOption3').html(response.error.option3);
                        } else {
                            $('#option3').removeClass('is-invalid');
                            $('.errorOption3').html('');
                        }
                        if (response.error.option4) {
                            $('#option4').addClass('is-invalid');
                            $('.errorOption4').html(response.error.option4);
                        } else {
                            $('#option4').removeClass('is-invalid');
                            $('.errorOption4').html('');
                        }
                        if (response.error.correct_answer) {
                            $('#correct_answer').addClass('is-invalid');
                            $('.errorCorrectAnswer').html(response.error.correct_answer);
                        } else {
                            $('#correct_answer').removeClass('is-invalid');
                            $('.errorCorrectanswer').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        })

                        $('#modaltambah').modal('hide');
                        examDetail();

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