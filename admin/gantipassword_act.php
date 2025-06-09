<?php
include '../koneksi.php';
session_start();
$id = $_SESSION['id'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

mysqli_query($koneksi, "UPDATE user SET user_password='$password' WHERE user_id='$id'") or die(mysqli_error($koneksi));

header("location:gantipassword.php?alert=sukses");