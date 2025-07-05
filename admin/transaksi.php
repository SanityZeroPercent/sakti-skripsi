<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Check authentication
if (!isset($_SESSION['status']) || $_SESSION['status'] != "administrator_logedin") {
  header("location:../index.php?alert=belum_login");
  exit();
}

include '../koneksi.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Handle ADD transaksi (transaksi_act.php functionality)
  if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $kategori = $_POST['kategori'];
    $nominal = $_POST['nominal'];
    $keterangan = $_POST['keterangan'];
    $bank = $_POST['bank'];

    $rekening = mysqli_query($koneksi, "SELECT * FROM bank WHERE bank_id='$bank'");
    $r = mysqli_fetch_assoc($rekening);

    if ($jenis == "Pemasukan") {
      $saldo_sekarang = $r['bank_saldo'];
      $total = $saldo_sekarang + $nominal;
      mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$total' WHERE bank_id='$bank'");
    } elseif ($jenis == "Pengeluaran") {
      $saldo_sekarang = $r['bank_saldo'];
      $total = $saldo_sekarang - $nominal;
      mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$total' WHERE bank_id='$bank'");
    }

    mysqli_query($koneksi, "INSERT INTO transaksi VALUES (NULL,'$tanggal','$jenis','$kategori','$nominal','$keterangan','$bank')") or die(mysqli_error($koneksi));
    header("location:transaksi.php?status=added");
    exit();
  }

  // Handle UPDATE transaksi (transaksi_update.php functionality)
  if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    $jenis = $_POST['jenis'];
    $kategori = $_POST['kategori'];
    $nominal = $_POST['nominal'];
    $keterangan = $_POST['keterangan'];
    $bank = $_POST['bank'];

    $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE transaksi_id='$id'");
    $t = mysqli_fetch_assoc($transaksi);
    $bank_lama = $t['transaksi_bank'];

    $rekening = mysqli_query($koneksi, "SELECT * FROM bank WHERE bank_id='$bank_lama'");
    $r = mysqli_fetch_assoc($rekening);

    if ($t['transaksi_jenis'] == "Pemasukan") {
      $kembalikan = $r['bank_saldo'] - $t['transaksi_nominal'];
      mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$kembalikan' WHERE bank_id='$bank_lama'");
    } else if ($t['transaksi_jenis'] == "Pengeluaran") {
      $kembalikan = $r['bank_saldo'] + $t['transaksi_nominal'];
      mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$kembalikan' WHERE bank_id='$bank_lama'");
    }

    if ($jenis == "Pemasukan") {
      $rekening2 = mysqli_query($koneksi, "SELECT * FROM bank WHERE bank_id='$bank'");
      $rr = mysqli_fetch_assoc($rekening2);
      $saldo_sekarang = $rr['bank_saldo'];
      $total = $saldo_sekarang + $nominal;
      mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$total' WHERE bank_id='$bank'");
    } elseif ($jenis == "Pengeluaran") {
      $rekening2 = mysqli_query($koneksi, "SELECT * FROM bank WHERE bank_id='$bank'");
      $rr = mysqli_fetch_assoc($rekening2);
      $saldo_sekarang = $rr['bank_saldo'];
      $total = $saldo_sekarang - $nominal;
      mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$total' WHERE bank_id='$bank'");
    }

    mysqli_query($koneksi, "UPDATE transaksi SET transaksi_tanggal='$tanggal', transaksi_jenis='$jenis', transaksi_kategori='$kategori', transaksi_nominal='$nominal', transaksi_keterangan='$keterangan', transaksi_bank='$bank' WHERE transaksi_id='$id'") or die(mysqli_error($koneksi));
    header("location:transaksi.php?status=updated");
    exit();
  }
}

