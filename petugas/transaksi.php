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
</head>

<body>
    <?php require_once("header.php"); ?>
    <div class="container">

        <h1 class="mt-5 text-center">Transaksi</h1>
        </br>

        <!-- //add siswa -->
        <p><a href="tambah_siswa.php" data-bs-toggle="modal" data-bs-target="#modalTambah" type="button"
                class="btn btn-info tambah">+ Tambah Data</a>
        </p>


        <div class="modal fade" id="modalTambah" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <div class="modal-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="petugas" class="col-form-label">Petugas</label>
                                <div class="col-sm-12">
                                    <select name="petugas" class="form-select">
                                        <?php
                                        // Kita akan ambil Nama Petugas yang ada pada tabel Petugas
                                        $petugas = mysqli_query($conn, "SELECT * FROM petugas");
                                        while($r = mysqli_fetch_assoc($petugas)){ 
                                            ?>
                                        <option value="<?= $r['id_petugas']; ?>"><?= $r['nama_petugas']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nama_siswa" class="col-form-label">Nama Siswa</label>
                                <div class="col-sm-12">
                                    <select name="siswa" class="form-select">
                                        <?php
                                    // Kita akan ambil Nama Petugas yang ada pada tabel Petugas
                                    $siswa = mysqli_query($conn, "SELECT * FROM siswa");
                                    while($r = mysqli_fetch_assoc($siswa)){ 
                                        ?>
                                        <option value="<?= $r['nisn']; ?>"><?= $r['nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="tgl" class="col-form-label">Tanggal / Bulan / Tahun</label>
                                <select class="form-select" name="tgl_bayar">
                                    <option selected>Tanggal</option>
                                    <?php
                                        for($tgl_bayar=1; $tgl_bayar<=31; $tgl_bayar++){
                                            echo "<option value=$tgl_bayar>$tgl_bayar</option>";
                                        }
                                    ?>
                                </select>
                                <select class="form-select" name="bulan_dibayar">
                                    <option selected>Bulan</option>
                                    <?php
                                        $bulan_dibayar=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                        $jlh_bln=count($bulan_dibayar);
                                        for($c=0; $c<$jlh_bln; $c++){
                                            echo"<option value=$bulan_dibayar[$c]> $bulan_dibayar[$c] </option>";
                                        }
                                        ?>
                                </select>
                                <select class="form-select" name="tahun_dibayar">
                                    <option selected>Tahun</option>
                                    <?php
                                        $now=date('Y');
                                        for ($tahun_dibayar=2018;$tahun_dibayar<=$now;$tahun_dibayar++)
                                        {
                                            echo "<option value='$tahun_dibayar'>$tahun_dibayar</option>";
                                        }
                                        echo "</select>";
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="spp" class="col-form-label">SPP / Nominal Bayar</label>
                                <select name="spp" class="form-select">
                                    <?php
                                        // Ambil juga data SPP
                                        $spp = mysqli_query($conn, "SELECT * FROM spp");
                                        while($r = mysqli_fetch_assoc($spp)){ ?>
                                    <option value="<?= $r['id_spp']; ?>"><?= $r['tahun'] . " | " . $r['nominal']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_bayar" class="col-form-label">Jumlah Bayar</label>
                                <input type="text" name="jumlah_bayar" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="tambah">Submit</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- //table transaksi -->
        <div class="row">
            <table class="table table-striped bg-dark mt-2 text-light" border="1">
                <thead>
                    <tr>
                        <td class="text-center" scope="col">No. </td>
                        <td scope="col">Nama Siswa</td>
                        <td scope="col">Tanggal Dibayar</td>
                        <td scope="col">Tahun | Nominal Bayar</td>
                        <td scope="col">Jumlah Dibayar</td>
                        <td scope="col">Nama Petugas</td>
                        <td scope="col">Status</td>
                    </tr>
                </thead>

                <?php
                // Kita Konfigurasi Pagging disini
                    $totalDataHalaman = 5;
                    $data = mysqli_query($conn, "SELECT * FROM pembayaran");
                    $hitung = mysqli_num_rows($data);
                    $totalHalaman = ceil($hitung / $totalDataHalaman);
                    $halAktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
                    $dataAwal = ($totalDataHalaman * $halAktif) - $totalDataHalaman;
                    // Kita panggil tabel pembayaran
                    // Setelah kita panggil, JOIN tabel yang ter relasi ke tabel pembayaran
                    $sql = mysqli_query($conn, "SELECT * FROM pembayaran
                    JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas 
                    JOIN siswa ON pembayaran.nisn = siswa.nisn
                    JOIN spp ON pembayaran.id_spp = spp.id_spp
                    ORDER BY tgl_bayar ASC LIMIT $dataAwal, $totalDataHalaman");
                    $no = 1;
                    while($r = mysqli_fetch_assoc($sql)){ ?>

                <tr class="text-light">
                    <td class="text-center text-light"><?= $no ?></td>
                    <td class="text-light"><?= $r['nama']; ?></td>
                    <td class="text-light">
                        <?= $r['tgl_bayar'] . "-" . $r['bulan_dibayar'] . "-" . $r['tahun_dibayar']; ?></td>
                    <td class="text-light"><?= $r['tahun'] . " | Rp. " . $r['nominal']; ?></td>
                    <td class="text-light"><?= $r['jumlah_bayar']; ?></td>
                    <td class="text-light"><?= $r['nama_petugas']; ?></td>
                    <td>
                        <h5 style="color: darkgreen; font-weight: bold;">LUNAS</h5>
                    </td>
                </tr>
                <?php $no++; } ?>
            </table>



            <!-- Tampilkan tombol halaman -->
            <div>
                <nav aria-label="page" class="page">
                    <ul class="pagination pagination-md justify-content-center ">
                        <?php for($i=1; $i <= $totalHalaman; $i++): ?>
                        <li class="page-item" aria-current="page">
                            <span class="page-link bg-dark"><a style="text-decoration:none"
                                    href="?hal=<?= $i; ?>"><?= $i; ?></a></span>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>
<?php
// Proses Tambah
if(isset($_POST['tambah'])){
    $petugas = $_POST['petugas'];
    $nama = $_POST['siswa'];
    $tgl = $_POST['tgl_bayar']; $bulan = $_POST['bulan_dibayar']; $tahun = $_POST['tahun_dibayar'];
    $spp = $_POST['spp'];
    $jumlah = $_POST['jumlah_bayar'];
    $simpan = mysqli_query($conn,"INSERT INTO pembayaran VALUES
                (NULL, '$petugas', '$nama', '$tgl', '$bulan', '$tahun', '$spp', '$jumlah')");
    // Arahkan ke menu transaksi
    if($simpan){
        echo "<script>
        document.location='transaksi.php'
        </script>";
    }else{
        echo "<script>alert('gagal');</script>";
    }}
?>