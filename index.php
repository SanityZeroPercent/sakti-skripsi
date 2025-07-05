<?php
// Process login if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    // menghubungkan dengan koneksi
    include 'koneksi.php';

    // menangkap data yang dikirim dari form
    $username = $_POST['username'];
    $password = $_POST['password']; // no md5 here

    $login = mysqli_query($koneksi, "SELECT * FROM user WHERE user_username='$username'");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        session_start();
        $data = mysqli_fetch_assoc($login);

        // Verify password using bcrypt
        if (password_verify($password, $data['user_password'])) {
            $_SESSION['id'] = $data['user_id'];
            $_SESSION['nama'] = $data['user_nama'];
            $_SESSION['username'] = $data['user_username'];
            $_SESSION['level'] = $data['user_level'];

            if ($data['user_level'] == "administrator") {
                $_SESSION['status'] = "administrator_logedin";
                header("location:admin/");
                exit();
            } else if ($data['user_level'] == "manajemen") {
                $_SESSION['status'] = "manajemen_logedin";
                header("location:manajemen/");
                exit();
            } else {
                header("location:index.php?alert=gagal");
                exit();
            }
        } else {
            header("location:index.php?alert=gagal");
            exit();
        }
    } else {
        header("location:index.php?alert=gagal");
        exit();
    }
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::SIMKEU:: Signin</title>
    <link rel="icon" href="../favicon.ico" type="image/x-icon"> <!-- Favicon-->

    <!-- project css file  -->
    <link rel="stylesheet" href="../assets/css/cryptoon.style.min.css">
</head>

<body>
    <div id="cryptoon-layout" class="theme-orange">

        <!-- main body area -->
        <div class="main p-2 py-3 p-xl-5">

            <!-- Body: Header -->
            <div class="container-xxl">
                <!-- header rightbar icon -->
                <div class="row align-items-center">
                    <div class="col">
                        <a href="index.php" class="d-flex align-item-center">
                            <i class="fa fa-gg-circle fs-3"></i>
                            <h5 class="mb-0 mt-1 mx-2">SIMKEU</h5>
                        </a>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex align-item-center">
                            <div class="setting ms-2 mt-1">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#Settingmodal">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 38 38">
                                        <path d="M19,28c-4.964,0-9-4.04-9-9c0-4.964,4.036-9,9-9c4.96,0,9,4.036,9,9  C28,23.96,23.96,28,19,28z M19,16c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S20.654,16,19,16z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                        <path class="st0" d="M19,24c-2.757,0-5-2.243-5-5s2.243-5,5-5s5,2.243,5,5S21.757,24,19,24z M19,16c-1.654,0-3,1.346-3,3  s1.346,3,3,3s3-1.346,3-3S20.654,16,19,16z M32,19c0-1.408-0.232-2.763-0.648-4.034l3.737-1.548l-0.766-1.848l-3.743,1.551  c-1.25-2.452-3.251-4.452-5.702-5.701l1.551-3.744l-1.848-0.765l-1.548,3.737C21.762,6.232,20.409,6,19,6  c-1.409,0-2.756,0.248-4.026,0.668l-1.556-3.756L11.57,3.677l2.316,5.592C15.416,8.462,17.154,8,19,8c6.065,0,11,4.935,11,11  s-4.935,11-11,11S8,25.065,8,19c0-3.031,1.232-5.779,3.222-7.771L9.808,9.816c-0.962,0.963-1.764,2.082-2.388,3.306l-3.744-1.551  l-0.765,1.847l3.738,1.548C6.232,16.238,6,17.592,6,19c0,1.409,0.232,2.763,0.648,4.034l-3.737,1.548l0.766,1.848l3.744-1.551  c1.25,2.451,3.25,4.451,5.701,5.7l-1.551,3.744l1.848,0.766l1.548-3.737C16.237,31.768,17.591,32,19,32s2.762-0.232,4.033-0.648  l1.549,3.737l1.848-0.766l-1.552-3.743c2.451-1.25,4.451-3.25,5.701-5.701l3.744,1.551l0.765-1.848l-3.736-1.548  C31.768,21.763,32,20.409,32,19z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
                <div class="container-xxl">
                    <div class="row g-3">
                        <div class="col-lg-6 d-flex justify-content-center align-items-center auth-h100">
                            <div class="d-flex flex-column">
                                <h1>Account Login</h1>
                                <span class="text-muted">Silahkan Masukkan ID Pengguna anda!</span>

                                <div class="tab-content mt-4 mb-3">
                                    <div class="card">

                                        <div class="card-header">
                                            <?php
                                            if (isset($_GET['alert'])) {
                                                if ($_GET['alert'] == "gagal") {
                                                    echo "<div class='alert alert-danger'>LOGIN GAGAL! USERNAME DAN PASSWORD SALAH!</div>";
                                                } else if ($_GET['alert'] == "logout") {
                                                    echo "<div class='alert alert-success'>ANDA TELAH BERHASIL LOGOUT</div>";
                                                } else if ($_GET['alert'] == "belum_login") {
                                                    echo "<div class='alert alert-warning'>ANDA HARUS LOGIN UNTUK MENGAKSES DASHBOARD</div>";
                                                }
                                            }
                                            ?>
                                        </div>

                                        <div class="card-body p-4">
                                            <form action="index.php" method="POST">
                                                <div class="mb-3">
                                                    <label class="form-label fs-6">Username</label>
                                                    <input type="text" name="username" class="form-control" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fs-6">Password</label>
                                                    <input type="password" name="password" class="form-control" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary text-uppercase py-2 fs-5 w-100 mt-2">log in</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center auth-h100">
                            <div class="qr-block text-center">
                                <img src="../assets/images/qr-code.png" alt="#" class="img-fluid my-4">
                                <h4>SIMKEU</h4>
                                <p>Sistem Informasi Manajemen Keuangan <br /><span class="text-primary">Majelis Perwakilan Khusus <br /> Yayasan Pelayanan Pekabaran Injil Indonesia Batu di Jakarta</span></p>
                            </div>
                        </div>
                    </div> <!-- End Row -->

                </div>
            </div>

            <?php include 'admin/footer.php'; ?>