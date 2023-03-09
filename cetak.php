<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';

$skincare = query("SELECT * FROM skincare");

$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Skincare</title>
</head>
<body>

<h1>Daftar Skincare</h1>
    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>No.</th>
            <th>Gambar</th>
            <th>Merk</th>
            <th>Jenis</th>
            <th>Ukuran</th>
            <th>Expired Date</th>
        </tr>';

    $i = 1;
    foreach( $skincare as $row ) {
        $html .= '<tr>
        <td>'. $i++ .'</td>
        <td><img src="img/'. $row["gambar"] .'" width="50"></td>
        <td>'. $row["merk"] .'</td>
        <td>'. $row["jenis"] .'</td>
        <td>'. $row["ukuran"] .'</td>
        <td>'. $row["expireddate"] .'</td>
        
        </tr>';
    }
    
$html .= '</table>
</body>
</html>';

$mpdf->WriteHTML($html);
$mpdf->Output('daftar-skincare.pdf', "I");