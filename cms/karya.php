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
    <title>Karya | Pusat Seni</title>
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
        <h2 class="text-center mb-3">Daftar Karya</h2>

        <input id="myInput" type="text" placeholder="Search..">
        <br>

        <table class="table table-hover text-center mt-2" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Karya</th>
                    <th>Foto Karya</th>
                    <th>Tenggat Kurasi</th>
                    <th>Pencipta</th>
                    <th>Skor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sSQL = "";
                $sSQL = "select * from tb_karya where status in ('submitted','accepted','withdrawn','rejected') order by id_karya";
                $result = mysqli_query($conn, $sSQL);
                if (mysqli_num_rows($result) > 0) {
                    $no = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $no++;
                        $id_karya = $row['id_karya'];
                        $judul_karya = $row['judul_karya'];
                        $foto_karya = $row['foto_kaya'];
                        $tenggat_kurasi = $row['tenggat_kurasi'];
                        $pencipta = $row['pencipta'];
                        $skor = $row['skor'];
                        $status = $row['status'];

                        $today = date('Y-m-d');
                        if ($status == 'submitted' && $tenggat_kurasi < $today) {
                            $sql = mysqli_query($conn, "select count(id_karya) as jumlah_kurator, sum(skor) as jumlah_skor from tb_kurasi where id_karya='$id_karya'")->fetch_assoc();
                            $skorAkhir = intval($sql['jumlah_skor']) / intval($sql['jumlah_kurator']);
                            if ($skorAkhir >= 0 && $skorAkhir < 70) {
                                $statusAkhir = 'rejected';
                            } elseif ($skorAkhir >= 70 && $skorAkhir <= 100) {
                                $statusAkhir = 'accepted';
                            } else {
                                $statusAkhir = $status;
                            }
                            mysqli_query($conn, "update tb_karya set skor='$skorAkhir', status='$statusAkhir' where id_karya='$id_karya'");
                        }
                ?>

                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><a href="detail_karya.php" class="text-black"><?php echo $judul_karya; ?></td>
                            <td><img src="../images/<?= $foto_karya; ?>" width="60px"></td>
                            <td>
                                <p><?= date('d-m-Y', strtotime($tenggat_kurasi)); ?></p>
                            </td>
                            <td><?= $pencipta; ?></td>
                            <td><?= $skor; ?></td>
                            <td><?= $status; ?></td>
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