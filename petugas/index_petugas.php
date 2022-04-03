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

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- Kita akan panggil menu navigasi -->
    <?php require_once("header.php"); ?>
    <div class="container" id="home">
        <div class="row text-center mb-5">
            <div class="col mt-5">
                <h2>Sistem Informasi Pembayaran SPP SMK Medikacom </h2>
                <h4>Anda login sebagai <b><?= $username; ?></b></h4>
            </div>
        </div>
        <div class="row justify-content-center fs-5">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-6">
                        <a href="data_siswa.php" style="text-decoration:none">
                            <div class="info-box mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" class="bi bi-people-fill"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    <path fill-rule="evenodd"
                                        d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                                    <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                                </svg>
                                <h3>Jumlah Siswa</h3>
                                <h3>
                                    <?php
                                    $siswa = mysqli_query($conn,"SELECT * FROM siswa");
                                    $jumlahSiswa = mysqli_num_rows($siswa);
                                ?>
                                    <?php echo "$jumlahSiswa" ?>
                                </h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="siswa.php" style="text-decoration:none">
                            <div class="info-box mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" class="bi bi-cash-stack"
                                    viewBox="0 0 16 16">
                                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                    <path
                                        d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z" />
                                </svg>
                                <h3>Total Transaksi</h3>
                                <h3>
                                    <?php
                                    $transaksi = mysqli_query($conn,"SELECT SUM(jumlah_bayar) FROM pembayaran");
                                    while($total = mysqli_fetch_array($transaksi)) {
                                    ?>
                                    <?php echo "Rp." . number_format($total['SUM(jumlah_bayar)']);?>
                                </h3>
                            </div>
                            <?php } ?>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="data_kelas.php" style="text-decoration:none">
                            <div class="info-box mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                    class="bi bi-house-door-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z" />
                                </svg>
                                <h3>Jumlah Kelas</h3>
                                <h3>
                                    <?php
                                    $kelas = mysqli_query($conn,"SELECT * FROM kelas");
                                    $jumlahKelas = mysqli_num_rows($kelas);
                                ?>
                                    <?php echo "$jumlahKelas" ?>
                                </h3>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="data_petugas.php" style="text-decoration:none">
                            <div class="info-box mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                    class="bi bi-person-workspace" viewBox="0 0 16 16">
                                    <path
                                        d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                    <path
                                        d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z" />
                                </svg>
                                <h3>Jumlah Petugas</h3>
                                <h3>
                                    <?php
                                    $petugas = mysqli_query($conn,"SELECT * FROM petugas");
                                    $jumlahPetugas = mysqli_num_rows($petugas);
                                ?>
                                    <?php echo "$jumlahPetugas" ?>
                                </h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />
    <!-- <?php require_once("footer.php"); ?> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>