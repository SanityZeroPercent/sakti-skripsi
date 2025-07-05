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
                  <?php
                    $current_page = basename($_SERVER['PHP_SELF']);
                    ?>
                  <ul class="menu-list flex-grow-1 mt-4 px-1">
                      <li class="divider mt-4 py-2 border-top text-uppercase"><small>Halaman Utama</small></li>
                      <li>
                          <a class="m-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">
                              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 38 38">
                                  <path xmlns="http://www.w3.org/2000/svg" d="M34,18.756V34H22v-8h-6v8h-4V14.31l7-3.89L34,18.756z M34,16.472V6h-6v7.139L34,16.472z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                  <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M34,14.19V6h-6v2h4v5.08L19,5.86L0.51,16.13l0.98,1.74L19,8.14l17.51,9.73l0.98-1.74L34,14.19z M32,32h-8v-8H14  v8H6V17.653l-2,1.111V34h12v-8h6v8h12V18.764l-2-1.111V32z"></path>
                              </svg>
                              <div>
                                  <h6 class="mb-0">Dashboard</h6><small class="text-muted">Halaman Utama</small>
                              </div>
                          </a>
                      </li>
                      <li class="divider mt-4 py-2 border-top text-uppercase"><small>Pengelolaan Keuangan</small></li>

                      <li>
                          <a class="m-link <?php echo ($current_page == 'transaksi.php') ? 'active' : ''; ?>" href="transaksi.php">
                              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="20px" viewBox="0 0 32 32">
                                  <path d="M2,0v32h28V0H2z M28,30H4V2h24V30z" style="fill:var(--primary-color);"></path>
                                  <path d="M19,8V4H6v10h20V8H19z M8,6h9v2H8V6z M24,12H8v-2h16V12z" style="fill:var(--svg-color);"></path>
                                  <path d="M19,20v-4H6v10h20v-6H19z M8,18h9v2H8V18z M24,24H8v-2h16V24z" style="fill:var(--svg-color);"></path>
                              </svg>
                              <div>
                                  <h6 class="mb-0">Data Transaksi</h6><small class="text-muted">Kelola Transaksi</small>
                              </div>
                          </a>
                      </li>

                      <?php if ($_SESSION['level'] == 'administrator') { ?>
                          <li>
                              <a class="m-link <?php echo ($current_page == 'kategori.php') ? 'active' : ''; ?>" href="kategori.php">
                                  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 64 64">

                                      <linearGradient id="crp_svg" gradientUnits="userSpaceOnUse" x1="13.876" y1="13.876" x2="50.1249" y2="50.1249">
                                          <stop offset="0" class="st2" />
                                          <stop offset="1" class="st3" />
                                      </linearGradient>
                                      <polygon class="st1" points="50,34 50,30 39.465,30 55.517,20.732 53.518,17.269 37.464,26.537 42.732,17.412 39.268,15.412 
                                        34,24.536 34,6 30,6 30,24.536 24.732,15.412 21.268,17.413 26.536,26.536 10.483,17.268 8.483,20.732 24.535,30 14,30 14,34 
                                        24.537,34 8.483,43.269 10.483,46.732 26.536,37.465 21.268,46.589 24.732,48.589 30,39.464 30,58 34,58 34,39.465 39.268,48.589 
                                        42.732,46.589 37.465,37.465 53.517,46.732 55.517,43.269 39.463,34 	" />
                                      <path class="st0" d="M50,36c-2.209,0-4-1.791-4-4s1.791-4,4-4s4,1.791,4,4S52.209,36,50,36z M36,6c0,2.209-1.791,4-4,4
                                        s-4-1.791-4-4s1.791-4,4-4S36,3.791,36,6z M36,58c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,55.791,36,58z M18,32
                                        c0-2.209-1.791-4-4-4s-4,1.791-4,4s1.791,4,4,4S18,34.209,18,32z M44.464,18.412c-1.104,1.913-3.552,2.568-5.464,1.464
                                        c-1.914-1.104-2.568-3.551-1.465-5.464c1.105-1.913,3.551-2.569,5.465-1.464C44.912,14.052,45.568,16.499,44.464,18.412z
                                        M11.483,15.536c1.913,1.104,2.569,3.551,1.464,5.464s-3.551,2.568-5.464,1.464S4.915,18.914,6.02,17S9.57,14.432,11.483,15.536z
                                        M56.517,41.536c1.913,1.104,2.568,3.551,1.464,5.464s-3.551,2.569-5.464,1.465S49.948,44.913,51.053,43
                                        S54.604,40.432,56.517,41.536z M25,44.124c-1.913-1.104-4.36-0.448-5.465,1.464c-1.104,1.913-0.448,4.36,1.465,5.465
                                        s4.359,0.448,5.464-1.465C27.568,47.676,26.913,45.229,25,44.124z M26.464,14.412c1.104,1.913,0.448,4.36-1.465,5.464
                                        s-4.359,0.449-5.464-1.464s-0.449-4.359,1.464-5.464S25.359,12.499,26.464,14.412z M7.483,41.536
                                        c1.913-1.104,4.36-0.449,5.465,1.464s0.448,4.36-1.465,5.465C9.571,49.569,7.125,48.913,6.02,47S5.57,42.641,7.483,41.536z
                                        M52.517,15.536c1.913-1.104,4.359-0.449,5.464,1.464s0.45,4.36-1.463,5.464s-4.36,0.448-5.465-1.465S50.604,16.641,52.517,15.536z
                                        M39,44.124c-1.914,1.104-2.568,3.552-1.465,5.465s3.552,2.568,5.465,1.464s2.568-3.552,1.463-5.465
                                        C43.359,43.676,40.912,43.02,39,44.124z M38,32c0,3.313-2.687,6-6,6s-6-2.687-6-6s2.687-6,6-6S38,28.687,38,32z" />

                                  </svg>
                                  <div>
                                      <h6 class="mb-0">Data Kategori</h6><small class="text-muted">Kelola Kategori Transaksi</small>
                                  </div>
                              </a>
                          </li>
                      <?php } ?>

                      <?php if ($_SESSION['level'] == 'administrator') { ?>
                          <li>
                              <a class="m-link <?php echo ($current_page == 'bank.php') ? 'active' : ''; ?>" href="bank.php">
                                  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 64 64">

                                      <path class="st1" d="M31.997,60C16.537,60,3.999,47.462,4,32.002C3.996,16.537,16.535,4,31.995,4C47.459,4,59.999,16.537,60,32
                                        S47.461,60,31.997,60z M53.999,32c-0.001-12.149-9.857-22-22.005-22C19.85,10,9.995,19.851,9.999,32.002
                                        C9.998,44.146,19.85,54,31.996,54C44.144,54,54,44.145,53.999,32L53.999,32z" />
                                      <path class="st0" d="M47.282,27.597c0.638-4.258-2.604-6.547-7.038-8.074l1.438-5.768l-3.51-0.875l-1.4,5.616
                                        c-0.924-0.23-1.871-0.447-2.813-0.662l1.409-5.653l-3.51-0.875l-1.439,5.767c-0.764-0.175-1.514-0.347-2.243-0.527l0.004-0.017
                                        l-4.842-1.21l-0.934,3.75c0,0,2.606,0.597,2.55,0.635c1.423,0.354,1.679,1.296,1.636,2.042l-3.939,15.801
                                        c-0.173,0.432-0.615,1.079-1.609,0.833c0.035,0.052-2.552-0.636-2.552-0.636l-1.743,4.019l4.569,1.14
                                        c0.85,0.213,1.683,0.435,2.503,0.646l-1.453,5.833l3.507,0.876l1.438-5.774c0.958,0.262,1.888,0.5,2.799,0.727l-1.434,5.745
                                        l3.51,0.876l1.454-5.824c4.734,0.896,10.564,0.461,12.384-4.739c1.517-4.325-1.217-7.469-3.226-8.515
                                        C45.095,32.224,46.821,30.714,47.282,27.597L47.282,27.597z M39.26,38.847c-1.084,4.36-8.425,2.004-10.806,1.413l1.929-7.729
                                        C32.761,33.124,40.395,34.3,39.26,38.847L39.26,38.847z M40.346,27.535c-0.989,3.966-7.1,1.951-9.083,1.458l1.748-7.011
                                        C34.994,22.476,41.377,23.397,40.346,27.535z" />

                                  </svg>
                                  <div>
                                      <h6 class="mb-0">Rekening Bank</h6><small class="text-muted">Kelola Rekening Bank</small>
                                  </div>
                              </a>
                          </li>
                      <?php } ?>

                      <li class="collapsed">
                          <a class="m-link <?php echo (in_array($current_page, ['hutang.php', 'piutang.php'])) ? 'active' : ''; ?>" data-bs-toggle="collapse" data-bs-target="#form" href="#">
                              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 64 64">

                                  <path class="st1" d="M52.069,24.893c3.283,5.371,5.676,11.109,6.327,15.939c1.7-3.766,3.014-11.133-1.376-19.159
                                                c1.358-0.886,1.722-1.15,1.824-1.355c0.274-0.554-1.862-3.773-2.479-3.734c-0.226,0.015-0.609,0.248-1.955,1.154
                                                c-5.685-7.169-12.979-8.83-17.109-8.734c4.196,2.483,8.549,6.923,12.218,12.04c-3.22,2.163-8.002,5.344-15.179,10.016
                                                c-0.802,0.522-1.572,1.022-2.34,1.521c-0.768-0.499-1.539-0.999-2.34-1.521c-7.177-4.672-11.959-7.853-15.179-10.016
                                                c3.669-5.117,8.022-9.557,12.218-12.04c-4.131-0.096-11.425,1.565-17.11,8.734c-1.345-0.907-1.729-1.139-1.955-1.154
                                                c-0.617-0.039-2.754,3.181-2.479,3.734c0.103,0.205,0.466,0.469,1.825,1.355c-4.39,8.025-3.077,15.393-1.376,19.159
                                                c0.652-4.83,3.044-10.568,6.327-15.939c3.246,2.124,8.038,5.29,15.137,10.081c0.207,0.14,0.399,0.271,0.604,0.408
                                                C15.214,43.411,8.157,47.727,8.007,48.336c-0.16,0.711,2.051,4.043,2.764,4.166c0.644,0.11,7.943-5.148,21.229-14.186
                                                c13.285,9.037,20.585,14.296,21.229,14.186c0.713-0.123,2.924-3.455,2.764-4.166c-0.148-0.609-7.207-4.925-19.663-12.954
                                                c0.204-0.138,0.396-0.269,0.604-0.408C44.032,30.183,48.824,27.017,52.069,24.893z" />
                                  <path class="st0" d="M45.01,30c-0.353,0-0.701,0.103-1.01,0.234v-2.661C44,21.178,37.885,16,32,16c-5.878,0-12,5.178-12,11.573
                                                v2.66C19.692,30.102,19.344,30,18.992,30C17.998,30,17,30.818,17,34.081C17,37.348,18.161,40,20.1,40
                                                c0.055,0,0.097-0.024,0.149-0.031c0.642,4.521,2.502,7.143,5.143,9.307C26.98,50.576,29.168,52,32,52
                                                c2.829,0,5.016-1.424,6.61-2.725c2.636-2.164,4.498-4.786,5.141-9.307C43.804,39.975,43.846,40,43.902,40
                                                C45.841,40,47,37.348,47,34.081C47,30.818,46.006,30,45.01,30z M40,36.188c0,6.249-1.94,8.365-3.928,9.996
                                                C34.535,47.438,33.276,48,32,48c-1.281,0-2.538-0.562-4.074-1.819C25.94,44.553,24,42.44,24,36.188v-8.615
                                                C24,23.377,28.376,20,32,20c3.623,0,8,3.378,8,7.573V36.188z" />

                              </svg>
                              <div>
                                  <h6 class="mb-0">Hutang/Piutang</h6><small class="text-muted">Kelola Hutang dan Piutang</small>
                              </div> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span>
                          </a>
                          <!-- Menu: Sub menu ul -->
                          <ul class="sub-menu collapse <?php echo (in_array($current_page, ['hutang.php', 'piutang.php'])) ? 'show' : ''; ?>" id="form">
                              <li><a class="ms-link <?php echo ($current_page == 'hutang.php') ? 'active' : ''; ?>" href="hutang.php">Catatan Hutang</a></li>
                              <li><a class="ms-link <?php echo ($current_page == 'piutang.php') ? 'active' : ''; ?>" href="piutang.php">Catatan Piutang</a></li>
                          </ul>
                      </li>
                      <li>
                          <a class="m-link <?php echo ($current_page == 'laporan.php') ? 'active' : ''; ?>" href="laporan.php">
                              <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 38 38">
                                  <path xmlns="http://www.w3.org/2000/svg" d="M22,6h2c0.875,0,1.513,0.657,2,1.31V10h4.501L32,12v24H22V6z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                  <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M10,14v18h18V14h-6v2h4v14h-6v-2.059c1.989-0.236,3-1.22,3-2.941c0-0.805-0.27-1.5-0.78-2.01  C21.226,21.998,19.654,22.003,19,22c-0.352-0.007-1.398,0.002-1.806-0.405C17.111,21.512,17,21.359,17,21c0-0.469,0-1,2-1  c1.122,0,1.788,0.205,2.297,0.709l1.406-1.422c-0.704-0.697-1.568-1.083-2.703-1.222V14H10z M18,18.059  c-1.988,0.236-3,1.221-3,2.941c0,0.805,0.271,1.5,0.781,2.01c0.994,0.992,2.543,0.989,3.22,0.99  c0.343-0.008,1.397-0.002,1.805,0.405C20.89,24.488,21,24.641,21,25c0,0.469,0,1-2,1c-1.121,0-1.787-0.205-2.297-0.709l-1.406,1.422  c0.705,0.697,1.568,1.083,2.703,1.222V30h-6V16h6V18.059z M30,14v20H8V4h15c0.46,0,1,0.26,1,1v3H12v2h12v2h7.99  c0,0-6.08-8.17-6.62-8.87C24.83,2.44,23.99,2,23,2H6v34h26V14H30z M26,7.31L28.01,10H26V7.31z"></path>
                              </svg>
                              <div>
                                  <h6 class="mb-0">Laporan</h6><small class="text-muted">Cetak Laporan</small>
                              </div>
                          </a>
                      </li>


                      <?php if ($_SESSION['level'] == 'administrator') { ?>
                          <li class="divider mt-4 py-2 border-top text-uppercase"><small>Pengelolaan Pengguna</small></li>
                          <li>
                              <a class="m-link <?php echo ($current_page == 'user.php') ? 'active' : ''; ?>" href="user.php">
                                  <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24">
                                      <path xmlns="http://www.w3.org/2000/svg" d="M20,20c0,1.104-0.896,2-2,2H6c-1.104,0-2-0.896-2-2V4c0-1.104,0.896-2,2-2h8l6,6V20z" style="fill:var(--primary-color);" data-st="fill:var(--chart-color4);"></path>
                                      <path xmlns="http://www.w3.org/2000/svg" class="st0" d="M16,8c-1.1,0-1.99-0.9-1.99-2L14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h1v-1.25C7,19.09,10.33,18,12,18  s5,1.09,5,2.75V22h1c1.1,0,2-0.9,2-2V8H16z M12,17c-1.66,0-3-1.34-3-3s1.34-3,3-3s3,1.34,3,3S13.66,17,12,17z"></path>
                                  </svg>
                                  <div>
                                      <h6 class="mb-0">Data Pengguna</h6><small class="text-muted">Kelola Data Pengguna</small>
                                  </div>
                              </a>
                          </li>
                      <?php } ?>

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