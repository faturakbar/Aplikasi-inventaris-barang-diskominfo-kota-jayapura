<?php 
 require 'functions.php';
  

 echo "<option value=''>Pilih Sub Kegiatan</option>";  
        //Perintah sql untuk menampilkan semua data pada tabel Program
        $sub_kegiatan=tampil_data ("SELECT * FROM sub_kegiatan   ");	
         foreach ($sub_kegiatan as $data ) {      
		echo "<option value='" . $data['kode_sub_kegiatan'] . "'>" . $data['nama_sub_kegiatan'] . "</option>";
        }
        
?>