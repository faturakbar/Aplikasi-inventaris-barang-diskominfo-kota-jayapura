<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
} 
require 'functions.php';

$mutasi_barang=tampil_data ("SELECT a.*, d.no_seri, e.nama_barang, f.jenis_barang,
                             b.ruangan as r_awal,c.ruangan as r_tujuan FROM mutasi a 
                             JOIN ruangan b ON a.kode_ruangan_awal = b.kode_ruangan 
                             JOIN ruangan c ON a.kode_ruangan_tujuan = c.kode_ruangan 
                             JOIN detail_barang d ON d.no_seri = a.no_seri
                             JOIN barang e  ON d.kode_barang = e.kode_barang
                             JOIN jenis_barang f  ON e.kode_jenis = f.kode_jenis                      
                              ");	   
 
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah berhasil di tambahkan atau tidak
 if (tambah_mutasi ($_POST) > 0) {

 
   echo "<script> 
       alert('Data Berhasil Ditambahkan!');
       document.location.href='data_mutasi.php';
     </script>";	
 } else {
   echo "<script> 
       alert('Data Gagal Ditambahkan!');
       document.location.href='data_mutasi.php';
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
<?php 
// kode mutasi barang  
$id = id ( "SELECT max(kode_mutasi) as kodeTerbesar FROM mutasi "); 
$kodeMutasi= $id['kodeTerbesar'];
// mengambil angka dari kode barang terbesar, menggunakan fungsi substr dan diubah ke integer dengan (int)
$urutan = (int) substr($kodeMutasi, 1, 1);
$urutan++;
$huruf = "M";
$kodeMutasi = $huruf . sprintf("%01s", $urutan); 
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
          <h1 class="h3 mb-2 text-gray-800">Data Mutasi Barang</h1>
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Mutasi Barang</h6>
            </div>
          
            <div class="card-body">
            <?php 
              $level = $_SESSION['level'];
              if($level == "admin") :?> 
            <div class="card-header  ">               
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                 Tambah Data Mutasi Barang
                </button>
                 <div class="modal fade" id="modal-default">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Form Tambah Mutasi Barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                   
              <!-- form start -->
              <form action="" method="post">
                <div class="card-body">
            
                    <input type="hidden" name="kode_mutasi"  value="<?php echo $kodeMutasi ?>" readonly required="required">
             
                  <div class="form-group">               
                    <label for="jenis_barang">Jenis Barang</label>
                    <select name="jenis_barang" id="jenis_barang" class="form-control" required="required">     
                    <option  >--Pilih--</option>                        
                    </select>                    
                 </div> 
                 <div class="form-group">               
                    <label for="nama_barang">Nama Barang</label>
                    <select name="nama_barang" id="nama_barang" class="form-control" required="required" >     
                    <option  >--Pilih--</option>      
       
                    </select>                    
                </div>  
                <div class="form-group">               
                    <label for="no_seri">No Seri</label>
                    <select name="no_seri" id="no_seri" class="form-control" required="required" onchange="changeValue(this.value)">     
                    <option  >--Pilih--</option>      
                    <?php 
                    $detail= tampil_data("SELECT * FROM detail_barang INNER JOIN ruangan ON detail_barang.kode_ruangan = ruangan.kode_ruangan");
                    $jsArray = "var prdName = new Array();\n";
                   
                    foreach ($detail as $data) {              
               
                      $jsArray .= "prdName['" . $data['no_seri'] . "'] = {ruangan_awal:'" . addslashes($data['ruangan']) .  "', kode_ruangan_awal:'".addslashes($data['kode_ruangan'])."' };\n";

                    }
                    ?>                  
                    </select>                    
                </div>  
                <div class="form-group">               
                    <label for="ruangan_awal">Ruangan Awal</label>
                    <input type="text" class="form-control" id="ruangan_awal" name="ruangan_awal" readonly>  
                    <input type="hidden" class="form-control" id="kode_ruangan_awal" name="ruangan_awal" readonly>                        
                </div>  
                <div class="form-group">               
                    <label for="ruangan_tujuan">Ruangan Tujuan</label>
                    <select name="ruangan_tujuan" id="ruangan" class="form-control" required="required" >     
                    <option  >--Pilih--</option>             
                    </select>                    
                </div>  
                <div class="form-group ui-widget">               
                    <label for="tgl_mutasi">Tanggal Mutasi</label>
                    <input type="date" name="tgl_mutasi" class="tm form-control" id="tgl_mutasi" required="required">                     
                    </div>    


                </div>  
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Mutasikan</button>
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>                   
                      <th>No Seri</th>
                      <th>Jenis Barang</th>                       
                      <th>Nama Barang</th>                       
                      <th>Ruangan Awal</th>                      
                      <th>Ruangan Tujuan</th>
                      <th>Tanggal Mutasi</th>
                      <?php 
                      $level = $_SESSION['level'];
                      if($level == "admin") :?>                              
                      <th>Aksi</th>    
                      <?php endif; ?>                          
                    </tr>                    
                  </thead>
             
                  <tbody>
                  <?php $i=1; ?>
                   
                  <?php foreach ($mutasi_barang AS $mutasi ) : ?>               
                    <tr>
                      <td><?= $i ?></td>
                      <td><?= $mutasi["no_seri"];?> </td>
                      <td><?= $mutasi["jenis_barang"]; ?></td>
                      <td><?= $mutasi["nama_barang"];?> </td>                       
                      <td><?= $mutasi["r_awal"];?> </td>
                      <td><?= $mutasi["r_tujuan"];?> </td>
                      <td><?= tgl_indo($mutasi["tgl_mutasi"]);?> </td>
                      <?php 
                      $level = $_SESSION['level'];
                      if($level == "admin") :?> 
                      <td>
                       <a onclick="return confirm('Yakin ingin menghapus data ini')" href="hapus_mutasi.php?kode_mutasi=<?php echo $mutasi['kode_mutasi']; ?>" class="fas fa-trash-alt btn btn-danger"></a>
                      </td>       
                      <?php endif; ?>            
                    </tr>               
                     <?php $i++ ?>                    
                     <?php endforeach;?>                   
                  </tbody>
                </table>
              </div>
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

            $("#nama_barang").change(function(){
      	var nama_barang = $("#nama_barang").val();
          	$.ajax({
          		type: "POST",
              	url: "get_no_seri.php",
              	data: {nama_barang: nama_barang},
              	cache: false,
              	success: function(msg){
                  $("#no_seri").html(msg);
                }
            });


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

<script type="text/javascript">    
    <?php echo $jsArray; ?>  
  
    function changeValue(x){  
    document.getElementById('ruangan_awal').value = prdName[x].ruangan_awal;
    document.getElementById('kode_ruangan_awal').value = prdName[x].kode_ruangan_awal;
    };  
    </script> 

    
    


</body>

</html>
