<?php 
 require 'functions.php';
 
	echo "<option value=''>Pilih Ruangan</option>";  
        //Perintah sql untuk menampilkan semua data pada tabel Jenis Barang
        $ruangan=tampil_data ("SELECT * FROM ruangan ORDER BY ruangan ASC");	
         foreach ($ruangan as $data ) {      
		echo "<option value='" . $data['kode_ruangan'] . "'>" . $data['ruangan'] . "</option>";
        }
        
?>