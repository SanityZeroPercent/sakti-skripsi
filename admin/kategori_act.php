<?php
if ($_SESSION['status'] != "administrator_logedin") {
    header("location:../index.php?alert=belum_login");
}
include '../koneksi.php';
$kategori  = $_POST['kategori'];

mysqli_query($koneksi, "insert into kategori values (NULL,'$kategori')");
header("location:kategori.php");
