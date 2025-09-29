<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa | Pusat Seni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <?php
    include "connection.php";

    $email = $_GET['email'];

    $sSQL = "select * from tb_users where email='$email' limit 1";
    $result = mysqli_query($conn, $sSQL);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id_user = $row['id_user'];
            $nama = $row['nama'];
            $email = $row['email'];
            $old_password = $row['password'];
        }
    }

    ?>

    <h2 class="h1 text-center">Edit Mahasiswa</h2>

    <div class="container">
        <form action="simpan_edit_mahasiswa.php" method="POST">
            <input type="hidden" name="old_password" value="<?= $old_password; ?>">
            <div class="mb-3 mt-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama"
                    placeholder="Enter first name" name="nama"
                    value="<?php echo $nama; ?> " required autocomplete="off">
            </div>
            <div class="mb-3 mt-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email"
                    placeholder="Enter email"
                    value="<?php echo $email; ?>"
                    name="email" readonly>
            </div>
            <div class="mb-3">
                <label for="password">New Password:</label>
                <input type="password" class="form-control" id="password"
                    placeholder="Enter password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

            <a href="kurator.php">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
        </form>
    </div>

</body>

</html>