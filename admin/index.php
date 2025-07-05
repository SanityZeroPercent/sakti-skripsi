<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Check authentication BEFORE including header
if (!isset($_SESSION['status']) || ($_SESSION['status'] != "administrator_logedin" && $_SESSION['status'] != "manajemen_logedin")) {
    header("location:../index.php?alert=belum_login");
    exit();
}

$page_title = 'Dashboard'; // Used to identify page in footer
include 'header.php';
?>

<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row g-3 mb-3 row-cols-1 row-cols-md-2 row-cols-lg-4">
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-fill text-truncate">
                            <span class="text-muted small text-uppercase"> <i class="fa fa-level-up"></i> Pemasukan Hari Ini</span>
                            <div class="d-flex flex-column">
                                <div class="price-block">
                                    <?php
                                    $tanggal = date('Y-m-d');
                                    $pemasukan = mysqli_query($koneksi, "SELECT sum(transaksi_nominal) as total_pemasukan FROM transaksi WHERE transaksi_jenis='Pemasukan' and transaksi_tanggal='$tanggal'");
                                    $p = mysqli_fetch_assoc($pemasukan);
                                    ?>
                                    <span class="fs-6 fw-bold color-price-up"><?php echo "Rp. " . number_format($p['total_pemasukan']) . " ,-" ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-fill text-truncate">
                            <span class="text-muted small text-uppercase"> <i class="fa fa-level-up"></i> Pemasukan Bulan Ini</span>
                            <div class="d-flex flex-column">
                                <div class="price-block">
                                    <?php
                                    $bulan = date('m');
                                    $pemasukan = mysqli_query($koneksi, "SELECT sum(transaksi_nominal) as total_pemasukan FROM transaksi WHERE transaksi_jenis='Pemasukan' and month(transaksi_tanggal)='$bulan'");
                                    $p = mysqli_fetch_assoc($pemasukan);
                                    ?>
                                    <span class="fs-6 fw-bold color-price-up"><?php echo "Rp. " . number_format($p['total_pemasukan']) . " ,-" ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-fill text-truncate">
                            <span class="text-muted small text-uppercase"> <i class="fa fa-level-up"></i> Pemasukan Tahun Ini</span>
                            <div class="d-flex flex-column">
                                <div class="price-block">
                                    <?php
                                    $tahun = date('Y');
                                    $pemasukan = mysqli_query($koneksi, "SELECT sum(transaksi_nominal) as total_pemasukan FROM transaksi WHERE transaksi_jenis='Pemasukan' and year(transaksi_tanggal)='$tahun'");
                                    $p = mysqli_fetch_assoc($pemasukan);
                                    ?>
                                    <span class="fs-6 fw-bold color-price-up"><?php echo "Rp. " . number_format($p['total_pemasukan']) . " ,-" ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-fill text-truncate">
                            <span class="text-muted small text-uppercase"> <i class="fa fa-level-up"></i> Seluruh Pemasukan</span>
                            <div class="d-flex flex-column">
                                <div class="price-block">
                                    <?php
                                    $pemasukan = mysqli_query($koneksi, "SELECT sum(transaksi_nominal) as total_pemasukan FROM transaksi WHERE transaksi_jenis='Pemasukan'");
                                    $p = mysqli_fetch_assoc($pemasukan);
                                    ?>
                                    <span class="fs-6 fw-bold color-price-up"><?php echo "Rp. " . number_format($p['total_pemasukan']) . " ,-" ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row End -->
        <div class="row g-3 mb-3 row-cols-1 row-cols-md-2 row-cols-lg-4">
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-fill text-truncate">
                            <span class="text-muted small text-uppercase"> <i class="fa fa-level-down"></i> Pengeluaran Hari Ini</span>
                            <div class="d-flex flex-column">
                                <div class="price-block">
                                    <?php
                                    $tanggal = date('Y-m-d');
                                    $pengeluaran = mysqli_query($koneksi, "SELECT sum(transaksi_nominal) as total_pengeluaran FROM transaksi WHERE transaksi_jenis='pengeluaran' and transaksi_tanggal='$tanggal'");
                                    $p = mysqli_fetch_assoc($pengeluaran);
                                    ?>
                                    <span class="fs-6 fw-bold color-price-down"><?php echo "Rp. " . number_format($p['total_pengeluaran']) . " ,-" ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-fill text-truncate">
                            <span class="text-muted small text-uppercase"> <i class="fa fa-level-down"></i> Pengeluaran Bulan Ini</span>
                            <div class="d-flex flex-column">
                                <div class="price-block">
                                    <?php
                                    $bulan = date('m');
                                    $pengeluaran = mysqli_query($koneksi, "SELECT sum(transaksi_nominal) as total_pengeluaran FROM transaksi WHERE transaksi_jenis='pengeluaran' and month(transaksi_tanggal)='$bulan'");
                                    $p = mysqli_fetch_assoc($pengeluaran);
                                    ?>
                                    <span class="fs-6 fw-bold color-price-down"><?php echo "Rp. " . number_format($p['total_pengeluaran']) . " ,-" ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-fill text-truncate">
                            <span class="text-muted small text-uppercase"> <i class="fa fa-level-down"></i> Pengeluaran Tahun Ini</span>
                            <div class="d-flex flex-column">
                                <div class="price-block">
                                    <?php
                                    $tahun = date('Y');
                                    $pengeluaran = mysqli_query($koneksi, "SELECT sum(transaksi_nominal) as total_pengeluaran FROM transaksi WHERE transaksi_jenis='pengeluaran' and year(transaksi_tanggal)='$tahun'");
                                    $p = mysqli_fetch_assoc($pengeluaran);
                                    ?>
                                    <span class="fs-6 fw-bold color-price-down"><?php echo "Rp. " . number_format($p['total_pengeluaran']) . " ,-" ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-fill text-truncate">
                            <span class="text-muted small text-uppercase"> <i class="fa fa-level-down"></i> Seluruh Pengeluaran</span>
                            <div class="d-flex flex-column">
                                <div class="price-block">
                                    <?php
                                    $pengeluaran = mysqli_query($koneksi, "SELECT sum(transaksi_nominal) as total_pengeluaran FROM transaksi WHERE transaksi_jenis='pengeluaran'");
                                    $p = mysqli_fetch_assoc($pengeluaran);
                                    ?>
                                    <span class="fs-6 fw-bold color-price-down"><?php echo "Rp. " . number_format($p['total_pengeluaran']) . " ,-" ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row End -->
        <div class="row g-3 mb-3 row-deck">
            <div class="col-xl-8 col-xxl-7">
                <div class="card">
                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom align-items-center flex-wrap">
                        <h6 class="mb-0 fw-bold">Grafik Data Pemasukan & Pengeluaran</h6>
                        <ul class="nav nav-tabs tab-body-header rounded d-inline-flex mt-2 mt-md-0" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#bulan" role="tab">Per Bulan</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tahun" role="tab">Per Tahun</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="bulan">
                                <div class="row g-3">
                                    <div id="apex-stacked-area"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tahun">
                                <div class="row g-3">
                                    <div id="apex-stacked-bar-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-xxl-5">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center bg-transparent border-bottom-0">
                        <h6 class="mb-0 fw-bold">Perbandingan Seluruh Pemasukan dan Pengeluaran</h6>
                    </div>
                    <div class="card-body">
                        <div id="apex-simple-donut"></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row End -->
    <div class="row g-3 mb-3 row-deck">
    </div>
</div>
</div>

<?php include 'footer.php'; ?>