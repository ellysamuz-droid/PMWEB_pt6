<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "reminderimunisasi";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi dengan database gagal: " . mysqli_connect_error());
}
?>