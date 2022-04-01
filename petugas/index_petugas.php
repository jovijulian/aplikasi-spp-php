<?php
session_start();
require_once("../db/koneksi.php");
//Jika sesi dari login belum dibuat maka akan kita kembalikan ke halaman login
if(!isset($_SESSION['username'])){
    header("location: login_petugas.php");
}else{
    // Jika sudah dibuatkan sesi maka akan kita masukkan kedalam variabel
    $username = $_SESSION['username'];
}
?>

<html>

<head>
    <title>Aplikasi Pembayaran SPP</title>
</head>

<body>
    <!-- Kita akan panggil menu navigasi -->
    <?php require_once("header.php"); ?>
    <center>
        <h3 class="mt-5">Selamat datang, <b><?= $username; ?></b></h3>
    </center>
    <br />
    <!-- <?php require_once("footer.php"); ?> -->
</body>

</html>