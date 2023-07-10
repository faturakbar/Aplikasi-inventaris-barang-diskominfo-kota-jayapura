<?php 
 require 'functions.php';
 
 echo "<option value=''>Pilih Jenis Barang</option>";  
        //Perintah sql untuk menampilkan semua data pada tabel Jenis Barang
        $jenis_barang=tampil_data ("SELECT * FROM jenis_barang");	
         foreach ($jenis_barang as $data ) {      
		echo "<option value='" . $data['kode_jenis'] . "'>" . $data['jenis_barang'] . "</option>";
        }
        
?>