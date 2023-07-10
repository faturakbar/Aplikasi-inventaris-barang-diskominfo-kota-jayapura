<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
require 'functions.php';

$barang=tampil_data ("SELECT * FROM barang JOIN jenis_barang ON barang.kode_jenis = 
                      jenis_barang.kode_jenis JOIN uraian ON barang.kode_rekening = 
                      uraian.kode_rekening ORDER BY kode_barang");	


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah berhasil di tambahkan atau tidak
 if (tambah_barang ($_POST) > 0) {

 
   echo "<script> 
       alert('Data Berhasil Ditambahkan!');
       document.location.href='data_barang.php';
     </script>";	
 } else {
   echo "<script> 
       alert('Data Gagal Ditambahkan!');
       document.location.href='data_barang.php';
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

 


<?php 
// kode jenis barang  
$id = id ("SELECT max(kode_barang) as kodeTerbesar FROM barang"); 
$kodeBarang = $id['kodeTerbesar'];
 
// mengambil angka dari kode barang terbesar, menggunakan fungsi substr dan diubah ke integer dengan (int)
$urutan = (int) substr($kodeBarang, 3, 3);
$urutan++;
$huruf = "BRG";
$kodeBarang = $huruf . sprintf("%03s", $urutan); 


?>


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
          <h1 class="h3 mb-2 text-gray-800">Data Barang</h1>
    
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
            </div>
          
            <div class="card-body">
            <?php 
              $level = $_SESSION['level'];
              if($level == "admin") :?>  
               <div class="card-header  ">      
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                 Tambah Data Barang
                </button>
                 <div class="modal fade" id="modal-lg">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Form Tambah Barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                   
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">      
                 <div class="form-group">               
                    <label for="kode_barang">Kode Barang</label>
                    <input type="text"  name="kode_barang" class="form-control" id="kode_barang" placeholder="Masukkan Kode Barang"  value="<?= $kodeBarang; ?>" readonly>
                </div>       
                <div class="form-group">               
                    <label for="jenis_barang">Jenis Barang</label>
                    <select name="jenis_barang" id="jenis_barang" class="form-control">                                     
                    </select>                    
                </div>  
                <div class="form-group">               
                    <label for="uraian">Uraian</label>
                    <select name="uraian" id="uraian" class="form-control">                                    
                    </select>                    
                </div>  
                 <div class="form-group">               
                    <label for="Satuan">Satuan</label>
                    <select name="satuan" id="" class="form-control" required="required">
                          <option value="Unit">Unit</option>
                          <option value="Buah">Buah</option>
                          <option value="Pcs">Pcs</option>
                          <option value="Pak">Pak</option>
                    </select>
                </div>
                 <div class="form-group">               
                    <label for="tipe">Tipe</label>
                    <input type="text"  name="tipe" class="form-control" id="tipe" placeholder="Masukkan Tipe Barang" required="required" autocomplete="off" >
                </div>
                <div class="form-group">               
                    <label for="merek">Merek</label>
                    <input type="text"  name="merek" class="form-control" id="merek" placeholder="Masukkan Merek Barang" required="required" autocomplete="off" >
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
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                  <thead > 
                    <tr>
                      <th >No</th>
                      <th >Kode Barang</th>
                      <th>Jenis Barang</th>
                      <th>Nama Barang</th>
                      <th>Uraian</th>                      
                      <th >Satuan</th>                      
                      <th>Tipe</th>
                      <th>Merek</th>
                      <?php 
                      $level = $_SESSION['level'];
                      if($level == "admin") :?>                        
                      <th>Aksi</th>   
                      <?php endif; ?>          
                    </tr>                    
                  </thead>
             
                  <tbody>
                  <?php $i=1; ?>
                  <?php foreach($barang as $bar) : ?>
                    <tr>
                      <td ><?= $i ?></td>
                      <td ><?= $bar["kode_barang"];?> </td>
                      <td><?= $bar["jenis_barang"];?> </td>
                       <td><?= $bar["nama_barang"];?> </td> 
                      <td><?= $bar["uraian"];?> </td>  
                      <td><?= $bar["satuan"];?> </td>                        
                      <td><?= $bar["tipe"];?> </td>
                      <td><?= $bar["merek"];?> </td>
                      <?php 
                      $level = $_SESSION['level'];
                      if($level == "admin") :?>  
                      <td width="13%">
                      <a class="fas fa-edit btn btn-success " href="ubah_barang.php?kode_barang=<?php echo $bar['kode_barang']; ?>" data-toggle="tooltip" data-placement="top" title="Edit data barang"></a>
                      <a onclick="return confirm('Yakin ingin menghapus data ini')" href="hapus_barang.php?kode_barang=<?php echo $bar['kode_barang']; ?>" class="fas fa-trash-alt btn btn-danger"title="Hapus Data Barang"></a>
                      </td>            
                      <?php endif; ?>  
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

    <script
src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js">
</script>


  <script  type="text/javascript">
		    $(document).ready(function(){       	 
        		$.ajax({
            		type: "POST",
            		url: "get_jenis.php",
                    cache: false, 
                   		success: function(msg){
                            $("#jenis_barang").html(msg);                                                                             
                    		}
                        });                    
            $.ajax({
            		type: "POST",
            		url: "get_uraian.php",
                    cache: false, 
                   		success: function(msg){
                            $("#uraian").html(msg);
                    		}
                        });                       
        });

	</script>
</body>

</html>
