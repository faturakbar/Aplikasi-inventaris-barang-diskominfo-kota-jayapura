  
   
   <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

        <!-- Heading -->
      <div class="sidebar-heading">
        Menu Utama
      </div>

      <!-- Nav Item - Pages Data Master Menu -->
      <?php 
      $level = $_SESSION['level'];
      
     
      if($level == "admin") :?>   
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#datamaster1" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-database"></i>
          <span>Data Master (Kegiatan)</span>
        </a>
        <div id="datamaster1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Data Master (Kegiatan):</h6>
          <a class="collapse-item" href="data_program.php">Data Program</a> 
          <a class="collapse-item" href="data_kegiatan.php">Data Kegiatan</a>
          <a class="collapse-item" href="data_sub_kegiatan.php">Data Sub Kegiatan</a>
          <a class="collapse-item" href="data_uraian.php">Data Uraian</a>           
        </div>
      </li> 

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#datamaster2" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-database"></i>
          <span>Data Master (Barang)</span>
        </a>
        <div id="datamaster2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Data Master (Barang):</h6>
          <a class="collapse-item" href="data_jenis.php">Data Jenis Barang</a>    
          <a class="collapse-item" href="data_ruangan.php">Data Ruangan</a>  
          <a class="collapse-item" href="data_barang.php">Data Barang</a>      
          </div>
        </div>
      </li> 


      
       <!-- Nav Item - Pages Data Transaksi Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#datatransaksi" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-list"></i>
          <span>Data Transaksi</span>
        </a>
        <div id="datatransaksi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Data Transaksi:</h6>
          <a class="collapse-item" href="data_inventaris.php">Data Inventaris</a>    
          </div>
        </div>
      </li>    
      <?php endif; ?>
      <?php 
      $level = $_SESSION['level'];
      if($level == "kepala"):?>        
      
       <!-- Nav Item - Pages Data Transaksi Menu -->
       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#datatransaksi" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-list"></i>
          <span>Data Transaksi</span>
        </a>

        <div id="datatransaksi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Data Transaksi:</h6>
          <a class="collapse-item" href="data_barang.php">Data Barang</a>    
          <a class="collapse-item" href="data_detail.php">Data Detail Barang</a>
          <a class="collapse-item" href="data_mutasi.php">Data Mutasi Barang</a>    
          <a class="collapse-item" href="data_pemutihan.php">Data Pemutihan</a>    

          </div>
        </div>
      </li>    
      <?php endif; ?>





      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
          <!-- Heading -->
          <div class="sidebar-heading">
        Logout
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="modal" data-target="#logoutModal"  aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2  "></i>
          <span>Logout</span>
        </a>
      </li>




      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->