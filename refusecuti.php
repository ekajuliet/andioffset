<?php
include 'koneksi.php';
refusecuti($_GET['id']);
header("Location: cuti_drk.php");
?>