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

  // Handle ADD hutang (hutang_act.php functionality)
  if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $tanggal = $_POST['tanggal'];
    $nominal = $_POST['nominal'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($koneksi, "INSERT INTO hutang VALUES (NULL,'$tanggal','$nominal','$keterangan')") or die(mysqli_error($koneksi));
    header("location:hutang.php?status=added");
    exit();
  }

  // Handle UPDATE hutang (hutang_update.php functionality)
  if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    $nominal = $_POST['nominal'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($koneksi, "UPDATE hutang SET hutang_tanggal='$tanggal', hutang_nominal='$nominal', hutang_keterangan='$keterangan' WHERE hutang_id='$id'") or die(mysqli_error($koneksi));
    header("location:hutang.php?status=updated");
    exit();
  }
}

// Handle DELETE hutang (hutang_hapus.php functionality)
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
  $id = $_GET['id'];

  mysqli_query($koneksi, "DELETE FROM hutang WHERE hutang_id='$id'");
  header("location:hutang.php?status=deleted");
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
        <h1 class="h4 mt-1">Catatan Hutang</h1>
      </div>
      <div class="col-12 col-md-6 text-md-end">
        <button type="button" data-bs-toggle="modal" data-bs-target="#tambah_hutang_modal" class="btn btn-primary lift">Tambah Hutang</button>
      </div>
    </div> <!-- Row end  -->
  </div>
</div>

<!-- Body: Body -->
<div class="body d-flex py-3">
  <div class="container-xxl">
    <!-- Modal Tambah -->
    <div class="modal fade" id="tambah_hutang_modal" tabindex="-1" aria-labelledby="tambahHutangLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="hutang.php" method="post">
            <input type="hidden" name="action" value="add">
            <div class="modal-header">
              <h5 class="modal-title" id="tambahHutangLabel">Tambah Hutang</h5>
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
                <label>Nominal</label>
                <input type="number" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal ..">
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3"></textarea>
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
            <th width="1%">KODE</th>
            <th width="10%" class="text-center">TANGGAL</th>
            <th class="text-center">KETERANGAN</th>
            <th class="text-center">NOMINAL</th>
            <th width="10%" class="text-center">OPSI</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $data = mysqli_query($koneksi, "SELECT * FROM hutang");
          while ($d = mysqli_fetch_array($data)) {
          ?>
            <tr>
              <td class="text-center"><?php echo $no++; ?></td>
              <td>HTG-000<?php echo $d['hutang_id']; ?></td>
              <td class="text-center"><?php echo date('d-m-Y', strtotime($d['hutang_tanggal'])); ?></td>
              <td><?php echo $d['hutang_keterangan']; ?></td>
              <td class="text-center"><?php echo "Rp. " . number_format($d['hutang_nominal']) . " ,-"; ?></td>
              <td>
                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_hutang_<?php echo $d['hutang_id'] ?>">
                  <i class="fa fa-cog"></i>
                </button>

                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus_hutang_<?php echo $d['hutang_id'] ?>">
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
$data = mysqli_query($koneksi, "SELECT * FROM hutang");
while ($d = mysqli_fetch_array($data)) {
?>
  <!-- Modal Edit Hutang -->
  <div class="modal fade" id="edit_hutang_<?php echo $d['hutang_id'] ?>" tabindex="-1" aria-labelledby="editHutangLabel_<?php echo $d['hutang_id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="hutang.php" method="post">
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id" value="<?php echo $d['hutang_id']; ?>">
          <div class="modal-header">
            <h5 class="modal-title" id="editHutangLabel_<?php echo $d['hutang_id'] ?>">Edit Hutang</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Tanggal</label>
              <input type="text" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['hutang_tanggal']; ?>">
            </div>
            <div class="form-group">
              <label>Nominal</label>
              <input type="number" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal .." value="<?php echo $d['hutang_nominal']; ?>">
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" rows="3"><?php echo $d['hutang_keterangan']; ?></textarea>
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

  <!-- Modal Hapus Hutang -->
  <div class="modal fade" id="hapus_hutang_<?php echo $d['hutang_id'] ?>" tabindex="-1" aria-labelledby="hapusHutangLabel_<?php echo $d['hutang_id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="hapusHutangLabel_<?php echo $d['hutang_id'] ?>">Peringatan!</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin menghapus data ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <a href="hutang.php?action=delete&id=<?php echo $d['hutang_id']; ?>" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>

<?php include 'footer.php'; ?>