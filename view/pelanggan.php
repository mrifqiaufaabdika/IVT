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
            <h1><i class="fa fa-users"></i> Data Pelanggan TV Kabel </h1>
            <ul class="breadcrumb side">
              <li><a href="index.php?page=dashboard"><i class="fa fa-home fa-lg"></i></a></li>

              <li class="active"><a href="#">Pelanggan</a></li>
            </ul>
          </div>
          <!-- button -->
          <div><a class="btn btn-primary btn-flat" href="prosesPelanggan.php" data-toggle="modal" data-target="#myModal"><i class="fa fa-lg fa-plus"></i></a>
          </div>
          <!--end  -->
        </div>

        <!-- modal -->




        <!-- end modal -->



        <div class="row">
          <div class="col-lg-12">

            <!-- <div class="bs-component">
              <ul class="nav nav-tabs">
                <li class="active" ><a href="#home" data-toggle="tab">Home</a></li>
                <li ><a href="#profile" data-toggle="tab">Profile</a></li>


              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active in" id="home">
                  <div class="col-md-12">
                    <br> -->
                    <div class="card">
                      <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                          <thead>
                            <tr>
                              <th>Kd Pelanggan</th>
                              <th>Nama</th>

                              <th>Area</th>
                              <th>No HP</th>
                              <th>Jml TV</th>
                              <th>Iuran</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            include "../koneksi/koneksi.php";
                            $sql ="select * from pelanggan where status='aktif'";
                            $hasil = mysql_query($sql);
                            while ($data = mysql_fetch_array($hasil)) {

                            echo"<tr>";
                              echo "<td align='center'>". $data['id_pelanggan']."</td>";
                              echo "<td>" . $data['nama_pelanggan']."</td>";

                              echo "<td>". $data['area']."</td>";
                              echo "<td align='center'>". $data['No_HP']."</td>";
                              echo "<td align='center'>" . $data['jumlah_tv']."</td>";
                              echo "<td > Rp ".format_rupiah( $data['iuran'])."</td>";
                              echo "<td>"?>
                                  <a href="#" class='open_view' id='<?php echo $data['id_pelanggan']; ?>'><span class="fa fa-lg fa-eye"></span></a>&nbsp&nbsp<a  href="#" class='open_delete' id='<?php echo $data['id_pelanggan']; ?>'><i class=" fa fa-user-times"></i></a>&nbsp&nbsp<a href="#" class='open_modal' id='<?php echo $data['id_pelanggan']; ?>'><span class="fa fa-lg fa-edit"></span></a>
                                  <!-- <a   class="demoSwal" id='<?php echo $data['id_pelanggan']; ?>'><i class="fa fa-lg fa-user-times"></i></a> -->
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








<!-- modal Add-->
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
                <input class="form-control" type="text" name="id_pelanggan" value="<?php echo $newID?>" readonly>
              </div>
            </div>
          <div class="form-group">
            <label class="control-label col-md-3">Nama</label>
            <div class="col-md-8">
              <input class="form-control" type="text" placeholder="Nama Lengkap" name="nama" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">No HP</label>
            <div class="col-md-8">
              <input class="form-control col-md-8"  placeholder="Nomor Handphone" name="noHp" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3">Alamat</label>
            <div class="col-md-8">
              <textarea class="form-control" rows="4" placeholder="Alamat" name="alamat" required></textarea>
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
            <option value="Pelita Jaya">Pelita Jaya</option>

          </optgroup>
        </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3" >Jumlah TV</label>
            <div class="col-md-8">
              <input class="form-control"  type="number" name="jumlahTV" placeholder="Jumlah TV" required></input>
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
              <input class="form-control"  name="tgl_bayar"type="date" placeholder="Tanggal Mulai Bayar" required></input>
            </div>
          </div>



          <div class="modal-footer">


            <a class="btn btn-default icon-btn" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>&nbsp;&nbsp;&nbsp;
            <button class="btn btn-primary icon-btn" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Register</button>

        </div>

        </form>
        </div>



      </div>
    </div>
</div>

<!-- end modal -->
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          </div>

    <script type="text/javascript">

                    $(".open_modal").click(function (e){
                        var m = $(this).attr("id");
                        $.ajax({
                            url: "../control/modalEdit/pelanggan.php",
                            type: "GET",
                            data : {id_pelanggan: m,},
                            success: function (ajaxData){
                                $("#ModalEdit").html(ajaxData);
                                $("#ModalEdit").modal('show',{backdrop: 'true'});
                            }
                        });
                    });

            </script>

<div id="ModalView" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalView" aria-hidden="true">
                      </div>

            <script type="text/javascript">

                            $(".open_view").click(function (e){
                                var m = $(this).attr("id");
                                $.ajax({
                                    url: "../control/modalEdit/viewPelanggan.php",
                                    type: "GET",
                                    data : {id_pelanggan: m,},
                                    success: function (ajaxData){
                                        $("#ModalView").html(ajaxData);
                                        $("#ModalView").modal('show',{backdrop: 'true'});
                                    }
                                });
                            });

                    </script>

                    <div id="ModalDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
                                </div>
                        <script type="text/javascript">

                                        $(".open_delete").click(function (e){
                                            var m = $(this).attr("id");
                                            $.ajax({
                                                url: "../control/modalDelete/pelanggan.php",
                                                type: "GET",
                                                data : {id_pelanggan: m,},
                                                success: function (ajaxData){
                                                    $("#ModalDelete").html(ajaxData);
                                                    $("#ModalDelete").modal('show',{backdrop: 'true'});
                                                }
                                            });
                                        });

                                </script>

                    <script type="text/javascript">




              $('.demoSwal').click(function(e){
                swal({
                  title: "Anda Yakin Ingin Resign Pelanggan?",
                  text: "You will not be able to recover this imaginary file!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Ya,Hapus!",
                  cancelButtonText: "Tidak,Batal!",
                  closeOnConfirm: false,
                  closeOnCancel: false
                }, function(isConfirm) {
                  if (isConfirm) {

                      var m = $(this).attr("id");
                    $.ajax({
                        url: "../control/prosesPemutusan2.php",
                        type: "GET",
                        data : {id_pelanggan: m,},

                    });
                  } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                  }
                });
              });
            </script>
