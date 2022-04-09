<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Starter Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/starter-template/">



    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

            <!--CSS LeafletJS-->
            <link
            rel="stylesheet"
            href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
            integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
            crossorigin=""/>

            
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://warungbelajar.com">Warung Belajar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="<?= site_url('tes'); ?>">Tes</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= site_url('location'); ?>">Atur Lokasi</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= site_url('chat'); ?>">Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url(); ?>/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">

        <div class="starter-template text-center py-5 px-3">
            <h1>Hai ! <?= session()->get('name'); ?></h1>
            <p class="lead">Selamat Datang di Warung Belajar, Kita sudah belajar membuat Authentikasi dengan Codeigniter 4</p>
            <br>
            <p><?= session()->get('address');?></p>
        </div>

        <hr />
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Jarak</th>
                </tr>
                <?php
                $no = 1;

                $usernow = session()->get('username');
                foreach ($users as $row){
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row->username; ?></td>
                        <td><?= $row->address; ?></td>
                        <td><?= $row->latitude; ?></td>
                        <td><?= $row->longitude; ?></td>
                        <td><?= number_format((float)$row->jarak_km, 2, '.', ''); ?> km</td>
                        <td><a title="Edit" href="<?= base_url("users/pilih/$row->username"); ?>" class="btn btn-info">pilih</a></td>
                    </tr>
                <?php
                }
                ?>
            </table>


    </main><!-- /.container -->


    <script src="https://getbootstrap.com/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>