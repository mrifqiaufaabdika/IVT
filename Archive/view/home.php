<?php
if($_SESSION['tipe'] != 'direktur'){
  header (sprintf("location:../view/login.php"));


}

$a=date('Y');
$thn=date('Y');
if(isset($_POST['tahun'])){

  $a=$_POST['tahun'];
}

if(isset($_POST['tahun2'])){

  $thn=$_POST['tahun2'];
}


 ?>

 <div class="page-title">
   <div>
     <h1><i class="fa fa-pie-chart"></i> Grafik Laporan</h1>
     <p>PT.Indragiri Vision Terpadu</p>
   </div>
   <H3>بِسْمِ اللهِ الرَّحْمنِ الرَّحِيمِ</H3>
   <div>
     <ul class="breadcrumb">
       <li><i class="fa fa-home fa-lg"></i></li>
       <li><a href="#">Grafik Laporan</a></li>
     </ul>
   </div>
 </div>
<div class="row">

  <div class="clearfix"></div>
  <div class="col-md-6">

    <div class="card">

      <h3 class="card-title">Pendapatan Perbulan Tahun <?php echo $a ?></h3>
      <div class="card-body">
        <form class="form-horizontal" action="" method="post" >
          <div >
            <select  name='tahun'>
        <optgroup label="Pilih Tahun" >

          <?php for ($i=date('Y'); $i  >= date('Y')-5 ; $i-=1) {
            echo "<option value='$i'>$i</option>";
          } ?>
          </optgroup>
          </select>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-lg fa-fw fa-area-chart"></i></button>
                  </div>
        </form>
      </div>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="card">
      <h3 class="card-title">Pendapatan Iuran dan Registrasi <?php echo $thn ?></h3>
      <form class="form-horizontal" action="" method="post" >
        <div >
          <select  name='tahun2'>
      <optgroup label="Pilih Tahun" >

        <?php for ($i=date('Y'); $i  >= date('Y')-5 ; $i-=1) {
          echo "<option value='$i'>$i</option>";
        } ?>
        </optgroup>
        </select>
                  <button class="btn btn-primary" type="submit"><i class="fa fa-lg fa-fw fa-area-chart"></i></button>
                </div>
      </form>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="lineChart"></canvas>
      </div>
    </div>
  </div>


  <div class="col-md-6">
    <div class="card">
      <h3 class="card-title">Pie Chart Pelanggan</h3>
      <div class="embed-responsive embed-responsive-16by9">
        <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
      </div>
    </div>
  </div>



</div>

<?php

//data grafik pembayaran semua
  for ($i=0; $i < 12; $i++) {
    # code...
    $var[$i]=0;
  }

  include '../koneksi/koneksi.php';


  $sql="SELECT MONTH(tgl_pembayaran) as bulan,  SUM(total) as total from transaksi where YEAR(tgl_pembayaran)='$a' GROUP BY MONTH(tgl_pembayaran)";
  $hasil=mysql_query($sql);
  while ($data=mysql_fetch_array($hasil)) {
    # code...
    $var[$data['bulan']-1]= $data['total'];
  }
// data grafik pelanggan

for ($i=0; $i < 3; $i++) {
  # code...
  $jml[$i]=0;
}
  $sqlPel =mysql_query("SELECT count(*) as jml, area FROM pelanggan WHERE status='aktif' GROUP BY area");
  $i=0;
  while($jmlPel = mysql_fetch_array($sqlPel)){

    $jml[$i]=$jmlPel['jml'];
    $i++;
  }

  //data untuk perbandingan ... iuran bulanan
  for ($i=0; $i < 12; $i++) {
    # code...
    $iuran[$i]=0;
  }

  include '../koneksi/koneksi.php';


  $sql1="SELECT MONTH(tgl_pembayaran) as bulan,  SUM(total) as total from transaksi where YEAR(tgl_pembayaran)='$thn' and jenis_pembayaran ='Iuran Bulanan'  GROUP BY MONTH(tgl_pembayaran)";
  $hasil1=mysql_query($sql1);
  while ($data1=mysql_fetch_array($hasil1)) {
    # code...
    $iuran[$data1['bulan']-1]= $data1['total'];
  }


  //data untuk perbandingan ... Registrasi
  for ($i=0; $i < 12; $i++) {
    # code...
    $reg[$i]=0;
  }

  include '../koneksi/koneksi.php';


  $sql2="SELECT MONTH(tgl_pembayaran) as bulan,  SUM(total) as total from transaksi where YEAR(tgl_pembayaran)='$thn' and jenis_pembayaran ='Registrasi' GROUP BY MONTH(tgl_pembayaran)";
  $hasil2=mysql_query($sql2);
  while ($data2=mysql_fetch_array($hasil2)) {
    # code...
    $reg[$data2['bulan']-1]= $data2['total'];
  }


 ?>




