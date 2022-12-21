<?= $this->extend('layout/templateMentor'); ?>
<?= $this->section('content'); ?>

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Java Source Code</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" crossorigin=""></script>
    <!-- Load Esri Leaflet from CDN -->
    <script src="https://unpkg.com/esri-leaflet@^3.0.8/dist/esri-leaflet.js"></script>
    <!-- Load Esri Leaflet Geocoder from CDN -->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.3/dist/esri-leaflet-geocoder.css" crossorigin="" />
    <script src="https://unpkg.com/esri-leaflet-geocoder@3.1.3/dist/esri-leaflet-geocoder.js" crossorigin=""></script>
    <style>
        html {
            position: relative;
            height: 100%;
        }

        body {
            margin-bottom: 60px;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-color: #f5f5f5;
        }

        body>.container {
            padding: 60px 15px 10px;
        }

        .footer>.container {
            padding-right: 15px;
            padding-left: 15px;
        }

        code {
            font-size: 80%;
        }

        #map {
            margin-top: 20px;
            width: 100%;
            height: 300px;
        }

        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: 'Roboto', 'sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                                    <div class="alert bg-warning alert-dismissible fade show" role="alert">
                                        <h4>Periksa Entrian Form</h4>
                                        </hr />
                                        <?php echo session()->getFlashdata('error'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="col-lg-9">
                                    <?php $usernow = session()->get('username'); ?>
                                    <form method="post" action="<?= site_url('location/update/' . $usernow) ?>">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="lat2" id="lat2" class="form-control">
                                        <input type="hidden" name="long2" id="long2" class="form-control">
                                        <label for="address">Alamat Anda</label>
                                        <input type="text" name="address" id="address" class="form-control"> <br>
                                </div>
                                <div class="col-lg-3 d-flex align-items-center">
                                    <a class="btn btn-primary btn-block " onclick="getlokasi()" style="color: #fff;">Dapatkan lokasi</a>
                                </div>
                            </div>


                            <p id="lokasi"></p>
                            <!-- peta akan ditampilkan di bawah ini dengan ukuran lebar 600px dan tinggi 400px -->
                            <div id="mapid" style="border-radius: 8px; width: 100%; height: 320px "></div>

                            <p class="card-text" style="font-size: 0px;" id="output"></p>
                            <button type="submit" class="w-100 btn btn-lg btn-success">Save</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {

    });


    var lokasi = document.getElementById("lokasi");

    function getlokasi() {

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        }
    }

    function showPosition(position) {

        const apiKey = "AAPK40a9b84e145248348faf7141af6f0a8cwEBJEVkfL6c19d8pfqMcvaDZ3TFGulklEN0ZJw2cuTUCG6cBH3MHx6weyhHZRpH4";
        var mymap = L.map("mapid").setView(
            [position.coords.latitude, position.coords.longitude],
            20
        );
        var marker;

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mymap);

        marker = L.marker([position.coords.latitude, position.coords.longitude])
            .addTo(mymap)
            .bindPopup("<b>Ini adalah lokasi mu</b>").openPopup();

        document.getElementById("lat2").value = position.coords.latitude;
        document.getElementById("long2").value = position.coords.longitude;

        $.ajax({
            url: "https://nominatim.openstreetmap.org/reverse",
            data: "lat=" + position.coords.latitude +
                "&lon=" + position.coords.longitude +
                "&format=json",
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                document.getElementById("address").value = data.display_name;
            }
        })

        mymap.on("click", function(e) {
            L.esri.Geocoding
                .reverseGeocode({
                    apikey: apiKey
                })
                .latlng(e.latlng)
                .run(function(error, result) {
                    if (error) {
                        return;
                    }

                    marker.setLatLng(e.latlng).bindPopup(result.address.Match_addr).openPopup();

                    document.getElementById("lat2").value = e.latlng.lat;
                    document.getElementById("long2").value = e.latlng.lng;
                    document.getElementById("address").value = result.address.Match_addr;

                });


        });


    }
</script>

</html>
<?= $this->endSection('content'); ?>