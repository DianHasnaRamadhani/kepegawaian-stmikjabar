<?php 

include '../../koneksi.php';

$id = $_GET['id_jabatan'];

$sql = "DELETE FROM tb_jabatan WHERE id_jabatan = '$id'";
$hapus = mysqli_query($koneksi, $sql);

if ($hapus) {
  header("location: datajabatan.php");
}else{
echo "bakekok bunda";
} 
 ?>
