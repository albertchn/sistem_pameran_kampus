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
    <title>Kurator | Pusat Seni</title>
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
        <h2 class="text-center mb-3">Daftar Kurator</h2>

        <input id="myInput" type="text" placeholder="Search..">
        <br>

        <a href="tambah_kurator.php">
            <button type="button" class="btn btn-dark mt-2">Tambah Kurator</button>
        </a>
        <table class="table table-hover text-center mt-2" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sSQL = "";
                $sSQL = "select * from tb_users where role = 'kurator' order by id_user";
                $result = mysqli_query($conn, $sSQL);
                if (mysqli_num_rows($result) > 0) {
                    $no = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $no++;
                        $id_user = $row['id_user'];
                        $nama = $row['nama'];
                        $email = $row['email'];
                ?>

                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><a href="kurasi_kurator.php?id_user=<?= $id_user; ?>&nama=<?= $nama; ?>" class="text-black"><?php echo $nama; ?></a></td>
                            <td><?php echo $email; ?></td>
                            <td>
                                <a href="edit_kurator.php?email=<?php echo $email; ?>">
                                    <button type="button" class="btn btn-primary px-4">
                                        Edit</button>
                                </a>
                            </td>
                            <td>

                                <a href="delete_kurator.php?email=<?php echo $email; ?>"
                                    onclick="return confirm_delete();">
                                    <button type="button" class="btn btn-danger text-white">
                                        Delete</button>
                                </a>

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