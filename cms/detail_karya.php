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
    <title>Detail Karya | Pusat Seni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body>

    <?php
    include "connection.php";
    $id_karya = $_GET['id_karya'];
    $sSQL = "";
    $sSQL = "select * from tb_karya where id_karya=$id_karya limit 1";
    $result = mysqli_query($conn, $sSQL)->fetch_assoc();
    $judul_karya = $result['judul_karya'];
    $foto_karya = $result['foto_kaya'];
    $pencipta = $result['pencipta'];
    $deskripsi = $result['deskripsi'];
    $skor = $result['skor'];
    $status = $result['status'];
    ?>

    <div class="container">
        <h1 class="text-center mt-2 mb-4">Detail Karya</h1>
        <div class="row">
            <div class="col col-6">
                <img src="../images/<?= $foto_karya; ?>" width="100%">
            </div>
            <div class="col col-6">
                <h3><?= $judul_karya; ?></h3>
                <p>Pencipta: <?= $pencipta; ?></p>
                <p>Skor: <?= $skor; ?></p>
                <p>Status: <?= $status; ?></p>
                <p>Deskripsi: <br><?= $deskripsi; ?></p>
            </div>
        </div>
    </div>




</body>

</html>