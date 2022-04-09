<?php
  session_start();
 include '../db/koneksi.php';
   // menangkap data yang dikirim dari form login
   $nisn = $_POST['nisn'];
    // menyeleksi data pada tabel admin dengan nisn sesuai
    $data = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn='$nisn'");
    $hasil = mysqli_fetch_assoc($data);
        // Jika data yang dicari kosong
        if(mysqli_num_rows($data) == 0){
            echo "<td colspan='2'><center>NISN belum terdaftar!</center></td>";
        }else{
        // Jika nisn siswa sesuai dengan database maka akan redirect ke halaman utama dan akan dibuatkan sesi
            $_SESSION['nisn'] = $_POST['nisn'];
            header("location: index_siswa.php");
        }
?>