<?php
// memanggil file connection.php untuk membuat connection
include '../../../config.php';

// mengecek apakah di url ada nilai GET id
if (isset($_GET['id'])) {
  // ambil nilai id dari url dan disimpan dalam variabel $id
  $id = ($_GET["id"]);

  // menampilkan data dari database yang mempunyai id=$id
  $query = "SELECT * FROM peminjaman
  INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
  WHERE peminjaman.id='$id'";
  $result = mysqli_query($connection, $query);

  // jika data gagal diambil maka akan tampil error berikut
  if (!$result) {
    die("Query Error: " . mysqli_errno($connection) .
      " - " . mysqli_error($connection));
  }
  // mengambil data dari database
  $item = mysqli_fetch_assoc($result);
  // apabila data tidak ada pada database maka akan dijalankan perintah ini
  if (!$item) {
    echo "<script>alert('Data tidak ditemukan pada database');window.location='peminjamanBuku.php';</script>";
  }
} else {
  // apabila tidak ada data GET id pada akan di redirect ke index.php
  echo "<script>alert('Masukkan data id.');window.location='peminjamanBuku.php';</script>";
}
if (isset($_SESSION['sebagai'])) {
  if ($_SESSION['sebagai'] == 'petugas') {
    header("Location: petugas/index.php");
    exit;
  } elseif ($_SESSION['sebagai'] == 'admin') {
    header("Location: admin/index.php");
    exit;
  }
}
$peminjaman = queryReadData("SELECT peminjaman.id AS peminjaman_id,
    buku.cover AS cover,
    buku.id_buku AS id_buku, 
    buku.judul AS judul,
    member.nisn AS nisn, 
    member.nama AS nama, 
    user.username AS username,
    peminjaman.tgl_pinjam AS tgl_pinjam,
    peminjaman.tgl_kembali AS tgl_kembali,
    peminjaman.status AS status
    FROM peminjaman
    INNER JOIN buku ON peminjaman.id_buku = buku.id_buku
    INNER JOIN member ON peminjaman.nisn = member.nisn
    INNER JOIN user ON peminjaman.id_user = user.id
    WHERE peminjaman.id='$id'");
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
              <a class="sidebar-link" href="../../petugas/index.php" aria-expanded="false">
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
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="../peminjaman/peminjamanBuku.php" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Peminjaman</span>
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
                <div class="text-center">
                  <td><img src="../../../assets/imgDB/<?= $item['cover']; ?>" alt="" width="160px" style="border-radius: 5px;"></td>
                </div>
                <h6 class="m-2 font-weight-bold text-center text-primary">
                  <?php echo $item['judul']; ?>
                </h6>
              </div>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="card shadow">
              <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Detail Peminjaman Buku - <?php echo $item['judul']; ?></h6>
              </div>
              <?php foreach ($peminjaman as $item) : ?>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <table class="table table-borderless">
                      <tr>
                        <td>Id Buku</td>
                        <td>:</td>
                        <td><b><?php echo $item['id_buku']; ?></b></td>
                      </tr>
                      <tr>
                        <td>Nisn</td>
                        <td>:</td>
                        <td><b><?php echo $item['nisn']; ?></b></td>
                      </tr>
                      <tr>
                        <td>Tanggal Pinjam</td>
                        <td>:</td>
                        <td><b><?php echo $item['tgl_pinjam']; ?></b></td>
                      </tr>
                      <tr>
                        <td>Tanggal Berakhir </td>
                        <td>:</td>
                        <td><b><?php echo $item['tgl_kembali']; ?></b></td>
                      </tr>
                      <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>
                                                <?php
                                                $statusClass = '';
                                                if ($item['status'] == 0) {
                                                    $statusText = 'Menunggu Persetujuan';
                                                    $statusClass = 'text-warning';
                                                } elseif ($item['status'] == 1) {
                                                    $statusText = 'Telah Disetujui';
                                                    $statusClass = 'text-primary';
                                                } elseif ($item['status'] == 2) {
                                                    $statusText = 'Tidak Disetujui';
                                                    $statusClass = 'text-danger';
                                                } else {
                                                    $statusText = 'Telah Dinonaktifkan';
                                                    $statusClass = 'text-secondary';
                                                }
                                                ?>
                                                <span class="<?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                                            </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                  <?php
                                    if ($item['status'] == 0) { 
                                    ?>
                                      <a href="setuju.php?id=<?= $item['peminjaman_id']; ?>"><span data-placement='top' data-toggle='tooltip' title='Setuju'><button class="btn btn-success">Setuju</button></span></a>&nbsp;
                                        <a href="tidaksetuju.php?id=<?= $item['peminjaman_id']; ?>"><span data-placement='top' data-toggle='tooltip' title='Tidak Setuju'><button class="btn btn-danger">Tidak Setuju</button></span></a>&nbsp;
                                    <a title="kembali" class="btn btn-secondary" href="peminjamanBuku.php">Kembali</a>
                                    <?php
                                    }else {
                                    ?>
                                      
                                        <a title="kembali" class="btn btn-secondary" href="peminjamanBuku.php">Kembali</a>
                                    <?php
                                    }
                                    ?>
                  </div>
                </div>
              </div>
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