<?php 
session_start();
require_once("koneksi.php");

if(!isset($_SESSION['username'])){
    header("location: ..petugas/login_petugas.php");
}else{
    $username = $_SESSION['username'];
}
?>