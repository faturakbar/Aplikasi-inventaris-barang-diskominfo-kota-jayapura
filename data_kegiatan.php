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

$kegiatan=tampil_data ("SELECT * FROM kegiatan JOIN program ON kegiatan.kode_program = program.kode_program
                        ORDER BY kode_kegiatan");	

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah berhasil di tambahkan atau tidak
 if (tambah_kegiatan($_POST) > 0) {

 
   echo "<script> 
       alert('Data Berhasil Ditambahkan!');
       document.location.href='data_kegiatan.php';
     </script>";	
 } else {
   echo "<script> 
       alert('Data Gagal Ditambahkan!');
       document.location.href='data_kegiatan.php';
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
          <h1 class="h3 mb-2 text-gray-800">Data Kegiatan</h1>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Kegiatan</h6>
            </div>
          
            <div class="card-body">
            <div class="card-header  ">               
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                 Tambah Data Kegiatan
                </button>
                 <div class="modal fade" id="modal-default">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Form Tambah Data Kegiatan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                   
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
           
               <div class="form-group">               
                    <label for="kode_kegiatan">Kode Kegiatan</label>
                   
                              <input   type="text"  name="kode_kegiatan1" class="form-control" id="kode_program" required="required" autocomplete="off" >
                     
                 
                
                </div>   

                     

                <div class="form-group">               
                    <label for="program">Nama Program</label>
                    <select name="program" id="program" class="form-control">
                    <option  >--Pilih--</option>
                    </select>
                </div>             
                   
                <div class="form-group">    
                    <label for="program">Nama Kegiatan</label>
                    <input type="text"  name="nama_kegiatan" class="form-control" id="program" placeholder="Masukkan Nama Kegiatan" required="required" autocomplete="off">
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
                       <th>Kode Kegiatan</th>
                      <th>Nama Program</th>
                      <th>Nama Kegiatan</th>
                      <th style="text-align:center;">Edit</th>
                      <th style="text-align:center;">Hapus</th>          

                    </tr>
                    
                  </thead>
             
                  <tbody>
                  <?php $i=1; ?>
                  <?php foreach($kegiatan as $data_kegiatan) : ?>

                    <tr>
                      <td><?= $i ?></td>
                      <td><?= $data_kegiatan["kode_kegiatan"];?> </td>
                      <td><?= $data_kegiatan["nama_program"];?> </td>
                      <td><?= $data_kegiatan["nama_kegiatan"];?> </td>
                      <td>
                      <a class="fas fa-edit btn btn-success " href="ubah_kegiatan.php?kode_kegiatan=<?php echo $data_kegiatan['kode_kegiatan']; ?>" data-toggle="tooltip" data-placement="top" title="Edit data kegiatan"></a>
                       </td><td>
                      <a onclick="return confirm('Yakin ingin menghapus data ini')" href="hapus_kegiatan.php?kode_kegiatan=<?php echo $data_kegiatan['kode_kegiatan']; ?>" class="fas fa-trash-alt btn btn-danger"></a></td>
                     
                    
                      
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
