<?php

require 'function.php';

$id = $_GET["id"];

if (hapusijin($id) > 0) {
    echo "
        <script>
            alert('data berhasil dihapus');
            document.location.href = 'ijinkaryawan_admin.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('data gagal dihapus');
            document.location.href = 'ijinkaryawan_admin.php';
        </script>
    ";
}
