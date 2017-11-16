<?php
if($_SESSION['tipe'] != 'direktur'){
  header (sprintf("location:../view/login.php"));
}

 ?>
 <div class="page-title">
   <div>
     <h1><i class="fa fa-file-pdf-o"></i> Laporan Harian</h1>
     <p>PT.Indragiri Vision Terpadu</p>
   </div>

   <div>
     <ul class="breadcrumb">
       <li><i class="fa fa-home fa-lg"></i></li>
       <li><a href="../view/index.php?page=laporan">Laporan</a></li>
        <li><a href="#">Laporan Harian</a></li>
     </ul>
   </div>
 </div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-title-w-btn">
        <h3 class="title">Cetak :</h3>

      </div>
      <div class="card-body">
        <?php $date=date("Y-m-d");
          $kemarin=date("Y-m-d",mktime(0,0,0,date("m"),date("d")-1,date("Y")));
         ?>
      <a href="laporan/harian.php?tgl=<?php echo $date?>"  ><span class="fa fa-lg fa-print">Hari Ini</span></a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="laporan/harian.php?tgl=<?php echo $kemarin?>"  ><span class="fa fa-lg fa-print">Kemarin</span></a>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">

        <table class="table table-hover table-bordered" id="sampleTable">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Jumlah Pembayaran</th>
              <th>Total</th>
              <th>Aksi</th>

            </tr>
          </thead>
          <tbody>

            <?php
            include "../koneksi/koneksi.php";
            $sql ="SELECT tgl_pembayaran,SUM(total) as jumlah, COUNT(*) as jumlah_pembayaran FROM transaksi where jenis_pembayaran ='Iuran Bulanan' GROUP BY tgl_pembayaran";
            $hasil = mysql_query($sql);
            while ($data = mysql_fetch_array($hasil)) {
              $tampilTgl = date('d/m/Y',strtotime($data['tgl_pembayaran']));
            echo"<tr>";
              echo "<td>". $tampilTgl."</td>";
              echo "<td>" . $data['jumlah_pembayaran']."</td>";
              echo "<td> Rp " .format_rupiah( $data['jumlah'])."</td>";
            ?>
              <td>
                <a href="laporan/harian.php?tgl=<?php echo $data['tgl_pembayaran'] ?>"  ><span class="fa fa-lg fa-print"></span></a>
              </td>
            <?php
            echo "</tr>";
          }

            ?>

          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
