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
$buku = queryReadData("SELECT * FROM buku order by id_buku desc");
$kategori = queryReadData("SELECT * FROM kategori_buku");
$query = mysqli_query($connection, "SELECT max(id_buku) as kodeTerbesar FROM buku");
$dataid = mysqli_fetch_array($query);
$kodebuku = $dataid['kodeTerbesar'];
$urutan = (int) substr($kodebuku, -4, 4);
$urutan++;
$huruf = "KB";
$kodebuku = $huruf . sprintf("%04s",$urutan);
// mengaktifkan tombol search engine
if (isset($_POST["search"])) {
  //buat variabel dan ambil apa saja yg diketikkan user di dalam input dan kirimkan ke function search.
  $buku = search($_POST["keyword"]);
}
if (isset($_POST["tambah"])) {

  if (tambahBuku($_POST) > 0) {
    echo "<script>alert('Data berhasil ditambah.');window.location='daftarBuku.php';</script>";
  } else {
    echo "<script>
      alert('Data buku gagal ditambahkan!');
      </script>";
    }
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
          <div class="row">
            <div class="col-md-6 offset-md-6 mt-4">
              <form action="" method="post" class="d-flex">
                <div class="input-group">
                  <input class="form-control me-2" type="search" name="keyword" id="keyword" placeholder="Cari Judul atau Kategori..." aria-label="Search">
                  <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                </div>
              </form>
            </div>
          </div>
          <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#myModal">
            Tambah Buku
          </button>
          <div class="card mt-2">
            <h5 class="card-header">List Buku</h5>
            <div class="table-responsive">
              <table class="table table-light">
                <thead>
                  <tr class="text-center" style="vertical-align: middle;">
                    <th>No</th>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                  <?php
                  $no = 1;
                  foreach ($buku as $item) : ?>
                    <tr class="text-center" style="vertical-align: middle;">
                      <td><?= $no++; ?></td>
                      <td><img src="../../../assets/imgDB/<?= $item['cover']; ?>" alt="" width="70px" height="100px" style="border-radius: 5px;"></td>
                      <td><?= $item["judul"]; ?></td>
                      <td><?= $item["kategori"]; ?></td>
                      <td><?= $item["pengarang"]; ?></td>
                      <td><?= $item["penerbit"]; ?></td>
                      <td>
    <div>
        <a title="detail" class="btn btn-success" style="width: 80px;" href="detailBuku.php?id_buku=<?= $item['id_buku']; ?>"> Detail</a>
    </div>
    <div>
    <a href="editBuku.php?id_buku=<?= $item['id_buku'];?>" class="btn btn-warning mt-1" style="width: 80px;">Edit</a>
    </div>
    <div>
        <a href="deleteBuku.php?id_buku=<?= $item["id_buku"]; ?>" class="btn btn-danger mt-1" style="width: 80px;" onclick="return confirm('Yakin ingin menghapus data Buku ?');"> Hapus</a>
    </div>
</td>

                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
        <div class="modal" id="myModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Form Tambah Buku</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                  <div class="custom-css-form">
                    <div class="mb-3">
                      <label for="formFileMultiple" class="form-label">Cover Buku</label>
                      <input class="form-control" type="file" name="cover" id="cover" required>
                    </div>

                    <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Id Buku</label>
                      <input type="text" class="form-control" name="id_buku" id="id_buku" placeholder="example inf01" value="<?=$kodebuku;?>" readonly style="background-color: #f0f0f0;">
                    </div>
                  </div>

                  <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori">
                      <option selected>Choose</option>
                      <?php foreach ($kategori as $item) : ?>
                        <option><?= $item["kategori"]; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-book"></i></span>
                    <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Buku" aria-label="Username" aria-describedby="basic-addon1" required>
                  </div>

                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Pengarang</label>
                    <input type="text" class="form-control" name="pengarang" id="pengarang" placeholder="nama pengarang" required>
                  </div>

                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" name="penerbit" id="penerbit" placeholder="nama penerbit" required>
                  </div>

                  <label for="validationCustom01" class="form-label">Tahun Terbit</label>
                  <div class="input-group mt-0">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-calendar-days"></i></span>
                    <input type="date" class="form-control" name="thn_terbit" id="thn_terbit" required>
                  </div>

                  <label for="validationCustom01" class="form-label">Jumlah Halaman</label>
                  <div class="input-group mt-0">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-book-open"></i></span>
                    <input type="number" class="form-control" name="jml_halaman" id="jml_halaman" required>
                  </div>

                  <div class="form-floating mt-3 mb-3">
                    <textarea class="form-control" placeholder="sinopsis tentang buku ini" name="deskripsi" id="deskripsi" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Deskripsi</label>
                  </div>

                  <div class="custom-css-form">
                    <div class="mb-3">
                      <label for="formFileMultiple" class="form-label">Isi Buku</label>
                      <input class="form-control" type="file" name="isi_buku" id="isi_buku" required>
                    </div>


                    <button class="btn btn-success" type="submit" name="tambah">Tambah</button>
                    <input type="reset" class="btn btn-warning text-light" value="Reset">
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
</body>

</html>