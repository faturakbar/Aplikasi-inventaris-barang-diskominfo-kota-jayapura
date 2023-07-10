<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
} 

require 'functions.php';


// ambil data di URL 
$no_seri= $_GET['no_seri'];

 

//query data 
$detail_barang=tampil_data ("SELECT * FROM detail_barang 
                            JOIN barang ON detail_barang.kode_barang = barang.kode_barang
                            JOIN ruangan ON detail_barang.kode_ruangan = ruangan.kode_ruangan
                            JOIN jenis_barang ON barang.kode_jenis = jenis_barang.kode_jenis   
                            WHERE no_seri = '$no_seri'") [0];	

 
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["ubah"])) {

    // cek apakah berhasil di ubah atau tidak
   if (ubah_detail ($_POST) > 0) {
       echo "<script> 
               alert('Data Berhasil Diubah!');
               document.location.href='data_detail.php';
           </script>";	
   } else {
       echo "<script> 
               alert('Data Gagal Diubah!');
               document.location.href='data_detail.php';
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

  <title>Aplikasi Inventaris Barang Lab FIKOM USTJ</title

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
          <h1 class="h3 mb-2 text-gray-800">Data Detail Barang</h1>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Ubah Detail Barang</h6>
            </div>

              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data" >
                <div class="card-body">
                <div class="form-group">      
                <input type="hidden" name="gambarlama" value="<?= $detail_barang['gambar']; ?>">         
                    <label for="no_seri">No Seri</label>
                    <input type="text"  name="no_seri" class="form-control" id="no_seri"   value="<?=$detail_barang["no_seri"];?>" readonly>
                </div>   
                <div class="form-group">               
                    <label for="jenis_barang">Jenis Barang</label>
                    
                    <select name="jenis_barang" id="jenis_barang" class="form-control" required="required">
                 <option value="">pilih</option>
                 <?php
                        $kode_jenis = $detail_barang["kode_jenis"];  
                        $jenis_barang =tampil_data ("SELECT * FROM jenis_barang");	 
                      ?>
                      <?php foreach ($jenis_barang as $data) :?>
                                <?php if ($kode_jenis == $data['kode_jenis']) {
                                    $select="selected";
                                    }else{
                                    $select="";
                                    }
                                    ?>
                                    <option value="<?= $data['kode_jenis'];?>" <?= $select;?> ><?= $data['jenis_barang'];?></option>
                        <?php endforeach; ?>
                    </select>                  
                </div>      
                <div class="form-group">               
              
                    <label for="nama_barang">Nama Barang</label>
                    <select name="nama_barang" id="nama_barang" class="form-control" required="required">
                 
                       <?php
                        $kode_jenis = $detail_barang["kode_jenis"];  
                        $barang =tampil_data ("SELECT * FROM barang  WHERE kode_jenis = '$kode_jenis'");	 
                      
                       foreach ($barang as $data) :
                                if ($detail_barang['kode_barang']==$data['kode_barang']) {
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
                    <label for="ruangan">Ruangan</label>
                    <select name="ruangan" id= "ruangan" class="form-control">
                    <?php
                       $ruangan=tampil_data ("SELECT * FROM ruangan");	  
                       foreach ($ruangan as $data) :
                                if ($detail_barang['kode_ruangan']==$data['kode_ruangan']) {
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
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan"  name="keterangan" rows="3"  ><?=$detail_barang["keterangan"];?></textarea>
                </div>           
                <div class="form-group">               
                    <label for="kondisi">Kondisi</label>
                    <select name="kondisi" id="" class="form-control" required="required">
                    <?php
                        if ($detail_barang['kondisi']=='BAIK') echo "<option value='BAIK' selected>BAIK</option>";
                        else echo "<option value='BAIK'>BAIK</option>";  
                        if ($detail_barang['kondisi']=='RUSAK') echo "<option value='RUSAK' selected>RUSAK</option>";
                        else echo "<option value='RUSAK'>RUSAK</option>";  
                        if ($detail_barang['kondisi']=='PUTIHKAN') echo "<option value='PUTIHKAN' selected>PUTIHKAN</option>";
                        else echo "<option value='PUTIHKAN'>PUTIHKAN</option>";  
                    ?> 
                    </select>                  
                <input type="hidden" name="kondisii" id="kondisii" value="<?=$detail_barang["kondisi"];?>">
                </div>  
                
                <div class="form-group">
                  <label for="gambar">Gambar</label> <br> 
                  <?php if ($detail_barang["gambar"]=="") : ?>
                    <a  href="img/no_image.jpg" data-toggle="lightbox"  data-title="<?= $detail_barang["nama_barang"];?>"> <img src="img/no_image.jpg" width=70;></a><br> <br>
                  <?php else :?>   
                  <a  href="img/<?= $detail_barang["gambar"];?>" data-toggle="lightbox"  data-title="<?= $detail_barang["nama_barang"];?>"> <img src="img/<?= $detail_barang['gambar']; ?>" width=70;></a><br> <br>
                  <?php endif; ?> 
                  <input type="file" class="form-control-file" id="gambar" name="gambar">
               </div> <br>

               <!-- /.card-body -->               
                  <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                  <a href="data_barang.php" name="close" class="btn btn-secondary">Close</a>
               
              </form>     

              </div>

          </div>
 
          </div>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

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

  <!-- Filterizr-->
  <script src="vendor/filterizr/jquery.filterizr.min.js"></script>
  <!-- Ekko Lightbox -->
  <script src="vendor/ekko-lightbox/ekko-lightbox.min.js"></script> 


  <script>
    $(document).ready(function(){       	 
        $("#jenis_barang").change(function(){
      	var jenis_barang = $("#jenis_barang").val();
          	$.ajax({
          		type: "POST",
              	url: "get_barang.php",
              	data: {jenis_barang: jenis_barang},
              	cache: false,
              	success: function(msg){
                  $("#nama_barang").html(msg);
                }
            });
        });
      });
  </script>
  <script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>

  
</body>

</html>
