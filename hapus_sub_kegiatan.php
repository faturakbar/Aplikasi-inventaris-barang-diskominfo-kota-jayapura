<?php 

require 'functions.php';

$kode_sub_kegiatan= $_GET['kode_sub_kegiatan'];
if (hapus_sub_kegiatan ($kode_sub_kegiatan) >0) { 
	 echo "<script> 
				alert('Data Berhasil Dihapus!');
				document.location.href='data_sub_kegiatan.php';
			</script>";	
	} else {
		echo "<script> 
				alert('Data Gagal Dihapus!');
				document.location.href='data_sub_kegiatan.php';
			</script>";	
	}


 ?>