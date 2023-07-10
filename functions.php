<?php 
// koneksi ke database
$conn = mysqli_connect("localhost","root","","db_inventaris");

function tampil_data ($query) {
	global $conn;

	$result = mysqli_query($conn, $query);


	$rows =[];
	error_reporting(0);
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] =$row;
 
	}
 
	return $rows;
}
 

function tgl_indo($tanggal){
    $bulan = array (
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

// Function  Program
function tambah_program ($data) {
    global $conn;
    // ambil data dari tiap elemen dalam form 
    $kode_program1 = $data['kode_program1']; 
 

    $gabung_kode_program = $kode_program1;
    $nama_program = htmlspecialchars($data['nama_program']);   

  
    // query insert data 
    $query = "INSERT INTO program Values 
                ('$gabung_kode_program','$nama_program')";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function hapus_program ($kode_program) {
	global $conn;
	mysqli_query($conn, "DELETE FROM program WHERE kode_program= '$kode_program'");
	return mysqli_affected_rows($conn);
}


function ubah_program ($data) {
	global $conn;
	 // ambil data dari tiap elemen dalam form 
	 $kode_program = $data['kode_program'];
	 $nama_program= htmlspecialchars($data['nama_program']);

	 // query ubah data 
	 $query = "UPDATE  program SET 
	 			nama_program = '$nama_program'
	 			 
	 			WHERE kode_program= '$kode_program'
	 			";
	 			
	 mysqli_query($conn,$query);
	 return mysqli_affected_rows($conn);

}

// Function Kegiatan
function tambah_kegiatan ($data) {
    global $conn;
    // ambil data dari tiap elemen dalam form 
    $kode_kegiatan1 = $data['kode_kegiatan1']; 
 

    $gabung_kode_kegiatan = $kode_kegiatan1;
    					
    $kode_program = htmlspecialchars($data['program']); 	
   
    $nama_kegiatan = htmlspecialchars($data['nama_kegiatan']);   
  
    // query insert data 
    $query = "INSERT INTO kegiatan Values 
                ('$gabung_kode_kegiatan','$kode_program','$nama_kegiatan')";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function hapus_kegiatan ($kode_kegiatan) {
	global $conn;
	mysqli_query($conn, "DELETE FROM kegiatan WHERE kode_kegiatan= '$kode_kegiatan'");
	return mysqli_affected_rows($conn);
}

function ubah_kegiatan ($data) {
	global $conn;
	 // ambil data dari tiap elemen dalam form 
	 $kode_kegiatan = $data['kode_kegiatan'];
	 $nama_kegiatan= htmlspecialchars($data['nama_kegiatan']);
	 $program = $data['program'];
	
	 // query ubah data 
	 $query = "UPDATE  kegiatan SET 
	 			kode_program = '$program',
	 			nama_kegiatan = '$nama_kegiatan'	 			 
	 			WHERE kode_kegiatan= '$kode_kegiatan'
	 			";
	 			
	 mysqli_query($conn,$query);
	 return mysqli_affected_rows($conn);

}

// Function Sub Kegiatan
function tambah_sub_kegiatan ($data) {
    global $conn;
    // ambil data dari tiap elemen dalam form 
    $kode_sub_kegiatan1 = $data['kode_sub_kegiatan1']; 
    
    $gabung_kode_sub_kegiatan = $kode_sub_kegiatan1;
    $kode_kegiatan = htmlspecialchars($data['kegiatan']); 	
    $nama_sub_kegiatan = htmlspecialchars($data['nama_sub_kegiatan']);

  
    // query insert data 
    $query = "INSERT INTO sub_kegiatan Values 
                ('$gabung_kode_sub_kegiatan','$kode_kegiatan','$nama_sub_kegiatan')";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function hapus_sub_kegiatan ($kode_sub_kegiatan) {
	global $conn;
	mysqli_query($conn, "DELETE FROM sub_kegiatan WHERE kode_sub_kegiatan= '$kode_sub_kegiatan'");
	return mysqli_affected_rows($conn);
}

function ubah_sub_kegiatan ($data) {
	global $conn;
	 // ambil data dari tiap elemen dalam form 
	 $kode_sub_kegiatan = $data['kode_sub_kegiatan'];
	 $nama_sub_kegiatan= htmlspecialchars($data['nama_sub_kegiatan']);
	 $kegiatan = $data['kegiatan'];

	 
	 // query ubah data 
	 $query = "UPDATE  sub_kegiatan SET 
	 			kode_kegiatan = '$kegiatan',
	 			nama_sub_kegiatan = '$nama_sub_kegiatan'	 			 
	 			WHERE kode_sub_kegiatan= '$kode_sub_kegiatan'
	 			";
	 			
	 mysqli_query($conn,$query);
	 return mysqli_affected_rows($conn);

}

// Function Uraian
function tambah_uraian ($data) {
    global $conn;
    // ambil data dari tiap elemen dalam form 
    $kode_rekening1 = $data['kode_rekening1']; 
    $kode_rekening2 = $data['kode_rekening2'];
    $kode_rekening3 = $data['kode_rekening3'];
    $kode_rekening4 = $data['kode_rekening4'];
    $kode_rekening5 = $data['kode_rekening5'];
    $kode_rekening6 = $data['kode_rekening6'];

    $gabung_kode_rekening = $kode_rekening1.".".$kode_rekening2.".".
    							$kode_rekening3.".".$kode_rekening4.".".
    							$kode_rekening5.".".$kode_rekening6;

    $uraian = htmlspecialchars($data['uraian']); 	
    

  
    // query insert data 
    $query = "INSERT INTO uraian Values 
                ('$gabung_kode_rekening','$uraian')";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function hapus_uraian ($kode_rekening) {
	global $conn;
	mysqli_query($conn, "DELETE FROM uraian WHERE kode_rekening= '$kode_rekening'");
	return mysqli_affected_rows($conn);
}

function ubah_uraian ($data) {
	global $conn;
	 // ambil data dari tiap elemen dalam form 
	 $kode_rekening = $data['kode_rekening'];
	 $uraian= htmlspecialchars($data['uraian']);
	  
 
	 // query ubah data 
	 $query = "UPDATE  uraian SET 
	 			uraian = '$uraian'	 			 
	 			WHERE kode_rekening= '$kode_rekening'
	 			";
	 			
	 mysqli_query($conn,$query);
	 return mysqli_affected_rows($conn);

}



// Function Jenis Barang
function tambah ($data) {
    global $conn;
    // ambil data dari tiap elemen dalam form 
    $kode_jenis = $data['kode_jenis'];  
    $jenis_barang = htmlspecialchars($data['jenis_barang']);   
    // query insert data 
    $query = "INSERT INTO jenis_barang Values 
                ('$kode_jenis','$jenis_barang')";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}


function id ($query) {
        global $conn;
        $result = mysqli_query($conn,$query);
        $data = mysqli_fetch_assoc($result);
        return $data;

}

function hapus ($kode_jenis) {
	global $conn;
	mysqli_query($conn, "DELETE FROM jenis_barang WHERE kode_jenis= '$kode_jenis'");
	return mysqli_affected_rows($conn);
}

function ubah ($data) {
	global $conn;
	 // ambil data dari tiap elemen dalam form 
	 $kode_jenis = $data['kode_jenis'];
	 $jenis_barang= htmlspecialchars($data['jenis_barang']);

	 // query ubah data 
	 $query = "UPDATE  jenis_barang SET 
	 			jenis_barang= '$jenis_barang' 
	 			WHERE kode_jenis = '$kode_jenis'
	 			";
	 			
	 mysqli_query($conn,$query);
	 return mysqli_affected_rows($conn);

}


// Function Ruangan

function tambah_ruangan ($data) {
    global $conn;
    // ambil data dari tiap elemen dalam form 
    $kode_ruangan = $data['kode_ruangan'];  
    $ruangan= htmlspecialchars($data['ruangan']);   
    // query insert data 
    $query = "INSERT INTO ruangan Values 
                ('$kode_ruangan','$ruangan')";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function id_ruangan($query) {
    global $conn;
    $result = mysqli_query($conn,$query);
    $data = mysqli_fetch_assoc($result);
    return $data;

}
function hapus_ruangan ($kode_ruangan) {
	global $conn;
	mysqli_query($conn, "DELETE FROM ruangan WHERE kode_ruangan= '$kode_ruangan'");
	return mysqli_affected_rows($conn);
}

function ubah_ruangan ($data) {
	global $conn;
	 // ambil data dari tiap elemen dalam form 
	 $kode_ruangan = $data['kode_ruangan'];
	 $ruangan= htmlspecialchars($data['ruangan']);

	 // query ubah data 
	 $query = "UPDATE  ruangan SET 
	 			ruangan = '$ruangan' 
	 			WHERE kode_ruangan = '$kode_ruangan'
	 			";
	 			
	 mysqli_query($conn,$query);
	 return mysqli_affected_rows($conn);
}

// Function Barang

function tambah_barang ($data) {
    global $conn;
    // ambil data dari tiap elemen dalam form 
    $kode_barang = $data['kode_barang'];  
    $jenis_barang= htmlspecialchars($data['jenis_barang']); 
    $uraian= htmlspecialchars($data['uraian']);    
    $satuan= htmlspecialchars($data['satuan']);
    $tipe= htmlspecialchars($data['tipe']);
    $merek= htmlspecialchars($data['merek']);



    $data_jenis_barang = tampil_data("SELECT jenis_barang FROM jenis_barang WHERE kode_jenis = '$jenis_barang'")[0]['jenis_barang'];


  	$nama_barang = $data_jenis_barang." ".$merek." ".$tipe;
 
    // query insert data barang
    $query = "INSERT INTO barang Values 
                ('$kode_barang','$jenis_barang','$uraian', '$nama_barang',
                 '$satuan','$tipe', '$merek')";
	mysqli_query($conn,$query);	


    return mysqli_affected_rows($conn);
}

function hapus_barang ($kode_barang) {
	global $conn;
	mysqli_query($conn, "DELETE FROM barang WHERE kode_barang= '$kode_barang'");
	return mysqli_affected_rows($conn);
}

function ubah_barang ($data) {
	global $conn;
	 // ambil data dari tiap elemen dalam form 
    $kode_barang = $data['kode_barang'];  
    $jenis_barang= htmlspecialchars($data['jenis_barang']); 
    $uraian= htmlspecialchars($data['uraian']);    
    $satuan= htmlspecialchars($data['satuan']);
    $tipe= htmlspecialchars($data['tipe']);
    $merek= htmlspecialchars($data['merek']);

    $data_jenis_barang = tampil_data("SELECT jenis_barang FROM jenis_barang WHERE kode_jenis = '$jenis_barang'")[0]['jenis_barang'];

    $nama_barang = $data_jenis_barang." ".$merek." ".$tipe;
     
 
	 // query ubah data 
     $query = "UPDATE barang SET 
             kode_jenis='$jenis_barang',
             kode_rekening='$uraian',
             nama_barang	 ='$nama_barang',
             satuan ='$satuan',
             tipe = '$tipe',
             merek = '$merek'
             WHERE kode_barang = '$kode_barang'
             ";

      mysqli_query($conn,$query);
	 return mysqli_affected_rows($conn);
}

// Function Inventaris

function tambah_inventaris ($data) {
    global $conn;
    // ambil data dari tiap elemen dalam form 
    $kode_inventaris = $data['kode_inventaris'];  
    $kode_barang= htmlspecialchars($data['barang']); 
    $kode_sub_kegiatan= htmlspecialchars($data['sub_kegiatan']);
    $jumlah=(int)htmlspecialchars($data['jumlah']);    
    $tgl_pengadaan= htmlspecialchars($data['tgl_pengadaan']);
    


    // query insert data 
    $query = "INSERT INTO inventaris Values 
                ('$kode_inventaris','$kode_barang','$kode_sub_kegiatan',
            	 '$jumlah','$tgl_pengadaan')";
                
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function ubah_inventaris ($data) {
	global $conn;
	 // ambil data dari tiap elemen dalam form 
    $kode_inventaris = $data['kode_inventaris'];  
    $kode_barang= htmlspecialchars($data['nama_barang']); 
    $kode_sub_kegiatan= htmlspecialchars($data['sub_kegiatan']);
    $jumlah=(int)htmlspecialchars($data['jumlah']);    
    $tgl_pengadaan= htmlspecialchars($data['tgl_pengadaan']);

	 // query ubah data 
     $query = "UPDATE inventaris SET 
             kode_barang='$kode_barang',
             kode_sub_kegiatan='$kode_sub_kegiatan',
             Jumlah = '$jumlah',
             tgl_pengadaan = '$tgl_pengadaan'
             WHERE kode_inventaris = '$kode_inventaris'
             ";
       			
	 mysqli_query($conn,$query);
	 return mysqli_affected_rows($conn);
}

function hapus_inventaris ($kode_inventaris) {
	global $conn;
	mysqli_query($conn, "DELETE FROM inventaris WHERE kode_inventaris= '$kode_inventaris'");
	return mysqli_affected_rows($conn);
}

// Function Detail Inventaris

function tambah_detail_inventaris ($data) {
    global $conn;
    // ambil data dari tiap elemen dalam form 
    $kode_inventaris = (string)htmlspecialchars($data['kode_inventaris']);  
    $no_seri= htmlspecialchars($data['no_seri']);
    $kode_ruangan= htmlspecialchars($data['ruangan']);
    $kondisi= htmlspecialchars($data['kondisi']);
 

    // upload gambar
	 $gambar = upload_detail();

	//check apakah noseri sudah ada atau belum ?
	$check_noseri= tampil_data("SELECT no_seri FROM detail_inventaris WHERE no_seri = '$no_seri'");

		foreach ($check_noseri as $seri ) {
			if ($seri['no_seri']==$no_seri) {
				echo "<script> alert ('No Seri Sudah Ada');
				</script>";
				return false;
		}
			}

	 // Check batas maksimum input data
		// Hitung kode inventaris yang sudah diinputkan 
		$check = tampil_data("SELECT count(kode_inventaris) as num  FROM detail_inventaris
							WHERE kode_inventaris = '$kode_inventaris'")[0]['num'];
		// tampilkan jumlah barang pada tabel inventaris 		
		$jumlah_barang= tampil_data("SELECT jumlah   FROM inventaris
									  WHERE kode_inventaris = '$kode_inventaris'")[0]['jumlah'];

			 //Bandingkan jumlah barang dengan kode inventaris 
				if ( $check>= $jumlah_barang ) {
					echo "<script> alert ('Data Yang Anda Inputkan lebih dari Jumlah Barang');
					</script>";
					return false;
				} 
				else {		
  					//query insert data 	
					$query = "INSERT INTO detail_inventaris Values 
	                ('$no_seri','$kode_inventaris','$kode_ruangan','$kondisi',
	            	 '$gambar')";
   
				    mysqli_query($conn,$query);
				    return mysqli_affected_rows($conn);;
					} 
}

 function hapus_detail_inventaris ($no_seri) {
	global $conn;
	mysqli_query($conn, "DELETE FROM detail_inventaris WHERE no_seri= '$no_seri'");
	return mysqli_affected_rows($conn);
}

function ubah_detail_inventaris ($data) {
	global $conn;
	 // ambil data dari tiap elemen dalam form 
	$no_seri = $data['no_seri']; 
    $kode_inventaris = $data['kode_inventaris'];  
    $ruangan= htmlspecialchars($data['ruangan']); 
    $kondisi= htmlspecialchars($data['kondisi']);

	// upload gambar
	$gambar = upload_detail();
	 
 
	// query ubah data 
     $query = "UPDATE detail_inventaris SET 
             kode_ruangan = '$ruangan',
             kondisi = '$kondisi',
			 gambar = '$gambar'
             WHERE no_seri = '$no_seri'
             ";



	 mysqli_query($conn,$query);
	 return mysqli_affected_rows($conn);
}

// Function Detail Barang

function tambah_detail ($data) {
    global $conn;
    // ambil data dari tiap elemen dalam form 
    $no_seri = htmlspecialchars($data['no_seri']);
    $nama_barang= htmlspecialchars($data['nama_barang']);
    $ruangan= htmlspecialchars($data['ruangan']);
    $keterangan= htmlspecialchars($data['keterangan']);
	$kondisi= htmlspecialchars($data['kondisi']);

 
	 
 
	//jika keterangan kosong 
	if ($keterangan=="") {
		$keterangan ="Tidak Ada Keterangan";
	} 

    // upload gambar
	 $gambar = upload_detail();

	 

	//check apakah noseri sudah ada atau belum ?
	$check_noseri= tampil_data("SELECT no_seri FROM detail_barang WHERE no_seri = '$no_seri'");
 
		foreach ($check_noseri as $seri ) {
			if ($seri['no_seri']==$no_seri) {
				echo "<script> alert ('No Seri Sudah Ada');
				</script>";
				return false;
		}
			}



		// Check batas maksimum input data
		$check = tampil_data("SELECT count(kode_barang) as num  FROM detail_barang 
							WHERE kode_barang = '$nama_barang'");
		$tes = tampil_data("SELECT jumlah_barang   FROM barang 
							WHERE kode_barang = '$nama_barang'");

		foreach ($check as $cek ) {	
			foreach ($tes as $tes) {		 
				$akhir = $tes['jumlah_barang'];		
				if ( $cek['num']>= $akhir ) {
					echo "<script> alert ('Data Yang Anda Inputkan lebih dari Jumlah Barang');
					</script>";
					return false;
				}
				else {			
			$query1 = "INSERT INTO detail_barang Values 
			('$no_seri','$nama_barang','$ruangan',
			'$keterangan','$kondisi','$gambar')";
	 	

			mysqli_query($conn,$query1);
				}
			}
		}	
		// check apakah kode barang sudah ada di pemutihan atau belum 
			$baik = $kondisi;
			$rusak = $kondisi;
			$putihkan=$kondisi;	

			$result = mysqli_query($conn, "SELECT * from pemutihan WHERE kode_barang = '$nama_barang' ");
			$row = mysqli_fetch_assoc($result);	 
			if ($kondisi=="BAIK") {
				$baik =  $row['baik']+ 1;
				$rusak =  $row['rusak'];
				$putihkan = $row['putihkan'];	
			} 
			else if ($kondisi=="RUSAK") {
				$baik = $row['baik'];	
				$rusak =  $row['rusak']+ 1;	
				$putihkan = $row['putihkan'];	
			} else {
				$baik = $row['baik'];	
				$rusak =$row['rusak'];	
				$putihkan = $row['putihkan']+1;
			}

			$jumlah = $baik + $rusak + $putihkan; 

			$query2 = "UPDATE  pemutihan SET  			
			baik ='$baik',
			rusak = '$rusak',
			putihkan = '$putihkan',
			jumlah = '$jumlah'
			WHERE kode_barang = '$nama_barang'
			";
			
	if ($nama_barang == $row['kode_barang']) {
	
		mysqli_query($conn,$query2);

	} else {
		return false;
	}	
    return mysqli_affected_rows($conn);
}


function upload_detail () {

	$namaFile = $_FILES['gambar'] ['name'];
	$ukuranFile = $_FILES['gambar'] ['size'];
	$errorFile = $_FILES['gambar'] ['error'];	
	$tmpFile = $_FILES['gambar'] ['tmp_name'];

		//cek apakah file yang diuopload adalah gambar
		$ekstensiGambarValid = ['jpg', 'jpeg','png',];
		$ekstensiGambar = explode('.', $namaFile);
		$ekstensiGambar = strtolower(end($ekstensiGambar));
		if (!in_array($ekstensiGambar,$ekstensiGambarValid)) {
		 
			return false;
		}

		// cek jika ukurannya terlalu besar 
		if ($ukuranFile >  1000000) {
			 echo "<script> alert ('Ukuran Gambar Terlalu Besar!!!');
				  </script>";
			 	return false;
		}

		//lolos pengecekan gambar siap di upload 

		//generate nama file baru
		$namaFileBaru = uniqid();
		$namaFileBaru .= '.';
		$namaFileBaru .= $ekstensiGambar;
		move_uploaded_file($tmpFile, 'img/'.$namaFileBaru);

		return $namaFileBaru;

}

function hapus_detail ($no_seri) {
	global $conn;

	$check = tampil_data("SELECT kode_barang, kondisi  FROM detail_barang 
					  WHERE no_seri = '$no_seri'")[0];

	$kondisii = $check['kondisi'];
	$nama_barang = $check ['kode_barang'];

 
	$baik = $kondisii;
	$rusak = $kondisii;
	$putihkan=$kondisii;
 
	$result = mysqli_query($conn, "SELECT * from pemutihan WHERE kode_barang = '$nama_barang' ");
	$row = mysqli_fetch_assoc($result);	 

	// Check kondisi awal yang  untuk dikurangi nilainya
	if ($kondisii=="BAIK") {
		$baik =  $row['baik']-1;
		$rusak =  $row['rusak']+0;
		$putihkan =  $row['putihkan']+0;	
	}
    else if ($kondisii=="RUSAK") {	
		$baik =  $row['baik']+0;
		$rusak =  $row['rusak']- 1;	
		$putihkan =  $row['putihkan']+0;	
	} else {
		$baik =  $row['baik']+0;
		$rusak =  $row['rusak']+0;
		$putihkan = $row['putihkan']-1;
	}
		
	$jumlah = floatval($baik) + floatval($rusak) + floatval($putihkan);

	$query2 = "UPDATE  pemutihan SET  			
	baik ='$baik',
	rusak = '$rusak',
	putihkan = '$putihkan',
	jumlah = '$jumlah'
	WHERE kode_barang = '$nama_barang'
	";
	
	mysqli_query($conn,$query2);

	mysqli_query($conn, "DELETE FROM detail_barang WHERE no_seri= '$no_seri'");
	return mysqli_affected_rows($conn);
}

function ubah_detail ($data) {
	global $conn;
	 // ambil data dari tiap elemen dalam form 
     $no_seri = htmlspecialchars($data['no_seri']);
     $nama_barang= htmlspecialchars($data['nama_barang']);
     $ruangan= htmlspecialchars($data['ruangan']);
     $keterangan= htmlspecialchars($data['keterangan']);
     $kondisi= htmlspecialchars($data['kondisi']); 
	 $gambarlama =htmlspecialchars($data['gambarlama']);
	 $kondisii = $data['kondisii'];
	 
	 
	 // cek apakah user pilih gambar baru atau tidak 
	 if ($_FILES['gambar']['error'] === 4 ) {
	 	$gambar =$gambarlama;
	 } else {
	 	$gambar = upload_detail();
	 }


	 // query ubah data 
	 $query1 = "UPDATE  detail_barang SET 	 			
	 			kode_barang = '$nama_barang',
	 			kode_ruangan ='$ruangan',
	 			keterangan = '$keterangan',
	 			kondisi = '$kondisi',
                gambar = '$gambar'
	 			WHERE no_seri = '$no_seri'
	 			";
	mysqli_query($conn,$query1);

	 // check apakah kode barang sudah ada di pemutihan atau belum 
	$baik = $kondisi;
	$rusak = $kondisi;
	$putihkan=$kondisi;	

	$result = mysqli_query($conn, "SELECT * from pemutihan WHERE kode_barang = '$nama_barang' ");
	$row = mysqli_fetch_assoc($result);	 

	// Check kondisi awal yang  untuk dikurangi nilainya
	if ($kondisii=="BAIK") {
		$baik =  $row['baik']-1;	
	}
    else if ($kondisii=="RUSAK") {		
		$rusak =  $row['rusak']- 1;	
			
	} else {
		
		$putihkan = $row['putihkan']-1;
	}

	 // Check kondisi yang dirubah untuk ditambah nilainya
	if ($kondisi=="BAIK") {
		$baik =  $row['baik']+ 1;	
	} 
	else if ($kondisi=="RUSAK") {		
		$rusak =  $row['rusak']+ 1;	
			
	} else {		
		$putihkan = $row['putihkan']+1;
	}
	
 	$jumlah = floatval($baik) + floatval($rusak) + floatval($putihkan);

	$query2 = "UPDATE  pemutihan SET  			
	baik ='$baik',
	rusak = '$rusak',
	putihkan = '$putihkan',
	jumlah = '$jumlah'
	WHERE kode_barang = '$nama_barang'
	";
	
	mysqli_query($conn,$query2);

	return mysqli_affected_rows($conn);

} 

function cari_detail ($keyword) {	
	$query ="SELECT * FROM detail_barang WHERE 
			 kode_barang LIKE '%$keyword%' OR			    
			 " ;  		 
			 return tampil_data ($query);
}



function ganti_password($data)
{
	global $conn;
	// ambil data dari tiap elemen dalam form
	$kode_user = htmlspecialchars($data['kode_user']);
	$password1 = mysqli_real_escape_string($conn, $data['password1']);
	$password2 = mysqli_real_escape_string($conn, $data['password2']);
	$username = $data['username'];

// Check Level 
$check_level = mysqli_query($conn,"SELECT level FROM user WHERE kode_user = '$kode_user'");
$levell = mysqli_fetch_assoc($check_level);
$level = $levell['level'];
 

	$result = mysqli_query($conn, "SELECT password FROM user WHERE kode_user='$kode_user'");
	$row = mysqli_fetch_assoc($result);

 


	// cek konfirmasi passsword 
	if ($password1 !== $password2) {
		echo "<script>
				   alert('Konfirmasi password tidak sesuai')
				   </script>";
		return false;
	}
	//enkripsi passwordnya
	$password2 = password_hash($password2, PASSWORD_DEFAULT);


	// query ubah data 
	$query = "UPDATE  user SET 
	username = '$username',
    level = '$level',
   password = '$password2'
	WHERE kode_user = '$kode_user'
	";



	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}
