<!DOCTYPE html>
<html>

<head>
    <title>Peta Kampus</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div id="preloader">
        <h4>Mohon ditunggu, sedang memuat...</h4>
    </div>

    <div class="container">
        <h3>Tampilan Demo Interaktif: Pemetaan Maps dengan Leaflet dan Data JSON dari MySQLi menggunakan PHP</h3>
        <hr>
        <div id="map" style="display: none;"></div>

        <!-- Modal untuk menampilkan informasi area -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="modalTitle"></h4>
                    </div>
                    <div class="modal-body">
                        <!-- Tabel untuk menampilkan lat dan lng -->
                        <h4><i>Data Koordinat</i></h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                </tr>
                            </thead>
                            <tbody id="coordinateTableBody">
                                <!-- Data akan dimasukkan ke sini oleh JavaScript -->
                            </tbody>
                        </table>

                        <p>Informasi lain tentang <span id="areaName"></span></p>
                        <p><b>Jumlah mahasiswa: </b><span id="studentCount"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- leaflet -->
    <script src="assets/js/index.js"></script>
</body>

</html>