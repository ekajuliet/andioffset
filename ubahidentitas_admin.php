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
        document.location.href = 'identitas_admin.php';
      </script>
      ";
  } else {
    echo "
      <script>
        alert('data gagal diubah');
        document.location.href = 'identitas_admin.php';
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

  <title>Ubah Identitas Karyawan</title>

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

        <h4 class="text-center">Ubah Identitas Karyawan</h4>
        <hr color="skyblue" height="20px">
        <br><br>

        <br>

        <form action="" method="post" autocomplete="off">

          <input type="hidden" name="id" value="<?= $ubahidentitas["id_anggota"]; ?>">

          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="id_anggota" style="width: 160px;">ID Anggota</span>
            </div>
            <input type="text" class="col-7 form-control" aria-label="id_anggota" aria-describedby="addon-wrapping" name="id_anggota" id="id_anggota" value="<?= $ubahidentitas[0]["id_anggota"]; ?>" required>
          </div>
          <br>

          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="nama_anggota" style="width: 160px;">Nama Lengkap</span>
            </div>
            <input type="text" class="col-7 form-control" aria-label="nama_anggota" aria-describedby="addon-wrapping" name="nama_anggota" id="nama_anggota" value="<?= $ubahidentitas[0]["nama_anggota"]; ?>" required>
          </div>
          <br>

          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="tempat_lahir" style="width: 160px;">Tempat Lahir</span>
            </div>
            <input type="text" class="col-7 form-control" aria-label="tempat_lahir" aria-describedby="addon-wrapping" name="tempat_lahir" id="tempat_lahir" value="<?= $ubahidentitas[0]["tempat_lahir"]; ?>" required>
          </div>
          <br>

          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="tanggal_lahir" style="width: 160px;">Tanggal Lahir</span>
            </div>
            <input type="date" class="col-sm-7 form-control" aria-label="tanggal_lahir" aria-describedby="addon-wrapping" name="tanggal_lahir" id="tanggal_lahir" value="<?= $ubahidentitas[0]["tanggal_lahir"]; ?>" required>
          </div>
          <br>

          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="nik" style="width: 160px;">NIK</span>
            </div>
            <input type="text" class="col-sm-7 form-control" aria-label="nik" aria-describedby="addon-wrapping" name="nik" id="nik" value="<?= $ubahidentitas[0]["nik"]; ?>" required>
          </div>
          <br>

          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="alamat_ktp" style="width: 160px;">Alamat KTP</label>
            </div>
            <input type="text" class="col-sm-7 form-control" aria-label="alamat_ktp" aria-describedby="addon-wrapping" name="alamat_ktp" id="alamat_ktp" value="<?= $ubahidentitas[0]["alamat_ktp"]; ?>" required>
          </div>
          <br>

          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="alamat_Sekarang" style="width: 160px;">Alamat Sekarang</label>
            </div>
            <input type="text" class="col-sm-7 form-control" aria-label="alamat_Sekarang" aria-describedby="addon-wrapping" name="alamat_Sekarang" id="alamat_Sekarang" value="<?= $ubahidentitas[0]["alamat_Sekarang"]; ?>" required>
          </div>
          <br>

          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="email" style="width: 160px;">Email</label>
            </div>
            <input type="text" class="col-sm-7 form-control" aria-label="email" aria-describedby="addon-wrapping" name="email" id="email" value="<?= $ubahidentitas[0]["email"]; ?>" required>
          </div>
          <br>

          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="npwp" style="width: 160px;">NPWP</label>
            </div>
            <input type="text" class="col-sm-7 form-control" aria-label="npwp" aria-describedby="addon-wrapping" name="npwp" id="npwp" value="<?= $ubahidentitas[0]["npwp"]; ?>" required>
          </div>
          <br>

          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="no_wa" style="width: 160px;">No Whatsapp</label>
            </div>
            <input type="text" class="col-sm-7 form-control" aria-label="no_wa" aria-describedby="addon-wrapping" name="no_wa" id="no_wa" value="<?= $ubahidentitas[0]["no_wa"]; ?>" required>
          </div>
          <br>

          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="no_telp" style="width: 160px;">No Telepon</label>
            </div>
            <input type="text" class="col-sm-7 form-control" aria-label="no_wa" aria-describedby="addon-wrapping" name="no_telp" id="no_telp" value="<?= $ubahidentitas[0]["no_telp"]; ?>" required>
          </div>
          <br>

          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="no_wa" style="width: 160px;">Golongan Darah</label>
            </div>
            <input type="text" class="col-sm-7 form-control" aria-label="no_wa" aria-describedby="addon-wrapping" name="golongan_darah" id="golongan_darah" value="<?= $ubahidentitas[0]["golongan_darah"]; ?>" required>
          </div>
          <br>

          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="no_wa" style="width: 160px;">Pendidikan Terakhir</label>
            </div>
            <input type="text" class="col-sm-7 form-control" aria-label="no_wa" aria-describedby="addon-wrapping" name="pend_terakhir" id="pend_terakhir" value="<?= $ubahidentitas[0]["pend_terakhir"]; ?>" required>
          </div>
          <br>

          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="no_wa" style="width: 160px;">Tanggal Masuk</label>
            </div>
            <input type="date" class="col-sm-7 form-control" aria-label="no_wa" aria-describedby="addon-wrapping" name="tgl_masuk_kerja" id="tgl_masuk_kerja" value="<?= $ubahidentitas[0]["tgl_masuk_kerja"]; ?>" required>
          </div>
          <br>


          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="no_wa" style="width: 160px;">Status Pernikahan</label>
            </div>
            <input type="text" class="col-sm-7 form-control" aria-label="no_wa" aria-describedby="addon-wrapping" name="status_pernikahan" id="status_pernikahan" value="<?= $ubahidentitas[0]["status_pernikahan"]; ?>" required>
          </div>
          <br>

          <div class="justify-content-center input-group flex-nowrap">
            <div class="input-group-prepend">
              <span class="input-group-text" id="addon-wrapping" for="no_wa" style="width: 160px;">Status Kepegawaian</label>
            </div>
            <input type="text" class="col-sm-7 form-control" aria-label="no_wa" aria-describedby="addon-wrapping" name="status_kepegawaian" id="status_kepegawaian" value="<?= $ubahidentitas[0]["status_kepegawaian"]; ?>" required>
          </div>
          <br>

          <div class="style1 text-center">
            <input type="submit" class="btn btn-info" name="daftar" value="ubah">
            <a href="identitas_admin.php" type="submit" class="btn btn-success" name="back">Kembali</a>
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

      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

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