<?php
if (isset($_SESSION['sebagai'])) {
  if ($_SESSION['sebagai'] == 'petugas') {
    header("Location: petugas/index.php");
    exit;
  } elseif ($_SESSION['sebagai'] == 'admin') {
    header("Location: admin/index.php");
    exit;
  }
}
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: ../../../sign/admin/sign_in.php");
  exit();
}

include "../../../config.php";
if (isset($_POST["tambah"])) {

    if (tambahkategori($_POST) > 0) {
        echo "<script>
      alert('Data berhasil ditambahkan!');
      window.location='kategori.php';
      </script>";
    } else {
        echo "<script>
      alert('Data gagal ditambahkan!');
      window.location='kategori.php';
      </script>";
    }
}

$datakategori = queryReadData("SELECT * FROM kategori_buku");
//search Kategori
if (isset($_POST["search"])) {
    $datakategori = searchKategori($_POST["keyword"]);
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
              <a class="sidebar-link" href="../akun/user.php" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">Akun</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="kategori.php" aria-expanded="false">
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
    <!-- Row 1 -->
    <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 offset-md-6 mt-4">
              <form action="" method="post" class="d-flex">
                <div class="input-group">
                  <input class="form-control me-2" type="search" name="keyword" id="keyword" placeholder="Cari Kategori..." aria-label="Search">
                  <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                </div>
              </form>
            </div>
          </div>
    <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#myModal">
    Tambah Kategori
</button>
<div class="card mt-2">
    <h5 class="card-header">List Kategori</h5>
    <div class="table-responsive">
        <table class="table table-light">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                $no = 1;
                foreach ($datakategori as $item) :
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $item["kategori"]; ?></td>
                    <td>
                    <a href="deleteKategori.php?kategori=<?= $item['kategori']; ?>" class="btn btn-danger" onclick="return confirm('Apakah <?= $item['kategori']; ?> ingin anda hapus? Jika anda hapus maka data buku dengan kategori ini juga akan terhapus!');">Hapus</a>
        
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- The Modal -->
 <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" method="post" class="">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Form Tambah Kategori</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Kategori</label>
                            <input type="text" class="form-control" name="kategori" id="kategori" placeholder="kategori" required>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit" name="tambah">Tambah</button>
                        <input type="reset" class="btn btn-warning text-light" value="Reset">
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