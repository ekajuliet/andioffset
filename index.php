<?php

session_start();

include 'function.php';
if (isset($_POST["login"])) {
    $username = $_POST['id_anggota'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE id_anggota = '$username'");

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION['login'] = true;
            $_SESSION["id_anggota"] = $row['id'];
            $_SESSION['id_anggota'] = $row['id_anggota'];
            header("Location: profil.php");
            if ($row['status'] == "admin") {
                header("location:profile_admin.php");
            } else if ($row['status'] == "direktur") {
                header("location:profile_drk.php");
            }
        }
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>index</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
                    <span class="login100-form-title-1">
                        LOGIN <br> ANDI OFFSET
                    </span>
                </div>
                <?php if (isset($error)) : ?>
                    <p style="color: red; font-style: italic; text-align: center;"><br>Username / password salah</p>
                <?php endif; ?>
                <form action="index.php" method="post" class="login100-form validate-form" autocomplete="off">

                    <p style="color: green; text-align: center" ;>Login dengan mengisi username <br> menggunakan ID Anggota yang telah didaftarkan</p>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <br>
                        <span class="label-input100"><br>Username</span>
                        <input class="input100" type="text" name="id_anggota" id="id_anggota" placeholder="Masukkan username">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Masukkan password" id="password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="login">
                            Masuk
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <script src="js/main.js"></script>

</body>

</html>