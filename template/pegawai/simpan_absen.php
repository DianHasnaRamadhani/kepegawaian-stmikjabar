<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $waktu = $_POST['waktu'];
    $masuk = $_POST['waktu'];
    
    $baru = DateTime::createFromFormat('Y-m-d H:i:s', $waktu);
    $hari_ini = $baru->format('Y-m-d');
    // die(var_dump($hari_ini));
    // Inisialisasi variabel status
    $status = "";
    date_default_timezone_set('Asia/Jakarta');
    // Tentukan status berdasarkan waktu absen
    if (strtotime($waktu) >= strtotime("00:00:00") && strtotime($waktu) <= strtotime("08:00:00")) {
        $status = "Hadir";
    } elseif (strtotime($waktu) >= strtotime("08:01:00") && strtotime($waktu) <= strtotime("15:59:00")) {
        $status = "Terlambat";
    } elseif (strtotime($waktu) >= strtotime("16:00:00") && strtotime($waktu) <= strtotime("23:59:00")){
        $status = "Pulang";
    }

    $tanggal_hari_ini = date("Y-m-d");

    // Cek apakah pengguna sudah absen hari ini
    $cek_absen = "SELECT status FROM tb_absen WHERE nip='$nip' AND DATE(waktu)='$tanggal_hari_ini'";
    $result = mysqli_query($koneksi, $cek_absen);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        if(strtotime($waktu) >= strtotime("00:00:00") && strtotime($waktu) <= strtotime("08:00:00")){
            $cek_absen= "SELECT * FROM tb_absen WHERE nip = '$nip' AND DATE(waktu) = '$tanggal_hari_ini' AND status = 'Hadir'";
            $result_hadir = mysqli_query($koneksi, $cek_absen);
            if (mysqli_num_rows($result_hadir) > 0) {
                // Pengguna sudah melakukan absen "Pulang" pada hari yang sama
                echo "<script>alert('Anda sudah melakukan absen Hadir pada hari ini.') </script>";
                echo "<script>window.location.href = \"dashboard.php\" </script>";
            }else{
                $save = "INSERT INTO tb_absen SET nip='$nip', nama='$nama', waktu='$waktu', status='Hadir'";
                $result = mysqli_query($koneksi, $save);
                if ($result) {
                    echo "<script>alert('Anda berhasil absen untuk hari ini dengan status: Hadir') </script>";
                    echo "<script>window.location.href = \"dashboard.php\" </script>";
                } else {
                    echo "Gagal melakukan absen.";
                }
            }
        }elseif(strtotime($waktu) >= strtotime("08:01:00") && strtotime($waktu) <= strtotime("15:59:00")){
            $cek_absen_hadir = "SELECT * FROM tb_absen WHERE nip = '$nip' AND DATE(waktu) = '$tanggal_hari_ini' AND status = 'Hadir'";
            $result_hadir = mysqli_query($koneksi, $cek_absen_hadir);
            if (mysqli_num_rows($result_hadir) > 0) {
                // Pengguna sudah melakukan absen "Pulang" pada hari yang sama
                echo "<script>alert('Anda sudah melakukan absen Hadir pada hari ini.') </script>";
                echo "<script>window.location.href = \"dashboard.php\" </script>";
            }else{
                $save = "INSERT INTO tb_absen SET nip='$nip', nama='$nama', waktu='$waktu', masuk='$waktu', status='Terlambat'";
                $result = mysqli_query($koneksi, $save);
                if ($result) {
                    echo "<script>alert('Anda berhasil absen untuk hari ini dengan status: Terlambat') </script>";
                    echo "<script>window.location.href = \"dashboard.php\" </script>";
                } else {
                    echo "Gagal melakukan absen.";
                }
            }
        }elseif($row['status'] === 'Hadir' || $row['status'] === 'Terlambat'  && strtotime($waktu) > strtotime("16:00:00")) {
            $cek_absen_pulang = "SELECT * FROM tb_absen WHERE nip = '$nip' AND DATE(waktu) = '$tanggal_hari_ini' AND status = 'Pulang'";
            $result_pulang = mysqli_query($koneksi, $cek_absen_pulang);
            if (mysqli_num_rows($result_pulang) > 0) {
                // Pengguna sudah melakukan absen "Pulang" pada hari yang sama
                echo "<script>alert('Anda sudah melakukan absen Pulang pada hari ini.') </script>";
                echo "<script>window.location.href = \"dashboard.php\" </script>";
            }
            else{
                $save = "UPDATE tb_absen SET status = '$status' , waktu = '$waktu' WHERE nip='$nip' AND DATE(waktu)='$hari_ini'";
                $result = mysqli_query($koneksi, $save);
                    if ($result) {
                        echo "<script>alert('Status absen untuk hari ini dengan status: Pulang') </script>";
                        echo "<script>window.location.href = \"dashboard.php\" </script>";
                    } else {
                        echo "Gagal melakukan absen.";
                    }
            }
        }else{
            echo "<script>alert('Anda sudah pulang') </script>";
            echo "<script>window.location.href = \"dashboard.php\" </script>";
        }
}else{
    $save = "INSERT INTO tb_absen SET nip='$nip', nama='$nama', waktu='$waktu', status='$status'";
                $result = mysqli_query($koneksi, $save);
                if ($result) {
                    echo "<script>alert('Anda berhasil absen untuk hari ini dengan status: $status') </script>";
                    echo "<script>window.location.href = \"dashboard.php\" </script>";
                } else {
                    echo "Gagal melakukan absen.";
                }
}
}
?>