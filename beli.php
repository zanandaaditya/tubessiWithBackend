<?php
session_start();
$id_produk = $_GET['id'];

//jk ad produk sama ditambah satu
if (isset($_SESSION['keranjang'][$id_produk])) {
    $_SESSION['keranjang'][$id_produk]=1;
}
//jk belum ada dianggap satu
else{
    $_SESSION['keranjang'][$id_produk]+=1;
}
echo "<pre>";
print_r($_SESSION['keranjang']);
echo "</pre>";
echo "<script>alert('Produk sudah dimasukkan ke keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?>