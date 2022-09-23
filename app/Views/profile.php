<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="breadcrumbs" style="margin-top: 3%;">
    <div class="container">
        <h4 style="text-align:left">Tentang kamu</h4>
    </div>
</div>

<section style="background-color: #eee;">

    <div class="container py-5" style="margin-top: -5%;">

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <?php foreach ($dataUsers as $row) { ?>
                        <div class="card-body text-center">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">
                                <?= $row->name; ?></h5>
                            <p class="text-muted mb-1">Mahasiswa UM</p>

                            <p class="text-muted mb-4"> <?= $row->address; ?><a href="<?= site_url('location'); ?>"><i class="ri-pencil-fill contact"></i></a> </p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-primary">Edit Profil</button>
                                <a href="<?= site_url('location'); ?>"> <button type="button" class="btn btn-outline-primary ms-1">Ubah Alamat</button></a>
                            </div>
                        </div>
                </div>

            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Username</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?= $row->username; ?></p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?= $row->name; ?></p>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?= $row->email; ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">(097) 234-5678</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Role</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?= $row->role; ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Kelas</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?= $row->kelas; ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?= $row->address; ?></p><a href="<?= site_url('location'); ?>"><i class="ri-pencil-fill contact"></i></a>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?php } ?>
        </div>
    </div>
</section>
<?= $this->endSection() ?>