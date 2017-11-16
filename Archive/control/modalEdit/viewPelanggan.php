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
            <h4 class="modal-title" id="myModalView">Edit Pelanggan</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="post" action="../control/prosesPelanggan.php?action=edit">
            <div class="form-group">
              <label class="control-label col-md-5">ID Pelanggan</label>
              <div class="col-md-7">
                <?php echo $data['id_pelanggan']?>
              </div>
            </div>
          <div class="form-group">
            <label class="control-label col-md-5">Nama</label>
            <div class="col-md-7">
              <?php echo $data['nama_pelanggan']?>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-5">No HP</label>
            <div class="col-md-7">
            <?php echo $data['No_HP']?>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-5">Alamat</label>
            <div class="col-md-7">
              <?php echo $data['alamat']?>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-5" >Jenis Klamin</label>
            <div class="col-md-7">

                <?php echo $data['jenis_kelamin']?>


              </div>
            </div>

          <div class="form-group">
            <label class="control-label col-md-5" >Area Sambungan</label>
            <div class="col-md-7">

              <?php echo $data['area']; ?>

            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-5" >Jumlah TV</label>
            <div class="col-md-7">
              <?php echo $data['jumlah_tv']?>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-5" >Iuran @bulan</label>
            <div class="col-md-7">

               <?php echo $data['iuran']?>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-5">Tgl.Mulai Bayar</label>
            <div class="col-md-7">
              <?php echo $data['tgl_bayar']?>
            </div>
          </div>



          <div class="modal-footer">


            <a class="btn btn-default icon-btn" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>&nbsp;&nbsp;&nbsp;


        </div>

        </form>
        </div>

<?php } ?>

      </div>
    </div>
</div>

<!-- end modal -->
