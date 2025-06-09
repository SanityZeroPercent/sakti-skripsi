<?php 
if ($_SESSION['status'] != "manajemen_logedin") {
	header("location:../index.php?alert=belum_login");
}
include '../koneksi.php';
$id  = $_POST['id'];
$tanggal  = $_POST['tanggal'];
$nominal  = $_POST['nominal'];
$keterangan  = $_POST['keterangan'];

mysqli_query($koneksi, "update piutang set piutang_tanggal='$tanggal', piutang_nominal='$nominal', piutang_keterangan='$keterangan' where piutang_id='$id'") or die(mysqli_error($koneksi));
header("location:piutang.php");