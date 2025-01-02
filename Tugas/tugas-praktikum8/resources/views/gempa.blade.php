<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peta gempa indonesia</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <style>
    #map {
      height: 500px;
    }
  </style>

</head>

<body>
  <div class="map" id="map"></div>
</body>
<script>
  var map = L.map('map').setView([-0.3155398750904368, 117.1371833207888], 5);
  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

  let files = {!! file_get_contents('https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json') !!}
  console.log(files);

  let gempas = files.Infogempa.gempa
  console.log(gempas)

  gempas.forEach(gempa => {
    let koordinat = gempa.Coordinates.split(",");
    let lat = koordinat[0];
    let long = koordinat[1];

    // untuk menampilkan koordinat gempa 
    let marker = L.marker([lat, long]).addTo(map);
    console.log(marker);

    // untuk menampilkan informasi gempa 
    marker.bindPopup(
      `Wilayah : ${gempa.Wilayah} <br>` +
      `Tanggal : ${gempa.Tanggal} <br>` +
      `Jam : ${gempa.Jam} <br>` +
      `Kekuatan : ${gempa.Magnitude} <br>` +
      `Potensi : ${gempa.Potensi} <br>`
      // `Kedalaman : ${gempa.Kedalaman} <br>`
    )
  })
</script>

</html>
