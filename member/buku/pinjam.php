<?php
// Start the session
session_start();

// Check if 'nama' is set in the session, if not, redirect to the login page
if (!isset($_SESSION['nama'])) {
    header("Location:../../sign/member/sign_in.php");
    exit();
}

if (!isset($_SESSION['nisn'])) {
    header("Location: ../../sign/member/sign_in.php");
    exit();
}

require "../../config.php";
// Tangkap id buku dari URL (GET)
$idBuku = $_GET["id"];
$query = queryReadData("SELECT * FROM buku WHERE id_buku = '$idBuku'");
//Menampilkan data siswa yg sedang login
$nisnSiswa = $_SESSION['nisn'];
$dataSiswa = queryReadData("SELECT * FROM member WHERE nisn = $nisnSiswa");
$admin = queryReadData("SELECT * FROM user where sebagai='petugas'");

// Peminjaman 
if (isset($_POST["pinjam"])) {

    if (pinjamBuku($_POST) > 0) {
        echo "<script>
    alert('Buku berhasil dipinjam');
    window.location.href = 'daftarPinjam.php';
    </script>";
    } else {
        echo "<script>
    alert('Buku gagal dipinjam!');
    </script>";
    }
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="https://kit.fontawesome.com/de8de52639.js" crossorigin="anonymous"></script>
    <title>Transaksi peminjaman Buku || Member</title>
</head>
<style>
    body {
        background: url('../../assets/images/ppp.jpg') no-repeat center center fixed;
        background-size: cover;
    }
</style>

<body>
    <nav class="navbar">
        <div class="container">

            <div class="navbar-header">
                <button class="navbar-toggler" data-toggle="open-navbar1">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <img src="../../assets/images/Madya_Perpus-removebg-preview.png" style="width: 100px; height: 50px;">
                </a>
            </div>

            <div class="navbar-menu" id="open-navbar1">
                <ul class="navbar-nav">
                    <li><a href="../index.php">Dashboard</a></li>
                    <li><a href="daftarBuku.php">Daftar Buku </a></li>
                    <li><a href="historyBuku.php">History</a></li>
                    <li><a href="../logout.php">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container-xxl p-5 my-5">
        <div class="">
            <div class="alert alert-dark" role="alert">Form Peminjaman Buku</div>
            <!-- Default box -->
            <div class="card mb-auto">
                <h5 class="card-header">Data lengkap Buku</h5>
                <div class="card-body d-flex">

                    <?php foreach ($query as $item) : ?>
                        <div class="row">
                            <div class="col-md-3">
                                <img src="../../assets/imgDB/<?= $item["cover"]; ?>" class="img-fluid rounded" alt="Book Cover">
                            </div>
                            <div class="col-md-9">
                                <form action="" method="post">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="id_buku" class="form-label">Id Buku</label>
                                            <input type="text" class="form-control" id="id_buku" value="<?= $item["id_buku"]; ?>" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="kategori" class="form-label">Kategori</label>
                                            <input type="text" class="form-control" id="kategori" value="<?= $item["kategori"]; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="judul" class="form-label">Judul</label>
                                        <input type="text" class="form-control" id="judul" value="<?= $item["judul"]; ?>" readonly>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="pengarang" class="form-label">Pengarang</label>
                                            <input type="text" class="form-control" id="pengarang" value="<?= $item["pengarang"]; ?>" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="penerbit" class="form-label">Penerbit</label>
                                            <input type="text" class="form-control" id="penerbit" value="<?= $item["penerbit"]; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="thn_terbit" class="form-label">Tahun Terbit</label>
                                            <input type="date" class="form-control" id="thn_terbit" value="<?= $item["thn_terbit"]; ?>" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="jml_halaman" class="form-label">Jumlah Halaman</label>
                                            <input type="number" class="form-control" id="jml_halaman" value="<?= $item["jml_halaman"]; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi Buku</label>
                                        <textarea class="form-control" id="deskripsi" rows="3" readonly><?= $item["deskripsi"]; ?></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>


                <div class="card mt-4">
                    <h5 class="card-header text-center">Data lengkap Siswa</h5>
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center flex-wrap">
                            <img src="../../assets/images/memberLogo.png" width="150px" class="me-md-4 mb-3 mb-md-0" alt="Member Logo">
                            <form action="" method="post" class="w-100">
                                <?php foreach ($dataSiswa as $item) : ?>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text">NISN</span>
                                                <input type="number" class="form-control" value="<?= $item["nisn"]; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text">Nama</span>
                                                <input type="text" class="form-control" value="<?= $item["nama"]; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text">Kelas</span>
                                                <input type="text" class="form-control" value="<?= $item["kelas"]; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text">Jurusan</span>
                                                <input type="text" class="form-control" value="<?= $item["jurusan"]; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="input-group">
                                                <span class="input-group-text">Alamat</span>
                                                <input type="text" class="form-control" value="<?= $item["alamat"]; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="alert alert-danger mt-4" role="alert">Silahkan periksa kembali data diatas, pastikan sudah benar sebelum meminjam buku! jika ada kesalahan data harap hubungi petugas.</div>

                <div class="card mt-4">
                    <h5 class="card-header">Form Pinjam Buku</h5>
                    <div class="card-body">
                        <form action="" method="post">
                            <!--Ambil data id buku-->
                            <?php foreach ($query as $item) : ?>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Id Buku</span>
                                    <input type="text" name="id_buku" class="form-control" placeholder="id buku" aria-label="id_buku" aria-describedby="basic-addon1" value="<?= $item["id_buku"]; ?>" readonly>
                                </div>
                            <?php endforeach; ?>
                            <!-- Ambil data NISN user yang login-->
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Nisn</span>
                                <input type="number" name="nisn" class="form-control" placeholder="nisn" aria-label="nisn" aria-describedby="basic-addon1" value="<?php echo htmlentities($_SESSION["nisn"]); ?>" readonly>
                            </div>
                            <!--Ambil data id admin-->
                            <select name="id_user" class="form-select" aria-label="Default select example">
                                <option selected>Pilih id Petugas</option>
                                <?php foreach ($admin as $item) : ?>
                                    <option value="<?= $item["id"]; ?>"><?= $item["username"]; ?></option>
                                <?php endforeach;
                                $sekarang    = date("Y-m-d");
                                ?>
                            </select>
                            <div class="input-group mb-3 mt-3">
                                <span class="input-group">Tanggal pinjam</span>
                                <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" value="<?= $sekarang; ?>" placeholder="tgl_pinjam" aria-label="tgl_pinjam" required>
                            </div>
                            <div class="input-group mb-3 mt-3">
                                <span class="input-group">Tanggal akhir peminjaman</span>
                                <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" placeholder="tgl_kembali" aria-label="tgl_kembali" required>
                            </div>
                            <!--<input type="hidden"  id="tgl_pinjam" name="tgl_pinjam">
      <input type="hidden" id="tgl_kembali" name="tgl_kembali"> onclick="convert()" -->

                            <a class="btn btn-danger" href="dashboard.php"> Batal</a>
                            <button type="submit" class="btn btn-success" name="pinjam">Pinjam</button>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.card -->
        </div>
    </div>
    </div>
    <!--<script>
function convert() {
            // Input date in "Y-m-d" format
            var date1 = document.getElementById("date1").value;
            var date2 = document.getElementById("date2").value;

            // Convert "Y-m-d" to "Ymd" using replace() method with regular expression
            var convertedDate1 = date1.replace(/-/g, '');
            var convertedDate2 = date2.replace(/-/g, '');

            // Display the converted date in input text fields
            document.getElementById("tgl_pinjam").value = convertedDate1;
            document.getElementById("tgl_kembali").value = convertedDate2;
        }
</script>-->
    <!--JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>