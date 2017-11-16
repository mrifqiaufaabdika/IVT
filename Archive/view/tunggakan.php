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

            <form name="bulk_action_form" action="cetakTagihan.php" method="post">
                <table class="table table-hover table-bordered " id="sampleTable" >
                  <thead>
                    <tr>
                      <th>Kd Pel</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                      <th>Jml TV</th>
                      <th>Iuran</th>
                      <th>Tunggakan</th>
                      <th>Tagihan</th>
                      <th><input type='checkbox' name='select_all' id='select_all' value='' /> Aksi</th>
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

                      if($interval >= 1){


                    echo"<tr>";
                      echo "<td>". $data['id_pelanggan']."</td>";
                      echo "<td>" . $data['nama_pelanggan']."</td>";
                      echo "<td>". $data['alamat']."</td>";
                      echo "<td>". $data['jumlah_tv']."</td>";
                      echo "<td>Rp ".  format_rupiah($data['iuran'])."</td>";
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


                        echo "<td align='center'>".$interval." Bulan </td>";
                        $total = $interval* $data['iuran'];
                        echo "<td>Rp ". format_rupiah($total)."</td>";?>
                        <td><input type='checkbox' name='checked_id[]' class='checkbox' value=" <?php echo $data['id_pelanggan']; ?>" >&nbsp<a href="cetak.php?id_pelanggan=<?php echo $data['id_pelanggan'] ?>"  ><span class="fa fa-lg fa-print"></span></a></td>;
                        <?php
                    echo "</tr>";
                  }
                  }
                      ?>
                      <!-- <tr>
                        <td >

                        </td>
                        <td>
                          <input type='checkbox' name='id_pelanggan' >
                        </td>
                      </tr> -->
                  </tbody>

              </table>
              <input type="submit" class="btn btn-primary" name="bulk_delete_submit" value="cetak"/>
            </form>
              </div>
              </div>
            </div>
          </div>
        </div>

        <script src="jquery.min.js"></script>
<script type="text/javascript">
function deleteConfirm(){
    var result = confirm("Are you sure to delete users?");
    if(result){
        return true;
    }else{
        return false;
    }
}

$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });

    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
</script>
