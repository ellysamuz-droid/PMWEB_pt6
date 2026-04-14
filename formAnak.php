<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formAnak</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body{
            height:100vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("bgimunisasi.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            overflow: hidden;
        }

        .full-height {
            height: 100vh;
        }

        .form-box{
            width:100%;
            max-width:500px;
            max-height:90vh;
            overflow-y: auto;
            background: rgba(255, 255, 255, 0.95); 
            padding: 30px;
            border-radius: 15px;
        }

        .btn-custom {
            background-color: indianred;
            color: white;
            border: none;
            width: 100%;
            padding: 12px;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background-color: #c94c4c;
            color: white;
        }
    </style>
</head>

<body>
    <div class="conatiner-fluid">
        <div class="row full-height justify-content-center align-items-center">

            <div class="col-md-5 d-flex align-items-center justify-content-center p-4">
                <div class="form-box shadow">
                    <form action="prosesanak.php" method="POST"> 
                        <fieldset> 
                            <legend>Input Data Anak</legend> 
                            <div class="mb-3"> 
                                <label for="disabledTextInput" class="form-label">Nama Anak</label> 
                                <input type="text" id="namaAnak" name="nama_anak" class="form-control" placeholder="Nama Lengkap" required> 
                            </div> 
                            <div class="mb-3">
                                <label for="jenisKelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenisKelamin" class="form-select" required>
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3"> 
                                <label class="form-label">Tanggal Lahir Anak</label> 
                                <input type="date" name="tanggal_lahir_anak" class="form-control" placeholder="Disabled input" required> 
                            </div> 
                            <div class="mb-3"> 
                                <label for="namaUrtu" class="form-label">Nama Orang Tua</label> 
                                <input type="text"  class="form-control" name="nama_orang_tua" placeholder="Ayah - Ibu"> 
                            </div> 
                            <div class="mb-3"> 
                                <label for="disabledTextInput" class="form-label">Alamat</label> 
                                <textarea class="form-control" rows="3" name="alamat" placeholder="Isi dengan Alamat Lengkap"></textarea> 
                            </div> 
                            <button type="submit" class="btn btn-custom">Submit</button> 
                        </fieldset> 
                    </form>
                </div>
            </div>
        </div>
    </div> 

</body>
</html>