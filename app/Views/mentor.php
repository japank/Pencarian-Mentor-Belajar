<?= $this->extend('layout/template') ?>

<?= $this->section('trainer') ?>

<main id="main" data-aos="fade-in">

<!-- ======= Breadcrumbs ======= -->
<div class="breadcrumbs">
    <div class="container">
    <h4 style="text-align:left">Hai <b><?= $usernow = session()->get('name'); ?></b> ! Lokasi Anda adalah</h4>
    <p style="text-align:left"><b><?= session()->get('address');?></b></p><br/>
    <p style="text-align:left"><a href="<?= site_url('location'); ?>" class="tombol-putih" ><b>Ubah Lokasi</b></a></p>    </div>
</div><!-- End Breadcrumbs -->
<!-- ======= Team Section ======= -->
<section id="team" class="team section-bg">
    <div class="container" data-aos="fade-up">

    <div class="row">
    <?php
            $no = 1;

            $usernow = session()->get('username');
            foreach ($mentor as $row){
            ?>
        <div class="col-lg-6">
        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
            <div class="pic"><img src="<?= base_url(); ?>/assets/img/trainers/trainer-1.jpg" class="img-fluid" alt=""></div>
            <div class="member-info">
            <h4><?= $row->name; ?></h4>
            <span><?= number_format((float)$row->jarak_km, 2, '.', ''); ?> km</span>
            <p><?= $row->address; ?></p>
            <div class="social">
                <a href="<?= base_url("mentor/request/$row->username"); ?>"><i class="ri-send-plane-fill"></i></a>
                <a ><i class="ri-message-fill contact" user-id='<?= $row->username ?>' user-name='<?= $row->name ?>'></i></a>
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
<div class="col-sm-8 col-sm-push-4 col-lg-12">
                <div class="box box-warning direct-chat direct-chat-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title" id="recipient-name">Chat Messages</h3>
                        <div class="box-tools pull-right"> <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="3 New Messages">20</span> <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>  <button type="button" class="btn btn-box-tool close-chat" data-widget="remove"><i class="fa fa-times"></i> </button> </div>
                    </div>
                    <div class="box-body" >
                        <div class="direct-chat-messages" id="conversation" >
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
                                <input type="text" name="message"  id="comment" placeholder="Type Message ..." class="form-control"> <span class="input-group-btn"> 
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
$('document').ready(function(){
    var meta = document.getElementsByTagName("meta")[0];
    var tokenHash = meta.content;
    $.ajaxPrefilter(function(options,originalOptions,jqXHR) {
        jqXHR.setRequestHeader('X-CSRF-Token', tokenHash);  });

    var roomId;

    var socket = new WebSocket('ws://127.0.0.1:8080');

    socket.onopen = function(e){
        console.log('Connection Estabilished');
    }

    socket.onmessage = function(e){
        var data = JSON.parse(e.data);
        console.log(data);
        var targetUserId = data.currentUserId;
        var incomingMessage = data.message;
        var targetRoomId = data.id_room;

        if(targetUserId!='<?= $username ?>' && targetRoomId==roomId){
        var template = `<div class="row message-body">
            <div class="col-sm-12 message-main-receiver">
            <div class="receiver">
                <div class="message-text">
                `+incomingMessage+`
                </div>
                <span class="message-time pull-right">
                'a'
                </span>
            </div>
            </div>
        </div>`;
        $("#conversation").append(template);
        $("#conversation").scrollTop($("#conversation")[0].scrollHeight);
        }
    }

    $('.contact').on('click', function(){
        document.getElementById("myForm").style.display = "block";
        var contactId = $(this).attr('user-id');
        var contactName = $(this).attr('user-name');
        $('#conversation').html('');

        $("#recipient-name").html(contactName);
        $.ajax({
        url: "<?= site_url('Chat/getRoomByUser') ?>",
        type: 'GET',
        data: {
            'contactId' : contactId,
        },
        dataType:'json',
        success : function(data){
            console.log(data);
            roomId = data.id_room;
            getChats();
        }
        });

    }),

    $('.close-chat').on('click', function(){
    document.getElementById("myForm").style.display = "none";
    });

    function getChats(){
        $.ajax({
        url: "<?= site_url('Chat/getChatsByRoomId') ?>",
        type: 'POST',
        data: {
            'roomId': roomId,
        },
        dataType:'json',
        success : function(data){
            console.log(data);
            for (var i=0;i<data.length;i++){
            var message = data[i].message;
            var created = data[i].created;
            var id_user = data[i].username;
            var template = null;
            if(id_user == '<?= $username ?>'){
                template =  `<div class="row message-body">
                <div class="col-sm-12 message-main-sender">
                <div class="sender">
                    <div class="message-text-sender">
                    `+message+`
                    </div>
                    <span class="message-time-sender pull-right">
                    `+created+`
                    </span>
                </div>
                </div>
            </div>`;
                }else{
                    template = `<div class="row message-body">
                <div class="col-sm-12 message-main-receiver">
                <div class="receiver">
                    <div class="message-text">
                    `+message+`
                    </div>
                    <span class="message-time pull-right">
                    `+created+`
                    </span>
                </div>
                </div>
            </div>`;
            }
            $("#conversation").append(template);
            $("#conversation").scrollTop($("#conversation")[0].scrollHeight);
            }
        } 
        });
    }

    $('#send-message').on('click', function(){
        var message = $("#comment").val();
        $("#comment").val('');
        var data = {
        'message': message,
        'id_room' : roomId,
        'currentUserId' : '<?= $username ?>',
        };
        socket.send(JSON.stringify(data));
        sendMessage(message);
    });


    function sendMessage(message){
        $.ajax({
        url : "<?= site_url('Chat/sendMessage') ?>",
        type : 'POST',
        data : {
            'message' : message,
            'id_room' : roomId,

        },
        dataType: 'json',
        success : function(data){
            console.log(data);
        var template =  `        <div class="row message-body">
        <div class="col-sm-12 message-main-sender">
        <div class="sender">
            <div class="message-text">
            `+data.message+`
            </div>
            <span class="message-time pull-right">
            'c'
            </span>
        </div>
        </div>
    </div>`;
        $('#conversation').append(template);
        }
        })
    }


});
</script>
<?= $this->endSection() ?>