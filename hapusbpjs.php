<?php

require 'function.php';

$id = $_GET["id"];

if (hapusbpjs($id) > 0) {
    echo "
        <script>
            alert('data berhasil dihapus');
            document.location.href = 'bpjs_admin.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('data gagal dihapus');
            document.location.href = 'bpjs_admin.php';
        </script>
    ";
}
