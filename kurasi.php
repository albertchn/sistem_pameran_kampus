<?php
session_start();
if (!$_SESSION['isLoggedin'] == 1)
    header("Location: cms/login.php");
if (!isset($_SESSION['kurator'])) {
    if (isset($_SESSION['mahasiswa'])) {
        header("Location: index.php");
    } elseif (isset($_SESSION['admin'])) {
        header("Location: cms/dashboard.php");
    } else {
        header("Location: cms/logout.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kurasi | Pusat Seni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .nav-link,
        .dropdown-item {
            font-size: 13px;
            color: black;
            text-transform: uppercase;
        }

        .nav-item {
            margin-right: 15px;
        }

        .active {
            background-color: darkblue;
            color: white !important;
        }

        .nav-link:hover,
        .dropdown-item:hover {
            background-color: red;
            color: white !important;
        }

        .flip:hover {
            transform: rotateY(360deg);
            transition: transform 1s;
        }

        .link-footer {
            color: white;
            text-decoration: none;
        }

        .link-footer:hover {
            color: yellow;
        }

        .active-footer {
            color: aqua;
        }
    </style>

</head>

<body>
    <div class="container-fluid  border-bottom border-dark" id="top-bar">
        <nav class="navbar navbar-expand-sm  text-dark">
            <div class="container-fluid">
                <!-- <a class="navbar-brand" href="#"><img src="images/logo.png" class="img-fluid" style="width:65px"></a> -->
                <a class="navbar-brand" href="#">
                    <h5>Pusat Seni</h5>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="kurasi.php">Daftar Kurasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="riwayat_kurasi.php">Riwayat Kurasi</a>
                        </li>
                    </ul>
                </div>
                <div class="ms-auto">
                    <a href="cms/logout.php" class="btn btn-danger" onclick="return confirm('Logout sekarang?')">Logout</a>
                </div>
            </div>
        </nav>
    </div>

    <?php
    include "cms/connection.php";
    ?>


    <div class="container">
        <h2 class="text-center my-3">Daftar Kurasi</h2>

        <input id="myInput" type="text" placeholder="Search..">
        <br>

        <table class="table table-hover text-center mt-2" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Karya</th>
                    <th>Foto Karya</th>
                    <th>Tenggat Kurasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id_user = $_SESSION['id_user'];
                $sSQL = "";
                $sSQL = "select * from tb_karya where status in ('submitted') and tenggat_kurasi >= CURRENT_DATE() order by id_karya";
                $result = mysqli_query($conn, $sSQL);
                if (mysqli_num_rows($result) > 0) {
                    $no = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $no++;
                        $id_karya = $row['id_karya'];
                        $judul_karya = $row['judul_karya'];
                        $foto_karya = $row['foto_kaya'];
                        $tenggat_kurasi = $row['tenggat_kurasi'];

                        $sql = mysqli_query($conn, "select status from tb_kurasi where id_karya=$id_karya and id_user=$id_user")->fetch_assoc();
                        if (!empty($sql)) {
                            $status = $sql['status'];
                        } else {
                            $status = '';
                        }
                ?>

                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $judul_karya; ?></td>
                            <td><img src="images/<?= $foto_karya; ?>" width="80px"></td>
                            <td>
                                <p><?= date('d-m-Y', strtotime($tenggat_kurasi)); ?></p>
                            </td>
                            <?php if ($status == 'draft'): ?>
                                <td><a href="edit_kurasi_karya.php?id_karya=<?= $id_karya; ?>" class="btn btn-success">Edit</td>
                            <?php elseif ($status == 'submitted'): ?>
                                <td><b>Submitted</b></td>
                            <?php else: ?>
                                <td><a href="kurasi_karya.php?id_karya=<?= $id_karya; ?>" class="btn btn-primary">Kurasi</td>
                            <?php endif; ?>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td align="center" colspan="5" class="text-danger">Tidak ada karya untuk dikurasi !</td>
                    </tr>
                <?php } ?>



            </tbody>
        </table>
    </div>



</body>

</html>