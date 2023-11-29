<?php
include '../../koneksi.php';

if (isset($_POST['tanggal_cari'])) {
    $tanggal = $_POST['tanggal_cari'];

    $query = "SELECT * FROM tb_absen WHERE waktu = '$tanggal'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Tampilkan data yang sesuai
            echo "Nama: " . $row['nama'] . ", Tanggal: " . $row['waktu'] . "<br>";
        }
    } else {
        echo "Tidak ada data yang sesuai.";
    }
}
?>
