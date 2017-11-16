<?php
include '../../koneksi/koneksi.php';
session_start();
$NIPdlu = $_SESSION['idPengguna'];
$NIP = $_GET['NIP'];

$sql = "SELECT * FROM pengguna WHERE NIP = '$NIP'";
$hasil = mysql_query($sql);
while ($data = mysql_fetch_array($hasil)){
 ?>



<!-- modal -->

<div class="modal-dialog ">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Edit Pengguna</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="post" action="../control/prosesPengguna.php?action=edit">
            <div class="form-group">
              <label class="control-label col-md-3">NIP</label>
              <div class="col-md-8">
                <input class="form-control" name="NIP" type="text"  value="<?php echo $data['NIP'];?>">
              </div>
            </div>
          <div class="form-group">
            <label class="control-label col-md-3">Username</label>
            <div class="col-md-8">
              <input class="form-control" type="text" name="username" value="<?php echo $data['username'] ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3">Password</label>
            <div class="col-md-8">
              <input class="form-control col-md-8" type="password" name="passwordEdit" value="<?php echo ($data['password']) ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3">Tipe Akun</label>
            <div class="col-md-9">
              <div class="radio-inline">
                <label>
                  <input type="radio" name="tipeAkun"  value="Administrator"<?php if($data['tipe_akun']=='Administrator'){echo "checked";}?> >Administrator
                </label>
              </div>
              <div class="radio-inline">
                <label>
                  <input type="radio" name="tipeAkun" value="Direktur" <?php if($data['tipe_akun']=='Direktur'){echo "checked";}?>>Direktur
                </label>
              </div>
            </div>
          </div>


          <div class="form-group">
            <label class="control-label col-md-3">Validasi Pengguna</label>
            <div class="col-md-8">
          <div class="toggle-flip">
            <label>
              <input type="checkbox" name="validasi"  value="Aktif"  <?php if($data['validasi_pengguna']=='Aktif'){echo "checked";}?>><span class="flip-indecator" data-toggle-on="Aktif" data-toggle-off="Nonaktif"></span>
            </label>
          </div>
        </div>
      </div>

        <div class="modal-footer">


            <a class="btn btn-default icon-btn" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>&nbsp;&nbsp;&nbsp;<button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Edit</button>

        </div>

      </form>
      <?php
  }
          ?>
    </div>



  </div>
</div>