// Handle DELETE transaksi (transaksi_hapus.php functionality)
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
  $id = $_GET['id'];

  $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE transaksi_id='$id'");
  $t = mysqli_fetch_assoc($transaksi);
  $bank_lama = $t['transaksi_bank'];

  $rekening = mysqli_query($koneksi, "SELECT * FROM bank WHERE bank_id='$bank_lama'");
  $r = mysqli_fetch_assoc($rekening);

  $jenis = $t['transaksi_jenis'];
  $nominal = $t['transaksi_nominal'];

  if ($jenis == "Pemasukan") {
    $saldo_sekarang = $r['bank_saldo'];
    $total = $saldo_sekarang - $nominal;
    mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$total' WHERE bank_id='$bank_lama'");
  } elseif ($jenis == "Pengeluaran") {
    $saldo_sekarang = $r['bank_saldo'];
    $total = $saldo_sekarang + $nominal;
    mysqli_query($koneksi, "UPDATE bank SET bank_saldo='$total' WHERE bank_id='$bank_lama'");
  }

  mysqli_query($koneksi, "DELETE FROM transaksi WHERE transaksi_id='$id'");
  header("location:transaksi.php?status=deleted");
  exit();
}
?>
<?php include 'header.php'; ?>

<!-- Body: Titel Header -->
<div class="body-header border-bottom d-flex py-3">
  <div class="container-xxl">
    <div class="row align-items-center g-2">
      <div class="col">
        <!-- Pretitle -->
        <h1 class="h4 mt-1">Transaksi Pemasukan & Pengeluaran</h1>
      </div>
      <div class="col-12 col-md-6 text-md-end">
        <button type="button" data-bs-toggle="modal" data-bs-target="#tambah_transaksi_modal" class="btn btn-primary lift">Tambah Transaksi</button>
      </div>
    </div> <!-- Row end  -->
  </div>
</div>

