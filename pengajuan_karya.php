<?php
session_start();

if (!$_SESSION['isLoggedin'] == 1)
    header("location:cms/login.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Karya | Pusat Seni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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

        .card-title {
            font-size: 12px;
            color: darkblue;
        }

        .card-text {
            font-size: 10px;
            color: red;
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
                            <a class="nav-link" href="index.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="pengajuan_karya.php">Pengajuan Karya</a>
                        </li>
                    </ul>
                </div>
                <div class="ms-auto">
                    <a href="cms/logout.php" class="btn btn-danger" onclick="return confirm('Logout sekarang?')">Logout</a>
                </div>
            </div>
        </nav>
    </div>

    <div class="container">
        <h2 class="mt-3 text-center">Pengajuan Karya Mahasiswa</h2>

        <a href="daftar_karya.php">
            <button type="button" class="btn btn-dark mt-2">Ajukan Karya</button>
        </a>
        <div class="row mt-4">
            <?php
            include "cms/connection.php";
            $id_user = $_SESSION['id_user'];
            $sSQL = "";
            $sSQL = "select * from tb_karya where id_user = $id_user";
            $result = mysqli_query($conn, $sSQL);
            if (mysqli_num_rows($result) > 0) {
                $no = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $id_karya = $row['id_karya'];
                    $judul_karya = $row['judul_karya'];
                    $foto_karya = $row['foto_kaya'];
                    $deskripsi = $row['deskripsi'];
                    $pencipta = $row['pencipta'];
                    $status = $row['status'];
                    $skor = $row['skor'];

            ?>
                    <div class="col col-6 my-2">
                        <div class="card" style="min-height: 550px;">
                            <img class="card-img-top" src="images/<?= $foto_karya; ?>" height="200px">
                            <div class="card-body">
                                <h3 class=""><?= $judul_karya; ?></h3>
                                <div class="row">
                                    <div class="col col-6">
                                        <p>Pencipta: <?= $pencipta; ?></p>
                                        <?php if ($status == 'accepted' or $status == 'submitted'): ?>
                                            <p>Status: <span style="color: lime;"><?= ucwords($status); ?></span></p>
                                        <?php elseif ($status == 'rejected'): ?>
                                            <p>Status: <span style="color: red;"><?= ucwords($status); ?></span></p>
                                        <?php endif; ?>
                                        <p>Skor:
                                            <?php if (empty($skor)): ?>
                                                -
                                            <?php else: echo $skor;
                                            endif; ?>
                                        </p>
                                    </div>
                                    <div class="col col-6">
                                        <?php if ($status == 'accepted'): ?>
                                            <?php
                                            $sSQL = "select * from tb_pameran where id_karya = $id_karya limit 1";
                                            $sql = mysqli_query($conn, $sSQL);
                                            $pmr = mysqli_fetch_assoc($sql);
                                            if (mysqli_num_rows($sql) > 0):
                                            ?>
                                                <p>Jadwal Pameran:</p>
                                                <p>Tanggal: <?= date('d-m-Y', strtotime($pmr['tanggal'])); ?></p>
                                                <p>Lokasi: <?= $pmr['lokasi']; ?></p>
                                                <p>Ruang: <?= $pmr['ruang_display']; ?></p>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <p class="">Deskripsi:<br><?= $deskripsi; ?></p>
                                <?php
                                if ($status == 'draft'):
                                ?>
                                    <a href="edit_daftar_karya.php?id_karya=<?= $id_karya; ?>" class="btn btn-success">Edit</a>
                                    <a href="delete_daftar_karya.php?id_karya=<?= $id_karya; ?>&foto_karya=<?= $foto_karya; ?>" class="btn btn-warning" onclick="return confirm('Hapus karya ini?')">Delete</a>
                                <?php endif; ?>

                            </div>
                        </div>

                    </div>
            <?php
                }
            }


            ?>


        </div>
    </div>





</body>

</html>