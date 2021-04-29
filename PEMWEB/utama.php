<?php

$result = mysqli_query($koneksi, "SELECT * FROM user");
$ambil = mysqli_query($koneksi,"SELECT * FROM produk");
$pengguna = mysqli_num_rows($result);
$produkJum = mysqli_num_rows($ambil);

?>
<h1 class="text-center p-4">SELAMAT DATANG, <?= $nama_pelanggan; ?></h1>
<div class="row justify-content-around">
    <div class="col-md-4 mt-2">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6 align-items-center d-flex flex-column mt-4">
                        <div class="card-title">
                            <h5>Produk</h5>
                        </div>
                        <div class="card-subtitle text-center">
                            <p style="font-size: 23px;"><?= $produkJum; ?></p>
                        </div>
                    </div>
                    <div class="col-6">
                        <i class="fas fa-mug-hot fa-5x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-2">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6 align-items-center d-flex flex-column mt-4">
                        <div class="card-title">
                            <h5>Pengguna</h5>
                        </div>
                        <div class="card-subtitle text-center">
                            <p style="font-size: 23px;"><?= $pengguna; ?></p>
                        </div>
                    </div>
                    <div class="col-6">
                    <i class="fas fa-user fa-5x"></i></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>