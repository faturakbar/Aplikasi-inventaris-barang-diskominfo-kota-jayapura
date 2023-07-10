<?php 
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
?>

     
            <h4 style="    font-weight: bolder; font-family: Arial, Helvetica, sans-serif; position: relative;
            top:10px; left: 20px; word-spacing: 0.25em; ">

                <img src="img/kota_jayapura.png" alt="" style="width:30px; position: relative;
            top:-3px; ">
          Sistem Informasi Inventaris Barang Diskominfo Kota Jayapura 
       
              
              <img src="img/diskominfo.png" alt="" style="width:35px; position: relative;
            top:-3px; ">
            </h4>
            
<!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username']; ?></span>
                <img class="img-profile rounded-circle" src="img/kepala_dinas.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              
                
          
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->