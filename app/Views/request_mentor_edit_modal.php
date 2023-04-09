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
                    <label for="" class="col-sm-4 col-form-label">Tanggal Pertemuan</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control" id="date_started" name="date_started" value="<?= $dataRequestMentor->date_started; ?>" placeholder=" Choose Date" style="cursor: pointer;">
                        <!-- <input type="date" class="form-control" id="date_started" name="date_started" value="<?= $dataRequestMentor->date_started; ?>"> -->
                        <div class="invalid-feedback errorDateMentoring">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Jam</label>
                    <div class="col-sm-8">
                        <input type="time" class="form-control" id="time_mentoring" name="time_mentoring" value="<?= $dataRequestMentor->time_mentoring; ?>">
                        <div class="invalid-feedback errorTimeMentoring">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Matpel</label>
                    <div class="col-sm-8">
                        <span class="custom-dropdown">
                            <select id="topic" name="topic" required class="form-select">
                                <option value="">Pilih salah satu</option>
                                <?php
                                foreach ($matpel as $row) {
                                ?>
                                    <option value="<?= $row['name_course'] ?>">
                                        <?= $row['name_course'] ?>
                                    </option>

                                <?php
                                }
                                ?>
                            </select>
                        </span>
                        <div class="invalid-feedback errorTopic">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Topik</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="description" name="description" value="<?= $dataRequestMentor->description; ?>">
<<<<<<< HEAD
                        <div class="invalid-feedback errorDescription">
                        </div>

=======
                        <div class="invalid-feedback errorDescriptionTopic">

                        </div>
>>>>>>> b60230be6a74b6e83a6ed782e122e1adfb91890e
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

                            if (response.error.time_mentoring) {
                                $('#time_mentoring').addClass('is-invalid');
                                $('.errorTimeMentoring').html(response.error.time_mentoring);
                            } else {
                                $('#time_mentoring').removeClass('is-invalid');
                                $('.errorTimeMentoring').html('');
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
<<<<<<< HEAD
                                $('.errorDescription').html(response.error.description);
                            } else {
                                $('#description').removeClass('is-invalid');
                                $('.errorDescription').html('');
=======
                                $('.errorDescriptionTopic').html(response.error.description);
                            } else {
                                $('#description').removeClass('is-invalid');
                                $('.errorDescriptionTopic').html('');
>>>>>>> b60230be6a74b6e83a6ed782e122e1adfb91890e
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

        $("#date_started").datepicker({
            format: 'yyyy-mm-dd',
            inline: false,
            lang: 'en',
            step: 15,
            multidate: 15,
            closeOnDateSelect: true
        });
    </script>