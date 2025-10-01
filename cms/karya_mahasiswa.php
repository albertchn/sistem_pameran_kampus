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
    <title>Karya Mahasiswa | Pusat Seni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


</head>

<body>
    <?php
    include "connection.php";
    $nama = $_GET['nama'];
    ?>


    <div class="container">
        <h2 class="text-center mt-3">Karya Mahasiswa</h2>
        <h5 align='center'><?= $nama; ?></h5>


        <table class="table table-hover text-center mt-2" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Karya</th>
                    <th>Foto Karya</th>
                    <th>Pencipta</th>
                    <th>Deskripsi</th>
                    <th>Skor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $id_user = $_GET['id_user'];
                $sSQL = "";
                $sSQL = "select * from tb_karya where id_user='$id_user'";
                $result = mysqli_query($conn, $sSQL);
                if (mysqli_num_rows($result) > 0) {
                    $no = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $no++;
                        $judul_karya = $row['judul_karya'];
                        $foto_karya = $row['foto_kaya'];
                        $pencipta = $row['pencipta'];
                        $deskripsi = $row['deskripsi'];
                        $skor = $row['skor'];
                        $status = $row['status'];
                ?>

                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $judul_karya; ?></td>
                            <td><img src="../images/<?= $foto_karya; ?>" width="80px"></td>
                            <td><?= $pencipta; ?></td>
                            <td><?= $deskripsi; ?></td>
                            <td><?= $skor; ?></td>
                            <td><?= $status; ?></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td align="center" colspan="7" class="text-danger">Mahasiswa belum mengajukan karya !</td>
                    </tr>
                <?php } ?>



            </tbody>
        </table>
    </div>



</body>

</html>