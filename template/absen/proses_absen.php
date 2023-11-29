<?php
include '../koneksi.php'; // Sesuaikan dengan file koneksi Anda
date_default_timezone_set('Asia/Jakarta');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $waktu = date('Y-m-d H:i:s');
    
    // Periksa apakah password sesuai dengan yang ada di database
    $queryCekPassword = "SELECT * FROM tb_pegawai WHERE password='$password'";
    $resultCekPassword = mysqli_query($koneksi, $queryCekPassword);

    if (mysqli_num_rows($resultCekPassword) > 0) {
        // Password sesuai, ambil data NIP dan Nama
        $rowPegawai = mysqli_fetch_assoc($resultCekPassword);
        $nip = $rowPegawai['nip'];
        $nama = $rowPegawai['nama'];
        $password = $rowPegawai['password'];

        // Lakukan absen masuk atau pulang berdasarkan jam
        if (date('H:i') >= '00:00' && date('H:i') <= '15:59') {
            $queryCekAbsenMasuk = "SELECT * FROM tb_absen WHERE password = '$password' AND DATE(masuk) = CURDATE()";
            $resultCekAbsenMasuk = mysqli_query($koneksi, $queryCekAbsenMasuk);
            if (mysqli_num_rows($resultCekAbsenMasuk) > 0) {
                 $queryAbsenPulang = "UPDATE tb_absen SET pulang = '$waktu', status = 'Pulang Cepat' WHERE password = '$password' AND DATE(masuk) = CURDATE()";
                echo "<script>window.location.href = \"absen.php\" </script>";
            } else {
                // Absen masuk
                $queryAbsenMasuk = "INSERT INTO tb_absen (nip, nama, password, masuk, status) VALUES ('$nip', '$nama', '$password', '$waktu', 'Pulang Cepat')";
                echo "<script>window.location.href = \"absen.php\" </script>";
            }
        } elseif (date('H:i') >= '16:00') {
            // Periksa apakah sudah ada absen masuk hari ini
            $queryCekAbsenMasuk = "SELECT * FROM tb_absen WHERE password = '$password' AND DATE(masuk) = CURDATE()";
            $resultCekAbsenMasuk = mysqli_query($koneksi, $queryCekAbsenMasuk);

            if (mysqli_num_rows($resultCekAbsenMasuk) > 0) {
                // Absen pulang
                $queryAbsenPulang = "UPDATE tb_absen SET pulang = '$waktu', status = 'Hadir' WHERE password = '$password' AND DATE(masuk) = CURDATE()";
                echo "<script>window.location.href = \"absen.php\" </script>";
            } else {
               $queryAbsenPulang = "INSERT INTO tb_absen (nip, nama, password, pulang, status) VALUES ('$nip', '$nama', '$password', '$waktu', 'Terlambat')";
               echo "<script>window.location.href = \"absen.php\" </script>";
            }
        } else {
            $pesan = "Belum saatnya absen!";
        }
    } else {
        echo "<script>window.location.href = \"absen.php\" </script>";
    }

    // Eksekusi query
    if (isset($queryAbsenMasuk)) {
        mysqli_query($koneksi, $queryAbsenMasuk);
    } elseif (isset($queryAbsenPulang)) {
        mysqli_query($koneksi, $queryAbsenPulang);
    }
}
?>
