<?php 

require 'functions.php';

$kode_program= $_GET['kode_program'];
 
if (hapus_program ($kode_program) >0) {
	 echo "<script> 
				alert('Data Berhasil Dihapus!');
				document.location.href='data_program.php';
			</script>";	
	} else {
		echo "<script> 
				alert('Data Gagal Dihapus!');
				document.location.href='data_program.php';
			</script>";	
	}


 ?>