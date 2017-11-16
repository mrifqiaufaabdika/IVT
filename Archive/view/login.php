<?php

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
    <script type="text/javascript" src="../model/js/plugins/bootstrap-notify.min.js"></script>
    <script type="text/javascript" src="../model/js/plugins/sweetalert.min.js"></script>
    <title>CBMS IVT</title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
  </head>
  <?php
  session_start();
  if(isset($_SESSION['pesan'])){
    ?>
    <script type="text/javascript">
		 window.load = load();
     function  load(){
      alert("gagal Login, Coba Lagi")
    // swal("Cancelled", "Your imaginary file is safe :)", "error");
    }
	</script>
    <?php



  }
  ?>
<body>

    <section class="material-half-bg">
      <div class="cover"></div>

    </section>
    <section class="login-content">
      <div class="logo">
        <H3>بِسْمِ اللهِ الرَّحْمنِ الرَّحِيمِ</H3>

      </div>
      <div class="login-box">

        <form class="login-form" action="../control/ProsesLogin.php" method="GET">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
          <div class="form-group">
            <label class="control-label">USERNAME</label>
            <input class="form-control" type="text" placeholder="Username" name="username" required>
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" type="password" placeholder="Password" name="password" required>
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label class="semibold-text">
                  <input type="checkbox"><span class="label-text">Stay Signed in</span>
                </label>
              </div>
              <p class="semibold-text mb-0"><a id="toFlip" href="#">Forgot Password ?</a></p>
            </div>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block">SIGN IN <i class="fa fa-sign-in fa-lg"></i></button>
          </div>
        </form>
        <form class="forget-form" action="index.html">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input class="form-control" type="text" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block">RESET <i class="fa fa-unlock fa-lg"></i></button>
          </div>
          <div class="form-group mt-20">
            <p class="semibold-text mb-0"><a id="noFlip" href="#"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
          </div>
        </form>
      </div>
      &copy;-<?php echo date("Y"); ?> Teknik Informatika
    </section>
  </body>
  <script src="../model/js/jquery-2.1.4.min.js"></script>
  <script src="../model/js/essential-plugins.js"></script>
  <script src="../model/js/bootstrap.min.js"></script>
  <script src="../model/js/plugins/pace.min.js"></script>
  <script src="../model/js/main.js"></script>




</html>

<?php session_destroy(); ?>
