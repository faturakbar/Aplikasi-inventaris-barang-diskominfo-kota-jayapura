<?php 
 require 'functions.php';
	echo "<option value=''>Pilih sumber</option>";  
        //Perintah sql untuk menampilkan semua data pada tabel Jenis Barang
        $sumber=tampil_data ("SELECT * FROM sumber");	
         foreach ($sumber as $data ) {      
		echo "<option value='" . $data['kode_sumber'] . "'>" . $data['sumber'] . "</option>";
	}
?>