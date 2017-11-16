
<?php
ob_start();
$active = @$_GET['tgl'];
$tampilTgl1 = date('d/m/Y',strtotime($active));
include "../../koneksi/koneksi.php";
 $sql ="select a.*,b.*,c.* from transaksi a,pelanggan b,pegawai c where a.jenis_pembayaran ='Iuran Bulanan' and a.id_pelanggan =b.id_pelanggan and a.NIP = c.NIP and a.tgl_pembayaran='$active'";
 $hasil = mysql_query($sql);
?>

<html>
<head>
<link rel="icon" href="../../gambar/LOGO.png" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="../../model/css/main.css">

</head>
<table width="100%" align="center"  >
     <tr>
     <td width='25%' align="center"><img src="../../gambar/LOGO.png" width='100px' alt="pdam" /></td>
     <td width='75%' align="center"><H2><b>PT. INDRAGIRI VISION TERPADU</b></H2> <br>JL. Harapan Gg.Harapan 1 No.49 28291 <br> Telp : 0761-7608229 Fax:0761-571352  www.ivtinhil.com </td>

   </tr>


 <tr>
   <td colspan="2"><hr color="red"></hr></td>
 </tr>

 <tr>

   <td colspan="2" align="center"><h4>Laporan Pendapatan Harian PT.Indragiri Vision Terpadu  </h4></td>
 </tr>
 <br>
 <tr>
   <td>
      Pembayaran Tanggal
   </td>
   <td >: <?php echo $tampilTgl1 ; ?> </td>
 </tr>

   </table>
   <br>
<table width="100%" border="1" >
  <thead>
    <tr >

      <th height="40px" align="center" >No Transaksi</th>
      <th align="center" >ID Pelanggan</th>
      <th align="center">Nama Pelanggan</th>
      <th align="center">Pegawai</th>
      <th align="center">Iuran</th>
      <th align="center">Jumlah Iuran</th>
      <th align="center">Total</th>

    </tr>
  </thead>
  <tbody>

    <?php
    $jumlah =0;
    while ($data = mysql_fetch_array($hasil)) {
        $tampilTgl = date('d/m/Y',strtotime($data['tgl_pembayaran']));
    echo"<tr>";
    echo "<td align='center'>". $data['no_faktur']."</td>";
    echo "<td align='center'>" . $data['id_pelanggan']."</td>";
    echo "<td align='center'>" . $data['nama_pelanggan']."</td>";
    echo "<td align='center'>".$data['nama_pegawai']." </td>";
    echo "<td > Rp.". format_rupiah ($data['iuran'])."</td>";
    echo "<td align='center'>". $data['jumlah_tunggakan']."</td>";
    echo "<td> Rp ".format_rupiah($data['total'])."</td>";
    $jumlah = $jumlah+$data['total'];
    echo "</tr>";
  }
  echo"<tr>";
    echo "<td colspan='5'></td>";
    echo "<td > Total : </td>";
    echo "<td> Rp " . format_rupiah($jumlah) ."</td>";
  echo "</tr>";

    ?>

  </tbody>
</table>
<br>
<br>
<table  align="right">

  <tr>
    <td align="center">
      Tembilahan, <?php echo date("d/m/Y"); ?>
    </td>
  </tr>

    <tr >
      <td height="80px">

      </td>
    </tr>
    <tr>
      <td align="center">
      M.Rifqi Aufa Abdika
      </td>
    </tr>

    <tr>
      <td align="center">
        NIP:231231231312312
      </td>
    </tr>




</table>




<?php
function format_rupiah($angka){
  $rupiah=number_format($angka,0,',','.');
  return $rupiah;
}

$out= ob_get_contents();
ob_end_clean();
include '../../pdf/mpdf.php';
$mpdf=new mPDF();
$mpdf ->SetDisplayMode('fullpage');
$mpdf->WriteHTML($out);
$mpdf->Output();
exit;
 ?>
