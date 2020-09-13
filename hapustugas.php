<?php

require 'koneksi.php';

$id = $_GET["id"];

if (hapustugas($id) > 0) {
    echo "
        <script>
            alert('data berhasil dihapus');
            document.location.href = 'izintugas_admin.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('data gagal dihapus');
            document.location.href = 'izintugas_admin.php';
        </script>
    ";
}
