var map;
var polygons = {}; // Objek untuk menyimpan poligon berdasarkan id_area
var markers = []; // Array untuk menyimpan semua marker

// Function untuk menghasilkan warna acak dalam format RGB
function getRandomColor() {
    var r = Math.floor(Math.random() * 256); // Komponen merah
    var g = Math.floor(Math.random() * 256); // Komponen hijau
    var b = Math.floor(Math.random() * 256); // Komponen biru
    return 'rgb(' + r + ',' + g + ',' + b + ')';
}

// Function untuk mengambil data koordinat dari server menggunakan AJAX
function fetchPolygonPointsFromDatabase(callback) {
    $.ajax({
        url: 'api.php', // Endpoint API tanpa parameter
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Loop through each id_area
            $.each(data, function(id_area, area) {
                var name = area.name;
                var coords = area.coords;
                var jumlah = area.jumlah; // Ambil jumlah mahasiswa

                // Ambil polygonPoints dari data respons
                var polygonPoints = [];

                // Loop through each coordinate data
                $.each(coords, function(index, coord) {
                    polygonPoints.push([parseFloat(coord[0]), parseFloat(coord[1])]);
                });

                // Tampilkan poligon dengan polygonPoints yang diperoleh
                displayPolygon(id_area, name, jumlah, polygonPoints);
            });

            // Panggil callback setelah selesai
            if (typeof callback === 'function') {
                callback();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('There was a problem with the AJAX request: ' + textStatus, errorThrown);
        }
    });
}

// Function untuk menampilkan poligon dengan polygonPoints yang diperoleh dari database
function displayPolygon(id_area, name, jumlah, polygonPoints) {
    // Hapus poligon yang mungkin sudah ada
    if (polygons[id_area]) {
        map.removeLayer(polygons[id_area]);
    }

    // Membuat poligon baru dengan polygonPoints, warna acak, dan menambahkannya ke peta
    polygons[id_area] = L.polygon(polygonPoints, {
        color: getRandomColor(), // Warna garis
        fillColor: getRandomColor(), // Warna isi
        fillOpacity: 0.5 // Opasitas isi
    }).addTo(map);

    // Tambahkan marker di tengah-tengah poligon
    var centerLatLng = getPolygonCenter(polygonPoints);
    var marker = L.marker(centerLatLng);

    // Tambahkan tooltip dengan nama area (judul pop-up)
    marker.bindTooltip(name, {
        permanent: true,
        className: 'tooltip-class'
    });

    // Tambahkan marker ke peta
    marker.addTo(map);

    // Tambahkan event listener untuk menampilkan modal saat klik pada poligon
    polygons[id_area].on('click', function(event) {
        // Isi modal dengan informasi yang sesuai
        $('#modalTitle').text(name);
        $('#areaName').text(name);
        $('#studentCount').text(jumlah);

        // Kosongkan tabel sebelum menambahkan data baru
        $('#coordinateTableBody').empty();

        // Tambahkan baris untuk setiap koordinat
        polygonPoints.forEach(function(coord) {
            var lat = coord[0];
            var lng = coord[1];
            var row = '<tr><td>' + lat + '</td><td>' + lng + '</td></tr>';
            $('#coordinateTableBody').append(row);
        });

        // Tampilkan modal
        $('#myModal').modal('show');
    });

    // Centang peta pada poligon
    map.fitBounds(polygons[id_area].getBounds());
}


// Function untuk mendapatkan titik tengah-tengah dari suatu poligon
function getPolygonCenter(polygonPoints) {
    var bounds = new L.LatLngBounds();
    polygonPoints.forEach(function(point) {
        bounds.extend(point);
    });
    return bounds.getCenter();
}

// Panggil function untuk menampilkan semua poligon saat halaman dimuat
$(document).ready(function() {
    // Tampilkan preloader selama 3 detik
    setTimeout(function() {
        $('#preloader').hide(); // Sembunyikan preloader
        $('#map').show(); // Tampilkan peta
        map = L.map('map').setView([-7.183, 210.413], 13); // Koordinat tengah peta dan zoom awal

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Panggil fungsi untuk mengambil dan menampilkan poligon dari database
        fetchPolygonPointsFromDatabase();
    }, 3000); // Delay 3 detik sebelum menampilkan peta
});