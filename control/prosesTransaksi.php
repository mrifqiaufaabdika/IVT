<?php
session_start();
include '../koneksi/koneksi.php';
$no_faktur = $_POST['no_faktur'];
$id_pelanggan = $_POST['id_pelanggan'];
$idPengguna = $_SESSION['idPengguna'];
$qty=$_POST['qty'];
$tgl = $_POST['tgl'];
$NIP = $idPengguna;

$total = $_POST['total'];

$sql="INSERT INTO `transaksi` (`no_faktur`, `id_pelanggan`, `NIP`, `total`, `tgl_pembayaran`, `jumlah_tunggakan`,`jenis_pembayaran`) VALUES ('$no_faktur', '$id_pelanggan', '$NIP', '$total', CURRENT_TIMESTAMP,'$qty','Iuran Bulanan');";
$hasil = mysql_query($sql);
header (sprintf("location:../view/bayar.php?id_pelanggan=$id_pelanggan&tgl=$tgl"));
 ?>
