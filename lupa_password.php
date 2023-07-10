<?php

require 'functions.php';
error_reporting(0);
$username = $_POST['username'];
$akun = tampil_data("SELECT * FROM user WHERE username ='$username'")[0];

 
$kode_user =  $akun['kode_user'];

// Check apakah tombol sudah ditekan atau belum 
if (isset($_POST['check_username'])) {

  // Check apakah username ada atau tidak
    if ($username==$akun['username']) {
      header("Location: ubah_password.php?kode_user=$kode_user&username=$username");
      exit;
    } else {
      echo "<script> 
      alert('Username Tidak Ditemukan!');
      document.location.href='lupa_password.php';
       </script>";	
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistem Informasi Inventaris Barang Diskominfo Kota Jayapura</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block  "><img src="img/diskominfo_kota.jpg"  style="width:100%;  "></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Lupa Password?</h1>
                    <p class="mb-4">Silahkan inputkan username anda untuk mereset password anda</p>
                  </div>
                  <form class="user" method="POST">
                    <div class="form-group">
                      <input type="input" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan Username..." name="username">
                    </div>
                    <button type="submit" name="check_username" class="btn btn-primary btn-user btn-block">Check Username</button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="login.php">Kembali Ke Menu Login!</a>
                  </div>
                   
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
