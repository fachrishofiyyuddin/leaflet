<?php
// ambil koneksi dari folder koneksi
include "koneksi/index.php";

// Query untuk mengambil data dari tabel geojson_data
$sql = "SELECT name, coordinates FROM geojson_data";
$result = $conn->query($sql);

// Array untuk menyimpan data koordinat
$features = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $coordinates = json_decode($row['coordinates'], true);
        $feature = array(
            "name" => $name,
            "coordinates" => $coordinates
        );
        array_push($features, $feature);
    }
}

$conn->close();

// Mengirimkan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($features);
