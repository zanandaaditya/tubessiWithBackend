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