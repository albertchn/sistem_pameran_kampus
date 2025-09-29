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
                    <th>Deskripsi</th>
                    <th>Pencita</th>
                    <th>Skor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sSQL = "";
                $sSQL = "select * from tb_karya order by id_karya desc";
                $result = mysqli_query($conn, $sSQL);
                if (mysqli_num_rows($result) > 0) {
                    $no = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $no++;
                        $judul_karya = $row['judul_karya'];
                        $foto_karya = $row['foto_kaya'];
                        $deskripsi = $row['deskripsi'];
                        $pencipta = $row['pencipta'];
                        $skor = $row['skor'];
                        $status = $row['status'];
                ?>

                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?= $judul_karya; ?></td>
                            <td><img src="../images/<?= $foto_karya; ?>" width="60px"></td>
                            <td>
                                <p style="mex-width:100px"><?= $deskripsi; ?></p>
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