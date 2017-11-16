<?php
if($_SESSION['tipe'] != 'admin'){
  header (sprintf("location:../view/login.php"));
}

 ?>
<!-- NO faktur Pembayaran-->
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

  $idPel =@$_GET['id_pelanggan'];
?>
<!--End Faktur Pembayaran-->



<div class="page-title">
  <div>
    <h1><i class="fa fa-calculator"></i> Transaksi</h1>
      <!--breadcrumb-->
    <ul class="breadcrumb side">
      <li><a href="index.php?page=dashboard"><i class="fa fa-home fa-lg"></i></a></li>

      <li class="active"><a href="#">Transaksi</a></li>
    </ul>
  </div>

    <!--end-->
  <div>
    <div><a class="btn btn-info btn-flat" href="index.php?page=transaksi"><i class="fa fa-lg fa-refresh"></i></a></div>


  </div>

</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">

          <div class="well bs-component">

              <fieldset>
                <form class="form-horizontal" action="../control/idTransaksi.php" method="post" >
                <legend>
                  ID Pelanggan
                <div class="form-group">

                    <div class="col-lg-6 col-lg-offset-6">

                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-group"></i></span>

                      <input class="form-control" type="text" placeholder="ID Pelanggan" name="id_pelanggan"><span class="input-group-btn">
                      <button class="btn btn-default" type="sumbit">Generate</button></span>
                    </form>
                    </div>
                  </div>
                </div>
                </legend>


                  <?php
                  if ($idPel != null) {
                    include '../koneksi/koneksi.php';
                    $id_pelanggan= $_GET['id_pelanggan'];
                    $sql="select * from pelanggan where id_pelanggan='$id_pelanggan'";
                    $hasil=mysql_query($sql);
                    $data=mysql_fetch_array($hasil);

                    $idPengguna = $_SESSION['idPengguna'];
                    $sqlPetugas = "select * from pegawai where NIP='$idPengguna'";
                    $dataPegawai=mysql_fetch_array(mysql_query($sqlPetugas));
                    ?>

                      <center><h3 class="card-title">Data Pembayaran</h3></center>
                        <div class="col-md-8">

                <table>
                  <tbody>
                    <tr>
                      <td>ID Pelanggan </td><td>&nbsp:&nbsp </td><td><?php echo $data['id_pelanggan'] ;?></td>
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
                    <td>No Transaksi</td><td>&nbsp:&nbsp </td><td><?php echo $newID_Transaksi; ?></td>
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

                  <form class="form-horizontal" action="../control/prosesTransaksi.php" method="post">
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
                      $sqlMaxTgl="SELECT MAX(tgl_pembayaran) as maxTgl from transaksi where id_pelanggan='$id_pelanggan' and jenis_pembayaran='Iuran Bulanan'";
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
                      //mulai bayar
                        list($thnMulai,$blnMulai,$tglMulai)= split('[-]',$data['tgl_bayar']);


                          $interval=$blnSkg-$blnTerakhir;

                        if($interval < 0){
                          $interval=$interval+12;
                        }

                        if($maxTgl == null){
                          $interval+=1;
                        //jika sudah bayar ambil data terakhir bayar
                        }
                        if($thnMulai==$thnSkg && $blnMulai > $blnSkg){
                          $interval =0;
                        }
                      ?>



                      Jumlah Tunggakan : <?php echo $interval; ?> Bulan


                      <table class="table">
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
                            if($thnMulai==$thnSkg && $blnMulai > $blnSkg){
                              $interval =0;
                            }else{

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
                            <td></td>
                            <td colspan="3">Total :</td>
                            <td><?php echo "Rp ".format_rupiah($jumlah).""; ?></td>
                            <input type="hidden" name="total" value="<?php echo $jumlah; ?>">
                            <input type="hidden" name="qty" value="<?php echo $interval; ?>">
                          </tr>

                        </tbody>
                      </table>
                        <a href="tambahPelanggan.php" data-toggle="modal" data-target="#myModal">Tambah</a>
                      <input type="hidden" name="id_pelanggan" value="<?php echo $data['id_pelanggan'] ?>">
                      <input type="hidden" name="no_faktur" value="<?php echo $newID_Transaksi; ?>">
                      <input type="hidden" name="tgl" value="<?php echo $tgl_byr; ?>">

                    </div>

                </div>

                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-9">
                    <a class="btn btn-default" href="../view/cetak.php?id_pelanggan=<?php echo $id_pelanggan; ?>" target="_blank">Cetak</a>
                    <button class="btn btn-primary" type="submit" >Bayar</button>

                  </div>
                </div>
                </form>
              </fieldset>
                <?php } ?>
          </div>


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



 <div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Pemutusan</h4>
         </div>
         <div class="modal-body">
           <form class="form-horizontal" action="../control/tambahPelanggan.php" method="post">
             <div class="form-group">
               <label class="control-label col-md-3">ID Pelanggan</label>
               <div class="col-md-8">
                 <input class="form-control" type="text" name="id_pelanggan">
               </div>
             </div>



           <div class="modal-footer">


             <button class="btn btn-default icon-btn" data-dismiss="modal" ><i class="fa fa-fw fa-lg fa-close"></i>Cancel</button>&nbsp;&nbsp;&nbsp;
             <button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Register</button>

         </div>

         </form>
         </div>



       </div>
     </div>
 </div>
