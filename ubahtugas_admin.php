<?php

session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
}

include 'koneksi.php';

$id = $_GET["id"];

$ubahtugas = query("SELECT tugas.id_tugas as idtugas, id_anggota, keterangan, nama_karyawan, tanggal_mulai, tanggal_selesai, provinsi.nama as provinsi, 
kabupaten.nama as kabupaten, kecamatan.nama as kecamatan FROM tugas
INNER JOIN provinsi ON tugas.id_prov = provinsi.id_prov
INNER JOIN kabupaten ON tugas.id_kab = kabupaten.id_kab
INNER JOIN kecamatan ON tugas.id_kec = kecamatan.id_kec

WHERE id_tugas = '$id'");

if (isset($_POST["daftar"])) {
    if (ubahtugas($_POST) > 0) {
        echo "
      <script>
        alert('data berhasil diubah');
        document.location.href = 'izintugas_admin.php';
      </script>
      ";
    } else {
        echo "
      <script>
        alert('data gagal diubah');
        document.location.href = 'izintugas_admin.php';
      </script>
      ";
    }
}
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

    <title>Informasi Izin Tugas Karyawan</title>

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
                <a href="" class="text-light nav-link ml-auto list-group-item list-group-item-action bg-dark"><i class='fas fa-user' style='font-size:20px'></i>&nbsp;&nbsp;&nbsp;Profile</a>
                <a href="identitas_admin.php" class="text-light nav-link ml-auto list-group-item list-group-item-action bg-dark"><i class='far fa-folder-open' style='font-size:18px'></i>&nbsp;&nbsp;&nbsp;Identitas Karyawan</a>
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

                <h4 class="text-center">Ubah Izin Tugas Karyawan</h4>
                <hr color="skyblue" height="20px">
                <br><br>

                <br>
                <form action="" method="post" autocomplete="off">

                    <input type="hidden" name="id" value="<?= $ubahtugas["id_anggota"]; ?>">

                    <div class="justify-content-center input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping" for="id_anggota" style="width: 160px;">ID Anggota</span>
                        </div>
                        <input type="text" class="col-7 form-control" aria-label="id_anggota" aria-describedby="addon-wrapping" name="id_anggota" id="id_anggota" value="<?= $ubahtugas[0]["id_anggota"]; ?>" required>
                    </div>
                    <br>

                    <div class="justify-content-center input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping" for="nama_karyawan" style="width: 160px;">Nama Lengkap</span>
                        </div>
                        <input type="text" class="col-7 form-control" aria-label="nama_karyawan" aria-describedby="addon-wrapping" name="nama_karyawan" id="nama_karyawan" value="<?= $ubahtugas[0]["nama_karyawan"]; ?>" required>
                    </div>
                    <br>

                    <div class="justify-content-center input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping" for="tanggal_mulai" style="width: 160px;">Tanggal mulai</span>
                        </div>
                        <input type="date" class="col-7 form-control" aria-label="tanggal_mulai" aria-describedby="addon-wrapping" name="tanggal_mulai" id="tanggal_mulai" value="<?= $ubahtugas[0]["tanggal_mulai"]; ?>" required>
                    </div>
                    <br>

                    <div class="justify-content-center input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping" for="tanggal_selesai" style="width: 160px;">Tanggal selesai</span>
                        </div>
                        <input type="date" class="col-7 form-control" aria-label="tanggal_selesai" aria-describedby="addon-wrapping" name="tanggal_selesai" id="tanggal_selesai" value="<?= $ubahtugas[0]["tanggal_selesai"]; ?>" required>
                    </div>
                    <br>

                    <div class="justify-content-center input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping" for="provinsi" style="width: 160px;">Pilih Provinsi</span>
                        </div>
                        <select class="col-7 form-control" aria-label="provinsi" aria-describedby="addon-wrapping" name="provinsi" id="provinsi" value="<?= $ubahtugas[0]["provinsi"]; ?>" required>
                        </select>
                    </div>

                    <br>
                    <div class="justify-content-center input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping" for="kabupaten" style="width: 160px;">Pilih Kabupaten</span>
                        </div>
                        <select class="col-7 form-control" aria-label="kabupaten" aria-describedby="addon-wrapping" name="kabupaten" id="kabupaten" value="<?= $ubahtugas[0]["kabupaten"]; ?>" required>
                        </select>
                    </div>
                    <br>

                    <div class="justify-content-center input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping" for="kecamatan" style="width: 160px;">Pilih Kecamatan</span>
                        </div>
                        <select class="col-7 form-control" aria-label="kecamatan" aria-describedby="addon-wrapping" name="kecamatan" id="kecamatan" value="<?= $ubahtugas[0]["kecamatan"]; ?>" required>
                        </select>
                    </div>
                    <br>

                    <div class="justify-content-center input-group flex-nowrap">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="addon-wrapping" for="keterangan" style="width: 160px;">Keterangan</span>
                        </div>
                        <textarea type="text" class="col-7 form-control" aria-label="keterangan" aria-describedby="addon-wrapping" name="keterangan" id="keterangan" required><?= $ubahtugas[0]["keterangan"]; ?></textarea>
                    </div>
                    <br>
                    <br>

                    <div class="text-center">
                        <input type="submit" class="btn btn-info" name="daftar" value="ubah">
                        <a href="izintugas_admin.php" type="submit" class="btn btn-success" name="back">Kembali</a>
                    </div>
                </form>
            </div>

            <br><br><br><br><br><br><br><br><br>
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
                            <h6>Pengirim : <?php echo " " . $_SESSION['id_anggota'] . " "; ?></h6>
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


                    $("#menu-toggle").click(function(e) {
                        e.preventDefault();
                        $("#wrapper").toggleClass("toggled");
                    });


                    $(document).ready(function() {
                        $.ajax({
                            type: 'POST',
                            url: "get_provinsi.php",
                            cache: false,
                            success: function(msg) {
                                console.log(msg);
                                $("#provinsi").html(msg);
                            }
                        });

                        $("#provinsi").change(function() {
                            var provinsi = $("#provinsi").val();
                            $.ajax({
                                type: 'POST',
                                url: "get_kabupaten.php",
                                data: {
                                    provinsi: provinsi
                                },
                                cache: false,
                                success: function(msg) {
                                    $("#kabupaten").html(msg);
                                }
                            });
                        });

                        $("#kabupaten").change(function() {
                            var kabupaten = $("#kabupaten").val();
                            $.ajax({
                                type: 'POST',
                                url: "get_kecamatan.php",
                                data: {
                                    kabupaten: kabupaten
                                },
                                cache: false,
                                success: function(msg) {
                                    $("#kecamatan").html(msg);
                                }
                            });
                        });

                        $("#kecamatan").change(function() {
                            var kecamatan = $("#kecamatan").val();
                            $.ajax({
                                type: 'POST',
                                url: "get_kelurahan.php",
                                data: {
                                    kecamatan: kecamatan
                                },
                                cache: false,
                                success: function(msg) {
                                    $("#kelurahan").html(msg);
                                }
                            });
                        });
                    });
                </script>

</body>

</html>