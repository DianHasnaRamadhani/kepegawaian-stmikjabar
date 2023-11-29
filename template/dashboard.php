<?php 
    session_start();
    require_once("koneksi.php");
    if (!isset($_SESSION['username'])) {
        header("location: index.php");
    }else {
        $username = $_SESSION['username'];  
    }

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>STMIK JABAR</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/STMIK_JABAR-removebg-preview.jpeg" />
</head>
<body>
   <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="images/logo2.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo2.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="images/STMIK_JABAR-removebg-preview.jpeg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="logout.php">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas navbar-primary bg-primary" id="sidebar">
        <ul class="nav ">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="icon-grid menu-icon text-white"></i>
              <span class="menu-title text-white">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon text-white"></i>
              <span class="menu-title text-white">Master Data</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/tables/datapegawai.php">Data Pegawai</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/tables/datajabatan.php">Data Jabatan</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/tables/dataabsen.php">
              <i class="icon-columns menu-icon text-white"></i>
              <span class="menu-title text-white">Kehadiran Pegawai</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon text-white"></i>
              <span class="menu-title text-white">Laporan</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/laporan/laporandataabsen.php">Laporan Absen</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/laporan/laporandatapegawai.php">Laporan Pegawai</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h2 class="font-weight-bold">Dashboard</h2>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <?php
              include 'koneksi.php';
               
              // mengambil data barang
              $pegawai = mysqli_query($koneksi,"SELECT * FROM tb_pegawai");
               
              // menghitung data barang
              $jumlah_pegawai = mysqli_num_rows($pegawai);
              ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pegawai
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumlah_pegawai; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Monthly) Card Example -->
            <?php
                          include 'koneksi.php';
                          date_default_timezone_set('Asia/Jakarta');
                          // Mendapatkan tanggal hari ini dalam format Y-m-d
                          $tanggal_hari_ini = date("Y-m-d");

                          // Mengambil data absen masuk untuk hari ini
                          $absen_masuk_hari_ini = mysqli_query($koneksi, "SELECT * FROM tb_absen WHERE DATE(masuk) = '$tanggal_hari_ini'");

                          // Menghitung jumlah data absen masuk untuk hari ini
                          $jumlah_absen_masuk_hari_ini = mysqli_num_rows($absen_masuk_hari_ini);
                          ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Absen Masuk
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $jumlah_absen_masuk_hari_ini; ?></div>
                                                </div>
                                            </div>
                                          <div class="col-auto">
                                              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <?php
                          include 'koneksi.php';
                          date_default_timezone_set('Asia/Jakarta');
                          // Mendapatkan tanggal hari ini dalam format Y-m-d
                          $tanggal_hari_ini = date("Y-m-d");

                          // Mengambil data absen masuk untuk hari ini
                          $absen_masuk_hari_ini = mysqli_query($koneksi, "SELECT * FROM tb_absen WHERE DATE(pulang) = '$tanggal_hari_ini'");

                          // Menghitung jumlah data absen masuk untuk hari ini
                          $jumlah_absen_masuk_hari_ini = mysqli_num_rows($absen_masuk_hari_ini);
                          ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Absen Pulang
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $jumlah_absen_masuk_hari_ini; ?></div>
                                                </div>
                                            </div>
                                          <div class="col-auto">
                                              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            <?php
              // Koneksi ke database
              include 'koneksi.php';

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
            <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Data Kehadiran Hari Ini</p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>NIP</th>
                          <th>Nama</th>
                          <th>Masuk</th>
                          <th>Pulang</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php 
                            date_default_timezone_set('Asia/Jakarta');
                            while ($row = mysqli_fetch_assoc($resultDataAbsen)) : ?>
                                <tr>
                                    <td><?php echo $row['nip']; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                    <td><?php echo $row['masuk']; ?></td>
                                    <td><?php echo $row['pulang']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Diagram Kehadiran Hari Ini</p>
                  <canvas id="pieChart" width="300" height="300"></canvas>
                </div>
              </div>
            </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('pieChart').getContext('2d');
        var data = {
            labels: ['Pegawai', 'Hadir'],
            datasets: [{
                data: [<?php echo $totalPegawai - $totalAbsenHariIni; ?>, <?php echo $totalAbsenHariIni; ?>],
                backgroundColor: ['#36A2EB', '#FF6384'],
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
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. STMIK JABAR</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

