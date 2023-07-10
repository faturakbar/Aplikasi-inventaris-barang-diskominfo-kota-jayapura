<?php 
 require 'functions.php';
 
 echo "<option value=''>Pilih Jenis Barang</option>";  
        //Perintah sql untuk menampilkan semua data pada tabel Jenis Barang
        $jenis_barang=tampil_data ("SELECT a.kode_inventaris,a.jumlah,a.tgl_pengadaan, 
                          b.nama_sub_kegiatan, c.nama_kegiatan, 
                          d.nama_program,
                          e.nama_barang, f.jenis_barang, f.kode_jenis
                          FROM inventaris a
                          JOIN sub_kegiatan b ON b.kode_sub_kegiatan = a.kode_sub_kegiatan
                          JOIN kegiatan c ON c.kode_kegiatan = b.kode_kegiatan
                          JOIN program d ON d.kode_program = c.kode_program
                          JOIN barang e ON e.kode_barang = a.kode_barang
                          JOIN jenis_barang f ON f.kode_jenis = e.kode_jenis
                          ORDER BY tgl_pengadaan ASC");     
         foreach ($jenis_barang as $data ) {      
              echo "<option value='" . $data['kode_jenis'] . "'>" . $data['jenis_barang'] . "</option>";
        }
        
?>