<?php
if ($_SESSION['status'] != "administrator_logedin") {
    header("location:../index.php?alert=belum_login");
}
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "update transaksi set transaksi_kategori='1' where transaksi_kategori='$id'");

mysqli_query($koneksi, "delete from kategori where kategori_id='$id'");
header("location:kategori.php");
