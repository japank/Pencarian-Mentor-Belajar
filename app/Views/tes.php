<html>

<head>
  <meta charset="utf-8" />
  <title>Display a basemap layer</title>
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>

  <!-- Load Esri Leaflet from CDN -->
  <script src="https://unpkg.com/esri-leaflet@3.0.10/dist/esri-leaflet.js"></script>

  <!-- Load Esri Leaflet Vector from CDN -->
  <script src="https://unpkg.com/esri-leaflet-vector@4.0.0/dist/esri-leaflet-vector.js" crossorigin=""></script>
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

    const map = L.map("map").setView([48.865195, 2.321033], 16);

    L.esri.Vector.vectorBasemapLayer("ArcGIS:Streets", {
      apikey: apiKey
    }).addTo(map);
    L.marker([48.865195, 2.321033])
      .addTo(map)
      .bindPopup("<b>Ini adalah lokasi mu</b>").openPopup();
  </script>
</body>

</html>