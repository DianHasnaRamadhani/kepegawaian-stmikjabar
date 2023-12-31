<?php 
    session_start();
    require_once("../../koneksi.php");
    if (!isset($_SESSION['username'])) {
        header("location: ../../index.php");
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
  <title>Data Pegawai | STMIK JABAR</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/STMIK_JABAR-removebg-preview.jpeg" />
</head>

<body>
  <?php 
    session_start();
    if (!isset($_SESSION['username'])) {
        header("location: ../../index.php");
    }else {
        $username = $_SESSION['username'];  
    }

 ?>
   <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="../../images/logo2.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../../images/logo2.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../../images/STMIK_JABAR-removebg-preview.jpeg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-power-off text-primary" href="../../logout.php"></i>
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
            <a class="nav-link" href="../../dashboard.php">
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
                <li class="nav-item"> <a class="nav-link" href="datapegawai.php">Data Pegawai</a></li>
                <li class="nav-item"> <a class="nav-link" href="datajabatan.php">Data Jabatan</a></li>
              </ul>
            </div>
          </li>
         <li class="nav-item">
            <a class="nav-link" href="../tables/dataabsen.php">
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
                <li class="nav-item"> <a class="nav-link" href="../laporan/laporandataabsen.php">Laporan Kehadiran</a></li>
                <li class="nav-item"> <a class="nav-link" href="../laporan/laporandatapegawai.php">Laporan Pegawai</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <?php 
              include '../../koneksi.php';
              $query1 = "SELECT * FROM tb_pegawai ORDER BY id_pegawai";

              $pola = 'asc';
              $polabaru = 'asc';

              if (isset($_GET['orderby'])) {
                $orderby = $_GET['orderby'];
                $pola = $_GET['pola'];

                $query1 = "SELECT * FROM tb_karyawan ORDER BY $orderby $pola";
                mysqli_query($koneksi, $query1);
                if ($pola=='asc') {
                  $polabaru = 'desc';
                }else{
                  $polabaru = 'asc';
                }

              }
          ?>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Pegawai</h4>
                  <p class="card-description">
                    <div class="row">
                      <div class="col-md-6">
                        <!-- Tombol "Tambah Data" di sebelah kiri -->
                        <a class="btn btn-success" href="../forms/tambahdatapegawai.php">Tambah Data</a>
                      </div>
                      <div class="col-md-6">
                        <!-- Kotak pencarian di sebelah kanan -->
                        <form action="caripegawai.php" method="POST" class="form-inline float-md-right">
                          <div class="form-group">
                            <input type="text" class="form-control" name="cari" placeholder="Ketik kata kunci...">
                          </div>
                          <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                      </div>
                    </div>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>NIP</th>
                          <th>Nama</th>
                          <th>Jabatan</th>
                          <th>Alamat</th>
                          <th>No Telepon</th>
                          <th>Foto</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <?php 
                        $no = 1;
                      ?>
                      <?php 
                                            $cari = $_POST['cari'];
                                            $sql = "SELECT * FROM tb_pegawai WHERE nip LIKE '%$cari%' OR nama LIKE '%$cari%'";
                                            $query = mysqli_query($koneksi, $sql);

                                            $no = 1;

                                            while ($row = mysqli_fetch_array($query)) {
                                                # code...
                                            
                                             ?>
                                            <tr>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo $row['nip']; ?></td>
                                                <td><?php echo $row['nama']; ?></td>
                                                <td><?php echo $row['jabatan']; ?></td>
                                                <td><?php echo $row['alamat']; ?></td>
                                                <td><?php echo $row['no_telepon']; ?></td>
                                                <td>
                                                    <?php 

                                                    if ($row['foto']!='') {
                                                        echo "<img src=\" ../forms/images/$row[foto]\" />";
                                                    }else{
                                                        echo "images";
                                                    }

                                                     ?>
                                                    

                                                </td>
                                                <td><a href="karyawan_edit.php?id_karyawan=<?php echo $row['nip']; ?>"><button class="btn btn-primary">Ubah</button></a> <a href="hapus.php?id_karyawan=<?php echo $row['nip']; ?>"><button class="btn btn-danger" onclick="return confirm('yakin ingin dihapus?');">Hapus</button></a></td>


                                                
                                            </tr>
                                             <?php 
                                                   $no++;
                                               }

                                            ?>
                                                  </tbody>
                                                </table>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                       
                                      </div>
                                    </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
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
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
