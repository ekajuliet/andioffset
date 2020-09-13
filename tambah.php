<?php

session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
}

include 'function.php';

$id = $_GET["id"];

$ubahidentitas = query("SELECT * FROM user WHERE id_anggota = '$id'");

if (isset($_POST["daftar"])) {
    if (ubah($_POST) > 0) {
        echo "
      <script>
        alert('data berhasil diubah');
        document.location.href = 'profil.php';
      </script>
      ";
    } else {
        echo "
      <script>
        alert('data gagal diubah');
        document.location.href = 'profil.php';
      </script>
      ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ubah Profile</title>
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
                        Ubah Identitas Diri
                    </span>

                </div>

                <form action="" method="post" class="login100-form validate-form" autocomplete="off">

                    <input type="hidden" name="id" value="<?= $ubahidentitas["id_anggota"]; ?>">

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="id_anggota">ID Anggota</span>
                        <input class="input100" name="id_anggota" id="id_anggota" value="<?= $ubahidentitas[0]["id_anggota"]; ?>" readonly></input>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="nama_anggota">Nama Anggota</span>
                        <input class="input100" type="text" name="nama_anggota" id="nama_anggota" value="<?= $ubahidentitas[0]["nama_anggota"]; ?>" readonly></input>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="tempat_lahir">Tempat Lahir</span>
                        <input class="input100" type="text" name="tempat_lahir" id="tempat_lahir" value="<?= $ubahidentitas[0]["tempat_lahir"]; ?>" readonly></input>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="tanggal_lahir">Tanggal Lahir</span>
                        <input class="input100" type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?= $ubahidentitas[0]["tanggal_lahir"]; ?>" readonly></input>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="nik">NIK</span>
                        <input class="input100" type="text" name="nik" id="nik" value="<?= $ubahidentitas[0]["nik"]; ?>" readonly></input>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="alamat_ktp">Alamat KTP</span>
                        <input class="input100" type="text" name="alamat_ktp" id="alamat_ktp" value="<?= $ubahidentitas[0]["alamat_ktp"]; ?>" readonly></input>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="alamat_Sekarang">Alamat Sekarang</span>
                        <input class="input100" type="text" name="alamat_Sekarang" id="alamat_Sekarang" value="<?= $ubahidentitas[0]["alamat_Sekarang"]; ?>">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="email">Alamat Email</span>
                        <input class="input100" type="text" name="email" id="email" value="<?= $ubahidentitas[0]["email"]; ?>">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="npwp">NPWP</span>
                        <input class="input100" type="text" name="npwp" id="npwp" value="<?= $ubahidentitas[0]["npwp"]; ?>" readonly></input>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="no_wa">No.WA</span>
                        <input class="input100" type="text" name="no_wa" id="no_wa" value="<?= $ubahidentitas[0]["no_wa"]; ?>">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="no_telp">No.Telp</span>
                        <input class="input100" type="text" name="no_telp" id="no_telp" value="<?= $ubahidentitas[0]["no_telp"]; ?>">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="golongan_darah">Gol_Darah</span>
                        <input class="input100" type="text" name="golongan_darah" id="golongan_darah" value="<?= $ubahidentitas[0]["golongan_darah"]; ?>" readonly></input>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="pend_terakhir">Pendidikan Terakhir</span>
                        <input class="input100" type="text" name="pend_terakhir" id="pend_terakhir" value="<?= $ubahidentitas[0]["pend_terakhir"]; ?>" readonly></input>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="tgl_masuk_kerja">Tanggal Masuk Kerja</span>
                        <input class="input100" type="text" name="tgl_masuk_kerja" id="tgl_masuk_kerja" value="<?= $ubahidentitas[0]["tgl_masuk_kerja"]; ?>" readonly></input>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="status_pernikahan">Status Pernikahan</span>
                        <input class="input100" type="text" name="status_pernikahan" id="status_pernikahan" value="<?= $ubahidentitas[0]["status_pernikahan"]; ?>" readonly></input>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100" for="status_pernikahan">Status Kepegawaian</span>
                        <input class="input100" type="text" name="status_kepegawaian" id="status_kepegawaian" value="<?= $ubahidentitas[0]["status_kepegawaian"]; ?>" readonly></input>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <br>
                        <input type="submit" name="daftar" class="login100-form-btn" value="Ubah">
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