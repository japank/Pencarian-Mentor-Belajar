<?= $this->extend('layout/templateMentor2'); ?>
<?= $this->section('content'); ?>
<!-- DataTables -->
<link href="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/mbohtable/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<link href="<?= base_url() ?>/assets/mbohtable/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>/assets/mbohtable/css/icons.css" rel="stylesheet" type="text/css">
<link href="<?= base_url() ?>/assets/mbohtable/css/style.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/timecircle/inc/TimeCircles.js"></script>
<link href="<?= base_url() ?>/assets/timecircle//inc/TimeCircles.css" rel="stylesheet">
<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>

<div class="container-fluid">

    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Test <?= $name; ?></h4>
                    <h6 class="card-subtitle">Level <?= $level ?>.</h6>
                </div>
                <div id="single_question_area">
                </div>

                <div id="question_navigation_area"></div>
                <div class="col-md-4">
                    <div allign="center">
                        <div id="exam_timer" data-Timer="<?= $time * 60 ?>" style="max-width:400px; width:100%; height:200px;"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>



<!-- <script src="<?= base_url() ?>/assets/mbohtable/js/jquery.min.js"></script> -->


<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url() ?>/assets/mbohtable/js/app.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var exam_id = '<?= $exam_id; ?>'

        loadQuestion();
        question_navigation();

        function loadQuestion(question_id = '', ) {
            $.ajax({
                url: "<?= site_url('exam/loadQuestion') ?>",
                method: "post",
                data: {
                    question_id: question_id,
                    exam_id: exam_id,

                },
                success: function(data) {
                    $('#single_question_area').html(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }

            })
        }

        $(document).on('click', '.next', function() {
            var question_id = $(this).attr('id');

            loadQuestion(question_id);
        });

        $(document).on('click', '.previous', function() {
            var question_id = $(this).attr('id');

            loadQuestion(question_id);
        });

        $(document).on('click', '.submit', function() {
            var exam_id = $(this).attr('id');

            Swal.fire({
                title: 'Submit',
                text: `Jika anda submit, anda tidak akan bisa mengubah jawaban anda. Tetap Submit ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= site_url('exam/userSubmit') ?>",
                        type: "post",
                        data: {
                            exam_id: exam_id,
                        },
                        dataType: "json",

                        success: function(response) {
                            if (response.sukses) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.sukses,
                                })
                                console.log("submit berhassi")
                                window.location = '<?= base_url(); ?>/exam/result';
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    })
                }
            })

        });

        function submitAnswer() {
            $.ajax({
                url: "<?= site_url('exam/submitAnswer') ?>",
                method: "POST",
                data: {
                    exam_id: exam_id,
                },
                success: function(data) {
                    console.log("sudah disubmit");

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        }

        function question_navigation() {
            $.ajax({
                url: "<?= site_url('exam/questionNavigation') ?>",
                method: "post",
                data: {
                    exam_id: exam_id,
                },
                success: function(data) {
                    $('#question_navigation_area').html(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        }

        $(document).on('click', '.question_navigation', function() {
            var question_id = $(this).data('question_id');


            loadQuestion(question_id);
        });

        $('#exam_timer').TimeCircles({
            time: {
                Days: {
                    show: false
                },
                Hours: {
                    show: false
                }
            }
        })

        setInterval(function() {
            var remaining_second = $('#exam_timer').TimeCircles().getTime();
            if (remaining_second < 1) {
                submitAnswer();
                console.log("sudah disubmit");
                Swal.fire({
                    icon: 'success',
                    title: 'Waktu Habis',
                })
                window.location = '<?= base_url(); ?>/exam/result';
            }
        }, 1000);

        $(document).on('click', '.answer_option', function() {
            var question_id = $(this).data('question_id');
            var answer_option = $(this).data('id');


            $.ajax({
                url: "<?= site_url('exam/userAnswer') ?>",
                method: "POST",
                data: {
                    question_id: question_id,
                    answer_option: answer_option,
                    exam_id: exam_id,
                },
                success: function(data) {
                    console.log("jawaban useer :" + answer_option);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        });

        $(document).on('click', '.testing', function() {
            var testid = $(this).attr('id');
            console.log(testid)

        });

    });
</script>

<?= $this->endSection('content'); ?>