<?php 

require 'functions.php';

$kode_ruangan= $_GET['kode_ruangan'];
if (hapus_ruangan ($kode_ruangan) >0) {
	 echo "<script> 
				alert('Data Berhasil Dihapus!');
				document.location.href='data_ruangan.php';
			</script>";	
	} else {
		echo "<script> 
				alert('Data Gagal Dihapus!');
				document.location.href='data_ruangan.php';
			</script>";	
	}


 ?>