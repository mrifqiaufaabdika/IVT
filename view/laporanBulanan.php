<?php
if($_SESSION['tipe'] != 'direktur'){
  header (sprintf("location:../view/login.php"));
}

 ?>
 <div class="page-title">
   <div>
     <h1><i class="fa fa-file-pdf-o"></i> Laporan Bulanan</h1>
     <p>PT.Indragiri Vision Terpadu</p>
   </div>

   <div>
     <ul class="breadcrumb">
       <li><a href="../view/index.php?page=home"><i class="fa fa-home fa-lg"></a></i></li>
       <li><a href="../view/index.php?page=laporan">Laporan</a></li>
        <li><a href="#">Laporan Bulanan</a></li>
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
            $sql ="SELECT CONCAT(MONTH(tgl_pembayaran),'/',YEAR(tgl_pembayaran)) AS tahun_bulan,SUM(total) as jumlah, COUNT(*) as jumlah_pembayaran FROM transaksi where jenis_pembayaran ='Iuran Bulanan' GROUP BY YEAR(tgl_pembayaran),MONTH(tgl_pembayaran)";
            $hasil = mysql_query($sql);
            while ($data = mysql_fetch_array($hasil)) {

            echo"<tr>";
              echo "<td> (". bulan($data['tahun_bulan']).") ".$data['tahun_bulan']."</td>";
              echo "<td>" . $data['jumlah_pembayaran']."</td>";
              echo "<td> Rp " .format_rupiah( $data['jumlah'])."</td>";
              ?>
            <td>
            <!-- <form action="../pages/print/dataPermintaan.php" method="POST">
              <input type="hidden" value="<?php echo  $data['noPengadaan']; ?>" name="noPengadaan">
              <button type="submit" ><span class="fa fa-lg fa-print"></span></button>
            </form> -->
              <a href="../view/laporan/bulanan.php?tahun=<?php echo $data['tahun_bulan'] ?>"><span class="fa fa-lg fa-print"></span></a>


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

  <?php
  function bulan($bulan)
  {
  Switch ($bulan){
      case 1 : $bulan="Januari";
          Break;
      case 2 : $bulan="Februari";
          Break;
      case 3 : $bulan="Maret";
          Break;
      case 4 : $bulan="April";
          Break;
      case 5 : $bulan="Mei";
          Break;
      case 6 : $bulan="Juni";
          Break;
      case 7 : $bulan="Juli";
          Break;
      case 8 : $bulan="Agustus";
          Break;
      case 9 : $bulan="September";
          Break;
      case 10 : $bulan="Oktober";
          Break;
      case 11 : $bulan="November";
          Break;
      case 12 : $bulan="Desember";
          Break;
      }
  return $bulan;
  }

   ?>
