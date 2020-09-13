<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
}

include 'function.php';

if (isset($_POST["submit"])) {
    if (ubahpass($_POST) > 0) {
        echo "<script>
				alert('ubah password berhasil');
			</script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styleform.css">

    <title>Ubah Password</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

    <div class="d-flex" id="wrapper">
        <div class="text-light bg-dark border-right" id="sidebar-wrapper">
            <div class="list-group list-group-flush">
                <div class="text-center sidebar-heading">
                    <a class="text-light nav-link ml-auto list-group-item list-group-item-action bg-dark"><i class='fas fa-user-circle' style='font-size:55px'></i>&nbsp;&nbsp;&nbsp;<br>
                        <?php echo "[ " . $_SESSION['id_anggota'] . " ]"; ?>
                    </a>
                </div>

                <div class="text-center sidebar-heading">
                    <h6>DATA</h6>
                </div>
                <a href="profil.php" class="text-light nav-link ml-auto list-group-item list-group-item-action bg-dark"><i class='fas fa-user' style='font-size:20px'></i>&nbsp;&nbsp;&nbsp;Profile</a>
                <a href="cuti.php" class="text-light nav-link ml-auto list-group-item list-group-item-action bg-dark"><i class='fas fa-file' style='font-size:20px'></i>&nbsp;&nbsp;&nbsp;Pengajuan Cuti</a>
                <a href="ijin.php" class="text-light nav-link ml-auto list-group-item list-group-item-action bg-dark"><i class='fas fa-file' style='font-size:20px'></i>&nbsp;&nbsp;&nbsp;Izin tidak masuk</a>
                <a href="tugas.php" class="text-light nav-link ml-auto list-group-item list-group-item-action bg-dark"><i class='fas fa-file' style='font-size:20px'></i>&nbsp;&nbsp;&nbsp;Izin tugas</a>
                <a href="daftarsakit.php" class="text-light nav-link ml-auto list-group-item list-group-item-action bg-dark"><i class='fas fa-file' style='font-size:20px'></i>&nbsp;&nbsp;&nbsp;Izin sakit</a>
                <a href="bpjs_ketenagakerjaan.php" class="text-light nav-link ml-auto list-group-item list-group-item-action bg-dark"><i class='fas fa-file' style='font-size:20px'></i>&nbsp;&nbsp;&nbsp;BPJS</a>
                <a href="beritapribadi.php" class="text-light nav-link ml-auto list-group-item list-group-item-action bg-dark"><i class='fas fa-paper-plane' style='font-size:20px'></i>&nbsp;&nbsp;&nbsp;Berita</a>
            </div>
        </div>
        <div id="page-content-wrapper">

            <nav class="navbar bg-info">
                <button class="btn btn-info" id="menu-toggle"><i class="fa fa-align-justify" style="font-size:23px;color:white"></i></button>

                <a class="text-light nav-link" href="logout.php">
                    <h6>Logout</h6><span class="sr-only"></span>
                </a>
            </nav>
            <br><br>

            <div class="container-fluid">
                <h4 class="text-center">Ubah Password</h4>
                <hr color="skyblue" height="20px">
                <br><br>

                <div>

                    <?php if (isset($error)) : ?>
                        <p style="color: red; font-style: italic; text-align: center;"><br>password salah</p>
                    <?php endif; ?>

                    <form action="" method="POST" autocomplete="off">

                        <div class="justify-content-center form-group row">
                            <label for="username" class="col-sm-2 col-form-label">ID Anggota</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="id_anggota" id="id_anggota" placeholder="Masukkan NIP" value="<?php echo " " . $_SESSION['id_anggota'] . " "; ?>" readonly style="background-color: white;">
                            </div>
                        </div>
                        <div class="justify-content-center form-group row">
                            <label for="password_lama" class="col-sm-2 col-form-label">Password Lama</label>
                            <div class="col-sm-7">
                                <input type="password_lama" class="form-control" name="password_lama" id="password_lama" placeholder="Masukkan Password lama" required>
                            </div>
                        </div>
                        <div class="justify-content-center form-group row">
                            <label for="password_baru" class="col-sm-2 col-form-label">Password Baru</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Masukkan Password baru" required>
                            </div>
                        </div>
                        <div class="justify-content-center form-group row">
                            <label for="konfirmasi" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="konfirmasi" id="konfirmasi" placeholder="Konfirmasi Password baru" required>
                            </div>
                        </div>

                        <div class="text-center">
                            <input class="btn btn-info" type="submit" name="submit" value="Simpan">
                        </div>

                    </form>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br>

            <footer class="page-footer font-small bg-info pt-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <h5>CV ANDI OFFSET</h5>
                            <br>
                            <a href="https://id.wikipedia.org/wiki/Andi_Offset" target="_blank" style="color: black">ABOUT</a>
                            <br>
                            <a href="http://andipublisher.com/sub-08-cabangcabang-kami.html" target="_blank" style="color: black">ALAMAT</a>
                            <br>
                            <a href="https://www.gudeg.net/direktori/32/penerbit-cv.-andi-offset.html" target="_blank" style="color: black">NO.TELP</a>
                            <br>
                            <a href="http://andipublisher.com/sub-08-cabangcabang-kami.html" target="_blank" style="color: black">CABANG</a>
                            <br>
                            <a href="https://www.google.com/search?sxsrf=ALeKk02Wi2IB1NiAmqwzZRj7CoC72UX3kw:1590082931438&q=cv+andi+offset+jam+buka&ludocid=14433669442413306937&sa=X&ved=2ahUKEwjjqqrCwMXpAhWLc30KHRD5CggQ6BMwF3oECBIQPA&sxsrf=ALeKk02Wi2IB1NiAmqwzZRj7CoC72UX3kw:1590082931438&biw=1707&bih=781" target="_blank" style="color: black">JAM BUKA</a>
                        </div>

                        <div class="col-md-4 mb-5">
                            <h5>Sosial Media</h5>
                            <br>
                            <a href="https://instagram.com/andioffsetcareer?igshid=1p3p73jg3hxpm" target="_blank" style="color: black">
                                <i class='fab fa-instagram' style='font-size:25px'></i>
                            </a>
                            &nbsp;&nbsp;
                            <a href="https://www.facebook.com/andipublishercom" target="_blank" style="color: black">
                                <i class='fab fa-facebook' style='font-size:25px'></i>
                            </a>
                            &nbsp;&nbsp;
                            <a href="https://mobile.twitter.com/specialchosenme" target="_blank" style="color: black">
                                <i class='fab fa-twitter' style='font-size:25px'></i>
                            </a>
                        </div>

                        <div class="col-md-4 mb-4">
                            <h6>Pengirim : <?php echo $data["nama_anggota"]; ?>
                                (<?php echo " " . $_SESSION['id_anggota'] . " "; ?>) </h6>
                            <form class="input-group">
                                <textarea cols="40" rows="5" placeholder="Saran/Komentar" aria-label="Your email" aria-describedby="basic-addon2"></textarea>
                            </form>
                            <br>
                            <div class="input-group-append">
                                <button class="btn btn-dark btn-sm" type="button">Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <script>
                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                });
            </script>

</body>

</html>