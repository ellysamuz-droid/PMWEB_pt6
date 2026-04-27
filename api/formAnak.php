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
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("../bgimunisasi.jpg");
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
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
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
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label small fw-bold">Provinsi</label>
                                    <select id="provinsi" name="provinsi" class="form-select">
                                        <option value="">-- Pilih Provinsi --</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label small fw-bold">Kabupaten/Kota</label>
                                    <select id="kabupatenkota" name="kabupaten" class="form-select" disabled>
                                        <option value="">-- Pilih Kabupaten --</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label small fw-bold">Kecamatan</label>
                                    <select id="kecamatan" name="kecamatan" class="form-select" disabled>
                                        <option value="">-- Pilih Kecamatan --</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="alamat_lengkap" id="alamat_lengkap">
                            <div class="mb-3"> 
                                <label class="form-label">Alamat Lengkap</label> 
                                <textarea name="alamat" class="form-control"></textarea> 
                            </div>
                            <button type="submit" class="btn btn-custom">Submit</button> 
                        </fieldset> 
                    </form>
                </div>
            </div>
        </div>
    </div> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // 1. MUAT PROVINSI (BPS)
            function loadProvinsi() {
                $.ajax({
                    url: 'bps_wilayah.php?action=provinsi',
                    method: 'GET',
                    success: function (res) {
                        if (res.status === 'OK') {
                            let options = '<option value="">-- Pilih Provinsi --</option>';
                            res.data.forEach(function (prov) {
                                options += `<option value="${prov.domain_id}">${prov.domain_name}</option>`;
                            });
                            $('#provinsi').html(options);
                        }
                    }
                });
            }

            loadProvinsi();

            // 2. PROVINSI -> KABUPATEN (BPS)
            $(document).on('change', '#provinsi', function () {
                const kode_prov = $(this).val();
                if (!kode_prov) {
                    $('#kabupatenkota').html('<option value="">-- Pilih Kabupaten/Kota --</option>').prop('disabled', true);
                    $('#kecamatan').html('<option value="">-- Pilih Kecamatan --</option>').prop('disabled', true);
                    return;
                }

                $('#kabupatenkota').html('<option value="">Memuat kabupaten...</option>').prop('disabled', true);

                $.ajax({
                    url: `bps_wilayah.php?action=kabupatenkota&kode=${kode_prov}`,
                    method: 'GET',
                    success: function (res) {
                        let options = '<option value="">-- Pilih Kabupaten/Kota --</option>';
                        if (res.status === 'OK' && res.data.length > 0) {
                            res.data.forEach(function (kab) {
                                options += `<option value="${kab.domain_id}">${kab.domain_name}</option>`;
                            });
                            $('#kabupatenkota').html(options).prop('disabled', false);
                        }
                    }
                });
            });

            // 3. KABUPATEN -> KECAMATAN (Menggunakan API Wilayah Luar agar pasti ada datanya)
            $(document).on('change', '#kabupatenkota', function () {
                const kode_kab = $(this).val(); // Contoh: 3578 (Surabaya)
                
                if (!kode_kab) {
                    $('#kecamatan').html('<option value="">-- Pilih Kecamatan --</option>').prop('disabled', true);
                    return;
                }

                $('#kecamatan').html('<option value="">Memuat kecamatan...</option>').prop('disabled', true);

                // Kita gunakan API emsifa karena API BPS Domain tidak menyediakan level kecamatan
                $.ajax({
                    url: `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kode_kab}.json`,
                    method: 'GET',
                    success: function (data) {
                        let options = '<option value="">-- Pilih Kecamatan --</option>';
                        if (data && data.length > 0) {
                            data.forEach(function (kec) {
                                options += `<option value="${kec.id}">${kec.name}</option>`;
                            });
                            $('#kecamatan').html(options).prop('disabled', false);
                        } else {
                            $('#kecamatan').html('<option value="">Kecamatan tidak ditemukan</option>');
                        }
                    },
                    error: function() {
                        $('#kecamatan').html('<option value="">Gagal memuat data</option>');
                    }
                });
            });
        });

        $(document).on('change', '#provinsi, #kabupatenkota, #kecamatan', function() {
            // Ambil teks yang tampil (bukan value angka/ID-nya)
            let prov = $('#provinsi option:selected').text();
            let kab  = $('#kabupatenkota option:selected').text();
            let kec  = $('#kecamatan option:selected').text();
            
            // Jangan gabungkan kalau masih tulisan "-- Pilih --"
            if($('#provinsi').val() !== "" && $('#kabupatenkota').val() !== "" && $('#kecamatan').val() !== "") {
                let gabung = kec + ", " + kab + ", " + prov;
                $('#alamat_lengkap').val(gabung);
            }
        });
    </script>
</body>
</html>