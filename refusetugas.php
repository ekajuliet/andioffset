<?php
include 'koneksi.php';
refusetugas($_GET['id']);
header("Location: izintugas_drk.php");
