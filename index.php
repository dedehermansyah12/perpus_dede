<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/fontawesome/css/stylehome.css">
  <title>Hello, world!</title>
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
        <img src="assets/images/Madya_Perpus-removebg-preview.png" style="width: 100px; height: 50px;">
        </a>
      </div>

      <div class="navbar-menu" id="open-navbar1">
        <ul class="navbar-nav">
          <li><a href="sign/member/sign_in.php">Login</a></li>
          <li><a href="sign/member/sign_up.php">Register</a></li>
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
          <img src="assets/images/dede2.jpeg" class="d-block w-100" alt="dede2.jpeg">
        </div>
        <div class="carousel-item">
          <img src="assets/images/dede3.jpeg" class="d-block w-100" alt="dede3.jpg">
        </div>
        <div class="carousel-item">
          <img src="assets/images/dede4.jpeg" class="d-block w-100" alt="dede4.jpg">
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




  <div class="d-flex flex-wrap justify-content-center">
    <div class="col">

      <?php
      require "config.php";
      // query read semua buku
      $buku = queryReadData("SELECT * FROM buku order by id_buku desc");
      //search buku
      if (isset($_POST["search"])) {
        $buku = search($_POST["keyword"]);
      }

      ?>

      <div class="container-fluid mt-2">
        <form action="" method="post" class="mt-4 mx-auto col-lg-6 col-md-8 col-sm-10">
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
      <div class="arrivals_card position-relative">
        <div class="arrivals_image">
          <a href="sign/member/sign_in.php"><img src="assets/imgDB/<?= $item["cover"]; ?>" class="card-img-top" alt="coverBuku" height="200px"></a>
        </div>
        <div class="arrivals_tag mt-3">
          <p class="text-center"><?= $item["judul"]; ?></p>
        </div>
        <div class="btn-group mt-3 position-absolute" style="bottom: 10%; left: 50%; transform: translateX(-50%);" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal<?= $item["id_buku"]; ?>">Detail</button>
          <a type="button" class="btn btn-primary" href="sign/member/sign_in.php">Pinjam</a>
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
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <img src="assets/imgDB/<?= $item["cover"]; ?>" class="img-thumbnail mb-4" alt="Mobil Image">
                </div>
                <div class="col-md-7">
                  <div style="display: flex; flex-direction: column;">
                    <div style="word-wrap: break-word;"><strong>Judul:</strong><?php echo $item['judul']; ?></div>
                  </div>
                  <div>
                    <strong>Kategori:</strong> <?php echo $item['kategori']; ?>
                  </div>
                  <div>
                    <strong>Pengarang:</strong> <?php echo $item['pengarang']; ?>
                  </div>
                  <div>
                    <strong>Penerbit:</strong> <?php echo $item['penerbit']; ?>
                  </div>
                  <div>
                    <strong>Tahun Terbit:</strong> <?php echo $item['thn_terbit']; ?>
                  </div>
                  <div>
                    <strong>Deskripsi:</strong> <?php echo $item['deskripsi']; ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>


      </section>


      <!-- Optional JavaScript; choose one of the two! -->

      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="assets/js/script.js"></script>
      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>