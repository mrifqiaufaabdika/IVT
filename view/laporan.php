<?php
if($_SESSION['tipe'] != 'direktur'){
  header (sprintf("location:../view/login.php"));
}

 ?>
 <div class="page-title">
   <div>
     <h1><i class="fa fa-file-pdf-o"></i> Laporan</h1>
     <p>PT.Indragiri Vision Terpadu</p>
   </div>

   <div>
     <ul class="breadcrumb">
       <li><i class="fa fa-home fa-lg"></i></li>
       <li><a href="#">Laporan</a></li>
     </ul>
   </div>
 </div>
<div class="row">
  <div class="col-md-3">
      <a href="../view/index.php?page=harian">
    <div class="widget-small primary"><i class="icon fa fa-calendar-o fa-3x"></i>
      <div class="info">
        <h4>Harian</h4>

      </div>
    </div>
  </a>
  </div>
  <div class="col-md-3">
      <a href="../view/index.php?page=bulanan">
    <div class="widget-small info"><i class="icon fa fa-moon-o fa-3x"></i>
      <div class="info">
        <h4>Bulanan</h4>

      </div>
    </div>
  </a>
  </div>
  <div class="col-md-3">
      <a href="../view/index.php?page=tahun">
    <div class="widget-small warning"><i class="icon fa fa-calendar fa-3x"></i>
      <div class="info">
        <h4>Tahun</h4>

      </div>
    </div>
  </a>
  </div>
  <div class="col-md-3">
    <a href="../view/index.php?page=priode">
    <div class="widget-small danger"><i class="icon fa fa-calendar-minus-o fa-3x"></i>

      <div class="info">
        <h4>Priode</h4>

      </div>
    </div>
    </a>
  </div>
  <div class="col-md-3">
      <a href="../view/index.php?page=registrasi">
    <div class="widget-small primary"><i class="icon fa fa-calendar-o fa-3x"></i>
      <div class="info">
        <h4>Laporan Registrasi</h4>

      </div>
    </div>
  </a>
  </div>
  </div>
