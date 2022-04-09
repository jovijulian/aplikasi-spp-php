<?php
session_start();
include '../db/koneksi.php';
if(isset($_SESSION['username'])){
    header("location: index_petugas.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Aplikasi Pembayaran SPP</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
    body {
        background-color: #78938A;
    }
    </style>
</head>

<body>

    <div class="index">
        <div class="containeri">
            <div class="wrapAktor">
                <span class="title">
                    Login Sebagai Petugas
                </span>
                <span class="title">
                    <form action="proseslogin.php" method="POST">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                            </span>
                            <input type="text" name="username" id="username" class="form-control"
                                placeholder="Username">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-key-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                </svg>
                            </span>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                        <div>
                            <br>
                            <span class="txt1 mb-3">
                                Apakah anda seorang siswa? Login
                            </span>
                            <a class="txt1" href="../siswa/login_siswa.php">
                                Disini!
                            </a>
                        </div>
                    </form>
                </span>
            </div>
        </div>
    </div>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>