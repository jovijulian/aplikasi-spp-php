<?php
session_start();
require_once("../db/koneksi.php");
// Jika sesi dari login belum dibuat maka akan kita kembalikan ke halaman login
if(!isset($_SESSION['nisn'])){
    header("location: login_siswa.php");
}else{
    // Jika sudah dibuatkan sesi maka akan kita masukkan kedalam variabel
    $nisn = $_SESSION['nisn'];
}
$siswa = mysqli_query($conn, "SELECT * FROM siswa 
JOIN kelas ON siswa.id_kelas=kelas.id_kelas 
WHERE nisn='$nisn'");
$result = mysqli_fetch_assoc($siswa);
$pembayaran = mysqli_query($conn, "SELECT * FROM pembayaran 
JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas 
JOIN spp ON pembayaran.id_spp = spp.id_spp
WHERE nisn='$nisn'
ORDER BY tgl_bayar");
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
    <style>
    .biodata {
        border: 2px solid black;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg static-top" style="background-color: #78938A;">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <diSv class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#biodata">Biodata Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#histori">Histori Pembayaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="logout.php" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Logout</a>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin ingin keluar?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tidak</button>
                                        <a href="logout.php" type="button" class="btn btn-danger">Ya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </diSv>
        </div>
    </nav>
    <div class="container">

        <h1 class="mt-5 text-center">Sistem Informasi SPP Siswa SMK Medikacom</h1>
        </br>

        <div id="printarea">
            <div class="container">
                <h3>Biodata Kamu</h3>
                <table cellpadding="5" class="biodata" id="biodata">
                    <tr>
                        <td>NISN</td>
                        <td>:</td>
                        <td><?= $result['nisn']; ?></td>
                    </tr>
                    <tr>
                        <td>NIS</td>
                        <td>:</td>
                        <td><?= $result['nis']; ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $result['nama']; ?></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><?= $result['nama_kelas'] . " | " . $result['kompetensi_keahlian']; ?></td>
                    </tr>
                </table>
            </div>

            <!-- //table transaksi -->
            <div class="row">
                <table class="table table-striped mt-2 text-light" border="1" id="histori"
                    style="background-color: #464E2E;">
                    <thead>
                        <tr>
                            <td class="text-center" scope="col">No. </td>
                            <td scope="col">Tanggal Dibayar</td>
                            <td scope="col">Tahun | Nominal Bayar</td>
                            <td scope="col">Jumlah Dibayar</td>
                            <td scope="col">Nama Petugas</td>
                            <td scope="col">Status</td>
                        </tr>
                    </thead>
                    <?php 
                        $no=1;
                        while($isi = mysqli_fetch_assoc($pembayaran)){ ?>
                    <tr class="text-light">
                        <td class="text-center text-light"><?= $no ?></td>
                        <td class="text-light">
                            <?= $isi['tgl_bayar'] . "-" . $isi['bulan_dibayar'] . "-" . $isi['tahun_dibayar']; ?></td>
                        <td class="text-light"><?= $isi['tahun'] . " | Rp. " . $isi['nominal']; ?></td>
                        <td class="text-light"><?= $isi['jumlah_bayar']; ?></td>
                        <td class="text-light"><?= $isi['nama_petugas']; ?></td>
                        <td>
                            <h5 style="color: white; font-weight: bold;">LUNAS</h5>
                        </td>
                    </tr>
                    <?php $no++; } ?>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>