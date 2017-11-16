<html>
<?php
if($_SESSION['tipe'] != 'direktur'){
  header (sprintf("location:../view/login.php"));
}

$dari=@$_GET['dari'];
$sampai=@$_GET['sampai'];
 ?>
 <body>
 <div class="page-title">
   <div>
     <h1><i class="fa fa-file-pdf-o"></i> Laporan Priode</h1>
     <p>PT.Indragiri Vision Terpadu</p>
   </div>

   <div>
     <ul class="breadcrumb">
       <li><i class="fa fa-home fa-lg"></i></li>
       <li><a href="#">Laporan</a></li>
        <li><a href="#" class="active">Laporan Priode</a></li>
     </ul>
   </div>
 </div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-title-w-btn">
        <h3 class="title">Tanggal Priode</h3>

      </div>
      <div class="card-body">

      <form class="form-horizontal" action="../control/tglPriode.php" method="post" >
        <div class="row">
          <div class="col-md-3">
            <input class="form-control" name="dari" id="demoDate" type="text" placeholder="Pilih Tanggal">
          </div>
          <div class="col-md-3">
            <input class="form-control" name="sampai" id="demoTanggal" type="text" placeholder="Pilih Tanggal">
          </div>
          <div class="col-md-3">
            <button class="btn btn-primary icon-btn" type="sumbit">Generate</button></span>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
<?php if($dari != null && $sampai != null){ ?>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><a  class="btn btn-primary" href="laporan/priode.php?dari=<?php echo $dari ?>&sampai=<?php echo $sampai ?>"  ><span class="fa fa-lg fa-print"></span> Print</a></div>
      <div class="panel-body">

        <table class="table table-hover table-bordered" id="sampleTable">
          <thead>
            <tr>
              <th>No Transaksi</th>
              <th>ID Pelanggan</th>
              <th>Nama Pelanggan</th>
              <th>Pegawai</th>
              <th>Qty</th>
              <th>Tgl Bayar</th>
              <th>Total</th>

            </tr>
          </thead>
          <tbody>

            <?php
            include "../koneksi/koneksi.php";
            $sql ="select a.*,b.*,c.* from transaksi a,pelanggan b,pegawai c where a.jenis_pembayaran ='Iuran Bulanan' and a.tgl_pembayaran BETWEEN '$dari' and '$sampai' and a.id_pelanggan =b.id_pelanggan and a.NIP = c.NIP";
            $hasil = mysql_query($sql);
            while ($data = mysql_fetch_array($hasil)) {

              echo"<tr>";

                echo "<td>". $data['no_faktur']."</td>";
                echo "<td>" . $data['id_pelanggan']."</td>";
                echo "<td>" . $data['nama_pelanggan']."</td>";
                echo "<td>".$data['nama_pegawai']." ". $data['NIP']."</td>";
                echo "<td>". $data['jumlah_tunggakan']."</td>";
                echo "<td>". $data['tgl_pembayaran']."</td>";
                echo "<td> Rp ".format_rupiah($data['total'])."</td>";

              echo "</tr>";
          }
            ?>

          </tbody>
        </table>
      </div>
    </div>

  </div>
<?php } ?>

</div>




  <script type="text/javascript" src="../model/js/plugins/bootstrap-datepicker.min.js"></script>

  <script type="text/javascript">



    $('#demoDate').datepicker({
      format: "dd/mm/yyyy",
      autoclose: true,
      todayHighlight: true
    });

    $('#demoTanggal').datepicker({
      format: "dd/mm/yyyy",
      autoclose: true,
      todayHighlight: true
    });


  </script>
</body>
</html>
