<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script> -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!DOCTYPE html>
<html class=''>

<head>
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
</head>

<body>

	<!-- 

A concept for a chat interface. 

Try writing a new message! :)


Follow me here:
Twitter: https://twitter.com/thatguyemil
Codepen: https://codepen.io/emilcarlsson/
Website: http://emilcarlsson.se/

-->
	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top">
		<div class="container d-flex align-items-center">

			<h1 class="logo me-auto"><a href="<?= base_url(); ?>/index.html">Mentor</a></h1>
			<!-- Uncomment below if you prefer to use an image logo -->
			<!-- <a href="<?= base_url(); ?>/index.html" class="logo me-auto"><img src="<?= base_url(); ?>/assets/img/logo.png" alt="" class="img-fluid"></a>-->

			<nav id="navbar" class="navbar order-last order-lg-0">
				<ul>
					<li><a href="<?= base_url(); ?>/">Home</a></li>
					<li><a href="<?= base_url(); ?>/mentorchecked">Mentor</a></li>
					<li><a class="active" href="<?= base_url(); ?>/chat">Chat</a></li>
					<!-- <li><a href="<?= base_url(); ?>/events.html">Events</a></li>
        <li><a href="<?= base_url(); ?>/pricing.html">Pricing</a></li> 
-->
					<?php
					$tes = session()->get('role');
					if ($tes == 'pendamping') {
					?>
						<li class="dropdown"><a href="<?= base_url(); ?>/#"><span>Logbook</span> <i class="bi bi-chevron-down"></i></a>
							<ul>
								<li><a href="<?= base_url(); ?>/mylogbook">Logbook Saya</a></li>
								<li><a href="<?= base_url(); ?>/logbook">Logbook Siswa</a></li>
							</ul>
						</li>

						<li class="dropdown"><a href="<?= base_url(); ?>/#"><span>Request</span> <i class="bi bi-chevron-down"></i></a>
							<ul>
								<li><a href="<?= base_url(); ?>/mentor/request">Request Mentoring</a></li>
								<li><a href="<?= base_url(); ?>/mentor/requested">Request Jadi Mentor</a></li>
							</ul>
						</li>
					<?php } else { ?>
						<li><a href="<?= base_url(); ?>/mentor/request">Request</a></li>
						<li><a href="<?= base_url(); ?>/mylogbook">Logbook</a></li>
					<?php }
					?>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav><!-- .navbar -->

			<a href="<?= base_url(); ?>/logout" class="get-started-btn"><?= session()->get('username') ?></a>

		</div>
	</header><!-- End Header -->


	<div id="frame" style="padding-top: 6%;">
		<div id="sidepanel">
			<div id="profile">
				<!-- <div class="wrap">
					<img id="profile-img" src="http://emilcarlsson.se/assets/mikeross.png" class="online" alt="" />
					<p><?= session()->get('username'); ?></p>
					<i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
					<div id="status-options">
						<ul>
							<li id="status-online" class="active"><span class="status-circle"></span>
								<p>Online</p>
							</li>
							<li id="status-away"><span class="status-circle"></span>
								<p>Away</p>
							</li>
							<li id="status-busy"><span class="status-circle"></span>
								<p>Busy</p>
							</li>
							<li id="status-offline"><span class="status-circle"></span>
								<p>Offline</p>
							</li>
						</ul>
					</div>
					<div id="expanded">
						<label for="twitter"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></label>
						<input name="twitter" type="text" value="mikeross" />
						<label for="twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></label>
						<input name="twitter" type="text" value="ross81" />
						<label for="twitter"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></label>
						<input name="twitter" type="text" value="mike.ross" />
					</div>
				</div> -->
				<p>
					Recent Chats
				</p>
			</div>
			<!-- <div id="search">
				<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
				<input type="text" placeholder="Search contacts..." />
			</div> -->
			<?= $this->renderSection('contact') ?>

		</div>


		<div class="content">
			<div class="contact-profile">
				<!-- <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" /> -->

				<p id="recipient-name" style="margin-left: 40%;"> Please select a contact</p>

				<!-- <div class="social-media">
				<i class="fa fa-facebook" aria-hidden="true"></i>
				<i class="fa fa-twitter" aria-hidden="true"></i>
				 <i class="fa fa-instagram" aria-hidden="true"></i>
			</div> -->
			</div>

			<?= $this->renderSection('conversation') ?>

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
	<?= $this->renderSection('script') ?>

</body>

</html>