<!-- Body: Body -->
<div class="body d-flex py-3">
  <div class="container-xxl">
    <!-- Modal Tambah -->
    <div class="modal fade" id="tambah_transaksi_modal" tabindex="-1" aria-labelledby="tambahTransaksiLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="transaksi.php" method="post">
            <input type="hidden" name="action" value="add">
            <div class="modal-header">
              <h5 class="modal-title" id="tambahTransaksiLabel">Tambah Transaksi</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" required="required" class="form-control">
              </div>
              <div class="form-group">
                <label>Jenis</label>
                <select name="jenis" class="form-control" required="required">
                  <option value="">- Pilih -</option>
                  <option value="Pemasukan">Pemasukan</option>
                  <option value="Pengeluaran">Pengeluaran</option>
                </select>
              </div>
              <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" class="form-control" required="required">
                  <option value="">- Pilih -</option>
                  <?php
                  $kategori_data = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY kategori ASC");
                  while ($k = mysqli_fetch_array($kategori_data)) {
                  ?>
                    <option value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Nominal</label>
                <input type="number" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal ..">
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label>Rekening Bank</label>
                <select name="bank" class="form-control" required="required">
                  <option value="">- Pilih -</option>
                  <?php
                  $bank_data = mysqli_query($koneksi, "SELECT * FROM bank");
                  while ($b = mysqli_fetch_array($bank_data)) {
                  ?>
                    <option value="<?php echo $b['bank_id']; ?>"><?php echo $b['bank_nama']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-striped" id="table-datatable">
        <thead>
          <tr>
            <th width="1%" rowspan="2">NO</th>
            <th width="10%" rowspan="2" class="text-center">TANGGAL</th>
            <th rowspan="2" class="text-center">KATEGORI</th>
            <th rowspan="2" class="text-center">KETERANGAN</th>
            <th rowspan="2" class="text-center">REKENING BANK</th> <!-- Add this line -->
            <th colspan="2" class="text-center">JENIS</th>
            <th rowspan="2" width="10%" class="text-center">OPSI</th>
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
          $data = mysqli_query($koneksi, "SELECT transaksi.*, kategori.kategori, bank.* FROM transaksi
                                        JOIN kategori ON kategori.kategori_id = transaksi.transaksi_kategori
                                        JOIN bank ON bank.bank_id = transaksi.transaksi_bank
                                        ORDER BY transaksi_id DESC");
          while ($d = mysqli_fetch_array($data)) {
          ?>
            <tr>
              <td class="text-center"><?php echo $no++; ?></td>
              <td class="text-center"><?php echo date('d-m-Y', strtotime($d['transaksi_tanggal'])); ?></td>
              <td><?php echo $d['kategori']; ?></td>
              <td><?php echo $d['transaksi_keterangan']; ?></td>
              <td><?php echo $d['bank_nama']; ?> <br> <?php echo $d['bank_nomor']; ?> <br> a.n. <?php echo $d['bank_pemilik']; ?></td> <!-- Add this line -->

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
              <td>
                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_transaksi_<?php echo $d['transaksi_id'] ?>">
                  <i class="fa fa-cog"></i>
                </button>

                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus_transaksi_<?php echo $d['transaksi_id'] ?>">
                  <i class="fa fa-trash"></i>
                </button>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
$data = mysqli_query($koneksi, "SELECT transaksi.*, kategori.kategori, bank.* FROM transaksi JOIN kategori ON kategori.kategori_id = transaksi.transaksi_kategori JOIN bank ON bank.bank_id = transaksi.transaksi_bank ORDER BY transaksi_id DESC");
while ($d = mysqli_fetch_array($data)) {
?>
  <!-- Modal Edit Transaksi -->
  <div class="modal fade" id="edit_transaksi_<?php echo $d['transaksi_id'] ?>" tabindex="-1" aria-labelledby="editTransaksiLabel_<?php echo $d['transaksi_id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="transaksi.php" method="post">
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id" value="<?php echo $d['transaksi_id']; ?>">
          <div class="modal-header">
            <h5 class="modal-title" id="editTransaksiLabel_<?php echo $d['transaksi_id'] ?>">Edit Transaksi</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Tanggal</label>
              <input type="text" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['transaksi_tanggal']; ?>">
            </div>
            <div class="form-group">
              <label>Jenis</label>
              <select name="jenis" class="form-control" required="required">
                <option value="Pemasukan" <?php if ($d['transaksi_jenis'] == 'Pemasukan') {
                                            echo "selected";
                                          } ?>>Pemasukan</option>
                <option value="Pengeluaran" <?php if ($d['transaksi_jenis'] == 'Pengeluaran') {
                                              echo "selected";
                                            } ?>>Pengeluaran</option>
              </select>
            </div>
            <div class="form-group">
              <label>Kategori</label>
              <select name="kategori" class="form-control" required="required">
                <?php
                $kategori_data_edit = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY kategori ASC");
                while ($k = mysqli_fetch_array($kategori_data_edit)) {
                ?>
                  <option value="<?php echo $k['kategori_id']; ?>" <?php if ($k['kategori_id'] == $d['transaksi_kategori']) {
                                                                      echo "selected";
                                                                    } ?>><?php echo $k['kategori']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Nominal</label>
              <input type="number" name="nominal" required="required" class="form-control" value="<?php echo $d['transaksi_nominal']; ?>">
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" rows="3"><?php echo $d['transaksi_keterangan']; ?></textarea>
            </div>
            <div class="form-group">
              <label>Rekening Bank</label>
              <select name="bank" class="form-control" required="required">
                <?php
                $bank_data_edit = mysqli_query($koneksi, "SELECT * FROM bank");
                while ($b = mysqli_fetch_array($bank_data_edit)) {
                ?>
                  <option value="<?php echo $b['bank_id']; ?>" <?php if ($b['bank_id'] == $d['transaksi_bank']) {
                                                                  echo "selected";
                                                                } ?>><?php echo $b['bank_nama']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Hapus Transaksi -->
  <div class="modal fade" id="hapus_transaksi_<?php echo $d['transaksi_id'] ?>" tabindex="-1" aria-labelledby="hapusTransaksiLabel_<?php echo $d['transaksi_id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="hapusTransaksiLabel_<?php echo $d['transaksi_id'] ?>">Peringatan!</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin menghapus data ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <a href="transaksi.php?action=delete&id=<?php echo $d['transaksi_id']; ?>" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>

<?php include 'footer.php'; ?>