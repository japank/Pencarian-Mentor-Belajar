<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet" />

<main id="main" data-aos="fade-in">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container">
            <h4 style="text-align:left">Hai <b><?= $usernow = session()->get('name'); ?></b> ! Lokasi Anda adalah</h4>
            <p style="text-align:left"><b><?= session()->get('address'); ?></b></p><br />
            <?php
            $currentLat = session()->get('latitude');
            $currentLong = session()->get('longitude');
            $currentAddress = session()->get('address');
            ?>
            <button type="button" class="btn btn-light btn-sm " onclick="changeLocation()"><i class="ri ri-book-fill"></i> Ubah Lokasi </button></a>
            <!-- <p style="text-align:left" onclick="changeLocation()"><a class=" tombol-putih"><b>Ubah Lokasi</b></a></p> -->
        </div>
    </div><!-- End Breadcrumbs -->
    <!-- ======= Team Section ======= -->

    <br>

    <div id="myBtnContainer" style="position: absolute; right: 7%;">
        <button class="btnfilter active" onclick="allMentor()"> Jarak</button>
        <button class="btnfilter" onclick="allMentorByScore()"> Skor</button>
    </div>

    <style>
        .container {
            overflow: hidden;
        }

        .filterDiv {
            float: left;
            background-color: #2196F3;
            color: #ffffff;
            width: 100px;
            line-height: 100px;
            text-align: center;
            margin: 2px;
            display: none;
            /* Hidden by default */
        }

        /* The "show" class is added to the filtered elements */
        .show {
            display: block;
        }

        /* Style the buttons */
        .btnfilter {
            border: none;
            outline: none;
            padding: 12px 16px;
            background-color: #f1f1f1;
            cursor: pointer;
        }

        /* Add a light grey background on mouse-over */
        .btnfilter:hover {
            background-color: #ddd;
        }

        /* Add a dark background to the active button */
        .btnfilter.active {
            background-color: #5fcf80;
            color: white;
        }
    </style>
    <section id="team" class="team section-bg">
        <div class="container viewdata" data-aos="fade-up">




        </div>
    </section><!-- End Team Section -->
</main><!-- End #main -->
<div class="form-popup" id="myForm">
    <div class="col-sm-8 col-sm-push-4 col-lg-12">
        <div class="box box-warning direct-chat direct-chat-warning">
            <div class="box-header with-border">
                <h3 class="box-title" id="recipient-name">Chat Messages</h3>
                <div class="box-tools pull-right">
                    <!-- <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="3 New Messages">20</span> -->
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>  -->
                    <button type="button" class="btn btn-box-tool close-chat" data-widget="remove"><i class="fa fa-times"></i> </button>
                </div>
            </div>
            <div class="box-body">
                <div class="direct-chat-messages" id="conversation">
                    <!-- <div class="direct-chat-msg"> 
                                <div class="direct-chat-text"> For what reason would it be advisable for me to think about business content? </div>
                                <div class="direct-chat-info clearfix"> <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span> </div> 
                            </div>
                            <div class="direct-chat-msg right ">
                                <div class="direct-chat-text"> Thank you for your believe in our supports </div>
                                <div class="direct-chat-info clearfix"> <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span> </div>
                            </div>
                            <div class="direct-chat-msg">
                                <div class="direct-chat-text"> For what reason would it be advisable for me to think about business content? </div>
                                <div class="direct-chat-info clearfix"> <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span> </div> 
                            </div>
                            <div class="direct-chat-msg right ">
                                <div class="direct-chat-text"> Thank you for your believe in our supports </div>
                                <div class="direct-chat-info clearfix"> <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span> </div>
                            </div>-->
                </div>
            </div>
            <div class="box-footer">
                <div class="input-group">
                    <?= csrf_field() ?>
                    <input type="text" name="message" id="comment" placeholder="Type Message ..." class="form-control"> <span class="input-group-btn">
                        <button type="button" id="send-message" class="btn btn-warning btn-flat" style=" background: #5fcf80;border-color: #5fcf80">Send</button> </span>
                </div>
            </div>
        </div>
    </div>

