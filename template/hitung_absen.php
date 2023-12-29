<?php
// Koneksi ke database
include '../../koneksi.php';

// Ambil tanggal yang ingin dihitung
date_default_timezone_set('Asia/Jakarta');

// Ambil tanggal hari ini
$tanggal_hari_ini = date("Y-m-d");

// Query untuk menghitung pegawai yang sudah absen pada tanggal tertentu
$query = "SELECT COUNT(DISTINCT nip) as jumlah_absen FROM tb_absen WHERE DATE(waktu) = '$tanggal_yang_dihitung'";
$result = mysqli_query($koneksi, $query);

// Inisialisasi data
$data = array('sudah_absen' => 0, 'belum_absen' => 0);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $data['sudah_absen'] = $row['jumlah_absen'];
    $data['belum_absen'] = jumlah_total_pegawai() - $row['jumlah_absen'];
}

// Mengembalikan data dalam format JSON
echo json_encode($data);

// Tutup koneksi database
mysqli_close($koneksi);

function jumlah_total_pegawai() {
    // Implementasikan fungsi untuk menghitung jumlah total pegawai dari database
    // Misalnya, dengan query SELECT COUNT(*) FROM tb_pegawai
    // Sesuaikan dengan struktur dan nama tabel pada database Anda
    return 10; // Gantilah dengan jumlah pegawai pada database Anda
}
?>
