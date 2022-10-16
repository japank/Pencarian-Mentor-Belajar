    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQm7fskSlerL2C1_1ODi4-49MMQanF63Y&callback=initMap">
    </script>
    <script type='text/javascript' src="<?= base_url(); ?>assets/location.users.js"></script>
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

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lokasi Anda </h5><br>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>



                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php $usernow = session()->get('username'); ?>
                                    <form method="post" action="<?= site_url('location/update/' . $usernow) ?>">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="lat2" id="lat2" class="form-control">
                                        <input type="hidden" name="long2" id="long2" class="form-control">
                                        <label for="address">Alamat Anda</label>
                                        <input type="text" name="address" id="address" class="form-control"> <br>
                                        <div id="map"></div>
                                        <p class="card-text" style="font-size: 0px;" id="output"></p>
                                        <button type="submit" class="w-100 btn btn-lg btn-success">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

        });

        var map, infoWindow, geocoder, marker, accuracyStatus;
        var output = document.getElementById("output");

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 7,
                center: {
                    lat: 0.3439242,
                    lng: 102.3072246
                }
            });

            infowindow = new google.maps.InfoWindow();
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    if (position.coords.accuracy < 100) {
                        accuracyStatus = "Akurasi : " + position.coords.accuracy.toFixed(2) + "Bagus";
                        document.getElementById("lat2").value = position.coords.latitude;
                        document.getElementById("long2").value = position.coords.longitude;
                    } else {
                        accuracyStatus = "Akurasi : " + position.coords.accuracy.toFixed(2) + "Lemah";
                    }
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    geocoder = new google.maps.Geocoder();
                    geocoder.geocode({
                        'latLng': pos
                    }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            map.setZoom(18);
                            map.setCenter(pos);
                            marker = new google.maps.Marker({
                                position: pos,
                                map: map,
                                animation: google.maps.Animation.BOUNCE,
                            });

                            var infowindowText = "<div class='text-center'><strong>Posisi Anda</strong><br>" + results[0].formatted_address + '</strong></div>';
                            infowindow.setContent(infowindowText);
                            infowindow.open(map, marker);
                            marker.addListener('click', function() {
                                infowindow.open(map, marker);
                            });
                            output.innerHTML = results[0].formatted_address + "<br>Latitude : <span id='latitude'>" + pos.lat + "</span>Longitude : <span id='longitude'>" + pos.lng + "</span>";
                            document.getElementById("address").value = results[0].formatted_address;
                            // var infowindowText = "<div class='text-center'><strong>Posisi Anda</strong><br>" + results[0].formatted_address + "<br>Lat : " + pos.lat.toFixed(5) + " |  Long : " + pos.lng.toFixed(5) + "<br>" + accuracyStatus + "" + '</strong></div>';
                            // infowindow.setContent(infowindowText);
                            // infowindow.open(map, marker);
                            // marker.addListener('click', function() {
                            //     infowindow.open(map, marker);
                            // });
                            // output.innerHTML = results[0].formatted_address + "<br>Latitude : <span id='latitude'>" + pos.lat + "</span>Longitude : <span id='longitude'>" + pos.lng + "</span>";
                            // document.getElementById("address").value = results[0].formatted_address;

                        }
                    });
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                '<span class="alert alert-danger">Error: The Geolocation service failed.</span>' :
                '<span class="alert alert-danger">Error: Your browser doesnt support geolocation.</span>');
            infoWindow.open(map);
        }
    </script>