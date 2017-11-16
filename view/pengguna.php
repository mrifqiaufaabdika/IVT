<?php
if($_SESSION['tipe'] != 'admin'){
  header (sprintf("location:../view/login.php"));
}
 ?>

        <div class="page-title">
          <div>
            <h1><i class="fa fa-user-md"></i> Data Pengguna</h1>
            <ul class="breadcrumb side">
              <li><a href="index.php?page=dashboard"><i class="fa fa-home fa-lg"></i></a></li>

              <li class="active"><a href="#">Pengguna</a></li>
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
                          <h4 class="modal-title">Tambah Pengguna</h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" method="post" action="../control/prosesPengguna.php?action=tambah">
                    <div class="form-group">
                      <label class="control-label col-md-3">NIP</label>
                      <div class="col-md-8">
                        <input class="form-control" name="NIP" type="text" placeholder="NIP" required>
                      </div>
                    </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Username</label>
                    <div class="col-md-8">
                      <input class="form-control" type="text" name="username" placeholder="Username" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3">Password</label>
                    <div class="col-md-8">
                      <input class="form-control col-md-8" type="password" name="password"placeholder="Password" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3">Tipe Akun</label>
                    <div class="col-md-9">
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="tipeAkun" value="Administrator" required>Administrator
                        </label>
                      </div>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="tipeAkun" value="Direktur" required>Direktur
                        </label>
                      </div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="control-label col-md-3">Validasi Pengguna</label>
                    <div class="col-md-8">
                  <div class="toggle-flip">
                    <label>
                      <input type="checkbox" name="validasi" value="Aktif" ><span class="flip-indecator" data-toggle-on="Aktif" data-toggle-off="Nonaktif"></span>
                    </label>
                  </div>
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
                      <th>Jabatan</th>
                      <th>Tipe Akun</th>
                      <th>Validasi</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Aksi</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include "../koneksi/koneksi.php";
                    $sql ="select a.*, b.* from pengguna a,pegawai b where a.NIP = b.NIP";
                    $hasil = mysql_query($sql);
                    while ($data = mysql_fetch_array($hasil)) {

                    echo"<tr>";
                      echo "<td>". $data['NIP']."</td>";
                      echo "<td>" . $data['nama_pegawai']."</td>";
                      echo "<td>". $data['jabatan']."</td>";
                      echo "<td>". $data['tipe_akun']."</td>";
                      echo "<td>". $data['validasi_pengguna']."</td>";
                      echo "<td>". $data['username']."</td>";
                      echo "<td>". md5($data['password'])."</td>";
                      echo "<td>"?>
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
                                    url: "../control/modalEdit/pengguna.php",
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
                                                url: "../control/modalDelete/pengguna.php",
                                                type: "GET",
                                                data : {NIP: m,},
                                                success: function (ajaxData){
                                                    $("#ModalDelete").html(ajaxData);
                                                    $("#ModalDelete").modal('show',{backdrop: 'true'});
                                                }
                                            });
                                        });

                                </script>
