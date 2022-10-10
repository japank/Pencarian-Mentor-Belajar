<?= $this->extend('layout/template2'); ?>
<?= $this->section('content'); ?>
<main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h4 style="text-align:left">Hai <b><?= $usernow = session()->get('name'); ?></b>. Ini Mentor kamu</h4>
            <!-- <p style="text-align:left"><?= session()->get('address'); ?></p><br/> -->
            <!-- <p style="text-align:left"><a href="<?= site_url('location'); ?>" class="tombol-putih" ><b>Ubah Lokasi</b></a></p>     -->
        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <?php
                $no = 1;

                $username_siswa = session()->get('username');
                foreach ($mentor as $row) {
                    $username_mentor = $row->username;
                ?>
                    <div class="col-lg-6">
                        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
                            <div class="pic"><img src="<?= base_url(); ?>/assets/img/trainers/trainer-1.jpg" class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4><?= $row->name; ?></h4>
                                <span> </span>
                                <p><?= $row->address; ?></p>
                                <div class="social">
                                    <!-- <a href="<?= base_url("mylogbook/details/$row->username"); ?>"><i class="ri-book-fill"></i></a>
                                 -->
                                    <button type="button" class="btn btn-primary btn-sm " onclick="showLogbook('<?= $username_mentor ?>')"><i class="ri ri-book-fill"></i> </button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>


            </div>

        </div>
    </section><!-- End Team Section -->
</main><!-- End #main -->
<script src="<?= base_url() ?>/assets/mbohtable/js/jquery.min.js"></script>


<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url() ?>/assets/mbohtable/js/app.js"></script>
<div class="viewModal" style="display: none;"></div>
<script>
    var username_siswa = '<?= $username_siswa ?>';
    $(document).ready(function() {
        // $('#dataMentored').DataTable();

    });

    function showLogbook(username_mentor) {
        $.ajax({
            type: "post",
            url: "<?= site_url('logbook/showLogbookStudent') ?>",
            data: {
                username_mentor: username_mentor,
                username_siswa: username_siswa
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewModal').html(response.sukses).show();
                    $('#modaltambah').modal('show');

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }
</script>
<?= $this->endSection('content'); ?>