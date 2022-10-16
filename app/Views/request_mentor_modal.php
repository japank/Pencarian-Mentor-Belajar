<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajukan Permintaan Mentoring "<?= $username_mentor ?>"</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open('mentor/processingRequest/', ['class' => 'formRequest']) ?>
            <?= csrf_field(); ?>

            <div class="modal-body">

                <input type="hidden" class="form-control" id="username_mentor" name="username_mentor" value="<?= $username_mentor ?>" readonly="">

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Tanggal Pertemuan</label>
                    <div class="col-sm-8">
                        <!-- <input type="date" class="form-control" id="date_mentoring" name="date_mentoring"> -->
                        <input type="text" readonly class="form-control" id="date_mentoring" name="date_mentoring" placeholder="Choose Date" style="cursor: pointer;">
                        <div class="invalid-feedback errorDateMentoring">

                        </div>
                    </div>
                </div>

                <!-- <input type="text" readonly id="Txt_Date" name="Txt_Date" placeholder="Choose Date" style="cursor: pointer;"> -->
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Topik</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="topic" name="topic">
                        <div class="invalid-feedback errorTopic">

                        </div>
                    </div>
                </div>
                <br>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Deskripsi Topik</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="topic_description" name="topic_description">
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

                        if (response.error.topic) {
                            $('#topic').addClass('is-invalid');
                            $('.errorTopic').html(response.error.topic);
                        } else {
                            $('#topic').removeClass('is-invalid');
                            $('.errorTopic').html('');
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
        format: 'yyyy-mm-dd',
        inline: false,
        lang: 'en',
        step: 15,
        multidate: 15,
        closeOnDateSelect: true
    });
</script>