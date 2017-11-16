<?php
session_start();
include '../koneksi/koneksi.php';

$id_pelanggan = $_POST['id_pelanggan'];

$day = date("Y-m-d");
$sql="update pelanggan set   status='non-aktif' ,tgl_putus='$day' where id_pelanggan='$id_pelanggan'";
$hasil = mysql_query($sql);
header (sprintf("location:../view/index.php?page=pelanggan"));
 ?>
