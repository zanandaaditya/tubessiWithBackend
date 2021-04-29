<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","db_tubessi");
// $koneksi = mysqli_connect("sql307.epizy.com","epiz_27302184","o5buL10tF8","epiz_27302184_tubessi");
if (!isset($_SESSION["pelanggan"])) {
   header("Location: login.php");
   exit;
}
// echo "<pre>";
// print_r($_SESSION['keranjang']);
// print_r($_SESSION['pelanggan']);
// echo "</pre>";

if (isset($_POST['checkout'])) {
   $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
   $id_ongkir = $_POST['id_ongkir'];
   $tanggal_pembelian = date("Y-m-d");

   $ongkirku = mysqli_query($koneksi,"SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
   $rows = mysqli_fetch_assoc($ongkirku);
   $nama_kota = $rows['nam_kota'];
   $tarif = $rows['tarif'];
   $total_pembelian = $totalbelanja + $tarif;

   //simpan data
   $ambil = mysqli_query($koneksi,"INSERT INTO pembelian (id_pembelian, id_pelanggan,id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif_ongkir) VALUES
   ('','$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif')
   ");

   //ambil id_pembelian
   $id_pembelian_baru = $koneksi->insert_id;

   foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
     //duplikat produk
     $ambil_data = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk='$id_produk'");
     $pecah_data=mysqli_fetch_assoc($ambil_data);
     $nama = $pecah_data['nama_produk'];
     $harga = $pecah_data['harga_produk'];
     $berat = $pecah_data['berat_produk'];
     $subberat = $pecah_data['berat_produk']*$jumlah;
     $subharga = $pecah_data['harga_produk']*$jumlah;

     $ambil_id = mysqli_query($koneksi,"INSERT INTO pembelian_produk VALUES
                 ('','$id_pembelian_baru','$id_produk','$jumlah','$nama','$harga','$berat','$subberat','$subharga') ");
   }

   //jika sudah bayar kosongkan keranjang
   unset($_SESSION['keranjang']);

   //view ke halaman checkout, untuk melakukan pembayaran
   echo "<script>alert('Pembelian sukses');
         location='nota.php?id=$id_pembelian_baru';
         </script>";
 }
// Mengamankan NOTA
$nama_pelanggan = $_SESSION['pelanggan']['nama_pelanggan'];
?>
<!-- <pre>
  <?php print_r($_SESSION['pelanggan']); ?>
  <?php print_r($_SESSION['keranjang']); ?>

</pre> -->
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
</section>


<!-- Breadcrubms -->
<section class="section-bred">
   <div class="container">
      <div class="row">
         <div class="col">
            <nav aria-label="breadcrumb" class="bg-transparent">
               <ol class="breadcrumb bg-transparent">
                  <li class="breadcrumb-item"><a href="profil.php">Profil</a></li>
                  <li class="breadcrumb-item"><a href="riwayat.php">Riwayat</a></li>
                  <li class="breadcrumb-item active">Nota Pembelian</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
</section>
<!-- Akhir Bread -->

<!-- Awal Keranjang -->
<section class="content store-cart p-4">
  <div class="container">

    <!-- Nota -->
    <h3 class="text-center">DETAIL PEMBELIAN</h3>
<?php
$cari=$_GET['id'];

$ambil=mysqli_query($koneksi,"SELECT * FROM pembelian INNER JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian=$cari");

$row= mysqli_fetch_assoc($ambil);

$id_pelanggan_yangbeli = $row['id_pelanggan'];
$id_pelanggan_yanglogin = $_SESSION['pelanggan']['id_pelanggan'];
if ($id_pelanggan_yangbeli !== $id_pelanggan_yanglogin) {
   echo "<script>
         location='riwayat.php';
         </script>";
   exit;
}
?>
<!-- <pre>
  <?php print_r($row); ?>
  <?php print_r($_SESSION); ?>

</pre> -->
   <div class="row">
      <div class="col-md-6">
         <div class="form-group">
            <label for="namaPenerima">Nama Penerima</label>
            <input type="text" readonly value="<?= $row['nama_pelanggan'] ?>" class="form-control">
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label for="noPenerima">Nomor Penerima</label>
            <input type="text" readonly value="<?= $row['nomor_pelanggan']; ?>" class="form-control">
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6">
         <div class="form-group">
            <label for="EPenerima">Email Penerima</label>
            <input type="text" readonly value="<?= $row['email_pelanggan']; ?>" class="form-control">
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label for="namaPenerima">Tanggal Pembelian</label>
            <input type="text" readonly value="<?= $row['tanggal_pembelian']; ?>" class="form-control">
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6">
         <div class="form-group">
            <label for="namaPenerima">Nama Provinsi</label>
            <input type="text" readonly value="<?= $row['nama_provinsi'] ?>" class="form-control">
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label for="namaPenerima">Nama Kota</label>
            <input type="text" readonly value="<?= $row['nama_kota'] ?>" class="form-control">
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6">
         <div class="form-group">
            <label for="namaPenerima">Alamat 1</label>
            <input type="text" readonly value="<?= $row['alamat1'] ?>" class="form-control">
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label for="namaPenerima">Alamat 2</label>
            <input type="text" readonly value="<?= $row['alamat2'] ?>" class="form-control">
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6">
         <div class="form-group">
            <label for="namaPenerima">Total Belanja</label>
            <input type="text" readonly value="<?= $totja = $row['total_pembelian'] ?>" class="form-control">
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label for="namaPenerima">Total Ongkos Kirim</label>
            <input type="text" readonly value="<?= $ongkoskirim = $row['tarif_ongkir'] ?>" class="form-control">
         </div>
      </div>
   </div>

<!-- <pre><?php print_r($row); ?></pre>

<strong><?= $row['nama_pelanggan'] ?></strong> <br/>
<p>
    <?= $row['nomor_pelanggan']; ?> <br/>
    <?= $row['email_pelanggan']; ?>
</p>
<p>
    Tanggal : <?= $row['tanggal_pembelian']; ?> <br/>
    Total : <?= $total = $row['total_pembelian']; ?>

</p> -->

<table class="table mt-5">
    <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Berat</th>
        <th>Jumlah</th>
        <th>Subberat</th>
        <th>Subtotal</th>
        <th>Total</th>
    </tr>
    <?php $i=1;?>
    <?php $totalbelanja=0;?>
    <?php $ambil=mysqli_query($koneksi,"SELECT * FROM pembelian_produk WHERE id_pembelian='$cari' "); ?>
    <?php while($row=mysqli_fetch_assoc($ambil)): ?>
    <tr>
        <td><?= $i; ?></td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['harga']; ?></td>
        <td><?= $row['berat']; ?></td>
        <td><?= $row['jumlah'];?></td>
        <td><?= $row['subberat']; ?> Gr</td>
        <td><?= $row['subharga']; ?></td>
        <td>
            Rp.<?= $row['harga']*$row['jumlah']; ?>
        </td>
    </tr>
    <?php $i++; ?>
    <?php $totalbelanja += $row['subharga']?>
    <?php endwhile;?>
    <tfoot>
      <tr class="align-middle">
         <th colspan="7" class="text-center">Total Belanja</th>
         <th>IDR <?= number_format($totalbelanja) ?></th>
      </tr>
      <tr class="align-middle">
         <th colspan="7" class="text-center">Total Ongkos Kirim</th>
         <th>IDR <?= number_format($ongkoskirim); ?></th>
      </tr>
      <tr class="align-middle">
         <th colspan="7" class="text-center text-success">Total Akhir</th>
         <th class="text-success">IDR <?= number_format($totja); ?></th>
      </tr>
   </tfoot>
</table>


  </div>
</section>
<!-- Akhir Pembayaran -->
<div class="container" style="margin-top: 50px;">
   <hr />
</div>

<section class="payment store-cart">
   <div class="container p-4">
<h2>Informasi Pembayaran</h2>
<p>Silahkan melakukan pemayaran melalui nomor pembayaran dibawah ini</p>
   <div class="row mt-5">
   <div class="col-md-7">
      <div class="bank-item pb-3">

         <div class="instruction">
            <div class="row">
               <div class="col-3">
               <i class="fas fa-credit-card fa-7x" class="bank-image"></i>
               </div>
               <div class="col-8">
                  <div class="header-card">
                     <h3>PT HITZ.COFFEE INDONESIA</h3>
                  </div>
                  <div class="number-card">
                     <p>021-3121-0221</p>
                     <p>Bank Central Asia</p>
                  </div>
               </div>
            </div>
         </div>

         <div class="clearfix"></div>

         </div>
      </div>

   </div>
</section>

<div class="container">
<div class="row mb-5 mt-5 d-flex justify-content-center align-items-center pembayaran">
      <div class="col-12 col-md-3 mb-5 mt-2">
         <a href="riwayat.php" class="btn btn-success px-4 btn-block">
            Bayar Sekarang
         </a>
      </div>
   </div>
</div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- <script src="js/jquery.min.js"></script> -->
   <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
   <script src="js/all.js"></script>

   </script>
</body>
</html>