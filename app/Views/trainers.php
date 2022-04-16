<?= $this->extend('layout/template') ?>

<?= $this->section('trainer') ?>

<main id="main" data-aos="fade-in">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
    <div class="container">
    <h4 style="text-align:left">Lokasi Anda</h4>
    <br/>
    <p style="text-align:left"><?= session()->get('address');?></p><br/>
    <p style="text-align:left"><a href="<?= site_url('location'); ?>" class="btn get-started-btn btn-secondary"><b>Ubah Lokasi</b></a></p>    </div>
</div><!-- End Breadcrumbs -->
<!-- ======= Team Section ======= -->
<section id="team" class="team section-bg">
    <div class="container" data-aos="fade-up">

    <div class="row">
    <?php
            $no = 1;

            $usernow = session()->get('username');
            foreach ($users as $row){
            ?>
        <div class="col-lg-6">
        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
            <div class="pic"><img src="<?= base_url(); ?>/assets/img/trainers/trainer-1.jpg" class="img-fluid" alt=""></div>
            <div class="member-info">
            <h4><?= $row->name; ?></h4>
            <span><?= number_format((float)$row->jarak_km, 2, '.', ''); ?> km</span>
            <p><?= $row->address; ?></p>
            <div class="social">
                               <a href="
                                <?= base_url(); ?>/<?= base_url("users/pilih/$row->username"); ?>
                               "><i class="ri-instagram-fill"></i></a>
                               <a ><i class="ri-twitter-fill" onclick="openForm()"></i></a>
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
<div class="form-popup" id="myForm">
<div class="col-md-4"></div>
<div class="col-md-4"></div>
<div class="col-md-4">
                <div class="box box-warning direct-chat direct-chat-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chat Messages</h3>
                        <div class="box-tools pull-right"> <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="3 New Messages">20</span> <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button> <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts"> <i class="fa fa-comments"></i></button> <button type="button" class="btn btn-box-tool" data-widget="remove" onclick="closeForm()"><i class="fa fa-times"></i> </button> </div>
                    </div>
                    <div class="box-body">
                        <div class="direct-chat-messages">
                            <div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-left">Timona Siera</span> <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span> </div> <img class="direct-chat-img" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="message user image">
                                <div class="direct-chat-text"> For what reason would it be advisable for me to think about business content? </div>
                            </div>
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-text"> Thank you for your believe in our supports </div>
                                <div class="direct-chat-info clearfix"> <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span> </div>
                            </div>
                            <div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-left">Timona Siera</span> <span class="direct-chat-timestamp pull-right">23 Jan 5:37 pm</span> </div> <img class="direct-chat-img" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="message user image">
                                <div class="direct-chat-text"> For what reason would it be advisable for me to think about business content? </div>
                            </div>
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-right">Sarah Bullock</span> <span class="direct-chat-timestamp pull-left">23 Jan 6:10 pm</span> </div> <img class="direct-chat-img" src="https://img.icons8.com/office/36/000000/person-female.png" alt="message user image">
                                <div class="direct-chat-text"> I would love to. </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <form action="#" method="post">
                            <div class="input-group"> <input type="text" name="message" placeholder="Type Message ..." class="form-control"> <span class="input-group-btn"> <button type="button" class="btn btn-warning btn-flat" style=" background: #5fcf80;">Send</button> </span> </div>
                        </form>
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

<script type="text/javascript">
function openForm() {
document.getElementById("myForm").style.display = "block";
}

function closeForm() {
document.getElementById("myForm").style.display = "none";
}
</script>
<?= $this->endSection() ?>