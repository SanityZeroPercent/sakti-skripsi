<?php
// Check authentication
if (!isset($_SESSION['status']) || $_SESSION['status'] != "administrator_logedin") {
  header("location:../index.php?alert=belum_login");
  exit();
}

include '../koneksi.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Handle ADD piutang (piutang_act.php functionality)
  if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $tanggal = $_POST['tanggal'];
    $nominal = $_POST['nominal'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($koneksi, "INSERT INTO piutang VALUES (NULL,'$tanggal','$nominal','$keterangan')") or die(mysqli_error($koneksi));
    header("location:piutang.php?status=added");
    exit();
  }

  // Handle UPDATE piutang (piutang_update.php functionality)
  if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    $nominal = $_POST['nominal'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($koneksi, "UPDATE piutang SET piutang_tanggal='$tanggal', piutang_nominal='$nominal', piutang_keterangan='$keterangan' WHERE piutang_id='$id'") or die(mysqli_error($koneksi));
    header("location:piutang.php?status=updated");
    exit();
  }
}

// Handle DELETE piutang (piutang_hapus.php functionality)
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
  $id = $_GET['id'];

  mysqli_query($koneksi, "DELETE FROM piutang WHERE piutang_id='$id'");
  header("location:piutang.php?status=deleted");
  exit();
}
?>
<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Piutang
      <small>Data Piutang</small>
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
            <h3 class="box-title">Catatan Piutang</h3>
            <div class="btn-group pull-right">

              <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#tambah_piutang_modal">
                <i class="fa fa-plus"></i> &nbsp Tambah Piutang
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal Tambah -->
            <div class="modal fade" id="tambah_piutang_modal" tabindex="-1" aria-labelledby="tambahPiutangLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form action="piutang.php" method="post">
                    <input type="hidden" name="action" value="add">
                    <div class="modal-header">
                      <h5 class="modal-title" id="tambahPiutangLabel">Tambah Piutang</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" name="tanggal" required="required" class="form-control datepicker2">
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
                  $data = mysqli_query($koneksi, "SELECT * FROM piutang");
                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td class="text-center"><?php echo $no++; ?></td>
                      <td>PTG-000<?php echo $d['piutang_id']; ?></td>
                      <td class="text-center"><?php echo date('d-m-Y', strtotime($d['piutang_tanggal'])); ?></td>
                      <td><?php echo $d['piutang_keterangan']; ?></td>
                      <td class="text-center"><?php echo "Rp. " . number_format($d['piutang_nominal']) . " ,-"; ?></td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_piutang_<?php echo $d['piutang_id'] ?>">
                          <i class="fa fa-cog"></i>
                        </button>

                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus_piutang_<?php echo $d['piutang_id'] ?>">
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
      </section>
    </div>
  </section>

</div>

<?php
$data = mysqli_query($koneksi, "SELECT * FROM piutang");
while ($d = mysqli_fetch_array($data)) {
?>
  <!-- Modal Edit Piutang -->
  <div class="modal fade" id="edit_piutang_<?php echo $d['piutang_id'] ?>" tabindex="-1" aria-labelledby="editPiutangLabel_<?php echo $d['piutang_id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="piutang.php" method="post">
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id" value="<?php echo $d['piutang_id']; ?>">
          <div class="modal-header">
            <h5 class="modal-title" id="editPiutangLabel_<?php echo $d['piutang_id'] ?>">Edit Piutang</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Tanggal</label>
              <input type="text" name="tanggal" required="required" class="form-control datepicker2" value="<?php echo $d['piutang_tanggal']; ?>">
            </div>
            <div class="form-group">
              <label>Nominal</label>
              <input type="number" name="nominal" required="required" class="form-control" placeholder="Masukkan Nominal .." value="<?php echo $d['piutang_nominal']; ?>">
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" rows="3"><?php echo $d['piutang_keterangan']; ?></textarea>
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

  <!-- Modal Hapus Piutang -->
  <div class="modal fade" id="hapus_piutang_<?php echo $d['piutang_id'] ?>" tabindex="-1" aria-labelledby="hapusPiutangLabel_<?php echo $d['piutang_id'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="hapusPiutangLabel_<?php echo $d['piutang_id'] ?>">Peringatan!</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin menghapus data ini?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <a href="piutang.php?action=delete&id=<?php echo $d['piutang_id']; ?>" class="btn btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>

<?php include 'footer.php'; ?>