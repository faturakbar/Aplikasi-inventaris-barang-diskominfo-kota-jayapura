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

$uraian=tampil_data ("SELECT * FROM uraian ORDER BY kode_rekening");	

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah berhasil di tambahkan atau tidak
 if (tambah_uraian($_POST) > 0) {

 
   echo "<script> 
       alert('Data Berhasil Ditambahkan!');
       document.location.href='data_uraian.php';
     </script>";	
 } else {
   echo "<script> 
       alert('Data Gagal Ditambahkan!');
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

  <title>Sistem Informasi Inventaris Barang Diskominfo Kota Jayapura</title>

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
// kode program  
$id = id ( "SELECT max(kode_program) as kodeTerbesar FROM program"); 
$kodeProgram = $id['kodeTerbesar'];
// mengambil angka dari kode barang terbesar, menggunakan fungsi substr dan diubah ke integer dengan (int)
$urutan = (int) substr($kodeProgram, 1, 1);
$urutan++;
$huruf = "J";
$kodeProgram= $huruf . sprintf("%01s", $urutan); 
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
          <h1 class="h3 mb-2 text-gray-800">Data Uraian</h1>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Uraian</h6>
            </div>
          
            <div class="card-body">
            <div class="card-header  ">               
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                 Tambah Data Uraian
                </button>
                 <div class="modal fade" id="modal-default">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Form Tambah Data Uraian</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                   
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
           
               <div class="form-group">               
                    <label for="kode_rekening">Kode Rekening</label>
                    <table>
                      <td>
                              <input style="width: 100px;" type="text"  name="kode_rekening1" class="form-control" id="kode_program" required="required" autocomplete="off" >
                      </td>
                      <td></td><td></td>
                       <td>
                              <input style="width: 100px;" type="text"  name="kode_rekening2" class="form-control" id="kode_program" required="required" autocomplete="off" >
                      </td>
                      <td></td><td></td>
                       <td>
                              <input style="width: 100px;" type="text"  name="kode_rekening3" class="form-control" id="kode_program"  required="required"autocomplete="off" >
                      </td>
                       <td></td><td></td>
                       <td>
                              <input style="width: 100px;" type="text"  name="kode_rekening4" class="form-control" id="kode_program"  required="required"autocomplete="off" >
                      </td>

                      <td></td><td></td>
                       <td>
                              <input style="width: 100px;" type="text"  name="kode_rekening5" class="form-control" id="kode_program"  required="required"autocomplete="off" >
                      </td>
                       <td></td><td></td>
                       <td>
                              <input style="width: 100px;" type="text"  name="kode_rekening6" class="form-control" id="kode_program"  required="required"autocomplete="off" >
                      </td>


                    </table>

                
                </div>   
        
                   
                <div class="form-group">    
                    <label for="program">Uraian</label>
                    <input type="text"  name="uraian" class="form-control" id="program" placeholder="Masukkan Uraian" required="required" autocomplete="off">
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
                       <th>Kode Rekening</th>
                      <th>Uraian</th>                      
                      <th style="text-align:center;">Edit</th>
                      <th style="text-align:center;">Hapus</th>   

                    </tr>
                    
                  </thead>
             
                  <tbody>
                  <?php $i=1; ?>
                  <?php foreach($uraian as $data_uraian) : ?>

                    <tr>
                      <td><?= $i ?></td>
                      <td><?= $data_uraian["kode_rekening"];?> </td>
                      <td><?= $data_uraian["uraian"];?> </td>                      
                      <td style="text-align: center;">
                      <a class="fas fa-edit btn btn-success " href="ubah_uraian.php?kode_rekening=<?php echo $data_uraian['kode_rekening']; ?>" data-toggle="tooltip" data-placement="top" title="Edit data uraian"></a>
                       </td><td style="text-align: center;">
                      <a onclick="return confirm('Yakin ingin menghapus data ini')" href="hapus_uraian.php?kode_rekening=<?php echo $data_uraian['kode_rekening']; ?>" class="fas fa-trash-alt btn btn-danger"></a></td>
                     
                    
                      
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


</body>

</html>