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
error_reporting(0); 
$kode_inventaris_get = $_GET['kode_inventaris']; 
// Check data terakhir yang diinputkan  
  $kode_inventaris1=tampil_data ("SELECT kode_inventaris FROM detail_inventaris ORDER BY kode_inventaris  DESC LIMIT 1 ")[0]['kode_inventaris'];
 
// Check jumlah kode_inventaris yang sudah di inputkan di database
  $check = tampil_data("SELECT count(kode_inventaris) as num  FROM detail_inventaris
              WHERE kode_inventaris = '$kode_inventaris1'")[0]['num'];
  
  
  // Bandingkan Hasil 
   if ($kode_inventaris1 == $kode_inventaris_get ) {
     $kode_inventaris =  tampil_data ("SELECT kode_inventaris FROM detail_inventaris ORDER BY kode_inventaris  DESC LIMIT 1 ")[0]['kode_inventaris'];
    
   }  elseif ($kode_inventaris_get=="") {
      $kode_inventaris =   $kode_inventaris1; 
    }

    else {
      $kode_inventaris = $kode_inventaris_get;
 
    }

    $_SESSION['kode_inventaris'] = $kode_inventaris;
    
$detail_inventaris=tampil_data ("SELECT a.no_seri,a.kode_inventaris,a.kondisi, a.gambar,
                                  b.ruangan, d.nama_barang  FROM                             
                                  detail_inventaris  a 
                                  JOIN ruangan b  
                                  ON b.kode_ruangan = a.kode_ruangan
                                  JOIN inventaris c
                                  ON c.kode_inventaris = a.kode_inventaris
                                  JOIN barang d
                                  ON d.kode_barang = c.kode_barang
                                  WHERE a.kode_inventaris = '$kode_inventaris'
                                  ");
 
 

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah berhasil di tambahkan atau tidak
 if (tambah_detail_inventaris ($_POST) > 0) {

 
   echo "<script> 
       alert('Data Berhasil Ditambahkan!');
       document.location.href='data_detail_inventaris.php?kode_inventaris=$kode_inventaris_get';
     </script>";	
 } else {
   echo "<script> 
       alert('Data Gagal Ditambahkan!');
       document.location.href='data_inventaris.php?kode_inventaris=$kode_inventaris_get';
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
          <h1 class="h3 mb-2 text-gray-800">Data Detail Inventaris Barang</h1>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Detail Inventaris Barang</h6>
            </div>
          
            <div class="card-body">
            <div class="card-header  ">               
              
                <a  href="data_inventaris.php" name="close" class="btn btn-secondary">Data Inventaris</a>
                <button type="submit" name="cetak" class="btn btn-success" data-toggle="modal" data-target="#modal-cetak">Cetak</button>

                <!-- modal cetak berdasarkan -->
                <div class="modal fade" id="modal-cetak">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">

                          <h4 class="modal-title">Cetak Berdasarkan</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <!-- form start -->
                        <form action="filter_cetak_detail_inventaris.php" method="GET">
                          <div class="card-body">
                            <div class="form-group">
                              <label for="barang">Cetak Berdasarkan</label>
                              <select id="filter" class="form-control" name="cetak_berdasarkan" aria-label="Default select example" onclick="hasil()">
                                <option value="kode_inventaris1">Keseluruhan</option>
                                <option value="kode_ruangan">Ruangan</option>
                                <option value="kondisi">Kondisi</option>
                              </select>
                            </div>
                            <input hidden
                                 type="text" name="kode_inventaris" value="<?= $kode_inventaris_get; ?>"  >
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                            <button type="submit" name="cetak_filter" class="btn btn-success">Cetak</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end modal cetak berdasarkan -->


                 <div class="modal fade" id="modal-default">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Form Tambah Data Detail Inventaris Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                   
              <!-- form start -->
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
              <div class="form-group">               
                    <label for="kode_inventaris">Kode Inventaris</label>
                    <input type="text"  name="kode_inventaris" class="form-control" id="no_seri"  value="<?= $kode_inventaris; ?>" readonly    >
                </div> 

               <div class="form-group">               
                    <label for="no_seri">No Seri</label>
                    <input type="text"  name="no_seri" class="form-control" id="no_seri" placeholder="Masukkan No Seri Barang" autocomplete="off">
                </div> 
                
                  <div class="form-group">               
                    <label for="ruangan">Ruangan</label>
                    <select name="ruangan" id="ruangan" class="form-control">
                    <option  >--Pilih Ruangan--</option>
                    </select>
                </div> 

                 <div class="form-group">               
                    <label for="kondisi">Kondisi</label>
                     <div class="form-check">
                      <input class="form-check-input" type="radio" name="kondisi" id="flexRadioDefault1" value="Layak Pakai">
                      <label class="form-check-label" for="flexRadioDefault1">
                        Layak Pakai
                      </label>                      
                    </div>
                     <div class="form-check">
                      <input class="form-check-input" type="radio" name="kondisi" id="flexRadioDefault1" value="Rusak">
                      <label class="form-check-label" for="flexRadioDefault1">
                        Rusak
                      </label>                      
                    </div>
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
  
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No Seri</th>
                       <th>Kode Inventaris</th>
                       <th>Nama Barang</th>
                       <th>Ruangan</th>
                      <th>Kondisi</th>
                      <th>Gambar</th>
                      
                    </tr>
                    
                  </thead>
             
                  <tbody>
                  <?php $i=1; ?>
                  <?php foreach($detail_inventaris as $data_detail_inventaris) : ?>

                    <tr>
                      <td><?= $i ?></td>
                      <td><?= $data_detail_inventaris["no_seri"];?> </td>
                      <td><?= $data_detail_inventaris["kode_inventaris"];?> </td>
                      <td><?= $data_detail_inventaris["nama_barang"];?> </td>
                      <td><?= $data_detail_inventaris["ruangan"];?> </td>
                      <td><?= $data_detail_inventaris["kondisi"];?> </td>
                     
                      <td>
                        <a class="btn btn-primary " href="#" type="button"     data-placement="top" title="Info Gambar" data-toggle="modal" data-target="#modal-lg_gambar<?php echo $data_detail_inventaris['no_seri']; ?>">Info Gambar</a>
                       </td>  
                        
                      <!-- modal gambar -->          
                      <div class="modal fade" id="modal-lg_gambar<?php echo $data_detail_inventaris['no_seri']; ?>">
                      <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                      <div class="modal-header">  

                      <h4 class="modal-title"><?php echo $data_detail_inventaris['nama_barang'];
                      ?> <?php echo " ";
                      ?>(<?php echo $data_detail_inventaris['no_seri'];
                      ?>)</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <hr>
                        <?php if ($data_detail_inventaris["gambar"]=="") : ?>
                          <div style="text-align: center;">
                          <img src="../img/no_image.jpg"  style="width: 400px;"  class="img-fluid mb-2"alt="">
                          </div>
                        <?php else :?> 
                          <div style="text-align: center;">
                          <img src="../img/<?= $data_detail_inventaris["gambar"];?>"  style="width: 250px;"  class="img-fluid mb-2"alt="">
                           </div>
                        <?php endif; ?>  
                        <hr>
                                                
                        </div>
                        </div>
                        </div>
                       <!-- end modal gambar -->
                      
                  
                    
                      
                    </tr>
                    <?php $i++ ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div> </div> </div> </div>
 
 
      </div>
      <!-- End of Main Content -->

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

  <script  type="text/javascript">
        $(document).ready(function(){          
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
