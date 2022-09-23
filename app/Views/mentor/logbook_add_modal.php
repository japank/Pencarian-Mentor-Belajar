<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Logbook <?= $username_siswa ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open('logbook/process/' . $username_siswa, ['class' => 'formLogbook']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">

                <input type="hidden" class="form-control" id="username_mentor" name="username_mentor" value="<?= session()->get('username'); ?>" readonly="">

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Tanggal Pertemuan</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="date_mentoring" name="date_mentoring">
                        <div class="invalid-feedback errorDateMentoring">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Topik</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="topic" name="topic">
                        <div class="invalid-feedback errorTopic">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Deskripsi Topik</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="topic_description" name="topic_description">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Deskripsi Pertemuan</label>
                    <div class="col-sm-8">
                        <textarea type="text" class="form-control" id="description" name="description"></textarea>
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
        $('.formLogbook').submit(function(e) {
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

                        $('#modaltambah').modal('hide');
                        studentLogbook();

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