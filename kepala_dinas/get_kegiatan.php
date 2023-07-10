<?php 
 require 'functions.php';
 $program = $_POST['program'];
 
 echo "<option value=''>Pilih Kegiatan</option>";  
        //Perintah sql untuk menampilkan semua data pada tabel Program
        $kegiatan=tampil_data ("SELECT * FROM kegiatan WHERE kode_program ='$program'");	
         foreach ($kegiatan as $data ) {      
		echo "<option value='" . $data['kode_kegiatan'] . "'>" . $data['nama_kegiatan'] . "</option>";
        }
        
?>