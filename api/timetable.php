<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TimeTable</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <style>
        .navbar-custom {
            background-color: indianred;
            padding: 15px 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand, .nav-link {
            color: white !important;
            font-weight: 600;
        }

        .bg-imunisasi {
            background-image: url("../bgimunisasi.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 40px;
            margin: 0;
            border-radius: 10px;
        }

        .table-indianred th{
            background-color: indianred;
            color: white;
        }

        .container-red {
            background-color: indianred;
            color: white;
            border-radius: 10px;
            padding: 30px;
        }
    </style>

    <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container-fluid">
            <h2><a class="navbar-brand" href="praktikum2.html">Reminder Imunisasi</a></h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="registrasi">
                        <a class="nav-link active" href="profil.php">PROFIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="timetable.php">TIMETABLE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-secondary ms-lg-3 px-3" href="logout.php" style="border-radius: 20px;">LOGOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 bg-imunisasi">

    <!-- jadwal imunisasi -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow p-4">
                    <div class="card-body container-red">
                        <h2 class="text-center mb-4">Jadwal Imunisasi Anak</h2>
                        <div class="mb-3">
                            <p>
                                <strong>Nama Anak :</strong>
                                <span id="namaAnak" class="fw-bold fs-6"></span>
                            </p>
                        </div>
                        <table class="table table-bordered table-hover table-center">
                            <thead class="table-header">
                                <tr>
                                    <th>Tanggal Imunisasi</th>
                                    <th>Jenis Vaksin</th>
                                </tr>
                            </thead>
                            <tbody id="jadwalTable"></tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <script>
        fetch('prosestimetable.php')
        .then(response => response.json())
        .then(res => {
            if (res.error) {
                alert(res.error);
                return;
            }

            document.getElementById("namaAnak").textContent = res.nama_anak;

            const tglLahir = res.tanggal_lahir;
            const lahir = new Date(tglLahir);
            const tabel = document.getElementById("jadwalTable");
            
            const daftarVaksin = [
                {bulan: 0, usia: "0-24 jam", vaksin: "Hepatitis B, Polio 0"},
                {bulan: 1, usia: "1 Bulan", vaksin: "BCG"},
                {bulan: 2, usia: "2 Bulan", vaksin: "DPT-HB-Hib 1, Polio 1"},
                {bulan: 3, usia: "3 Bulan", vaksin: "DPT-HB-Hib 2, Polio 2"},
                {bulan: 4, usia: "4 Bulan", vaksin: "DPT-HB-Hib 3, Polio 3"},
                {bulan: 9, usia: "9 Bulan", vaksin: "MR / Campak"},
                {bulan: 18, usia: "18 Bulan", vaksin: "Booster DPT-HB-Hib"}
            ];

            tabel.innerHTML = ""; // Bersihkan tabel

            daftarVaksin.forEach(function(item) {
                let tglImunisasi = new Date(lahir);
                tglImunisasi.setMonth(tglImunisasi.getMonth() + item.bulan);

                // Format tanggal ke Indonesia (dd/mm/yyyy)
                let tglIndo = tglImunisasi.toLocaleDateString('id-ID', {
                    day: '2-digit', month: '2-digit', year: 'numeric'
                });

                let row = `<tr>
                    <td>${tglIndo}</td>
                    <td>${item.vaksin}</td>
                </tr>`;
                tabel.innerHTML += row;
            });
        })
        .catch(err => {
            console.log("error: ", err);
        });
    </script>

    <div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="text center mb-4"> Tabel Imunisasi Dasar</h3>
    
        <!-- Table Imunisasi Dasar -->
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-indianred">
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">USIA</th>
                    <th scope="col">JENIS IMUNISASI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>0-24jam</td>
                    <td>Hepatitis B (HB-0), Polio 0</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>0-1 bulan</td>
                    <td>BCG</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>2 bulan</td>
                    <td>DPT-HB-Hib 1, Polio 1(tetes), PCV 1, Rotavirus 1</td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>3 bulan</td>
                    <td>DPT-HB-Hib 2, Polio 2(tetes), PCV 2, Rotavirus 2</td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>4 bulan</td>
                    <td>DPT-HB-Hib 3, Polio 3(tetes), Polio Suntik (IPV), PCV 3, Rotavirus 3</td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>6 bulan</td>
                    <td>Influenza (dosis 1), PCV 3 (opsional), Rotavirus 3</td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <td>9 bulan</td>
                    <td>MR/Campak 1, Japanese Encephalitis (JE-Daerah endemis)</td>
                </tr>
                <tr>
                    <th scope="row">8</th>
                    <td>12-15 bulan</td>
                    <td>Booster PCV, MR/Campak 2, Hepatitis A, Varicella (cacar air)</td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
    </div>
</body>
</html>