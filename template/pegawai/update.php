<?php
session_start();
error_reporting(0);
include 'koneksi.php';

//proses input
if (isset($_POST['edit'])) {
  $nip = $_POST['nip'];
  $nama = $_POST['nama'];
  $ttl = $_POST['ttl'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $alamat = $_POST['alamat'];
  $agama = $_POST['agama'];
  $pend_terakhir = $_POST['pend_terakhir'];
  $jabatan = $_POST['jabatan'];
  $no_telepon = $_POST['no_telepon'];
  $password = $_POST['password'];

  if(isset($_POST['ubahfoto'])){ // Cek apakah user ingin mengubah fotonya atau tidak
    $foto     = $_FILES['inpfoto']['name'];
    $tmp      = $_FILES['inpfoto']['tmp_name'];
    $fotobaru = date('dmYHis').$foto;
    $path     = "../../pages/forms/images/".$fotobaru;

    if(move_uploaded_file($tmp, $path)){ //awal move upload file
      $sql    = "SELECT * FROM tb_pegawai WHERE nip = '".$nip."' ";
      $query  = mysqli_query($koneksi, $sql);
      $hapus_f = mysqli_fetch_array($query);

//proses hapus gambar
      $file = "../../pages/forms/images/".$hapus_f['foto'];
      unlink($file);//nama variabel yang ada di server

      // Proses ubah data ke Database
      $sql_f = "UPDATE tb_pegawai set nip='$nip', nama='$nama', ttl='$ttl', jenis_kelamin='$jenis_kelamin', alamat='$alamat', agama='$agama', pend_terakhir='$pend_terakhir', jabatan='$jabatan', no_telepon='$no_telepon', password='$password', foto ='$fotobaru' WHERE nip='$nip'";
      $ubah  = mysqli_query($koneksi, $sql_f);
      if($ubah){
        echo "<script>alert('Ubah Data Dengan NIP = ".$nip." Berhasil') </script>";
        header('Location:index.php?m=index');
      } else {
        $sql    = "SELECT * FROM tb_pegawai WHERE nip = '".$nip."' ";
        $query  = mysqli_query($koneksi, $sql);
        while ($row = mysqli_fetch_array($query)) {
          echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
        }
      }
    } //akhir move upload file
    else{
      // Jika gambar gagal diupload, Lakukan :
      echo "Maaf, Gambar gagal untuk diupload.";
      echo "<br><a href='profil.php'>Kembali Ke data pegawai</a>";
    }
 } //akhir ubah foto
 else { //hanya untuk mengubah data
   $sql_d   = "UPDATE tb_pegawai set nip='$nip', nama='$nama', ttl='$ttl', jenis_kelamin='$jenis_kelamin', alamat='$alamat', agama='$agama', pend_terakhir='$pend_terakhir', jabatan='$jabatan', no_telepon='$no_telepon', password='$password' WHERE nip='$nip'";
   $data    = mysqli_query($koneksi, $sql_d);
   if ($data) {
     echo "<script>alert('Ubah Data Dengan NIP = ".$nip." Berhasil') </script>";
     echo "<script>window.location.href = \"profil.php\" </script>";
   } else {
     $sql   = "SELECT * FROM tb_pegawai WHERE nip = '".$nip."' ";
     $query = mysqli_query($koneksi, $sql);
     while ($row = mysqli_fetch_array($query)) {
       echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
       echo "<br><a href=\"edit.php?nip=".$row['nip']."\"> Kembali Ke From ! </a>";
     }
   }
 } //akhir untuk mengubah data
}

?>
