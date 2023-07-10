<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
} 

require 'functions.php';


// ambil data di URL 
$no_seri = $_GET['no_seri'];
$kode_inventaris = $_SESSION['kode_inventaris'];

 
 
 
//query data 
$detail_inventaris=tampil_data ("SELECT a.no_seri,a.kode_inventaris,a.kondisi, a.gambar,
                                  b.ruangan, b.kode_ruangan, d.nama_barang  FROM                             
                                  detail_inventaris  a 
                                  JOIN ruangan b  
                                  ON b.kode_ruangan = a.kode_ruangan
                                  JOIN inventaris c
                                  ON c.kode_inventaris = a.kode_inventaris
                                  JOIN barang d
                                  ON d.kode_barang = c.kode_barang
                                  WHERE a.no_seri = '$no_seri'
                                  ")[0];


 

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["ubah_detail_inventaris"])) {

    // cek apakah berhasil di ubah atau tidak
   if (ubah_detail_inventaris ($_POST) > 0) {
       echo "<script> 
               alert('Data Berhasil Diubah!');
               document.location.href='data_detail_inventaris.php?kode_inventaris=$kode_inventaris';
           </script>";	
   } else {
       echo "<script> 
               alert('Data Gagal Diubah!');
               document.location.href='data_detail_inventaris.php?kode_inventaris=$kode_inventaris';
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
          <h1 class="h3 mb-2 text-gray-800">Data Inventaris</h1>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Ubah Inventaris</h6>
            </div>

              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data" >
                <div class="card-body">

                <div class="form-group">               
                    <label for="no_seri">No Seri</label>
                    <input type="text"  name="no_seri" class="form-control" id="no_seri" placeholder="Masukkan Kode Inventaris" value="<?= $detail_inventaris["no_seri"]; ?>" readonly>
                </div> 

              <div class="form-group">               
                    <label for="kode_inventaris">Kode Inventaris</label>
                    <input type="text"  name="kode_inventaris" class="form-control" id="kode_inventaris" placeholder="Masukkan Kode Inventaris" value="<?= $detail_inventaris["kode_inventaris"]; ?>" readonly>
                </div> 

                <div class="form-group">            
                    <label for="ruangan">Ruangan</label>
                    <select name="ruangan" id="ruangan" class="form-control" required="required">
                       <?php
                       $ruangan=tampil_data ("SELECT * FROM ruangan");	  
                       foreach ($ruangan as $data) :
                                if ($detail_inventaris['kode_ruangan']==$data['kode_ruangan']) {
                                    $select="selected";
                                    }else{
                                    $select="";
                                    }
                                    ?>
                        <option value="<?= $data['kode_ruangan'];?>"
                        <?= $select;?>><?= $data['ruangan'];?></option>
                        <?php  endforeach; ?>
                    </select>                  
                </div>

                <div class="form-group">               
                    <label for="Kondisi">Kondisi</label>
                    <select name="kondisi" id="" class="form-control" required="required">
                    <?php
                        if ($detail_inventaris['kondisi']=='Layak Pakai') echo "<option value='Layak Pakai' selected>Layak Pakai</option>";
                        else echo "<option value='Layak Pakai'>Layak Pakai</option>";  
                        if ($detail_inventaris['kondisi']=='Rusak') echo "<option value='Rusak' selected>Rusak</option>";
                        else echo "<option value='Rusak'>Rusak</option>";  
                      
                    ?> 
                    </select>
                </div>  

                <div class="form-group">               
                    <label for="gambar">Gambar</label>
                    <?php 
                        if ($detail_inventaris['gambar']=="")  :?>
                          <img src="img/no_image.jpg" width=500px;><br><br>	
                    <?php else :?>
                            <img src="img/<?= $detail_inventaris['gambar']; ?>" width=500px;><br><br>
                    <br>
                    <?php endif; ?>
				            <input type="file" name="gambar" id="gambar">                
                </div>  
                
               <!-- /.card-body -->               
                  <button type="submit" name="ubah_detail_inventaris" class="btn btn-primary">Ubah</button>
                  <a  href="data_detail_inventaris.php?kode_inventaris=<?= $kode_inventaris;?>" name="close" class="btn btn-secondary">Close</a>
               
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

  <script >
    $(document).ready(function(){     
                
        $("#jenis_barang").change(function(){
        var jenis_barang = $("#jenis_barang").val();
            $.ajax({
              type: "POST",
                url: "get_barang.php",
                data: {jenis_barang:jenis_barang},
                cache: false,
                success: function(msg){
                  $("#nama_barang").html(msg);
                }
              });     
            });       
      
           });
  </script>

<script >
    $(document).ready(function(){     
                
        $("#program").change(function(){
        var program = $("#program").val();
            $.ajax({
              type: "POST",
                url: "get_kegiatan.php",
                data: {program:program},
                cache: false,
                success: function(msg){
                  $("#kegiatan").html(msg);
                }
              }); 

            }); 

        $("#kegiatan").change(function(){
        var kegiatan = $("#kegiatan").val();
            $.ajax({
              type: "POST",
                url: "get_sub_kegiatan.php",
                data: {kegiatan:kegiatan},
                cache: false,
                success: function(msg){
                  $("#sub_kegiatan").html(msg);
                }
              }); 
                  
            });       
      
           });
  </script>

</body>

</html>
