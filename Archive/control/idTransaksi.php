<?php
$id_pelanggan = $_POST['id_pelanggan'];



header (sprintf("location:../view/index.php?page=transaksi&id_pelanggan=$id_pelanggan"));


 ?>
