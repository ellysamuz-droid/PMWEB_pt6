<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loginForm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <style>
        body{
            height:100vh;
            background-image: url('login.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .login-section {
            height: 100vh;   
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

    <div class="container-fluid login-section">
        <div class="row h-100">
            <div class="col-md-7"></div>
            <div class="col-md-5 d-flex align-items-center">
                <div class="login-box shadow">
                    <h4 class="text-center mb-3">Login</h4>

                    <form action="proseslogin.php" method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="forgot_password.php" class="small text-decoration-none">Forgot Password?</a>
                        </div>
                        <button type="submit" class="btn btn-custom">Submit</button>
                    </form>
                    <div class="footer">
                        Belum punya akun? <a href="registrasi.php">Daftar sekarang</a>
                    </div>
                </div>
            </div>
        </div>     
    </div>
</body>
</html>