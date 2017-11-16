<?php
$dari = $_POST['dari'];
$sampai = $_POST['sampai'];


list($tglDari,$blnDari,$thnDari)= split('[/]',$dari);
list($tglSampai,$blnSampai,$thnSampai)= split('[/]',$sampai);

$tglDari = $thnDari.sprintf("-").sprintf($blnDari).sprintf("-").sprintf($tglDari);
$tglSampai = $thnSampai.sprintf("-").sprintf($blnSampai).sprintf("-").sprintf($tglSampai);;

header (sprintf("location:../view/index.php?page=priode&dari=$tglDari&sampai=$tglSampai"));


 ?>
