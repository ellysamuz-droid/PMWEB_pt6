<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: loginForm.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fdfdfd
        }
        .navbar-custom{
            background-color: indianred;
            padding: 15px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: 600;
        }

        .main-hero-section {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            overflow: hidden; /* Agar sudut melengkung pada container */
        }

        /* --- Kolom Kiri: Dokter --- */
        .doctor-img-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .doctor-img {
            max-width: 100%;
            height: auto;
            max-height: 400px; /* Batas tinggi agar seimbang */
            border-radius: 15px; /* Sedikit melengkung pada gambar */
        }

        /* --- Kolom Kanan: Simple Solution Text --- */
        .solution-text-container {
            padding: 40px;
        }

        .solution-header {
            color: #ff8a8a; /* Pink kemerahan sesuai gambar */
            font-weight: 800; /* Ekstra bold */
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 30px;
            font-size: 2.2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.05); /* Sedikit bayangan teks */
        }

        .solution-list {
            list-style: none;
            padding: 0;
            margin: 0;
            position: relative; /* Penting untuk garis vertikal */
        }

        /* Garis vertikal penghubung angka 1-2-3 */
        .solution-list::before {
            content: '';
            position: absolute;
            left: 24px; /* Tengah-tengah lingkaran angka */
            top: 25px;
            bottom: 25px;
            width: 2px;
            background-color: #dee2e6; /* Warna garis abu-abu halus */
            z-index: 1;
        }

        .solution-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
            z-index: 2; /* Di atas garis */
        }

        /* Lingkaran Angka */
        .solution-number {
            background-color: #ff8a8a; /* Pink sesuai gambar */
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: -25px;
            position: relative;
            z-index: 3; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Bar Teks (Hujan Toska) */
        .solution-text-bar {
            background-color: #78b7b7; /* Hijau toska sesuai gambar */
            color: white;
            width: 100%;
            padding: 12px 15px 12px 40px; /* Padding kiri besar untuk overlap */
            border-radius: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 1rem;
        }

        .solution-list::before {
            content: '';
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: 20px;
            bottom: 80px;
            width: 2px;
            background-color: #dee2e6;
            z-index: 1;
        }

        /* Tombol Input Data Anak (Merah Bata Sesuai Gambar) */
        .btn-input-data {
            background-color: #d15b5b;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
            border: none;
            box-shadow: 0 4px 15px rgba(205, 92, 92, 0.3);
            margin-top: 30px;
        }
        .btn-input-data:hover {
            background-color: #b04a4a;
            color: white;
            transform: translateY(-3px);
        }

        /* --- Card Styling Bawah (Informasi Tambahan) --- */
        .bg-section {
            background-color: #fde2e2;
        }
        .card {
            border: none;
            transition: 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .card-img-top {
            height: 180px;
            object-fit: cover;
        }
        .btn-custom {
            background-color: indianred;
            color: white;
            border: none;
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">
            <h2><a class="navbar-brand" href="dashboard.php">Reminder Imunisasi</a></h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="registrasi">
                        <a class="nav-link active" href="profil.html">PROFIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="timetable.html">TIMETABLE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-secondary ms-lg-3 px-3" href="logout.php" style="border-radius: 20px;">LOGOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <img src="Remind Imunisasi.jpg" class="img-fluid" alt="banner">

    <div class="container my-5 py-3">

        <div class="row justify-content-center">
            <div class="col-lg-11">

                <div class="main-hero-section">
                    <div class="row g-0 align-items-center"> <div class="col-md-7 doctor-img-container p-4 p-md-5">
                            <img src="homekartun.jpg" class="img-fluid doctor-img shadow-sm" alt="Ilustrasi Dokter & Bayi Sehat">
                        </div>

                        <div class="col-md-5 solution-text-container">
                            <h1 class="solution-header text-md-start text-center">SIMPLE SOLUTION</h1>

                            <ul class="solution-list">
                                <li class="solution-item">
                                    <div class="solution-number">1</div>
                                    <div class="solution-text-bar">BAYI LAHIR</div>
                                </li>
                                <li class="solution-item">
                                    <div class="solution-number">2</div>
                                    <div class="solution-text-bar">IMUNISASI LENGKAP</div>
                                </li>
                                <li class="solution-item">
                                    <div class="solution-number">3</div>
                                    <div class="solution-text-bar">BAYI SEHAT</div>
                                </li>
                            </ul>

                            <div class="text-md-start text-center">
                                <a href="formAnak.php" class="btn btn-input-data btn-lg">Input Data Anak</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container text-center mt-5 bg-section p-5 rounded"> 
        <div class="row"> 
            <div class="col"> 
                <div class="card h-100"> 
                    <img src="imunisasi1.jpg" class="card-img-top" alt="manfaatimunsasi"> 
                    <div class="card-body d-flex flex-column"> 
                        <h5 class="card-title  fw-bold">Manfaat Imunisasi</h5> 
                        <p class="card-text">Dengan memberikan imunisasi pada anak sejak dini, kita membantu membangun sistem kekebalan tubuh yang kuat dan melindungi mereka dari penyakit yang dapat dicegah.</p> 
                        <a href="https://rstmc.co.id/artikel/pentingnya-imunisasi-bagi-anak-melindungi-masa-depan-sehat" class="btn btn-custom mt-auto">Go Link</a> 
                    </div> 
                </div> 
            </div> 
            <div class="col"> 
                <div class="card h-100"> 
                    <img src="imunisasi2.jpg" class="card-img-top" alt="Jadwal&Jenis Imunisasi"> 
                    <div class="card-body d-flex flex-column"> 
                        <h5 class="card-title fw-bold">Jadwal dan Jenis Imunisasi</h5> 
                        <p class="card-text">AImunisasi rutin lengkap merupakan salah satu cara yang efektif dalam mencegah penyebaran penyakit</p> 
                        <a href="https://www.alodokter.com/imunisasi" class="btn btn-custom mt-auto">Go Link</a> 
                    </div> 
                </div> 
            </div> 
            <div class="col"> 
                <div class="card h-100"> 
                    <img src="imunisasi3.jpg" class="card-img-top" alt="Dampak Negatif Bayi Tidak Imunisasi"> 
                    <div class="card-body d-flex flex-column"> 
                        <h5 class="card-title fw-bold">Dampak Negatif Bayi Tidak Imunisasi</h5> 
                        <p class="card-text">Anak lebih rentan terkena masalah kesehatan lain akibat malnutrisi. Pasalnya, anak yang berstatus gizi buruk memiliki risiko mudah terserang infeksi akibat penurunan daya tahan tubuh.</p> 
                        <a href="https://www.halodoc.com/artikel/ketahui-7-dampak-negatif-jika-bayi-tidak-diimunisasi?srsltid=AfmBOoo6NveZzQtC-ItdVFygNyXBonh0FohkLcrUP2NF9IZXsS14bBax" class="btn btn-custom mt-auto">Go Link</a> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div>
</body>
</html>