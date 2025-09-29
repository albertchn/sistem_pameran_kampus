<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pameran | Pusat Seni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1 class="h1 text-center mt-4">Registrasi Pameran</h1>

    <div class="container mt-4">
        <form action="simpan_jadwal_pameran.php" method="POST">
            <div class="mb-3 mt-3">
                <label for="id_karya">Judul Karya</label>
                <select name="id_karya" id="id_karya" class="form-select" required>
                    <option value="">Pilih Karya</option>
                    <?php
                    include 'connection.php';
                    $sSQL = "";
                    $sSQL = "select id_karya,judul_karya from tb_karya where status='accepted'";
                    $result = mysqli_query($conn, $sSQL);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id_karya = $row['id_karya'];
                            $judul_karya = $row['judul_karya'];
                    ?>
                            <option value="<?= $id_karya; ?>"><?= ucwords($judul_karya); ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal"
                    placeholder="" name="tanggal" required>
            </div>
            <div class="mb-3">
                <label for="lokasi">Lokasi:</label>
                <input type="text" class="form-control" id="lokasi"
                    placeholder="" name="lokasi" required>
            </div>
            <div class="mb-3">
                <label for="ruang_display">Ruang Display:</label>
                <input type="text" class="form-control" id="ruang_display"
                    placeholder="" name="ruang_display" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

            <a href="pameran.php">
                <button type="button" class="btn btn-danger ms-2">Cancel</button>
            </a>
        </form>
    </div>

</body>

</html>