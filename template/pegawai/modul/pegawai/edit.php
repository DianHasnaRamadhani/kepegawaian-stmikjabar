<?php 
error_reporting(0);

 ?>
  <?php 
    session_start();
    require_once("koneksi.php");
    if (!isset($_SESSION['nip'])) {
        header("location: index.php");
    }else {
        $username = $_SESSION['nip'];  
    }

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
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
  <link rel="shortcut icon" href="../../../images/STMIK_JABAR-removebg-preview.jpeg" />
</head>
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<body>
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="../../../images/logo2.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../../../images/logo2.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <?php
            $nip = $_SESSION['nip'];
            include '../../koneksi.php';
            $sql = "SELECT * FROM tb_pegawai WHERE nip = '$nip'";
            $query = mysqli_query($koneksi, $sql);
            $r = mysqli_fetch_array($query);
          ?>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../../../pages/forms/images/<?php echo $r['foto'];?>" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="../../logout.php">
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
            <a class="nav-link" href="../../dashboard.php">
              <i class="icon-grid menu-icon text-white"></i>
              <span class="menu-title text-white">Dashboard</span>
            </a>
          </li>
          </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
           <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tambah Data</h4>
                  <p class="card-description">
                    Form Data Pegawai
                  </p>
                  <form class="forms-sample" action="update.php" enctype="multipart/form-data" method="POST">
                    <?php
                                  $nip = $_SESSION['nip'];
                                  include '../../koneksi.php';
                                  $sql = "SELECT * FROM tb_pegawai WHERE nip = '$nip'";
                                  $query = mysqli_query($koneksi, $sql);
                                  $r = mysqli_fetch_array($query);

                                   ?>
                    <div class="form-group">
                      <label >Nomor Induk Pegawai (NIP)</label>
                      <input type="text" class="form-control" readonly="" required="" placeholder="Nomor Induk Pegawai (NIP)" name="nip" value="<?php echo $r['nip'];?>">
                    </div>
                    <div class="form-group">
                      <label >Nama Lengkap</label>
                      <input type="text" class="form-control" required="" placeholder="Nama Lengkap" name="nama" value="<?php echo $r['nama'];?>">
                    </div>
                    <div class="form-group">
                      <label >Tempat Tanggal Lahir</label>
                      <input type="text" class="form-control" required="" placeholder="Tempat Tanggal Lahir" name="ttl" value="<?php echo $r['ttl'];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender" >Jenis Kelamin</label>
                        <select class="form-control" id="exampleSelectGender" required="" name="jenis_kelamin" >
                          <option><?php echo $r['jenis_kelamin'];?></option>
                          <option>Perempuan</option>
                          <option>Laki-Laki</option>
                        </select>
                      </div>
                    <div class="form-group">
                      <label >Alamat</label>
                      <input type="text" class="form-control" required="" placeholder="Alamat" name="alamat" value="<?php echo $r['alamat'];?>">
                    </div>
                    <div class="form-group">
                      <label >Agama</label>
                      <input type="text" class="form-control" required="" placeholder="Agama" name="agama" value="<?php echo $r['agama'];?>">
                    </div>
                    <div class="form-group">
                      <label >Pendidikan Terakhir</label>
                      <input type="text" class="form-control" required="" placeholder="Pendidikan Terakhir" name="pend_terakhir" value="<?php echo $r['pend_terakhir'];?>"> 
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Jabatan</label>
                        <select class="form-control" id="exampleSelectGender" required="" name="jabatan">
                          <option><?php echo $r['jabatan'];?></option>
                          <?php 
                            include '../../koneksi.php';
                            $sql = "SELECT * FROM tb_jabatan";
                            $hasil = mysqli_query($koneksi, $sql);
                            $no = 0;
                            while ($data = mysqli_fetch_array($hasil)) {
                            $no++;             
                          ?>
                          <option value="<?php echo $data['jabatan'];?>"><?php echo $data['jabatan'];?></option>
                          <?php } ?>
                        </select>
                      </div>
                    <div class="form-group">
                      <label >No Telepon</label>
                      <input type="text" class="form-control" required="" placeholder="No. Telepon" name="no_telepon" value="<?php echo $r['no_telepon'];?>">
                    </div>
                    <div class="form-group">
                      <label >Password</label>
                      <input type="text" class="form-control" required="" placeholder="Password" name="password" value="<?php echo $r['password'];?>">
                    </div>
                    <div class="form-group">
                      <label>Foto </label>
                      <?php 
                        if ($r['foto']!=''){
                          echo "<img src=\"../../../pages/forms/images/$r[foto]\" height=150 />";  
                        }
                        else{
                          echo "tidak ada gambar";
                        }
                      ?>
                      <div class="form-group col-xs-12">
                        <input type="checkbox" name="ubahfoto" value="true"> Ceklis jika ingin mengubah foto !
                        <br>
                        <input type="file" name="inpfoto">
                      </div>
                    </div>
                    <button type="submit" name="edit" class="btn btn-primary mr-2">Submit</button>
                    <a type="reset" name="" value="Batal" class="btn btn-light" href="../../dashboard.php">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
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
  <script src="../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../js/file-upload.js"></script>
  <script src="../../js/typeahead.js"></script>
  <script src="../../js/select2.js"></script>
  <!-- End custom js for this page-->
</body>

</html>