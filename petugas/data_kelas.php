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

    <title>Data Kelas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php require_once("header.php"); ?>
    <div class="container">
        <center>
            <h1 class="mt-5">Tabel Kelas</h1>
        </center></br>

        <!-- //add siswa -->
        <p><a href="tambah_siswa.php" data-bs-toggle="modal" data-bs-target="#modalTambah" type="button"
                class="btn btn-info">+ Tambah Data</a></p>
        <div class="modal fade" id="modalTambah" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="nama_kelas" class="col-form-label">Nama Kelas</label>
                                <input type="text" name="nama_kelas" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="kompetensi_keahlian" class="col-form-label">Kompetensi Keahlian</label>
                                <input type="text" name="kompetensi_keahlian" class="form-control">
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



        <!-- //table kelas -->
        <div class="row">
            <table class="table table-striped bg-dark mt-2 text-light" border="1">
                <thead>
                    <tr>
                        <td class="text-center" scope="col">No. </td>
                        <td scope="col">Nama Kelas</td>
                        <td scope="col">Kompetensi Keahlian</td>
                        <td class="text-center" scope="col">Aksi</td>
                    </tr>
                </thead>

                <?php
                // Kita buat konfigurasi pagging
                    $totalDataHalaman = 5;
                    $data = mysqli_query($conn, "SELECT * FROM kelas");
                    $hitung = mysqli_num_rows($data);
                    $totalHalaman = ceil($hitung / $totalDataHalaman);
                    $halAktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
                    $dataAwal = ($totalDataHalaman * $halAktif) - $totalDataHalaman;
                    // Konfigurasi Selesai
                    // Kita panggil tabel kelas
                    $sql = mysqli_query($conn, "SELECT * FROM kelas ORDER BY nama_kelas LIMIT $dataAwal, $totalDataHalaman");
                    $no = 1;
                    while ($r = mysqli_fetch_assoc($sql)) { ?>

                <tr class="text-light">
                    <td class="text-center text-light"><?= $no ?></td>
                    <td class="text-light"><?= $r['nama_kelas']; ?></td>
                    <td class="text-light"><?= $r['kompetensi_keahlian']; ?></td>
                    <td class=" text-center text-light"><a href="#" type="button" class="btn btn-danger"
                            data-bs-toggle="modal" data-bs-target="#modalHapus<?php echo $r['id_kelas']; ?>">Hapus</a>
                        <a href="#" type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#modalEdit<?php echo $r['id_kelas']; ?>">Edit </a>
                    </td>
                    <!-- delete -->
                    <div class="modal fade" id="modalHapus<?php echo $r['id_kelas']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Kelas</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <input type="hidden" name="id_kelas" value="<?= $r['id_kelas']; ?>">
                                        Apakah Anda yakin menghapus kelas ini?
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
                    <div class="modal fade" id="modalEdit<?php echo $r['id_kelas']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-titlec" id="exampleModalLabel">Edit Kelas</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form method="post">
                                        <?php
                                    $id_kelas = $r['id_kelas']; 
                                    $query_edit = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas='$id_kelas'");
                                    while ($row = mysqli_fetch_array($query_edit)) {  
                                    ?>
                                        <input type="hidden" name="id_kelas" value="<?= $row['id_kelas']; ?>">
                                        <div class="mb-3">
                                            <label for="nama_kelas" class="col-form-label text-dark">Nama Kelas</label>
                                            <input type="text" name="nama_kelas" value="<?= $row['nama_kelas']; ?>"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="kompetensi_keahlian" class="col-form-label text-dark">Kompetensi
                                                Keahlian</label>
                                            <input type="text" name="kompetensi_keahlian"
                                                value="<?= $row['kompetensi_keahlian']; ?>" class="form-control">
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
$nama = $_POST['nama_kelas'];
$kk = $_POST['kompetensi_keahlian'];
$simpan = mysqli_query($conn, "INSERT INTO kelas VALUES(NULL, '$nama', '$kk')");
if($simpan){
    echo "<script>
    document.location='data_kelas.php'
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
$id_kelas = $_POST['id_kelas'];
$nama = $_POST['nama_kelas'];
$kk = $_POST['kompetensi_keahlian'];
$update = mysqli_query($conn, "UPDATE kelas SET nama_kelas='$nama', kompetensi_keahlian='$kk'
WHERE kelas.id_kelas='$id_kelas'");
        if($update){
            echo "<script>
            document.location='data_kelas.php'
            </script>";
        }else{
            echo "<script>alert('Gagal'); </script>";
        }
}
?>
<!-- delete -->
<?php
    if(isset($_POST['hapus'])){
        $id_kelas = $_POST['id_kelas'];
        $hapus = mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas='$id_kelas'");
        if($hapus){
            echo "<script>document.location='data_kelas.php'</script>"  ;                      
        }else{
            echo "<script>alert('Maaf, data tersebut masih terhubung dengan data yang lain');
            </script>";
        }
    }
?>