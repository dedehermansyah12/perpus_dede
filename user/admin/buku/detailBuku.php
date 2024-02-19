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
// Tangkap id buku dari URL (GET)
$idBuku = $_GET["id_buku"];
$query = queryReadData("SELECT * FROM buku WHERE id_buku = '$idBuku'");

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboar Admin</title>
  <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/favicon.png" />
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
      <!-- End of Topbar -->

      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Content Row -->
        <div class="row">

        <div class="col-md-4">
            <div class="card card-success">
              <div class="card-header">
                <center>
                  <h6 class="m-0 font-weight-bold text-primary">Cover</h6>
                </center>
                <div class="card-tools"></div>
              </div>
              <div class="card-body">
              <?php
                $no = 1;
                foreach ($query as $item) :
                ?>
                <div class="text-center">
                  <td><img src="../../../assets/imgDB/<?= $item['cover']; ?>" alt="" width="160px" style="border-radius: 5px;"></td>
                </div>
                <h6 class="m-2 font-weight-bold text-center text-primary">
                  <?php echo $item['judul']; ?>
                </h6>
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="card card-info">
              <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Detail Buku</h6>

                <div class="card-tools">
                </div>
              </div>
              <div class="card-body">
               
                  <table class="table">
                    <tbody>
                      <tr>
                        <td style="width: 150px">
                          <b>ID Buku</b>
                        </td>
                        <td>:
                          <?php echo $item['id_buku']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 150px">
                          <b>Kategori</b>
                        </td>
                        <td>:
                          <?php echo $item['kategori']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 150px">
                          <b>Judul</b>
                        </td>
                        <td>:
                          <?php echo $item['judul']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 150px">
                          <b>Pengarang</b>
                        </td>
                        <td>:
                          <?php echo $item['pengarang']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 150px">
                          <b>Penerbit</b>
                        </td>
                        <td>:
                          <?php echo $item['penerbit']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 150px">
                          <b>Tahun Terbit</b>
                        </td>
                        <td>:
                          <?php echo $item['thn_terbit']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 150px">
                          <b>Jumlah Halaman</b>
                        </td>
                        <td>:
                          <?php echo $item['jml_halaman']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 150px">
                          <b>Deskripsi</b>
                        </td>
                        <td>:
                          <?php echo $item['deskripsi']; ?>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 150px">
                          <b>Isi Buku</b>
                        </td>
                        <td>:
                          <?php echo $item['isi_buku']; ?>
                        </td>
                      </tr>

                    </tbody>
                  </table>
                  <div>
                    <a class="btn btn-sm btn-secondary" href="daftarBuku.php"><i class="fa fa-reply"></i> Kembali</a>
                  </div>
              </div>
            </div>
          </div>

        

        <?php endforeach; ?>
        </div>

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <script src="../../../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../../assets/js/sidebarmenu.js"></script>
  <script src="../../../assets/js/app.min.js"></script>
  <script src="../../../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../../../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../../../assets/js/assets.js"></script>

  <!-- Main JS -->
  <script src="../../../assets/js/main.js"></script>
</body>

</html>