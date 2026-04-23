<?php
header('Content-Type: application/json'); 

// URL API BPS spesifik yang sudah dites di Postman
$url = "https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/0000/var/211/th/125/key/21971963e56adba7a54f7d8dff9043c8";

// ambil data
$response = file_get_contents($url);

// cek error
if ($response === FALSE) {
    echo json_encode(["error" => "Gagal mengambil data"]);
    exit;
}

// kirim ke frontend
echo $response;
?>