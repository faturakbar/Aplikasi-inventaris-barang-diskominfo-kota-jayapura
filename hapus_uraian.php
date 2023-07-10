<?php 

require 'functions.php';

$kode_rekening= $_GET['kode_rekening'];
if (hapus_uraian ($kode_rekening) >0) { 
	 echo "<script> 
				alert('Data Berhasil Dihapus!');
				document.location.href='data_uraian.php';
			</script>";	
	} else {
		echo "<script> 
				alert('Data Gagal Dihapus!');
				document.location.href='data_uraian.php';
			</script>";	
	}


 ?>