<body>
    <style>
        body{
            height:100vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("../bgimunisasi.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sand-serif;
        }

        .login-section {
            height: 100vh;  
        }

        .login-box{
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            width:100%;
            max-width: 700px;
        }

        .btn-custom {
            background-color: indianred;
            color: white;
            border: none;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-custom:hover {
            background-color: #c94c4c;
            color: white;
        }
    </style>
    <div class="container-fluid edit-section">
        <div class="row h-100">
            <div class="col-md-7"></div>
            <div class="col-md-5 d-flex align-items-center">
                <div class="login-box shadow">
                   
                    <h2 class="text-center mb-3">Tambah Pengguna</h2>

                    <form action="prosestambah.php" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label></label>
                            <input type="text" name="username" placeholder="Masukkan Nama" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="contoh1@gmail.com" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" placeholder="minimal 6 karakter" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="role" class="form-label">Posisi Pengguna</label>
                            <select name="role" required>
                                <option value="" disabled selected>Pilih Role</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-custom">Tambah Data</button>
                    </form>
                    <div class="auth-footer">
                        <br>
                        <a href="dashboardadmin.php" style="color: #667eea;">&larr; Kembali ke Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>