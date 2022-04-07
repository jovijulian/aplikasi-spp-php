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

    <title>Data SPP</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php require_once("header.php"); ?>
    <div class="container">

        <h1 class="mt-5 text-center">Tabel SPP</h1>
        </br>

        <!-- //add siswa -->
        <p><a href="tambah_siswa.php" data-bs-toggle="modal" data-bs-target="#modalTambah" type="button"
                class="btn btn-info">+ Tambah Data</a></p>
        <div class="modal fade" id="modalTambah" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah SPP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="tahun" class="col-form-label">Tahun</label>
                                <input type="text" name="tahun" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="nominal" class="col-form-label">Nominal</label>
                                <input type="text" name="nominal" class="form-control">
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



        <!-- //table spp -->
        <div class="row">
            <table class="table table-striped bg-dark mt-2 text-light" border="1">
                <thead>
                    <tr>
                        <td class="text-center" scope="col">No. </td>
                        <td scope="col">Tahun</td>
                        <td scope="col">Nominal</td>
                        <td class="text-center" scope="col">Aksi</td>
                    </tr>
                </thead>

                <?php
                // Kita buat konfigurasi pagging
                    $totalDataHalaman = 5;
                    $data = mysqli_query($conn, "SELECT * FROM spp");
                    $hitung = mysqli_num_rows($data);
                    $totalHalaman = ceil($hitung / $totalDataHalaman);
                    $halAktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
                    $dataAwal = ($totalDataHalaman * $halAktif) - $totalDataHalaman;
                    // Konfigurasi Selesai
                    // Kita panggil tabel spp
                    $sql = mysqli_query($conn, "SELECT * FROM spp ORDER BY tahun ASC LIMIT $dataAwal, $totalDataHalaman");
                    $no = 1;
                    while($r = mysqli_fetch_assoc($sql)){ 
                ?>
                <tr class="text-light">
                    <td class="text-center text-light"><?= $no ?></td>
                    <td class="text-light"><?= $r['tahun']; ?></td>
                    <td class="text-light"><?= $r['nominal']; ?></td>
                    <td class=" text-center text-light"><a href="#" type="button" class="btn btn-danger"
                            data-bs-toggle="modal" data-bs-target="#modalHapus<?php echo $r['id_spp']; ?>">Hapus</a>
                        <a href="#" type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#modalEdit<?php echo $r['id_spp']; ?>">Edit </a>
                    </td>
                    <!-- delete -->
                    <div class="modal fade" id="modalHapus<?php echo $r['id_spp']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus SPP</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <input type="hidden" name="id_spp" value="<?= $r['id_spp']; ?>">
                                        Apakah Anda yakin menghapus spp ini?
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
                    <div class="modal fade" id="modalEdit<?php echo $r['id_spp']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-titlec" id="exampleModalLabel">Edit SPP</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form method="post">
                                        <?php
                                    $id_spp = $r['id_spp']; 
                                    $query_edit = mysqli_query($conn, "SELECT * FROM spp WHERE id_spp='$id_spp'");
                                    while ($row = mysqli_fetch_array($query_edit)) {  
                                    ?>
                                        <input type="hidden" name="id_spp" value="<?= $row['id_spp']; ?>">
                                        <div class="mb-3">
                                            <label for="tahun" class="col-form-label text-dark">Tahun</label>
                                            <input type="text" name="tahun" value="<?= $row['tahun']; ?>"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nominal" class="col-form-label text-dark">Nominal</label>
                                            <input type="text" name="nominal" value="<?= $row['nominal']; ?>"
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
                            <span class="page-link bg-dark"><a style="text-decoration:none"
                                    href="?hal=<?= $i; ?>"><?= $i; ?></a></span>
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
$tahun = $_POST['tahun'];
$nominal = $_POST['nominal'];
$simpan = mysqli_query($conn, "INSERT INTO spp VALUES(NULL, '$tahun', '$nominal')");
if($simpan){
    echo "<script>
    document.location='data_spp.php'
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
$id_spp = $_POST['id_spp'];
$tahun = $_POST['tahun'];
$nominal = $_POST['nominal'];
$update = mysqli_query($conn, "UPDATE spp SET tahun='$tahun', nominal='$nominal'
WHERE spp.id_spp='$id_spp'");
        if($update){
            echo "<script>
            document.location='data_spp.php'
            </script>";
        }else{
            echo "<script>alert('Gagal'); </script>";
        }
}
?>
<!-- delete -->
<?php
    if(isset($_POST['hapus'])){
        $id_spp = $_POST['id_spp'];
        $hapus = mysqli_query($conn, "DELETE FROM spp WHERE id_spp='$id_spp'");
        if($hapus){
            echo "<script>document.location='data_spp.php'</script>"  ;                      
        }else{
            echo "<script>alert('Maaf, data tersebut masih terhubung dengan data yang lain');
            </script>";
        }
    }
?>