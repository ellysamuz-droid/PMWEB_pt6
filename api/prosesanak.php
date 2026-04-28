<?php
include 'koneksi.php';

$nama_anak = $_POST['nama_anak'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir_anak = $_POST['tanggal_lahir_anak'];
$nama_orang_tua = $_POST['nama_orang_tua'];
$alamat_lengkap = $_POST['alamat_lengkap'];

if (empty($nama_anak) || empty($jenis_kelamin) || empty($tanggal_lahir_anak) || empty($nama_orang_tua) || empty($alamat_lengkap)) {
    echo "Semua wajib diisi!";
    exit;
}

$cek = mysqli_query($koneksi, "SELECT * FROM dataanak 
    WHERE nama_anak='$nama_anak' 
    AND tanggal_lahir_anak='$tanggal_lahir_anak'");

if (mysqli_num_rows($cek) > 0) {
    // ❗ kalau sudah ada → tidak insert
    echo "<script>
        alert('Data anak sudah terdaftar!');
        window.location='timetable.php';
    </script>";
} else {
    // ✅ kalau belum → insert
    $query = "INSERT INTO dataanak   
    (nama_anak, jenis_kelamin, tanggal_lahir_anak, nama_orang_tua, alamat_lengkap) 
    VALUES 
    ('$nama_anak', '$jenis_kelamin', '$tanggal_lahir_anak', '$nama_orang_tua', '$alamat_lengkap')";

    $result = mysqli_query($koneksi, $query);

    if ($result){
        header("Location: timetable.php");
    } else {
        echo "Register Gagal: " . mysqli_error($koneksi);
    }
}
?>