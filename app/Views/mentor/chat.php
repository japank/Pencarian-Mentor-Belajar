<?= $this->extend('layout/templateMentor2'); ?>
<?= $this->section('content'); ?>
<!-- DataTables -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script> -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<!--<script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script><script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script><meta charset='UTF-8'><meta name="robots" content="noindex"><link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" /><link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" /><link rel="canonical" href="https://codepen.io/emilcarlsson/pen/ZOQZaV?limit=all&page=74&q=contact+" /> -->
<meta charset="<?= csrf_meta() ?>
	<link href=" https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/css/wa.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/css/chat.css" rel="stylesheet">

<link href="<?= base_url(); ?>/assets/img/favicon.png" rel="icon">
<link href="<?= base_url(); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="<?= base_url(); ?>/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/vendor/aos/aos.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

<link href="<?= base_url(); ?>/assets/css/style.css" rel="stylesheet">

<script src="https://use.typekit.net/hoy3lrg.js"></script>
<script>
    try {
        Typekit.load({
            async: true
        });
    } catch (e) {}
</script>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
<style class="cp-pen-styles">
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background: #f8f9fa
            /*#27ae60*/
        ;
        font-family: "proxima-nova", "Source Sans Pro", sans-serif;
        font-size: 1em;
        letter-spacing: 0.1px;
        color: #32465a;
        text-rendering: optimizeLegibility;
        text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.004);
        -webkit-font-smoothing: antialiased;
    }
</style>


<div id="frame">
    <div id="sidepanel">
        <div id="profile">
            <p>
                Recent Chats
            </p>
        </div>
        <div id="contacts">
            <ul>

                <?php
                foreach ($recentChat as $u) : ?>
                    <li class="contact" user-id=<?= $u->username ?> user-name=<?= $u->name ?>>
                        <div class="wrap">
                            <span class="contact-status online"></span>
                            <img src="http://emilcarlsson.se/assets/louislitt.png" alt="" />
                            <div class="meta">
                                <p class="name"><?= $u->name ?></p>
                                <p class="preview">You just got LITT up, Mike.</p>
                            </div>
                        </div>
                    </li>
                <?php endforeach ?>
            </ul>
        </div>

    </div>


    <div class="content">
        <div class="contact-profile">

            <p id="recipient-name" style="margin-left: 40%;"> Please select a contact</p>

        </div>

        <div class="messages" id="conversation">
            <ul>

            </ul>
        </div>


        <div class="message-input">
            <div class="wrap">
                <?= csrf_field() ?>
                <input type="text" placeholder="Write your message..." id="comment" />
                <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                <button class="submit" id="send-message"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- <script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script><script src='https://code.jquery.com/jquery-2.2.4.min.js'></script> -->
