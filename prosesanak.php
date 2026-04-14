<?php
include 'koneksi.php';

$nama_anak = $_POST['nama_anak'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir_anak = $_POST['tanggal_lahir_anak'];
$nama_orang_tua = $_POST['nama_orang_tua'];
$alamat = $_POST['alamat'];

if (empty($nama_anak) || empty($jenis_kelamin) || empty($tanggal_lahir_anak) || empty($nama_orang_tua) || empty($alamat)) {
    echo "Semua wajib diisi!";
    exit;
}

$query = "INSERT INTO data_anak (nama_anak, jenis_kelamin, tanggal_lahir_anak, nama_orang_tua, alamat) VALUES ('$nama_anak', '$jenis_kelamin', '$tanggal_lahir_anak', '$nama_orang_tua', '$alamat')";
$result = mysqli_query($koneksi, $query);

if ($result){
        header ("Location: timetable.php");
    } else {
        echo "Register Gagal: " . mysqli_error($koneksi);
    }
?>