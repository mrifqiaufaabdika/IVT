<?php
include ("../koneksi/koneksi.php");

$active = @$_GET['action'];
$NIP= $_POST['NIP'];
$nama = $_POST['nama'];
$no_hp = $_POST['noHP'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jk'];
$jabatan = $_POST['jabatan'];

if($active=='tambah'){
$sql = "INSERT INTO `pegawai` (`NIP`, `nama_pegawai`, `No_HP`, `alamat`, `jabatan`, `jenis_kelamin`) VALUES ('$NIP', '$nama', '$no_hp', '$alamat', '$jabatan', '$jenis_kelamin');";
$proses = mysql_query($sql);
  header (sprintf("location:../view/index.php?page=pegawai"));
}else if ($active=='edit') {
    $edit=  mysql_query("update pegawai set  nama_pegawai ='$nama', No_HP='$no_hp' , alamat ='$alamat' ,jabatan ='$jabatan', jenis_kelamin ='$jenis_kelamin' where NIP='$NIP'");
    header (sprintf("location:../view/index.php?page=pegawai"));
}else if($active=='delete'){
  $delete=  mysql_query("DELETE FROM `pegawai` where NIP='$NIP'");
  header (sprintf("location:../view/index.php?page=pegawai"));
}
