<?php

require 'functions.php';
 
 

$kode_user = $_GET['kode_user'];
$username= $_GET['username'];
 

// Check apakah tombol sudah ditekan atau belum 
if (isset($_POST['reset_password'])) {

  // cek apakah berhasil di ubah atau tidak
  if (ganti_password ($_POST) > 0) {
    echo "<script> 
            alert('Password Berhasil Diubah!');
            document.location.href='login.php';
        </script>";	
} else {
    echo "<script> 
            alert('Password Gagal Diubah!');
            document.location.href='login.php';
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
                    <h1 class="h4 text-gray-900 mb-2">Silahkan Inputkan Password Baru Anda</h1>
                    
                  </div>
                  <form class="user" method="POST">
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan Password..." name="password1">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Ulangi Password..." name="password2">
                    </div>
                     <input type="text" value="<?=$kode_user;?>" name="kode_user" hidden>
                     <input type="text" value="<?=$username;?>" name="username" hidden>
                    <button type="submit" name="reset_password" class="btn btn-primary btn-user btn-block">Reset Password</button>
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
