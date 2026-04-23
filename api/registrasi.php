!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registrasi</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <style>
        body{
            height:100vh;
            background-image: url("../bgimunisasi.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .login-box{
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            width:100%;
            max-width:400px;
        }

        .btn-custom {
            background-color: indianred;
            color: white;
            border: none;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
        }

        .btn-custom:hover {
            background-color: #c94c4c;
            color: white;
        }

        .footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }
    </style>
    <div class="container-fluid vh-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-4">
                <div class="login-box shadow">
                    <h4 class="text-center mb-3">Registrasi</h4>
        
                    <form action="prosesregistrasi.php" method="post">
                        <div class="mb-3">
                            <label for="exampleDropdownFormEmail1" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Ellysaa">
                        </div>
                        <div class="mb-3">
                            <label for="exampleDropdownFormPassword1" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="coba1@gmail.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleDropdownFormPassword1" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="exampleDropdownFormPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="minimal 6 karakter">
                        </div>
                        <button type="submit" class="btn btn-custom">Sign in</button>
                    </form>
                    <div class="footer">
                        Sudah punya akun? <a href="loginForm.php">Masuk sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
