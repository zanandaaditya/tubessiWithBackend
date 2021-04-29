<?php

session_start();
if (!isset($_SESSION["pelanggan"])) {
   header("Location: login.php");
   exit;
}
$nama_pelanggan = $_SESSION['pelanggan']['nama_pelanggan'];
$koneksi = mysqli_connect("localhost","root","","db_tubessi");
// $koneksi = mysqli_connect("sql307.epizy.com","epiz_27302184","o5buL10tF8","epiz_27302184_tubessi");

$result = mysqli_query($koneksi,"SELECT * FROM pelanggan");
// echo "<pre>";
// var_dump($nama_pelanggan);
// print_r($_SESSION['pelanggan']);
// echo "</pre>";
$akun=mysqli_fetch_assoc($result);

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
               <li class="nav-item mx-md-2"><a href="index.php" class="nav-link active">Beranda</a></li>
               <li class="nav-item mx-md-2"><a href="katalog.php" class="nav-link">Katalog</a></li>
               <li class="nav-item mx-md-2"><a href="aboutus.php" class="nav-link">Tentang Kami</a></li>
            </ul>
            <a href="keranjang.php">
               <i class="fas fa-shopping-cart mx-md-2 mr-3 keranjang"></i>
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
   <div class="container">
      <div class="row d-flex align-items-center">
         <div class="col-md-6 title-jumbotron">
            <h3>BUBUK KOPI DENGAN PRODUKSI TERBAIK</h3>
            <form class="form-inline text-white">
               <button class="btn btn-katalog" href="katalog.php">
                  Katalog
               </button>
            </form>
         </div>
         <div class="col-md-6">
            <img src="assets/photo-1603052875230-416ab3bc0545-removebg.png" alt="">
         </div>
      </div>
   </div>
</section>

<!-- Content Start -->
<section class="section-content">
   <div class="container">
      <div class="row d-flex align-items-center">
         <div class="col-md-6">
            <h3>Bikin cerita asik mu bersama pilihan kopi produksi terbaik</h3>
            <p>Keinget mantan bikin hari-hari mu kacau</p>
            <form class="form-inline text-white">
               <button class="btn btn-katalog" href="aboutus.php">
                  Baca Lagi
               </button>
            </form>
         </div>
         <div class="col-md-6 d-none d-md-block">
            <div class="row d-flex align-items-center">
               <div class="col-md-6 picture-one img-fluid" style="background-image: url(assets/photo-1598524817357-f7d55f772246.jpg);">
               </div>
               <div class="col-md-5 picture-two offset-1 img-fluid" style="background-image: url(assets/photo-1581447355321-05e5534bc367.jpg);">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Akhir Content Start -->
<!-- Produk Terbaru -->
<section class="section-produk">
   <div class="container">
      <div class="row">
         <div class="col mt-5 text-center">
            <h4>Produk Terbaru</h4>
            <p>Aroma kopi terbaru sama harumnya taman bunga, Eaa</p>
         </div>
      </div>
      <div class="row justify-content-center">
<?php
   $ambil = mysqli_query($koneksi,"SELECT * FROM produk ORDER BY id_produk DESC LIMIT 3");
   while($rows = mysqli_fetch_assoc($ambil)){

?>
         <div class="col-md-4 mb-5 mt-5">
            <div class="card-produk text-center d-flex flex-column">
               <img src="PEMWEB/photo/<?= $rows['gambar_produk'] ?>" width="auto" height="400px">
               <div class="title-produk">
                  <h5><?= $rows['nama_produk'] ?></h5>
               </div>
               <div class="button-beli mt-auto">
                  <!-- <a href="beli.php?id=<?= $rows['id_produk']; ?>" class="btn btn-beli"><?= number_format($rows['harga_produk']) ?></a> -->
                  <a href="details.php?id=<?= $rows['id_produk']; ?>" class="btn btn-beli"><?= number_format($rows['harga_produk']) ?></a>
               </div>
            </div>
         </div>
<?php } ?>
         <!-- <div class="col-md-4 mb-5 mt-5">
            <div class="card-produk text-center d-flex flex-column">
               <img src="assets/toraja-removebg-preview.png" alt="">
               <div class="title-produk">
                  <h5>Bubuk Kopi Toraja</h5>
               </div>
               <div class="button-beli mt-auto">
                  <a href="details.html" class="btn btn-beli">Rp. 29.000</a>
               </div>
            </div>
         </div>
         <div class="col-md-4 mb-5 mt-5">
            <div class="card-produk text-center d-flex flex-column">
               <img src="assets/toraja-removebg-preview.png" alt="">
               <div class="title-produk">
                  <h5>Bubuk Kopi Toraja</h5>
               </div>
               <div class="button-beli mt-auto">
                  <a href="details.html" class="btn btn-beli">Rp. 29.000</a>
               </div>
            </div>
         </div> -->
      </div>
   </div>
</section>
<!-- Akhir Produk -->
<section class="section-up">
   <div class="container">
      <div class="row">
         <div class="col mt-5 text-center">
            <h4>Mengapa di HITZ COFFEE ?</h4>
         </div>
      </div>
      <div class="row justify-content-center">
         <div class="col-md-6">
            <div class="row mt-5">
               <div class="col-3">
                  <i class="far fa-kiss-wink-heart fa-5x"></i>
               </div>
               <div class="col-7 offset-1">
                  <h3>Kualitas Terbaik</h3>
                  <p>Kami mengolah dari biji kopi kualitas terbaik dari biji biji kopi pilihan agar dapat menghasilkan produk terbaik</p>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="row mt-5">
               <div class="col-3">
                  <i class="fas fa-money-bill-wave fa-5x"></i>
               </div>
               <div class="col-7 offset-1">
                  <h3>Harga Bersahabat</h3>
                  <p>Dengan kualitas terbaik dapat Anda dapatkan dengan harga yang murah dan tentunya bersahabat dengan isi dompet</p>
               </div>
            </div>
         </div>
      </div>
      <div class="row justify-content-center">
         <div class="col-md-6">
            <div class="row mt-5">
               <div class="col-3">
                  <i class="fab fa-telegram-plane fa-5x"></i>
               </div>
               <div class="col-7 offset-1">
                  <h3>Pengiriman Gratis</h3>
                  <p>Biaya ongkir ke mana pun menjadi gratis dengan bertransaksi minimal Rp.100.000</p>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="row mt-5">
               <div class="col-3">
                  <i class="fas fa-box-open fa-5x"></i>
               </div>
               <div class="col-7 offset-1">
                  <h3>Garansi</h3>
                  <p>Apabila produk yang diterima rusak dapat dikembalikan uang 100% atau produk dapat ditukar</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

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