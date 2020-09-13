<?php

session_start();
if (!isset($_SESSION["login"])) {
  header("Location: index.php");
}

include 'function.php';

if (isset($_POST["submit"])) {
  if (tambahadmin($_POST) > 0) {
    echo "<script>
				alert('Anggota berhasil ditambah');
			</script>";
  } else {
    echo mysqli_error($conn);
  }
}

// UPLOAD DATA DARI EXCEL (BLM JADI)
if (isset($_POST['upload_data_karyawan'])) {
	require('vendor/spreadsheet-reader/php-excel-reader/excel_reader2.php');
	require('vendor/spreadsheet-reader/SpreadsheetReader.php');

	//upload data excel kedalam folder uploads
	$nama = $_FILES['excel']['name'];
	$target_dir = "file_excel/".basename($_FILES['excel']['name']);
	
	move_uploaded_file($_FILES['excel']['tmp_name'],$target_dir);

	$Reader = new SpreadsheetReader($target_dir);

	$no = 1;
	foreach ($Reader as $Key => $Row){

		// import data excel mulai baris ke-2 (karena ada header pada baris 1)
		if ($Key < 1) continue;			
		if ($Row[0] == '') continue;


		$cek = $conn->query("SELECT anggota_sistem FROM pustaka_buku WHERE id_anggota='$Row[1]' AND status_hapus!='R'");

		$cek = $cek->num_rows;
		if ($cek > 0) {
	        $_SESSION['gagal_upload'][$no] = '<b>'.$no.'.</b> &nbsp;Karyawan <b>"'.$Row['1'].'"</b> gagal, ID telah terdaftar dalam database';
	        $no++;
		}else{
		    
		    $hasil_query = $conn->query("INSERT INTO user (id_riwayat_anggota, id_anggota, password, nama_anggota, tempat_lahir,tanggal_lahir,nik,alamat_ktp, alamat_Sekarang, email,npwp, no_telp, 
            	no_wa, golongan_darah, pend_terakhir, tgl_masuk_kerja, status_pernikahan, status_kepegawaian, status)
            	VALUES 
            	('$Row[1]', 
            	'$Row[1]', 
            	'$Row[1]', 
            	'$Row[1]', 
            	'$Row[1]', 
            	'$Row[1]', 
            	'$Row[1]', 
            	'$Row[1]', 
            	'$Row[1]', 
            	'$Row[1]', 
            	'$Row[1]', 
                '$Row[1]', 
            	'$Row[1]',  
            	'$Row[1]', 
            	'$Row[1]', 
            	'$Row[1]', 
            	'$Row[1]', 
            	'$Row[1]', 
            	'$Row[1]')");
			
			if ($hasil_query == 0) {
				$_SESSION['gagal_upload'][$no] = 'Karyawan <b>"'.$Row['1'].'"</b> Gagal, Sistem Error';
				$no++;
			}
		}
	}

	unlink("file_excel/$nama");
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

  <title>Profile Admin</title>

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
        <div class="row justify-content-center">
            <div class="col-sm-9">
                <h4 class="pull-left">Tambah Anggota</h4>
                <button class='pull-right btn btn-primary' data-toggle="modal" data-target="#modal_tambah">Upload Excel</button>
                <br><br>
            </div>
        </div>
    
        
        <hr color="skyblue" height="20px">

        <div>

          <?php if (isset($error)) : ?>
            <p style="color: red; font-style: italic; text-align: center;"><br>Username / password salah</p>
          <?php endif; ?>

          <form action="" method="POST" autocomplete="off">

            <div class="justify-content-center form-group row">
              <label for="id_anggota" class="col-sm-2 col-form-label">ID Anggota</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="id_anggota" id="id_anggota" placeholder="Masukkan ID Anggota" required>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="nama_anggota" class="col-sm-2 col-form-label">Nama Anggota</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="nama_anggota" id="nama_anggota" placeholder="Masukkan nama anggota" required>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="password" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-7">
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password" required>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="password" class="col-sm-2 col-form-label">Konfirmasi Password</label>
              <div class="col-sm-7">
                <input type="password" class="form-control" name="password2" id="password2" placeholder="Konfirmasi Password" required>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan tempat Lahir" required>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
              <div class="col-sm-7">
                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Masukkan Tanggal Lahir" required>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="nik" class="col-sm-2 col-form-label">NIK</label>
              <div class="col-sm-7">
                <input type="number" class="form-control" name="nik" id="nik" placeholder="Masukkan NIK" required>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="alamat_ktp" class="col-sm-2 col-form-label">Alamat KTP</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="alamat_ktp" id="alamat_ktp" placeholder="Masukkan Alamat KTP" required>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="alamat_Sekarang" class="col-sm-2 col-form-label">Alamat Sekarang</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="alamat_Sekarang" id="alamat_Sekarang" placeholder="Masukkan Alamat Sekarang" required>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="email" id="email" placeholder="Masukkan Email" required>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="npwp" class="col-sm-2 col-form-label">NPWP</label>
              <div class="col-sm-7">
                <input type="number" class="form-control" name="npwp" id="npwp" placeholder="Masukkan NPWP" required>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="no_wa" class="col-sm-2 col-form-label">No WA</label>
              <div class="col-sm-7">
                <input type="number" class="form-control" name="no_wa" id="no_wa" placeholder="Masukkan No.Whatsapp" required>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="no_telp" class="col-sm-2 col-form-label">No Telp</label>
              <div class="col-sm-7">
                <input type="number" class="form-control" name="no_telp" id="no_telp" placeholder="Masukkan No.Telp" required>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="golongan_darah" class="col-sm-2 col-form-label">Golongan Darah</label>
              <div class="col-sm-7">
                <select type="text" class="form-control" name="golongan_darah" id="golongan_darah" required>
                  <option></option>
                  <option>A</option>
                  <option>B</option>
                  <option>AB</option>
                  <option>O</option>
                </select>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="pend_terakhir" class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
              <div class="col-sm-7">
                <select type="text" class="form-control" name="pend_terakhir" id="pend_terakhir" required>
                  <option></option>
                  <option>SD</option>
                  <option>SMP</option>
                  <option>SMA</option>
                  <option>S1</option>
                  <option>S2</option>
                  <option>S3</option>
                </select>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="tgl_masuk_kerja" class="col-sm-2 col-form-label">Tanggal Masuk Kerja</label>
              <div class="col-sm-7">
                <input type="date" class="form-control" name="tgl_masuk_kerja" id="tgl_masuk_kerja" placeholder="Masukkan Tanggal Masuk Kerja" required>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="status_pernikahan" class="col-sm-2 col-form-label">Status Pernikahan</label>
              <div class="col-sm-7">
                <select type="date" class="form-control" name="status_pernikahan" id="status_pernikahan" required>
                  <option></option>
                  <option value="1">Lajang</option>
                  <option value="2">Menikah</option>
                  <option value="3">Cerai Mati</option>
                  <option value="4">Cerai Hidup</option>
                </select>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="status_kepegawaian" class="col-sm-2 col-form-label">Status Kepegawaian</label>
              <div class="col-sm-7">
                <select type="date" class="form-control" name="status_kepegawaian" id="status_kepegawaian" required>
                  <option></option>
                  <option value="1">Kontrak</option>
                  <option value="2">Tetap</option>
                </select>
              </div>
            </div>

            <div class="justify-content-center form-group row">
              <label for="status" class="col-sm-2 col-form-label">Status</label>
              <div class="col-sm-7">
                <select type="date" class="form-control" name="status" id="status" required>
                  <option></option>
                  <option>Karyawan</option>
                  <option>Admin</option>
                  <option>Direktur</option>
                  <option>Supervisior</option>
                </select>
              </div>
            </div>

            <div class="text-center">
              <input class="btn btn-info" type="submit" name="submit" value="Simpan">
            </div>

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
      

<!-- MODAL -->
<div class="modal fade" id="modal_tambah">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="frm_tambah_paket" method="post" enctype="multipart/form-data">
            <input type="text" name="upload_list_buku" hidden>
            <div class="modal-body">
                <div class="form-group">
                  <label>Upload Data Karyawan</label><br>
                  <input type="file" class="" name="excel" required autocomplete="off">
                </div>
                <a href="" download>Download Format Excel</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btn_simpan_list_buku">Upload dan Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>


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