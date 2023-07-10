<?php 

require 'functions.php';

$kode_mutasi= $_GET['kode_mutasi'];
if (hapus_mutasi ($kode_mutasi) >0) {
	 echo "<script> 
				alert('Data Berhasil Dihapus!');
				document.location.href='data_mutasi.php';
			</script>";	
	} else {
		echo "<script> 
				alert('Data Gagal Dihapus!');
				document.location.href='data_mutasi.php';
			</script>";	
	}


 ?>