<?php 

require 'functions.php';

$no_seri= $_GET['no_seri'];
$kode_inventaris = $_GET['kode_inventaris'];
 
if (hapus_detail_inventaris ($no_seri) >0) {
	 echo "<script> 
				alert('Data Berhasil Dihapus!');
				document.location.href='data_detail_inventaris.php?kode_inventaris=$kode_inventaris';
			</script>";	
	} else {
		echo "<script> 
				alert('Data Gagal Dihapus!');
				document.location.href='data_detail_inventaris.php?kode_inventaris=$kode_inventaris';
			</script>";	
	}


 ?>