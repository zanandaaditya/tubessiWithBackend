<?php
session_start();
require 'functions.php';
if (!isset($_SESSION["pelanggan"])) {
   header("Location: login.php");
   exit;
}

$result = query("SELECT * FROM produk");
if (isset($_POST['cari'])) {
    $result = $_POST['keyword'];
 }

   $koneksi = mysqli_connect("localhost","root","","db_tubessi");
   // $koneksi = mysqli_connect("sql310.epizy.com","epiz_27636863","eAB0Ci78ai28T","epiz_27636863_db_tubessi");
   // $koneksi = mysqli_connect("sql202.epizy.com","epiz_27355163","WYHalRNWwPXv","epiz_27355163_db_tubessi");

   $nama_pelanggan = $_SESSION['pelanggan']['nama_user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin</title>
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="../style/font/all.css">
   <!-- Style Manual -->
   <link rel="stylesheet" href="style/style.css">
   <!-- Font Import -->
   <style>
      @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&family=Playfair+Display:wght@400;700&display=swap');
   </style>
</head>
<body>
<section class="wrapper hover-collapse">
      <div class="top-navbar">
         <div class="logo">
            <img src="../assets/Logo.png" alt="">
         </div>
         <div class="menu">
            <div class="hamburger" >
               <i class="fas fa-bars"></i>
            </div>
            <div class="profile-wrap">
               <div class="profile">
                  <div class="name">
                  <li class="nav-item dropdown" style="list-style-type: none;">
                     <a class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">Halo, <?= $nama_pelanggan; ?>
                     </a>
                     <div class="dropdown-menu">
                     <a href="edit-profil.php" class="dropdown-item">Profil</a>
                     <hr>
                     <a href="logout.php" class="dropdown-item">Keluar</a>
                  </div>
               </li>
               </div>
                  <div class="icon" type="hidden">
                     <i class="fas fa-angle-down"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>


   <div class="side-bar">
      <div class="sidebar_inner">
         <ul>
            <li class="">
               <a href="index.php?halaman=utama" class="d-flex flex-row">
                  <div class="icon mr-2"><i class="fas fa-home"></i></div>
                  <div class="text">Beranda</div>
               </a>
            </li>
            <li>
               <a href="index.php?halaman=produk" class="d-flex flex-row">
                  <div class="icon mr-2"><i class="fas fa-shopping-bag"></i></div>
                  <div class="text">Produk</div>
               </a>
            </li>
            <li>
               <a href="index.php?halaman=pembelian" class="d-flex flex-row">
                  <div class="icon mr-2"><i class="fas fa-users"></i></div>
                  <div class="text">Pembelian</div>
               </a>
            </li>
            <li>
               <a href="logout.php" class="d-flex flex-row">
                  <div class="icon mr-2"><i class="fas fa-sign-out-alt"></i></div>
                  <div class="text">Logout</div>
               </a>
            </li>
         </ul>
      </div>
   </div>

   <div class="main-container">
      <div class="container">
         <div class="content">
            <?php
               if (isset($_GET['halaman'])) {
                  if ($_GET['halaman']=="produk") {
                     include 'produk.php';
                  } elseif ($_GET['halaman']=="pembelian") {
                     include 'pembelian.php';
                  } elseif ($_GET['halaman']=="pelanggan") {
                     include 'pelanggan.php';
                  } elseif ($_GET['halaman']=="detail"){
                     include 'detail.php';
                  } elseif ($_GET['halaman']=="tambahProduk"){
                     include 'tambahProduk.php';
                  } elseif ($_GET['halaman']=="hapusProduk"){
                     include 'hapusProduk.php';
                  } elseif ($_GET['halaman']=="ubahProduk"){
                     include 'ubahProduk.php';
                  } elseif ($_GET['halaman']=="utama"){
                     include 'utama.php';
                  } elseif ($_GET['halaman']=="hapusUser"){
                     include 'hapusUser.php';
                  } elseif ($_GET['halaman']=="pembayaran"){
                     include 'pembayaran.php';
                  }
               }
               else
               {
                  include 'index.php';
               }
            ?>
         </div>
      </div>
   </div>
</section>
   <script src="js/jquery-3.5.1.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
   <script src="js/all.js"></script>
   <script src="script/script.js"></script>
   <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

</body>
</html>