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
// Check if 'nama' is set in the session, if not, redirect to the login page
if (!isset($_SESSION['username'])) {
  header("Location:../sign/admin/sign_in.php");
  exit();
}

// Halaman pengelolaan peminjaman buku perpustakaan
require "../../../config.php";
$id = $_SESSION['id'];
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
WHERE user.id = '$id' order by peminjaman.status asc");


// Notifikasi

$statusArray = [1];
$statusString = implode(',', $statusArray);  // Mengubah array menjadi string terpisah koma
$sekarang  = date("Y-m-d");
$a = 0;
$query  = "SELECT count(peminjaman.id) AS notif,
peminjaman.tgl_kembali AS tgl_kembali,
peminjaman.status AS status
FROM peminjaman 
INNER JOIN user ON peminjaman.id_user = user.id
WHERE tgl_kembali < '$sekarang' and  peminjaman.id_user = '$id' and status IN ($statusString)";
$sql    = mysqli_query($connection, $query);
if (mysqli_num_rows($sql) > 0) {
  $data = mysqli_fetch_assoc($sql);
  $a  = $data['notif'];
}
if (isset($_POST["search"])) {
  $peminjaman = searchPinjamPetugas($_POST["keyword"]);
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
          <h5 class="card-header" >Data Buku Terpinjam
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="float:right;" ><i class="ti ti-bell-ringing"></i> Notifikasi <b class="badge badge-light" style=""><?= number_format($a); ?></b></button>
          </h5>
          <div class="table-responsive">
            <table class="table table-light">
              <thead>
                <tr class="text-center" style="vertical-align: middle;">
                  <th>Cover</th>
                  <th>Judul Buku</th>
                  <th>NISN</th>
                  <th>Nama Peminjam</th>
                  <th>Nama Petugas</th>
                  <th>Tgl. Pinjam</th>
                  <th>Tgl. Selesai</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1; // Nomor urut dimulai dari 1
                if (isset($peminjaman) && is_array($peminjaman) && count($peminjaman) > 0) {
                  foreach ($peminjaman as $item) :
                ?>
                    <tr class="text-center" style="vertical-align: middle;">
                      <td>
                        <img src="../../../assets/imgDB/<?= $item['cover']; ?>" alt="" width="70px" height="100px" style="border-radius: 5px;">
                      </td>
                      <td><?= $item["judul"]; ?></td>
                      <td><?= $item["nisn"]; ?></td>
                      <td><?= $item["nama"]; ?></td>
                      <td><?= $item["username"]; ?></td>
                      <td><?= $item["tgl_pinjam"]; ?></td>
                      <td><?= $item["tgl_kembali"]; ?></td>
                      <td><?php
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
                          } else  { 
                            $statusText = 'Telah Dinonaktifkan';
                            $statusClass = 'text-secondary';
                          }
                          ?>
                        <span class="<?php echo $statusClass; ?>"><?php echo $statusText; ?></span>
                      </td>
                      <td>
                        <a title="status" class="btn btn-info" href="validate.php?id=<?php echo $item['peminjaman_id']; ?>">
                          <i class="ti ti-article"></i>
                        </a>

                      </td>
                    </tr>
                <?php endforeach;
                } else {
                  echo '<tr><td colspan="10">Tidak ada data peminjaman.</td></tr>';
                } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal" id="myModal">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenterTitle">Notifikasi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <?php
              $statusArray = [1];
              $statusString = implode(',', $statusArray);  // Mengubah array menjadi string terpisah koma
              $sekarang  = date("Y-m-d");
              $query  = mysqli_query($connection, "SELECT peminjaman.id AS peminjaman_id,
             peminjaman.tgl_kembali AS tgl_kembali,
             peminjaman.status AS status
             FROM peminjaman
          INNER JOIN user ON peminjaman.id_user = user.id
          WHERE tgl_kembali < '$sekarang' AND peminjaman.id_user = '$id' AND status IN ($statusString) ORDER BY tgl_kembali");
              while ($data  = mysqli_fetch_array($query)) {
                $kembali  = new DateTime($data['tgl_kembali']);
                $lambat    = new DateTime($sekarang);
                $diff  = $lambat->diff($kembali);
              ?>
                <div class="alert alert-danger alert-dismissible">
                  <strong>Peringatan!</strong> Peminjaman ID <a title="Cek" class="alert-link" href="validate.php?id=<?= $data['peminjaman_id']; ?>"><?php echo $data['peminjaman_id']; ?></a> harus dinonaktifkan karena sudah melewati batas waktu selama <?php echo $diff->d . " hari " ?><?php echo $diff->m . " bulan " ?><?php echo $diff->y . " tahun." ?>
                </div>
                <?php
              }
          ?>
            </div>
         
          <div class="modal-footer">
            <a href="non_aktif.php"><span data-placement='top' data-toggle='tooltip' title='Nonaktifkan'><button class="btn btn-secondary">Nonaktifkan</button></span></a>&nbsp;
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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