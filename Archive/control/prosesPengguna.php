<?php
include ("../koneksi/koneksi.php");


//Add Pengguna
$active = @$_GET['action'];
$NIP= $_POST['NIP'];
$username = $_POST['username'];
$password =($_POST['password']);
$passwordEdit =$_POST['passwordEdit'];
$tipeAkun = $_POST['tipeAkun'];
$validasi_pengguna = $_POST['validasi'];
$val;
if ($validasi_pengguna == null){
  $val="Non-Aktif";
}else if($validasi_pengguna="Aktif"){
  $val =$validasi_pengguna ;
}else if($validasi_pengguna="Non-Aktif"){
  $val =$validasi_pengguna ;
}

if($active=='tambah'){
$sql = "INSERT INTO `pengguna` (`NIP`, `username`, `password`, `tipe_akun`, `validasi_pengguna`) VALUES ('$NIP', '$username', '$password','$tipeAkun', '$val');";
$proses = mysql_query($sql);
}else if ($active=='edit') {
  # code...
  $barang=  mysql_query("update pengguna set  username ='$username', password='$passwordEdit' , tipe_akun ='$tipeAkun' ,validasi_pengguna ='$val' where NIP='$NIP'");
  header (sprintf("location:../view/index.php?page=pengguna"));
}else if($active=='delete'){
    $barang=  mysql_query("DELETE FROM `pengguna` where NIP='$NIP'");
    header (sprintf("location:../view/index.php?page=pengguna"));
}
