<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Interaktif dengan AJAX dan Leaflet.js</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 600px;
        }
    </style>
</head>

<body>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // Inisialisasi peta Leaflet dengan pusat di Semarang
        var map = L.map('map').setView([-7.090911, 110.398804], 12);

        // Menambahkan tile layer OpenStreetMap sebagai base layer peta
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // AJAX untuk mengambil data dari API
        $.ajax({
            url: 'api.php', // Ganti dengan URL API yang sesuai
            type: 'GET',
            success: function(data) {
                // Menambahkan layer GeoJSON ke peta
                for (var i = 0; i < data.length; i++) {
                    var name = data[i].name;
                    var coordinates = data[i].coordinates;
                    var randomColor = getRandomColor();

                    // Membuat polygon untuk wilayah
                    var polygon = L.polygon(coordinates, {
                        color: randomColor,
                        fillOpacity: 0.7
                    }).addTo(map);
                    polygon.bindPopup(name);

                    // Menambahkan marker di tengah polygon (dengan ikon default Leaflet)
                    var center = getPolygonCenter(coordinates);
                    var marker = L.marker(center).addTo(map);
                    marker.bindPopup(name);
                }
            },
            error: function(xhr, status, error) {
                console.error('Gagal mengambil data: ' + status + ', ' + error);
            }
        });

        // Fungsi untuk menghasilkan warna acak
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Fungsi untuk mendapatkan titik tengah polygon
        function getPolygonCenter(coords) {
            var bounds = new L.LatLngBounds(coords);
            return bounds.getCenter();
        }
    </script>

</body>

</html>