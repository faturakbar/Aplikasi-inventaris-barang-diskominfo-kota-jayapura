<?php 

require 'functions.php';

$kode_inventaris= $_GET['kode_inventaris'];
if (hapus_inventaris ($kode_inventaris) >0) {
	 echo "<script> 
				alert('Data Berhasil Dihapus!');
				document.location.href='data_inventaris.php';
			</script>";	
	} else {
		echo "<script> 
				alert('Data Gagal Dihapus!');
				document.location.href='data_inventaris.php';
			</script>";	
	}


 ?>