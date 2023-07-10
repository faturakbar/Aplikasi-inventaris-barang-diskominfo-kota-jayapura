<?php 
session_start();
require 'functions.php';


// cek cookie 
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
	$id = $_COOKIE['id'];
  $key = $_COOKIE['key'];
  
 

	// ambil username berdasarkan id 
	$result = mysqli_query($conn, "SELECT username from user WHERE kode_user = $id");
	$row = mysqli_fetch_assoc($result);


	// cek cookie dan username 
	if ($key === hash('sha256', $row['username'])) {
		 $_SESSION['login'] = true;
	}
	
}

if (isset($_SESSION["login"])) {
	 header("Location: index.php");
	exit;
}

// cek apakah tombol submit sudah ditekan atau belum 
if (isset($_POST['login'])) {
	$username =$_POST['username'];
  $password =$_POST['password']; 

  
 
  $result =mysqli_query($conn, "SELECT * FROM user WHERE username ='$username'");
 
 
	if (mysqli_num_rows($result) === 1) {	 
		// cek password 
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row['password'])) {
			// set session 
      $_SESSION['kode_user']   = $row['kode_user'];
      $_SESSION['username']   = $row['username'];
      $_SESSION['password']   = $row['password'];
      $_SESSION['level']   = $row['level'];
      $_SESSION["login"]= true;

      
      
      // cek remember me 
			if (isset ($_POST['remember'])) {
				// buat cookie
				setcookie('id', $row['kode_user'], time()+60);
				setcookie('key', hash('sha256', $row['username']), time()+60);
      }
      // Check Level
      if ($row['level']=="kepala_dinas") {
        header("Location:kepala_dinas/index.php");
        exit;
      }
      else {
        header("Location:index.php");
        exit;
      }
     
		}	
	}
  $error = true;
  
 
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

  <title>Sistem Informasi Inevntaris Barang Diskominfo Kota Jayapura</title>


  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <style>

    #remember {
      margin-left:-18px;
    }
    p{
      color: red;
    }
  </style>
</head>

<body class="bg-gradient-primary">
<br><br>
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block">
                <img src="img/diskominfo_kota.jpg"  style="width:110%;  ">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                  <?php if (isset($error)) : ?>
                  <p>Username Atau Password Salah !!</p>
                  <?php endif; ?>
                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                  </div>
                  <form class="user" method="post" action="">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group" style="margin-left: 3px; " >
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox"   id="remember"   >
                        <label  for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-user btn-block" type="submit" name="login">
                      Login
                    </button>
                  
                  
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="lupa_password.php">Lupa Password?</a>
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
