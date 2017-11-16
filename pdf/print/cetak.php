


<?php
$a='da';
$html = '
  <?php $a?>
';
include("../mpdf.php");

$mpdf=new mPDF();

$mpdf->WriteHTML($html);
$mpdf->Output();
exit;

 ?>
