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
$sumber=tampil_data ("SELECT * FROM sumber");	

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah berhasil di tambahkan atau tidak
 if (tambah_sumber ($_POST) > 0) {
 
 
   echo "<script> 
       alert('Data Berhasil Ditambahkan!');
       document.location.href='data_sumber.php';
     </script>";	
 } else {
   echo "<script> 
       alert('Data Gagal Ditambahkan!');
       document.location.href='data_sumber.php';
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
<?php 
// kode jenis barang  
$id = id_sumber ( "SELECT max(kode_sumber) as kodeTerbesar FROM sumber"); 
$kodesumber = $id['kodeTerbesar'];
// mengambil angka dari kode barang terbesar, menggunakan fungsi substr dan diubah ke integer dengan (int)
$urutan = (int) substr($kodesumber, 1, 1);
$urutan++;
$huruf = "0";
$kodesumber = $huruf . sprintf("%01s", $urutan); 
?>

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
          <h1 class="h3 mb-2 text-gray-800">Data Sumber Barang</h1>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Sumber</h6>
            </div>
          
            <div class="card-body">
            <div class="card-header  ">               
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                 Tambah Data Sumber Barang
                </button>
                 <div class="modal fade" id="modal-default">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Form Tambah Sumber Barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                   
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
           
                  <div class="form-group">             
                    <input type="hidden" name="kode_sumber"  value="<?php echo $kodesumber ?>" readonly required="required">
                    <label for="sumber">Sumber Barang</label>
                    <input type="text"  name="sumber" class="form-control" id="sumber" placeholder="Masukkan Sumber Barang" required="required">
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
                      <th>Sumber Barang</th>
                      <th>Aksi</th>             
                    </tr>
                    
                  </thead>
             
                  <tbody>
                  <?php $i=1; ?>
                  <?php foreach($sumber as $sum) : ?>

                    <tr>
                      <td><?= $i ?></td>
                      <td><?= $sum["sumber"];?> </td>
                      <td>
                      <a class="fas fa-edit btn btn-success " href="ubah_sumber.php?kode_sumber=<?php echo $sum['kode_sumber']; ?>" data-toggle="tooltip" data-placement="top" title="Edit data barang"></a>
                      <a onclick="return confirm('Yakin ingin menghapus data ini')" href="hapus_sumber.php?kode_sumber=<?php echo $sum['kode_sumber']; ?>" class="fas fa-trash-alt btn btn-danger"></a>
                      </td>
                    
                      
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

</body>

</html>
