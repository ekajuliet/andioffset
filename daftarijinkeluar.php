<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
}


include 'function.php';
$no = 1;
$ijinkeluar = query("SELECT id_anggota, nama_karyawan, waktu_keluar,status,alasan FROM ijinkeluar 
 WHERE id_anggota = '" . $_SESSION['id_anggota'] . "'
 
 ORDER BY id_ijin_keluar DESC");

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

  <title>Daftar Izin Karyawan</title>

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

        <div class=pengajuan>
          <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
            <div class="text-light d-flex w-100 justify-content-start align-items-center">
              <span class='fas fa-file' style='font-size:20px'></span>
              <span class="menu-collapsed">&nbsp;&nbsp;&nbsp;Pengajuan<i class="fas fa-caret-down ml-5"></i></span>
              <span class="submenu-icon ml-auto"></span>
            </div>
          </a>

          <div id='submenu2' class="collapse sidebar-submenu">
            <a href="ijin.php" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed"><i class='far fa-file-alt ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Tidak masuk</span>
            </a>
            <a href="ijinkeluar.php" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed"><i class='fas fa-file-signature ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Izin Keluar</span>
            </a>
            <a href="ijin.php" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed"><i class='fas fa-folder-plus ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Izin Terlambat</span>
            </a>
            <a href="cuti.php" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed"><i class='far fa-copy ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Cuti</span>
            </a>
            <a href="daftarsakit.php" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed"><i class='far fa-folder-open ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Sakit</span>
            </a>
            <a href="tugas.php" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed"><i class='far fa-folder ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Tugas Dinas</span>
            </a>
          </div>
        </div>

        <div class=Tunjangan>
          <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
            <div class="text-light d-flex w-100 justify-content-start align-items-center">
              <span class='fas fa-file' style='font-size:20px'></span>
              <span class="menu-collapsed">&nbsp;&nbsp;&nbsp;Tunjangan<i class="fas fa-caret-down ml-5"></i></span>
              <span class="submenu-icon ml-auto"></span>
            </div>
          </a>

          <div id='submenu3' class="collapse sidebar-submenu">
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed"><i class='fas fa-tshirt ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Seragam</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed"><i class='fab fa-blackberry ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Beras</span>
            </a>
            <a href="#.php" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed"><i class='fas fa-car-side ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Transport</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed"><i class='fas fa-file-medical ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;BPJS Kesehatan</span>
            </a>
            <a href="bpjs_ketenagakerjaan.php" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed"><i class='far fa-file-alt ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;Ketenagakerjaan</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed"><i class='far fa-folder-open ml-4' style='font-size:15px'></i>&nbsp;&nbsp;&nbsp;BPJS Hari Tua</span>
            </a>
          </div>
        </div>
        <a href="beritapribadi.php" class="text-light nav-link ml-auto list-group-item list-group-item-action bg-dark"><i class='fas fa-paper-plane' style='font-size:20px'></i>&nbsp;&nbsp;&nbsp;Berita</a>
      </div>
    </div>

    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-info border-bottom">
        <button class="btn btn-info" id="menu-toggle">
          <i class="fa fa-align-justify" style="font-size:23px;color:white"></i>
        </button>
        <a class="text-light nav-link navbar-nav ml-auto" href="logout.php">Logout <span class="sr-only">(current)</span></a>
      </nav>
      <br><br>

      <div class="container-fluid">
        <div class="container">
          <h3 style="text-align: center">Daftar Izin Keluar</h3>
          <br><br>

          <form action="" method="POST">

            <?php foreach ($ijinkeluar as $data) : ?>
              <div class="card mb-5">

                <h5 class="card-header"><?php echo $data["nama_karyawan"]; ?> (<?php echo $data["id_anggota"]; ?>)</h5>
                <div class="card-body">
                  <p class="card-title">Waktu sekarang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data["waktu_keluar"]; ?></p>
                  <p class="card-title">Status &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;: <?php echo $data["status"]; ?></p>
                  <p class="card-title">Alasan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data["alasan"]; ?></p>
                  </p>
                  <br>
                </div>
              </div>
            <?php endforeach; ?>
          </form>
          <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
      </div>

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
              <h6>Pengirim : <?php echo $data["nama_karyawan"]; ?> (<?php echo " " . $_SESSION['id_anggota'] . " "; ?>) </h6>
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