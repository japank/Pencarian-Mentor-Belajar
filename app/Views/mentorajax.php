<?php
$no = 1;

$usernow = session()->get('username');
foreach ($mentor as $row) {
    $pp = "";
    if (is_null($row->profile_picture)) {
        $pp = "default.jpg";
    } else {
        $pp = $row->profile_picture;
    }
?>
    <div class="col-lg-6 mt-4">
        <div class="member d-flex align-items-start" data-aos="zoom-in" data-aos-delay="100">
            <div class="pic"><img src="<?= base_url() ?>/file/profile/<?= $pp ?>" class="img-fluid" alt="" style="width: 100%; height:150px"></div>
            <div class="member-info">
                <h4><?= $row->name; ?></h4>
                <!-- <span><?= number_format((float)$row->jarak_km, 2, '.', ''); ?> km</span> -->

                <p><i class="fa fa-map-marker" aria-hidden="true"></i> <?= number_format((float)$row->jarak_km * 1000, 2, '.', ''); ?> m</p>
                <p><i class="fa fa-usd" aria-hidden="true"></i> <?= $row->price_sd ?>rb - <?= $row->price_sma ?>rb</p>
                <p>
                <div class="social">
                    <a onclick="showMatpelMentor('<?= $row->username ?>')"><i class="ri-book-fill"></i></a>
                    <a onclick="showLocation('<?= $row->latitude ?>','<?= $row->longitude ?>','<?= $row->username ?>','<?= $row->address ?>')"><i class="ri-treasure-map-fill"></i></a>
                </div>
                </p>
                <div class="social">

                    <button class="contact btn btn-primary" style="border-radius: 50px;" user-id='<?= $row->username ?>' user-name='<?= $row->name ?>'><i class="ri-message-fill"></i><strong style="margin-left: 7%;">Chat</strong></button>

                    <button class="btn btn-success" style="border-radius: 50px;margin-left:10%" onclick="request('<?= $row->username ?>')"><i class="ri-send-plane-fill"></i><strong style="margin-left: 7%;">Order</strong></button>

                </div>
            </div>
        </div>
    </div>
<?php
}
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $('document').ready(function() {

    });

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
            var template = `<div class="row message-body">
            <div class="col-sm-12 message-main-receiver">
            <div class="receiver">
                <div class="message-text">
                ` + incomingMessage + `
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

    $('.contact').on('click', function() {
            document.getElementById("myForm").style.display = "block";
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

        }),

        $('.close-chat').on('click', function() {
            document.getElementById("myForm").style.display = "none";
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
                        template = `<div class="row message-body">
                <div class="col-sm-12 message-main-sender">
                <div class="sender">
                    <div class="message-text-sender">
                    ` + message + `
                    </div>
                    <span class="message-time-sender pull-right">
                    ` + created + `
                    </span>
                </div>
                </div>
            </div>`;
                    } else {
                        template = `<div class="row message-body">
                <div class="col-sm-12 message-main-receiver">
                <div class="receiver">
                    <div class="message-text">
                    ` + message + `
                    </div>
                    <span class="message-time pull-right">
                    ` + created + `
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
                var template = `        <div class="row message-body">
        <div class="col-sm-12 message-main-sender">
        <div class="sender">
            <div class="message-text">
            ` + data.message + `
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
</script>