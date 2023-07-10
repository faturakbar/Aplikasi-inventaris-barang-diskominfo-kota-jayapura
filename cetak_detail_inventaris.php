<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';

 error_reporting(0); 
$kode_inventaris = $_GET['kode_inventaris'];

$ruangan = $_POST['ruangan'];
$kondisi = $_POST['kondisi'];

$kode_inventaris1 = $_POST['kode_inventaris'];

 
date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
 
$tanggal = date('l, d-m-Y  H:i:s');
 

if (isset($kode_inventaris)!="") {

                                $detail_inventaris=tampil_data ("SELECT a.no_seri,a.kode_inventaris,a.kondisi, a.gambar,
                                b.ruangan, d.nama_barang  FROM                             
                                detail_inventaris  a 
                                JOIN ruangan b  
                                ON b.kode_ruangan = a.kode_ruangan
                                JOIN inventaris c
                                ON c.kode_inventaris = a.kode_inventaris
                                JOIN barang d
                                ON d.kode_barang = c.kode_barang
                                WHERE a.kode_inventaris = '$kode_inventaris'
                                ");
 

 

}
elseif (isset($ruangan)==true) {

                                $detail_inventaris=tampil_data ("SELECT a.no_seri,a.kode_inventaris,a.kondisi, a.gambar,
                                b.ruangan, d.nama_barang  FROM                             
                                detail_inventaris  a 
                                JOIN ruangan b  
                                ON b.kode_ruangan = a.kode_ruangan
                                JOIN inventaris c
                                ON c.kode_inventaris = a.kode_inventaris
                                JOIN barang d
                                ON d.kode_barang = c.kode_barang
                                WHERE b.kode_ruangan = '$ruangan' AND c.kode_inventaris = '$kode_inventaris1'
                                ");

}
elseif (isset($kondisi)==true) {
                                $detail_inventaris=tampil_data ("SELECT a.no_seri,a.kode_inventaris,a.kondisi, a.gambar,
                                b.ruangan, d.nama_barang  FROM                             
                                detail_inventaris  a 
                                JOIN ruangan b  
                                ON b.kode_ruangan = a.kode_ruangan
                                JOIN inventaris c
                                ON c.kode_inventaris = a.kode_inventaris
                                JOIN barang d
                                ON d.kode_barang = c.kode_barang
                                WHERE a.kondisi = '$kondisi' AND c.kode_inventaris = '$kode_inventaris1'
                                ");
                                 
} 
 

$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Detail Inventaris Barang Diskominfo Kota Jayapura</title>
    <link rel="stylesheet" href="css/print.css">
</head>
<body>
    <img src="img/kop_diskominfo.png"  style="width:100%;  ">
    <h3 style="text-align: center;" >Daftar Detail Inventaris Barang Diskominfo Kota Jayapura</h3>
    <h6> Dicetak Pada Tanggal : ' .$tanggal;
    $html .= '
 
    </h6>
    <table border="1" cellpadding="10" cellspacing="0">
		<tr>
            <th>No</th>
            <th>No Seri</th>
            <th>Kode Inventaris</th>
            <th>Nama Barang</th>
            <th>Ruangan</th>
            <th>Kondisi</th>
            <th>Gambar</th>
        </tr>';
    
 $i = 1;
foreach ($detail_inventaris as $row) {
    $html .= '<tr>
        <td>'. $i++ .'</td>
        <td>'.$row["no_seri"].'</td>
        <td>'.$row["kode_inventaris"].'</td>
        <td>'.$row["nama_barang"].'</td>
        <td>'.$row["ruangan"].'</td>
        <td>'.$row["kondisi"].'</td>';
        
 if ($row["gambar"]=="") {
        $html .='<td><img src="img/no_image.jpg" width="50"></td>';
 }  else {
    $html .='<td><img src="img/'.$row['gambar'].'" width="50"></td>';
 }
 $html .= '</tr>';
}
$html .= '</table>    
<br>
<img src="img/ttd_kadis.png"  style="width:35%; float:right;  ">


</body>


</html>';



$mpdf->WriteHTML($html);
$mpdf->Output('daftar-detail-inventaris.pdf', "I");

?> 