<script>
    $(".messages").animate({
        scrollBot: $(document).height()
    }, "fast");

    // $("#profile-img").click(function() {
    // 	$("#status-options").toggleClass("active");
    // });

    // $(".expand-button").click(function() {
    //   $("#profile").toggleClass("expanded");
    // 	$("#contacts").toggleClass("expanded");
    // });

    // $("#status-options ul li").click(function() {
    // 	$("#profile-img").removeClass();
    // 	$("#status-online").removeClass("active");
    // 	$("#status-away").removeClass("active");
    // 	$("#status-busy").removeClass("active");
    // 	$("#status-offline").removeClass("active");
    // 	$(this).addClass("active");

    // 	if($("#status-online").hasClass("active")) {
    // 		$("#profile-img").addClass("online");
    // 	} else if ($("#status-away").hasClass("active")) {
    // 		$("#profile-img").addClass("away");
    // 	} else if ($("#status-busy").hasClass("active")) {
    // 		$("#profile-img").addClass("busy");
    // 	} else if ($("#status-offline").hasClass("active")) {
    // 		$("#profile-img").addClass("offline");
    // 	} else {
    // 		$("#profile-img").removeClass();
    // 	};

    // 	$("#status-options").removeClass("active");
    // });

    // function newMessage() {
    // 	message = $(".message-input input").val();
    // 	if($.trim(message) == '') {
    // 		return false;
    // 	}
    // 	$('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
    // 	$('.message-input input').val(null);
    // 	$('.contact.active .preview').html('<span>You: </span>' + message);
    // 	$(".messages").animate({ scrollTop: $(document).height() }, "fast");
    // };

    // $('.submit').click(function() {
    //   newMessage();
    // });

    // $(window).on('keydown', function(e) {
    //   if (e.which == 13) {
    //     newMessage();
    //     return false;
    //   }
    // });
    //# sourceURL=pen.js
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $('document').ready(function() {
        var meta = document.getElementsByTagName("meta")[0];
        var tokenHash = meta.content;
        $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
            jqXHR.setRequestHeader('X-CSRF-Token', tokenHash);
        });

        var roomId;

        var socket = new WebSocket('ws://127.0.0.1:8080');

        socket.onopen = function(e) {
            console.log('Connection Estabilished');
        }

        socket.onmessage = function(e) {
            var data = JSON.parse(e.data);
            console.log(data);
            var targetUserId = data.currentUserId;
            var incomingMessage = data.message;
            var targetRoomId = data.id_room;

            if (targetUserId != '<?= $username ?>' && targetRoomId == roomId) {
                var template = `<ul><li class="sent">
					<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
					<p>` + incomingMessage + `</p>
				</li></ul>
`;
                $("#conversation").append(template);
                $("#conversation").scrollTop($("#conversation")[0].scrollHeight);
            }
        }

        $('.contact').on('click', function() {
            var contactId = $(this).attr('user-id');
            var contactName = $(this).attr('user-name');
            $('#conversation').html('');

            $("#recipient-name").html(contactName);
            $.ajax({
                url: "<?= site_url('Chat/getRoomByUser') ?>",
                type: 'GET',
                data: {
                    'contactId': contactId,
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    roomId = data.id_room;
                    getChats();
                }
            });
        });

        function getChats() {
            $.ajax({
                url: "<?= site_url('Chat/getChatsByRoomId') ?>",
                type: 'POST',
                data: {
                    'roomId': roomId,
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    for (var i = 0; i < data.length; i++) {
                        var message = data[i].message;
                        var created = data[i].created;
                        var id_user = data[i].username;
                        var template = null;
                        if (id_user == '<?= $username ?>') {
                            template = `<ul>				<li class="replies">
					<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
					<p>` + message + `</p>
          
          </li></ul>
          <span class="message-time-sender2 pull-right">
                    ` + created + `
                    </span>
`;
                        } else {
                            template = `<ul><li class="sent">
					<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
					<p>` + message + `</p>
				</li></ul>
        <span class="message-time pull-left">
                    ` + created + `
                    </span>
`;
                        }
                        $("#conversation").append(template);
                        $("#conversation").scrollTop($("#conversation")[0].scrollHeight);
                    }
                }
            });
        }

        $('#send-message').on('click', function() {
            var message = $("#comment").val();
            $("#comment").val('');
            var data = {
                'message': message,
                'id_room': roomId,
                'currentUserId': '<?= $username ?>',
            };
            socket.send(JSON.stringify(data));
            sendMessage(message);
        });

        $(window).on('keydown', function(e) {
            if (e.which == 13) {
                var message = $("#comment").val();
                $("#comment").val('');
                var data = {
                    'message': message,
                    'id_room': roomId,
                    'currentUserId': '<?= $username ?>',
                };
                socket.send(JSON.stringify(data));
                sendMessage(message);
            }
        });

        function sendMessage(message) {
            $.ajax({
                url: "<?= site_url('Chat/sendMessage') ?>",
                type: 'POST',
                data: {
                    'message': message,
                    'id_room': roomId,

                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var template = `<ul>				<li class="replies">
					<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
					<p>` + data.message + `</p>
				</li></ul>`;
                    $('#conversation').append(template);
                    $("#conversation").scrollTop($("#conversation")[0].scrollHeight);
                }
            })
        }


    });
</script>

</div>
</div>

</div>
</div>
</div>



<!-- <script src="<?= base_url() ?>/assets/mbohtable/js/jquery.min.js"></script> -->
<!-- 

<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/mbohtable/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url() ?>/assets/mbohtable/js/app.js"></script> -->
<script type="text/javascript">

</script>

<?= $this->endSection('content'); ?>