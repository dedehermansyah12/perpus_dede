<?php
session_start();
include "../../config.php";

if (isset($_SESSION['sebagai'])) {
  if ($_SESSION['sebagai'] == 'petugas') {
    header("Location: ../../user/petugas/index.php");
    exit;
  } elseif ($_SESSION['sebagai'] == 'admin') {
    header("Location: ../../user/admin/index.php");
    exit;
  }
}


if (isset($_POST['btn-login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];


  // Query to check user credentials
  $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
  $result = $connection->query($query);

  if (mysqli_num_rows($result) === 1) {
    $_SESSION['username'] = true;
    $rows = mysqli_fetch_assoc($result);
    if ($rows['sebagai'] == 'petugas') {
      $_SESSION['sebagai'] = $rows['sebagai'];
      $_SESSION['username'] = $rows['username'];
      $_SESSION['id'] = $rows['id'];
      // $_SESSION['id'] = $rows['password'];
      return header("Location: ../../user/petugas/index.php");

      if (isset($_SESSION['username'])) {
        header("Location: ../../user/petugas/index.php");
        exit;
      }
    } elseif ($rows['sebagai'] == 'admin') {
      $_SESSION['sebagai'] = $rows['sebagai'];
      $_SESSION['username'] = $rows['username'];
      $_SESSION['id'] = $rows['id'];
      // $_SESSION['id'] = $rows['password'];
      return header("Location: ../../user/admin/index.php");


      if (isset($_SESSION['username'])) {
        header("Location: ../../user/admin/index.php");
        exit;
      }
    }
  } else {
    // Login failed
    echo "<script>alert('username atau password Anda salah. Silahkan coba lagi!')</script>";
}
}
$connection->close();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="../../assetsdb/images/logos/favicon.png" />
  <link rel="stylesheet" href="../../assets/css/styles.min.css" />
</head>
<style>
  body {
  width: 100%;
  height: 100%;
  background-image: linear-gradient(to right, #f6d365, #fda085);
}
</style>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../../assets/images/Madya_Perpus-removebg-preview.png" width="180" alt="">
                </a>
                <p class="text-center">Your Social Campaigns</p>
                <form method="post">
                  <div class="mb-3">
                    <label for="exampleInputtext1" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="exampleInputtext1" aria-describedby="text">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                  </div>
                  <button class="btn btn-primary" type="submit" name="btn-login">Sign In</button>
                  <a href="../../index.php" class="btn btn-warning">
                            Kembali
                          </a>
                  <div class="d-flex align-items-center justify-content-center">
                  
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <?php if (isset($error)) : ?>
    <div class="alert alert-danger mt-2" role="alert">username atau Password Salah!</div>
  <?php endif; ?>
  </div>

  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      const forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }

          form.classList.add('was-validated')
        }, false)
      })
    })()
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>