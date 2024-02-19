<?php
// Start the session
session_start();

// Check if 'nama' is set in the session, if not, redirect to the login page
if (!isset($_SESSION['nama'])) {
  header("Location: ../../sign/member/sign_in.php");
  exit();
}

if (!isset($_SESSION['nisn'])) {
  header("Location: ../../sign/member/sign_in.php");
  exit();
}
require "../../config.php";
// query read semua buku
$buku = queryReadData("SELECT * FROM buku order by id_buku desc");
//search buku
if (isset($_POST["search"])) {
  $buku = search($_POST["keyword"]);
}

// Access the NIS from the session
$nis = $_SESSION['nisn'];

// Now you can use $nis wherever you need it
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../assets/fontawesome/css/stylehome.css">
  <title>Daftar Buku || Member</title>
</head>
  <style>
  body {
  width: 100%;
  height: 100%;
  background-image: linear-gradient(to right, #f6d365, #fda085);
}

  /* Add this to your CSS */
  .img-small {
    width: 50px;
    /* Adjust the width as needed */
    height: auto;
    /* Maintain aspect ratio */
  }

  .layout-card-custom {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1.5rem;
  }

  .arrivals {
    width: 100%;
    height: 100vh;
    margin-bottom: 35px;
  }

  .arrivals h1 {
    font-size: 50px;
    text-align: center;
    margin-bottom: 35px;
  }

  .arrivals .arrivals_box {
    width: 95%;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    grid-gap: 25px 0;
  }

  .arrivals .arrivals_box .arrivals_card {
    width: 210px;
    height: 400px;
    background-color: #fff;
    text-align: center;
    padding: 10px;
    border: 1px solid #000;
    margin: auto 20px;
      border-radius: 20px;
  }

  .arrivals .arrivals_box .arrivals_card:hover {
    box-shadow: 0 0 5px #3608a1;
  }

  .arrivals .arrivals_box .arrivals_card .arrivals_image {
    width: 150px;
    height: 220px;
    margin: 0 auto;
    cursor: pointer;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.5);
    overflow: hidden;
  }

  .arrivals .arrivals_box .arrivals_card .arrivals_image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: 0.3s;
  }

  .arrivals .arrivals_box .arrivals_card:hover .arrivals_image img {
    transform: scale(1.1);
  }

  .arrivals .arrivals_box .arrivals_card .arrivals_tag p {
    font-family: sans-serif;
    font-size: 15px;
    margin: 8px 0;
    word-wrap: break-word;
  }

  .arrivals .arrivals_box .arrivals_card .arrivals_tag .arrivals_icon {
    color: #3608a1;
    margin-bottom: 18px;
  }

  .arrivals .arrivals_box .arrivals_card .arrivals_tag .arrivals_btn {
    padding: 8px 20px;
    border: 2px solid #3608a1;
    text-decoration: none;
    color: #000;
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
          <li><a href="daftarPinjam.php">Daftar Pinjam </a></li>
          <li><a href="historyBuku.php">History</a></li>
          <li><a href="../logout.php">Log Out</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="row justify-content-center mt-2">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="max-width: 100%;">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../../assets/images/banner1.jpg" class="d-block w-100" alt="banner1.jpg">
        </div>
        <div class="carousel-item">
          <img src="../../assets/images/banner2.jpg" class="d-block w-100" alt="banner2.jpg">
        </div>
        <div class="carousel-item">
          <img src="../../assets/images/banner3.jpg" class="d-block w-100" alt="banner3.jpg">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>

  <div class="container-fluid">
    <form action="" method="post" class="mt-4 mx-auto d-block col-md-6">
      <div class="input-group">
        <input class="form-control me-2" type="search" name="keyword" id="keyword" placeholder="cari judul atau kategori..." aria-label="Search">
        <button class="btn btn-outline-success" type="submit" name="search">Search</button>
      </div>
    </form>
  </div>

  <!--Card buku-->
  <div class="arrivals mt-4">
    <div class="arrivals_box d-flex flex-wrap justify-content-center">
      <?php foreach ($buku as $item) : ?>
        <div class="arrivals_card d-flex flex-column justify-content-between">
    <div class="arrivals_image">
        <a href="sign/member/sign_in.php"><img src="../../assets/imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku" height="200px"></a>
    </div>
    <div class="arrivals_tag mt-3">
        <p class="text-center"><?= $item["judul"]; ?></p>
    </div>
    <div class="btn-group mt-auto" role="group" aria-label="Basic example" style="bottom: 10%;">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal<?= $item["id_buku"]; ?>">Detail</button>
    </div>
</div>

        <!-- Vertically centered modal -->
        <!-- The Modal -->
        <div class="modal" id="myModal<?= $item["id_buku"]; ?>">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Detail Buku</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <!-- Modal body -->
              <div class="modal-body d-flex justify-content-center align-items-center">
                <div class="card" style="width: 18rem;">
                  <img src="../../assets/imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="Mobil Image">
                  <div class="card-body  ">
                  </div>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Judul:</strong> <?= $item['judul']; ?></li>
                    <li class="list-group-item"><strong>Deskripsi:</strong> <?= $item['deskripsi']; ?></li>
                    <li class="list-group-item"><strong>Kategori:</strong> <?= $item['kategori']; ?></li>
                    <li class="list-group-item"><strong>Pengarang:</strong> <?= $item['pengarang']; ?></li>
                    <li class="list-group-item"><strong>Penerbit:</strong> <?= $item['penerbit']; ?></li>
                    <li class="list-group-item"><strong>Tahun Terbit:</strong> <?= $item['thn_terbit']; ?></li>
                  </ul>
                  <div class="card-body">

                    <a href="daftarBuku.php" class="btn btn-danger">Batal</a>
                    <a href="pinjam.php?id=<?= $item["id_buku"]; ?>" class="btn btn-success">Pinjam</a>

                  </div>
                </div>
              </div>
              <!-- Modal footer -->
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="../../assets/js/script.js"></script>
</body>

</html>