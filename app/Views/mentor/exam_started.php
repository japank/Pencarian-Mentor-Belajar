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
                    <h4 class="card-title">Hai Siswa yascvscascf</h4>
                    <h6 class="card-subtitle">Dibawah ini adalah daftar siswa yang kamu mentorin.</h6>
                </div>
                <div id="single_question_area">
                </div>

                <div id="question_navigation_area"></div>
                <div class="col-md-4">
                    <div allign="center">
                        <div id="exam_timer" data-Timer="<?= 10; ?>" style="max-width:400px; width:100%; height:200px;"></div>
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

        // setInterval(function() {
        //     var remaining_second = $('#exam_timer').TimeCircles().getTime();
        //     if (remaining_second < 1) {
        //         alert('Time Up');
        //         //location.reload();
        //     }
        // }, 1000);

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