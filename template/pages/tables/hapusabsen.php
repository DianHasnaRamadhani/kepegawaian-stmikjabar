<?php 

include '../../koneksi.php';

$id = $_GET['id_absen'];

$sql = "DELETE FROM tb_absen WHERE id_absen = '$id'";
$hapus = mysqli_query($koneksi, $sql);

if ($hapus) {
	header("location: dataabsen.php");
}else{
echo "bakekok bunda";
} 
 ?>
