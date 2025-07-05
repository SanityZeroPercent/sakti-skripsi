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

  // Handle ADD user
  if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $level = $_POST['level'];

    $foto = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['name'] != "") {
      $foto = $_FILES['foto']['name'];
      $tmp = $_FILES['foto']['tmp_name'];
      $path = "../gambar/user/" . $foto;

      if (move_uploaded_file($tmp, $path)) {
        // File uploaded successfully
      } else {
        $foto = ""; // Reset if upload failed
      }
    }

    mysqli_query($koneksi, "INSERT INTO user VALUES (NULL,'$nama','$username','$password','$level','$foto')");
    header("location:user.php?status=added");
    exit();
  }

  // Handle UPDATE user
  if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $level = $_POST['level'];

    // Handle password update (only if provided)
    $password_query = "";
    if (!empty($_POST['password'])) {
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
      $password_query = ", user_password='$password'";
    }

    // Handle photo update
    $foto_query = "";
    if (isset($_FILES['foto']) && $_FILES['foto']['name'] != "") {
      $foto = $_FILES['foto']['name'];
      $tmp = $_FILES['foto']['tmp_name'];
      $path = "../gambar/user/" . $foto;

      if (move_uploaded_file($tmp, $path)) {
        $foto_query = ", user_foto='$foto'";
      }
    }

    // Build the complete query with proper field ordering
    $query = "UPDATE user SET user_nama='$nama', user_username='$username', user_level='$level'";
    $query .= $password_query;
    $query .= $foto_query;
    $query .= " WHERE user_id='$id'";

    mysqli_query($koneksi, $query);
    header("location:user.php?status=updated");
    exit();
  }
}

include 'header.php'; ?>
<!-- Body: Titel Header -->
<div class="body-header border-bottom d-flex py-3">
  <div class="container-xxl">
    <div class="row align-items-center g-2">
      <div class="col">
        <!-- Pretitle -->
        <h1 class="h4 mt-1">Kelola Pengguna</h1>
      </div>
      <div class="col-12 col-md-6 text-md-end">
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
          <i class="fa fa-plus"></i> Tambah Pengguna Baru
        </button>
      </div>
    </div> <!-- Row end  -->
  </div>
</div>

<!-- Body: Body -->
<div class="body d-flex py-3">
  <div class="container-xxl">

    <!-- Modal Tambah User -->
    <div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="user.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTambahUserLabel">Tambah Pengguna Baru</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="form-group mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama ..">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" required="required" placeholder="Masukkan Username ..">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required="required" minlength="5" placeholder="Masukkan Password ..">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Level</label>
                <select class="form-control" name="level" required="required">
                  <option value=""> - Pilih Level - </option>
                  <option value="administrator"> Administrator </option>
                  <option value="manajemen"> Manajemen </option>
                </select>
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Foto</label>
                <input type="file" class="form-control" name="foto" accept="image/*">
                <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB.</small>
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

    <table id="table-datatable" class="table table-hover align-middle mb-0" style="width: 100%;">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nama Pengguna</th>
          <th>ID Pengguna</th>
          <th>Level Akses</th>
          <th>Foto</th>
          <th>Opsi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include '../koneksi.php';
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM user");
        while ($d = mysqli_fetch_array($data)) {
        ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['user_nama']; ?></td>
            <td><?php echo $d['user_username']; ?></td>
            <td><?php echo $d['user_level']; ?></td>
            <td>
              <center>
                <?php if ($d['user_foto'] == "") { ?>
                  <img src="../gambar/sistem/user.png" style="width: 80px;height: auto">
                <?php } else { ?>
                  <img src="../gambar/user/<?php echo $d['user_foto'] ?>" style="width: 80px;height: auto">
                <?php } ?>
              </center>
            </td>
            <td>
              <?php if ($d['user_id'] == $_SESSION['id']) { ?>
                <a class="btn btn-warning btn-sm" href="profile.php"><i class="fa fa-cog"></i></a>
              <?php } ?>
              <?php if ($d['user_id'] != $_SESSION['id']) { ?>
                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit_user_<?php echo $d['user_id'] ?>">
                  <i class="fa fa-cog"></i>
                </button>
                <a class="btn btn-danger btn-sm" href="user_hapus.php?id=<?php echo $d['user_id'] ?>"><i class="fa fa-trash"></i></a>
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

<?php
// Generate Modals for Edit
$data = mysqli_query($koneksi, "SELECT * FROM user");
while ($d = mysqli_fetch_array($data)) {
  if ($d['user_id'] != $_SESSION['id']) { // Only show edit modal for other users
?>
    <!-- Modal Edit User -->
    <div class="modal fade" id="edit_user_<?php echo $d['user_id'] ?>" tabindex="-1" aria-labelledby="editUserLabel_<?php echo $d['user_id'] ?>" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="user.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $d['user_id']; ?>">
            <div class="modal-header">
              <h5 class="modal-title" id="editUserLabel_<?php echo $d['user_id'] ?>">Edit Pengguna</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="form-group mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $d['user_nama'] ?>" required="required">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" value="<?php echo $d['user_username'] ?>" required="required">
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" minlength="5" placeholder="Kosong jika tidak ingin diganti">
                <small class="form-text text-muted">Kosong jika tidak ingin diganti</small>
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Level</label>
                <select class="form-control" name="level" required="required">
                  <option value=""> - Pilih Level - </option>
                  <option <?php if ($d['user_level'] == "administrator") {
                            echo "selected='selected'";
                          } ?> value="administrator"> Administrator </option>
                  <option <?php if ($d['user_level'] == "manajemen") {
                            echo "selected='selected'";
                          } ?> value="manajemen"> Manajemen </option>
                </select>
              </div>
              <div class="form-group mb-3">
                <label class="form-label">Foto</label>
                <input type="file" class="form-control" name="foto" accept="image/*">
                <small class="form-text text-muted">Kosong jika tidak ingin diganti. Format: JPG, PNG, GIF.</small>
                <?php if ($d['user_foto'] != "") { ?>
                  <div class="mt-2">
                    <small>Foto saat ini:</small><br>
                    <img src="../gambar/user/<?php echo $d['user_foto'] ?>" style="width: 100px; height: auto;" class="img-thumbnail">
                  </div>
                <?php } ?>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php
  }
}
?>

<?php include 'footer.php'; ?>