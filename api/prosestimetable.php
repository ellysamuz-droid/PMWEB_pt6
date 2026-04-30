<?php
include 'koneksi.php';

header('Content-Type: application/json');

try {
    $db   = Database::getInstance();
    $rows = $db->query("SELECT * FROM dataanak ORDER BY id_anak DESC LIMIT 1");

    if (empty($rows)) {
        echo json_encode(["error" => "Data anak tidak ditemukan"]);
        exit;
    }

    $data = $rows[0];

    echo json_encode([
        "nama_anak"     => $data['nama_anak'],
        "tanggal_lahir" => $data['tanggal_lahir_anak']
    ]);

} catch (RuntimeException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>