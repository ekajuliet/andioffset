<?php

$conn = mysqli_connect("localhost", "root", "", "projekse_hris");

function login($data)
{
	$_SESSION["login"];
}

function createID($search, $table, $kode)
{
	// CREATE ID
	$id_primary = $GLOBALS['conn']->query("SELECT max($search) as maxKode FROM $table");
	$id_primary = $id_primary->fetch_assoc();
	$id_primary = $id_primary['maxKode'];

	if (substr($id_primary, 2, 8) != date('Ymd')) {
		$noUrut = 0;
	} else {
		$noUrut = (int) substr($id_primary, 10, 10);
		if ($noUrut == 9999999999) {
			$noUrut = 0;
		} else {
			$noUrut++;
		}
	}
	$id_primary = $kode . date('Ymd') . sprintf("%010s", $noUrut);
	return $id_primary;
	// END CREATE ID
}

function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($data = mysqli_fetch_assoc($result)) {
		$rows[] = $data;
	}

	return $rows;
}

function upload()
{
	$namaFile = $_FILES['foto']['name'];
	$ukuranFile = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmpName = $_FILES['foto']['tmp_name'];

	if ($error === 4) {
		echo "<script>
				alert('pilih foto terlebih dahulu');
			</script>";
		return false;
	}

	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
				alert('yang anda upload bukan file foto');
			</script>";
		return false;
	}

	if ($ukuranFile > 1000000) {
		echo "<script>
				alert('ukuran foto terlalu besar');
			</script>";
		return false;
	}

	$namaFileBaru = uniqid();

	move_uploaded_file($tmpName, 'image/' . $namaFile);

	return $namaFile;
}


