<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
} 
if ($_SESSION['level']=="kepala") {
  header("Location: index.php");
	exit;
}
require 'functions.php';

// ambil data di URL 
$kode_rekening = $_GET['kode_rekening'];
//query data 
$uraian =tampil_data ("SELECT * FROM uraian WHERE kode_rekening = '$kode_rekening'") [0];	


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["ubah_uraian"])) {

    // cek apakah berhasil di ubah atau tidak
   if (ubah_uraian ($_POST) > 0) {
       echo "<script> 
               alert('Data Berhasil Diubah!');
               document.location.href='data_uraian.php';
           </script>";	
   } else {
       echo "<script> 
               alert('Data Gagal Diubah!');
               document.location.href='data_uraian.php';
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
 
  <title>Sistem Informasi Inevntaris Barang Diskominfo Kota Jayapura</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
<!-- Page Wrapper -->
  <div id="wrapper">

  <!-- sidebar -->
  <?php 
  include'sidebar.php'
  ?>
  <!-- end sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <form class="form-inline">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
          </form> 
          
        <!--  top navbar -->
       <?php 
         include'topnavbar.php'
        ?>
        <!-- end top navbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"> Ubah Uraian</h1>
         
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Ubah Uraian</h6>
            </div>

              <!-- form start -->
              <form action="" method="post" >
                <div class="card-body">

                  <div class="form-group">             
                  <label for="kegiatan">Kode Rekening</label>
                    <input type="text" value="<?= $uraian["kode_rekening"]; ?>"  name="kode_uraian1" class="form-control" id="program" required="required" disabled>
                    <input type="" name="kode_rekening" value="<?= $uraian["kode_rekening"]; ?>" hidden>
                  </div>  

                  
                  <div class="form-group">             
                     <label for="kegiatan">Uraian</label>
                    <input type="text" value="<?= $uraian["uraian"]; ?>"  name="uraian" class="form-control" id="kegiatan"  required="required" autocomplete="off">
                  </div>  

                 
                
                <!-- /.card-body -->               
                  <button type="submit" name="ubah_uraian" class="btn btn-primary">Ubah</button>
                  <a  href="data_program.php" name="close" class="btn btn-secondary">Close</a>
               
              </form>



           

              </div>

          </div>
 
          </div>
      </div>
      <!-- End of Main Content -->

         <!-- footer -->
      <?php
      include 'footer.php';
      ?>
      <!-- endfooter -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
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

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
