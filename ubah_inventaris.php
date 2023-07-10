<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
} 

require 'functions.php';


// ambil data di URL 
$kode_inventaris = $_GET['kode_inventaris'];

//query data 
$inventaris=tampil_data ("SELECT *
                          FROM inventaris 
                          JOIN sub_kegiatan ON sub_kegiatan.kode_sub_kegiatan = inventaris.kode_sub_kegiatan
                          JOIN kegiatan ON kegiatan.kode_kegiatan = sub_kegiatan.kode_kegiatan
                          JOIN program ON program.kode_program =kegiatan.kode_program
                          JOIN barang ON barang.kode_barang = inventaris.kode_barang
                          JOIN jenis_barang ON jenis_barang.kode_jenis = barang.kode_jenis
                          WHERE kode_inventaris = '$kode_inventaris'") [0];	
 

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
              <form action="" method="post" >
                <div class="card-body">

              <div class="form-group">               
                    <label for="kode_inventaris">Kode Inventaris</label>
                    <input type="text"  name="kode_inventaris" class="form-control" id="kode_inventaris" placeholder="Masukkan Kode Inventaris"  value="<?=$kode_inventaris; ?>" readonly>
                </div>     
                <div class="form-group">            

                    <label for="jenis_barang">Jenis Barang</label>
                    <select name="jenis_barang" id="jenis_barang" class="form-control" required="required">
                       <?php
                       $jenis_barang=tampil_data ("SELECT * FROM jenis_barang");	  
                       foreach ($jenis_barang as $data) :
                                if ($inventaris['kode_jenis']==$data['kode_jenis']) {
                                    $select="selected";
                                    }else{
                                    $select="";
                                    }
                                    ?>
                        <option value="<?= $data['kode_jenis'];?>"
                        <?= $select;?>><?= $data['jenis_barang'];?></option>
                        <?php  endforeach; ?>
                    </select>                  
                </div>
                  <div class="form-group">               
              
                    <label for="nama_barang">Nama Barang</label>
                    <select name="nama_barang" id="nama_barang" class="form-control" required="required"   >
                    <?php
                        $kode_jenis = $inventaris["kode_jenis"];  
                        $barang =tampil_data ("SELECT * FROM barang  WHERE kode_jenis = '$kode_jenis'");    
                        foreach ($barang as $data) :
                                if ($inventaris['kode_barang']==$data['kode_barang']) {
                                    $select="selected";
                                    }else{
                                    $select="";
                                    }
                                    ?>
                        <option value="<?= $data['kode_barang'];?>"
                        <?= $select;?>><?= $data['nama_barang'];?></option>
                        <?php  endforeach; ?>
                    </select>                  
                </div>  

                <div class="form-group">               
                    <label for="program">Program</label>
                    <select name="program" id="program" class="form-control" required="required"  >
                       <?php
                       $program=tampil_data ("SELECT * FROM program");    
                       foreach ($program as $data) :
                                if ($inevntaris['kode_program']==$data['kode_program']) {
                                    $select="selected";
                                    }else{
                                    $select="";
                                    }
                                    ?>
                        <option value="<?= $data['kode_program'];?>"
                        <?= $select;?>><?= $data['nama_program'];?></option>
                        <?php  endforeach; ?>
                    </select>                  
                </div>  

                <div class="form-group">               
              
                    <label for="kegiatan">Kegiatan</label>
                    <select name="kegiatan" id="kegiatan" class="form-control" required="required"   >
                 
                       <?php
                        $kode_program = $inventaris["kode_program"];  
                        $kegiatan =tampil_data ("SELECT * FROM kegiatan  WHERE kode_program = '$kode_program'");    
                        foreach ($kegiatan as $data) :
                                if ($inventaris['kode_kegiatan']==$data['kode_kegiatan']) {
                                    $select="selected";
                                    }else{
                                    $select="";
                                    }
                                    ?>
                        <option value="<?= $data['kode_kegiatan'];?>"
                        <?= $select;?>><?= $data['nama_kegiatan'];?></option>
                        <?php  endforeach; ?>
                    </select>                  
                </div>  

                <div class="form-group">               
              
                    <label for="sub_kegiatan">Sub Kegiatan</label>
                    <select name="sub_kegiatan" id="sub_kegiatan" class="form-control" required="required"   >
                 
                       <?php
                        $kode_kegiatan = $inventaris["kode_kegiatan"];  
                        $sub_kegiatan =tampil_data ("SELECT * FROM sub_kegiatan  WHERE kode_kegiatan = '$kode_kegiatan'");    
                        foreach ($sub_kegiatan as $data) :
                                if ($inventaris['kode_sub_kegiatan']==$data['kode_sub_kegiatan']) {
                                    $select="selected";
                                    }else{
                                    $select="";
                                    }
                                    ?>
                        <option value="<?= $data['kode_sub_kegiatan'];?>"
                        <?= $select;?>><?= $data['nama_sub_kegiatan'];?></option>
                        <?php  endforeach; ?>
                    </select>                  
                </div>  

                 <div class="form-group">    
                    <label for="program">Jumlah</label>
                    <input type="number"name="jumlah" class="form-control" id="program"  required="required" autocomplete="off" value="<?= $inventaris["jumlah"]; ?>">
                  </div>               
                          
                <div class="form-group ui-widget">               
                    <label for="tgl_pengadan">Tanggal Pengadaan</label>
                    <input type="date" name="tgl_pengadaan" class="tm form-control" id="tgl_pengadaan" required="required" value="<?= $inventaris["tgl_pengadaan"]; ?>">                     
                </div>    

               <!-- /.card-body -->               
                  <button type="submit" name="ubah_inventaris" class="btn btn-primary">Ubah</button>
                  <a  href="data_inventaris.php" name="close" class="btn btn-secondary">Close</a>
               
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
