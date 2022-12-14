<html>

<head>
  <meta charset="utf-8" />
  <title>Reverse geocode sample</title>
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" crossorigin=""></script>
  <!-- Load Esri Leaflet from CDN -->
  <script src="https://unpkg.com/esri-leaflet@^3.0.8/dist/esri-leaflet.js"></script>
  <!-- Load Esri Leaflet Geocoder from CDN -->
  <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.3/dist/esri-leaflet-geocoder.css" crossorigin="" />
  <script src="https://unpkg.com/esri-leaflet-geocoder@3.1.3/dist/esri-leaflet-geocoder.js" crossorigin=""></script>
  <style>
    html,
    body,
    #map {
      padding: 0;
      margin: 0;
      height: 100%;
      width: 100%;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 14px;
      color: #323232;
    }
  </style>
</head>

<body>
  <div id="map"></div>
  <script>
    const apiKey = "AAPK40a9b84e145248348faf7141af6f0a8cwEBJEVkfL6c19d8pfqMcvaDZ3TFGulklEN0ZJw2cuTUCG6cBH3MHx6weyhHZRpH4";

    const map = L.map("map").setView([40.725, -73.985], 13);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);


    map.on("click", function(e) {
      L.esri.Geocoding
        .reverseGeocode({
          apikey: apiKey
        })
        .latlng(e.latlng)
        .run(function(error, result) {
          if (error) {
            return;
          }

          L.marker(result.latlng).addTo(map).bindPopup(result.address.Match_addr).openPopup();
        });
    });
  </script>
</body>

</html>