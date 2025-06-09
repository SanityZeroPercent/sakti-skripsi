<?php 
if ($_SESSION['status'] != "manajemen_logedin") {
	header("location:../index.php?alert=belum_login");
}
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "delete from piutang where piutang_id='$id'");
header("location:piutang.php");