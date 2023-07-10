<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
} 

require 'functions.php';

$cetak_berdasarkan = $_GET['cetak_berdasarkan'];

 
$kode_inventaris = $_GET['kode_inventaris'];



 
// ambil data di URL 
$filter_by = $_GET['cetak_berdasarkan'];
 
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["ubah_inventaris"])) {

    // cek apakah berhasil di ubah atau tidak
   if (ubah_inventaris ($_POST) > 0) {
       echo "<script> 
               alert('Data Berhasil Diubah!');
               document.location.href='data_inventaris.php';
           </script>";	
   } else {
       echo "<script> 
               alert('Data Gagal Diubah!');
               document.location.href='data_inventaris.php';
           </script>";	
   }
    
}
 
 
// check apakah data yang dicetak adalah keseluruhan data
if ($cetak_berdasarkan=="kode_inventaris1") {
    header("Location:cetak_detail_inventaris.php?kode_inventaris=$kode_inventaris");
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

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- JQUERY -->
  <script src="js/jquery-3.5.1.min.js"></script>

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
          <h1 class="h3 mb-2 text-gray-800">Cetak Data Inventaris</h1>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Cetak Data Inventaris</h6>
            </div>

              <!-- form start -->
              <form action="cetak_detail_inventaris.php" method="post" >
                <div class="card-body">
              <?php if ($filter_by=='kode_ruangan') : ?>
                    <div class="form-group">   
                        <label for="ruangan">Ruangan</label>
                        <select name="ruangan" id="ruangan" class="form-control">
                       <option  >--Pilih Ruangan--</option>
                       </select>
              <?php else :?>
                        <div class="form-group">   
                        <label for="kondisi">Ruangan</label>
                              <select name="kondisi" id="kondisi" class="form-control">
                              <option value="Layak Pakai">Layak Pakai</option>
                              <option value="Rusak">Rusak</option>
                               
                              </select>
                    
              <?php endif; ?>   

              
              </div>     
                <input type="text" hidden name="kode_inventaris" value="<?= $kode_inventaris?>">
                 
               <!-- /.card-body -->               
                  <button type="submit" name="cetak" class="btn btn-success">Cetak</button>
                  <a  href="data_detail_inventaris.php?kode_inventaris=<?=$_GET['kode_inventaris'];?>" name="close" class="btn btn-secondary">Close</a>
               
              </form>     

              </div>

          </div>
 
          </div>
      </div>
      <!-- End of Main Content -->

     

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
<!-- Jquery -->
<script src="../js/jquery-3.5.1.min.js"></script>

<script
src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js">
</script>

<!-- jenis barang -->
<script  type="text/javascript">
    $(document).ready(function(){          
        $.ajax({
            type: "POST",
            url: "get_cetak_ruangan.php",
                cache: false, 
                  success: function(msg){
                        $("#ruangan").html(msg);                                                                             
                    }
                    });                    
                   
    });

</script>

<!-- Nama barang -->
<script  type="text/javascript">
    $(document).ready(function(){          
        $.ajax({
            type: "POST",
            url: "get_barang_cetak.php",
                cache: false, 
                  success: function(msg){
                        $("#barang").html(msg);                                                                             
                    }
                    });                    
                   
    });

</script>

<!-- Program -->
<script  type="text/javascript">
    $(document).ready(function(){          
        $.ajax({
            type: "POST",
            url: "get_program.php",
                cache: false, 
                  success: function(msg){
                        $("#program").html(msg);                                                                             
                    }
                    });                    
          
                   
    });

</script>

<!-- Sub Kegiatan -->
<script  type="text/javascript">
    $(document).ready(function(){          
        $.ajax({
            type: "POST",
            url: "get_sub_kegiatan_cetak.php",
                cache: false, 
                  success: function(msg){
                        $("#sub_kegiatan").html(msg);                                                                             
                    }
                    });                    
                   
    });

</script>
</body>

</html>
