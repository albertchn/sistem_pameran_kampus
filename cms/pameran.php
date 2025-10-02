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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pameran | Pusat Seni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        function confirm_delete() {
            if (confirm("Hapus baris ini ?"))
                return true;
            else
                return false;
        }
    </script>


</head>

<body>
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
                    <span>Dashboard</span></a>
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
                    <span class="fw-bold">Pameran</span></a>
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
                    ?>


                    <div class="container">
                        <h2 class="text-center mb-3 text-black">Daftar Pameran</h2>

                        <input id="myInput" type="text" placeholder="Search..">
                        <br>

                        <a href="regis_pameran.php">
                            <button type="button" class="btn btn-dark mt-2">Registrasi Pameran</button>
                        </a>

                        <table class="table table-hover text-center mt-2" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Karya</th>
                                    <th>Foto Karya</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi</th>
                                    <th>Ruang Display</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sSQL = "";
                                $sSQL = "select * from tb_karya left join tb_pameran on tb_karya.id_karya = tb_pameran.id_karya where tb_pameran.status='scheduled' order by tb_karya.id_karya";
                                $result = mysqli_query($conn, $sSQL);
                                if (mysqli_num_rows($result) > 0) {
                                    $no = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $no++;
                                        $id_pameran = $row['id_pameran'];
                                        $judul_karya = $row['judul_karya'];
                                        $foto_karya = $row['foto_kaya'];
                                        $tanggal = $row['tanggal'];
                                        $lokasi = $row['pencipta'];
                                        $ruang_display = $row['ruang_display'];
                                ?>

                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?= $judul_karya; ?></td>
                                            <td><img src="../images/<?= $foto_karya; ?>" width="60px"></td>
                                            <td><?= date('d-m-Y', strtotime($tanggal)); ?></td>
                                            <td><?= $lokasi; ?></td>
                                            <td><?= $ruang_display; ?></td>
                                            <td>
                                                <a href="edit_pameran.php?id_pameran=<?= $id_pameran; ?>" class="btn btn-success">Edit</a>
                                                <a href="delete_pameran.php?id_pameran=<?= $id_pameran; ?>" class="btn btn-danger" onclick="return confirm('Hapus jadwal pameran ini?')">Delete</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }


                                ?>



                            </tbody>
                        </table>
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