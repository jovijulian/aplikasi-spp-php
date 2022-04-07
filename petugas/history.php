<?php
require_once("../db/require.php");

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

    <title>Transaksi</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
    .biodata {
        border: 2px solid black;
    }
    </style>
</head>

<body>
    <?php require_once("header.php"); ?>
    <div class="container">

        <h1 class="mt-5 text-center">Cetak Data Transaksi Siswa</h1>
        </br>

        <!-- //search -->
        <form action="#" method="POST">
            <button type="button" class="btn btn-success" onclick="printPage()">Cetak
            </button>
            <button class="btn btn-danger float-end" type="submit" name="cari">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                    viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </button><input class="btn text-light btn-dark float-end" type="text" name="nisn" placeholder="Input NISN"
                autofocus>
        </form>
        <hr>
        <?php
            // Kita lakukan proses pencariannya disini
            if(isset($_POST['cari'])){
                $nisn = $_POST['nisn'];
                // Kita panggil table siswa
                $biodataSiswa = mysqli_query($conn, "SELECT * FROM siswa 
                                JOIN kelas ON siswa.id_kelas=kelas.id_kelas 
                                WHERE nisn='$nisn'");
                // Table pembayaran wajib kita panggil
                $historyPembayaran = mysqli_query($conn, "SELECT * FROM pembayaran
                                    JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas
                                    JOIN spp ON pembayaran.id_spp=spp.id_spp
                                    WHERE nisn='$nisn'
                                    ORDER BY tgl_bayar");
                $r_siswa = mysqli_fetch_assoc($biodataSiswa);
        ?>
        <div id="printarea">
            <div class="container">
                <div>
                    <h2 class="text-center">SMK Medikacom</h2>
                </div>
                <h3>Biodata Siswa</h3>
                <table cellpadding="5" class="biodata">
                    <tr>
                        <td>NISN</td>
                        <td>:</td>
                        <td><?= $r_siswa['nisn']; ?></td>
                    </tr>
                    <tr>
                        <td>NIS</td>
                        <td>:</td>
                        <td><?= $r_siswa['nis']; ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $r_siswa['nama']; ?></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><?= $r_siswa['nama_kelas'] . " | " . $r_siswa['kompetensi_keahlian']; ?></td>
                    </tr>
                </table>
            </div>

            <!-- //table transaksi -->
            <div class="row">
                <table class="table table-striped bg-dark mt-2 text-light" border="1">
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
                        while($isi = mysqli_fetch_assoc($historyPembayaran)){ ?>
                    <tr class="text-light">
                        <td class="text-center text-light"><?= $no ?></td>
                        <td class="text-light">
                            <?= $isi['tgl_bayar'] . "-" . $isi['bulan_dibayar'] . "-" . $isi['tahun_dibayar']; ?></td>
                        <td class="text-light"><?= $isi['tahun'] . " | Rp. " . $isi['nominal']; ?></td>
                        <td class="text-light"><?= $isi['jumlah_bayar']; ?></td>
                        <td class="text-light"><?= $isi['nama_petugas']; ?></td>
                        <td>
                            <h5 style="color: darkgreen; font-weight: bold;">LUNAS</h5>
                        </td>
                    </tr>
                    <?php $no++; } ?>
                </table>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>

<script>
function printPage() {
    const a = document.getElementById('printarea')
    p = window.open("")
    p.document.write(a.outerHTML);
    p.print();
    p.close();
}
</script>