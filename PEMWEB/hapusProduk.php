<?php

$cari=$_GET['id'];

$ambil = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk=$cari");
$row = mysqli_fetch_assoc($ambil);
$gambar_produk = $row['gambar_produk'];
    if (file_exists("photo/$gambar_produk")) {
        unlink("photo/$gambar_produk");
    }

$hapus = mysqli_query($koneksi,"DELETE FROM produk WHERE id_produk=$cari");

if ($hapus==true) {
    echo "
            <script>
                alert ('data berhasil di hapus');
                document.location.href= 'index.php?halaman=produk';
            </script>
        ";
} else {
    echo "
            <script>
                alert ('data GAGAL di hapus');
                document.location.href= 'index.php?halaman=produk';
            </script>
        ";
}
?>