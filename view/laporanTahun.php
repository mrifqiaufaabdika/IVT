<?php
if($_SESSION['tipe'] != 'direktur'){
  header (sprintf("location:../view/login.php"));
}



 ?>
 <div class="page-title">
   <div>
     <h1><i class="fa fa-file-pdf-o"></i> Laporan Per-Tahun</h1>
     <p>PT.Indragiri Vision Terpadu</p>
   </div>

   <div>
     <ul class="breadcrumb">
       <li><i class="fa fa-home fa-lg"></i></li>
       <li><a href="../view/index.php?page=laporan">Laporan</a></li>
        <li><a href="#" class="active">Laporan per-tahun</a></li>
     </ul>
   </div>
 </div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">

        <table class="table table-hover table-bordered" id="sampleTable">
          <thead>
            <tr>
              <th>Tahun Bulan</th>
              <th>Jumlah Pembayaran</th>
              <th>Total</th>
              <th>Aksi</th>

            </tr>
          </thead>
          <tbody>

            <?php
            include "../koneksi/koneksi.php";
            $sql ="SELECT YEAR(tgl_pembayaran) AS tahun, COUNT(*) AS jumlah_pembayaran, SUM(total) as jumlah FROM transaksi where jenis_pembayaran ='Iuran Bulanan' GROUP BY YEAR(tgl_pembayaran)";
            $hasil = mysql_query($sql);
            while ($data = mysql_fetch_array($hasil)) {

            echo"<tr>";
              echo "<td>". $data['tahun']."</td>";
              echo "<td>" . $data['jumlah_pembayaran']."</td>";
              echo "<td> Rp " .format_rupiah( $data['jumlah'])."</td>";
              ?>
              <td>
                <a href="laporan/tahun.php?tahun=<?php echo $data['tahun'] ?>"  ><span class="fa fa-lg fa-print"></span></a>
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
