<?php

if (isset($_POST["submit"])) {

    //notifikasi sukses atau tidak
    if (tambah($_POST) > 0){
        echo "
            <script>
                alert ('data berhasil ditambahkan');
                document.location.href= 'index.php?halaman=produk';
            </script>
        ";
    } else {
        echo "
            <script>
                alert ('data GAGAL ditambahkan');
                document.location.href= 'index.php?halaman=produk';
            </script>
        ";
    }

}
?>

<h2>TAMBAH PRODUK</h2>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Nama Produk</label>
        <input type="text" name="nama_produk" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Harga Produk</label>
        <input type="number" name="harga_produk" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Berat Produk (gr)</label>
        <input type="number" name="berat_produk" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Deskripsi Produk</label>
        <textarea name="deskripsi_produk" class="form-control" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="">Foto Produk</label>
        <input type="file" name="gambar_produk" id="">
    </div>
    <button class="btn btn-primary" name="submit" type="submit">TAMBAH PRODUK</button>

</form>