<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <?php
    include "connection.php";
    session_start();
    if (isset($_POST['btnsubmit'])) {
        $nama = $_POST['nama'];
        $email_account = $_POST['email_account'];
        $user_password = $_POST['user_password'];
        $conf_password = $_POST['conf_password'];

        if ($user_password != $conf_password) {
            $err = "Passwordnya gak sama!";
        } else {
            $sSQL = "";
            $sSQL = " select * from tb_users where email='$email_account'";
            $result = mysqli_query($conn, $sSQL);
            if (mysqli_num_rows($result) > 0) {
                $err = "Email sudah terdaftar tau!";
            } else {
                $user_password = md5(trim($user_password));
                $role = 'mahasiswa';
                $sql = "insert into tb_Users (nama,email,password,role)
                        values
                        ('$nama','$email_account','$user_password','$role')
                        ";
                mysqli_query($conn, $sql);
                header("Location: login.php");
            }
        }
    }
    ?>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image text-center my-auto"><img src="../images/icon/login.svg" width="80%"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Registrasi Yuk!</h1>
                                    </div>
                                    <form class="user" method="POST" action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="nama" name="nama" aria-describedby="nama" placeholder="Masukin nama kamu..." required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email_account" name="email_account" aria-describedby="email_accounts" placeholder="Masukin email yuk..." required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="user_password" name="user_password"
                                                placeholder="Password yang kuat..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="conf_password" name="conf_password"
                                                placeholder="Sama kaya password diatas ya..." required>
                                        </div>

                                        <button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-success">Submit</button>
                                        <?php
                                        if (isset($err)) {
                                        ?>
                                            <p class="text-danger pt-2"><?= $err; ?></p>
                                        <?php
                                        }
                                        ?>
                                        <p class="small mt-3">Sudah punya akun? <a href="login.php" class="text-decoration-underline text-black">Login yuk.</a></p>
                                        <hr>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>