<?php

session_start();
$koneksi = mysqli_connect("localhost","root","","db_tubessi");
// $koneksi = mysqli_connect("sql307.epizy.com","epiz_27302184","o5buL10tF8","epiz_27302184_tubessi");
if (!isset($_SESSION["pelanggan"])) {
   header("Location: login.php");
   exit;
}
$nama_pelanggan = $_SESSION['pelanggan']['nama_pelanggan'];

if(isset($_POST['cari'])){
   $cari = $_POST['keyword'];
   $data = mysqli_query($koneksi,"SELECT * FROM produk WHERE nama_produk like '%".$cari."%'");
}else{
   $data = mysqli_query($koneksi,"SELECT * FROM produk");
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
               <li class="nav-item mx-md-2"><a href="katalog.php" class="nav-link active">Katalog</a></li>
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
   <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
         <div class="carousel-item active">
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
         <div class="carousel-item">
            <div class="row d-flex align-items-center">
               <div class="col-md-6 title-jumbotron">
                  <h3>Cari produk yang cocok dengan Anda</h3>
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
         <div class="carousel-item">
            <div class="row d-flex align-items-center">
               <div class="col-md-6 title-jumbotron">
                  <h3>Harga yang murah belum tentu kualitas terbaik, namun disini kualitas dan harga sesuai dompet dan hasrat</h3>
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
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="sr-only">Next</span>
      </a>
      </div>

   </div>
</section>

<!-- Breadcrubms -->
<section class="section-bred">
   <div class="container">
      <div class="row">
         <div class="col">
            <nav aria-label="breadcrumb" class="bg-transparent">
               <ol class="breadcrumb bg-transparent">
                  <li class="breadcrumb-item active">Katalog</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
</section>
<!-- Akhir Bread -->

<!-- Searching -->
<section class="section-cari">
   <div class="container">
      <div class="row">
         <div class="col text-center">
         <form class="form-inline sm-form form-sm mt-0 ml-2 mb-4 d-flex justify-content-center" method="POST">
            <input class="form-control form-control-sm ml-3 w-10" type="text" placeholder="Cari Produk" name="keyword" id="keyword" autofocus>
               <button type="submit" class="btn btn-sm" name="cari" id="tombol-cari">
               <i class="fas fa-search"></i>
               </button>
         </form>
         </div>
      </div>
   </div>
</section>
<!-- Akhir Searching -->

<!-- Produk Terbaru -->
<section class="section-katalog">
   <div class="container">
      <div class="row justify-content-center">
      <?php

   while($rows = mysqli_fetch_assoc($data)){
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
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
   <script src="js/all.js"></script>
   <script src="js/jquery-3.5.1.min.js"></script>
</body>
</html>