<?php
session_start();
if (!$_SESSION['isLoggedin'] == 1)
    header("Location: cms/login.php");
if (!isset($_SESSION['mahasiswa'])) {
    if (isset($_SESSION['kurator'])) {
        header("Location: kurasi.php");
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
    <title>Pengajuan Karya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1 class="h1 text-center">Daftar Karya</h1>
    <div class="container">
        <form action="simpan_daftar_karya.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?= $_SESSION['id_user']; ?>" name="id_user">
            <div class="mb-3 mt-3">
                <label for="judul_karya">Judul Karya</label>
                <input type="text" class="form-control" id="judul_karya"
                    placeholder="Masukkan judul karya..." name="judul_karya" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="pencipta">Pencipta</label>
                <input type="text" class="form-control" id="pencipta"
                    placeholder="Masukan nama pencipta..." name="pencipta" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" placeholder="Masukkan deskripsi karya..." id="floatingTextarea" required name="deskripsi" autocomplete="off"></textarea>
            </div>
            <div class="mb-3 mt-3">
                <label for="fileToUpload" class="form-label">Foto Karya</label>
                <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" required>
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