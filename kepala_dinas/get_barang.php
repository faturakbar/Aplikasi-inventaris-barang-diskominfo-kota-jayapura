<?php 
 require 'functions.php';
 $jenis_barang = $_POST['jenis_barang'];

	echo "<option value=''>Pilih Barang</option>";  
        //Perintah sql untuk menampilkan semua data pada tabel Barang
        $barang =tampil_data ("SELECT * FROM barang  WHERE kode_jenis = '$jenis_barang'");	    
      
         foreach ($barang as $data ) {      
                echo "<option value='" . $data['kode_barang'] . "'>" . $data['nama_barang'] . "</option>";
              
        }
        
?>