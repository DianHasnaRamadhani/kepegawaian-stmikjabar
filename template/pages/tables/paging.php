<head>
	 
</head>
<?php 
include '../../koneksi.php';

$batas = 10;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;

$data = mysqli_query($koneksi, "SELECT * FROM tb_pegawai");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

$data_pegawai = mysqli_query($koneksi, "SELECT * FROM tb_pegawai LIMIT $halaman_awal, $batas");
$nomor = $halaman_awal+1;

if (isset($_GET['cari'])) {
	$cari = $_GET['cari'];

	$data = mysqli_query($koneksi, "SELECT * FROM tb_pegawai WHERE nip LIKE '%$cari%' OR nama LIKE '%$cari%'");
}else{
	$data = mysqli_query($koneksi, "SELECT * FROM tb_pegawai");
}
$no = 1;
while ($row=mysqli_fetch_array($data_pegawai)) {


 ?>

  <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $row['nip']; ?></td>
      <td><?php echo $row['nama']; ?></td>
      <td><?php echo $row['jabatan']; ?></td>
      <td><?php echo $row['alamat']; ?></td>
      <td><?php echo $row['no_telepon']; ?></td>
      <td><img src="../forms/images/<?php echo $row['foto'];?>" ></td>
      <td><a href="editdatapegawai.php?nip=<?php echo $row['nip']; ?>"><button class="btn btn-primary btn-sm">Ubah</button></a> 
        <a href="hapuspegawai.php?id_pegawai=<?php echo $row['id_pegawai']; ?>"><button class="btn btn-danger btn-sm" onclick="return confirm('yakin ingin dihapus?');">Hapus</button></a>
      </td>
  </tr>
  <?php $no++; ?>
  <?php } ?>

