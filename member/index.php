
<?php
// Start the session
session_start();


// Check if 'nama' is set in the session, if not, redirect to the login page
if (!isset($_SESSION['nama'])) {
    header("Location: ../sign/member/sign_in.php");
    exit();
}

if (!isset($_SESSION['nisn'])) {
    header("Location:../sign/member/sign_in.php");
    exit();
}

// Access the NIS from the session
$nis = $_SESSION['nisn'];
// Now you can use $nis wherever you need it
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'><link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/fontawesome/css/stylehome.css">
  <title>Hello, world!</title>
</head>


<body>
<nav class="navbar">
  <div class="container">

    <div class="navbar-header">
      <button class="navbar-toggler" data-toggle="open-navbar1">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <img src="../assets/images/Madya_Perpus-removebg-preview.png" style="width: 100px; height: 50px;">
      </a>
    </div>

    <div class="navbar-menu" id="open-navbar1">
      <ul class="navbar-nav">
      <li><a href="buku/daftarBuku.php">Daftar Buku</a></li>
        <li><a href="buku/daftarPinjam.php">Daftar Pinjam</a></li>
        <li><a href="buku/historyBuku.php">History</a></li>
        <li><a href="logout.php">Log Out</a></li>
      </ul>
    </div>
  </div>
</nav>
      <style>
       body {
  width: 100%;
  height: 100%;
  background-image: linear-gradient(to right, #f6d365, #fda085);
}

        /* Add this to your CSS */
.img-small {
  width: 50px; /* Adjust the width as needed */
  height: auto; /* Maintain aspect ratio */
}

        .layout-card-custom {
          display: flex;
          flex-wrap: wrap;
          justify-content: center;
          gap: 1.5rem;
        }

        .arrivals{
    width: 100%;
    height: 100vh;
    margin-bottom: 35px;
}

.arrivals h1{
    font-size: 50px;
    text-align: center;
    margin-bottom: 35px;
}

.arrivals .arrivals_box{
    width: 95%;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    grid-gap: 25px 0;
}

.arrivals .arrivals_box .arrivals_card{
    width: 210px;
    height: 460px;
    text-align: center;
    padding: 5px;
    border: 1px solid #000;
    margin: auto 20px;
}

.arrivals .arrivals_box .arrivals_card:hover{
    box-shadow: 0 0 5px #3608a1;
}

.arrivals .arrivals_box .arrivals_card .arrivals_image{
    width: 150px;
    height: 220px;
    margin: 0 auto;
    cursor: pointer;
    box-shadow: 0 0 8px rgba(0,0,0,0.5);
    overflow: hidden;
}

.arrivals .arrivals_box .arrivals_card .arrivals_image img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: 0.3s;
}

.arrivals .arrivals_box .arrivals_card:hover .arrivals_image img{
    transform: scale(1.1);
}

.arrivals .arrivals_box .arrivals_card .arrivals_tag p{
    font-family: queen of camelot;
    font-size: 20px;
    margin: 8px 0;
}

.arrivals .arrivals_box .arrivals_card .arrivals_tag .arrivals_icon{
    color: #3608a1;
    margin-bottom: 18px;
}

.arrivals .arrivals_box .arrivals_card .arrivals_tag .arrivals_btn{
    padding: 8px 20px;
    border: 2px solid #3608a1;
    text-decoration: none;
    color: #000;
}

      </style>
<div class="mt-5 p-4">
      <?php
      // Mendapatkan tanggal dan waktu saat ini
      $date = date('Y-m-d H:i:s'); // Format tanggal dan waktu default (tahun-bulan-tanggal jam:menit:detik)
      // Mendapatkan hari dalam format teks (e.g., Senin, Selasa, ...)
      $day = date('l');
      // Mendapatkan tanggal dalam format 1 hingga 31
      $dayOfMonth = date('d');
      // Mendapatkan bulan dalam format teks (e.g., Januari, Februari, ...)
      $month = date('F');
      // Mendapatkan tahun dalam format 4 digit (e.g., 2023)
      $year = date('Y');
      ?>
      
      <h1 class="mt-0 fw-bold">Dashboard - <span class="fs-4 text-secondary"> <?php echo $day. " ". $dayOfMonth." ". " ". $month. " ". $year; ?> </span></h1>
      <div class="alert alert-info" role="alert">Selamat datang member - <span class="text-capitalize fw-bold"><?php echo $_SESSION['nama']; ?> </span> di Dashboard Perpustakaan Online</div>
      
    <div class="mt-3 p-3">
      <div class="mt-2 mb-4">
       <h3 class="mb-3">Layanan Perpustakaan yang tersedia</h3>
      </div>
      
      <!-- Optional JavaScript; choose one of the two! -->

      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script  src="../assets/js/script.js"></script>
      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>