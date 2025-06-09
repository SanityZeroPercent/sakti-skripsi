<?php
if ($_SESSION['status'] != "administrator_logedin") {
    header("location:../index.php?alert=belum_login");
}
include '../koneksi.php';
$nama  = $_POST['nama'];
$pemilik  = $_POST['pemilik'];
$nomor  = $_POST['nomor'];
$saldo  = $_POST['saldo'];

mysqli_query($koneksi, "insert into bank values (NULL,'$nama','$pemilik','$nomor','$saldo')");
header("location:bank.php");
