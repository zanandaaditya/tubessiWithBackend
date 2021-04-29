<?php
$cari = $_GET['id'];

    $ambil = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk='$cari'");

    $row = mysqli_fetch_assoc($ambil);

    if (isset($_POST["ubah"])) {

        //notifikasi sukses atau tidak
        if (ubah($_POST) > 0){
            echo "
                <script>
                    alert ('data berhasil diubah');
                    document.location.href= 'index.php?halaman=produk';
                </script>
            ";
        } else {
            // echo "
            //     <script>
            //         alert ('data GAGAL diubah');
            //         document.location.href= 'index.php?halaman=produk';
            //     </script>
            // ";
        }


    }

//     if (isset($_POST['submit'])) {
//         $namaFile = $_FILES['gambar_produk']['name'];
//         $ukuranFile = $_FILES['gambar_produk']['size'];
//         $error = $_FILES['gambar_produk']['error'];
//         $lokasi = $_FILES['gambar_produk']['tmp_name'];

//         $nama_produk = $_POST['nama_produk'];
//         $harga_produk = $_POST['harga_produk'];
//         $berat_produk = $_POST['berat_produk'];
//         $deskripsi_produk = $_POST['deskripsi_produk'];

//            if (!empty($lokasi))
//             {

//                 move_uploaded_file($lokasi,"photo/$namaFile");

//                 mysqli_query($koneksi,"UPDATE produk SET
//                 nama_produk='$nama_produk',
//                 harga_produk='$harga_produk',
//                 berat_produk='$berat_produk',
//                 deskripsi_produk='$deskripsi_produk',
//                 gambar_produk='$namaFile'
//                 WHERE id_produk= '$cari';
//                 ");
//                 echo "
//                 <script>
//                     alert ('data berhasil di PERBAHARUI');
//                     document.location.href= 'index.php?halaman=produk';
//                 </script>
//             ";
//             }
//             else
//             {
//                 mysqli_query($koneksi,"UPDATE produk SET
//                 nama_produk='$nama_produk',
//                 harga_produk='$harga_produk',
//                 berat_produk='$berat_produk',
//                 deskripsi_produk='$deskripsi_produk'
//                 WHERE id_produk='$cari'
//                 ");
//                 echo "
//                 <script>
//                     alert ('datat gagal di PERBAHARUI');
//                     document.location.href= 'index.php?halaman=produk';
//                 </script>
//             ";

//             }


//             }



//         // echo "
//         // <script>
//         //     alert ('data berhasil di UPDATE');
//         //     document.location.href= 'index.php?halaman=produk';
//         // </script>
//         // ";


?>
<h2>UBAH PRODUK</h2>

<form action="" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= $row["id_produk"];?>">
<input type="hidden" name="gambarLama" value="<?= $row["gambar_produk"];?>">
    <div class="form-group">
        <label for="">Nama Produk</label>
        <input type="text" name="nama_produk" id="" class="form-control" value="<?= $row['nama_produk']; ?>">
    </div>
    <div class="form-group">
        <label for="">Harga Produk</label>
        <input type="number" name="harga_produk" id="" class="form-control" value="<?= $row['harga_produk']; ?>">
    </div>
    <div class="form-group">
        <label for="">Berat Produk (gr)</label>
        <input type="number" name="berat_produk" id="" class="form-control" value="<?= $row['berat_produk']; ?>">
    </div>
    <div class="form-group">
        <label for="">Deskripsi Produk</label>
        <textarea name="deskripsi_produk" class="form-control" rows="10"><?= $row['deskripsi_produk'];?></textarea>
    </div>
    <div class="form-group">
        <label for="">Foto Produk</label>
        <img src="photo/<?= $row['gambar_produk']; ?>" width="200" alt="" srcset="">
        <input type="file" name="gambar_produk" id="">
    </div>
    <button class="btn btn-primary" name="ubah" type="submit">UBAH PRODUK</button>

</form>
