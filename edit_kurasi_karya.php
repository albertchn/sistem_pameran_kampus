<?php
session_start();
if (!$_SESSION['isLoggedin'] == 1)
    header("Location: cms/login.php");
if (!isset($_SESSION['kurator'])) {
    if (isset($_SESSION['mahasiswa'])) {
        header("Location: index.php");
    } elseif (isset($_SESSION['admin'])) {
        header("Location: cms/dashboard.php");
    } else {
        header("Location: cms/logout.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kurasi Karya | Pusat Seni</title>
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
                            <a class="nav-link active" href="pengajuan_karya.php">Daftar Kurasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="riwayat_kurasi.php">Riwayat Kurasi</a>
                        </li>
                    </ul>
                </div>
                <div class="ms-auto">
                    <a href="cms/logout.php" class="btn btn-danger" onclick="return confirm('Logout sekarang?')">Logout</a>
                </div>
            </div>
        </nav>
    </div>

    <?php
    include "cms/connection.php";
    ?>


    <div class="container">
        <h2 class="text-center my-3">Edit Kurasi Karya</h2>

        <?php
        $id_karya = $_GET['id_karya'];
        $sSQL = "";
        $sSQL = "select * from tb_karya where id_karya='$id_karya' limit 1";
        $result = mysqli_query($conn, $sSQL);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $judul_karya = $row['judul_karya'];
                $foto_karya = $row['foto_kaya'];
                $deskripsi = $row['deskripsi'];
                $pencipta = $row['pencipta'];
            }
        }
        $id_user = $_SESSION['id_user'];
        $sql = mysqli_query($conn, "select * from tb_kurasi where id_karya=$id_karya and id_user=$id_user")->fetch_assoc();
        ?>
        <div class="row">
            <div class="col col-6">
                <img src="images/<?= $foto_karya; ?>" width="100%">
                <h4><?= $judul_karya; ?></h4>
                <h6>Pencipta: <?= $pencipta; ?></h6>
                <p>Deskrispi:<br><?= $deskripsi; ?></p>
            </div>
            <div class="col col-6">
                <form action="simpan_edit_kurasi_karya.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $id_user; ?>" name="id_user">
                    <input type="hidden" name="id_karya" value="<?= $id_karya; ?>">
                    <div class="mb-3 mt-3">
                        <label for="skor">Skor</label>
                        <input type="number" class="form-control" id="skor"
                            placeholder="Masukkan judul karya..." name="skor" required autocomplete="off" value="<?= $sql['skor']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="catatan">Catatan</label>
                        <input type="text" class="form-control" id="catatan"
                            placeholder="Masukan catatan..." name="catatan" required autocomplete="off" value="<?= $sql['catatan']; ?>">
                    </div>

                    <div class="mt-5">
                        <button type="submit" class="btn btn-success" name="draft">Simpan</button>
                        <button type="submit" class="btn btn-primary" name="submit" onclick="return confirm('Submit hasil kurasi anda? \nSetelah disubmit TIDAK DAPAT diubah kembali!')">Submit</button>

                        <a href="kurasi.php">
                            <button type="button" class="btn btn-danger">Cancel</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>



        </tbody>
        </table>
    </div>



</body>

</html>