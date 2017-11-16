<?php

include '../../koneksi/koneksi.php';
$id = $_GET['NIP'];

$sql = "SELECT * FROM pegawai WHERE NIP = '$id'";
$hasil = mysql_query($sql);
while ($data = mysql_fetch_array($hasil)){
 ?>

 <!-- modal -->
 <div class="modal-dialog">
     <div class="modal-content">
         <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
             <h4 class="modal-title" id="myModalLabel">Edit Pegawai</h4>
         </div>
         <div class="modal-body">
           <form class="form-horizontal" method="post" action="../control/prosesPegawai.php?action=edit">
             <div class="form-group">
               <label class="control-label col-md-3">NIP</label>
               <div class="col-md-8">
                 <input class="form-control" name="NIP"type="text" placeholder="NIP" value="<?php echo $data['NIP']?>">
               </div>
             </div>
           <div class="form-group">
             <label class="control-label col-md-3">Nama</label>
             <div class="col-md-8">
               <input class="form-control" type="text" name='nama' placeholder="nama" value="<?php echo $data['nama_pegawai']?>">
             </div>
           </div>
           <div class="form-group">
             <label class="control-label col-md-3">No HP</label>
             <div class="col-md-8">
               <input class="form-control col-md-8" type="text"  name='noHP'placeholder="NO Handphone" value="<?php echo $data['No_HP']?>">
             </div>
           </div>
           <div class="form-group">
             <label class="control-label col-md-3">Alamat</label>
             <div class="col-md-8">
               <textarea class="form-control" rows="4" name='alamat'placeholder="Alamat Pegawai" value="<?php echo $data['alamat']?>"><?php echo $data['alamat']?></textarea>
             </div>
           </div>
           <div class="form-group">
             <label class="control-label col-md-3">Jenis Klamin</label>
             <div class="col-md-9">
               <div class="radio-inline">
                 <label>
                   <input type="radio" name="jk" value="L" <?php if($data['jenis_kelamin']=='L'){echo "checked";}?>>Laki-Laki
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
             <label class="control-label col-md-3">Jabatan</label>
             <div class="col-md-8">
               <select class="form-control" name='jabatan'>
           <optgroup label="Pilih Jabatan" >
             <option value=<?php echo $data['jabatan']; ?>><?php echo $data['jabatan']; ?></option>
             <option value='Kepelangganan'>Kepelangganan</option>
             <option value="Teknisi">Teknisi</option>
             <option value="Direktur">Direktur</option>
               <option value="Kolektor">Kolektor</option>

           </optgroup>
         </select>
             </div>
           </div>










           <div class="modal-footer">


             <a class="btn btn-default icon-btn" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>&nbsp;&nbsp;&nbsp;<button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Register</button>

         </div>

         </form>
         </div>

<?php } ?>

       </div>
     </div>
 </div>



 <!-- end modal -->
