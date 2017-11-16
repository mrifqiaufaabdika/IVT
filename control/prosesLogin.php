  <?php
session_start();
include ("../koneksi/koneksi.php");

$username=$_GET['username'];
$password=($_GET['password']);

$sql="select * from pengguna where username = '$username' and password= '$password' ";
$hasil=mysql_query($sql);

$data=mysql_fetch_array($hasil);
if ($username == $data['username'] && $password == $data['password'] && $data['validasi_pengguna']=='Aktif'){

$tipeAkun = $data['tipe_akun'] ;
    if( $tipeAkun == 'Administrator' ){
        $_SESSION['status']='berhasil';
        $_SESSION['tipe']='admin';
        $_SESSION['idPengguna']=$data['NIP'];
	     header (sprintf("location:../view/index.php?page=dashboard"));
    }else if($tipeAkun == 'Direktur'){
      $_SESSION['status']='berhasil';
      $_SESSION['tipe']='direktur';
      header (sprintf("location:../view/index.php?page=home"));
    }else{
      $_SESSION['pesan']='gagal';
      header (sprintf("location:../view/login.php"));
    }

}else{
  $_SESSION['pesan']='gagal';
  header (sprintf("location:../view/login.php"));
 }

?>
