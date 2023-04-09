<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajukan Permintaan Mentoring kepada <strong><?= $username_mentor ?></strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open('mentor/processingRequest/', ['class' => 'formRequest']) ?>
            <?= csrf_field(); ?>

            <div class="modal-body">

                <input type="hidden" class="form-control" id="username_mentor" name="username_mentor" value="<?= $username_mentor ?>" readonly="">

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tanggal Pertemuan</label>
                    <div class="col-sm-8">
                        <!-- <input type="date" class="form-control" id="date_mentoring" name="date_mentoring"> -->
                        <input type="text" readonly class="form-control" id="date_mentoring" name="date_mentoring" placeholder="Pilih tanggal" style="cursor: pointer;">
                        <div class="invalid-feedback errorDateMentoring">

                        </div>
                    </div>
                </div>
                <br>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Jam</label>
                    <div class="col-sm-8">
                        <input type="time" class="form-control" id="time_mentoring" name="time_mentoring">
                        <div class="invalid-feedback errorTimeMentoring">

                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Topik</label>
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
                <br>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Deskripsi Topik</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="topic_description" name="topic_description">
                        <div class="invalid-feedback errorTopicDescription">

                        </div>
                    </div>
                </div>

            </div>


            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan">Ajukan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formRequest').submit(function(e) {
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
                        if (response.error.date_mentoring) {
                            $('#date_mentoring').addClass('is-invalid');
                            $('.errorDateMentoring').html(response.error.date_mentoring);
                        } else {
                            $('#date_mentoring').removeClass('is-invalid');
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

                        if (response.error.topic_description) {
                            $('#topic_description').addClass('is-invalid');
                            $('.errorTopicDescription').html(response.error.topic_description);
                        } else {
                            $('#topic_description').removeClass('is-invalid');
                            $('.errorTopicDescription').html('');
                        }

                    } else {

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        })

                        $('#modalEdit').modal('hide');

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
        format: 'dd-mm-yyyy',
        inline: false,
        lang: 'en',
        step: 15,
        multidate: 15,
        closeOnDateSelect: true
    });
</script>