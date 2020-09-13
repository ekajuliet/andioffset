<?php

require 'function.php';

$id = $_GET["id"];

if (hapustransport($id) > 0) {
    echo "
        <script>
            alert('data berhasil dihapus');
            document.location.href = 'infotranspor_admin.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('data gagal dihapus');
            document.location.href = 'infotranspor_admin.php';
        </script>
    ";
}
