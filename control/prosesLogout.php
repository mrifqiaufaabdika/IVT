<?php
session_start();

session_destroy();

header (sprintf("location:../view/login.php"));


 ?>
