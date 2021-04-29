<?php

?>
<h1>DATA PRODUK</h1>

<a href="index.php?halaman=tambahProduk" class="btn btn-primary">TAMBAH DATA</a>
<form class="form-inline sm-form form-sm mt-0 ml-2 mb-4 d-flex justify-content-center" method="POST">
    <input class="form-control form-control-sm ml-3 w-10" type="text" placeholder="Cari Produk" aria-label="Search" name="keyword" id="keyword" autofocus>
        <button type="submit" class="btn btn-sm" name="cari" id="tombol-cari">
        <i class="fas fa-search"></i>
        </button>
</form>
<div id="isi-table">
<table class="table table-responsive">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Harga</td>
            <td>Berat</td>
            <td>Foto</td>
            <td>Deskripsi</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php
        if(isset($_POST['cari'])){
            $cari = $_POST['keyword'];
            $data = mysqli_query($koneksi,"SELECT * FROM produk where nama_produk like '%".$cari."%'");
        }else{
            $data = mysqli_query($koneksi,"SELECT * FROM produk");
        }
        ?>
        <?php $i=1; ?>
        <?php while($row=mysqli_fetch_assoc($data)):?>

        <tr>
            <td><?= $i; ?></td>
            <td><?= $row["nama_produk"] ?></td>
            <td><?= $row["harga_produk"] ?></td>
            <td><?= $row["berat_produk"] ?></td>
            <td><img src="photo/<?= $row["gambar_produk"] ?>" alt="" width="100"></td>
            <td><?= $row["deskripsi_produk"]?></td>
            <td>
                <a href="index.php?halaman=hapusProduk&id=<?= $row['id_produk']; ?>" name="hapusProduk" class="btn btn-danger">HAPUS</a>
                <a href="index.php?halaman=ubahProduk&id=<?= $row['id_produk']; ?>" name="ubahProduk"  class="btn btn-warning">UBAH</a>
            </td>
        </tr>
        <?php $i++;?>
        <?php endwhile; ?>
    </tbody>
</table>
</div>
