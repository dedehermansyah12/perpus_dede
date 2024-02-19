<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: ../../../sign/admin/sign_in.php");
  exit();
}
require "../../../config.php";

$Admin = queryReadData("SELECT * FROM user order by id desc");

if (isset($_POST["search"])) {
  $Admin = searchAdmin($_POST["keyword"]);
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboar Admin</title>
  <link rel="shortcut icon" type="image/png" href="../../../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../../../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="../../../assets/images/Madya_Perpus-removebg-preview.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../../../user/admin/index.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">UI COMPONENTS</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../member/member.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>

                </span>
                <span class="hide-menu">Member</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../buku/daftarBuku.php" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Daftar Buku</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../peminjaman/peminjamanBuku.php" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Peminjaman</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="user.php" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">Akun</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../buku/kategori.php" aria-expanded="false">
                <span>
                  <i class="ti ti-notes"></i>
                </span>
                <span class="hide-menu">Kategori</span>
              </a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="../../../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">

                    <a class="dropdown-item text-center mb-2" href="#">Akun Terverifikasi <span class="text-primary"><i class="fa-solid fa-circle-check"></i></span></a>

                    <a href="../../../logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Sign Out</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->

        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 offset-md-6 mt-4">
              <form action="" method="post" class="d-flex">
                <div class="input-group">
                  <input class="form-control me-2" type="search" name="keyword" id="keyword" placeholder="Cari nama..." aria-label="Search">
                  <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                </div>
              </form>
            </div>
          </div>
          <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#myModal">
            Tambah Akun Baru
          </button>
          <div class="card mt-2">
            <h5 class="card-header">List Member</h5>
            <div class="table-responsive">
              <table class="table table-light">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Sebagai</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                  <?php
                  $no = 1;
                  foreach ($Admin as $item) :
                    $id = $item['id'];
                  ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $item["username"]; ?></td>
                      <td><?= $item["password"]; ?></td>
                      <td><?= $item["sebagai"]; ?></td>
                      <td>
                        <div>
                      <button type="button" class="btn btn-warning" style="width: 80px;" data-bs-toggle="modal" data-bs-target="#edit<?= $id; ?>">
                            Edit
                          </button>
                          </div>
                        <?php if ($item['username'] !== 'Betta') : ?>

                         <div>
                          <a href="deleteAdmin.php?id=<?= $item["id"]; ?>" class="btn btn-danger mt-1" style="width: 80px;" onclick="return confirm('Yakin ingin menghapus data admin ?');">Hapus</a>
                          </div>
                        <?php else : ?>
                          <!-- Additional condition if needed for 'welen' user -->
                          <span class="text-muted">Tidak dapat dihapus</span>
                        <?php endif; ?>
            </div>
            </td>
            </tr>
            <!-- The Modal -->
      <div class="modal fade" id="edit<?= $id; ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Edit Akun - <?= $item['username']; ?></h4>
              </div>

              <!-- Modal body -->
              <div class="modal-body">

                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" value="<?= $item['username']; ?>">

                <label for="password">Password</label>
                <input type="text" id="password" name="password" class="form-control" value="<?= $item['password']; ?>">

                <label>Sebagai</label>
                <select name="sebagai" class="form-control" required>
                  <option value="">Pilih Sebagai</option>
                  <option value="admin">admin</option>
                  <option value="petugas">petugas</option>
                </select>
                <input type="hidden" name="id" value="<?= $id; ?>">

              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
              <a href="../akun/user.php" class="btn btn-sm btn-danger"><i class="fa fa-reply"></i> Kembali</a>
                <button type="submit" class="btn btn-sm btn-primary" name="update"><i class="fa fa-plus mr-2"></i>Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>

          <?php endforeach; ?>
          <?php
          if (isset($_POST['user'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sebagai = $_POST['sebagai'];

            // Check if the username already exists
            $checkQuery = mysqli_query($connection, "SELECT * FROM user WHERE username = '$username'");
            if (mysqli_num_rows($checkQuery) > 0) {
              echo "<div class='alert alert-warning'>
                    <strong>Failed!</strong> Username already exists. Redirecting you back in 1 second.
                  </div>";
              echo "<meta http-equiv='refresh' content='1; url= user.php'/>";
              exit; // Stop further execution
            }

            // If the username is unique, proceed with the insert
            $insertQuery = mysqli_query($connection, "INSERT INTO user VALUES('', '$username', '$password', '$sebagai')");
            if ($insertQuery) {
              echo "<div class='alert alert-success'>
                    <strong>Success!</strong> Redirecting you back in 1 second.
                  </div>";
            }

            echo "<meta http-equiv='refresh' content='1; url= user.php'/>";
          }
          if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sebagai = $_POST['sebagai'];

            $updatedata = mysqli_query($connection, "update user set username='$username', password='$password', sebagai='$sebagai' where id='$id'");

            //cek apakah berhasil
            if ($updatedata) {

              echo " <div class='alert alert-success'>
                    <strong>Success!</strong> Redirecting you back in 1 seconds.
                  </div>
                <meta http-equiv='refresh' content='1; url= user.php'/>  ";
            } else {
              echo "<div class='alert alert-warning'>
                    <strong>Failed!</strong> Redirecting you back in 1 seconds.
                  </div>
                 <meta http-equiv='refresh' content='1; url= user.php'/> ";
            }
          };
          ?>

          </tbody>
          </table>
          </div>
        </div>
      </div>

      
      <!-- The Modal -->
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Akun Baru</h4>
            </div>
            <form method="POST">
              <div class="modal-body">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" id="username" required="required" placeholder="Username" autocomplete="off" class="form-control">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="text" name="password" id="password" required="required" placeholder="Password" autocomplete="off" class="form-control">
                </div>
                <div class="form-group">
                  <label>Sebagai</label>
                  <select name="sebagai" class="form-control" required>
                    <option value="">Pilih Sebagai</option>
                    <option value="admin">admin</option>
                    <option value="petugas">petugas</option>
                  </select>
                </div>
                <div class="form-group mt-2">
                  <button type="submit" class="btn btn-sm btn-primary" name="user"><i class="fa fa-plus"></i> Tambah</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
                  <a href="../akun/user.php" class="btn btn-sm btn-secondary"><i class="fa fa-reply"></i> Kembali</a>
                </div>
            </form>
          </div>
        </div>
      </div>

      <script src="../../../assets/libs/jquery/dist/jquery.min.js"></script>
      <script src="../../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script src="../../../assets/js/sidebarmenu.js"></script>
      <script src="../../../assets/js/app.min.js"></script>
      <script src="../../../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
      <script src="../../../assets/libs/simplebar/dist/simplebar.js"></script>
      <script src="../../../assets/js/assets.js"></script>

      <!-- Main JS -->
      <script src="../../../assets/js/main.js"></script>

</html>