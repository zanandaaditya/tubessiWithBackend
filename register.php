<?php
require 'functions.php';

if(isset($_POST["register"])) {

    if(registrasi($_POST)>0){
        echo "
        <script>
            alert ('User berhasil ditambahkan');
            document.location.href= 'login.php';
        </script>
    ";


    } else {
        echo mysqli_error($koneksi);
    }
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

<div class="page-content page-auth mt-5">
      <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row align-items-center row-login">
            <div class="col-md-6 text-center">
               <img
               src="PEMWEB/photo/login-placeholder.png"
               alt=""
               class="w-50 mb-4 mb-lg-none"/>
            </div>
            <div class="col-md-6 mx-auto">
            <div class="panel panel-default">
               <div class="panel-heading">
                     <h3 class="panel-title">Daftar</h3>
               </div>
               <div class="panel-body">
               <?php if(isset($error)){
                     echo"<div class='alert alert-danger'>Username atau Password tidak sesuai</div>";
               } ?>
                     <form action="" method="POST">
                        <div class="form-group">
                           <label for="username">Username</label>
                           <input type="text" name="username" class="form-control w-75" required>
                        </div>
                        <div class="form-group">
                           <label for="email">Email</label>
                           <input type="email" name="email" class="form-control w-75" required>
                        </div>
                        <div class="form-group">
                           <label for="password">Password</label>
                           <input type="password" name="password" class="form-control w-75" required>
                        </div>
                        <div class="form-group">
                           <label for="password2">Ulangi Password</label>
                           <input type="password" name="password2" class="form-control w-75" required>
                        </div>
                        <div class="form-group">
                           <label for="notelp">Nomor Telepon</label>
                           <input type="number" name="notelp" class="form-control w-75" required>
                        </div>
                        <button class="btn btn-success btn-block mt-4 w-75"
                           href="" type="submit" name="register">Daftar</button>
                           <a
                           class="btn btn-secondary mt-2 btn-block w-75" href="login.php">
                                 Masuk
                           </a>
                        <!-- <button type="submit" class="btn btn-secondary btn-beli w-25" name="login">Login</button>
                        <button type="submit" class="btn btn-primary w-25" name="register">Daftar</button> -->
                     </form>
               </div>
            </div>
         </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- <section class="section-content-login">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-md-6">
            <div class="img-responsive bg-img d-flex flex-column" style="width: 100%; max-height:600px; background-image: url('../assets/photo-1598524817357-f7d55f772246.jpg');">
               <div class="title"><h2>Halo sahabat cofhitz, Silahkan Login</h2></div>
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