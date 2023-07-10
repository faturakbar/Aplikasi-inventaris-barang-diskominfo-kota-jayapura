<?php 
 require 'functions.php';
 $kegiatan= $_POST['kegiatan'];

 echo "<option value=''>Pilih Sub Kegiatan</option>";  
        //Perintah sql untuk menampilkan semua data pada tabel Program
        $sub_kegiatan=tampil_data ("SELECT * FROM sub_kegiatan WHERE kode_kegiatan ='$kegiatan'");	
         foreach ($sub_kegiatan as $data ) {      
		echo "<option value='" . $data['kode_sub_kegiatan'] . "'>" . $data['nama_sub_kegiatan'] . "</option>";
        }
        
?>