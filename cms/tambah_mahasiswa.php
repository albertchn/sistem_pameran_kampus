<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa | Pusat Seni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1 class="h1 text-center mt-4">Tambah Mahasiswa</h1>

    <div class="container mt-4">
        <form action="simpan_mahasiswa_baru.php" method="POST">
            <div class="mb-3 mt-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama"
                    placeholder="Masukkan nama lengkap..." name="nama" required autocomplete="off">
            </div>
            <div class="mb-3 mt-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email"
                    placeholder="Masukkan email..." name="email" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password"
                    placeholder="Masukkan password..." name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

            <a href="mahasiswa.php">
                <button type="button" class="btn btn-danger ms-2">Cancel</button>
            </a>
        </form>
    </div>

</body>

</html>