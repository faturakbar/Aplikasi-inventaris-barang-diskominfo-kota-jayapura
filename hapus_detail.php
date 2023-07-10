<?php 

require 'functions.php';

$no_seri= $_GET['no_seri'];
if (hapus_detail ($no_seri) >0) {
	 echo "<script> 
				alert('Data Berhasil Dihapus!');
				document.location.href='data_detail.php';
			</script>";	
	} else {
		echo "<script> 
				alert('Data Gagal Dihapus!');
				document.location.href='data_detail.php';
			</script>";	
	}


 ?>