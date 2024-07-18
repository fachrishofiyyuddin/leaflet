<?php
// ambil koneksi dari folder koneksi
include "koneksi/index.php";

header('Content-Type: application/json');

// Query SQL untuk mengambil data koordinat dan mengelompokkannya berdasarkan id_area
$sql = "SELECT coordinates.id_area, areas.name, students.jumlah, GROUP_CONCAT( CONCAT( coordinates.lat, ',', coordinates.lng ) SEPARATOR ';' ) AS coordinates FROM coordinates JOIN areas ON coordinates.id_area = areas.id JOIN students ON students.id_area = areas.id GROUP BY coordinates.id_area";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Inisialisasi array untuk menyimpan data koordinat
    $coordinates = array();

    // Loop melalui setiap baris hasil query
    while ($row = $result->fetch_assoc()) {
        // Explode coordinates menjadi array koordinat yang terpisah
        $coords = array_map(function ($coord) {
            return explode(',', $coord);
        }, explode(';', $row['coordinates']));

        // Tambahkan data koordinat dan nama area ke dalam array
        $coordinates[$row['id_area']] = array(
            'name' => $row['name'],
            'jumlah' => $row['jumlah'],
            'coords' => $coords
        );
    }

    // Mengirimkan data sebagai JSON
    echo json_encode($coordinates);
} else {
    echo json_encode(array()); // Jika tidak ada hasil, kirimkan array kosong
}


// Tutup koneksi database
$conn->close();
