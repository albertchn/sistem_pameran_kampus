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

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <?php
    include "connection.php";
    session_start();
    if (isset($_POST['btnsubmit'])) {
        $email_account = $_POST['email_account'];
        $user_password = md5($_POST['user_password']);

        $sSQL = "";
        $sSQL = " select * from tb_users where email='$email_account'";
        $sSQL .= " and password= '$user_password' limit 1";

        //die($sSQL);
        $result = mysqli_query($conn, $sSQL);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["email"] = $email_account;
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['isLoggedin'] = 1;
            $_SESSION['LoginGagal'] = 0;

            header("location:dashboard.php");
        } else {
            $_SESSION['isLoggedin'] = 0;
            $_SESSION['LoginGagal'] = 1;
            header("location:login.php");
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
                                        <h1 class="h4 text-gray-900 mb-4">Login Dulu Ya!</h1>
                                    </div>
                                    <form class="user" method="POST" action="login.php">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email_account" name="email_account" aria-describedby="email_accounts" placeholder="Masukin email yuk..." required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="user_password" name="user_password"
                                                placeholder="Password kamu..." required>
                                        </div>

                                        <button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-success">Login</button>
                                        <?php
                                        if (isset($_SESSION['LoginGagal'])) {
                                        ?>
                                            <p class="text-danger pt-2">Email atau Password salah!</p>
                                        <?php
                                        }
                                        ?>
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