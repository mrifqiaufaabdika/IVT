<?php
if($_SESSION['tipe'] != 'admin'){
  header (sprintf("location:../view/login.php"));
}
 ?>
        <div class="page-title">
          <div>
            <h1><i class="fa fa-user"></i> Data Pegawai</h1>
            <ul class="breadcrumb side">
              <li><a href="index.php?page=dashboard"><i class="fa fa-home fa-lg"></i></a></li>

              <li class="active"><a href="#">Pegawai</a></li>
            </ul>
          </div>
          <!-- button -->
          <div><a class="btn btn-primary btn-flat" href="tambahPegawai.php" data-toggle="modal" data-target="#myModal"><i class="fa fa-lg fa-plus"></i></a>
          </div>
          <!--end  -->
        </div>

        <!-- modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Tambah Pegawai</h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" action="../control/prosesPegawai.php?action=tambah" method="post">
                    <div class="form-group">
                      <label class="control-label col-md-3">NIP</label>
                      <div class="col-md-8">
                        <input class="form-control" name="NIP"type="text" placeholder="NIP">
                      </div>
                    </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Nama</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" name='nama' placeholder="nama">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">No HP</label>
                    <div class="col-md-8">
                      <input class="form-control col-md-8" type="text"  name='noHP'placeholder="NO Handphone">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Alamat</label>
                    <div class="col-md-8">
                      <textarea class="form-control" rows="4" name='alamat'placeholder="Alamat Pegawai"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Jenis Klamin</label>
                    <div class="col-md-9">
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="jk" value="L">Laki-Laki
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
                    <label class="control-label col-md-3">Jabatan</label>
                    <div class="col-md-8">
                      <select class="form-control" name='jabatan'>
                  <optgroup label="Select Area" >
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



              </div>
            </div>
        </div>



        <!-- end modal -->



        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>NIP</th>
                      <th>Nama</th>
                      <th>Jk </th>
                      <th>NO HP</th>
                      <th>Alamat</th>
                      <th>Jabatan</th>
                      <th>Aksi</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include "../koneksi/koneksi.php";
                    $sql ="select * from pegawai";
                    $hasil = mysql_query($sql);
                    while ($data = mysql_fetch_array($hasil)) {

                    echo"<tr>";
                      echo "<td>". $data['NIP']."</td>";
                      echo "<td>" . $data['nama_pegawai']."</td>";
                        echo "<td>" . $data['jenis_kelamin']."</td>";
                      echo "<td>". $data['No_HP']."</td>";
                      echo "<td>". $data['alamat']."</td>";
                      echo "<td>". $data['jabatan']."</td>";
                      echo "<td>"?>
                        <!-- <a  href="tambahPelanggan.php" data-toggle="modal" data-target="#ModalView"><i class="fa fa-lg fa-eye"></i></a>&nbsp&nbsp -->
                        <a href="#" class='open_modal' id='<?php echo $data['NIP']; ?>'><span class="fa fa-lg fa-edit"></span></a>&nbsp&nbsp<a  href="#" class='open_delete' id='<?php echo $data['NIP']; ?>'><i class="fa fa-lg fa-trash"></i></a>
                        <?php "</td>";
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





        <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  </div>

            <script type="text/javascript">

                            $(".open_modal").click(function (e){
                                var m = $(this).attr("id");
                                $.ajax({
                                    url: "../control/modalEdit/pegawai.php",
                                    type: "GET",
                                    data : {NIP: m,},
                                    success: function (ajaxData){
                                        $("#ModalEdit").html(ajaxData);
                                        $("#ModalEdit").modal('show',{backdrop: 'true'});
                                    }
                                });
                            });

                    </script>

                    <div id="ModalDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                </div>
                        <script type="text/javascript">

                                        $(".open_delete").click(function (e){
                                            var m = $(this).attr("id");
                                            $.ajax({
                                                url: "../control/modalDelete/pegawai.php",
                                                type: "GET",
                                                data : {NIP: m,},
                                                success: function (ajaxData){
                                                    $("#ModalDelete").html(ajaxData);
                                                    $("#ModalDelete").modal('show',{backdrop: 'true'});
                                                }
                                            });
                                        });

                                </script>
