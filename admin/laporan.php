<?php include 'header.php'; ?>
<!-- Body: Titel Header -->
<div class="body-header border-bottom d-flex py-3">
  <div class="container-xxl">
    <div class="row align-items-center g-2">
      <div class="col">
        <!-- Pretitle -->
        <h1 class="h4 mt-1">Laporan Keuangan</h1>
      </div>
    </div> <!-- Row end  -->
  </div>
</div>

<!-- Body: Body -->
<div class="body d-flex py-3">
  <div class="container-xxl">
    <div class="row">
      <div class="box box-info">
        <div class="box-body">
          <div class="card mb-3">
            <div class="card-body">
              <form method="get" action="" class="row g-3">
                <div class="col-lg-3">
                  <div class="input-group">
                    <input type="date" class="form-control" required="true" value="<?php if (isset($_GET['tanggal_dari'])) {
                                                                                      echo $_GET['tanggal_dari'];
                                                                                    } else {
                                                                                      echo "";
                                                                                    } ?>" name="tanggal_dari">
                  </div>
                </div>
                <div class="col-lg-3">
                  <input type="date" class="form-control" required="true" value="<?php if (isset($_GET['tanggal_sampai'])) {
                                                                                    echo $_GET['tanggal_sampai'];
                                                                                  } else {
                                                                                    echo "";
                                                                                  } ?>" name="tanggal_sampai">
                </div>
                <div class="col-lg-3">
                  <select name="kategori" class="form-select" required="required">
                    <option value="semua">- Semua Kategori -</option>
                    <?php
                    $kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
                    while ($k = mysqli_fetch_array($kategori)) {
                    ?>
                      <option <?php if (isset($_GET['kategori'])) {
                                if ($_GET['kategori'] == $k['kategori_id']) {
                                  echo "selected='selected'";
                                }
                              } ?> value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="col-lg-3">
                  <input type="submit" class="btn btn-outline-primary" value="TAMPILKAN">
                </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class=" box box-info">
      <div class="box-body">

        <?php
        if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari']) && isset($_GET['kategori'])) {
          $tgl_dari = $_GET['tanggal_dari'];
          $tgl_sampai = $_GET['tanggal_sampai'];
          $kategori = $_GET['kategori'];
        ?>

          <div class="row">
            <div class="col-lg-6">
              <table class="table table-bordered">
                <tr>
                  <th width="30%">DARI TANGGAL</th>
                  <th width="1%">:</th>
                  <td><?php echo $tgl_dari; ?></td>
                </tr>
                <tr>
                  <th>SAMPAI TANGGAL</th>
                  <th>:</th>
                  <td><?php echo $tgl_sampai; ?></td>
                </tr>
                <tr>
                  <th>KATEGORI</th>
                  <th>:</th>
                  <td>
                    <?php
                    if ($kategori == "semua") {
                      echo "SEMUA KATEGORI";
                    } else {
                      $k = mysqli_query($koneksi, "select * from kategori where kategori_id='$kategori'");
                      $kk = mysqli_fetch_assoc($k);
                      echo $kk['kategori'];
                    }
                    ?>

                  </td>
                </tr>
              </table>

            </div>
          </div>

          <a href="laporan_pdf.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&kategori=<?php echo $kategori ?>" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-file-pdf-o"></i> &nbsp CETAK PDF</a>
          <a href="laporan_print.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>&kategori=<?php echo $kategori ?>" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th width="1%" rowspan="2">NO</th>
                  <th width="10%" rowspan="2" class="text-center">TANGGAL</th>
                  <th rowspan="2" class="text-center">KATEGORI</th>
                  <th rowspan="2" class="text-center">KETERANGAN</th>
                  <th colspan="2" class="text-center">JENIS</th>
                </tr>
                <tr>
                  <th class="text-center">PEMASUKAN</th>
                  <th class="text-center">PENGELUARAN</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include '../koneksi.php';
                $no = 1;
                $total_pemasukan = 0;
                $total_pengeluaran = 0;
                if ($kategori == "semua") {
                  $data = mysqli_query($koneksi, "SELECT * FROM transaksi,kategori where kategori_id=transaksi_kategori and date(transaksi_tanggal)>='$tgl_dari' and date(transaksi_tanggal)<='$tgl_sampai'");
                } else {
                  $data = mysqli_query($koneksi, "SELECT * FROM transaksi,kategori where kategori_id=transaksi_kategori and kategori_id='$kategori' and date(transaksi_tanggal)>='$tgl_dari' and date(transaksi_tanggal)<='$tgl_sampai'");
                }
                while ($d = mysqli_fetch_array($data)) {

                  if ($d['transaksi_jenis'] == "Pemasukan") {
                    $total_pemasukan += $d['transaksi_nominal'];
                  } elseif ($d['transaksi_jenis'] == "Pengeluaran") {
                    $total_pengeluaran += $d['transaksi_nominal'];
                  }
                ?>
                  <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td class="text-center"><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
                    <td><?php echo $d['kategori']; ?></td>
                    <td><?php echo $d['transaksi_keterangan']; ?></td>
                    <td class="text-center">
                      <?php
                      if ($d['transaksi_jenis'] == "Pemasukan") {
                        echo "Rp. " . number_format($d['transaksi_nominal']) . " ,-";
                      } else {
                        echo "-";
                      }
                      ?>
                    </td>
                    <td class="text-center">
                      <?php
                      if ($d['transaksi_jenis'] == "Pengeluaran") {
                        echo "Rp. " . number_format($d['transaksi_nominal']) . " ,-";
                      } else {
                        echo "-";
                      }
                      ?>
                    </td>
                  </tr>
                <?php
                }
                ?>
                <tr>
                  <th colspan="4" class="text-right">TOTAL</th>
                  <td class="text-center text-bold text-success"><?php echo "Rp. " . number_format($total_pemasukan) . " ,-"; ?></td>
                  <td class="text-center text-bold text-danger"><?php echo "Rp. " . number_format($total_pengeluaran) . " ,-"; ?></td>
                </tr>
                <tr>
                  <th colspan="4" class="text-right">SALDO</th>
                  <td colspan="2" class="text-center text-bold text-white bg-primary"><?php echo "Rp. " . number_format($total_pemasukan - $total_pengeluaran) . " ,-"; ?></td>
                </tr>
              </tbody>
            </table>



          </div>

        <?php
        } else {
        ?>

          <div class="alert alert-info text-center">
            Silahkan Filter Laporan Terlebih Dulu.
          </div>

        <?php
        }
        ?>

      </div>
    </div>

  </div>

</div>
<?php include 'footer.php'; ?>