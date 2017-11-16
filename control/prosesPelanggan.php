<?php
include ("../koneksi/koneksi.php");
session_start();
$active = @$_GET['action'];
$id_pelanggan = $_POST['id_pelanggan'];
$nama = $_POST['nama'];
$no_hp = $_POST['noHp'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jk'];
$area = $_POST['area'];
$jumlah_tv = $_POST['jumlahTV'];
$iuran = $_POST['iuran'];
$tgl_bayar = $_POST['tgl_bayar'];
$idPengguna = $_SESSION['idPengguna'];
$NIP = $idPengguna;
$total = '200000';

$sql3 ="select max(no_faktur) as maxKode from transaksi";
$hasil3 = mysql_query($sql3);
$data=mysql_fetch_array($hasil3);
$no_faktur = $data['maxKode'];
$noUrut =(int)substr($no_faktur,1,4);
$noUrut++;
$char ="F";
$newID_Transaksi =$char.sprintf("%04s",$noUrut);

if($active=='tambah'){
$sql = "INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `No_HP`, `alamat`, `jenis_kelamin`, `area`, `jumlah_tv`, `iuran`, `tgl_bayar`, `tgl_regristrasi`) VALUES ('$id_pelanggan', '$nama', '$no_hp', '$alamat', '$jenis_kelamin', '$area', '$jumlah_tv', '$iuran', '$tgl_bayar', CURRENT_TIMESTAMP);";
$proses = mysql_query($sql);
$sql2="INSERT INTO `transaksi` (`no_faktur`, `id_pelanggan`, `NIP`, `total`, `tgl_pembayaran`, `jumlah_tunggakan`,`jenis_pembayaran`) VALUES ('$newID_Transaksi', '$id_pelanggan', '$NIP', '$total', CURRENT_TIMESTAMP,'1','Registrasi');";
$hasil = mysql_query($sql2);
header (sprintf("location:../view/cetakRegistrasi.php?no_faktur=$newID_Transaksi"));

}else if ($active=='edit') {
  $update=  mysql_query("update pelanggan set  nama_pelanggan ='$nama', No_HP='$no_hp' , alamat ='$alamat' ,jenis_kelamin ='$jenis_kelamin',area='$area' ,jumlah_tv='$jumlah_tv', iuran='$iuran', tgl_bayar='$tgl_bayar' where id_pelanggan='$id_pelanggan'");
  header (sprintf("location:../view/index.php?page=pelanggan"));
}else if($active=='delete'){

}
?>
