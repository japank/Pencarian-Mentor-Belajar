<!-- Modal -->

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Exam <?= $dataRequestMentor->id_request_mentor ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open('mentor/updateRequestMentor/' . $dataRequestMentor->id_request_mentor, ['class' => 'formRequestMentor']) ?>
            <?= csrf_field(); ?>

            <div class="modal-body">


                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Tanggal Pertemuan</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control" id="date_started" name="date_started" value="<?= $dataRequestMentor->date_started; ?>" placeholder=" Choose Date" style="cursor: pointer;">
                        <!-- <input type="date" class="form-control" id="date_started" name="date_started" value="<?= $dataRequestMentor->date_started; ?>"> -->
                        <div class="invalid-feedback errorDateMentoring">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Topik</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="topic" name="topic" value="<?= $dataRequestMentor->topic; ?>">
                        <div class="invalid-feedback errorTopic">

                        </div>
                    </div>
                </div>
                <br>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Deskripsi Topik</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="description" name="description" value="<?= $dataRequestMentor->description; ?>">
                        <div class="invalid-feedback errorDescriptionTopic">

                        </div>
                    </div>
                </div>



                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnsimpan">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.formRequestMentor').submit(function(e) {
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
                        $('.btnsimpan').html('Update');

                    },
                    success: function(response) {
                        if (response.error) {
                            if (response.error.date_started) {
                                $('#date_started').addClass('is-invalid');
                                $('.errorDateMentoring').html(response.error.date_started);
                            } else {
                                $('#date_started').removeClass('is-invalid');
                                $('.errorDatementoring').html('');
                            }

                            if (response.error.topic) {
                                $('#topic').addClass('is-invalid');
                                $('.errorTopic').html(response.error.topic);
                            } else {
                                $('#topic').removeClass('is-invalid');
                                $('.errorTopic').html('');
                            }
                            if (response.error.description) {
                                $('#description').addClass('is-invalid');
                                $('.errorDescriptionTopic').html(response.error.description);
                            } else {
                                $('#description').removeClass('is-invalid');
                                $('.errorDescriptionTopic').html('');
                            }

                        } else {

                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            })

                            $('#modalEdit').modal('hide');
                            requestMentorList();
                        }

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            });
            return false;
        })

        $("#date_mentoring").datepicker({
            format: 'yyyy-mm-dd',
            inline: false,
            lang: 'en',
            step: 15,
            multidate: 15,
            closeOnDateSelect: true
        });
    </script>