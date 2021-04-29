<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","db_tubessi");
// $koneksi = mysqli_connect("sql307.epizy.com","epiz_27302184","o5buL10tF8","epiz_27302184_tubessi");
if (!isset($_SESSION["pelanggan"])) {
   header("Location: login.php");
   exit;
}
$nama_pelanggan = $_SESSION['pelanggan']['nama_pelanggan'];
// echo "<pre>";
// print_r($_SESSION['keranjang']);
// print_r($_SESSION['pelanggan']);
// echo "</pre>";

if (empty($_SESSION['keranjang'])) {
   echo "<script>alert('Keranjang Kosong silahkan pilih barang');</script>";
   echo "<script>location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>HITZ COFFEE</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="style/font/all.css">
   <!-- Style Manual -->
   <link rel="stylesheet" href="style/style.css">
   <!-- Font Import -->
   <style>
      @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&family=Playfair+Display:wght@400;700&display=swap');
   </style>
</head>
<body>
<!-- Navbar -->
<section class="section-jumbotron">
   <div class="container">
      <nav class="row navbar navbar-expand-lg navbar-light bg-transparent">
         <a href="index.php" class="navbar-brand">
            <img src="assets/Logo.png" alt="Logo Nomads">
         </a>
         <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navSM">
            <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navSM">
            <ul class="navbar-nav ml-auto mr-3 text-uppercase">
               <li class="nav-item mx-md-2"><a href="index.php" class="nav-link">Beranda</a></li>
               <li class="nav-item mx-md-2"><a href="katalog.php" class="nav-link">Katalog</a></li>
               <li class="nav-item mx-md-2"><a href="aboutus.php" class="nav-link">Tentang Kami</a></li>
            </ul>
            <a href="keranjang.php">
               <i class="fas fa-shopping-cart mx-md-2 mr-3 keranjang active"></i>
            </a>

   <!-- Mobile Button -->
            <form class="form-inline d-sm-block d-md-none">
            <?php if (isset($_SESSION['pelanggan'])) :?>
               <li class="nav-item dropdown" style="list-style-type: none;">
                     <a class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">Halo, <?= $nama_pelanggan; ?>
                     </a>
                     <div class="dropdown-menu">
                     <a href="edit-profil.php" class="dropdown-item">Profil</a>
                     <a href="riwayat.php" class="dropdown-item">Riwayat</a>
                     <hr>
                     <a href="logout.php" class="dropdown-item">Keluar</a>
                  </div>
               </li>
            <?php else: ?>
               <a href="login.php" class="btn btn-login my-2 my-sm-0 px-4">Masuk</a>
            <?php endif; ?>
            </form>
   <!-- Destkop Button -->
            <form class="ml-3 form-inline my-2 my-lg-0 d-none d-md-block">
            <?php if (isset($_SESSION['pelanggan'])) :?>
               <li class="nav-item dropdown" style="list-style-type: none;">
                     <a class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">Halo, <?= $nama_pelanggan; ?>
                     </a>
                     <div class="dropdown-menu">
                     <a href="edit-profil.php" class="dropdown-item">Profil</a>
                     <a href="riwayat.php" class="dropdown-item">Riwayat</a>
                     <hr>
                     <a href="logout.php" class="dropdown-item">Keluar</a>
                  </div>
               </li>
            <?php else: ?>
               <a href="login.php" class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4">Masuk</a>
            <?php endif; ?>
            </form>
         </div>
      </nav>
   </div>
   <!-- Akhir Navbar -->
</section>

<!-- Breadcrubms -->
<section class="section-bred">
   <div class="container">
      <div class="row">
         <div class="col">
            <nav aria-label="breadcrumb" class="bg-transparent">
               <ol class="breadcrumb bg-transparent">
                  <li class="breadcrumb-item active">Keranjang</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
</section>
<!-- Akhir Bread -->

<!-- Awal Keranjang -->
<section class="section-cart">
   <div class="container">
      <div class="row">
         <div class="col">
            <div class="col mt-5 text-center">
               <h4>Keranjang</h4>
               <p>Tambahin lagi Hyung</p>
            </div>
         </div>
      </div>
      <div class="attendee">
         <table class="table table-responsive-sm text-center">
            <thead>
               <tr>
                  <td>
                     No
                  </td>
                  <td>
                     Picture
                  </td>
                  <td>
                     Nama Produk
                  </td>
                  <td>
                     Jumlah
                  </td>
                  <td>
                     Sub Harga
                  </td>
                  <td>
                     Total Harga
                  </td>
                  <td>
                     Aksi
                  </td>
               </tr>
            </thead>
            <tbody>
<?php $no=1;?>
<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
<?php $query = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk = '$id_produk'");
   $rows = mysqli_fetch_assoc($query);
   $subharga = $rows['harga_produk'] * $jumlah;
?>
               <tr>
                  <td>
                     <p class="align-items-center"><?= $no; ?></p>
                  </td>
                  <td>
                     <img src="PEMWEB/photo/<?= $rows['gambar_produk'] ?>" height="60">
                  </td>
                  <td class="align-middle">
                     <?= $rows['nama_produk'] ?>
                  </td>
                  <td class="align-middle">
                     <?= $jumlah ?>
                  </td>
                  <td class="align-middle">
                     IDR <?= number_format($rows["harga_produk"]); ?>
                  </td>
                  <td class="align-middle">
                     IDR <?= number_format($subharga); ?>
                  </td>
                  <td class="align-middle">
                     <a href="hapuskeranjang.php?id=<?= $rows['id_produk'] ?>" style="color: #707070 !important; text-decoration: none; list-style-type: none;">
                        <i class="fas fa-trash"></i>
                     </a>
                  </td>
               </tr>
<?php $no++; ?>
<?php endforeach; ?>
            </tbody>
         </table>
      </div>
      <div class="row text-center justify-content-center">
         <div class="col-md-5">
            <a href="index.php" class="btn btn-lanjut mr-3">Lanjutkan Belanja</a>

            <a href="checkout.php" class="btn btn-beli">Checkout</a>
         </div>
      </div>
   </div>
</section>
<!-- Akhir Keranjang -->

<!-- Footer -->
<footer class="border-top p-5">
   <div class="container">
      <div class="row justify-content-between">
         <div class="col-1">
            <a href="">
            <img src="assets/Logo.png">
            </a>
         </div>
         <div class="col-4 text-right">
            <a href="">
               <i class="fab fa-facebook fa-2x"></i>
            </a>
            <a href="">
               <i class="fab fa-twitter fa-2x"></i>
            </a>
            <a href="">
               <i class="fab fa-instagram fa-2x"></i>
            </a>
         </div>
      </div>
      <div class="row mt-3 justify-content-between">
         <div class="col-5">
            <p>All Rights Reserved by HITZ COFFEE Copyright 2020.</p>
         </div>
         <div class="col-6">
            <nav class="nav justify-content-end text-uppercase">
            <a class="nav-link active" href="#">Jobs</a>
            <a class="nav-link" href="#">Developer</a>
            <a class="nav-link" href="#">Terms</a>
            <a class="nav-link pr-0" href="#">Privacy Policy</a>
            </nav>
         </div>
      </div>
   </div>
</footer>
<!-- Akhir Footer -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
   <script src="js/all.js"></script>
   <script src="js/jquery-3.5.1.min.js"></script>
</body>
</html>