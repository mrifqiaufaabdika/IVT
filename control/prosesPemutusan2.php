<?php
session_start();
include '../koneksi/koneksi.php';

$id_pelanggan = $_POST['id_pelanggan'];


$sql="update pelanggan set   status='non-aktif' where id_pelanggan='$id_pelanggan'";
$hasil = mysql_query($sql);
header (sprintf("location:../view/index.php?page=pelanggan"));
 ?>
