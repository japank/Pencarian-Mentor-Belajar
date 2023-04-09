<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Logbook </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open_multipart('logbook/process/' . $id_request, ['class' => 'formLogbook']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Tanggal Pertemuan</label>
                    <div class="col-sm-8">
                        <select id="date_mentoring" name="date_mentoring" required class="form-select">
                            <option value="">Pilih salah satu</option>
                            <?php
                            foreach ($datementoring as $dm) {
                            ?>
                                <option value="<?= strftime("%Y-%m-%d", strtotime($dm)) ?>"><?= strftime("%a %d %b %Y", strtotime($dm)) ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Deskripsi Pertemuan</label>
                    <div class="col-sm-8">
                        <textarea type="text" class="form-control" id="description" name="description"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Foto Kegiatan</label>
                    <div class="col-sm-8">
                        <input type="file" class="form-control" id="activity_photo" name="activity_photo">
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
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                data: formData,
                enctype: 'multipart/form-data',
                async: false,
                cache: false,
                processData: false,
                contentType: false,
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