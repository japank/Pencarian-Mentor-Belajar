<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container" style=" padding-top : 100px;">
    <div class="card">
        <div class="card-header">
            <h3>Edit Request Mentor</h3>
        </div>
        <div class="card-body">
            <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h4>Periksa Entrian Form</h4>
                    </hr />
                    <?php echo session()->getFlashdata('error'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <form method="post" action="<?= base_url('mentor/update/' . $dataRequestMentor->id_request_mentor) ?>">
                <?= csrf_field(); ?>

                <input type="hidden" class="form-control" id="username" name="username" value="<?= session()->get('username'); ?>" readonly="">

                <div class="form-group">
                    <label for="nama">Nama Mentor</label>
                    <input type="text" class="form-control" id="username_mentor" name="username_mentor" value="<?= $dataRequestMentor->username_mentor; ?>" readonly="">
                </div>

                <div class="form-group">
                    <label for="nama">Topik</label>
                    <input type="text" class="form-control" id="topic" name="topic">
                </div>

                <div class="form-group">
                    <label for="nama">Deskripsi Topik</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>

                <div class="form-group">
                    <label for="nama">Tanggal Pertemuan</label>
                    <input type="date" class="form-control" id="date_started" name="date_started">
                </div>

                <br />
                <div class="form-group">
                    <input type="submit" value="Ajukan Permintaan" class="btn btn-success" />
                </div>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>