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
                <div class="ms-auto">
                    <a href="cms/login.php" class="btn btn-primary">Login</a>
                    <a href="cms/daftar.php" class="btn btn-success ms-2">Daftar</a>
                </div>
            </div>
        </nav>
    </div>

    <div class="container-fluid mt-2">
        <?php
        // $sSQL = "";
        // $sSQL = "select * from tb_video  order by video_id desc limit 1";
        // $result = mysqli_query($conn, $sSQL);
        // if (mysqli_num_rows($result) > 0) {
        //     $no = 0;
        //     while ($row = mysqli_fetch_assoc($result)) {
        //         $no++;
        //         $video_id = $row['video_id'];
        //         $video_name = $row['video_name'];
        //         $video_file = $row['video_file'];
        //     }
        // }
        ?>


        <video src="video/<?php echo $video_file; ?>" width="100%" autoplay muted loop>
        </video>


    </div>

    <div class="container-fluid mt-2 mb-3">
        <marquee behavior="" direction="">
            <h1 class="h1">Our Promo</h1>
        </marquee>

        <div class="row">
            <div class="col-sm-4 col-md-4 mb-2 flip">
                <img src="images/wedding.png" class="img-fluid">

            </div>
            <div class="col-sm-4 col-md-4 mb-2 flip">
                <img src="images/wedding.png" class="img-fluid">
            </div>
            <div class="col-sm-4 col-md-4 flip">
                <img src="images/wedding.png" class="img-fluid">
            </div>
        </div>

    </div>

    <div class="container mt-5">
        <h1 class="h1 text-center">About Us</h1>
        <div class="row mt-5">
            <div class="col-sm-6 col-md-6">
                <img src="images/chef.jpg" class="img-fluid rounded-corner">

            </div>
            <div class="col-sm-6 col-md-6">
                <p class="text-justify mb-2">
                    What is Lorem Ipsum?
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    Lorem Ipsum has been the industry's standard dummy text ever
                    since the 1500s, when an unknown printer took a galley of type and
                    scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap
                    into electronic typesetting, remaining essentially unchanged.
                    It was popularised in the 1960s with the release of Letraset sheets containing
                    <a href="about.php"
                        style="text-decoration:none;color:red;font-size:9px">... more details</a>
                </p>


            </div>
        </div>
    </div>

    <div class="container-fluid mt-4 bg-dark text-white pb-5">
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <ul style="list-style-type:none" class="ms-5 mt-5">
                    <li><a href="index.php" class="link-footer active-footer">Home</a></li>
                    <li><a href="about.php" class="link-footer">About Us</a></li>
                    <li><a href="menu.php" class="link-footer">Our Menu</a></li>
                    <li><a href="event.php" class="link-footer">Events</a></li>
                    <li><a href="news.php" class="link-footer">News</a></li>
                    <li><a href="contact.php" class="link-footer">Contact Us</a></li>


                </ul>


            </div>
            <div class="col-sm-4 col-md-4">
                <p class="p ms-5 mt-5">
                <h3>Our Adress </h1>
                    Jl.Sijuk Km 2.4 <br>
                    Tanjung Pandan <br>
                    Bangka Belitung <br>
                    Indonesia.
                    </p>



            </div>
            <div class="col-sm-4 col-md-4">
                <iframe class="ms-5 mt-5" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3985.3232516009734!2d107.6711514!3d-2.7200070000000007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e173e01eb87033b%3A0x4b4d5c2ae692612d!2sPandan%20House%20Restaurant!5e0!3m2!1sid!2sid!4v1756198162558!5m2!1sid!2sid"
                    width="auto" height="auto" style="border:0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>


            </div>

        </div>


    </div>




</body>

</html>