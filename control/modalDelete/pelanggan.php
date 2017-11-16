<?php

    include '../../koneksi/koneksi.php';
    $id_pelanggan = $_GET['id_pelanggan'];
    $qry="select * from pelanggan where id_pelanggan='$id_pelanggan'";
    $hasil = mysql_query($qry);

    while($row=  mysql_fetch_array($hasil)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel2">Pemutusan Pelanggan</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" action="../control/prosesPemutusan.php" name="modal-popup" enctype="multipart/form-data" method="POST">

                    <div class="alert alert-warning">Apakah anda yakin Non-Aktifkan data ini ?</div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">ID Pelanggan</label>
                                    <div class="col-lg-5">
                                        <input style="width: 200px;"  class="form-control" type="text" name="id_pelanggan" value="<?php echo $row['id_pelanggan']; ?>" readonly/>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Nama Pelanggan</label>
                                    <div class="col-lg-5">
                                        <input style="width: 200px;"  class="form-control" type="text" name="nama" value="<?php echo $row['nama_pelanggan']; ?>" readonly/>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Area</label>
                                    <div class="col-lg-5">
                                        <input style="width: 200px;"  class="form-control" type="text" name="nama" value="<?php echo $row['area']; ?>" readonly/>
                                    </div>
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
                                <button type="submit" class="btn btn-warning">Putuskan</button>

                            </div>
            </form>
            <?php
    }
            ?>
        </div>
    </div>
</div>
