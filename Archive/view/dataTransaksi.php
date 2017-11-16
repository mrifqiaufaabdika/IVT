<?php
if($_SESSION['tipe'] != 'admin'){
  header (sprintf("location:../view/login.php"));
}
 ?>
        <div class="page-title">
          <div>
            <h1><i class="fa fa-book"></i> Data Transaksi Pelanggan</h1>
            <ul class="breadcrumb side">
              <li><a href="index.php?page=dashboard"><i class="fa fa-home fa-lg"></i></a></li>

              <li class="active"><a href="#">Data Transaksi</a></li>
            </ul>
          </div>
          <p> PT.Indragiri Vision Terpadu</p>

        </div>





        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>No Transaksi</th>
                      <th>ID Pelanggan</th>
                      <th>Nama Pelanggan</th>
                      <th>Pegawai</th>
                      <th>Qty</th>
                      <th>Tgl Bayar</th>
                      <th>Jenis Transaksi</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    include "../koneksi/koneksi.php";
                    $sql ="select a.*,b.*,c.* from transaksi a,pelanggan b,pegawai c where a.id_pelanggan =b.id_pelanggan and a.NIP = c.NIP ";
                    $hasil = mysql_query($sql);
                    while ($data = mysql_fetch_array($hasil)) {

                    echo"<tr>";
                      echo "<td>". $data['no_faktur']."</td>";
                      echo "<td>" . $data['id_pelanggan']."</td>";
                      echo "<td>" . $data['nama_pelanggan']."</td>";
                      echo "<td>".$data['nama_pegawai']." ". $data['NIP']."</td>";
                      echo "<td>". $data['jumlah_tunggakan']."</td>";
                      echo "<td>". $data['tgl_pembayaran']."</td>";
                      echo "<td>". $data['jenis_pembayaran']."</td>";
                      echo "<td> Rp ".format_rupiah($data['total'])."</td>";

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
