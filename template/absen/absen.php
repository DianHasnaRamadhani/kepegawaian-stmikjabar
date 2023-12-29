<?php
// Koneksi ke database
include '../koneksi.php';

// Ambil total pegawai
date_default_timezone_set('Asia/Jakarta');
$queryTotalPegawai = "SELECT COUNT(*) as total FROM tb_pegawai";
$resultTotalPegawai = mysqli_query($koneksi, $queryTotalPegawai);
$rowTotalPegawai = mysqli_fetch_assoc($resultTotalPegawai);
$totalPegawai = $rowTotalPegawai['total'];

// Ambil data pegawai yang sudah absen hari ini
$tanggalHariIni = date("Y-m-d");
$queryDataAbsen = "SELECT * FROM tb_absen WHERE DATE(masuk) = '$tanggalHariIni'";
$resultDataAbsen = mysqli_query($koneksi, $queryDataAbsen);

// Hitung jumlah pegawai yang sudah absen hari ini
$totalAbsenHariIni = mysqli_num_rows($resultDataAbsen);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/chart.js" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images/STMIK_JABAR-removebg-preview.jpeg" />
    <style>
        .container {
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }

        #chartContainer {
            width: 100%;
        }

        #tableContainer {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <title>Dashboard Absensi Pegawai</title>
</head>
<body>
    <div class="container">
    <h2 class="text-center">Presensi Pegawai</h2>
        <div class="row">
            <div class="col-12">
                <!-- Awal Table -->
                <div id="tableContainer">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle; text-align: center;">NIP</th>
                                <th style="vertical-align: middle; text-align: center;">Nama</th>
                                <th style="vertical-align: middle; text-align: center;">Absen Masuk</th>
                                <th style="vertical-align: middle; text-align: center;">Absen Pulang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            date_default_timezone_set('Asia/Jakarta');
                            while ($row = mysqli_fetch_assoc($resultDataAbsen)) : ?>
                                <tr>
                                    <td style="vertical-align: middle; text-align: center;"><?php echo $row['nip']; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td style="vertical-align: middle; text-align: center;"><?php echo date('H:i', strtotime($row['masuk'])); ?></td>
                                    <td style="vertical-align: middle; text-align: center;"><?php echo date('H:i', strtotime($row['pulang'])); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Akhir Table -->
            </div>

            <div class="col-12 mt-5">
                <!-- Awal form -->
                <div id="absensiForm" class="mt-6">
                    <form action="proses_absen.php" method="post">
                        <div class="form-group">
                            <label for="password">Masukan Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <p class="text-right">Kembali ke login Admin <a href="../index.php">disini!</a>.</p>
                <!-- Akhir Form -->
            </div>
        </div>
    
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('pieChart').getContext('2d');
        var data = {
            labels: ['Absen', 'Hadir'],
            datasets: [{
                data: [<?php echo $totalPegawai - $totalAbsenHariIni; ?>, <?php echo $totalAbsenHariIni; ?>],
                backgroundColor: ['#808080', '#2554C7'],
            }]
        };
        var options = {
            responsive: false,
            maintainAspectRatio: false,
        };
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
