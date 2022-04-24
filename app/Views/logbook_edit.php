<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="container" style=" padding-top : 100px;">
    <div class="card">
        <div class="card-header">
            <h3>Edit Logbook <?= $dataLogbook->username_siswa ?></h3>
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
            <form method="post" action="<?= base_url('logbook/update/'. $dataLogbook->id_logbook) ?>">
                <?= csrf_field(); ?>

                    <input type="hidden" class="form-control" id="username_siswa" name="username_siswa" value="<?= $dataLogbook->username_siswa ?>" readonly="">
                
                <div class="form-group">
                    <label for="nama">Tanggal Pertemuan</label>
                    <input type="date" class="form-control" id="date_mentoring" name="date_mentoring" value="<?= $dataLogbook->date_mentoring ?>">
                </div>
                
                <div class="form-group">
                    <label for="nama">Topik</label>
                    <input type="text" class="form-control" id="topic" name="topic" value="<?= $dataLogbook->topic ?>">
                </div>

                <div class="form-group">
                    <label for="nama">Deskripsi</label>
                    <input type="text" class="form-control" id="description" name="description" value="<?= $dataLogbook->description ?>">
                </div>



                <div class="form-group">
                    <input type="submit" value="Tambah Data" class="btn btn-info" />
                </div>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>