<?php
$active = @$_GET['print'];

if($active == 'harian'){
  $tgl= @$_GET['tgl'];
  $data='harian.php';
}

include '../../pdf/mpdf.php';
$mpdf=new mPDF();
$mpdf ->SetDisplayMode('fullpage');
$mpdf->WriteHTML(file_get_contents($data));
$mpdf->Output();

 ?>
