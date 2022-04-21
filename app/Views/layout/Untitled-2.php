<?= $this->extend('layout') ?>

<?= $this->section('contact') ?>

<?php

use function PHPSTORM_META\type;
 foreach($allUsers as $u): ?>
  <div class="row sideBar-body contact" user-id=<?= $u->username ?> user-name=<?= $u->name ?> >
            <div class="col-sm-3 col-xs-3 sideBar-avatar">
              <div class="avatar-icon">
                <img src="https://bootdey.com/img/Content/avatar/avatar1.png">
              </div>
            </div>
            <div class="col-sm-9 col-xs-9 sideBar-main">
              <div class="row">
                <div class="col-sm-8 col-xs-8 sideBar-name">
                  <span class="name-meta"><?= $u->name ?>
                </span>
                </div>
                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                  <span class="time-meta pull-right"><?= $u->username ?>
                </span>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach ?>
<?= $this->endSection() ?>


<?= $this->section('sidebar') ?>
<div class="row searchBox">
          <div class="col-sm-12 searchBox-inner">
            <div class="form-group has-feedback">
              <input id="searchText" type="text" class="form-control" name="searchText" placeholder="Search">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>
          </div>
        </div>

        <div class="row sideBar">
        <?php foreach($recentChat as $rc): ?>
          <div class="row sideBar-body contact" user-id=<?= $rc->username ?> user-name=<?= $rc->name ?>>
            <div class="col-sm-3 col-xs-3 sideBar-avatar">
              <div class="avatar-icon">
                <img src="https://bootdey.com/img/Content/avatar/avatar1.png">
              </div>
            </div>
            <div class="col-sm-9 col-xs-9 sideBar-main">
              <div class="row">
                <div class="col-sm-8 col-xs-8 sideBar-name">
                  <span class="name-meta"><?= $rc->username ?>
                </span>
                </div>
                <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                  <span class="time-meta pull-right">18:18
                </span>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach ?>

        </div>
      </div>
<?= $this->endSection() ?>


<?= $this->section('conversation') ?>
<div class="row heading">
        <div class="col-sm-2 col-md-1 col-xs-3 heading-avatar">
          <div class="heading-avatar-icon">
            <img src="https://bootdey.com/img/Content/avatar/avatar6.png">
          </div>
        </div>
        <div class="col-sm-8 col-xs-7 heading-name">
          <a class="heading-name-meta" id="recipient-name">John Doe
          </a>
          <span class="heading-online">Online</span>
        </div>
        <div class="col-sm-1 col-xs-1  heading-dot pull-right">
          <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
        </div>
      </div>

      <div class="row message" id="conversation">
        <!-- <div class="row message-previous">
          <div class="col-sm-12 previous">
            <a onclick="previous(this)" id="ankitjain28" name="20">
            Show Previous Message!
            </a>
          </div>
        </div>

        <div class="row message-body">
          <div class="col-sm-12 message-main-receiver">
            <div class="receiver">
              <div class="message-text">
               Hi, what are you doing?!
              </div>
              <span class="message-time pull-right">
                Sun
              </span>
            </div>
          </div>
        </div>

        <div class="row message-body">
          <div class="col-sm-12 message-main-sender">
            <div class="sender">
              <div class="message-text">
                I am doing nothing man!
              </div>
              <span class="message-time pull-right">
                Sun
              </span>
            </div>
          </div>
        </div>-->
      </div> 

      <div class="row reply">
        <div class="col-sm-1 col-xs-1 reply-emojis">
          <i class="fa fa-smile-o fa-2x"></i>
        </div>
        <div class="col-sm-9 col-xs-9 reply-main">
        <?= csrf_field() ?>
          <textarea class="form-control" rows="1" id="comment"></textarea>
        </div>
        <div class="col-sm-1 col-xs-1 reply-recording">
          <i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
        </div>
        <div class="col-sm-1 col-xs-1 reply-send" id="send-message">
          <i class="fa fa-send fa-2x" aria-hidden="true"></i>
        </div>
      </div>
<?= $this->endSection() ?>


<?= $this->section('script') ?>
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
              <div class="message-text">
                `+message+`
              </div>
              <span class="message-time pull-right">
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
          var template = `        <div class="row message-body">
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