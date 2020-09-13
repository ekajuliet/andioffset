<?php


session_start();

if (!isset($_SESSION["login"])) {
    header("Location: index.php");
}

include 'koneksi.php';
$no = 1;

$anggota = query("SELECT * FROM user ORDER BY id_riwayat_anggota DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="styleform.css">


    <title>Identitas Karyawan</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <a href="tambahBPJS.php" class="list-group-item list-group-item-action bg-dark text-white">
                            <span class="menu-collapsed"><i class='far fa-address-book ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Tambah BPJS</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                            <span class="menu-collapsed"><i class='fas fa-tshirt ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Tambah Seragam</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                            <span class="menu-collapsed"><i class='fab fa-blackberry ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Tambah Beras</span>
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

                <h4 class="text-center">Informasi Identitas Karyawan</h4>
                <hr color="skyblue" height="20px">
                <br><br><br>

                <form action="" method="POST">

                    <div class="container">

                        <table id="example" class="display table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>No.urut</th>
                                    <th style="width:70px">Action</th>
                                    <th>Nama Anggota</th>
                                    <th>ID Anggota</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>NIK</th>
                                    <th>Alamat KTP</th>
                                    <th>Alamat Sekarang</th>
                                    <th>Email</th>
                                    <th>NPWP</th>
                                    <th>No.WA</th>
                                    <th>No.Telp</th>
                                    <th>Gol.Darah</th>
                                    <th>Pendidikan Terakhir</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Status Pernikahan</th>
                                    <th>Status Kepegawaian</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($anggota as $data) : ?>
                                    <tr>
                                        <td><?php echo $no;
                                            $no++; ?></td>
                                        <td>
                                            <a href="hapuskaryawan.php?id=<?= $data["id_riwayat_anggota"]; ?>" onclick="return confirm('apakah anda yakin ingin menghapus?');" type="submit" name="back">
                                                <i class="btn btn-danger btn-sm"><i class='far fa-trash-alt' style="font-size: 18px; color:white"></i></i>
                                            </a>


                                            <a href="ubahidentitas_admin.php?id=<?= $data["id_riwayat_anggota"]; ?>" type="submit" class="btn btn-info btn-sm" name="back">
                                                <i class='far fa-edit' style="font-size: 18px; color:white"></i>
                                            </a>
                                        </td>

                                        <td><?php echo $data["nama_anggota"]; ?></td>
                                        <td><?php echo $data["id_anggota"]; ?></td>
                                        <td><?php echo $data["tempat_lahir"]; ?></td>
                                        <td><?php echo $data["tanggal_lahir"]; ?></td>
                                        <td><?php echo $data["nik"]; ?></td>
                                        <td><?php echo $data["alamat_ktp"]; ?></td>
                                        <td><?php echo $data["alamat_Sekarang"]; ?></td>
                                        <td><?php echo $data["email"]; ?></td>
                                        <td><?php echo $data["npwp"]; ?></td>
                                        <td><?php echo $data["no_wa"]; ?></td>
                                        <td><?php echo $data["no_telp"]; ?></td>
                                        <td><?php echo $data["golongan_darah"]; ?></td>
                                        <td><?php echo $data["pend_terakhir"]; ?></td>
                                        <td><?php echo $data["tgl_masuk_kerja"]; ?></td>
                                        <td><?php echo $data["status_pernikahan"]; ?></td>
                                        <td><?php echo $data["status_kepegawaian"]; ?></td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                </form>
            </div>
        </div>

        <br><br><br><br><br><br><br><br>
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
                        <h6>Pengirim : <?php echo $data["nama_anggota"]; ?> (<?php echo " " . $_SESSION['id_anggota'] . " "; ?>) </h6>
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

        <script>
            $(document).ready(function() {
                $('#example').DataTable({
                    "scrollX": true
                });
            });

            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
            });
        </script>

</body>

</html>