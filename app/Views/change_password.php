<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ganti Password <?= $name ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open('profile/updatePw/' . $username, ['class' => 'formPw']) ?>
            <?= csrf_field(); ?>

            <div class="modal-body">

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Password Lama</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="old_pw" name="old_pw" value="">
                        <div class="invalid-feedback errorOldpw">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Password Baru</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="new_pw" name="new_pw" value="">
                        <div class="invalid-feedback errorNewpw">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="new_pw_conf" name="new_pw_conf" value="">
                        <div class="invalid-feedback errorNewpwconf">

                        </div>
                    </div>
                </div>
            </div>



            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan">Ganti Password</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formPw').submit(function(e) {
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

                        if (response.error.old_pw) {
                            $('#old_pw').addClass('is-invalid');
                            $('.errorOldpw').html(response.error.old_pw);
                        } else {
                            $('#old_pw').removeClass('is-invalid');
                            $('.errorOldpw').html('');
                        }
                        if (response.error.new_pw) {
                            $('#new_pw').addClass('is-invalid');
                            $('.errorNewpw').html(response.error.new_pw);
                        } else {
                            $('#new_pw').removeClass('is-invalid');
                            $('.errorNewpw').html('');
                        }
                        if (response.error.new_pw_conf) {
                            $('#new_pw_conf').addClass('is-invalid');
                            $('.errorNewpwconf').html(response.error.new_pw_conf);
                        } else {
                            $('#new_pw_conf').removeClass('is-invalid');
                            $('.errorNewpwconf').html('');
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
</script>