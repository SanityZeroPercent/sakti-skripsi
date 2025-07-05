<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Check authentication
if (!isset($_SESSION['status']) || ($_SESSION['status'] != "administrator_logedin" && $_SESSION['status'] != "manajemen_logedin")) {
  header("location:../index.php?alert=belum_login");
  exit();
}

include '../koneksi.php';

// Get current user profile data for the $profil variable
$user_id = $_SESSION['id'];
$profil_query = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='$user_id'");
$profil = mysqli_fetch_array($profil_query);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Handle UPDATE user profile
  if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    // Don't change user level in profile - keep existing level
    $level = $profil['user_level'];

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

    // Update session variables
    $_SESSION['nama'] = $nama;

    header("location:profile.php?status=updated");
    exit();
  }
}

include 'header.php';
?>


<!-- Body: Body -->
<div class="body d-flex py-3">
  <div class="container-xxl">
    <div class="row align-items-center">
      <div class="border-0 mb-4">
        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
          <h3 class="fw-bold mb-0">User Profile</h3>
        </div>
      </div>
    </div> <!-- Row end  -->
    <div class="row g-3">
      <div class="col-xl-4 col-lg-5 col-md-12">
        <div class="card profile-card flex-column mb-3">
          <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
            <h6 class="mb-0 fw-bold ">Profile</h6>
          </div>
          <div class="card-body d-flex profile-fulldeatil flex-column">
            <div class="profile-user text-center w220 mx-auto">
              <?php
              if ($profil['user_foto'] == "") {
              ?>
                <img src="../gambar/sistem/user.png" class="avatar xl rounded img-thumbnail shadow-sm">
              <?php } else { ?>
                <img src="../gambar/user/<?php echo $profil['user_foto'] ?>" class="avatar xl rounded img-thumbnail shadow-sm">
              <?php } ?>
            </div>
            <div class="profile-info w-100">
              <h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center"> <?php echo $_SESSION['nama'] ?></h6>
              <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block"><?php echo $_SESSION['level'] ?></span>

            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-8 col-lg-7 col-md-12">
        <div class="card mb-3">
          <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
            <h6 class="mb-0 fw-bold ">Profile Settings</h6>
          </div>
          <div class="card-body">
            <form action="profile.php" method="post" enctype="multipart/form-data" class="row g-4">
              <input type="hidden" name="action" value="update">
              <?php
              $id = $_SESSION['id'];
              $data = mysqli_query($koneksi, "select * from user where user_id='$id'");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label">Nama Pengguna</label>
                    <input class="form-control" type="text" name="nama" value="<?php echo $d['user_nama'] ?>">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $d['user_id'] ?>" required="required">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label">ID Pengguna</label>
                    <input class="form-control" type="text" name="username" value="<?php echo $d['user_username'] ?>">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label">Password</label>
                    <input class="form-control" type="Password" name="password" min="5" placeholder="Kosong Jika tidak ingin di ganti">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label">Foto Profil</label>
                    <input type="file" class="form-control" name="foto" accept="image/*">
                  </div>
                </div>


                <div class="col-sm-6 col-md-6 col-lg-3">
                  <div class="form-group">
                    <label class="form-label">Level</label>
                    <select class="form-control" disabled>
                      <option <?php if ($d['user_level'] == "administrator") {
                                echo "selected='selected'";
                              } ?> value="administrator"> Administrator </option>
                      <option <?php if ($d['user_level'] == "manajemen") {
                                echo "selected='selected'";
                              } ?> value="manajemen"> Manajemen </option>
                    </select>
                  </div>
                </div>


                <div class="col-12 mt-4">
                  <input type="submit" class="btn btn-primary text-uppercase px-5" placeholder="Simpan" value="Simpan">
                </div>
              <?php
              }

              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>