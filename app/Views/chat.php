<?= $this->extend('layout/template_chat') ?>

<?= $this->section('contact') ?>
<div id="contacts">
  <ul>
    <?php
    $pp = "";
    if (is_null(session()->get('profile_picture'))) {
      $pp = "default.jpg";
    } else {
      $pp = session()->get('profile_picture');;
    } ?>


    <?php
    foreach ($recentChat as $u) : ?>
      <?php
      $ppnotme = "";
      if (is_null($u->profile_picture)) {
        $ppnotme = "default.jpg";
      } else {
        $ppnotme = $u->profile_picture;;
      } ?>
      <li class="contact" user-id=<?= $u->username ?> user-name=<?= $u->name ?>>
        <div class="wrap">
          <span class="contact-status online"></span>
          <img src="<?= base_url() ?>/file/profile/<?= $ppnotme ?>" width="40" height="40" alt="" />
          <div class=" meta">
            <p class="name" style="font-size: x-large;"><?= $u->name ?></p>

          </div>
        </div>
      </li>
    <?php endforeach ?>
  </ul>
</div>

<?= $this->endSection() ?>

<?= $this->section('conversation') ?>
<div class="messages" id="conversation">
  <ul>
    <br><br><br>
    <div class="card-body">
      <div class="text-center">
        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;height:10rem" src="<?= base_url(); ?>/assets/dashboard/img/undraw_posting_photo.svg" alt="...">
      </div>
      <h1 style="font-size:xx-large;text-align:center">Chat Mentormu Sekarang!</h1><br>
      <p style="text-align:center">Diskusikan tentang mentoring kamu dengan mentor kamu. Diskusi cepat, mudah dan tanpa batasan</p>

    </div>

  </ul>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

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
					<img src="<?= base_url() ?>/file/profile/<?= $pp ?>" width="40" height="30" alt="" />
					<p>` + message + `</p>
          
          </li></ul>
          <span class="message-time-sender2 pull-right">
                    ` + created + `
                    </span>
`;
            } else {
              template = `<ul><li class="sent">
					
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
					<img src="<?= base_url() ?>/file/profile/<?= $pp ?>" width="40" height="30" alt="" />
					<p>` + data.message + `</p>
				</li></ul>`;
          $('#conversation').append(template);
          $("#conversation").scrollTop($("#conversation")[0].scrollHeight);
        }
      })
    }


  });
</script>
<?= $this->endSection() ?>