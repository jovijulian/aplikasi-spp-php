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

    <title>Data Petugas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php require_once("header.php"); ?>
    <div class="container">

        <h1 class="mt-5 text-center">Tabel Petugas</h1>
        </br>

        <!-- //add siswa -->
        <p><a href="tambah_siswa.php" data-bs-toggle="modal" data-bs-target="#modalTambah" type="button"
                class="btn btn-info">+ Tambah Data</a></p>
        <div class="modal fade" id="modalTambah" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="nama_petugas" class="col-form-label">Nama Petugas</label>
                                <input type="text" name="nama_petugas" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="col-form-label">Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="col-form-label">Password</label>
                                <input type="password" name="password" class="form-control">
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
                        <td scope="col">Nama Petugas</td>
                        <td scope="col">Username</td>
                        <td scope="col">Level</td>
                        <td class="text-center" scope="col">Aksi</td>
                    </tr>
                </thead>

                <?php
                // Kita buat konfigurasi pagging
                    $jmlhDataHal = 5;
                    $data = mysqli_query($conn, "SELECT * FROM petugas");
                    $jmlhData = mysqli_num_rows($data);
                    $jmlhHal = ceil($jmlhData / $jmlhDataHal);
                    $halAktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
                    $dataAwal = ($jmlhData * $halAktif) - $jmlhData;
                    // Konfigurasi Selesai
                    // Kita panggil tabel petugas
                    $sql = mysqli_query($conn, "SELECT * FROM petugas LIMIT $dataAwal, $jmlhDataHal");
                    $no = 1;
                    while($r = mysqli_fetch_assoc($sql)){
                ?>
                <tr class="text-light">
                    <td class="text-center text-light"><?= $no ?></td>
                    <td class="text-light"><?= $r['username']; ?></td>
                    <td class="text-light"><?= $r['nama_petugas']; ?></td>
                    <td class="text-light"><?= $r['level']; ?></td>
                    <td class=" text-center text-light"><a href="#" type="button" class="btn btn-danger"
                            data-bs-toggle="modal" data-bs-target="#modalHapus<?php echo $r['id_petugas']; ?>">Hapus</a>
                        <a href="#" type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#modalEdit<?php echo $r['id_petugas']; ?>">Edit </a>
                    </td>
                    <!-- delete -->
                    <div class="modal fade" id="modalHapus<?php echo $r['id_petugas']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Petugas</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <input type="hidden" name="id_petugas" value="<?= $r['id_petugas']; ?>">
                                        Apakah Anda yakin menghapus petugas ini?
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
                    <div class="modal fade" id="modalEdit<?php echo $r['id_petugas']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-titlec" id="exampleModalLabel">Edit Petugas</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form method="post">
                                        <?php
                                    $id_petugas = $r['id_petugas']; 
                                    $query_edit = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas='$id_petugas'");
                                    while ($row = mysqli_fetch_array($query_edit)) {  
                                    ?>
                                        <input type="hidden" name="id_petugas" value="<?= $row['id_petugas']; ?>">
                                        <div class="mb-3">
                                            <label for="nama_petugas" class="col-form-label text-dark">Nama
                                                Petugas</label>
                                            <input type="text" name="nama_petugas" value="<?= $row['nama_petugas']; ?>"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="col-form-label text-dark">Username</label>
                                            <input type="text" name="username" value="<?= $row['username']; ?>"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="col-form-label text-dark">Password</label>
                                            <input type="password" name="password" value="<?= $row['password']; ?>"
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
                        <?php for($i=1; $i <= $jmlhHal; $i++): ?>
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
$user = $_POST['username'];
$pass = $_POST['password'];
$nama = $_POST['nama_petugas'];
$simpan = mysqli_query($conn, "INSERT INTO petugas VALUES(NULL, '$user', '$pass', '$nama', 'Petugas')");
if($simpan){
    echo "<script>
    document.location='data_petugas.php'
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
    $id_petugas = $_POST['id_petugas'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $nama = $_POST['nama_petugas'];
    $update = mysqli_query($conn, "UPDATE petugas SET username='$user',
                                 password='$pass', nama_petugas='$nama'
                                 WHERE petugas.id_petugas='$id_petugas'");
        if($update){
            echo "<script>
            document.location='data_petugas.php'
            </script>";
        }else{
            echo "<script>alert('Gagal'); </script>";
        }
}
?>
<!-- delete -->
<?php
    if(isset($_POST['hapus'])){
        $id_petugas = $_POST['id_petugas'];
        $hapus = mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas='$id_petugas'");
        if($hapus){
            echo "<script>document.location='data_petugas.php'</script>"  ;                      
        }else{
            echo "<script>alert('Maaf, data tersebut masih terhubung dengan data yang lain');
            </script>";
        }
    }
?>