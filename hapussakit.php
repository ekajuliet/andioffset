<?php

require 'function.php';

$id = $_GET["id"];

if (hapussakit($id) > 0) {
    echo "
        <script>
            alert('data berhasil dihapus');
            document.location.href = 'izinsakit_admin.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('data gagal dihapus');
            document.location.href = 'izinsakit_admin.php';
        </script>
    ";
}
