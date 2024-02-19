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
require "../../../config.php";

$member = queryReadData("SELECT * FROM member order by nama asc");

if (isset($_POST["search"])) {
  $member = searchMember($_POST["keyword"]);
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
                  <input class="form-control me-2" type="search" name="keyword" id="keyword" placeholder="Cari nisn atau nama..." aria-label="Search">
                  <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                </div>
              </form>
            </div>
          </div>

          <div class="card mt-3">
            <h5 class="card-header">List Member</h5>
            <div class="table-responsive">
              <table class="table table-light">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nisn</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Alamat</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                  <?php
                  $no = 1;
                  foreach ($member as $item) : 
                  $nisn = $item['nisn'];?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $item["nisn"]; ?></td>
                      <td><?= $item["nama"]; ?></td>
                      <td><?= $item["kelas"]; ?></td>
                      <td><?= $item["jurusan"]; ?></td>
                      <td><?= $item["alamat"]; ?></td>
                      <td>
                        <div class="action">
                          <div>
                        <button type="button" class="btn btn-warning" style="width: 80px;" data-bs-toggle="modal" data-bs-target="#edit<?= $nisn; ?>">
                            Edit
                          </button>
                          </div>
                          <div>
                          <a href="deleteMember.php?id=<?= $item["nisn"]; ?>" class="btn btn-danger mt-1" style="width: 80px;" onclick="return confirm('Yakin ingin menghapus data member ?');">Hapus </a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <!-- The Modal -->
                    <div class="modal fade" id="edit<?= $nisn; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <form method="post">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Member - <?= $item['nama']; ?></h4>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">

                                <label for="nisn">NISN</label>
                                <input type="text" id="nisn" name="nisn" class="form-control" value="<?= $item['nisn']; ?>">

                                <label for="nama">Nama</label>
                                <input type="text" id="nama" name="nama" class="form-control" value="<?= $item['nama'] ?>" ;>

                                <label for="password">Password</label>
                                <input type="text" id="password" name="password" class="form-control" value="<?= $item['password']; ?>">

                                <label>Kelas</label>
                                <select name="kelas" class="form-control">
                                  <option class="hidden" selected disabled>Pilih Kelas</option>
                                  <option value="X">X</option>
                                  <option value="XI">XI</option>
                                  <option value="XII">XII</option>
                                </select>

                                <label>Jurusan</label>
                                <select name="jurusan" class="form-control">
                                  <option class="hidden" selected disabled>Pilih Jurusan</option>
                                  <option value="Otomatisasi dan Tata Kelola Perkantoran">Otomatisasi dan Tata Kelola Perkantoran</option>
                                  <option value="Akuntansi dan Keuangan Lembaga">Akuntansi dan Keuangan Lembaga</option>
                                  <option value="Bisnis Daring dan Pemasaran">Bisnis Daring dan Pemasaran</option>
                                  <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                  <option value="Multimedia">Multimedia</option>
                                </select>

                                <label for="alamat">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-control" value="<?= $item['alamat']; ?>">

                                <input type="hidden" name="nisn" value="<?= $nisn; ?>">

                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                              <a href="member.php" class="btn btn-sm btn-danger"><i class="fa fa-reply"></i> Kembali</a>
                                <button type="submit" class="btn btn-sm btn-primary" name="update"><i class="fa fa-plus mr-2"></i>Save</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      
                  <?php endforeach; ?>
                  <?php
                  // Edit
                  if (isset($_POST['update'])) {
                    $nisn = $_POST['nisn'];
                    $nama = $_POST['nama'];
                    $password = $_POST['password'];
                    $kelas = $_POST['kelas'];
                    $jurusan = $_POST['jurusan'];
                    $alamat = $_POST['alamat'];

                    $updatedata = mysqli_query($connection, "update member set nama='$nama', password='$password', kelas='$kelas', jurusan='$jurusan', alamat='$alamat' where nisn='$nisn'");

                    //cek apakah berhasil
                    if ($updatedata) {

                      echo " <div class='alert alert-success'>
                            <strong>Success!</strong> Redirecting you back in 1 seconds.
                          </div>
                        <meta http-equiv='refresh' content='1; url= member.php'/>  ";
                    } else {
                      echo "<div class='alert alert-warning'>
                            <strong>Failed!</strong> Redirecting you back in 1 seconds.
                          </div>
                         <meta http-equiv='refresh' content='1; url= member.php'/> ";
                    }
                  };
                  ?>
                </tbody>
              </table>
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