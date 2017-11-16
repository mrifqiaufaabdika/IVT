<?php
if($_SESSION['tipe'] != 'admin'){
  header (sprintf("location:../view/login.php"));
}



 ?>

        <div class="page-title">
          <div>
            <h1><i class="fa fa-calendar"></i> Data Tagihan Pelanggan</h1>
            <ul class="breadcrumb side">
              <li><a href="index.php?page=dashboard"><i class="fa fa-home fa-lg"></i></a></li>

              <li class="active"><a href="#">Data Tagihan</a></li>
            </ul>
          </div>
          <p> PT.Indragiri Vision Terpadu</p>
          <!-- button -->

          </div>
          <!--end  -->


          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <select class="form-control" name="tahun">
                        <optgroup label="Tahun">
                      <?php
                      for($i=date('Y'); $i>=date('Y')-5; $i-=1){
                      echo"<option value='$i'> $i </option>";
                      }
                      ?>
                      </optgroup>
                    </select>
                    </div>
                    <div class="col-md-3">
                      <button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-list-ul"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>






        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">


                <table class="table table-hover table-bordered " id="sampleTable" >
                  <thead>
                    <tr>
                      <th>Kd Pel</th>
                      <th>Nama</th>

                      <th>Jml TV</th>
                      <th>Iuran</th>
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>Mar</th>
                      <th>Apl</th>
                      <th>Mei</th>
                      <th>Jun</th>
                      <th>Jul</th>
                      <th>Ags</th>
                      <th>Spt</th>
                      <th>Okt</th>
                      <th>Nov</th>
                      <th>Des</th>
                      <th>tagihan</th>
                      <th>aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include "../koneksi/koneksi.php";
                    //$sql ="select *, extract(month from MaxTgl) as bulan, MaxTgl from (SELECT MAX(tgl_pembayaran) as MaxTgl, tgl_pembayaran, id_pelanggan from transaksi GROUP BY id_pelanggan) t join pelanggan on pelanggan.id_pelanggan = t.id_pelanggan";
                    $sql = "select * from pelanggan ";
                    $hasil = mysql_query($sql);

                    while ($data = mysql_fetch_array($hasil)) {
                      $id=$data['id_pelanggan'];


                    echo"<tr>";
                      echo "<td>". $data['id_pelanggan']."</td>";
                      echo "<td>" . $data['nama_pelanggan']."</td>";
                      echo "<td>". $data['jumlah_tv']."</td>";
                      echo "<td>". $data['iuran']."</td>";
                      // $idpel = $data['id_pelanggan'];
                      //  $sql2 = "select MAX(tgl_pembayaran) as tglMax from transaksi where id_pelanggan='$idpel'";
                      //  $hasil2 = mysql_query($sql2);
                      //  $data2 = mysql_fetch_array($hasil2);
                      //  $tgl_byr=$data2['tglMax'];
                      //  list($thnTerakhir,$blnTerakhir,$tglTerakhir)= split('[-]',$tgl_byr);
                        // for($x = 0; $x < $data['bulan'] - 1; $x++){
                        //
                        //   echo "<td><i class='fa fa-check'></i></td>";
                        // }
                        // for($y = 0; $y <= 12 - $data['bulan']; $y++){
                        //   echo "<td></td>";
                        // }

                        //mencari Tunggakan ..INI DIA
                        $sqlMaxTgl="SELECT MAX(tgl_pembayaran) as maxTgl from transaksi where id_pelanggan='$id' and year(tgl_pembayaran)='2017'";
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



                        //byr terakhir
                          list($thnTerakhir,$blnTerakhir,$tglTerakhir)= split('[-]',$tgl_byr);

                        //sekarang
                          $tgl_byr_skg =date("Y-m-d");
                          list($thnSkg,$blnSkg,$tglSkg)= split('[-]',$tgl_byr_skg);
                          //mulai bayar
                            list($thnMulai,$blnMulai,$tglMulai)= split('[-]',$data['tgl_bayar']);


                              $interval=$blnSkg-$blnTerakhir;
                              if($thnMulai==$thnSkg && $blnMulai > $blnSkg){
                                $interval =0;
                              }
                            if($interval < 0){
                              $interval=$interval+12;
                            }
                        $bulan=12;
                        $thr=$blnTerakhir;
                        $tahunSkg = date('Y');


                        if($maxTgl == null){

                        //jika baru mulai
                        for ($i=1; $i<=12  ; $i++) {
                          $dat[$i]='belum';
                          # code...
                        }



                        //  if($blnMulai >= 2){
                            //penting
                            // for ($i=1; $i <=$bulan ; $i++) {
                            //   # code...
                            //   for ($a=1; $a < $blnMulai-1; $a++) {
                            //     $dat[$a]='belum';
                            //   }
                            //   for ($a=$blnMulai-1; $a <= $thr; $a++) {
                            //     $dat[$a]='bayar';
                            //   }
                            //   for ($b=($thr); $b <=12 ; $b++) {
                            //     # code...
                            //       $dat[$b]='belum';
                            //   }
                            //
                            // }
                          //}
                        }else{

                          for ($i=1; $i < $blnMulai-1; $i++) {
                            # code...
                            $dat[$i]='belum';
                          }
                          for ($i=$blnMulai-1; $i < $blnTerakhir ; $i++) {
                            # code...
                              $dat[$i]='bayar';

                          }

                          for ($i=$blnTerakhir; $i <=12 ; $i++) {
                            # code...


                              $dat[$i]='belum';

                          }



                        }








                    for ($i=1; $i <=12 ; $i++) {
                      # code...

                      if($dat[$i]=='bayar'){
                        echo "<td><i class='fa fa-check'></i></td>";
                      }else if ($dat[$i]=='belum'){
                        echo "<td> - </td>";
                      }else{
                        echo "<td> </td>";
                      }
                    }









                        echo "<td align='center'>".$interval."</td>";
                        echo "<td></td>";
                    echo "</tr>";
                  }
                      ?>

                  </tbody>

              </table>
              </div>
              </div>
            </div>
          </div>
        </div>
