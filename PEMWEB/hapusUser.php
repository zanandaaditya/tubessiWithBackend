<?php

$cari=$_GET['id'];


$nama = 'zanandaaditya';

if ($nama_pelanggan = $_SESSION['pelanggan']['nama_user'] == $nama) {
    $hapus = mysqli_query($koneksi,"DELETE FROM user WHERE id_user=$cari");

    if ($hapus==true) {
        echo "
                <script>
                    alert ('data berhasil di hapus');
                    document.location.href= 'index.php?halaman=pelanggan';
                </script>
            ";
    } else {
        echo "
                <script>
                    alert ('data GAGAL di hapus');
                    document.location.href= 'index.php?halaman=pelanggan';
                </script>
            ";
    }
} else {
    echo "
        <script>
            alert ('ANDA BUKAN SUPER USER, SILAHKAN HUBUNGI ZANANDA ADITYA DULS');
            alert ('100K Jadi SUPERUSER SELAMA 1 HARI');
            document.location.href= 'index.php?halaman=pelanggan';
        </script>
    ";
    exit;
}

?>