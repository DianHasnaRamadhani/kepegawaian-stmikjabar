
<?php 

  include_once "../koneksi.php";

  $nip = $_POST['nip'];
  $pass = $_POST['password'];
  $sql = "SELECT * FROM tb_pegawai WHERE nip='$nip' AND password='$pass'";
  $login=mysqli_query($koneksi,$sql);
  $ketemu=mysqli_num_rows($login);
  $b=mysqli_fetch_array($login);

  if($ketemu>0){
    session_start();
    $_SESSION['nip']   = $b['nip'];
    $_SESSION['usersi'] = $b['username'];
    $_SESSION['namasi'] = $b['nama'];
    $_SESSION['ttlsi']  = $b['tmp_tgl_lahir'];
    $_SESSION['jenkelsi'] = $b['jenkel'];
    $_SESSION['agamasi'] = $b['agama'];
    $_SESSION['alamatsi'] = $b['alamat'];
    $_SESSION['teleponsi'] = $b['no_tel'];
    $_SESSION['jabatansi'] = $b['jabatan'];
    $_SESSION['fotosi'] = $b['foto'];

    header("location: dashboard.php");
}else{
    
    echo '<script language="javascript">';
        echo 'alert ("Username/Password ada yang salah, atau akun anda belum Aktif")';
    echo '</script>';
    header("location: login.php");
}
  

 ?>

