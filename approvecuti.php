<?php

include 'koneksi.php';
approve($_GET['id']);
header("Location: cuti_drk.php");
?>