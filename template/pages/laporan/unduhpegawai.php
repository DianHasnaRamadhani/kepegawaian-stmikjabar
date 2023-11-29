<?php
// memanggil library FPDF
require('../../../vendor/tecnickcom/tcpdf/tcpdf.php');
include '../../koneksi.php';
 
// Create a new TCPDF instance with custom page settings
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
$pdf->AddPage();
 
// Logo
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
$pdf->Cell(0, 10, 'Laporan Pegawai', 0, 1, 'C'); // Ubah lebar cell sesuai kebutuhan
 
$pdf->Cell(10, 15, '', 0, 1);
$pdf->SetFont('Times', 'B', 9);
$pdf->Cell(10, 7, 'NO', 1, 0, 'C');
$pdf->Cell(50, 7, 'NIP', 1, 0, 'C');
$pdf->Cell(75, 7, 'NAMA', 1, 0, 'C');
$pdf->Cell(55, 7, 'JABATAN', 1, 0, 'C');
 
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 10);
$no = 1;
$data = mysqli_query($koneksi, "SELECT  * FROM tb_pegawai");
while ($d = mysqli_fetch_array($data)) {
    $pdf->Cell(10, 6, $no++, 1, 0, 'C');
    $pdf->Cell(50, 6, $d['nip'], 1, 0);
    $pdf->Cell(75, 6, $d['nama'], 1, 0);
    $pdf->Cell(55, 6, $d['jabatan'], 1, 1);
}
 
$pdf->Output();

 
?>

