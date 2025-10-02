<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Seni</title>
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
    </style>

</head>

<body>
    <?php
    include "cms/connection.php";
    session_start();
    ?>


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
                            <a class="nav-link active" href="index.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pengajuan_karya.php">Pengajuan Karya</a>
                        </li>
                    </ul>
                </div>
                <?php
                if (!isset($_SESSION['isLoggedin']) == 1):
                ?>
                    <div class="ms-auto">
                        <a href="cms/login.php" class="btn btn-primary">Login</a>
                        <a href="cms/daftar.php" class="btn btn-success ms-2">Daftar</a>
                    </div>
                <?php
                else:
                ?>
                    <div class="ms-auto">
                        <a href="cms/logout.php" class="btn btn-danger" onclick="return confirm('Logout sekarang?')">Logout</a>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
    </div>

    <div class="container mt-2">
        <marquee behavior="" direction="">
            <h1 class="h1">PAMERAN TERKEDAT</h1>
        </marquee>
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <?php
                $sSQL = "";
                $sSQL = "select * from tb_karya left join tb_pameran on tb_karya.id_karya = tb_pameran.id_karya where tb_pameran.status='scheduled' order by tb_pameran.tanggal";
                $result = mysqli_query($conn, $sSQL);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $judul_karya = $row['judul_karya'];
                        $foto_karya = $row['foto_kaya'];
                        $tanggal = $row['tanggal'];
                        $pencipta = $row['pencipta'];
                        $lokasi = $row['lokasi'];
                ?>
                        <div class="carousel-item active">
                            <img src="images/<?= $foto_karya; ?>" class="d-block w-100 h-50" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?= $judul_karya; ?></h5>
                                <p><?= $pencipta; ?></p>
                                <p align='center'><?= $lokasi; ?> | <?= date('d-m-Y', strtotime($tanggal)); ?></p>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container my-5">
        <h1 class="h1 text-center">Tentang Kami</h1>
        <div class="row mt-5">
            <div class="col-sm-6 col-md-6">
                <img src="images/pusatseni.png" class="img-fluid rounded-corner w-100">

            </div>
            <div class="col-sm-6 col-md-6">
                <p style="text-align: justify; text-indent: 25px;">
                    Pusat Seni Fakultas Seni hadir sebagai ruang kreatif yang mewadahi berbagai aktivitas seni, mulai dari pameran, pertunjukan, hingga penelitian dan pengembangan karya. Kami percaya bahwa seni tidak hanya menjadi sarana ekspresi, tetapi juga medium untuk membangun dialog, memperluas wawasan, dan memperkaya nilai-nilai budaya. Melalui kegiatan yang melibatkan mahasiswa, dosen, dan komunitas seni, pusat ini berupaya menghadirkan pengalaman estetik yang bermakna serta relevan dengan perkembangan zaman.
                </p>
                <p style="text-align: justify; text-indent: 25px;">
                    Sebagai bagian dari fakultas, Pusat Seni berkomitmen untuk menjadi jembatan antara dunia akademik dan masyarakat luas. Dengan memadukan tradisi dan inovasi, kami berusaha menciptakan ruang kolaboratif yang inklusif, terbuka, dan inspiratif. Harapannya, pusat ini dapat menjadi katalis bagi tumbuhnya ekosistem seni yang dinamis sekaligus menjadi sumber inspirasi, pembelajaran, dan kontribusi nyata bagi perkembangan seni di tingkat lokal maupun global.
                </p>


            </div>
        </div>
    </div>
</body>

</html>