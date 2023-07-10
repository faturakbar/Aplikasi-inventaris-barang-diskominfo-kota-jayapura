<?php 
 require 'functions.php';
 
 echo "<option value=''>Pilih Uraian</option>";  
        //Perintah sql untuk menampilkan semua data pada tabel Jenis Barang
        $uraian=tampil_data ("SELECT * FROM uraian");	
         foreach ($uraian as $data ) {      
		echo "<option value='" . $data['kode_rekening'] . "'>" . $data['uraian'] . "</option>";
        }
        
?>