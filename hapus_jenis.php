<?php 

require 'functions.php';

$kode_jenis= $_GET['kode_jenis'];
if (hapus ($kode_jenis) >0) {
	 echo "<script> 
				alert('Data Berhasil Dihapus!');
				document.location.href='data_jenis.php';
			</script>";	
	} else {
		echo "<script> 
				alert('Data Gagal Dihapus!');
				document.location.href='data_jenis.php';
			</script>";	
	}


 ?>