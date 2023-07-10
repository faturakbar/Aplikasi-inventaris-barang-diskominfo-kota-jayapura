<?php 
 require 'functions.php';
 $nama_barang = $_POST['nama_barang'];

	echo "<option value=''>Pilih No Seri</option>";  
        //Perintah sql untuk menampilkan semua data pada tabel Barang
        $barang =tampil_data ("SELECT * FROM detail_barang WHERE kode_barang = '$nama_barang'");	    
      
         foreach ($barang as $data ) {      
                echo "<option value='" . $data['no_seri'] . "'>" . $data['no_seri'] . "</option>";
              
        }
        
?>