<?php
session_start();
require_once("../db/koneksi.php");
if(isset($_SESSION['nisn'])){
    header("location: index_siswa.php");
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
        background-color: #57B846;
    }
    </style>
</head>

<body>

    <div class="index">
        <div class="containeri">
            <div class="wrap">
                <span class="title">
                    Login Sebagai Siswa
                </span>
                <span class="title">
                    <form class="login" action="proseslogin.php" method="POST">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                            </span>
                            <input type="text" class="form-control" placeholder="NISN">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                        <div>
                            <span class="txt1">
                                Apakah anda seorang petugas?
                            </span>
                            <a class="txt1" href="../petugas/login_petugas.php">
                                Disini
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