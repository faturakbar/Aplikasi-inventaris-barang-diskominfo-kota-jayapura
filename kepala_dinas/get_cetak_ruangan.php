<?php 
 require 'functions.php';
 
 

	echo "<option value=''>Pilih Ruangan</option>";  
        //Perintah sql untuk menampilkan semua data pada tabel Jenis Barang
        $ruangan=tampil_data ("SELECT a.no_seri,a.kode_inventaris,a.kondisi, a.gambar,
                                  b.ruangan, d.nama_barang  FROM                             
                                  detail_inventaris  a 
                                  JOIN ruangan b  
                                  ON b.kode_ruangan = a.kode_ruangan
                                  JOIN inventaris c
                                  ON c.kode_inventaris = a.kode_inventaris
                                  JOIN barang d
                                  ON d.kode_barang = c.kode_barang
                                 
                                  ");	
         foreach ($ruangan as $data ) {      
		echo "<option value='" . $data['kode_ruangan'] . "'>" . $data['ruangan'] . "</option>";
        }
        
?>