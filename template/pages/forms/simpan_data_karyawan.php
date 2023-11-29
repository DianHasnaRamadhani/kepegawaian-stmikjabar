<?php
session_start(); 
include '../../koneksi.php';
if (isset($_POST['simpan'])) {
	
	$nip = $_POST['nip'];
	$nama = $_POST['nama'];
	$ttl = $_POST['ttl'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$alamat = $_POST['alamat'];
	$agama = $_POST['agama'];
	$pend_terakhir = $_POST['pend_terakhir'];
	$tanggal_masuk = $_POST['tanggal_masuk'];
	$jabatan = $_POST['jabatan'];
	$no_telepon = $_POST['no_telepon'];
	$username = $_POST['username'];
	$password = $_POST['password'];


	//untuk gambar
	$foto     = $_FILES['foto']['name'];
	$tmp      = $_FILES['foto']['tmp_name'];
	$fotobaru = date('dmYHis').$foto;
	$path     = "images/".$fotobaru;
}

if (move_uploaded_file($tmp, $path)) {
	$sql = "SELECT * FROM tb_pegawai WHERE id_pegawai = '".$id_pegawai."'";
	$tambah = mysqli_query($koneksi, $sql);
}

if ($row = mysqli_fetch_row($tambah)) {
echo "<script>alert('Data Dengan NIP = ".$id_karyawan." sudah ada') </script>";
		echo "<script>window.location.href = \"tambahdatapegawai.php\" </script>";

}

$query = "INSERT INTO tb_pegawai (nip, nama, ttl, jenis_kelamin, alamat, agama, pend_terakhir, tanggal_masuk, jabatan, no_telepon, username, password, foto) VALUES ('$nip', '$nama', '$ttl', '$jenis_kelamin', '$alamat', '$agama', '$pend_terakhir', '$tanggal_masuk', '$jabatan', '$no_telepon', '$username', '$password', '$fotobaru')";
mysqli_query($koneksi, $query);

if ($query) {
	header("location: ../tables/datapegawai.php");
}else{
	echo "gagal";
}

 ?>