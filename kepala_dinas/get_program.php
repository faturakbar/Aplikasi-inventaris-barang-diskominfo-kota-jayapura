<?php 
 require 'functions.php';
 
 echo "<option value=''>Pilih Program</option>";  
        //Perintah sql untuk menampilkan semua data pada tabel Program
        $program=tampil_data ("SELECT * FROM program");	
         foreach ($program as $data ) {      
		echo "<option value='" . $data['kode_program'] . "'>" . $data['nama_program'] . "</option>";
        }
        
?>