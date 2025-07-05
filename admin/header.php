  <?php
    include '../koneksi.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ?>
  <!doctype html>
  <html class="no-js" lang="en" dir="ltr">

  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=Edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>::SIMKEU:: Dashboard </title>
      <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->

      <!-- plugin css file  -->
      <link rel="stylesheet" href="../assets/plugin/datatables/responsive.dataTables.min.css">
      <link rel="stylesheet" href="../assets/plugin/datatables/dataTables.bootstrap5.min.css">

      <!-- project css file  -->
      <link rel="stylesheet" href="../assets/css/cryptoon.style.min.css">
  </head>

  <body>
      <div id="cryptoon-layout" class="theme-orange">

          <!-- sidebar -->
          <div class="sidebar py-2 py-md-2 me-0 border-end">
              <div class="d-flex flex-column h-100">
                  <!-- Logo -->
                  <a href="index.php" class="mb-0 brand-icon">
                      <span class="logo-icon">
                          <i class="fa fa-gg-circle fs-3"></i>
                      </span>
                      <span class="logo-text">SIMKEU</span>
                  </a>
                  <!-- Menu: main ul -->
                  <ul class="menu-list flex-grow-1 mt-4 px-1">
                      <li class="divider mt-4 py-2 border-top text-uppercase"><small>Halaman Utama</small></li>
                      <li>
                          <a class="m-link active" href="index.php">
                              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 38 38">
                                  <path xmlns="http://www.w3.org/2000/svg" d="M34,18.756V34H22v-8h-6v8h-4V14.31l7-3.89L34,18.756z M34,16.472V6h-6v7.139L34,16.472z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                  <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M34,14.19V6h-6v2h4v5.08L19,5.86L0.51,16.13l0.98,1.74L19,8.14l17.51,9.73l0.98-1.74L34,14.19z M32,32h-8v-8H14  v8H6V17.653l-2,1.111V34h12v-8h6v8h12V18.764l-2-1.111V32z"></path>
                              </svg>
                              <div>
                                  <h6 class="mb-0">Dashboard</h6><small class="text-muted">Halaman Utama</small>
                              </div>
                          </a>
                      </li>
                      <li>
                          <a class="m-link" href="kategori.php">
                              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 38 38">
                                  <path xmlns="http://www.w3.org/2000/svg" d="M34,18.756V34H22v-8h-6v8h-4V14.31l7-3.89L34,18.756z M34,16.472V6h-6v7.139L34,16.472z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                  <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M34,14.19V6h-6v2h4v5.08L19,5.86L0.51,16.13l0.98,1.74L19,8.14l17.51,9.73l0.98-1.74L34,14.19z M32,32h-8v-8H14  v8H6V17.653l-2,1.111V34h12v-8h6v8h12V18.764l-2-1.111V32z"></path>
                              </svg>
                              <div>
                                  <h6 class="mb-0">Data Kategori</h6><small class="text-muted">Kelola Kategori Transaksi</small>
                              </div>
                          </a>
                      </li>
                      <li>
                          <a class="m-link" href="transaksi.php">
                              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 38 38">
                                  <path xmlns="http://www.w3.org/2000/svg" d="M34,18.756V34H22v-8h-6v8h-4V14.31l7-3.89L34,18.756z M34,16.472V6h-6v7.139L34,16.472z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                  <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M34,14.19V6h-6v2h4v5.08L19,5.86L0.51,16.13l0.98,1.74L19,8.14l17.51,9.73l0.98-1.74L34,14.19z M32,32h-8v-8H14  v8H6V17.653l-2,1.111V34h12v-8h6v8h12V18.764l-2-1.111V32z"></path>
                              </svg>
                              <div>
                                  <h6 class="mb-0">Data Transaksi</h6><small class="text-muted">Kelola Transaksi</small>
                              </div>
                          </a>
                      </li>
                      <li class="collapsed">
                          <a class="m-link" data-bs-toggle="collapse" data-bs-target="#form" href="#">
                              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="20px" viewBox="0 0 32 32">
                                  <path d="M2,0v32h28V0H2z M28,30H4V2h24V30z" style="fill:var(--primary-color);"></path>
                                  <path d="M19,8V4H6v10h20V8H19z M8,6h9v2H8V6z M24,12H8v-2h16V12z" style="fill:var(--svg-color);"></path>
                                  <path d="M19,20v-4H6v10h20v-6H19z M8,18h9v2H8V18z M24,24H8v-2h16V24z" style="fill:var(--svg-color);"></path>
                              </svg>
                              <div>
                                  <h6 class="mb-0">HUTANG PIUTANG</h6><small class="text-muted">Kelola Hutang dan Piutang</small>
                              </div> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span>
                          </a>
                          <!-- Menu: Sub menu ul -->
                          <ul class="sub-menu collapse" id="form">
                              <li><a class="ms-link" href="hutang.php">Catatan Hutang</a></li>
                              <li><a class="ms-link" href="piutang.php">Catatan Piutang</a></li>
                          </ul>
                      </li>
                      <li>
                          <a class="m-link" href="bank.php">
                              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 38 38">
                                  <path xmlns="http://www.w3.org/2000/svg" d="M34,18.756V34H22v-8h-6v8h-4V14.31l7-3.89L34,18.756z M34,16.472V6h-6v7.139L34,16.472z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                  <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M34,14.19V6h-6v2h4v5.08L19,5.86L0.51,16.13l0.98,1.74L19,8.14l17.51,9.73l0.98-1.74L34,14.19z M32,32h-8v-8H14  v8H6V17.653l-2,1.111V34h12v-8h6v8h12V18.764l-2-1.111V32z"></path>
                              </svg>
                              <div>
                                  <h6 class="mb-0">Rekening Bank</h6><small class="text-muted">Kelola Rekening Bank</small>
                              </div>
                          </a>
                      </li>
                      <li>
                          <a class="m-link" href="user.php">
                              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 38 38">
                                  <path xmlns="http://www.w3.org/2000/svg" d="M34,18.756V34H22v-8h-6v8h-4V14.31l7-3.89L34,18.756z M34,16.472V6h-6v7.139L34,16.472z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                  <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M34,14.19V6h-6v2h4v5.08L19,5.86L0.51,16.13l0.98,1.74L19,8.14l17.51,9.73l0.98-1.74L34,14.19z M32,32h-8v-8H14  v8H6V17.653l-2,1.111V34h12v-8h6v8h12V18.764l-2-1.111V32z"></path>
                              </svg>
                              <div>
                                  <h6 class="mb-0">Data Pengguna</h6><small class="text-muted">Kelola Data Pengguna</small>
                              </div>
                          </a>
                      </li>
                      <li>
                          <a class="m-link" href="laporan.php">
                              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 38 38">
                                  <path xmlns="http://www.w3.org/2000/svg" d="M34,18.756V34H22v-8h-6v8h-4V14.31l7-3.89L34,18.756z M34,16.472V6h-6v7.139L34,16.472z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                  <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M34,14.19V6h-6v2h4v5.08L19,5.86L0.51,16.13l0.98,1.74L19,8.14l17.51,9.73l0.98-1.74L34,14.19z M32,32h-8v-8H14  v8H6V17.653l-2,1.111V34h12v-8h6v8h12V18.764l-2-1.111V32z"></path>
                              </svg>
                              <div>
                                  <h6 class="mb-0">Laporan</h6><small class="text-muted">Cetak Laporan</small>
                              </div>
                          </a>
                      </li>
                  </ul>
                  <!-- Menu: menu collepce btn -->
                  <button type="button" class="btn btn-link sidebar-mini-btn text-muted">
                      <span><i class="icofont-bubble-right"></i></span>
                  </button>
              </div>
          </div>

          <!-- main body area -->
          <div class="main px-lg-4 px-md-4">

              <!-- Body: Header -->
              <div class="header">
                  <nav class="navbar py-4">
                      <div class="container-xxl">

                          <!-- header rightbar icon -->
                          <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">
                              <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                                  <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                                      <?php
                                        $id_user = $_SESSION['id'];
                                        $profil = mysqli_query($koneksi, "select * from user where user_id='$id_user'");
                                        $profil = mysqli_fetch_assoc($profil);
                                        if ($profil['user_foto'] == "") {
                                        ?>
                                          <img src="../gambar/sistem/user.png" class="avatar lg rounded-circle img-thumbnail">
                                      <?php } else { ?>
                                          <img src="../gambar/user/<?php echo $profil['user_foto'] ?>" class="avatar lg rounded-circle img-thumbnail">
                                      <?php } ?>
                                  </a>
                                  <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                      <div class="card border-0 w280">
                                          <div class="card-body pb-0">
                                              <div class="d-flex py-1">
                                                  <?php
                                                    if ($profil['user_foto'] == "") {
                                                    ?>
                                                      <img src="../gambar/sistem/user.png" class="avatar rounded-circle">
                                                  <?php } else { ?>
                                                      <img src="../gambar/user/<?php echo $profil['user_foto'] ?>" class="avatar rounded-circle">
                                                  <?php } ?>
                                                  <div class="flex-fill ms-3">
                                                      <p class="mb-0"><span class="font-weight-bold"><?php echo $profil['user_nama'] ?></span></p>
                                                      <small class=""><?php echo $_SESSION['level']; ?></small>
                                                  </div>
                                              </div>

                                              <div>
                                                  <hr class="dropdown-divider border-dark">
                                              </div>
                                          </div>
                                          <div class="list-group m-2 ">
                                              <a href="profile.php" class="list-group-item list-group-item-action border-0">
                                                  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 38 38" class="me-3">
                                                      <path xmlns="http://www.w3.org/2000/svg" d="M36.15,38H1.85l0.16-1.14c0.92-6.471,3.33-7.46,6.65-8.83c0.43-0.17,0.87-0.36,1.34-0.561  c0.19-0.08,0.38-0.17,0.58-0.26c1.32-0.61,2.14-1.05,2.64-1.45c0.18,0.48,0.47,1.13,0.93,1.78C15.03,28.78,16.53,30,19,30  c2.47,0,3.97-1.22,4.85-2.46c0.46-0.65,0.75-1.3,0.931-1.78c0.5,0.4,1.319,0.84,2.64,1.45c0.2,0.09,0.39,0.17,0.58,0.26  c0.47,0.2,0.91,0.391,1.34,0.561c3.32,1.37,5.73,2.359,6.65,8.83L36.15,38z M20,13v4h-2v-4H20z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                                      <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M21.67,17.34C21.22,18.27,20.29,19,19,19s-2.22-0.73-2.67-1.66l-1.79,0.891C15.31,19.78,16.88,21,19,21  s3.69-1.22,4.46-2.77L21.67,17.34z M15,10.85c-0.61,0-1.1,0.38-1.1,1.65s0.49,1.65,1.1,1.65s1.1-0.38,1.1-1.65S15.61,10.85,15,10.85  z M23,10.85c-0.61,0-1.1,0.38-1.1,1.65s0.489,1.65,1.1,1.65s1.1-0.38,1.1-1.65S23.61,10.85,23,10.85z M35.99,36.86  c-0.92-6.471-3.33-7.46-6.65-8.83c-0.43-0.17-0.87-0.36-1.34-0.561c-0.19-0.09-0.38-0.17-0.58-0.26c-1.32-0.61-2.14-1.05-2.64-1.45  c-0.521-0.42-0.7-0.8-0.761-1.29C26.55,22.74,28,19.8,28,17V4.56l-1.18,0.21C26.1,4.91,25.58,5,25.05,5  c-1.439,0-2.37-0.24-3.35-0.49C20.71,4.26,19.68,4,18.21,4c-1.54,0-2.94,0.69-3.83,1.9l1.61,1.18C16.5,6.39,17.31,6,18.21,6  c1.22,0,2.08,0.22,3,0.45C22.22,6.71,23.36,7,25.05,7c0.32,0,0.63-0.02,0.95-0.06V17c0,3.44-2.62,7-7,7s-7-3.56-7-7V6.29  C12.23,5.59,13.61,2,18.21,2c1.61,0,2.76,0.28,3.88,0.55C23.06,2.78,23.98,3,25.05,3C26.12,3,27.19,2.74,28,2.47V0.34  C27.34,0.61,26.17,1,25.05,1c-0.83,0-1.6-0.18-2.49-0.4C21.38,0.32,20.05,0,18.21,0c-5.24,0-7.64,3.86-8.18,5.89L10,17  c0,2.8,1.45,5.74,3.98,7.47c-0.06,0.49-0.24,0.87-0.76,1.29c-0.5,0.4-1.32,0.84-2.64,1.45c-0.2,0.09-0.39,0.18-0.58,0.26  c-0.47,0.2-0.91,0.391-1.34,0.561c-3.32,1.37-5.73,2.359-6.65,8.83L1.85,38h34.3L35.99,36.86z M4.18,36c0.81-4.3,2.28-4.9,5.24-6.12  c0.62-0.25,1.29-0.53,2-0.86c1.09-0.5,2.01-0.949,2.73-1.479c0.8-0.56,1.36-1.22,1.64-2.12C16.76,25.78,17.83,26,19,26  s2.24-0.22,3.21-0.58c0.28,0.9,0.84,1.561,1.64,2.12c0.721,0.53,1.641,0.979,2.73,1.479c0.71,0.33,1.38,0.61,2,0.86  c2.96,1.22,4.43,1.83,5.24,6.12H4.18z"></path>
                                                  </svg>Profile Page
                                              </a>
                                              <a href="logout.php" onclick="return confirm('Apakah Anda yakin untuk logout?')" class="list-group-item list-group-item-action border-0 ">
                                                  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" class="me-3">
                                                      <rect xmlns="http://www.w3.org/2000/svg" class="st0" width="24" height="24" style="fill:none;;" fill="none"></rect>
                                                      <path xmlns="http://www.w3.org/2000/svg" d="M20,4c0-1.104-0.896-2-2-2H6C4.896,2,4,2.896,4,4v16c0,1.104,0.896,2,2,2h12  c1.104,0,2-0.896,2-2V4z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                                      <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M15,6.81v2.56c0.62,0.7,1,1.62,1,2.63c0,2.21-1.79,4-4,4s-4-1.79-4-4c0-1.01,0.38-1.93,1-2.63V6.81  C7.21,7.84,6,9.78,6,12c0,3.31,2.69,6,6,6c3.31,0,6-2.69,6-6C18,9.78,16.79,7.84,15,6.81z M13,6.09C12.68,6.03,12.34,6,12,6  s-0.68,0.03-1,0.09V12h2V6.09z"></path>
                                                  </svg>Signout
                                              </a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="setting ms-2">
                                  <a href="#" data-bs-toggle="modal" data-bs-target="#Settingmodal">
                                      <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 38 38">
                                          <path d="M19,28c-4.964,0-9-4.04-9-9c0-4.964,4.036-9,9-9c4.96,0,9,4.036,9,9  C28,23.96,23.96,28,19,28z M19,16c-1.654,0-3,1.346-3,3s1.346,3,3,3s3-1.346,3-3S20.654,16,19,16z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                          <path class="st0" d="M19,24c-2.757,0-5-2.243-5-5s2.243-5,5-5s5,2.243,5,5S21.757,24,19,24z M19,16c-1.654,0-3,1.346-3,3  s1.346,3,3,3s3-1.346,3-3S20.654,16,19,16z M32,19c0-1.408-0.232-2.763-0.648-4.034l3.737-1.548l-0.766-1.848l-3.743,1.551  c-1.25-2.452-3.251-4.452-5.702-5.701l1.551-3.744l-1.848-0.765l-1.548,3.737C21.762,6.232,20.409,6,19,6  c-1.409,0-2.756,0.248-4.026,0.668l-1.556-3.756L11.57,3.677l2.316,5.592C15.416,8.462,17.154,8,19,8c6.065,0,11,4.935,11,11  s-4.935,11-11,11S8,25.065,8,19c0-3.031,1.232-5.779,3.222-7.771L9.808,9.816c-0.962,0.963-1.764,2.082-2.388,3.306l-3.744-1.551  l-0.765,1.847l3.738,1.548C6.232,16.238,6,17.592,6,19c0,1.409,0.232,2.763,0.648,4.034l-3.737,1.548l0.766,1.848l3.744-1.551  c1.25,2.451,3.25,4.451,5.701,5.7l-1.551,3.744l1.848,0.766l1.548-3.737C16.237,31.768,17.591,32,19,32s2.762-0.232,4.033-0.648  l1.549,3.737l1.848-0.766l-1.552-3.743c2.451-1.25,4.451-3.25,5.701-5.701l3.744,1.551l0.765-1.848l-3.736-1.548  C31.768,21.763,32,20.409,32,19z"></path>
                                      </svg>
                                  </a>
                              </div>
                          </div>



                          <!-- main menu Search-->
                          <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 d-flex align-items-center">

                          </div>
                          <!-- menu toggler -->
                          <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
                              <span class="fa fa-bars"></span>
                          </button>
                      </div>
                  </nav>
              </div>