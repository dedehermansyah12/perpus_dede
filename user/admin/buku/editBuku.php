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
$id = $_GET ['id_buku'];
$kategori = queryReadData("SELECT * FROM kategori_buku");
$databuku = queryReadData("SELECT * FROM buku where id_buku = '$id' ");

if (isset($_POST["edit"])) {

    if (updateBuku($_POST) > 0) {
        echo "<script>alert('Data berhasil diubah.');window.location='daftarBuku.php';</script>";
    } else {
        echo "<script>
        alert('Data buku gagal diubah!');
        </script>";
    }
}


//search buku
if (isset($_POST["search"])) {
    $databuku = search($_POST["keyword"]);
}
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
          <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mt-2">Edit Buku</h2>
                        <!-- Button to Open the Modal -->
                    </div>
                    <?php foreach ($databuku as $item) : ?>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data" class="mt-3 p-2">

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="custom-css-form">
                                        <div class="mb-3">
                                            <input type="hidden" name="coverLama" value="<?= $item["cover"]; ?>">
                                            <img src="../../../assets/imgDB/<?= $item["cover"]; ?>" width="84px" height="110px">
                                            <label for="formFileMultiple" class="form-label">Cover Buku</label>
                                            <input class="form-control" type="file" name="cover" id="formFileMultiple">
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Id Buku</label>
                                            <input type="text" class="form-control" name="id_buku" id="id_buku" value="<?= $item['id_buku']; ?>" readonly style="background-color: #f0f0f0;">
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                                        <select class="form-select" id="kategori" name="kategori" value="">
                                            <option selected><?= $item["kategori"]; ?></option>
                                            <?php foreach ($kategori as $p) : ?>
                                                <option value="<?= $p['kategori']; ?>"><?= $p["kategori"]; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Judul Buku</label>
                                        <input type="text" class="form-control" name="judul" id="judul" value="<?= $item['judul']; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Pengarang</label>
                                        <input type="text" class="form-control" name="pengarang" id="pengarang" value="<?= $item['pengarang']; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Penerbit</label>
                                        <input type="text" class="form-control" name="penerbit" id="penerbit" value="<?= $item['penerbit']; ?>">
                                    </div>

                                    <label for="validationCustom01" class="form-label">Tahun Terbit</label>
                                    <div class="input-group mt-0">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-calendar-days"></i></span>
                                        <input type="date" class="form-control" name="thn_terbit" id="thn_terbit" value="<?= $item['thn_terbit']; ?>">
                                    </div>

                                    <label for="validationCustom01" class="form-label">Jumlah Halaman</label>
                                    <div class="input-group mt-0">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-book-open"></i></span>
                                        <input type="number" class="form-control" name="jml_halaman" id="jml_halaman" value="<?= $item['jml_halaman']; ?>">
                                    </div>

                                    <div class="form-floating mt-3 mb-3">
                                        <textarea class="form-control" placeholder="sinopsis tentang buku ini" name="deskripsi" id="deskripsi" style="height: 100px"><?= $item['deskripsi']; ?></textarea>
                                        <label for="floatingTextarea2">Deskripsi</label>
                                    </div>

                                    <div class="custom-css-form">
                                    <a href="daftarBuku.php" class="btn btn-warning"></i> Kembali</a>
                                        <button class="btn btn-success" type="submit" name="edit">Edit</button>
                                        <input type="reset" class="btn btn-danger text-light" value="Reset">
                                    </div>
                            </form>
                        <?php endforeach; ?>

                        </div>
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
</body>

</html>