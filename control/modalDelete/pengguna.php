<?php

    include '../../koneksi/koneksi.php';
    $NIP = $_GET['NIP'];
    $qry="select a.*,b.* from pengguna a,pegawai b where a.NIP=b.NIP and a.NIP='$NIP'";
    $hasil = mysql_query($qry);

    while($row=  mysql_fetch_array($hasil)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Delete Pengguna</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="../control/prosesPengguna.php?action=delete" name="modal-popup" enctype="multipart/form-data" method="POST">

                    <div class="alert alert-danger">Apakah anda yakin ingin menghapus data ini ?</div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">NIP</label>
                                    <div class="col-lg-5">
                                        <input style="width: 200px;"  class="form-control" type="text" name="NIP" value="<?php echo $row['NIP']; ?>" readonly/>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Nama Pegawai</label>
                                    <div class="col-lg-5">
                                        <input style="width: 200px;"  class="form-control" type="text" name="nama" value="<?php echo $row['nama_pegawai']; ?>" readonly/>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Tipe Akun</label>
                                    <div class="col-lg-5">
                                        <input style="width: 200px;"  class="form-control" type="text" name="nama" value="<?php echo $row['tipe_akun']; ?>" readonly/>
                                    </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Gak Jadi</button>
                                <button type="submit" class="btn btn-danger">Hapus</button>

                            </div>
            </form>
            <?php
    }
            ?>
        </div>
    </div>
</div>
