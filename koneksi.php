<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB1', 'projekse_hris');


$db1 = new mysqli(HOST, USER, PASS, DB1);

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
    global $db1;
    $result = mysqli_query($db1, $query);
    $rows = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $rows[] = $data;
    }

    return $rows;
}

function approve($id)
{
    global $db1;
    $sql = "UPDATE cuti SET status='approve' WHERE id='" . $_GET['id'] . "'";
    mysqli_query($db1, $sql);
}

function approvetugas($id)
{
    global $db1;
    $sql = "UPDATE tugas SET status='approve' WHERE id='" . $_GET['id'] . "'";
    mysqli_query($db1, $sql);
}

function refusecuti($id)
{
    global $db1;
    $sql = "UPDATE cuti SET status='rejected' WHERE id='" . $_GET['id'] . "'";
    mysqli_query($db1, $sql);
}

function refusetugas($id)
{
    global $db1;
    $sql = "UPDATE tugas SET status='rejected' WHERE id='" . $_GET['id'] . "'";
    mysqli_query($db1, $sql);
}

function ubahcuti($data)
{
    global $db1;

    $id = $data["id_anggota"];
    $nama_karyawan = htmlspecialchars($data["nama_karyawan"]);
    $tanggal_mulai = htmlspecialchars($data["tanggal_mulai"]);
    $tanggal_selesai = htmlspecialchars($data["tanggal_selesai"]);
    $provinsi = htmlspecialchars($data["provinsi"]);
    $kabupaten = htmlspecialchars($data["kabupaten"]);
    $kecamatan = htmlspecialchars($data["kecamatan"]);
    $keterangan = htmlspecialchars($data["keterangan"]);


    $query = "UPDATE cuti SET
	
	  nama_karyawan = '$nama_karyawan',
	  tanggal_mulai = '$tanggal_mulai',
	  tanggal_selesai = '$tanggal_selesai',
	  provinsi = '$provinsi',
	  kabupaten = '$kabupaten',
	  kecamatan = '$kecamatan',
	  keterangan = '$keterangan'
      
	  WHERE id_anggota = '$id'
	 ";

    mysqli_query($db1, $query);

    return mysqli_affected_rows($db1);
}


function ubahtugas($data)
{
    global $db1;

    $id = $data["id_anggota"];
    $nama_karyawan = htmlspecialchars($data["nama_karyawan"]);
    $tanggal_mulai = htmlspecialchars($data["tanggal_mulai"]);
    $tanggal_selesai = htmlspecialchars($data["tanggal_selesai"]);
    $provinsi = htmlspecialchars($data["provinsi"]);
    $kabupaten = htmlspecialchars($data["kabupaten"]);
    $kecamatan = htmlspecialchars($data["kecamatan"]);
    $keterangan = htmlspecialchars($data["keterangan"]);


    $query = "UPDATE tugas SET
	  
	  nama_karyawan = '$nama_karyawan',
	  tanggal_mulai = '$tanggal_mulai',
	  tanggal_selesai = '$tanggal_selesai',
	  provinsi = '$provinsi',
	  kabupaten = '$kabupaten',
	  kecamatan = '$kecamatan',
	  keterangan = '$keterangan'

	  WHERE id_anggota = '$id'";

    mysqli_query($db1, $query);

    return mysqli_affected_rows($db1);
}

function hapuscuti($id)
{
    global $db1;
    mysqli_query($db1, "DELETE FROM cuti WHERE id_cuti = '$id'");
    return mysqli_affected_rows($db1);
}

function hapusidentitas($id)
{
    global $db1;
    mysqli_query($db1, "DELETE FROM user WHERE id_riwayat_anggota = '$id'");
    return mysqli_affected_rows($db1);
}

function hapustugas($id)
{
    global $db1;
    mysqli_query($db1, "DELETE FROM tugas WHERE id_tugas = '$id'");
    return mysqli_affected_rows($db1);
}
