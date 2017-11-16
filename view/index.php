<?php
session_start();

if($_SESSION['status'] != 'berhasil'){
  header (sprintf("location:../view/login.php"));
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS-->
    <link rel="icon" href="../gambar/LOGO.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../model/css/main.css">
    <title>CBMS IVT</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
    <script src="../model/jquery.min.js"></script>
  </head>
  <body class="sidebar-mini fixed">
    <div class="wrapper">
      <header class="main-header hidden-print"><a class="logo" href="index.html">Admin</a>
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button--><a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
          <!-- Navbar Right Menu-->
          <div class="navbar-custom-menu">

            <ul class="top-nav">

              <!-- <li></li> -->
              <!-- <?php echo date("l,d/m/Y h:i:s a"); ?> -->
              <!-- User Menu-->
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu">

                  <!-- <li><a href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li> -->
                  <li><a href="../control/prosesLogout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>

                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
    <?php if($_SESSION['tipe']=='direktur'){ ?>
      <!-- Navbar-->
      <header class="main-header hidden-print"><a class="logo" href="index.html">Direktur</a>
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button--><a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
          <!-- Navbar Right Menu-->
          <div class="navbar-custom-menu">

            <ul class="top-nav">

              <!-- User Menu-->
              <li ><a class="dropdown-toggle" href="../control/prosesLogout.php" ><i class="fa fa-power-off fa-lg"></i></a>

              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Side-Nav-->
      <?php } ?>
      <aside class="main-sidebar hidden-print">
        <section class="sidebar">
          <div class="user-panel">
            <center>
            <img  src="../gambar/logo.png" width="70%"alt="IVT">
          </center>
            <!-- <div class="pull-left info">
              <p>John Doe</p>
              <p class="designation">Frontend Developer</p>
            </div> -->
          </div>
          <!-- Sidebar Menu-->

          <?php
          $active = @$_GET['page'];

          if($_SESSION['tipe']=='admin'){

           ?>
           <ul class="sidebar-menu">

            <li <?php if($active == 'dashboard') echo 'class="active"'; ?>><a href="?page=dashboard"><i class="fa fa-desktop"></i><span>Dashboard</span></a></li>
            <li <?php if($active == 'pengguna') echo 'class="active"';?>><a href="?page=pengguna"><i class="fa fa-user-md"></i><span>Pengguna</span></a></li>
            <li <?php if($active == 'pegawai') echo 'class="active"'; ?>><a href="?page=pegawai"><i class="fa fa-user"></i><span>Pegawai</span></a>

            </li>
            <li <?php if($active == 'pelanggan' || $active == 'non_pelanggan') echo 'class="active"'; ?> class="treeview"><a href="#"><i class="fa fa-group"></i><span>Pelanggan</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="?page=pelanggan"><i class="fa fa-circle-o"></i> Aktif</a></li>
                <li><a href="?page=non_pelanggan"><i class="fa fa-circle-o"></i> Non-Aktif</a></li>
                <!-- <li><a href="?page=detail"><i class="fa fa-circle-o"></i>Detail</a></li> -->

              </ul>

            </li>

            <li <?php if($active == 'transaksi' || $active == 'dataTransaksi' || $active == 'tunggakan' || $active == 'detail') echo 'class="active"'; ?> class="treeview"><a href="#"><i class="fa fa-book"></i><span>Transaksi</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="?page=transaksi"><i class="fa fa-circle-o"></i>Transaksi</a></li>
                <li><a href="?page=dataTransaksi"><i class="fa fa-circle-o"></i>Data Transaksi</a></li>
                <!-- <li><a href="?page=detail"><i class="fa fa-circle-o"></i>Detail</a></li> -->
                <li><a href="?page=tunggakan"><i class="fa fa-circle-o"></i>Tunggakan</a></li>
              </ul>
            </li>
          </ul>
            <?php
          }else if($_SESSION['tipe']=='direktur'){//endif

             ?>
            <ul class="sidebar-menu">

            <li <?php if($active == 'home') echo 'class="active"'; ?>><a href="?page=home"><i class="fa fa-pie-chart"></i><span>Dashboard</span></a></li>
            <li <?php if($active == 'laporan' ||$active == 'registrasi' || $active == 'harian' || $active == 'bulanan'|| $active == 'tahun' || $active == 'priode') echo 'class="active"'; ?>><a href="?page=laporan"><i class="fa fa-file-pdf-o"></i><span>Laporan</span></a></li>


          </ul>
          <?php
        }//end if
        ?>
        </section>
      </aside>
      <div class="content-wrapper">

        <?php
          //ini adalah pembagian form untuk side base_convert
          switch (@$_GET['page']) {
            case 'dashboard':
              # code...

              include 'dashboard.php';
              break;

            case 'pengguna':
              # code...
              include 'pengguna.php';
              break;


            case 'pegawai':
              # code...
              include 'pegawai.php';
              break;

            case 'pelanggan':
              # code...
              include 'pelanggan.php';
              break;

            case 'detail':
              # code...
              include 'detailTagihan.php';
              break;

            case 'transaksi':
              # code...
              include 'transaksi.php';
              break;

            case 'dataTransaksi':
              # code...
              include 'dataTransaksi.php';
              break;

            case 'laporan':
              # code...
              include 'laporan.php';
              break;

            case 'home':
              # code...
              include 'home.php';
              break;

            case 'harian':
              # code...
              include 'laporanHarian.php';
              break;

            case 'bulanan':
              # code...
              include 'laporanBulanan.php';
              break;

            case 'tahun':
              # code...
              include 'laporanTahun.php';
              break;

            case 'priode':
              # code...
              include 'laporanPriode.php';
              break;

            case 'registrasi':
              # code...
              include 'laporanRegistrasi.php';
              break;


            case 'tunggakan':
              # code...
              include 'tunggakan.php';
              break;

              case 'non_pelanggan':
                # code...
                include 'pelanggan_non_aktif.php';
                break;


          }





         ?>




    </div>
    <!-- Javascripts-->
    <script src="../model/js/jquery-2.1.4.min.js"></script>
    <script src="../model/js/essential-plugins.js"></script>
    <script src="../model/js/bootstrap.min.js"></script>
    <script src="../model/js/plugins/pace.min.js"></script>
    <script src="../model/js/main.js"></script>
    <script type="text/javascript" src="../model/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../model/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script type="text/javascript" src="../model/js/plugins/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="../model/js/plugins/sweetalert.min.js"></script>




  </body>
</html>

<?php
function format_rupiah($angka){
  $rupiah=number_format($angka,0,',','.');
  return $rupiah;
}
 ?>
