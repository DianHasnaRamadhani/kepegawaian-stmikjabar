<?php 
include '../../koneksi.php';
session_start();

$id = $_GET['id_pegawai'];
$sql = "SELECT *  FROM tb_pegawai WHERE id_pegawai = '$id'";
$query = mysqli_query($koneksi, $sql);
$hapus_f = mysqli_fetch_array($query);

//proses hapus gambar
$file = "../forms/images/".$hapus_f['foto'];
unlink($file);

$sql_h = "DELETE FROM tb_pegawai WHERE id_pegawai = '$id' ";
$hapus = mysqli_query($koneksi, $sql_h);

if ($hapus) {
         
         header("location: datapegawai.php");
} else {
  echo "Gagal Dihapus";
}

 ?>

