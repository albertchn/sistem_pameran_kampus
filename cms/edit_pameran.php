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
    <title>Edit Pameran | Pusat Seni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1 class="h1 text-center mt-4">Edit Pameran</h1>

    <div class="container mt-4">
        <?php
        include 'connection.php';
        $id_pameran = $_GET['id_pameran'];
        $sSQL = "";
        $sSQL = "select p.tanggal,p.lokasi,p.ruang_display,ky.judul_karya from tb_pameran p left join tb_karya ky on p.id_karya=ky.id_karya where p.id_pameran='$id_pameran'";
        $result = mysqli_query($conn, $sSQL);
        while ($row = mysqli_fetch_assoc($result)) {
            $judul_karya = $row['judul_karya'];
            $tanggal = $row['tanggal'];
            $lokasi = $row['lokasi'];
            $ruang_display = $row['ruang_display'];
        }
        ?>
        <form action="simpan_edit_pameran.php" method="POST">
            <input type="hidden" name="id_pameran" value="<?= $id_pameran; ?>">
            <div class="mb-3 mt-3">
                <label for="judul_karya">Judul Karya</label>
                <input type="text" class="form-control" id='judul_karya' name="judul_karya" readonly value="<?= $judul_karya; ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required value="<?= $tanggal; ?>">
            </div>
            <div class="mb-3">
                <label for="lokasi">Lokasi:</label>
                <input type="text" class="form-control" id="lokasi"
                    placeholder="" name="lokasi" required value="<?= $lokasi; ?>" autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="ruang_display">Ruang Display:</label>
                <input type="text" class="form-control" id="ruang_display"
                    placeholder="" name="ruang_display" required value="<?= $ruang_display; ?>" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

            <a href="pameran.php">
                <button type="button" class="btn btn-danger ms-2">Cancel</button>
            </a>
        </form>
    </div>

</body>

</html>