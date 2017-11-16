<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="icon" href="../gambar/LOGO.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../model/css/main.css">
    <title>CBMS IVT</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
    <script src="../model/jquery.min.js"></script>
  </head>

<script>
window.load = print_d();
function print_d(){
  window.print();
}
</script>

<?php
  include ('../koneksi/koneksi.php');
  $sql ="select max(no_faktur) as maxKode from transaksi";
  $hasil = mysql_query($sql);
  $data=mysql_fetch_array($hasil);
  $no_faktur = $data['maxKode'];
  $noUrut =(int)substr($no_faktur,1,4);
  $noUrut++;
  $char ="F";
  $newID_Transaksi =$char.sprintf("%04s",$noUrut);


?>
<?php

session_start();


if(isset($_POST['bulk_delete_submit'])){
        $idArr = $_POST['checked_id'];
        foreach($idArr as $id){
          echo $id;



          $sql="select * from pelanggan where id_pelanggan='$id'";
          $hasil=mysql_query(($sql));
          $data=mysql_fetch_array($hasil);

          $idPengguna = $_SESSION['idPengguna'];
          $sqlPetugas = "select * from pegawai where NIP='$idPengguna'";
          $dataPegawai=mysql_fetch_array(mysql_query($sqlPetugas));
          ?>
        <fieldset>

        <div class="row">
          <div class="col-md-3">

          </div>

        <div class="col-md-9">
          <table width="100%" align="center"  >
               <tr>
               <td width='25%' align="center"><img src="../gambar/LOGO.png" width='100px' alt="pdam" /></td>
               <td width='75%' align="center"><H4><b>PT. INDRAGIRI VISION TERPADU</b></H4> JL. Harapan Gg.Harapan 1 No.49 28291 <br> Telp : 0761-7608229 Fax:0761-571352  www.ivtinhil.com </td>

             </tr>


           <tr>
             <td colspan="2"><hr color="red"></hr></td>
           </tr>




             </table>
          <center><h3 class="card-title">Bukti Pembayaran</h3></center>
        <div class="row">
        <div class="col-md-8">

        <table >
        <tbody>
          <tr>
            <td>ID Pelanggan </td><td>&nbsp:&nbsp </td><td><?php echo $data['id_pelanggan'];?></td>
          </tr>
          <tr>
            <td>Nama</td><td> &nbsp:&nbsp </td><td><?php echo $data['nama_pelanggan'] ;?></td>
          </tr>
          <tr>
            <td>Alamat</td><td> &nbsp:&nbsp </td><td><?php echo $data['alamat'] ;?></td>
          </tr>
          <tr>
            <td>Jumlah TV</td><td> &nbsp:&nbsp</td><td><?php echo $data['jumlah_tv'] ."   ( Rp ". format_rupiah($data['iuran']).")";?></td>
          </tr>

        </tbody>
        </table>
        </div>
        <div class="col-md-4">

        <table>
        <tbody>
        <tr>
          <td>No Transaksi</td><td>&nbsp:&nbsp </td><td><?php echo "Belum LUNAS"; ?></td>
        </tr>
        <tr>
          <td>Tanggal</td><td> &nbsp:&nbsp </td><td><?php echo date('d-m-Y') ; ?></td>
        </tr>
        <tr>

          <td>Petugas</td><td> &nbsp:&nbsp </td><td><?php echo $dataPegawai['nama_pegawai']; ?></td>
        </tr>


        </tbody>
        </table>

        </div>
        <div class="col-md-12">

          <div class="table-responsive">
            <?php
            // mengambil nomor faktur teratas
            // $sqlByr ="select max(no_faktur) as maxKode from transaksi where id_pelanggan='$id_pelanggan'";
            // $hasilByr = mysql_query($sqlByr);
            // $dataByr=mysql_fetch_array($hasilByr);
            // $no_faktur = $dataByr['maxKode'];
            // //deklarisasi tgl bayar terakhir
            // $tgl_byr ;
            // //cek ada tidak di tabel transaksi
            // if($no_faktur==null){
            //   //jika tidak ada ambil TGL Bayar dari tabel pelanggan atribut mulai bayar
            //   $tgl_byr= $data['tgl_bayar'];
            // }else {
            //   //jika ada maka ambil TGL Bayar dari tabel transaksi
            //   $sql1="select * from transaksi where no_faktur='$no_faktur'";
            //   $hasil1=mysql_query($sql1);
            //   $data1=mysql_fetch_array($hasil1);
            //   $tgl_byr=$data1['tgl_pembayaran'];
            // }
            //query max tgl
            $sqlMaxTgl="SELECT MAX(tgl_pembayaran) as maxTgl from transaksi where id_pelanggan='$id'and jenis_pembayaran='Iuran Bulanan' ";
            $hasilMaxTgl = mysql_query($sqlMaxTgl);
            $dataMaxTgl = mysql_fetch_array($hasilMaxTgl);
            //ambil max tgl
            $maxTgl = $dataMaxTgl['maxTgl'];
            //deklarasi max tgl byr
            $tgl_byr ;
            //jika blm bayar maka pakai pembayaran awal
            if($maxTgl == null){
              $tgl_byr= $data['tgl_bayar'];
            //jika sudah bayar ambil data terakhir bayar
            }else {
              # code...
              $tgl_byr =$maxTgl ;
            }


            // $tgl=date_create($tgl_byr);
            // $tgl_skg =date_create(date("Y-m-d"));
            // $diff = date_diff ($tgl,$tgl_skg);
            // $intervalBulan= $diff->format("%m");
            //  $intervalHari= $diff->format("%D");
            //  $intervalTahun= $diff->format("%Y");
          //   //  cek dulu bulan sama atau tidak
          //   // kalau sama LUNAS
          //   // kalau tidak sama dan jaraknya 1
          //   $interval;
          //   if($intervalBulan ==0){
          //    $interval= $intervalHari/30;
          //  }else {
          //    $interval =$intervalBulan +($intervalHari/30);
          //  }
            //byr terakhir
              list($thnTerakhir,$blnTerakhir,$tglTerakhir)= split('[-]',$tgl_byr);
            //sekarang
              $tgl_byr_skg =date("Y-m-d");
              list($thnSkg,$blnSkg,$tglSkg)= split('[-]',$tgl_byr_skg);
              $interval=$blnSkg-$blnTerakhir;
              if($interval < 0){
                $interval=$interval+12;
              }
              if($maxTgl == null){
                $interval+=1;
              //jika sudah bayar ambil data terakhir bayar
              }

            ?>



            Jumlah Tunggakan : <?php echo $interval; ?> Bulan

            <table class="table ">
              <thead>
                <tr>
                  <th>NO</th>
                  <th>Item</th>
                  <th>Qty</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if($maxTgl == null){
                  $interval-=1;
                //jika sudah bayar ambil data terakhir bayar
                }
                $jumlah =0;
                $bulan = date('m');
                if ($maxTgl==null) {
                  # code...
                  for ($i=0;$i <= $interval; $i++){
                    $no = $i+1;
                    $jml = 1;
                    $harga =$jml* $data['iuran'];
                    $jumlah =$harga+$jumlah;
                    $bulan=$bulan-1;
                    if($bulan ==0 ){
                      $bulan=12;
                    }
                    $item = bulan($bulan);
                  echo"<tr>";
                    echo "<td>".$no ."</td>";
                    echo "<td>" . $item."</td>";
                    echo "<td>". $jml ."</td>";
                    echo "<td>Rp ". format_rupiah($data['iuran'])."</td>";
                    echo "<td>Rp ". format_rupiah($harga)."</td>";
                  echo "</tr>";
                  }
                } else {
                  # code...


                for ($i=0;$i < $interval; $i++){
                  $no = $i+1;
                  $jml = 1;
                  $harga =$jml* $data['iuran'];
                  $jumlah =$harga+$jumlah;
                  $bulan=$bulan-1;
                  if($bulan ==0 ){
                    $bulan=12;
                  }
                  $item = bulan($bulan);
                echo"<tr>";
                  echo "<td>".$no ."</td>";
                  echo "<td>" . $item."</td>";
                  echo "<td>". $jml ."</td>";
                  echo "<td>Rp ". format_rupiah($data['iuran'])."</td>";
                  echo "<td>Rp ". format_rupiah($harga)."</td>";
                echo "</tr>";
                }
              }

                ?>
                <tr>
                  <td colspan="3"></td>
                  <td >Total :</td>
                  <td><?php echo "Rp ".format_rupiah($jumlah).""; ?></td>
                  <input type="hidden" name="total" value="<?php echo $jumlah; ?>">
                </tr>

              </tbody>
            </table>


          </div>

        </div>
        </div>
        </div>
        </div>


        </fieldset>
        <?php
        }

    }
?>





<?php
function format_rupiah($angka){
  $rupiah=number_format($angka,0,',','.');
  return $rupiah;
}
 ?>

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

  <script src="../model/js/jquery-2.1.4.min.js"></script>
  <script src="../model/js/essential-plugins.js"></script>
  <script src="../model/js/bootstrap.min.js"></script>
  <script src="../model/js/plugins/pace.min.js"></script>
  <script src="../model/js/main.js"></script>
  <script type="text/javascript" src="../model/js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="../model/js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">$('#sampleTable').DataTable();</script>
  <script type="text/javascript" src="../model/js/plugins/bootstrap-notify.min.js"></script>
  <script type="text/javascript" src="../model/js/plugins/sweetalert.min.js"></script>

  </html>
