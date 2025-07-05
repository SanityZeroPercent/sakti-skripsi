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

  // Handle ADD bank (bank_act.php functionality)
  if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $nama = $_POST['nama'];
    $pemilik = $_POST['pemilik'];
    $nomor = $_POST['nomor'];
    $saldo = $_POST['saldo'];

    mysqli_query($koneksi, "INSERT INTO bank VALUES (NULL,'$nama','$pemilik','$nomor','$saldo')");
    header("location:bank.php?status=added");
    exit();
  }

  // Handle UPDATE bank (bank_update.php functionality)
  if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $pemilik = $_POST['pemilik'];
    $nomor = $_POST['nomor'];
    $saldo = $_POST['saldo'];

    mysqli_query($koneksi, "UPDATE bank SET bank_nama='$nama', bank_pemilik='$pemilik', bank_nomor='$nomor', bank_saldo='$saldo' WHERE bank_id='$id'") or die(mysqli_error($koneksi));
    header("location:bank.php?status=updated");
    exit();
  }
}

// Handle DELETE bank (bank_hapus.php functionality)
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
  $id = $_GET['id'];

  // It's good practice to ensure the default bank (ID 1) cannot be deleted.
  if ($id != 1) {
    // Update transactions to use default bank (ID 1) before deleting
    mysqli_query($koneksi, "UPDATE transaksi SET transaksi_bank='1' WHERE transaksi_bank='$id'");

    // Delete the bank record
    mysqli_query($koneksi, "DELETE FROM bank WHERE bank_id='$id'");
    header("location:bank.php?status=deleted");
    exit();
  } else {
    header("location:bank.php?status=delete_failed");
    exit();
  }
}
?>
<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Bank
      <small>Data bank</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Data Akun Bank</h3>
            <div class="btn-group pull-right">
              <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahBank">
                <i class="fa fa-plus"></i> &nbsp Tambah Bank
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal Tambah Bank -->
            <div class="modal fade" id="modalTambahBank" tabindex="-1" aria-labelledby="modalTambahBankLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form action="bank.php" method="post">
                    <input type="hidden" name="action" value="add">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalTambahBankLabel">Tambah Bank</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Nama bank</label>
                        <select class="form-control" name="nama" required="required" class="" size="1">
                          <option value="">-- Pilih Bank --</option>
                          <optgroup label="Bank Pemerintah">
                            <option value="Bank Mandiri">Bank Mandiri</option>
                            <option value="Bank BNI">Bank Negara Indonesia (BNI)</option>
                            <option value="Bank BRI">Bank Rakyat Indonesia (BRI)</option>
                            <option value="Bank BTN">Bank Tabungan Negara (BTN)</option>
                          </optgroup>

                          <optgroup label="Bank Pembangunan Daerah">
                            <option value="Bank BPD Aceh">Bank Aceh</option>
                            <option value="Bank BPD Bali">Bank Bali</option>
                            <option value="Bank Bank DKI">Bank DKI</option>
                            <option value="Bank BJB">Bank Jabar Banten (BJB)</option>
                            <option value="Bank Jateng">Bank Jateng</option>
                            <option value="Bank Jatim">Bank Jatim</option>
                            <option value="Bank Kalsel">Bank Kalimantan Selatan</option>
                            <option value="Bank Kaltim">Bank Kalimantan Timur</option>
                            <option value="Bank Lampung">Bank Lampung</option>
                            <option value="Bank Maluku">Bank Maluku</option>
                            <option value="Bank Nagari">Bank Nagari</option>
                            <option value="Bank NTT">Bank NTT</option>
                            <option value="Bank Papua">Bank Papua</option>
                            <option value="Bank Riau">Bank Riau Kepri</option>
                            <option value="Bank Sultra">Bank Sulawesi Tenggara</option>
                            <option value="Bank Sumsel">Bank Sumsel Babel</option>
                            <option value="Bank Sumut">Bank Sumut</option>
                          </optgroup>

                          <optgroup label="Bank Swasta Nasional">
                            <option value="Bank BCA">Bank Central Asia (BCA)</option>
                            <option value="Bank CIMB Niaga">Bank CIMB Niaga</option>
                            <option value="Bank Danamon">Bank Danamon</option>
                            <option value="Bank Maybank">Bank Maybank Indonesia</option>
                            <option value="Bank Mega">Bank Mega</option>
                            <option value="Bank OCBC NISP">Bank OCBC NISP</option>
                            <option value="Bank Panin">Bank Panin</option>
                            <option value="Bank Permata">Bank Permata</option>
                          </optgroup>

                          <optgroup label="Bank Syariah">
                            <option value="Bank BSI">Bank Syariah Indonesia (BSI)</option>
                            <option value="Bank BCA Syariah">BCA Syariah</option>
                            <option value="Bank BNI Syariah">BNI Syariah</option>
                            <option value="Bank BRI Syariah">BRI Syariah</option>
                            <option value="Bank Muamalat">Bank Muamalat</option>
                            <option value="Bank Panin Dubai Syariah">Bank Panin Dubai Syariah</option>
                          </optgroup>

                          <optgroup label="Bank Asing & Campuran">
                            <option value="Bank Citibank">Citibank</option>
                            <option value="Bank HSBC">HSBC Indonesia</option>
                            <option value="Bank Standard Chartered">Standard Chartered</option>
                            <option value="Bank ANZ">ANZ Indonesia</option>
                            <option value="Bank DBS">DBS Indonesia</option>
                          </optgroup>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Nama Pemilik Rekening</label>
                        <input type="text" name="pemilik" class="form-control" placeholder="Nama pemiliki rekening bank ..">
                      </div>
                      <div class="form-group">
                        <label>Nomor Rekening</label>
                        <input type="text" name="nomor" class="form-control" placeholder="Nomor rekening bank ..">
                      </div>
                      <div class="form-group">
                        <label>Saldo Awal</label>
                        <input type="number" name="saldo" required="required" class="form-control" placeholder="Saldo bank ..">
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
                    <th width="1%">NO</th>
                    <th>NAMA BANK</th>
                    <th>PEMILIK REKENING</th>
                    <th>NOMOR REKENING</th>
                    <th>SALDO</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $data = mysqli_query($koneksi, "SELECT * FROM bank");
                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['bank_nama']; ?></td>
                      <td><?php echo $d['bank_pemilik']; ?></td>
                      <td><?php echo $d['bank_nomor']; ?></td>
                      <td><?php echo "Rp. " . number_format($d['bank_saldo']) . " ,-"; ?></td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_bank_<?php echo $d['bank_id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <?php if ($d['bank_id'] != 1) { ?>
                          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus_bank_<?php echo $d['bank_id'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        <?php } ?>
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
      </section>
    </div>
  </section>

</div>

<?php
// Generate Modals for Edit and Delete
$data = mysqli_query($koneksi, "SELECT * FROM bank");
while ($d = mysqli_fetch_array($data)) {
?>
  <!-- Modal Edit Bank -->
  <div class="modal fade" id="edit_bank_<?php echo $d['bank_id'] ?>" tabindex="-1" aria-labelledby="editBankLabel_<?php echo $d['bank_id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="bank.php" method="post">
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id" value="<?php echo $d['bank_id']; ?>">
          <div class="modal-header">
            <h5 class="modal-title" id="editBankLabel_<?php echo $d['bank_id'] ?>">Edit Bank</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Nama Bank</label>
              <?php
              $bank_groups = [
                "Bank Pemerintah" => [
                  "Bank Mandiri",
                  "Bank BNI",
                  "Bank BRI",
                  "Bank BTN"
                ],
                "Bank Pembangunan Daerah" => [
                  "Bank BPD Aceh",
                  "Bank BPD Bali",
                  "Bank Bank DKI",
                  "Bank BJB",
                  "Bank Jateng",
                  "Bank Jatim",
                  "Bank Kalsel",
                  "Bank Kaltim",
                  "Bank Lampung",
                  "Bank Maluku",
                  "Bank Nagari",
                  "Bank NTT",
                  "Bank Papua",
                  "Bank Riau",
                  "Bank Sultra",
                  "Bank Sumsel",
                  "Bank Sumut"
                ],
                "Bank Swasta Nasional" => [
                  "Bank BCA",
                  "Bank CIMB Niaga",
                  "Bank Danamon",
                  "Bank Maybank",
                  "Bank Mega",
                  "Bank OCBC NISP",
                  "Bank Panin",
                  "Bank Permata"
                ],
                "Bank Syariah" => [
                  "Bank BSI",
                  "Bank BCA Syariah",
                  "Bank BNI Syariah",
                  "Bank BRI Syariah",
                  "Bank Muamalat",
                  "Bank Panin Dubai Syariah"
                ],
                "Bank Asing & Campuran" => [
                  "Bank Citibank",
                  "Bank HSBC",
                  "Bank Standard Chartered",
                  "Bank ANZ",
                  "Bank DBS"
                ]
              ];
              $current_bank = $d['bank_nama'];
              ?>
              <select class="form-control" name="nama" required="required">
                <option value="">-- Pilih Bank --</option>
                <?php foreach ($bank_groups as $group_label => $banks) { ?>
                  <optgroup label="<?php echo $group_label; ?>">
                    <?php foreach ($banks as $bank_name) { ?>
                      <option value="<?php echo $bank_name; ?>" <?php if ($current_bank == $bank_name) echo 'selected'; ?>>
                        <?php echo $bank_name; ?>
                      </option>
                    <?php } ?>
                  </optgroup>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Nama Pemilik Rekening</label>
              <input type="text" name="pemilik" class="form-control" placeholder="Nama pemiliki rekening bank .." value="<?php echo $d['bank_pemilik']; ?>">
            </div>
            <div class="form-group">
              <label>Nomor Rekening</label>
              <input type="text" name="nomor" class="form-control" placeholder="Nomor rekening bank .." value="<?php echo $d['bank_nomor']; ?>">
            </div>
            <div class="form-group">
              <label>Saldo</label>
              <input type="number" name="saldo" required="required" class="form-control" placeholder="Saldo bank .." value="<?php echo $d['bank_saldo']; ?>">
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

  <?php if ($d['bank_id'] != 1) { ?>
    <!-- Modal Hapus Bank -->
    <div class="modal fade" id="hapus_bank_<?php echo $d['bank_id'] ?>" tabindex="-1" aria-labelledby="hapusBankLabel_<?php echo $d['bank_id'] ?>" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="hapusBankLabel_<?php echo $d['bank_id'] ?>">Peringatan!</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Anda yakin ingin menghapus data ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <a href="bank.php?action=delete&id=<?php echo $d['bank_id']; ?>" class="btn btn-danger">Hapus</a>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
<?php
}
?>

<?php include 'footer.php'; ?>