<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
require 'functions.php';
       	     
 
if(isset($_POST['cari'])){
  $cari = $_POST['cari'];

}
if(isset($_POST['cari'])){
  $cari = $_POST['cari'];       
    $detail_barang=tampil_data ("SELECT no_seri, kode_barang, kode_ruangan, keterangan, kondisi,
    gambar,  nama_barang, ruangan, jenis_barang  FROM detail_barang 
    JOIN barang USING(kode_barang) 
    JOIN ruangan USING(kode_ruangan)
    JOIN jenis_barang USING(kode_jenis)
    WHERE kode_barang = '$cari'                         
    ");
  
}else{
  $detail_barang=tampil_data ("SELECT no_seri, kode_barang, kode_ruangan, keterangan, kondisi,
    gambar,  nama_barang, ruangan, jenis_barang  FROM detail_barang 
    JOIN barang USING(kode_barang) 
    JOIN ruangan USING(kode_ruangan)
    JOIN jenis_barang USING(kode_jenis)
    ORDER BY nama_barang                        
    ");
  }                 

 

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) { 

  // cek apakah berhasil di tambahkan atau tidak
 if (tambah_detail ($_POST) > 0) {

 
   echo "<script> 
       alert('Data Berhasil Ditambahkan!');
       document.location.href='data_detail.php';
     </script>";	
 } else {
   echo "<script> 
       alert('Data Gagal Ditambahkan!');
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

  <title>Sistem Informasi Inevntaris Barang Diskominfo Kota Jayapura</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

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
  <!-- endsidebar -->

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
              <h6 class="m-0 font-weight-bold text-primary">Data Detail Barang</h6>
            </div>
          
            <div class="card-body">
            <?php 
              $level = $_SESSION['level'];
              if($level == "admin") :?> 
            <div class="card-header  ">               
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                 Tambah Data Detail Barang
                </button>
                 <div class="modal fade" id="modal-lg">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Form Tambah Detail Barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                      
                
              <!-- form start -->
              <form action="" method="post"  enctype="multipart/form-data">
                <div class="card-body">      
                 <div class="form-group">               
                    <label for="no_seri">No Seri</label>
                    <input type="text"  name="no_seri" class="form-control" id="no_seri" placeholder="Masukkan No Seri Barang"  required="required" ">
                </div> 
                <div class="form-group">               
                    <label for="jenis_barang">Jenis Barang</label>
                    <select name="jenis_barang" id="jenis_barang" class="form-control" required="required">     
                    <option  >--Pilih--</option>                        
                    </select>                    
                </div>        
                <div class="form-group">               
                    <label for="nama_barang">Nama Barang</label>
                    <select name="nama_barang" id="nama_barang" class="form-control" required="required">     
                    <option  >--Pilih--</option>                        
                    </select>                    
                </div>  
                <div class="form-group">               
                    <label for="ruangan">Ruangan</label>
                    <select name="ruangan" id="ruangan" class="form-control" required="required">
                    <option  >--Pilih--</option>
                    </select>
                </div>         
                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <textarea class="form-control" id="keterangan"  name="keterangan" rows="3" placeholder="Opsional" ></textarea>
                </div> 
                <div class="form-group">               
                    <label for="kondisi">Kondisi</label>
                    <select name="kondisi" id="kondisi" class="form-control" required="required">
                          <option value="BAIK">BAIK</option>
                          <option value="RUSAK">RUSAK</option>
                          <option value="PUTIHKAN">PUTIHKAN</option>
                    </select>  
               </div>
               <div class="form-group">
                  <label for="gambar">Upload Gambar</label>
                  <input type="file" class="form-control-file" id="gambar" name="gambar"    >
               </div>

 
              </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                  </div>
              </form>
                       
               </div>               
               </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              </div>
              <br>            
              <?php endif; ?>
              <div class="table-responsive" >
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No Seri</th>
                      <th>Nama Barang</th>
                      <th>Jenis Barang</th>
                      <th>Ruangan</th>                           
                      <th>Kondisi</th>    
                      <?php 
                      $level = $_SESSION['level'];
                      if($level == "admin") :?> 
                      <th>Aksi</th>    
                      <?php endif; ?>         
                    </tr>
                    
                  </thead>
             
                  <tbody>
                
                  <?php $i=1; ?>
                  <?php foreach($detail_barang as $detail) : ?>
                    <tr>
                      <td><?= $i ?></td>
                      <td><?= $detail["no_seri"];?> </td>
                      <td><?= $detail["nama_barang"];?> </td>
                      <td><?= $detail["jenis_barang"];?> </td>
                      <td><?= $detail["ruangan"];?> </td>                      
                      <td><?= $detail["kondisi"];?> </td>      
                      <?php 
                      $level = $_SESSION['level'];
                      if($level == "admin") :?>          
                      <td>                     
                      <a class="btn btn-primary " href="#"   data-placement="top" title="Keterangan Gambar" data-toggle="modal" data-target="#modal-lg_keterangan<?php echo $detail['no_seri']; ?>"> <i class="fa fa-info-circle" aria-hidden="true"></i></a>
                      
                      <!-- modal keterangan -->          
                      <div class="modal fade" id="modal-lg_keterangan<?php echo $detail['no_seri']; ?>">
                      <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                      <div class="modal-header">                
                      <h4 class="modal-title"><?php echo $detail['nama_barang']; ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <hr>
                        <?php if ($detail["gambar"]=="") : ?>
                        <div style="text-align: center;">
                        <img src="img/no_image.jpg"  style="width: 400px;"  class="img-fluid mb-2"alt="">
                        </div>
                        <?php else :?> 
                        <div style="text-align: center;">
                        <img src="img/<?= $detail["gambar"];?>"  style="width: 400px;"  class="img-fluid mb-2"alt="">
                        </div>
                        <?php endif; ?> 
                        <hr>
                        <?= $detail["keterangan"];?>                        
                        </div>
                        </div>
                        </div>
                       <!-- end modal keterangan -->
                       
                      <a class="fas fa-edit btn btn-success " href="ubah_detail.php?no_seri=<?php echo $detail['no_seri']; ?>" data-toggle="tooltip" data-placement="top" title="Edit Data Detail Barang"></a>
                      <a onclick="return confirm('Yakin ingin menghapus data ini')" href="hapus_detail.php?no_seri=<?php echo $detail['no_seri']; ?>" class="fas fa-trash-alt btn btn-danger"></a>                       
                      </td>      
                        <?php  endif;?>                
                    </tr>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
 

      </div>
      <!-- End of Main Content -->
     </div>
      <!-- Footer -->     
      <?php
      include 'footer.php';
      ?>
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
    <?php
      include 'logoutmodal.php';
      ?>


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

  <!-- Filterizr-->
  <script src="vendor/filterizr/jquery.filterizr.min.js"></script>
  <!-- Ekko Lightbox -->
  <script src="vendor/ekko-lightbox/ekko-lightbox.min.js"></script> 

 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js">
 </script>


  <script>
		    $(document).ready(function(){       	 
          $.ajax({
            		type: "POST",
            		url: "get_jenis.php",
                    cache: false, 
                   		success: function(msg){
                            $("#jenis_barang").html(msg);
                    		}
                        });
                    		
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


            $.ajax({
            		type: "POST",
            		url: "get_ruangan.php",
                    cache: false, 
                   		success: function(msg){
                            $("#ruangan").html(msg);
                    		}
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
