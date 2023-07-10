<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';

 error_reporting(0);
$jenis_barang = $_POST['jenis_barang'];
$barang = $_POST['barang'];
$program = $_POST['program'];
$barang = $_POST['barang'];
$sub_kegiatan = $_POST['sub_kegiatan'];

$tgl_pengadaan1 = $_POST['tgl_pengadaan1']; 
$tgl_pengadaan2 = $_POST['tgl_pengadaan2'];


 

 
date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
 
$tanggal = date('l, d-m-Y  H:i:s');
 

if (isset($jenis_barang)==true) {

                     $inventaris = tampil_data("SELECT a.kode_inventaris,a.jumlah,a.tgl_pengadaan, 
                          b.nama_sub_kegiatan, c.nama_kegiatan, 
                          d.nama_program,
                          e.nama_barang, f.jenis_barang
                          FROM inventaris a
                          JOIN sub_kegiatan b ON b.kode_sub_kegiatan = a.kode_sub_kegiatan
                          JOIN kegiatan c ON c.kode_kegiatan = b.kode_kegiatan
                          JOIN program d ON d.kode_program = c.kode_program
                          JOIN barang e ON e.kode_barang = a.kode_barang
                          JOIN jenis_barang f ON f.kode_jenis = e.kode_jenis
                          Where f.kode_jenis = '$jenis_barang'
                           ");
}
elseif (isset($barang)==true) {

                     $inventaris = tampil_data("SELECT a.kode_inventaris,a.jumlah,a.tgl_pengadaan, 
                          b.nama_sub_kegiatan, c.nama_kegiatan, 
                          d.nama_program,
                          e.nama_barang, f.jenis_barang
                          FROM inventaris a
                          JOIN sub_kegiatan b ON b.kode_sub_kegiatan = a.kode_sub_kegiatan
                          JOIN kegiatan c ON c.kode_kegiatan = b.kode_kegiatan
                          JOIN program d ON d.kode_program = c.kode_program
                          JOIN barang e ON e.kode_barang = a.kode_barang
                          JOIN jenis_barang f ON f.kode_jenis = e.kode_jenis
                          Where e.kode_barang = '$barang'
                           ");
}
elseif (isset($program)==true) {

                        $inventaris = tampil_data("SELECT a.kode_inventaris,a.jumlah,a.tgl_pengadaan, 
                            b.nama_sub_kegiatan, c.nama_kegiatan, 
                            d.nama_program,
                            e.nama_barang, f.jenis_barang
                            FROM inventaris a
                            JOIN sub_kegiatan b ON b.kode_sub_kegiatan = a.kode_sub_kegiatan
                            JOIN kegiatan c ON c.kode_kegiatan = b.kode_kegiatan
                            JOIN program d ON d.kode_program = c.kode_program
                            JOIN barang e ON e.kode_barang = a.kode_barang
                            JOIN jenis_barang f ON f.kode_jenis = e.kode_jenis
                            Where d.kode_program = '$program'
                            ");

} elseif (isset($sub_kegiatan)==true)  {
    
                        $inventaris = tampil_data("SELECT a.kode_inventaris,a.jumlah,a.tgl_pengadaan, 
                            b.nama_sub_kegiatan, c.nama_kegiatan, 
                            d.nama_program,
                            e.nama_barang, f.jenis_barang
                            FROM inventaris a
                            JOIN sub_kegiatan b ON b.kode_sub_kegiatan = a.kode_sub_kegiatan
                            JOIN kegiatan c ON c.kode_kegiatan = b.kode_kegiatan
                            JOIN program d ON d.kode_program = c.kode_program
                            JOIN barang e ON e.kode_barang = a.kode_barang
                            JOIN jenis_barang f ON f.kode_jenis = e.kode_jenis
                            Where b.kode_sub_kegiatan = '$sub_kegiatan'
                            ");
} elseif (isset($tgl_pengadaan1)==true) {

                    $inventaris = tampil_data("SELECT a.kode_inventaris,a.jumlah,a.tgl_pengadaan, 
                                    b.nama_sub_kegiatan, c.nama_kegiatan, 
                                    d.nama_program,
                                    e.nama_barang, f.jenis_barang
                                    FROM inventaris a
                                    JOIN sub_kegiatan b ON b.kode_sub_kegiatan = a.kode_sub_kegiatan
                                    JOIN kegiatan c ON c.kode_kegiatan = b.kode_kegiatan
                                    JOIN program d ON d.kode_program = c.kode_program
                                    JOIN barang e ON e.kode_barang = a.kode_barang
                                    JOIN jenis_barang f ON f.kode_jenis = e.kode_jenis
                                    Where a.tgl_pengadaan BETWEEN  '$tgl_pengadaan1' AND '$tgl_pengadaan2'
                                            ");
                     
}
 

$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Inventaris Barang Diskominfo Kota Jayapura</title>
    <link rel="stylesheet" href="css/print.css">
</head>
<body>
    <img src="img/kop_diskominfo.png"  style="width:100%;  ">
    <h3 style="text-align: center;" >Daftar Inventaris Barang Diskominfo Kota Jayapura</h3>
    <h6> Dicetak Pada Tanggal : ' .$tanggal;
    $html .= '
 
    </h6>
    <table border="1" cellpadding="10" cellspacing="0">
		<tr>
            <th>No</th>
            <th>Kode Inventaris</th>
            <th>Jenis Barang</th>
            <th>Nama Barang</th>
            <th>Program</th>
            <th>Sub Kegiatan</th>
            <th>Jumlah</th>
            <th>Tanggal Pengadaan</th>
        </tr>';
    
 $i = 1;
foreach ($inventaris as $row) {
    $html .= '<tr>
        <td>'. $i++ .'</td>
        <td>'.$row["kode_inventaris"].'</td>
        <td>'.$row["jenis_barang"].'</td>
        <td>'.$row["nama_barang"].'</td>
        <td>'.$row["nama_program"].'</td>
        <td>'.$row["nama_sub_kegiatan"].'</td>
        <td>'.$row["jumlah"].'</td>
        <td>'.tgl_indo($row["tgl_pengadaan"]).'</td>
    </tr>';
}
$html .= '</table>    
<br>
<img src="img/ttd_kadis.png"  style="width:35%; float:right;  ">


</body>


</html>';

$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Inventaris Barang Diskominfo Kota Jayapura</title>
    <link rel="stylesheet" href="css/print.css">
</head>
<body>
    <img src="img/kop_diskominfo.png"  style="width:100%;  ">
    <h3 style="text-align: center;" >Daftar Inventaris Barang Diskominfo Kota Jayapura</h3>
    <h6> Dicetak Pada Tanggal : ' .$tanggal;
    $html .= '
 
    </h6>
    <table border="1" cellpadding="10" cellspacing="0">
		<tr>
            <th>No</th>
            <th>Kode Inventaris</th>
            <th>Jenis Barang</th>
            <th>Nama Barang</th>
            <th>Program</th>
            <th>Sub Kegiatan</th>
            <th>Jumlah</th>
            <th>Tanggal Pengadaan</th>
        </tr>';
    
 $i = 1;
foreach ($inventaris as $row) {
    $html .= '<tr>
        <td>'. $i++ .'</td>
        <td>'.$row["kode_inventaris"].'</td>
        <td>'.$row["jenis_barang"].'</td>
        <td>'.$row["nama_barang"].'</td>
        <td>'.$row["nama_program"].'</td>
        <td>'.$row["nama_sub_kegiatan"].'</td>
        <td>'.$row["jumlah"].'</td>
        <td>'.tgl_indo($row["tgl_pengadaan"]).'</td>
    </tr>';
}
$html .= '</table>    
<br>
<img src="img/ttd_kadis.png"  style="width:35%; float:right;  ">


</body>


</html>';


$mpdf->WriteHTML($html);
$mpdf->Output('daftar-inventaris.pdf', "I");

?> 
