<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
if ($_SESSION['level'] == "kepala") {
  header("Location: index.php");
  exit;
}
require 'functions.php';


 

$inventaris = tampil_data("SELECT a.kode_inventaris,a.jumlah,a.tgl_pengadaan, 
                          b.nama_sub_kegiatan, c.nama_kegiatan, 
                          d.nama_program,
                          e.nama_barang, f.jenis_barang
                          FROM inventaris a
                          JOIN sub_kegiatan b ON b.kode_sub_kegiatan = a.kode_sub_kegiatan
                          JOIN kegiatan c ON c.kode_kegiatan = b.kode_kegiatan
                          JOIN program d ON d.kode_program = c.kode_program
                          JOIN barang e ON e.kode_barang = a.kode_barang
                          JOIN jenis_barang f ON f.kode_jenis = e.kode_jenis
                          ORDER BY tgl_pengadaan ASC");


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

  // cek apakah berhasil di tambahkan atau tidak
  if (tambah_inventaris($_POST) > 0) {


    echo "<script> 
       alert('Data Berhasil Ditambahkan!');
       document.location.href='data_inventaris.php';
     </script>";
  } else {
    echo "<script> 
       alert('Data Gagal Ditambahkan!');
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
  <link href="css/style.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
  <?php
  // kode Inventaris  
  $id = id("SELECT max(kode_inventaris) as kodeTerbesar FROM inventaris");

  $kodeInventaris = $id['kodeTerbesar'];

  // mengambil angka dari kode barang terbesar, menggunakan fungsi substr dan diubah ke integer dengan (int)
  $urutan = (int) substr($kodeInventaris, 11, 11);
  $urutan++;
  $huruf = "inv-kominf-";
  $kodeInventaris = $huruf . sprintf("%03s", $urutan);

  ?>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- sidebar -->
    <?php
    include 'sidebar.php'
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
          include 'topnavbar.php'
          ?>
          <!-- end top navbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Data Inventaris Barang</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Inventaris Barang</h6>
              </div>

              <div class="card-body">
                <div class="card-header  ">
                
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
                        <form action="filter_cetak_inventaris.php" method="GET">
                          <div class="card-body">
                            <div class="form-group">
                              <label for="barang">Cetak Berdasarkan</label>
                              <select id="filter" class="form-control" name="cetak_berdasarkan" aria-label="Default select example" onclick="hasil()">
                                <option selected>Cetak Berdasarkan</option>
                                <option value="kode_jenis">Jenis Barang</option>
                                <option value="kode_barang">Nama Barang</option>
                                <option value="kode_program">Program</option>
                                <option value="kode_sub_kegiatan">Sub Kegiatan</option>
                                <option value="tgl_pengadaan">Tanggal Pengadaan</option>
                              </select>
                            </div>
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
                        <h4 class="modal-title">Form Tambah Data Inventaris Barang</h4>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>



                      <!-- form start -->
                      <form action="" method="post">
                        <div class="card-body">

                          <div class="form-group">
                            <label for="kode_inventaris">Kode Inventaris</label>
                            <input type="text" name="kode_inventaris" class="form-control" id="kode_inventaris" placeholder="Masukkan Kode Inventaris" value="<?= $kodeInventaris; ?>" readonly>
                          </div>
                          <div class="form-group">
                            <label for="jenis_barang">Jenis Barang</label>
                            <select name="jenis_barang" id="jenis_barang" class="form-control">
                              <option>--Pilih Jenis Barang--</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="barang">Nama Barang</label>
                            <select name="barang" id="barang" class="form-control">
                              <option>--Pilih Barang--</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="program">Program</label>
                            <select name="program" id="program" class="form-control">
                              <option>--Pilih Program--</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="kegiatan">Nama Kegiatan</label>
                            <select name="kegiatan" id="kegiatan" class="form-control">
                              <option>--Pilih Kegiatan--</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="sub_kegiatan">Nama Sub Kegiatan</label>
                            <select name="sub_kegiatan" id="sub_kegiatan" class="form-control">
                              <option>--Pilih Sub Kegiatan--</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="program">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" id="program" value=1 required="required" autocomplete="off">
                          </div>

                          <div class="form-group ui-widget">
                            <label for="tgl_pengadan">Tanggal Pengadaan</label>
                            <input type="date" name="tgl_pengadaan" class="tm form-control" id="tgl_pengadaan" required="required">
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
                      <th>Kode Inventaris</th>
                      <th>Jenis Barang</th>
                      <th>Nama Barang</th>
                      <th>Program</th>
                      <th>Sub Kegiatan</th>
                      <th>Jumlah</th>
                      <th>Tanggal Pengadaan</th>
                      <th style="text-align: center;"> Detail</th>
                     
                    </tr>

                  </thead>

                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($inventaris as $data_inventaris) : ?>

                      <tr>
                        <td><?= $i ?></td>
                        <td><?= $data_inventaris["kode_inventaris"]; ?> </td>
                        <td><?= $data_inventaris["jenis_barang"]; ?> </td>
                        <td><?= $data_inventaris["nama_barang"]; ?> </td>
                        <td><?= $data_inventaris["nama_program"]; ?> </td>
                        <td><?= $data_inventaris["nama_sub_kegiatan"]; ?> </td>
                        <td><?= $data_inventaris["jumlah"]; ?> </td>
                        <td><?= tgl_indo($data_inventaris["tgl_pengadaan"]); ?> </td>

                        <td>
                          <a class="fas fa-folder btn btn-secondary " href="data_detail_inventaris.php?kode_inventaris=<?php echo $data_inventaris['kode_inventaris']; ?>" data-toggle="tooltip" data-placement="top" title="Detail Data inventaris"></a>

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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js">
  </script>


  <script type="text/javascript">
    $(document).ready(function() {
      $.ajax({
        type: "POST",
        url: "get_jenis.php",
        cache: false,
        success: function(msg) {
          $("#jenis_barang").html(msg);
        }
      });
      $("#jenis_barang").change(function() {
        var jenis_barang = $("#jenis_barang").val();
        $.ajax({
          type: 'POST',
          url: "get_barang.php",
          data: {
            jenis_barang: jenis_barang
          },
          cache: false,
          success: function(msg) {
            $("#barang").html(msg);
          }
        });
      });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $.ajax({
        type: "POST",
        url: "get_program.php",
        cache: false,
        success: function(msg) {
          $("#program").html(msg);
        }
      });
      $("#program").change(function() {
        var program = $("#program").val();
        $.ajax({
          type: 'POST',
          url: "get_kegiatan.php",
          data: {
            program: program
          },
          cache: false,
          success: function(msg) {
            $("#kegiatan").html(msg);
          }
        });
      });
      $("#kegiatan").change(function() {
        var kegiatan = $("#kegiatan").val();
        $.ajax({
          type: 'POST',
          url: "get_sub_kegiatan.php",
          data: {
            kegiatan: kegiatan
          },
          cache: false,
          success: function(msg) {
            $("#sub_kegiatan").html(msg);
          }
        });
      });
    });
  </script>



</body>

</html>