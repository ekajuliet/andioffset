<?php
session_start();
include 'function.php';

if (isset($_POST["tambah_seragam"])) {
    $id_tunjangan   = createID('id_seragam', 'tunjangan_seragam', 'TS');
    $id_anggota     = $_POST["id_anggota"];
    $nama_anggota   = $_POST["nama_anggota"];
    $status_dapat   = $_POST["status_dapat"];
    $status_terima  = $_POST["status_terima"];
    $kemeja         = $_POST["kemeja"];
    $celana         = $_POST["celana"];
    $keterangan     = $_POST["keterangan"];

    $sql = "INSERT INTO tunjangan_seragam(id_seragam,id_anggota,nama_anggota,status_dapat,kemeja, celana,status_terima, keterangan) VALUES (
                '$id_tunjangan',
                '$id_anggota',
                '$nama_anggota',
                '$status_dapat',
                '$kemeja',
                '$celana',
                '$status_terima',
                '$keterangan')";
    $result = mysqli_query($conn, $sql);

    $result = "<script>alert(Tunjangan Telah Diinputkan)</script>";
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

    <title>Tunjangan seragam</title>

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

                <a href="profile_admin.php" class="text-light nav-link ml-auto list-group-item list-group-item-action bg-dark"><i class='fas fa-tachometer-alt' style='font-size:20px'></i>&nbsp;&nbsp;&nbsp;Dashboard</a>

                <div class=tambah>
                    <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                        <div class="text-light d-flex w-100 justify-content-start align-items-center">
                            <span class='fas fa-user-plus' style='font-size:20px'></span>
                            <span class="menu-collapsed">&nbsp;&nbsp;&nbsp;Tambah<i class="fas fa-caret-down ml-5"></i></span>
                            <span class="submenu-icon ml-auto"></span>
                        </div>
                    </a>

                    <div id='submenu2' class="collapse sidebar-submenu">
                        <a href="tambahadmin.php" class="list-group-item list-group-item-action bg-dark text-white">
                            <span class="menu-collapsed"><i class='far fa-address-card ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Tambah Anggota</span>
                        </a>

                        <div class=bpjs>
                            <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                                <div class="text-light d-flex w-100 justify-content-start align-items-center">
                                    <span class='far fa-address-book ml-4' style='font-size:15px'></span>
                                    <span class="menu-collapsed">&nbsp;&nbsp;&nbsp;Tambah BPJS<i class="fas fa-caret-down ml-5"></i></span>
                                    <span class="submenu-icon ml-auto"></span>
                                </div>
                            </a>

                            <div id='submenu3' class="collapse sidebar-submenu">
                                <a href="bpjs_kesehatan.php" class="list-group-item list-group-item-action bg-dark text-white">
                                    <span class="menu-collapsed"><i class='far fa-copy ml-5' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Kesehatan</span>
                                </a>

                                <a href="tambahBPJS.php" class="list-group-item list-group-item-action bg-dark text-white">
                                    <span class="menu-collapsed"><i class='far fa-copy ml-5' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Ketenagakerjaan</span>
                                </a>

                                <a href="bpjs_pensiun.php" class="list-group-item list-group-item-action bg-dark text-white">
                                    <span class="menu-collapsed"><i class='far fa-copy ml-5' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Hari Tua</span>
                                </a>
                            </div>
                        </div>

                        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                            <span class="menu-collapsed"><i class='fas fa-tshirt ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Tambah Seragam</span>
                        </a>

                        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                            <span class="menu-collapsed"><i class='fab fa-blackberry ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Tambah Beras</span>
                        </a>

                        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                            <span class="menu-collapsed"><i class='fas fa-car-side ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Tambah Transport</span>
                        </a>
                    </div>
                </div>

                <a href="identitas_admin.php" class="text-light nav-link ml-auto list-group-item list-group-item-action bg-dark"><i class='far fa-folder-open' style='font-size:18px'></i>&nbsp;&nbsp;&nbsp;Identitas Anggota</a>
                <a href="beritaadmin.php" class="text-light nav-link ml-auto list-group-item list-group-item-action bg-dark"><i class='fas fa-paper-plane' style='font-size:20px'></i>&nbsp;&nbsp;&nbsp;Berita</a>
                <a href="" class="text-light nav-link ml-auto list-group-item list-group-item-action bg-dark"><i class='far fa-comments' style='font-size:20px'></i>&nbsp;&nbsp;&nbsp;Kritik/Saran</a>

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
                <h4 class="text-center">Tambah Tunjangan Seragam</h4>
                <hr color="skyblue" height="20px">
                <br><br>

                <form action="" method="post">

                    <input type="text" name="tambah_seragam" hidden>

                    <div class="justify-content-center input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping" style="width: 160px;">Id Anggota</span>
                        </div>
                        <input type="text" class="col-7 form-control" aria-label="id_anggota" aria-describedby="addon-wrapping" name="id_anggota" style="background-color: white;" required></input>
                    </div>
                    <br>

                    <div class="justify-content-center input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping" style="width: 160px;">Nama Anggota</span>
                        </div>
                        <input type="text" class="col-7 form-control" aria-label="nama_anggota" aria-describedby="addon-wrapping" name="nama_anggota" style="background-color: white;" required></input>
                    </div>
                    <br>

                    <div class="justify-content-center input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping" style="width: 160px;">Status Dapat</span>
                        </div>
                        <select name="status_dapat" class="col-7 form-control" id="status_dapat">
                            <option value="">Pilih Status</option>
                            <option value="1">Dapat</option>
                            <option value="2">Tidak Dapat</option>
                        </select>
                    </div>
                    <br>

                    <div class="element-terkirim" style="display: none;">
                        <div class="justify-content-center input-group flex-nowrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping" style="width: 160px;">Kemeja</span>
                            </div>
                            <select name="kemeja" class="col-7 form-control" id="kemeja">
                                <option value="">Pilih Status</option>
                                <option value="1">Dapat</option>
                                <option value="2">Tidak Dapat</option>
                            </select>
                        </div>
                        <br>

                        <div class="justify-content-center input-group flex-nowrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping" style="width: 160px;">Celana</span>
                            </div>
                            <select name="celana" class="col-7 form-control" id="celana">
                                <option value="">Pilih Status</option>
                                <option value="1">Dapat</option>
                                <option value="2">Tidak Dapat</option>
                            </select>
                        </div>
                        <br>

                        <div class="justify-content-center input-group flex-nowrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping" style="width: 160px;">Status Terima</span>
                            </div>
                            <select name="status_terima" class="col-7 form-control">
                                <option value="">Pilih Status</option>
                                <option value="1">Diterima</option>
                                <option value="2">Belum Diterima</option>
                            </select>
                        </div>
                        <br>
                    </div>

                    <div class="justify-content-center input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping" style="width: 160px;">Keterangan</span>
                        </div>
                        <textarea type="text" class="col-7 form-control" aria-label="Username" aria-describedby="addon-wrapping" name="keterangan" required></textarea>
                    </div>
                    <br>

                    <div class="style1 text-center">
                        <input type="submit" class="btn btn-info" value="kirim">
                    </div>

                </form>

            </div>
            <br><br><br><br><br><br><br><br><br><br>
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
                            <h6>Pengirim : <?php echo " " . $_SESSION['id_anggota'] . " "; ?> </h6>
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

<script>
    $("#status_dapat").change(function() {
        var value = $(this).val();
        if (value == 2) {
            $('.element-terkirim').css("display", "none");
        }
        if (value == 1) {
            $('.element-terkirim').css("display", "inline");
        }

    });
</script>