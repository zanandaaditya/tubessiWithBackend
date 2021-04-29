<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","db_tubessi");
// $koneksi = mysqli_connect("sql307.epizy.com","epiz_27302184","o5buL10tF8","epiz_27302184_tubessi");
$id_produk = $_GET['id'];

$result = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk='$id_produk' ");
$rows = mysqli_fetch_assoc($result);
$nama_pelanggan = $_SESSION['pelanggan']['nama_pelanggan'];
// echo "<pre>";
// print_r($_SESSION['pelanggan']);
// print_r($rows);
// echo "</pre>";


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
                  <li class="nav-item mx-md-2"><a href="katalog.php" class="nav-link active">Katalog</a></li>
                  <li class="nav-item mx-md-2"><a href="aboutus.php" class="nav-link">Tentang Kami</a></li>
               </ul>
               <a href="keranjang.php">
                  <i class="fas fa-shopping-cart mx-md-2 mr-3 keranjang"></i>
               </a>

      <!-- Mobile Button -->
               <form class="form-inline d-sm-block d-md-none">
               <?php if (isset($_SESSION['pelanggan'])) :?>
                  <p>Halo, <?= $nama_pelanggan; ?></p>
               <?php else: ?>
                  <a href="login.php" class="btn btn-login my-2 my-sm-0 px-4">Masuk</a>
               <?php endif; ?>
               </form>
      <!-- Destkop Button -->
               <form class="ml-3 form-inline my-2 my-lg-0 d-none d-md-block">
               <?php if (isset($_SESSION['pelanggan'])) :?>
                  <p>Halo, <?= $nama_pelanggan ?></p>
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
                  <li class="breadcrumb-item"><a href="katalog.php">Katalog</a></li>
                  <li class="breadcrumb-item active">Detail</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
</section>
<!-- Akhir Bread -->

<!-- Details -->
<section class="section-details">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-md-6">
         <form action="" method="POST">
            <h4 class="mt-5 title-produk"><?= $rows['nama_produk'] ?></h4>
            <p class="harga">IDR <?= number_format($rows['harga_produk']) ?></p>
            <p class="text-comment p-3">
               <?= $rows['deskripsi_produk'] ?>
            </p>
            <div class="row justify-content-center d-flex align-items-center">
               <div class="col-md-6">
                  <div class="row">
                     <div class="col-md-3 mr-3">
                        <button type="button" class="btn btn-lg btn-kurang" style="background-color:#707070;; color: white;"><i
                        class="fas fa-minus-circle"></i></button>
                     </div>
                     <div class="col-md-4">
                        <input type="number" min="1" class="inp form-control" value="1" width="100px" name="jumlah">
                     </div>
                     <div class="col-md-3">
                     <button type="button" class="btn btn-lg btn-tambah" style="color: white;left:-20px"><i
                     class="fas fa-plus-circle"></i></button>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                     <button name="addCart" class="btn btn-beli">Tambahkan ke Keranjang</button>
                     <!-- <a href="beli.php?id=<?= $rows['id_produk']; ?>" class="btn btn-beli"><?= number_format($rows['harga_produk']) ?></a> -->
               </div>
            </div>
         </form>
         <?php
            if (isset($_POST['addCart'])) {
               global $id_produk;
               if (isset(['keranjang'][$id_produk])) {
                  $jumlah = $_POST['jumlah'];
                  $_SESSION['keranjang'][$id_produk]=$jumlah;
               }
              //jk belum ada dianggap satu
               else{
                  $jumlah = $_POST['jumlah'];
                  $_SESSION['keranjang'][$id_produk]=$jumlah;
               }

               var_dump($jumlah);
               echo "<pre>";
            print_r($_SESSION['keranjang']);
            echo "</pre>";
            echo "<script>alert('Produk sudah dimasukkan ke keranjang');</script>";
               echo "<script>location='keranjang.php';</script>";

            }
         ?>
         </div>
         <div class="col-md-6 text-center" style="margin-top: 50px; margin-bottom: 50px;">
            <img src="PEMWEB/photo/<?= $rows['gambar_produk'] ?>" alt="">
         </div>
      </div>
   </div>
</section>
<!-- Akhir Details -->

<!-- Produk Terbaru -->
<section class="section-produk">
   <div class="container">
      <div class="row">
         <div class="col mt-5 text-center">
            <h4>Produk Lainnya</h4>
            <p>Mungkin Anda suka dengan produk yang kami sarankan</p>
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
                  <a href="details.php?id=<?= $rows['id_produk']; ?>" class="btn btn-beli"><?= number_format($rows['harga_produk']) ?></a>
               </div>
            </div>
         </div>
<?php } ?>
         <!-- <div class="col-md-3 mb-5 mt-5">
            <div class="card-produk text-center d-flex flex-column">
               <img src="assets/toraja-removebg-preview.png" alt="">
               <div class="title-produk">
                  <h5>Bubuk Kopi Toraja</h5>
               </div>
               <div class="button-beli mt-auto">
                  <a href="" class="btn btn-beli">Rp. 29.000</a>
               </div>
            </div>
         </div>
         <div class="col-md-3 mb-5 mt-5">
            <div class="card-produk text-center d-flex flex-column">
               <img src="assets/toraja-removebg-preview.png" alt="">
               <div class="title-produk">
                  <h5>Bubuk Kopi Toraja</h5>
               </div>
               <div class="button-beli mt-auto">
                  <a href="" class="btn btn-beli">Rp. 29.000</a>
               </div>
            </div>
         </div> -->
      </div>
   </div>
</section>
<!-- Akhir Produk Terbaru -->

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
   <script src="js/custom.js"></script>
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
   <script src="js/all.js"></script>
   <script src="js/jquery-3.5.1.min.js"></script>
</body>
</html>