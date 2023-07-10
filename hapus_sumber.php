<?php 

require 'functions.php';

$kode_sumber= $_GET['kode_sumber'];
if (hapus_sumber ($kode_sumber) >0) {
	 echo "<script> 
				alert('Data Berhasil Dihapus!');
				document.location.href='data_sumber.php';
			</script>";	
	} else {
		echo "<script> 
				alert('Data Gagal Dihapus!');
				document.location.href='data_sumber.php';
			</script>";	
	}


 ?>