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
            <h1><i class=" fa fa-user-times"></i></i> Pelanggan TV Kabel NON-AKTIF </h1>
            <ul class="breadcrumb side">
              <li><a href="index.php?page=dashboard"><i class="fa fa-home fa-lg"></i></a></li>

              <li class="active"><a href="#">Pelanggan Non-Aktif</a></li>
            </ul>
          </div>
          <!-- button -->
          <div> <p> PT.Indragiri Vision Terpadu</p>
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
                              <th>Tgl. Putus </th>
                              <th>Status</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            include "../koneksi/koneksi.php";
                            $sql ="select * from pelanggan where status='non-aktif'";
                            $hasil = mysql_query($sql);
                            while ($data = mysql_fetch_array($hasil)) {
                              $tampilTgl = date('d/m/Y',strtotime($data['tgl_putus']));

                            echo"<tr>";
                              echo "<td align='center'>". $data['id_pelanggan']."</td>";
                              echo "<td>" . $data['nama_pelanggan']."</td>";

                              echo "<td>". $data['area']."</td>";
                              echo "<td align='center'>". $data['No_HP']."</td>";

                              echo "<td align='center'>" . $tampilTgl."</td>";
                              echo "<td align='center'>" . $data['status']."</td>";
                              echo "<td>"?>
                                  <a href="#" class='open_view' id='<?php echo $data['id_pelanggan']; ?>'><span class="fa fa-lg fa-eye"></span></a>
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
