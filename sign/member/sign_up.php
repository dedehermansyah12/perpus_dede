<?php 
include "../../config.php";
if(isset($_POST["signUp"]) ) {
  
  if(signUp($_POST) > 0) {
    echo "<script>
    alert('Sign Up berhasil!')
    </script>";
  }else {
    echo "<script>
    alert('Sign Up gagal!')
    </script>";
  }
  
}

?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Register</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../assets/style.css">
</head>
<style>
  body {
  width: 100%;
  height: 100%;
  background-image: linear-gradient(to right, #f6d365, #fda085);
}
</style>

<body>
 
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="card text-black" style="border-radius: 10px;">
          <div class="card-body p-md-2">
          <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-3 mt-5">Register</p>
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                <form action="" method="post">
                  <div class="row">
                    <div class="form-outline mb-4  col-md-6 ">
                      <label class="form-label" for="validationCustom01"> <i class="bi bi-person-circle"></i>NISN</label>
                      <input type="text" id="validationCustom01" class="form-control form-control-lg py-3" name="nisn" autocomplete="off" placeholder="NISN" style="border-radius:25px ;" />
                    </div>
                    <div class="form-outline mb-4 col-md-6">
                      <label class="form-label" for="validationCustom02"> <i class="bi bi-person-circle"></i>Nama Lengkap</label>
                      <input type="text" id="validationCustom02" class="form-control form-control-lg py-3" name="nama" autocomplete="off" placeholder="Nama Lengkap" style="border-radius:25px ;" />
                    </div >
</div >
                    <div class="row ">
                    <div class="form-outline mb-4 col-md-6">
                      <label class="form-label" for="validationCustom02"> <i class="bi bi-person-circle"></i>Password</label>
                      <input type="password" id="validationCustom02" class="form-control form-control-lg py-3" name="password" autocomplete="off" placeholder="Password" style="border-radius:25px ;" />
                  </div>
                    <div class="form-outline mb-4 col-md-6">
                      <label class="form-label" for="validationCustom01"> <i class="bi bi-person-circle"></i>Alamat</label>
                      <input type="text" id="validationCustom01" class="form-control form-control-lg py-3" name="alamat" autocomplete="off" placeholder="Alamat" style="border-radius:25px ;" />
                    </div>
                  </div>
                  <div class="form-outline mb-4">
                    <label class="form-label" for="inputGroupSelect01"><i class="bi bi-person-circle"></i>Kelas</label>
                    <select class="form-select" id="inputGroupSelect01" name="kelas">
                    <option disabled="disabled" selected="selected">Pilih Kelas</option>
                      <option value="X">X</option>
                      <option value="XI">XI</option>
                      <option value="XII">XII</option>
                    </select>
                  </div>

                  <div class="form-outline mb-4">
                    <label class="form-label" for="inputGroupSelect01"><i class="bi bi-person-circle"></i>Jurusan</label>
                    <select class="form-select" id="inputGroupSelect01" name="jurusan">
                      <option disabled="disabled" selected="selected">Pilih Jurusan</option>
                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                        <option value="Otomatisasi Tata Kelola Perkantoran">Otomatisasi Tata Kelola Perkantoran</option>
                        <option value="BDP">BDP</option>
                        <option value="Multi Media">Multi Media</option>
                        <option value="AKL">AKL</option>
                    </select>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button class="btn btn-primary" type="submit" value="Sign Up" name="signUp" class="btn btn-warning btn-lg text-light my-2 py-3" style="width: 100%; height: 60px; border-radius: 30px; font-weight: 600; background-color: #ffc107;">Sign Up</button>
                  </div>

                  <br>
                  <p>Already have an account? <a href="sign_in.php" class="text-decoration-none text-primary">Sign In</a></p>
                </form><br>
              </div>
              

            </div>
          </div>
        </div>
      </div>
  </section>




  </div>
  </div>
</body>

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

</html>