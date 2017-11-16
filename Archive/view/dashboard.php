<?php
if($_SESSION['tipe'] != 'admin'){
  header (sprintf("location:../view/login.php"));
}
 ?>

<!-- New ID Pelanggan -->
<?php
  include ('../koneksi/koneksi.php');
  $sqlPel ="select max(id_pelanggan) as maxKode from pelanggan";
  $hasilPel = mysql_query($sqlPel);
  $dataPel=mysql_fetch_array($hasilPel);
  $ID_Pel = $dataPel['maxKode'];
  $noUrut =(int)substr($ID_Pel,1,4);
  $noUrut++;
  $char ="P";
  $newID =$char.sprintf("%04s",$noUrut);
?>
<!-- End New ID pelanggan -->

<div class="page-title">
  <div>
    <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
    <p> PT.Indragiri Vision Terpadu</p>


  </div>
  <center> <H3>السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ </H3> </center>
  <!--breadcrumb-->
  <div>
    <ul class="breadcrumb">
      <li><i class="fa fa-home fa-lg"></i></li>
      <li><a href="#">Dashboard</a></li>
    </ul>
  </div>
  <!--end-->
</div>

<div class="row">

  <div class="col-md-3">
              <a href="index.php?page=transaksi">
              <div class="widget-small primary"><i class="icon fa fa-book fa-3x"></i>
                <div class="info">
                  <h4>Transaksi</h4>

                </div>
              </div>
            </a>

</div>
<div class="col-md-3">
            <a href="index.php?page=pelanggan">
              <div class="widget-small info"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                  <h4>Pelanggan</h4>
                  <?php
                  include '../koneksi/koneksi.php';
                  $sql="select * from pelanggan ";
                  $hasil= mysql_query($sql);
                  $jumlah = mysql_num_rows($hasil);
                   ?>
                  <p> <b><?php echo $jumlah; ?> Pelanggan</b></p>
                </div>
              </div>
            </a>
</div>

<div class="col-md-3">
            <a href="#" data-toggle="modal" data-target="#myModal">
              <div class="widget-small danger"><i class="icon fa fa-user-plus fa-3x"></i>
                <div class="info">
                  <h4>Regristrasi Baru</h4>

                </div>

              </div>
              </a>
</div>
<div class="col-md-3">
            <a href="pemutusan.php" data-toggle="modal" data-target="#myModal2">
              <div class="widget-small warning coloured-icon"><i class="icon fa fa-user-times fa-3x"></i>
                <div class="info">
                  <h4>Pemutusan</h4>

                </div>
              </div>
            </a>
            </div>



  <div class="col-md-6">
            <div class="card">
              <h3 class="card-title">Visi </h3>
              <div class="card-footer">Menjadi penyedia layanan televise berlangganan melalui kabel yang mampu memenuhi kebutuhan informasi, hiburan yang mendidik dan berkualitas bagi masyarakat Kabupaten Indragiri Hilir serta turut andil dalam membangun Kabupaten Indragiri Hilir lebih maju di bidang informasi </div>

            </div>
          </div>

          <div class="col-md-6">
                    <div class="card">
                      <h3 class="card-title">Misi</h3>
                      <div class="card-footer">
                        1.	Memberi layanan chanel program yang beragam dan berkualitas yang ramah bagi seluruh anggota keluarga.<br>
                        2.	Memberikan informasi kepada masyarakat secara tepat, cepat dan bermutu.<br>
                        3.	Memberikan layanan televise berbayar dengan harga yang terjangkau oleh masyarakat sesuai dengan kempuan ekonomi masyarkat yang mayoritas adalah petani dan nelayan.<br>
                        4.	Meningkatkan kesejahteraan karyawan sehingga mampu dan ikhlas menyediakan pelayanan bagi pelanggan.<br>
                      </div>
                    </div>
                  </div>

                  <!-- <div class="col-md-6">
                          <div class="card">
                                      <h3 class="card-title">Motto IVT</h3>
                                      <div class="card-footer">“CABLE TV SULUTION NETWORK”</div>

                                    </div>
                                  </div> -->

</div>




<!-- modal tambah pelanggan-->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Tambah Pelanggan</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="../control/prosesPelanggan.php?action=tambah" method="post">
            <div class="form-group">
              <label class="control-label col-md-3">ID Pelanggan</label>
              <div class="col-md-8">
                <input class="form-control" type="text" name="id_pelanggan" value="<?php echo $newID ?>">
              </div>
            </div>
          <div class="form-group">
            <label class="control-label col-md-3">Nama</label>
            <div class="col-md-8">
              <input class="form-control" type="text" placeholder="Nama Lengkap" name="nama">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">No HP</label>
            <div class="col-md-8">
              <input class="form-control col-md-8"  placeholder="Nomor Handphone" name="noHp">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">Alamat</label>
            <div class="col-md-8">
              <textarea class="form-control" rows="4" placeholder="Alamat" name="alamat"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3" >Jenis Klamin</label>
            <div class="col-md-9">
              <div class="radio-inline">
                <label>
                  <input type="radio" name="jk" value="L">Laki-laki
                </label>
              </div>
              <div class="radio-inline">
                <label>
                  <input type="radio" name="jk" value="P">Perempuan
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3" >Area Sambungan</label>
            <div class="col-md-8">
              <select class="form-control" name="area">
          <optgroup label="Select Area">
            <option value="Harapan">Harapan</option>
            <option value="Sapta Marga">Sapta Marga</option>
            <option value="Pelita Java">Pelita Jaya</option>

          </optgroup>
        </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3" >Jumlah TV</label>
            <div class="col-md-8">
              <input class="form-control"  type="number" name="jumlahTV" placeholder="Jumlah TV"></input>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3" >Iuran @bulan</label>
            <div class="col-md-9">

              <div class="radio-inline">
                <label>
                  <input type="radio" name="iuran" value="20000">Rp.20.000
                </label>
              </div>
              <div class="radio-inline">
                <label>
                  <input type="radio" name="iuran" value="30000">Rp.30.000
                </label>
              </div>
              <div class="radio-inline">
                <label>
                  <input type="radio" name="iuran" value="40000">Rp.40.000
                </label>
              </div>
              <div class="radio-inline">
                <label>
                  <input type="radio" name="iuran" value="50000">Rp.50.000
                </label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3">Tgl.Mulai Bayar</label>
            <div class="col-md-8">
              <input class="form-control"  name="tgl_bayar"type="date" placeholder="Tanggal Mulai Bayar"></input>
            </div>
          </div>



          <div class="modal-footer">


            <button class="btn btn-default icon-btn" type="reset" ><i class="fa fa-fw fa-lg fa-refresh"></i>Reset</button>&nbsp;&nbsp;&nbsp;
            <button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Register</button>

        </div>

        </form>
        </div>



      </div>
    </div>
</div>

<!-- end modal -->

<!-- modal pemutusan -->

<div class="modal fade" id="myModal2" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Pemutusan</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="../control/prosesPemutusan.php" method="post">
            <div class="form-group">
              <label class="control-label col-md-3">ID Pelanggan</label>
              <div class="col-md-8">
                <input class="form-control" type="text" name="id_pelanggan" placeholder="Masukan ID Pelanggan"  required>
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
