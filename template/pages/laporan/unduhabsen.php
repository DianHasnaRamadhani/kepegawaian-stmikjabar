<?php
require_once('../../../vendor/tecnickcom/tcpdf/tcpdf.php');
include '../../koneksi.php';

// Tentukan rentang tanggal
$tanggal_awal = $_POST['tanggal_awal'];
$tanggal_akhir = $_POST['tanggal_akhir'];
$tanggal_awall = date("Y-m-d", strtotime($tanggal_awal));
$tanggal_akhirr = date("Y-m-d", strtotime($tanggal_akhir));
$bebas = DateTime::createFromFormat("Y-m-d", $tanggal_akhir);
$bebas->add(new DateInterval('P1D'));
$tanggal_baru = $bebas->format("Y-m-d");

// Query data pegawai
$queryPegawai = "SELECT * FROM tb_pegawai";
$resultPegawai = $koneksi->query($queryPegawai);

$pdf = new TCPDF();
$pdf->SetAutoPageBreak(true, 10);

$pdf->AddPage();

$imageFile = '../../images/STMIK_JABAR-removebg-preview.jpeg';  // Ganti dengan path file logo Anda
$pdf->Image($imageFile, 5, 12, 20);  // Atur posisi dan ukuran logo
$pdf->SetFont('Times', 'B', 20);
$pdf->Cell(0, 10, 'STMIK JABAR', 0, 1, 'C'); // Ubah lebar cell sesuai kebutuhan
$pdf->SetFont('Times', 'B', 11);
$pdf->SetXY(30, 20); // Koordinat X dan Y untuk teks
$pdf->Cell(10, 5, 'Jl. Soekarno Hatta No.777, Cisaranten Endah, Kec. Arcamanik, Kota Bandung, Jawa Barat 40292'); // Ubah lebar cell sesuai kebutuhan
$pdf->Ln(); // Spasi
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 5, 'Telepon: (022) 7335108', 0, 1, 'C');

// Judul laporan
$pdf->Ln(); // Spasi
$pdf->Ln(); // Spasi
$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(0, 10, 'Laporan Kehadiran Pegawai', 0, 1, 'C'); // Ubah lebar cell sesuai kebutuha
$pdf->Ln();

// Loop through each day in the date range
$currentDate = $tanggal_awall;
while ($currentDate <= $tanggal_akhirr) {
    $formattedDate = date("d-m-Y", strtotime($currentDate));

    $pdf->SetFont('times', 'B', 11);
    $pdf->Cell(0, 10, 'Tanggal: ' . $formattedDate, 0, 1, 'L');

    // Tabel data absen headers
    $pdf->SetFont('times', 'B', 11);
    $pdf->Cell(25, 10, 'NIP', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Nama', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Waktu Masuk', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Waktu Pulang', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Keterangan', 1, 1, 'C');
    // Query data absen for the current day
    $queryAbsen = "SELECT nip, masuk, pulang, nama, status FROM tb_absen WHERE masuk BETWEEN '$currentDate' AND '$currentDate 23:59:59'";
    $resultAbsen = $koneksi->query($queryAbsen);

    // Mengambil data absen ke dalam array untuk pencocokan
    $dataAbsen = array();
    while ($rowAbsen = $resultAbsen->fetch_assoc()) {
        $dataAbsen[$rowAbsen['nama']] = $rowAbsen;
    }

    // Menampilkan data pegawai
    $resultPegawai->data_seek(0);
    while ($rowPegawai = $resultPegawai->fetch_assoc()) {
        $nama = $rowPegawai['nama'];
        $nip = $rowPegawai['nip'];

        $masuk = isset($dataAbsen[$nama]) ? date("H:i", strtotime($dataAbsen[$nama]['masuk'])) : '-';
        $pulang = isset($dataAbsen[$nama]) ? date("H:i", strtotime($dataAbsen[$nama]['pulang'])) : '-';

        // Menentukan status
        $status = ($masuk != '-' && $pulang != '-') ? $dataAbsen[$nama]['status'] : 'Tidak Hadir';

        $pdf->Cell(25, 10, $nip, 1, 0, 'C');
        $pdf->Cell(60, 10, $nama, 1, 0, 'C');
        $pdf->Cell(40, 10, $masuk, 1, 0, 'C');
        $pdf->Cell(40, 10, $pulang, 1, 0, 'C');
        $pdf->Cell(30, 10, $status, 1, 1, 'C');
    }

    // Move to the next day
    $currentDate = date("Y-m-d", strtotime($currentDate . ' + 1 day'));
}

// Tutup koneksi
$koneksi->close();

// Output PDF
$pdf->Output();
?>
