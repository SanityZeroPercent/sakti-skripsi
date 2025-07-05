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

  // Handle ADD kategori (kategori_act.php functionality)
  if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $kategori = $_POST['kategori'];

    mysqli_query($koneksi, "INSERT INTO kategori VALUES (NULL,'$kategori')");
    header("location:kategori.php");
    exit();
  }

  // Handle UPDATE kategori (kategori_update.php functionality)
  if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $kategori = $_POST['kategori'];

    mysqli_query($koneksi, "UPDATE kategori SET kategori='$kategori' WHERE kategori_id='$id'");
    header("location:kategori.php");
    exit();
  }
}

// Handle DELETE kategori (kategori_hapus.php functionality)
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
  $id = $_GET['id'];

  // Update transactions to use default category (ID 1) before deleting
  mysqli_query($koneksi, "UPDATE transaksi SET transaksi_kategori='1' WHERE transaksi_kategori='$id'");

  // Delete the category record
  mysqli_query($koneksi, "DELETE FROM kategori WHERE kategori_id='$id'");
  header("location:kategori.php");
  exit();
}
?>
<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Kategori
      <small>Data kategori</small>
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
            <h3 class="box-title">Kategori Transaksi Keuangan</h3>
            <div class="btn-group pull-right">

              <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">
                <i class="fa fa-plus"></i> &nbsp Tambah Kategori
              </button>
            </div>
          </div>
          <div class="box-body">

            <!-- Modal Tambah -->
            <div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="tambahKategoriModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form action="kategori.php" method="post">
                    <input type="hidden" name="action" value="add">
                    <div class="modal-header">
                      <h5 class="modal-title" id="tambahKategoriModalLabel">Tambah Kategori</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="kategori" required="required" class="form-control" placeholder="Nama Kategori ..">
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
                    <th>NAMA</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include '../koneksi.php';
                  $no = 1;
                  $data = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY kategori ASC");
                  while ($d = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['kategori']; ?></td>
                      <td>
                        <?php
                        if ($d['kategori_id'] != 1) {
                        ?>
                          <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_kategori_<?php echo $d['kategori_id'] ?>">
                            <i class="fa fa-cog"></i>
                          </button>

                          <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus_kategori_<?php echo $d['kategori_id'] ?>">
                            <i class="fa fa-trash"></i>
                          </button>
                        <?php
                        }
                        ?>
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
// Modals for Edit and Delete
$data = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY kategori ASC");
while ($d = mysqli_fetch_array($data)) {
  if ($d['kategori_id'] != 1) {
?>
    <!-- Modal Edit -->
    <div class="modal fade" id="edit_kategori_<?php echo $d['kategori_id'] ?>" tabindex="-1" aria-labelledby="editKategoriLabel_<?php echo $d['kategori_id'] ?>" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="kategori.php" method="post">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $d['kategori_id']; ?>">
            <div class="modal-header">
              <h5 class="modal-title" id="editKategoriLabel_<?php echo $d['kategori_id'] ?>">Edit Kategori</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group" style="width:100%">
                <label>Nama Kategori</label>
                <input type="text" name="kategori" required="required" class="form-control" placeholder="Nama Kategori .." value="<?php echo $d['kategori']; ?>" style="width:100%">
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

    <!-- Modal Hapus -->
    <div class="modal fade" id="hapus_kategori_<?php echo $d['kategori_id'] ?>" tabindex="-1" aria-labelledby="hapusKategoriLabel_<?php echo $d['kategori_id'] ?>" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="hapusKategoriLabel_<?php echo $d['kategori_id'] ?>">Peringatan!</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Yakin ingin menghapus data ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <a href="kategori.php?action=delete&id=<?php echo $d['kategori_id'] ?>" class="btn btn-primary">Hapus</a>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
?>
<?php include 'footer.php'; ?>