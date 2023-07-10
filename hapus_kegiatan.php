<?php 

require 'functions.php';

$kode_kegiatan= $_GET['kode_kegiatan'];
if (hapus_kegiatan ($kode_kegiatan) >0) { 
	 echo "<script> 
				alert('Data Berhasil Dihapus!');
				document.location.href='data_kegiatan.php';
			</script>";	
	} else {
		echo "<script> 
				alert('Data Gagal Dihapus!');
				document.location.href='data_kegiatan.php';
			</script>";	
	}


 ?>