function tambahijinsakit($data)
{
	global $conn;

	$id_sakit = createID('id_sakit', 'sakit', 'SA');
	$nama_karyawan = htmlspecialchars($data["nama_karyawan"]);
	$tanggal_sekarang = htmlspecialchars($data["tanggal_sekarang"]);
	$nama_dokter = htmlspecialchars($data["nama_dokter"]);
	$keterangan = htmlspecialchars($data["keterangan"]);

	$foto = upload();
	if (!$foto) {
		return false;
	}


	mysqli_query($conn, "INSERT INTO sakit (id_sakit, id_anggota, nama_karyawan, tanggal_sekarang, nama_dokter, keterangan, foto)
	 VALUES 
	 	('$id_sakit', 
	 	'$_SESSION[id_anggota]',
        '$nama_karyawan', 
        '$tanggal_sekarang',
        '$nama_dokter', 
        '$keterangan',
        '$foto')");

	return mysqli_affected_rows($conn);
}

function beritapribadi($data)
{
	global $conn;

	$id_berita = createID('id_berita', 'berita', 'BR');
	$id_anggota = ($data["id_anggota"]);
	$nama_karyawan = ($data["nama_anggota"]);
	$tanggal_sekarang = ($data["tanggal_sekarang"]);
	$judul = ($data["judul"]);
	$keterangan = ($data["keterangan"]);

	mysqli_query($conn, "INSERT INTO berita (id_berita, id_anggota, nama_anggota, tanggal_sekarang,judul,keterangan)
	VALUES 
	('$id_berita', 
	'$id_anggota', 
	'$nama_karyawan', 
	'$tanggal_sekarang', 
	'$judul', 
	'$keterangan')");

	return mysqli_affected_rows($conn);
}

function bpjs($data)
{
	global $conn;

	$id_bpjskesehatan = createID('id_tunjangan', 'tunjangan', "TK");
	$id_anggota = $_POST["id_anggota"];
	$nama_anggota = $_POST["nama_anggota"];
	$nik = $_POST["nomor_ktp"];
	$nomor_telp = $_POST["no_telp"];
	$jenis_kelamin = $_POST["jenis_kelamin"];
	$tanggal_lahir = $_POST["tanggal_lahir"];
	$kelas = $_POST["kelas"];
	$gaji = $_POST["gaji"];
	$jenis_bpjs = $_POST["jenis_bpjs"];

	mysqli_query($conn, "INSERT INTO tunjangan (id_tunjangan, id_anggota, nama_anggota, nomor_ktp, no_telp, jenis_kelamin, tanggal_lahir, kelas, gaji, jenis_bpjs)
	VALUES 
	('$id_bpjskesehatan', 
	'$id_anggota', 
	'$nama_anggota', 
	'$nik', 
	'$nomor_telp', 
	'$jenis_kelamin',
	'$tanggal_lahir',
	'$kelas',
	'$gaji',
	'$jenis_bpjs')");

	return mysqli_affected_rows($conn);
}

function regis_ijin($data)
{
	global $conn;

	$id_ijin = createID('id_ijin', 'ijin', 'IJ');
	$id_anggota = trim($data["id_anggota"]);
	$nama_karyawan = ($data["nama_karyawan"]);
	$tanggal_sekarang = ($data["tanggal_sekarang"]);
	$bagian = ($data["bagian"]);
	$alasan = ($data["alasan"]);

	mysqli_query($conn, "INSERT INTO ijin (id_ijin, id_anggota, nama_karyawan, tanggal_sekarang,bagian,alasan)
	VALUES 
	('$id_ijin', 
	'$id_anggota', 
	'$nama_karyawan', 
	'$tanggal_sekarang', 
	'$bagian', 
	'$alasan')");

	return mysqli_affected_rows($conn);
}

function regis_ijinkeluar($data)
{
	global $conn;

	$id_ijinkeluar = createID('id_ijin_keluar', 'ijinkeluar', 'IJ');
	$id_anggota = trim($data["id_anggota"]);
	$nama_karyawan = ($data["nama_karyawan"]);
	$waktu_keluar = ($data["waktu_keluar"]);
	$status = ($data["status"]);
	$alasan = ($data["alasan"]);

	mysqli_query($conn, "INSERT INTO ijinkeluar (id_ijin_keluar, id_anggota, nama_karyawan, waktu_keluar, status, alasan)
	VALUES 
	('$id_ijinkeluar', 
	'$id_anggota', 
	'$nama_karyawan', 
	'$waktu_keluar', 
	'$status', 
	'$alasan')");

	return mysqli_affected_rows($conn);
}


function tambahadmin($data)
{
	global $conn;

	$id_anggota = createID('id_riwayat_anggota', 'user', 'RA');
	$username = ($data["id_anggota"]);
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$nama_anggota = ($data["nama_anggota"]);
	$tempat_lahir = ($data["tempat_lahir"]);
	$tanggal_lahir = ($data["tanggal_lahir"]);
	$nik = ($data["nik"]);
	$alamat_ktp = ($data["alamat_ktp"]);
	$alamat_sekarang = ($data["alamat_Sekarang"]);
	$email = ($data["email"]);
	$npwp = ($data["npwp"]);
	$no_Wa = ($data["no_wa"]);
	$no_telp = ($data["no_telp"]);
	$golongan_darah = ($data["golongan_darah"]);
	$pend_terakhir = ($data["pend_terakhir"]);
	$tgl_masuk_kerja = ($data["tgl_masuk_kerja"]);
	$status_pernikahan = ($data["status_pernikahan"]);
	$status_kepegawaian = ($data["status_kepegawaian"]);
	$status = ($data["status"]);


	$result = mysqli_query($conn, "SELECT id_anggota FROM user WHERE id_anggota = '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('Username sudah terdaftar');
			</script>";
		return false;
	}


	if ($password !== $password2) {
		echo "<script>
				alert('konfirmasi password tidak sesuai');
			</script>";
		return false;
	}

	$password = password_hash($password, PASSWORD_DEFAULT);

	mysqli_query($conn, "INSERT INTO user (id_riwayat_anggota, id_anggota, password, nama_anggota, tempat_lahir,tanggal_lahir,nik,alamat_ktp, alamat_Sekarang, email,npwp, no_telp, 
	no_wa, golongan_darah, pend_terakhir, tgl_masuk_kerja, status_pernikahan, status_kepegawaian, status)
	VALUES 
	('$id_anggota', 
	'$username', 
	'$password', 
	'$nama_anggota', 
	'$tempat_lahir', 
	'$tanggal_lahir', 
	'$nik', 
	'$alamat_ktp', 
	'$alamat_sekarang', 
	'$email', 
	'$npwp', 
    '$no_Wa', 
	'$no_telp',  
	'$golongan_darah', 
	'$pend_terakhir', 
	'$tgl_masuk_kerja', 
	'$status_pernikahan', 
	'$status_kepegawaian', 
	'$status')");

	return mysqli_affected_rows($conn);
}

function tambahbpjs($data)
{
	global $conn;

	$id_bpjs = createID('id_tunjangan', 'tunjangan', "BK");
	$id_anggota = $_POST["id_anggota"];
	$nama_anggota = $_POST["nama_anggota"];
	$nomor_induk = $_POST["nomor_ktp"];
	$nomor_telp = $_POST["no_telp"];
	$jenis_kelamin = $_POST["jenis_kelamin"];
	$tanggal_lahir = $_POST["tanggal_lahir"];
	$kelas = $_POST["kelas"];
	$gaji = $_POST["gaji"];

	$query = "INSERT INTO tunjangan (id_tunjangan, id_anggota, nama_anggota, nomor_ktp, no_telp, jenis_kelamin, tanggal_lahir, kelas, gaji)
	 VALUES
	 	('" . $id_bpjs . "',
		'" . $id_anggota . "', 
        '" . $nama_anggota . "', 
        '" . $nomor_induk . "', 
        '" . $nomor_telp . "', 
        '" . $jenis_kelamin . "', 
        '" . $tanggal_lahir . "',
        '" . $kelas . "', 
        '" . $gaji . "',
        '" . $_SESSION['id_anggota'] . "')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubah($data)
{
	global $conn;

	$id = $data['id_anggota'];
	$nama_anggota = ($data["nama_anggota"]);
	$tempat_lahir = ($data["tempat_lahir"]);
	$tanggal_lahir = ($data["tanggal_lahir"]);
	$nik = ($data["nik"]);
	$alamat_ktp = ($data["alamat_ktp"]);
	$alamat_sekarang = ($data["alamat_Sekarang"]);
	$email = ($data["email"]);
	$npwp = ($data["npwp"]);
	$no_Wa = ($data["no_wa"]);
	$no_telp = ($data["no_telp"]);
	$golongan_darah = ($data["golongan_darah"]);
	$pend_terakhir = ($data["pend_terakhir"]);
	$tgl_masuk_kerja = ($data["tgl_masuk_kerja"]);
	$status_pernikahan = ($data["status_pernikahan"]);
	$status_kepegawaian = ($data["status_kepegawaian"]);

	$query = "UPDATE user SET

		nama_anggota = '$nama_anggota',
		tempat_lahir = '$tempat_lahir',
		tanggal_lahir = '$tanggal_lahir',
		nik = '$nik',
		alamat_ktp = '$alamat_ktp',
		alamat_Sekarang = '$alamat_sekarang',
		email = '$email',
		npwp = '$npwp',
		no_Wa = '$no_Wa',
		no_telp = '$no_telp',
		golongan_darah = '$golongan_darah',
		pend_terakhir = '$pend_terakhir',
		tgl_masuk_kerja = '$tgl_masuk_kerja',
		status_pernikahan = '$status_pernikahan',
		status_kepegawaian = '$status_kepegawaian'
	  
		WHERE id_anggota = '$id'";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function tambahijin($data)
{
	global $conn;

	$id = $data['id_ijin'];
	$nama_karyawan = htmlspecialchars($data["nama_karyawan"]);
	$tanggal_sekarang = htmlspecialchars($data["tanggal_sekarang"]);
	$bagian = htmlspecialchars($data["bagian"]);
	$keterangan = htmlspecialchars($data["alasan"]);

	$query = "UPDATE ijin SET

		nama_karyawan = '$nama_karyawan',
		tanggal_sekarang = '$tanggal_sekarang',
		bagian = '$bagian',
		alasan = '$keterangan'
		 
		WHERE id_ijin = '$id'";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function ubahpass($data)
{

	global $conn;

	$password_lama 			= $_POST['password_lama'];
	$password_baru			= $_POST['password_baru'];
	$konfirmasi_password	= $_POST['konfirmasi'];
	$ok						= "SELECT password FROM user WHERE id_anggota ='$_SESSION[id_anggota]'";
	$result = mysqli_query($conn, $ok);
	$result = $result->fetch_assoc()['password'];

	if (password_verify($password_lama, $result)) {
		if (strlen($password_baru) >= 5) {

			if ($password_baru == $konfirmasi_password) {

				$password_baru 	= password_hash($password_baru, PASSWORD_DEFAULT);
				$id_anggota		= $_SESSION['id_anggota']; //ini dari session saat login

				$update 		= "UPDATE user SET password='$password_baru' WHERE id_anggota='$id_anggota'";
				$sql = mysqli_query($conn, $update);
				if ($sql) {
					echo "<script>alert('Password berhasil diubah');</script>";
				} else {
					echo "<script>alert('Password gagal diubah');</script>";
				}
			} else {
				echo "<script>alert('Konfirmasi password tidak cocok');</script>";
			}
		} else {
			echo "<script>alert('Minimal password baru 5 karakter');</script>";
		}
	} else {
		echo "<script>alert('Password lama salah');</script>";
	}
}

function ubahsakit($data)
{
	global $conn;

	$id = $data["id_anggota"];
	$nama_anggota = htmlspecialchars($data["nama_karyawan"]);
	$tanggal_sekarang = htmlspecialchars($data["tanggal_sekarang"]);
	$nama_dokter = htmlspecialchars($data["nama_dokter"]);
	$keterangan = htmlspecialchars($data["keterangan"]);

	$query = "UPDATE sakit SET

	nama_karyawan = '$nama_anggota',
	tanggal_sekarang = '$tanggal_sekarang',
	nama_dokter = '$nama_dokter',
	keterangan = '$keterangan'

	WHERE id_anggota = '$id'";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function ubahseragam($data)
{
	global $conn;

	$id = $data["id_anggota"];
	$nama_anggota = htmlspecialchars($data["nama_anggota"]);
	$status_dapat = htmlspecialchars($data["status_dapat"]);
	$kemeja = htmlspecialchars($data["kemeja"]);
	$celana = htmlspecialchars($data["celana"]);
	$status_terima = htmlspecialchars($data["status_terima"]);
	$keterangan = htmlspecialchars($data["keterangan"]);

	$query = "UPDATE tunjangan_seragam SET

	nama_anggota = '$nama_anggota',
	status_dapat = '$status_dapat',
	kemeja = '$kemeja',
	celana = '$celana',
	status_terima = '$status_terima',
	keterangan = '$keterangan'

	WHERE id_anggota = '$id'";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function ubahberas($data)
{
	global $conn;

	$id = $data["id_anggota"];
	$nama_anggota = htmlspecialchars($data["nama_anggota"]);
	$status_dapat = htmlspecialchars($data["status_dapat"]);
	$status_terima = htmlspecialchars($data["status_terima"]);
	$keterangan = htmlspecialchars($data["keterangan"]);

	$query = "UPDATE tunjangan_beras SET

	nama_anggota = '$nama_anggota',
	status_dapat = '$status_dapat',
	status_terima = '$status_terima',
	keterangan = '$keterangan'

	WHERE id_anggota = '$id'";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function ubahbpjs($data)
{
	global $conn;

	$id = $data["id_anggota"];
	$nama_anggota = htmlspecialchars($data["nama_anggota"]);
	$nomor_ktp = htmlspecialchars($data["nomor_ktp"]);
	$no_telp = htmlspecialchars($data["no_telp"]);
	$jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
	$tanggal_lahir = htmlspecialchars($data["tanggal_lahir"]);
	$kelas = htmlspecialchars($data["kelas"]);
	$gaji = htmlspecialchars($data["gaji"]);


	$query = "UPDATE tunjangan SET

	nama_anggota = '$nama_anggota',
	nomor_ktp = '$nomor_ktp',
	no_telp = '$no_telp',
	jenis_kelamin = '$jenis_kelamin',
	tanggal_lahir = '$tanggal_lahir',
	kelas = '$kelas',
	gaji = '$gaji'
	WHERE id_anggota = '$id'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahtransport($data)
{
	global $conn;

	$id = $data["id"];
	$id_anggota = htmlspecialchars($data["id_anggota"]);
	$nama_anggota = htmlspecialchars($data["nama_anggota"]);
	$status_dapat = htmlspecialchars($data["status_dapat"]);
	$status_terima = htmlspecialchars($data["status_terima"]);
	$keterangan = htmlspecialchars($data["keterangan"]);

	$query = "UPDATE tunjangan_transport SET

	id_anggota = '$id_anggota',
	nama_anggota = '$nama_anggota',
	status_dapat = '$status_dapat',
	status_terima = '$status_terima',
	keterangan = '$keterangan'

	WHERE id = '$id'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahberita($data)
{
	global $conn;

	$id = $data["id_anggota"];
	$nama_anggota = htmlspecialchars($data["nama_anggota"]);
	$tanggal_sekarang = htmlspecialchars($data["tanggal_sekarang"]);
	$judul = htmlspecialchars($data["judul"]);
	$keterangan = htmlspecialchars($data["keterangan"]);

	$query = "UPDATE berita SET

	nama_anggota = '$nama_anggota',
	tanggal_sekarang = '$tanggal_sekarang',
	judul = '$judul',
	keterangan = '$keterangan'
	WHERE id_anggota = '$id'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function hapus($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM berita WHERE id_berita = '$id'");
	return mysqli_affected_rows($conn);
}

function hapusijin($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM ijin WHERE id_ijin = '$id'");
	return mysqli_affected_rows($conn);
}

function hapussakit($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM sakit WHERE id_sakit = '$id'");
	return mysqli_affected_rows($conn);
}

function hapustransport($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM tunjangan_transport WHERE id_transport = '$id'");
	return mysqli_affected_rows($conn);
}

function hapusbpjs($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM tunjangan WHERE id_tunjangan = '$id'");
	return mysqli_affected_rows($conn);
}

function hapusseragam($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM tunjangan_seragam WHERE id_seragam = '$id'");
	return mysqli_affected_rows($conn);
}

function hapusberas($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM tunjangan_beras WHERE id_beras = '$id'");
	return mysqli_affected_rows($conn);
}


function hapusberita($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM berita WHERE id_berita = '$id'");
	return mysqli_affected_rows($conn);
}


function hapuscuti($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM cuti WHERE id_cuti = $id");
	return mysqli_affected_rows($conn);
}
