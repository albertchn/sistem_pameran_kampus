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

    <?php
    include "connection.php";
    ?>


    <div class="container">
        <h2 class="text-center mb-3">Daftar Pameran</h2>

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



</body>

</html>