<script src="../model/js/jquery-2.1.4.min.js"></script>
<script src="../model/js/essential-plugins.js"></script>
<script src="../model/js/bootstrap.min.js"></script>
<script src="../model/js/plugins/pace.min.js"></script>
<script src="../model/js/main.js"></script>
<script type="text/javascript" src="../model/js/plugins/chart.js"></script>
<script type="text/javascript">
//data pembayaran
  var data = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May","Jun","Jul","Ags","Spt","Oct","Nov","Des"],
    datasets: [

      {
        label: "My Second dataset",
        fillColor: "rgba(151,187,205,0.2)",
        strokeColor: "rgba(151,187,205,1)",
        pointColor: "rgba(151,187,205,1)",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(151,187,205,1)",
        data: [<?php echo $var[0]; ?>, <?php echo $var[1]; ?>, <?php echo $var[2]; ?>, <?php echo $var[3]; ?>, <?php echo $var[4]; ?>, <?php echo $var[5]; ?>, <?php echo $var[6]; ?>, <?php echo $var[7]; ?>, <?php echo $var[8]; ?>, <?php echo $var[9]; ?>, <?php echo $var[10]; ?>,  <?php echo $var[11]; ?>  ]
      }
    ]
  };

  //data pelanggan
  var pdata = [
    {
      value:  <?php echo $jml[2] ?> ,
      color:"#F7464A",
      highlight: "#FF5A5E",
      label: "Sapta Marga"
    },
    {
      value:  <?php echo $jml[1] ?> ,
      color: "#46BFBD",
      highlight: "#5AD3D1",
      label: "Pelita Jaya"
    },
    {
      value:  <?php echo $jml[0] ?>  ,
      color: "#FDB45C",
      highlight: "#FFC870",
      label: "Harapan"
    }

  ]

//data perbandingan regristrasi dan iuran
  var data2 = {
    labels: ["Jan", "Feb", "Mar", "Apr", "May","Jun","Jul","Ags","Spt","Oct","Nov","Des"],
    datasets: [
      {
        label: "My First dataset",
        fillColor: "rgba(220,220,220,0.2)",
        strokeColor: "rgba(220,220,220,1)",
        pointColor: "rgba(220,220,220,1)",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(220,220,220,1)",
        data: [<?php echo $iuran[0]; ?>, <?php echo $iuran[1]; ?>, <?php echo $iuran[2]; ?>, <?php echo $iuran[3]; ?>, <?php echo $iuran[4]; ?>, <?php echo $iuran[5]; ?>, <?php echo $iuran[6]; ?>, <?php echo $iuran[7]; ?>, <?php echo $iuran[8]; ?>, <?php echo $iuran[9]; ?>, <?php echo $iuran[10]; ?>,  <?php echo $iuran[11]; ?> ]
      },
      {
        label: "My Second dataset",
        fillColor: "rgba(151,187,205,0.2)",
        strokeColor: "rgba(151,187,205,1)",
        pointColor: "rgba(151,187,205,1)",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(151,187,205,1)",
        data: [<?php echo $reg[0]; ?>, <?php echo $reg[1]; ?>, <?php echo $reg[2]; ?>, <?php echo $reg[3]; ?>, <?php echo $reg[4]; ?>, <?php echo $reg[5]; ?>, <?php echo $reg[6]; ?>, <?php echo $reg[7]; ?>, <?php echo $reg[8]; ?>, <?php echo $reg[9]; ?>, <?php echo $reg[10]; ?>,  <?php echo $reg[11]; ?> ]
      }
    ]
  };

  var ctxl = $("#lineChartDemo").get(0).getContext("2d");
  var lineChart = new Chart(ctxl).Line(data);

  var ctxl = $("#lineChart").get(0).getContext("2d");
  var lineChart = new Chart(ctxl).Line(data2);

  var ctxp = $("#pieChartDemo").get(0).getContext("2d");
  var barChart = new Chart(ctxp).Pie(pdata);


</script>
