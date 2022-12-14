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

  <title>Register Mentor</title>
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
                <h3>Register <strong>Mentor</strong></h3>
                <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
              </div>
              <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <h4>Periksa Entrian Form</h4>
                  </hr />
                  <?php echo session()->getFlashdata('error'); ?>
                </div>
              <?php endif; ?>
              <form action="<?= site_url('register/process'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group first">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username">

                </div>
                <div class="form-group last mb-4">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group last mb-4">
                  <label for="password_conf">Confirm Password</label>
                  <input type="password" class="form-control" id="password_conf" name="password_conf">
                </div>
                <div class="form-group last mb-4">
                  <label for="name">Nama</label>
                  <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group last mb-4">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group last mb-4">Kelas
                  <select style="background-color: transparent; border-color:transparent; color:dimgray" class="form-select" id="kelas" name="kelas">
                    <option value="1">1 SD</option>
                    <option value="2">2 SD</option>
                    <option value="3">3 SD</option>
                    <option value="4">4 SD</option>
                    <option value="5">5 SD</option>
                    <option value="6">6 SD</option>
                    <option value="7">1 SMP</option>
                    <option value="8">2 SMP</option>
                    <option value="9">3 SMP</option>
                    <option value="10">1 SMA</option>
                    <option value="11">2 SMA</option>
                    <option value="12">3 SMA</option>
                  </select>
                </div>
                <div class="form-group last mb-4">Daftar sebagai
                  <select style="background-color: transparent; border-color:transparent; color:dimgray" class="form-select" id="role" name="role">
                    <option value="siswa">Siswa</option>
                    <option value="pendamping">Mentor</option>
                  </select>
                </div>



                <input type="submit" value="Register" class="btn text-white btn-block btn-primary">

                <span class="d-block text-left my-4 text-muted"> Sudah memiliki akun ? <a href="<?= site_url('login'); ?>">Login</a></span>

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