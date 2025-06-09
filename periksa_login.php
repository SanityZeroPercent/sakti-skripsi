<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password']; // no md5 here

$login = mysqli_query($koneksi, "SELECT * FROM user WHERE user_username='$username'");
$cek = mysqli_num_rows($login);

if($cek > 0){
    session_start();
    $data = mysqli_fetch_assoc($login);

    // Verify password using bcrypt
    if(password_verify($password, $data['user_password'])) {
        $_SESSION['id'] = $data['user_id'];
        $_SESSION['nama'] = $data['user_nama'];
        $_SESSION['username'] = $data['user_username'];
        $_SESSION['level'] = $data['user_level'];

        if($data['user_level'] == "administrator"){
            $_SESSION['status'] = "administrator_logedin";
            header("location:admin/");
        }else if($data['user_level'] == "manajemen"){
            $_SESSION['status'] = "manajemen_logedin";
            header("location:manajemen/");
        }else{
            header("location:index.php?alert=gagal");
        }
    } else {
        header("location:index.php?alert=gagal");
    }
}else{
    header("location:index.php?alert=gagal");
}