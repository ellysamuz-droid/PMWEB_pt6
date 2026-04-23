<?php
include 'koneksi.php';

header('Content-Type: application/json');

$query = mysqli_query($koneksi, "SELECT * FROM data_anak ORDER BY id_anak DESC LIMIT 1");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo json_encode(["error" => "Data anak tidak ditemukan"]);
    exit;
}

echo json_encode([
    "nama_anak" => $data['nama_anak'],
    "tanggal_lahir" => $data['tanggal_lahir_anak']
]);
?>