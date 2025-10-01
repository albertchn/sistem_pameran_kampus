<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Karya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1 class="h1 text-center">Edit Daftar Karya</h1>
    <?php
    include "cms/connection.php";
    session_start();
    $id_karya = $_GET['id_karya'];

    $sSQL = "select * from tb_karya where id_karya='$id_karya' limit 1";
    $result = mysqli_query($conn, $sSQL);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $judul_karya = $row['judul_karya'];
            $pencipta = $row['pencipta'];
            $deskripsi = $row['deskripsi'];
            $foto_lama = $row['foto_kaya'];
        }
    }
    ?>
    <div class="container">
        <form action="simpan_edit_karya.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?= $id_karya; ?>" name="id_karya">
            <input type="hidden" value="<?= $foto_lama; ?>" name="foto_lama">
            <div class="mb-3 mt-3">
                <label for="judul_karya">Judul Karya</label>
                <input type="text" class="form-control" id="judul_karya"
                    placeholder="Masukkan judul karya..." name="judul_karya" required autocomplete="off" value="<?= $judul_karya; ?>">
            </div>
            <div class="mb-3">
                <label for="pencipta">Pencipta</label>
                <input type="text" class="form-control" id="pencipta"
                    placeholder="Masukan nama pencipta..." name="pencipta" required autocomplete="off" value="<?= $pencipta; ?>">
            </div>
            <div class="mb-3">
                <label for="deskripsi">Deskripsi</label>
                <input type="text" class="form-control" placeholder="Masukkan deskripsi karya..." required name="deskripsi" autocomplete="off" value="<?= $deskripsi; ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="fileToUpload" class="form-label">Foto Karya</label>
                <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
            </div>

            <button type="submit" class="btn btn-success" name="draft">Simpan</button>
            <button type="submit" class="btn btn-primary" name="submit" onclick="return confirm('Submit karya anda? \nSetelah disubmit TIDAK DAPAT diubah kembali!')">Submit</button>

            <a href="pengajuan_karya.php">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
        </form>
    </div>

</body>

</html>