<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link href="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/mbohtable/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<link href="<?= base_url() ?>/assets/mbohtable/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>/assets/mbohtable/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>/assets/mbohtable/css/style.css" rel="stylesheet" type="text/css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet" />

<!-- Page Wrapper -->
<div id="wrapper" style=" padding-top:100px">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">


            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">History Request Mentor</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive viewdata">





                        </div>
                    </div>
                </div>


                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->

                    </div>

                </div>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->



        <script src="<?= base_url() ?>/assets/mbohtable/js/jquery.min.js"></script>


        <script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <script src="<?= base_url() ?>/assets/mbohtable/js/app.js"></script>
        <div class="viewModal" style="display: none;"></div>

        <script type="text/javascript">
            function requestMentorList() {
                $.ajax({
                    url: "<?= site_url('mentor/loadRequestMentorList') ?>",
                    dataType: "json",
                    success: function(response) {
                        $('.viewdata').html(response.data);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })
            }

            $(document).ready(function() {
                requestMentorList();

            });
        </script>
        <?= $this->endSection('content'); ?>