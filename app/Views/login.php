<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url(); ?>/assets/login/fonts/icomoon/style.css">

  <link rel="stylesheet" href="<?= base_url(); ?>/assets/login/css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/login/css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/login/css/style.css">

  <title>Login Mentor</title>
</head>

<body>



  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="<?= base_url() ?>/assets/login/images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <h3>Sign In to <strong>Mentor</strong></h3>
                <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
              </div>
              <form action="<?= site_url('login/process'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group first">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username">

                </div>
                <div class="form-group last mb-4">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>

                <!-- <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="<?= site_url('register'); ?>" class="forgot-pass">Register</a></span> 
              </div> -->

                <input type="submit" value="Log In" class="btn text-white btn-block btn-primary">

                <span class="d-block text-left my-4 text-muted"> Belum memiliki akun ? <a href="<?= site_url('register'); ?>">Register</a></span>

                <!-- <div class="social-login">
                <a href="<?= base_url(); ?>#" class="facebook">
                  <span class="icon-facebook mr-3"></span> 
                </a>
                <a href="<?= base_url(); ?>#" class="twitter">
                  <span class="icon-twitter mr-3"></span> 
                </a>
                <a href="<?= base_url(); ?>#" class="google">
                  <span class="icon-google mr-3"></span> 
                </a>
              </div> -->
              </form>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>


  <script src="<?= base_url(); ?>/assets/login/js/jquery-3.3.1.min.js"></script>
  <script src="<?= base_url(); ?>/assets/login/js/popper.min.js"></script>
  <script src="<?= base_url(); ?>/assets/login/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>/assets/login/js/main.js"></script>
</body>

</html>