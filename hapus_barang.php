<?php 

require 'functions.php';

$kode_barang= $_GET['kode_barang'];
if (hapus_barang ($kode_barang) >0) {
	 echo "<script> 
				alert('Data Berhasil Dihapus!');
				document.location.href='data_barang.php';
			</script>";	
	} else {
		echo "<script> 
				alert('Data Gagal Dihapus!');
				document.location.href='data_barang.php';
			</script>";	
	}


 ?>