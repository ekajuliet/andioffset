<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
}

include 'function.php';

if ( isset($_POST["daftar"])) {
    if( daftar($_POST) > 0 ) {
        echo "
      <script>
        alert('data berhasil ditambah');
        document.location.href = 'profil.php';
      </script>
      ";
  } else {
    echo "
      <script>
        alert('data gagal ditambah');
        document.location.href = 'profil.php';
      </script>
      ";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
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
                        Daftar Identitas Diri
                    </span>
                    
                </div>
                
                <form action="" method="post" class="login100-form validate-form" autocomplete="off">

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="nama">Nama Lengkap</span>
                        <input class="input100" type="text" name="nama" id="nama">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="nik">NIP</span>
                        <input class="input100" type="text" name="nik" id="nik">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="jenis_kelamin">Jenis kelamin</span>
                        <select class="input100" name="jenis_kelamin" id="jenis_kelamin">
                            <option value="perempuan">Perempuan</option>
                            <option value="laki-laki">Laki-Laki</option>
                        <span class="focus-input100"></span>
                        </select>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="tanggal_lahir">Tanggal Lahir</span>
                        <input class="input100" type="date" name="tanggal_lahir" id="tanggal_lahir">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="usia">Usia</span>
                        <input class="input100" type="text" name="usia" id="usia">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="alamat">Alamat</span>
                        <input class="input100" type="text" name="alamat" id="alamat">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="agama">Agama</span>
                        <select class="input100" name="agama" id="agama">
                          <option value="kristen">Kristen</option>
                          <option value="islam">Islam</option>
                          <option value="katolik">Katolik</option>
                          <option value="hindu">Hindu</option>
                          <option value="buddha">Buddha</option>
                        <span class="focus-input100"></span>
                        </select>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="jabatan">Jabatan</span>
                        <input class="input100" type="text" name="jabatan" id="jabatan">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="no_telp">No.telp</span>
                        <input class="input100" type="text" name="no_telp" id="no_telp">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <br>
                        <input type="submit" name="daftar" class="login100-form-btn" value="Daftar">
                    </div>
                    <br><br><br>
                        <a href="profil.php" type="submit" class="login100-form-btn">Kembali</a>
                    
                   
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