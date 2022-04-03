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

    <title>Data Siswa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <center>
            <h1 class="mt-5">Tabel Siswa</h1>
        </center></br>

        <!-- //add siswa -->
        <p><a href="tambah_siswa.php" data-bs-toggle="modal" data-bs-target="#modalTambah" type="button"
                class="btn btn-info">+ Tambah Data</a></p>
        <div class="modal fade" id="modalTambah" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="nisn" class="col-form-label">NISN</label>
                                <input type="text" name="nisn" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="nis" class="col-form-label">NIS</label>
                                <input type="text" name="nis" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="col-form-label">Nama Siswa</label>
                                <input type="text" name="nama" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="input1" class="col-sm-2 control-label">Kelas</label>
                                <div class="col-sm-12">
                                    <select name="kelas" class="form-control">
                                        <?php
                                            $kelas = mysqli_query($conn, "SELECT * FROM kelas");
                                            while($r = mysqli_fetch_assoc($kelas)){ 
                                        ?>
                                        <option value="<?= $r['id_kelas']; ?>">
                                            <?= $r['nama_kelas'] . " | ". $r['kompetensi_keahlian']; ?>
                                        </option>
                                        <?php } ?>
                                    </select></td>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="col-form-label">Alamat:</label>
                                <textarea name="alamat" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="no_telp" class="col-form-label">No. Handphone</label>
                                <input type="text" name="no_telp" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="tambah">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- //table siswa -->
        <div class="row">
            <table class="table table-striped bg-dark mt-2 text-light" border="1">
                <thead>
                    <tr>
                        <td class="text-center" scope="col">No. </td>
                        <td scope="col">NISN</td>
                        <td scope="col">NIS</td>
                        <td scope="col">Nama Siswa</td>
                        <td scope="col">Kelas</td>
                        <td scope="col">Alamat</td>
                        <td scope="col">No. Telp</td>
                        <td class="text-center" scope="col">Aksi</td>
                    </tr>
                </thead>

                <?php
                    $totalDataHalaman = 5;
                    $data = mysqli_query($conn, "SELECT * FROM siswa");
                    $hitung = mysqli_num_rows($data);
                    $totalHalaman = ceil($hitung / $totalDataHalaman);
                    $halAktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
                    $dataAwal = ($totalDataHalaman * $halAktif) - $totalDataHalaman;

                    $sql = mysqli_query($conn, "SELECT * FROM siswa
                    JOIN kelas ON siswa.id_kelas = kelas.id_kelas
                    ORDER BY nama LIMIT $dataAwal, $totalDataHalaman ");
                    $no = 1;
                    while($r = mysqli_fetch_assoc($sql)){ 
                ?>
                <tr class="text-light">
                    <td class="text-center text-light"><?= $no ?></td>
                    <td class="text-light"><?= $r['nisn']; ?></td>
                    <td class="text-light"><?= $r['nis']; ?></td>
                    <td class="text-light"><?= $r['nama']; ?></td>
                    <td class="text-light"><?= $r['nama_kelas'] . " | " . $r['kompetensi_keahlian']; ?></td>
                    <td class="text-light"><?= $r['alamat']; ?></td>
                    <td class="text-light"><?= $r['no_telp']; ?></td>
                    <td class="text-center text-light"><a href="#" type="button" class="btn btn-danger"
                            data-bs-toggle="modal" data-bs-target="#modalHapus<?php echo $r['nisn']; ?>">Hapus</a>
                        <a href="#" type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#modalEdit<?php echo $r['nisn']; ?>">Edit </a>
                    </td>
                    <!-- delete -->
                    <div class="modal fade" id="modalHapus<?php echo $r['nisn']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <input type="hidden" name="nisn" value="<?= $r['nisn']; ?>">
                                        Apakah Anda yakin menghapus siswa ini?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tidak</button>
                                    <button type="submit" class="btn btn-danger" name="hapus">Ya</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- edit -->
                    <div class="modal fade" id="modalEdit<?php echo $r['nisn']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-titlec" id="exampleModalLabel">Edit Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form method="post">
                                        <?php
                                    $nisn = $r['nisn']; 
                                    $query_edit = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn='$nisn'");
                                    while ($row = mysqli_fetch_array($query_edit)) {  
                                    ?>
                                        <input type="hidden" name="nisn" value="<?= $row['nisn']; ?>">
                                        <div class="mb-3">
                                            <label for="nis" class="col-form-label text-dark">NIS</label>
                                            <input type="text" name="nis" value="<?= $row['nis']; ?>"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama" class="col-form-label text-dark">Nama
                                                Siswa</label>
                                            <input type="text" name="nama" value="<?= $row['nama']; ?>"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="input1" class="col-form-label text-dark">Kelas</label>
                                            <div class="col-sm-12">
                                                <select name="kelas" class="form-control">
                                                    <?php
                                                            $kelas = mysqli_query($conn, "SELECT * FROM kelas");
                                                            while($r = mysqli_fetch_assoc($kelas)){ ?>
                                                    <option value="<?= $r['id_kelas']; ?>"><?= $r['nama_kelas'] . " | " 
                                                        . $r['kompetensi_keahlian']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="col-form-label text-dark">Alamat</label>
                                            <textarea name="alamat"
                                                class="form-control"><?php echo $row['alamat'] ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="no_telp" class="col-form-label text-dark">No.
                                                Handphone</label>
                                            <input type="text" name="no_telp" value="<?= $row['no_telp']; ?>"
                                                class="form-control">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="update">Submit</button>
                                        </div>
                                        <?php 
                                                }
                                            ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </tr>
                <?php $no++; } ?>
            </table>



            <!-- Tampilkan tombol halaman -->
            <div>
                <nav aria-label="page" class="page">
                    <ul class="pagination pagination-md justify-content-center ">
                        <?php for($i=1; $i <= $totalHalaman; $i++): ?>
                        <li class="page-item" aria-current="page">
                            <span class="page-link bg-dark"><a href="?hal=<?= $i; ?>"><?= $i; ?></a></span>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>



            <!-- Selesai -->
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>
<?php
// Proses Simpan
if(isset($_POST['tambah'])){
$nisn = $_POST['nisn'];
$nis = $_POST['nis'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$alamat = $_POST['alamat'];
$no = $_POST['no_telp'];
$simpan = mysqli_query($conn, "INSERT INTO siswa VALUES
('$nisn', '$nis', '$nama', '$kelas', '$alamat', '$no')");
if($simpan){
    echo "<script>
    document.location='data_siswa.php'
    </script>";
}else{
    echo "<script>
    alert('Data sudah ada');
    </script>";
}
}
?>
<?php
// Proses update
if(isset($_POST['update'])){
    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $no = $_POST['no_telp'];
    $update = mysqli_query($conn, "UPDATE siswa SET nis='$nis', nama='$nama',
                                 id_kelas='$kelas', alamat='$alamat', no_telp='$no' 
                                 WHERE siswa.nisn='$nisn'");
        if($update){
            echo "<script>
            document.location='data_siswa.php'
            </script>";
        }else{
            echo "<script>alert('Gagal'); </script>";
        }
}
?>
<!-- delete -->
<?php
    if(isset($_POST['hapus'])){
        $nisn = $_POST['nisn'];
        $hapus = mysqli_query($conn, "DELETE FROM siswa WHERE nisn='$nisn'");
        if($hapus){
            echo "<script>document.location='data_siswa.php'</script>"  ;                      
        }else{
            echo "<script>alert('Maaf, data tersebut masih terhubung dengan data yang lain');
            </script>";
        }
    }
?>