<?php

include 'koneksi.php';
approvetugas($_GET['id']);
header("Location: izintugas_drk.php");
