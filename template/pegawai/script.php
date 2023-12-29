<?php
include 'koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Ambil total pegawai
$queryTotalPegawai = "SELECT COUNT(*) as total FROM tb_pegawai";
$resultTotalPegawai = mysqli_query($koneksi, $queryTotalPegawai);
$rowTotalPegawai = mysqli_fetch_assoc($resultTotalPegawai);
$totalPegawai = $rowTotalPegawai['total'];

// Ambil total pegawai yang sudah absen hari ini
date_default_timezone_set('Asia/Jakarta');
$currentDate = date('Y-m-d');
$queryTotalAbsen = "SELECT COUNT(*) as total FROM tb_absen WHERE DATE(masuk) = '$currentDate'";
$resultTotalAbsen = mysqli_query($koneksi, $queryTotalAbsen);
$rowTotalAbsen = mysqli_fetch_assoc($resultTotalAbsen);
$totalAbsen = $rowTotalAbsen['total'];

// Format data sebagai JSON
$data = [
    'totalPegawai' => $totalPegawai,
    'totalAbsen' => $totalAbsen,
];

header('Content-Type: application/json');
echo json_encode($data);
?>

