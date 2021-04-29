<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","db_tubessi");
// $koneksi = mysqli_connect("sql307.epizy.com","epiz_27302184","o5buL10tF8","epiz_27302184_tubessi");
// $koneksi = mysqli_connect("sql202.epizy.com","epiz_27355163","WYHalRNWwPXv","epiz_27355163_db_tubessi");

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
   $id = $_COOKIE['id'];
   $key = $_COOKIE['key'];

   //ambil username bedasarkan id
   $result= mysqli_query($koneksi, "SELECT email_pelanggan, nama_pelanggan FROM pelanggan WHERE id_pelanggan=$id");
   $row =  mysqli_fetch_assoc($result);

   //cek kookie dan username
   if ($key === hash('sha256', $row['nama_user'])) {
     $_SESSION['pelanggan'] = true;
   }
 }

 if (isset($_SESSION["pelanggan"])) {
   header("Location:index.php");
   exit;
}
// if (isset($_SESSION["keranjang"]) OR !empty($_SESSION['keranjang'])) {
//    header("Location:checkout.php");
//    exit;
// }
// else
// {
//    header("Location:riwayat.php");
//    exit;
// }


   if(isset($_POST["login"])){

      $email = $_POST['email'];
      $password = $_POST['password'];
      $result = mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE email_pelanggan='$email' OR nama_pelanggan='$email' ");
     //cek username
      if (mysqli_num_rows($result)===1) {
       //cek password
      $row = mysqli_fetch_assoc($result);
      if(password_verify($password,$row["password_pelanggan"])){
         //set session
         $_SESSION["pelanggan"] = $row;

         //cek remember me
         if (isset($_POST['remember'])) {
           //buat cookienya

           setcookie('id',$row['id'],time()+60);
           setcookie('key',hash('sha256',$row['nama_pelanggan']),time()+60);
         }

         header("Location:index.php?halaman=utama");
         exit;
       }
     }
     $error=true;

   }

// if (isset($_POST['login'])) {

// $email = $_POST['email'];
// $password = $_POST['password'];

//     $result = mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'
//    ");

//    $data = mysqli_num_rows($result);

//    if ($data===1) {
//       $akun = mysqli_fetch_assoc($result);
//       $_SESSION['pelanggan'] = $akun;

//       header('Location:index.php');
//                exit;
//    } else {
//       $error=true;
//    }
// }
// if (isset($_SESSION["pelanggan"])) {
//    header("Location: index.php");
//    exit;
// }
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
<div class="page-content page-auth mt-5">
      <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row align-items-center row-login">
            <div class="col-lg-6 text-center">
               <img
               src="PEMWEB/photo/login-placeholder.png"
               alt=""
               class="w-50 mb-4 mb-lg-none"/>
            </div>
            <div class="col-md-6">
            <div class="panel panel-default">
               <div class="panel-heading">
                     <h3 class="panel-title">Masuk</h3>
               </div>
               <div class="panel-body">
               <?php if(isset($error)){
                     echo"<div class='alert alert-danger'>Username atau Password tidak sesuai</div>";
               } ?>
                     <form action="" method="POST">
                     <div class="form-group">
                           <label for="email">Username</label>
                           <input type="text" name="email" class="form-control" placeholder="Email atau Username" required>
                        </div>
                        <div class="form-group">
                           <label for="password">Password</label>
                           <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
                        </div>
                        <div class="form-check mb-4">
                           <input type="checkbox" class="form-check-input" id="exampleCheck1">
                           <label class="form-check-label" for="exampleCheck1" name="remember">Ingkatkan saya diperambanan ini</label>
                        </div>
                        <button class="btn btn-success btn-block mt-4 w-75"
                           href="" type="submit" name="login">Masuk</button>
                           <a
                           class="btn btn-secondary mt-2 btn-block w-75" href="register.php">
                                 Daftar
                           </a>
                        <!-- <button type="submit" class="btn btn-primary btn-beli w-25" name="login" href="login.php">Login</button>
                        <button type="submit" class="btn btn-secondary w-25" name="register" href="register.php">Daftar</button> -->
                        <p>Belum punya akun?klik <a href="register.php">disini</a></p>
                     </form>
               </div>
            </div>
         </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- <section class="section-content">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <div class="head-title">
               <h3>Sahabat Baru Kophitz ? Silahkan Daftar</h3>
            </div>
            <div class="p-title">
               <p>Gabung bersama sahabat kophitz, nikmati setiap promo dan diskon yang pastinya no have akhlak</p>
            </div>
         </div>
      </div>
         <div class="col-md-6">
            <div class="panel panel-default">
               <div class="panel-heading">
                     <h3 class="panel-title">Login pelanggan</h3>
               </div>
               <div class="panel-body">
               <?php if(isset($error)){
                     echo"<div class='alert alert-danger'>Username atau Password tidak sesuai</div>";
               } ?>
                     <form action="" method="POST">
                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                           <label for="password">Password</label>
                           <input type="password" name="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                     </form>
               </div>
            </div>
      </div>
   </div>
</section> -->


<!-- Akhir Footer -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
   <script src="js/all.js"></script>
   <script src="js/jquery-3.5.1.min.js"></script>
</body>
</html>