<?php 
 require 'functions.php';
 

	echo "<option value=''>Pilih Barang</option>";  
        //Perintah sql untuk menampilkan semua data pada tabel Barang
        $barang =tampil_data ("SELECT * FROM barang  ");	    
      
         foreach ($barang as $data ) {      
                echo "<option value='" . $data['kode_barang'] . "'>" . $data['nama_barang'] . "</option>";
              
        }
        
?>