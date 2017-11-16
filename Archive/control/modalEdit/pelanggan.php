<?php
include '../../koneksi/koneksi.php';
$id = $_GET['id_pelanggan'];

$sql = "SELECT * FROM pelanggan WHERE id_pelanggan = '$id'";
$hasil = mysql_query($sql);
while ($data = mysql_fetch_array($hasil)){
?>
<!-- modal Edit-->
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Edit Pelanggan</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="post" action="../control/prosesPelanggan.php?action=edit">
            <div class="form-group">
              <label class="control-label col-md-3">ID Pelanggan</label>
              <div class="col-md-8">
                <input class="form-control" type="text" name="id_pelanggan" value="<?php echo $data['id_pelanggan']?>">
              </div>
            </div>
          <div class="form-group">
            <label class="control-label col-md-3">Nama</label>
            <div class="col-md-8">
              <input class="form-control" type="text" placeholder="Nama Lengkap" name="nama" value="<?php echo $data['nama_pelanggan']?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">No HP</label>
            <div class="col-md-8">
              <input class="form-control col-md-8"  placeholder="Nomor Handphone" name="noHp" value="<?php echo $data['No_HP']?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">Alamat</label>
            <div class="col-md-8">
              <textarea class="form-control" rows="4"  name="alamat" value="<?php echo $data['alamat']?>"><?php echo $data['alamat']?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3" >Jenis Klamin</label>
            <div class="col-md-9">
              <div class="radio-inline">
                <label>
                  <input type="radio" name="jk" value="L"<?php if($data['jenis_kelamin']=='L'){echo "checked";}?>>Laki-laki
                </label>
              </div>
              <div class="radio-inline">
                <label>
                  <input type="radio" name="jk" value="P" <?php if($data['jenis_kelamin']=='P'){echo "checked";}?>>Perempuan
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3" >Area Sambungan</label>
            <div class="col-md-8">
              <select class="form-control" name="area">
          <optgroup label="Select Area">
            <option value="<?php echo $data['area']; ?>"><?php echo $data['area']; ?></option>
            <option value="Harapan">Harapan</option>
            <option value="Sapta Marga">Sapta Marga</option>
            <option value="Pelita Jaya">Pelita Jaya</option>

          </optgroup>
        </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3" >Jumlah TV</label>
            <div class="col-md-8">
              <input class="form-control"  type="number" name="jumlahTV" placeholder="Jumlah TV" value="<?php echo $data['jumlah_tv']?>"></input>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3" >Iuran @bulan</label>
            <div class="col-md-9">

              <div class="radio-inline">
                <label>
                  <input type="radio" name="iuran" value="20000" <?php if($data['iuran']=='20000'){echo "checked";}?>>Rp.20.000
                </label>
              </div>
              <div class="radio-inline">
                <label>
                  <input type="radio" name="iuran" value="30000" <?php if($data['iuran']=='30000'){echo "checked";}?>>Rp.30.000
                </label>
              </div>
              <div class="radio-inline">
                <label>
                  <input type="radio" name="iuran" value="40000" <?php if($data['iuran']=='40000'){echo "checked";}?>>Rp.40.000
                </label>
              </div>
              <div class="radio-inline">
                <label>
                  <input type="radio" name="iuran" value="50000" <?php if($data['iuran']=='50000'){echo "checked";}?>>Rp.50.000
                </label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3">Tgl.Mulai Bayar</label>
            <div class="col-md-8">
              <input class="form-control"  name="tgl_bayar"type="date" placeholder="Tanggal Mulai Bayar" value="<?php echo $data['tgl_bayar']?>"></input>
            </div>
          </div>



          <div class="modal-footer">


            <a class="btn btn-default icon-btn" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>&nbsp;&nbsp;&nbsp;
            <button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Register</button>

        </div>

        </form>
        </div>

<?php } ?>

      </div>
    </div>
</div>

<!-- end modal -->