</div>




<!-- <div class="form-popup" id="myForm">
<div class="col-md-12">
                <div class="card card-bordered">
                    <div class="card-header">
                        <h4 class="card-title"><strong>Chat</strong></h4> <a class="btn btn-xs btn-danger" href="#" data-abc="true" onclick="closeForm()" ><b>X</b></a>
                    </div>
                    <div class="ps-container ps-theme-default ps-active-y" id="chat-content" style="overflow-y: scroll !important; height:400px !important;">
                        <div class="media media-chat"> <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                            <div class="media-body">
                                <p>Hi</p>
                                <p>How are you ...???</p>
                                <p>What are you doing tomorrow?<br> Can we come up a bar?</p>
                                <p class="meta"><time datetime="2018">23:58</time></p>
                            </div>
                        </div>
                        <div class="media media-meta-day">Today</div>
                        <div class="media media-chat media-chat-reverse">
                            <div class="media-body">
                                <p>Hiii, I'm good.</p>
                                <p>How are you doing?</p>
                                <p>Long time no see! Tomorrow office. will be free on sunday.</p>
                                <p class="meta"><time datetime="2018">00:06</time></p>
                            </div>
                        </div>
                        <div class="media media-chat"> <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                            <div class="media-body">
                                <p>Okay</p>
                                <p>We will go on sunday? </p>
                                <p class="meta"><time datetime="2018">00:07</time></p>
                            </div>
                        </div>
                        <div class="media media-chat media-chat-reverse">
                            <div class="media-body">
                                <p>Hiii, I'm good.</p>
                                <p>How are you doing?</p>
                                <p>Long time no see! Tomorrow office. will be free on sunday.</p>
                                <p class="meta"><time datetime="2018">00:06</time></p>
                            </div>
                        </div>
                        <div class="media media-chat"> <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                            <div class="media-body">
                                <p>Okay i will meet you on Sandon Square </p>
                                <p class="meta"><time datetime="2018">00:10</time></p>
                            </div>
                        </div>
                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                            <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;">
                            <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div>
                        </div>
                    </div>
                    <div class="publisher bt-1 border-light"> <img class="avatar avatar-xs" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="..."> <input class="publisher-input" type="text" placeholder="Write something"> <span class="publisher-btn file-group"> <i class="fa fa-paperclip file-browser"></i> <input type="file"> </span> <a class="publisher-btn" href="#" data-abc="true"><i class="fa fa-smile"></i></a> <a class="publisher-btn text-info" href="#" data-abc="true"><i class="fa fa-paper-plane"></i></a> </div>
                </div>
            </div>
</form>
</div> -->
<div class="viewModal" style="display: none;"></div>
<script type="text/javascript">
    $('document').ready(function() {


        allMentor();

    });

    function changeLocation() {

        $.ajax({
            type: "post",
            url: "<?= site_url('location/index') ?>",
            data: {
                // latitude: lat,
                // longitude: long,
                // address: address,

            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewModal').html(response.sukses).show();
                    $('#modalEdit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function request(username_mentor) {
        var exam_id = '<? $exam_id ?>'
        $.ajax({
            type: "post",
            url: "<?= site_url('mentor/requestMentor') ?>",
            data: {
                username_mentor: username_mentor
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewModal').html(response.sukses).show();
                    $('#modalEdit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function allMentor() {
        $.ajax({
            url: "<?= site_url('mentor/allMentor') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    function allMentorByScore() {
        $.ajax({
            url: "<?= site_url('mentor/allMentorByScore') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    }

    var btnContainer = document.getElementById("myBtnContainer");
    var btns = btnContainer.getElementsByClassName("btnfilter");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
</script>
<?= $this->endSection() ?>