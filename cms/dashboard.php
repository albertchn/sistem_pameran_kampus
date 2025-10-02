<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Pusat Seni</title>

  <!-- Custom fonts for this template-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
  <?php
  session_start();
  if (!$_SESSION['isLoggedin'] == 1)
    header("Location: login.php");
  if (!isset($_SESSION['admin'])) {
    if (isset($_SESSION['kurator'])) {
      header("Location: ../kurasi.php");
    } elseif (isset($_SESSION['mahasiswa'])) {
      header("Location: ../index.php");
    } else {
      header("Location: logout.php");
    }
  }
  ?>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Pusat Seni </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php" onclick="refreshIframe()">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span><b>Dashboard</b></span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Menu
      </div>




      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="mahasiswa.php">
          <i class="fas fa-fw fa-graduation-cap"></i>
          <span>Mahasiswa</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="kurator.php">
          <i class="fas fa-fw fa-magic"></i>
          <span>Kurator</span></a>
      </li>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="karya.php">
          <i class="fas fa-fw fa-image"></i>
          <span>Karya</span></a>
      </li>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="pameran.php">
          <i class="fas fa-fw fa-film"></i>
          <span>Pameran</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-3 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['email'] ?></span>
                <div class="topbar-divider d-none d-sm-block"></div>
                <i class="bi bi-gear-fill" style="color: black;"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php
          include "connection.php";
          $jml_mhs = mysqli_query($conn, "select count(id_user) as jumlah_mahasiswa from tb_users where role='mahasiswa'")->fetch_assoc();
          $jml_krt = mysqli_query($conn, "select count(id_user) as jumlah_kurator from tb_users where role='kurator'")->fetch_assoc();
          $jml_ky = mysqli_query($conn, "select count(id_karya) as jumlah_karya from tb_karya where status in ('submitted','accepted','rejected')")->fetch_assoc();
          $jml_pmr = mysqli_query($conn, "select count(id_pameran) as jumlah_pameran from tb_pameran")->fetch_assoc();
          ?>

          <div class="row">
            <div class="col-sm-6 col-md-4">
              <div class="card bg-primary text-white mb-4">
                <div class="card-body">Jumlah Mahasiswa<br><span class="small"><?= $jml_mhs['jumlah_mahasiswa']; ?> Orang</span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a href="mahasiswa.php" class="small text-black text-decoration-underline stretched-link">Lihat Detail</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="card bg-success text-white mb-4">
                <div class="card-body">Jumlah Kurator<br><span class="small"><?= $jml_krt['jumlah_kurator']; ?> Orang</span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a href="kurator.php" class="small text-black text-decoration-underline stretched-link">Lihat Detail</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="card bg-danger text-white mb-4">
                <div class="card-body">Jumlah Karya<br><span class="small"><?= $jml_ky['jumlah_karya']; ?> Karya</span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a href="karya.php" class="small text-black text-decoration-underline stretched-link">Lihat Detail</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-4">
              <div class="card bg-dark text-white mb-4">
                <div class="card-body">Jumlah Pameran<br><span class="small"><?= $jml_pmr['jumlah_pameran']; ?> Pameran</span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a href="pameran.php" class="small text-black text-decoration-underline stretched-link">Lihat Detail</a>
                </div>
              </div>
            </div>
          </div>
          <iframe frameborder="0" id="ifrm" name="ifrm" width="100%" height="500px">
            <!-- Page Heading -->

          </iframe>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Keluar sekarang?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih "Logout" dibawah jika anda siap mengakhiri sesi ini.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>