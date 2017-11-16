<?php
include "../pdf/mpdf.php";

$pdf_ = new mPDF();

ob_start();
$nama = "Rifqi";
$umur = 20;
$nama_doc = "perkenalan"
?>


<h3>Hai, nama saya <?= $nama ?> </h3>
<h3>Umur saya <?= $umur ?></h3>





<?php
$html = ob_get_contents();
ob_end_clean();
$pdf_->WriteHTML(utf8_encode($html));
$pdf_->Output($nama_doc.".pdf", 'I');
?>
