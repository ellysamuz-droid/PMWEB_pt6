<?php
include __DIR__ . '/koneksi.php';

$nama_anak          = $_POST['nama_anak']           ?? '';
$jenis_kelamin      = $_POST['jenis_kelamin']       ?? '';
$tanggal_lahir_anak = $_POST['tanggal_lahir_anak']  ?? '';
$nama_orang_tua     = $_POST['nama_orang_tua']      ?? '';
$no_hp              = $_POST['no_hp']               ?? '';
$wilayah            = $_POST['alamat_lengkap']      ?? '';
$detail_alamat      = $_POST['alamat_']             ?? '';

$alamat_lengkap     = trim($detail_alamat . ', ' . $wilayah, ', ');

if (empty($nama_anak) || empty($jenis_kelamin) || empty($tanggal_lahir_anak) || empty($nama_orang_tua) || empty($no_hp) || empty($alamat_lengkap)) {
    echo "Semua wajib diisi!";
    exit;
}

try {
    $db = Database::getInstance();

    // Cek apakah data anak sudah terdaftar
    $cek = $db->query(
        "SELECT id_anak FROM dataanak WHERE nama_anak = ? AND tanggal_lahir_anak = ? LIMIT 1",
        'ss',
        [$nama_anak, $tanggal_lahir_anak]
    );

    if (!empty($cek)) {
        echo "<script>
            alert('Data anak sudah terdaftar!');
            window.location='timetable.php';
        </script>";
        exit;
    }

    // Insert data baru
    $db->execute(
        "INSERT INTO dataanak (nama_anak, jenis_kelamin, tanggal_lahir_anak, nama_orang_tua, no_hp, alamat_lengkap) 
         VALUES (?, ?, ?, ?, ?)",
        'sssss',
        [$nama_anak, $jenis_kelamin, $tanggal_lahir_anak, $nama_orang_tua, $no_hp, $alamat_lengkap]
    );

    header("Location: timetable.php");
    exit;

} catch (RuntimeException $e) {
    echo "Register Gagal: " . $e->getMessage();
}
?>